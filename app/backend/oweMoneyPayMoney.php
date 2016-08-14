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
        error_log("creditor found");
        foreach ($debtors as &$debtor) {
            $q = new UsersQuery();
            $tempUser = $q->findPK($debtor["email"]);
            if (!$tempUser) {
                echo print_jsonp_callback("{\"status\":\"fail\",\"error\":\"Debtor is not registered!\"}");
                exit();
            }
        }
        // all debtors exists, for each debtor, build a transaction
        foreach ($debtors as &$debtor) {
            $transaction = new Transaction();
            $transaction->setName($transaction_name);
            $transaction->setCreditor($creditor_email);
            $transaction->setDebtor($debtor["email"]);
            $transaction->setAmount($debtor["amount"]);
            $status = $transaction->save();
            if (!$status) {
                echo print_jsonp_callback("{\"status\":\"fail\",\"error\":\"Insert into transaction table failed: {$q->errorCode()}\"}");
                exit();
            }
        }
        // all transactions have been inserted, now update debt
        foreach ($debtors as &$debtor) {
            $q = new DebtQuery();
            $debt_acc = $q->findPK(array($creditor_email, $debtor["email"]));
            if ($debt_acc) {
                $debt_acc->setAmount($debt_acc->getAmount() + $debtor["amount"]);
                $status = $debt_acc->save();
                if (!$status) {
                    echo print_jsonp_callback("{\"status\":\"fail\",\"error\":\"Update Debt table failed: {$q->errorCode()}\"}");
                    exit();
                }
            } else {
                $q = new DebtQuery();
                $debt_acc = $q->findPK(array($debtor["email"], $creditor_email));
                if ($debt_acc) {
                    $debt_acc->setAmount($debt_acc->getAmount() - $debtor["amount"]);
                    $status = $debt_acc->save();
                    if (!$status) {
                        echo print_jsonp_callback("{\"status\":\"fail\",\"error\":\"Update Debt table failed: {$q->errorCode()}\"}");
                        exit();
                    }
                } else {
                    echo print_jsonp_callback("{\"status\":\"fail\",\"error\":\"Debt with {$creditor_email} and {$debtor["email"]} not found!\"}");   
                }
            }
        }
        // all debt table are updated
        echo print_jsonp_callback("{\"status\":\"success\",\"message\":\"Transaction added successful.\"}");
    } else {
        echo print_jsonp_callback("{\"status\":\"fail\",\"error\":\"Creditor is not registered!\"}");
    }
} else {
    echo print_jsonp_callback("{\"status\":\"fail\",\"error\":\"No Object Specified\"}");
}

?>