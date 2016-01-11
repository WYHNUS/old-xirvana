<?php

header('content-type: application/json; charset=utf-8');
define("JSON_PRETTY_PRINT", 128);

function print_jsonp_callback($result) {
   global $jsonp_callback;
   if(!is_string($result)) {
	$result = json_encode($result, JSON_PRETTY_PRINT);
   }
   print $jsonp_callback ? "$jsonp_callback($result)" : $result;
}

?>