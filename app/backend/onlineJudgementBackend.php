<?php

require_once 'printFormat.php';
require_once 'shellProcess.php';

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
            $change_to_tmp_dir = "cd ".$save_to_dir."; ";
            $input_dir = "../testdata/input/";
            $out_dir = "../testdata/output/";
            $set_limit_cmd = "ulimit -v 4000; ulimit -t 2; ";
            
            for ($test_index=1; $test_index<=$num_of_tests; $test_index++) {
                $input_file = "in".$test_index.".in";
                $output_file = "out".$test_index.".out";
                $tmp_out_file = "tmpout".$test_index.".out";
                $exec_cmd = "java ".$program_name." < ".$input_dir.$input_file." > ".$tmp_out_file."; ";
                passthru($change_to_tmp_dir.$set_limit_cmd.$exec_cmd, $return_value);

                if ($return_value === 0) {
                    $compare_cmd = "diff -b ".$tmp_out_file." ".$out_dir.$output_file;
                    $result = exec($compare_cmd, $outcome);
                    error_log($compare_cmd);
                    error_log($result);
                    error_log(count($outcome));
//                    if () {
//                        print_jsonp_callback("{\"status\":\"fail\",\"message\":\"incorrect result\"}");
//                        exit();
//                    }
                } else {
                    print_jsonp_callback("{\"status\":\"fail\",\"message\":\"run time error\"}");
                    exit();
                }
            }
            
            // pass all the test cases
            print_jsonp_callback("{\"status\":\"ok\"}");
        } else {
            print_jsonp_callback("{\"status\":\"fail\",\"message\":\"compilation error\"}");
        }
        
        // clean up
//        passthru($change_to_tmp_dir."rm *.*", $return_value);
//        if ($return_value != 0) {
//            error_log("clean up failed");
//        }
    } else {
        print_jsonp_callback("{\"status\":\"fail\",\"message\":\"fail to save input file\"}");
    }
} else {
    print_jsonp_callback("{\"status\":\"fail\",\"message\":\"file not exist\"}");
}

?>