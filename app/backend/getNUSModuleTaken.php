<?php

require_once '../../vendor/php-dom-parser/simple_html_dom.php';

function curl_post($curl, $url, $post_fields, $add_opt=array()) {
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_USERAGENT => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36",
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_FOLLOWLOCATION => TRUE,
        CURLOPT_POST => TRUE,
        CURLOPT_POSTFIELDS => $post_fields,
        CURLOPT_SSL_VERIFYPEER => false
    );
    curl_setopt_array($curl, $options+$add_opt);
    return curl_exec ($curl);
}

function curl_get($curl, $url, $cookiefile) {
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_COOKIEFILE => $cookiefile
    );
    curl_setopt_array($curl, $options);
    return curl_exec ($curl);
}

function parse_module($module_text) {
    $modules_taken = array();
	
	$regex_pattern = "/[A-Z]{2,3}\d{4}[A-Z]{0,1}/";
	$num_modules_taken = preg_match_all($regex_pattern, $module_text, $modules_code);
	$modules_info_array = preg_split($regex_pattern, $module_text);
	
	if ($num_modules_taken) {
		for ($i=0; $i<$num_modules_taken; $i++) {
			$module_info = explode(" ", trim($modules_info_array[$i+1]));
			$info_len = count($module_info);
			
			$module = array(
				"code" => $modules_code[0][$i],
				"name" => implode(" ", array_slice($module_info, 0, -2)),
				"MC" => $module_info[$info_len - 2],
				"grade" => $module_info[$info_len - 1]
			);
			array_push($modules_taken, $module);
		}
	}
	return $modules_taken;
}


// information to login to myisis
$matricNo = "A0113742";
$pwd = "";
$login_url = "https://myisis.nus.edu.sg/psp/cs90prd/EMPLOYEE/HRMS/h/?tab=DEFAULT&cmd=login&languageCd=ENG";
$login_fields = "userid=".$matricNo."&pwd=".$pwd;

// url to retrive all exam result root directory
$all_result_url = "https://myisis.nus.edu.sg/psc/cs90prd/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES.N_SSR_SSENRL_GRADE.GBL?FolderPath=PORTAL_ROOT_OBJECT.CO_EMPLOYEE_SELF_SERVICE.HCCC_ENROLLMENT.N_SSR_SSENRL_GRADE_GBL";

// url to retrieve specified semester exam result
$sem_result_url = "https://myisis.nus.edu.sg/psc/cs90prd/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES.N_SSR_SSENRL_GRADE.GBL";
$sem_result_field = "ICAJAX=1&ICAction=N_DERIVED_EXAM_SSR_PB_GO&SSR_DUMMY_RECV1\$sels\$0=";


$cookiefile = "cookie";
$ch = curl_init();
// login
$login_state = curl_post($ch, $login_url, $login_fields, array(CURLOPT_COOKIEJAR => $cookiefile));
if ($login_state) {
    // crawl "View My Exam Results" page from ISIS
    $all_result_page = curl_get($ch, $all_result_url, $cookiefile);
    // parse dom tree
    $all_result_dom = str_get_html($all_result_page);
    // store information for semester
    $sem_index_array = array();
    $sem_name_array = array();
    foreach($all_result_dom->find("input") as $ele){
        // only radio input are selectable semesters
        /*
            Each tr in term table (except th) has the following structure:
                <tr>
                    <td><div><input type="radio" .../></div></td>
                    <td><div><span>*Semester Details*</span></div></td>
                    ...
                </tr>
            
        */
        if ($ele->type == "radio") {
            array_push($sem_index_array, $ele->value);
            array_push($sem_name_array, $ele->parent()->parent()->next_sibling()->children(0)->children(0)->innertext);
        }
    }
    $all_result_dom->clear();
    
    // crawl each exam result page
    for ($i=0; $i<count($sem_index_array); $i++) {
        /*
            Individual semester page table information:
            - table showing modules taken : id -> TERM_CLASSES$scroll$0
                - inside its *child* table: 
                    - first tr includes th
                    - other tr has following structure:
                        <tr>
                            <td>
                                <div><span>*ModuleCode*</span></div>
                            </td>
                            <td>
                                <div><span>*ModuleTitle*</span></div>
                            </td>
                            <td>
                                <div><span>*MSs*</span></div>
                            </td>
                            <td>
                                <div><span>*Grade*</span></div>
                            </td>
                        </tr>
        */
        
//        $sem_result_page = curl_post($ch, $sem_result_url, $sem_result_field.$sem_index_array[$i], array(CURLOPT_COOKIEFILE => $cookiefile));
//        $sem_result_dom = str_get_html($sem_result_page);
//        $module_table = $sem_result_dom->find("#TERM_CLASSES\$scroll\$0");
    }
    
    
    
    // simple_html_dom parser seems to stop working ... and I don't know why!!!
    $sem_result_page = curl_post($ch, $sem_result_url, $sem_result_field.$sem_index_array[0], array(CURLOPT_COOKIEFILE => $cookiefile));

    // use text processing to extract information
    $raw_text = strip_tags($sem_result_page);
    // replace multiple spaces with one
    $trimed_text = preg_replace('!\s+!', ' ', $raw_text);
    $start_str = "Official Grades Module Description MCs/Units Grade";
    $end_str = "Term Statistics";
    $module_text_start_index = strpos($trimed_text, $start_str) + strlen($start_str);
    $module_text_length = strpos($trimed_text, $end_str) - $module_text_start_index;
    $module_text = substr($trimed_text, $module_text_start_index, $module_text_length);
    
    $modules_taken = parse_module($module_text);
    
    // need to process $module_text further
    /* proposal: 
        1. process module code out using regex
        2. query using NUSMOD API to get Description as well as MCs
        3. remove Description and MCs from $module_text
        4. convert array to (module,grade) pair
        5. print out table with th (Module ; Description ; MCs/Units ; Grade)
        
        OR
        
        1. process module code out using regex
        2. process grade out using dictionary
        3. process MCs out using regex
        4. get Description last
    */
    /*
        module grade dictionary:
        A+      5.0
        A       5.0
        A-      4.5
        B+      4.0
        B       3.5
        B-      3.0
        C+      2.5
        C       2.0
        D+      1.5
        D       1.0
        F       0
        no grade points are assigned:
        CS
        CU
        EXE
        IC
        IP
        S
        U
        W
        
        * explaination
        Completed Satisfactorily/Completed Unsatisfactorily (CS/CU)
        Exempted (EXE) 
        Incomplete (IC)
        In Progress (IP) 
        Satisfactory/Unsatisfactory (S/U)
        Withdrawn (W)
        
        CAP = sum ((module grade points) * 
                   (the number of MCs for the corresponding module))
              / (total number of MCs)
    */
    
} else {
    echo("failed to login");
}
curl_close($ch);

?>