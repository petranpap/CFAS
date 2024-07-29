<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'dbsettings.php';
/* Create connection */
$conn = new mysqli($host, $username, $password, $dbname);
/* Check connection  */
if ($conn->connect_error) {
die("Connection to database failed: " . $conn->connect_error);
}

$parent_first_name = $_POST['parent_first_name'];
// echo "string  ".$parent_first_name;
$parent_last_name = $_POST['parent_last_name'];
$parent_user_name = $_POST['parent_user_name'];
$parent_email = $_POST['parent_email'];
$pass = $_POST['pass'];

$child_first_name = $_POST['child_first_name'];
$child_last_name = $_POST['child_last_name'];
$child_email = $_POST['child_email'];
$child_fb_url = $_POST['child_fb_url'];
$child_fb_url = str_replace("/","-",$child_fb_url);
$child_twitter = $_POST['child_twitter'];
$child_twitter = str_replace("https://twitter.com/","",$child_twitter);


$sql_select_parent="SELECT * from parent where parent.parent_user_name='$parent_user_name' and parent.pass='$pass' and parent.parent_email='$parent_email'";
echo $sql_select_parent;
$sql_select_child="SELECT * from childs where childs.child_first_name='$child_first_name' and childs.child_last_name='$child_last_name' and childs.child_email='$child_email'";
$result_select_parent = $conn->query($sql_select_parent);
$result_select_child = $conn->query($sql_select_child);


if ($result_select_parent->num_rows > 0) {
	print_r($result_select_parent);
	if ($result_select_child->num_rows > 0){
		echo "The Kid is already on db";
	}
	
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('The User is already on db');
    window.location.href='/index.php';
    </script>");
}else{

	$sql_parent = "INSERT INTO `parent` (`parent_first_name`, `parent_last_name`, `pass`, `parent_user_name`, `parent_email`) VALUES ('$parent_first_name', '$parent_last_name', '$pass', '$parent_user_name', '$parent_email');";
	// echo $sql_parent;
	$result_sql_parent= $conn->query($sql_parent);
	// print_r($result_sql_parent);
	$sql_parent_id = "SELECT parent.parent_id from parent ORDER BY parent.parent_id DESC LIMIT 1";
	$result_sql_parent_id = $conn->query($sql_parent_id );
	while($row = $result_sql_parent_id->fetch_assoc()) { 
		$parent_id=$row["parent_id"];
		
		$sql_child_insert="INSERT INTO `childs` (`parent_id`, `child_first_name`, `child_last_name`, `child_email`, `child_fb_url`, `child_twitter`) VALUES ('$parent_id', '$child_first_name', '$child_last_name', '$child_email', '$child_fb_url', '$child_twitter');";
		$result_sql_child_insert= $conn->query($sql_child_insert);
		// echo $row["parent_id"];
}
$sql_child_id="SELECT childs.child_id from childs ORDER BY childs.child_id DESC LIMIT 1";
$result_sql_child_id = $conn->query($sql_child_id);

	while($row = $result_sql_child_id->fetch_assoc()) { 
		$child_id=$row["child_id"];
		$sql_parental="INSERT INTO `parental_visibility` (`child_id`, `parent_id`, `parental_visibility_level`, `child_aproved`, `checkbox`) VALUES ('$child_id', '$parent_id', '1', '0', '');";
		$sql_backend="INSERT INTO `backend_visibility` (`child_id`, `parent_id`, `backend_visibility_level`, `child_aproved`, `checkbox`) VALUES ('$child_id', '$parent_id', '1', '0', '');";
		$sql_security="INSERT INTO `security_visibility` (`child_id`, `parent_id`, `security_visibility_level`, `child_aproved`, `checkbox`) VALUES ('$child_id', '$parent_id', '1', '0', '');";
		$result_sql_parental= $conn->query($sql_parental);	
		$result_sql_backend= $conn->query($sql_backend);	
		$result_sql_security= $conn->query($sql_security);
}
header("Location: /index.php");
}
