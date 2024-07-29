<?php
if ($_SERVER['SCRIPT_FILENAME'] == __FILE__) {
    // This block will be executed if the script is accessed directly

    // Send a 404 status code
    header("HTTP/1.0 404 Not Found");

    // Display an error message
//    echo "404 - Page not found";
    exit;
}

$host = 'localhost';
$db = 'encase';
$user = 'the_encase_user';
$pass = 'SEou!gR[p$=YLqrI4Q9$';

