<?php 
header("content-type: text/html;charset=utf-8");
 require 'dbsettings.php';
 /* Create connection */
$conn = new mysqli($host, $username, $password, $dbname);

/* Check connection  */
if ($conn->connect_error) {

     die("Connection to database failed: " . $conn->connect_error);
}
mysqli_set_charset($conn, "utf8");

/* SQL query to get results from database */
// SELECT parent_first_name,parent_last_name,parent_email,child_first_name,child_last_name,child_email,fb_msg_text,fb_sender_name FROM parent INNER JOIN childs INNER JOIN fb_msg ON childs.child_id=fb_msg.child_id
$child_id = $_GET['childid'];
$sql = "SELECT parent_first_name,parent_last_name,parent_email,child_first_name,child_last_name,child_email,	fb_wall_text 
		FROM parent  
		INNER JOIN childs  INNER JOIN fb_wall ON childs.child_id=fb_wall.child_id WHERE childs.child_id=".$child_id;
//echo $sql;
$result = $conn->query($sql);

/* If there are results from database push to result array */

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {

        array_push($result_array, $row);

    }

}

/* send a JSON encded array to client */

echo json_encode($result_array);


$conn->close();

?>

