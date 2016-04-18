<?php

require_once '../../vendor/php-dom-parser/simple_html_dom.php';

function curl_post($curl, $url, $cookiefile, $post_fields) {
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_USERAGENT => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36",
        CURLOPT_COOKIEJAR => $cookiefile,
        CURLOPT_POST => TRUE,
        CURLOPT_POSTFIELDS => $post_fields,
        CURLOPT_SSL_VERIFYPEER => false
    );
    curl_setopt_array($curl, $options);
    return curl_exec ($curl);
}

function curl_get($curl, $url, $cookiefile) {
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_COOKIEFILE => $cookiefile
    );
    curl_setopt_array($curl, $options);
    return curl_exec ($curl);
}

// login to myisis
$login_url = "https://myisis.nus.edu.sg/psp/cs90prd/EMPLOYEE/HRMS/h/?tab=DEFAULT&cmd=login&languageCd=ENG";
$login_fields = "userid=A0113742&pwd=Wyh1993~!@";

// retrive info list
$info_url = "https://myisis.nus.edu.sg/psc/cs90prd/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES.N_SSR_SSENRL_GRADE.GBL?FolderPath=PORTAL_ROOT_OBJECT.CO_EMPLOYEE_SELF_SERVICE.HCCC_ENROLLMENT.N_SSR_SSENRL_GRADE_GBL";

$cookiefile = "cookie";
$ch = curl_init();
$login_state = curl_post($ch, $login_url, $cookiefile, $login_fields);
if ($login_state) {
    $page = curl_get($ch, $info_url, $cookiefile);
    var_dump($page);
} else {
    echo("failed to login");
}
curl_close($c);

?>