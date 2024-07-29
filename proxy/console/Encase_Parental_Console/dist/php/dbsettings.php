<?php


$host         = "localhost";
$username     = "the_encase_user";

$password     = "SEou!gR[p$=YLqrI4Q9$";

$dbname       = "encase";
$result_array = array();

/* Create connection */
$conn = new mysqli($host, $username, $password, $dbname);

/* Check connection  */
if ($conn->connect_error) {

     die("Connection to database failed: " . $conn->connect_error);

}
?>
