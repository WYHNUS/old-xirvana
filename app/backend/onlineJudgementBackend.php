<?php

require_once 'printFormat.php';

// check if upload success
if ($_FILES["file"]) {
    $save_to_dir = "../../assets/Practice/".$_REQUEST["practiceName"]."/tmp/";
    $saved_file_name = $_FILES["file"]["name"];
    $data = file_get_contents($_FILES["file"]["tmp_name"]);
    $is_successful = file_put_contents($save_to_dir.$saved_file_name, $data);
    error_log($is_successful);
    if ($is_successful) {
        print_jsonp_callback("{\"status\":\"ok\"}");
    } else {
        print_jsonp_callback("{\"status\":\"fail\",\"message\":\"fail to save input file\"}");
    }
} else {
    print_jsonp_callback("{\"status\":\"fail\",\"message\":\"file not exist\"}");
}

?>