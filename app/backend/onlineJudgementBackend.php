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
            $change_dir_cmd = "cd /".$save_to_dir;
            
            $input_dir = "../testdata/input/";
            $sample_out_dir = "../testdata/output/";
            $exec_cmd = "java ".$program_name." < ".$input_dir."sum_integers1.in"." > "."tmp.out";
            $process = new ShellProcess($change_dir_cmd."; ".$exec_cmd);
            error_log($process->getPid());
            
            print_jsonp_callback("{\"status\":\"ok\"}");
        } else {
            print_jsonp_callback("{\"status\":\"fail\",\"message\":\"compilation error\"}");
        }
        
        // clean up
        //$process = new ShellProcess("rm -rf -- ".$save_to_dir);
        //$process = new ShellProcess("mkdir ".$save_to_dir);
    } else {
        print_jsonp_callback("{\"status\":\"fail\",\"message\":\"fail to save input file\"}");
    }
} else {
    print_jsonp_callback("{\"status\":\"fail\",\"message\":\"file not exist\"}");
}

?>