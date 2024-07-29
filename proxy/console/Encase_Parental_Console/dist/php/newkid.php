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

 		$child_first_name = $_POST['child_first_name'];
		$child_last_name = $_POST['child_last_name'];
		$child_email = $_POST['child_email'];
		$child_fb_url = $_POST['child_fb_url'];
                $child_fb_url = str_replace("/","-",$child_fb_url);
                $child_twitter = $_POST['child_twitter'];
                $child_twitter = str_replace("https://twitter.com/","",$child_twitter);
		$parent_id = $_POST['parent_id'];


 // $conn = new mysqli($host, $username, $password, $dbname);
 $sql_child_new = "INSERT INTO `childs` (`parent_id`, `child_first_name`, `child_last_name`, `child_email`, `child_fb_url` , `child_twitter`) VALUES ('$parent_id', '$child_first_name', '$child_last_name', '$child_email', '$child_fb_url', '$child_twitter');";
	echo $sql_child_new;
	$result_sql_child_new= $conn->query($sql_child_new);
	// print_r($result_sql_child_new);

	header("Location: /home.php");
	echo "strte  ". $child_first_name;

 ?>
