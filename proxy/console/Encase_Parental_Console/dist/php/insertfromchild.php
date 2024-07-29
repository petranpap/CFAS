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
$fb_msg_text=$_POST['fb_msg'];
// echo $fb_msg_text;

$fb_sender_name=$_POST['fb_sender_name'];
$fb_url=$_POST['fb_url'];
echo $fb_sender_name;
$sql_get_child_id="SELECT child_id from childs where child_fb_url ='$fb_url'";
$get_child_id = $conn->query($sql_get_child_id);
$sql_get_parent_id="SELECT parent_id from childs where child_fb_url ='$fb_url'";
$get_parent_id = $conn->query($sql_get_parent_id);
// echo $get_child_id[0].' '.$get_parent_id[0];
// print_r($get_parent_id);
while($row = $get_child_id->fetch_assoc()) {
$child_id = $row["child_id"];
// echo $child_id;
}
while($row = $get_parent_id->fetch_assoc()) {
$parent_id = $row["parent_id"];
// echo $parent_id;
}
$sql_read="SELECT * from fb_msg WHERE child_id='$child_id'";
$result_read = $conn->query($sql_read);
// print_r($result_read);
if ($result_read->num_rows == 0){

$sql="INSERT INTO fb_msg (fb_msg_text, fb_sender_name,parent_id,child_id) VALUES ('$fb_msg_text', '$fb_sender_name','$parent_id','$child_id')";
$result = $conn->query($sql);
// echo "PAOK";


}else{

$sql = "UPDATE fb_msg SET fb_msg_text='$fb_msg_text' WHERE parent_id='$parent_id' AND child_id='$child_id' AND fb_sender_name='$fb_sender_name'";
$result = $conn->query($sql);

// echo "PAOK UPdATE";
}

?>