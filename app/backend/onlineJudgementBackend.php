<?php

require_once 'printFormat.php';

function cleanup($dir) {
    passthru($dir."rm *.*", $return_value);
    if ($return_value != 0) {
        error_log("clean up failed");
    }
}
    
// check if upload success
if ($_FILES["file"]) {
    $saved_file_name = $_FILES["file"]["name"];
    if (substr($saved_file_name, strlen($saved_file_name) - 5, strlen($saved_file_name) - 1) != ".java") {
        print_jsonp_callback("{\"status\":\"fail\",\"message\":\"please upload a java file\"}");
        exit();
    }
    $program_name = substr($saved_file_name, 0, strlen($saved_file_name) - 5);
    $practice_dir = "../../assets/Practice/".$_REQUEST["practiceName"];
    $save_to_dir = $practice_dir."/tmp";
    $change_to_tmp_dir = "cd ".$save_to_dir."; ";
    $program_full_path = $save_to_dir."/".$saved_file_name;
    
    $data = file_get_contents($_FILES["file"]["tmp_name"]);
    $is_successful = file_put_contents($program_full_path, $data);
    
    if ($is_successful) {
        // compile user's program
        passthru("javac ".$program_full_path, $return_value);
        
        if ($return_value === 0) {
            // get number of test cases
            $change_to_input_dir = "cd ".$practice_dir."/testdata/input; ";
            $get_num_cmd = "numfiles=(*); numfiles=\${#numfiles[@]}; echo \$numfiles; ";
            $num_of_tests = exec($change_to_input_dir.$get_num_cmd);
                
            // check if submitted java file passes all the test cases
            $input_dir = "../testdata/input/";
            $out_dir = "../testdata/output/";
            $set_limit_cmd = "ulimit -v 64000; ulimit -t 4; ";
            
            for ($test_index=1; $test_index<=$num_of_tests; $test_index++) {
                $input_file = "in".$test_index.".in";
                $output_file = "out".$test_index.".out";
                $tmp_out_file = "tmpout".$test_index.".out";
                $exec_cmd = "java ".$program_name." < ".$input_dir.$input_file." > ".$tmp_out_file."; ";
                passthru($change_to_tmp_dir.$set_limit_cmd.$exec_cmd, $return_value);

                if ($return_value === 0) {
                    $compare_cmd = "diff -b ".$tmp_out_file." ".$out_dir.$output_file;
                    exec($change_to_tmp_dir.$compare_cmd, $outcome);
                    
                    if (count($outcome) != 0) {
                        print_jsonp_callback("{\"status\":\"fail\",\"message\":\"incorrect result\"}");
                        cleanup($change_to_tmp_dir);
                        exit;
                    }
                } else {
                    print_jsonp_callback("{\"status\":\"fail\",\"message\":\"run time error\"}");
                    cleanup($change_to_tmp_dir);
                    exit;
                }
            }
            
            // pass all the test cases
            print_jsonp_callback("{\"status\":\"ok\",\"message\":\"successfully pass all test cases\"}");
        } else {
            print_jsonp_callback("{\"status\":\"fail\",\"message\":\"compilation error\"}");
        }
        
        cleanup($change_to_tmp_dir);
    } else {
        print_jsonp_callback("{\"status\":\"fail\",\"message\":\"fail to save input file\"}");
    }
} else {
    print_jsonp_callback("{\"status\":\"fail\",\"message\":\"file not exist\"}");
}

?>