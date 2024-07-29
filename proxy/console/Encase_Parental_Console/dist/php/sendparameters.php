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

          $sql = "select child_id,parent_id,child_first_name,child_last_name,child_email from childs";
          // echo $sql;

             $result = $conn->query($sql);
             $childs = array();
			 while ($row = $result->fetch_assoc()) {
			  $child = array(
			    "child_id" => $row['child_id'],
			    "parent_id"         => $row['parent_id'],
			    "child_first_name"          => $row['child_first_name'],
			    "child_last_name"       => $row['child_last_name'],
			    "child_email"       => $row['child_email']
			  );
			  $childs[] = $child;
			}

echo json_encode($childs);

 ?>