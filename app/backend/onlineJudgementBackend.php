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
            // check if submitted java file passes all the test cases
            $change_dir_cmd = "cd ".$save_to_dir;
            $set_limit_cmd = "ulimit -v 4000; ulimit -t 2; ";
            
            $input_dir = "../testdata/input/";
            $sample_out_dir = "../testdata/output/";
            $exec_cmd = "java ".$program_name." < ".$input_dir."sum_integers1.in"." > "."tmp.out";
            passthru($change_dir_cmd."; ".$set_limit_cmd.$exec_cmd, $return_value);
            
            if ($return_value === 0) {
                print_jsonp_callback("{\"status\":\"ok\"}");
            } else {
                print_jsonp_callback("{\"status\":\"fail\",\"message\":\"run time error\"}");
            }
        } else {
            print_jsonp_callback("{\"status\":\"fail\",\"message\":\"compilation error\"}");
        }
        
        // clean up
        passthru($change_dir_cmd."; "."rm *.*", $return_value);
        if ($return_value != 0) {
            error_log("clean up failed");
        }
    } else {
        print_jsonp_callback("{\"status\":\"fail\",\"message\":\"fail to save input file\"}");
    }
} else {
    print_jsonp_callback("{\"status\":\"fail\",\"message\":\"file not exist\"}");
}

?>