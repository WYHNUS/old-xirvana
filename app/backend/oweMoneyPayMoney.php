<?php

require_once 'printFormat.php';
// setup the autoloading
require_once '../../vendor/autoload.php';
// setup Propel
require_once '../../generated-conf/config.php';

$request_object = json_decode($_REQUEST["object"], true);
if ($request_object) {
    $transaction_name = $request_object["name"];
    $creditor_email = $request_object["creditor"];
    $debtors = $request_object["debtors"];
    
    // check if creditor and debtors are in DB
    $q = new UsersQuery();
    $tempUser = $q->findPK($email);
    if ($creditor_email) {
        for ($i=0; $i<$debtors.length(); $i++) {
            $q = new UsersQuery();
            $tempUser = $q->findPK($debtors["email"]);
            if (!$tempUser) {
                echo print_jsonp_callback("{\"status\":\"fail\",\"error\":\"Debtor is not registered!\"}");
                exit();
            }
        }
        echo print_jsonp_callback("{\"status\":\"success\",\"message\":\"test\"}");
    } else {
        echo print_jsonp_callback("{\"status\":\"fail\",\"error\":\"Creditor is not registered!\"}");
    }
} else {
    echo print_jsonp_callback("{\"status\":\"fail\",\"error\":\"No Object Specified\"}");
}

?>