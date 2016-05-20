<?php

require_once 'printFormat.php';
// setup the autoloading
require_once '../../vendor/autoload.php';
// setup Propel
require_once '../../generated-conf/config.php';

/*
    backend for connectDBService, and support function to:
    1. register a new user
    2. check if a user is registered
*/

$requestCommand = $_REQUEST["command"];
$requestObject = json_decode($_REQUEST["object"], true);

if ($requestObject) {
	if ($requestCommand) {
		switch ($requestCommand) {
		 	case "register":
		 		$name = $requestObject["user_name"];
		 		$email = $requestObject["user_email"];
                $pwd = $requestObject["user_password"];
                
                $q = new UsersQuery();
                $tempUser = $q->findPK($email);
                if ($tempUser) {
                    // duplicate primary key
                    echo print_jsonp_callback("{\"status\":\"fail\",\"error\":\"Email has already been registered.\"}");
                } else {
                    $user = new Users();
                    $user->setName($name);
                    $user->setEmail($email);
                    $user->setPassword($pwd);
                    $status = $user->save();
                    if ($status) {
                       echo print_jsonp_callback("{\"status\":\"success\",\"message\":\"Insert into table successful.\"}");
                    } else {
                        echo print_jsonp_callback("{\"status\":\"fail\",\"error\":\"Insert into table failed: {$q->errorCode()}\"}");
                    }
                }
		 		break;
                
            case "login":
		 		$email = $requestObject["user_email"];
                $pwd = $requestObject["user_password"];
                error_log("should be printed 1");
                $q = new UsersQuery();
                error_log("should be printed 2");
                $tempUser = $q->findPK($email);
                error_log("should be printed 3");
                if ($tempUser) {
                    // user exists, check pwd
                    if ($tempUser->getPassword() === $pwd) {
                        echo print_jsonp_callback("{\"status\":\"success\",\"message\":\"User information correct.\"}");
                    } else {
                        // wrong password
                        echo print_jsonp_callback("{\"status\":\"fail\",\"error\":\"Email or password is invalid.\"}");
                    }
                } else {
                    // user does not exist
                    echo print_jsonp_callback("{\"status\":\"fail\",\"error\":\"Email or password is invalid.\"}");
                }
                error_log("should be printed 4");
                break;
		 	
		 	default:
		 		# code...
		 		break;
		 }
	} else {
	    echo print_jsonp_callback("{\"status\":\"fail\",\"error\":\"No Command Specified\"}");
	}
} else {
    echo print_jsonp_callback("{\"status\":\"fail\",\"error\":\"No Object Specified\"}");
}

?>