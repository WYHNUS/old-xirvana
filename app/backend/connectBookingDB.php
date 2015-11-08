<?php
header('content-type: application/json; charset=utf-8');
define("JSON_PRETTY_PRINT", 128);

$config = parse_ini_file("../../assets/config/DBConfig.ini");
$servername = $config["db_servername"];
$username = $config["db_username"];
$password = $config["db_password"];
$dbname = $config["db_name"];

$requestCommand = $_REQUEST["command"];
$requestObject = json_decode($_REQUEST["object"], true);

function print_jsonp_callback($result) {
   global $jsonp_callback;
   if(!is_string($result)) {
	$result = json_encode($result, JSON_PRETTY_PRINT);
   }
   print $jsonp_callback ? "$jsonp_callback($result)" : $result;
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo print_jsonp_callback("{\"status\":\"fail\",\"error\":\"Error Connecting Booking DB : {$e->getMessage()}\"}");
}

if ($requestObject) {
	if ($requestCommand) {
		switch ($requestCommand) {
		 	case "insert":
		 		$name = $requestObject["name"];
		 		$email = $requestObject["email"];
		 		$sql = "INSERT INTO Users (name,email) VALUES (:name,:email)";
		 		$q = $conn->prepare($sql);
		 		$value = $q->execute(array(":name" => $name, ":email" => $email));
		 		if ($value) {
				    echo print_jsonp_callback("{\"status\":\"success\",\"message\":\"Insert into table successful\"}");
		 		} else {
	    			echo print_jsonp_callback("{\"status\":\"fail\",\"error\":\"Insert into table failed: {$q->errorCode()}\"}");
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