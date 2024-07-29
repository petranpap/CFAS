<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require 'dbsettings.php';
/* Create connection */
$conn = new mysqli($host, $username, $password, $dbname);
/* Check connection  */
if ($conn->connect_error) {
die("Connection to database failed: " . $conn->connect_error);
}
// Here We Get the Id of the Parent and the Child
$child_id = $_POST['child_id'];
$parent_id = $_POST['parent_id'];
$option_type = $_POST['option_type'];
// Now we get the values  we want for the Parental Visibility Options
$visibility_level_parental =$_POST['visibility_level_parental'];
$parentalValues = $_POST['parentalValues'];
$parentalValues = implode(" ",$parentalValues);
// Now we get the values  we want for the Backend Visibility Options
$visibility_level_backend =$_POST['visibility_level_backend'];
$backendValues = $_POST['backendValues'];
$backendValues = implode(" ",$backendValues);
$anonymously = $_POST['anonymously'];
// Now we get the values  we want for the Security Visibility Options
$visibility_level_security =$_POST['visibility_level_security'];
$securityValues = $_POST['securityValues'];
$securityValues = implode(" ",$securityValues);
// We Select from the DB to see if the options are there so to update the row of the table or to insert a new one
$sql_select_parental="SELECT * from parental_visibility where parent_id='$parent_id' and child_id='$child_id'";
$sql_select_backend="SELECT * from backend_visibility where parent_id='$parent_id' and child_id='$child_id'";
$sql_select_security="SELECT * from security_visibility where parent_id='$parent_id' and child_id='$child_id'";
$result_select_parental = $conn->query($sql_select_parental);
// print_r($result_select_parental);
// json_encode($result_select_parental);
$result_select_backend = $conn->query($sql_select_backend);
// json_encode($result_select_backend);
// print_r($result_select_backend);
$result_select_security = $conn->query($sql_select_security);
// json_encode($result_select_security);
// print_r($result_select_security);
switch ($option_type) {
	case "parental":
if ($result_select_parental->num_rows > 0) {
	$sql_parental="UPDATE parental_visibility SET parental_visibility_level='$visibility_level_parental', checkbox='$parentalValues',child_aproved=0 where child_id='$child_id' and parent_id='$parent_id'";
	// echo $sql_parental;
	
}else{
	$sql_parental = "INSERT INTO `parental_visibility` ( `child_id`, `parent_id`, `parental_visibility_level`, `checkbox`) VALUES('$child_id', '$parent_id', '$visibility_level_parental', '$parentalValues')";
		// echo $sql_parental;
	}
	$result_parental = $conn->query($sql_parental);
break;
case "backend":
if ($result_select_backend->num_rows > 0) {
	$sql_backend="UPDATE backend_visibility SET backend_visibility_level='$visibility_level_backend', checkbox='$backendValues',anonymously='$anonymously',child_aproved=0 where child_id='$child_id' and parent_id='$parent_id'";
	// echo $sql_backend;
}else{
	$sql_backend = "INSERT INTO `backend_visibility` ( `child_id`, `parent_id`, `backend_visibility_level`, `checkbox`,`anonymously`) VALUES('$child_id', '$parent_id', '$visibility_level_backend', '$backendValues','$anonymously')";
// echo $sql_backend;
	}
	$result_backend = $conn->query($sql_backend);
break;

case "security":
if ($result_select_security->num_rows > 0) {
	$sql_security="UPDATE security_visibility SET security_visibility_level='$visibility_level_security', checkbox='$securityValues', child_aproved = 0 where child_id='$child_id' and parent_id='$parent_id'";
}else{
	$sql_security = "INSERT INTO `security_visibility` ( `child_id`, `parent_id`, `security_visibility_level`, `checkbox`) VALUES('$child_id', '$parent_id', '$visibility_level_security', '$securityValues')";
// echo $sql;}
	
	}


	
	$result_security = $conn->query($sql_security);
break;

default:
echo "";
}


?>
