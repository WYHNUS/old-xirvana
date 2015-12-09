<?php
header('content-type: application/json; charset=utf-8');
define("JSON_PRETTY_PRINT", 128);

// setup the autoloading
require_once '../../vendor/autoload.php';
// setup Propel
require_once '../../generated-conf/config.php';

$requestCommand = $_REQUEST["command"];
$requestObject = json_decode($_REQUEST["object"], true);

function print_jsonp_callback($result) {
   global $jsonp_callback;
   if(!is_string($result)) {
	$result = json_encode($result, JSON_PRETTY_PRINT);
   }
   print $jsonp_callback ? "$jsonp_callback($result)" : $result;
}

if ($requestObject) {
	if ($requestCommand) {
		switch ($requestCommand) {
		 	case "insert":
		 		$name = $requestObject["name"];
		 		$email = $requestObject["email"];
                
                $q = new UsersQuery();
                $tempUser = $q->findPK($email);
                if ($tempUser) {
                    // duplicate primary key
                    echo print_jsonp_callback("{\"status\":\"fail\",\"error\":\"Email has already been registered.\"}");
                } else {
                    $user = new Users();
                    $user->setName($name);
                    $user->setEmail($email);
                    $status = $user->save();
                    if ($status) {
                       echo print_jsonp_callback("{\"status\":\"success\",\"message\":\"Insert into table successful\"}");
                    } else {
                        echo print_jsonp_callback("{\"status\":\"fail\",\"error\":\"Insert into table failed: {$q->errorCode()}\"}");
                    }
                }
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