<?php 
//
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
//


//Bypass SSL errors
$dargs=array("ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false),"http"=>array('timeout' => 60, 'user_agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.9) Gecko/20071025 Firefox/3.0.0.1'));
//

//Get the Image and the child_url from the child's facebook Feed
$fb_url = $_POST['fb_url'];
$img_src=$_POST['img_src'];
//echo $fb_url;
//echo $img_src;

$directory = "/var/www/html/uploads/" . $fb_url . "/";

if (!file_exists($directory)) {
    mkdir($directory, 0777, true);
}

//Get The name of the image from proxy in order to be the same
$img_name_from_proxy = substr($img_src, strrpos($img_src, '/') + 1);
//echo $img_name_from_proxy;

//Move image to folder

$image_from_proxy = file_get_contents($img_src, false, stream_context_create($dargs));

//echo "\n".$image_from_proxy;

$final = file_put_contents($directory.$img_name_from_proxy,$image_from_proxy);
//print_r($test);
//echo $img_name_from_proxy;
exec('curl -X POST "http://127.0.0.1:5000/apiSteganographyWatermarking/unhideData" -H "accept: image/png" -H "Content-Type: multipart/form-data" -F "key=encase2020" -F "image=@' . $directory.$img_name_from_proxy . ';type=image/jpeg" -o' . $directory. 'unlocked.png');

echo 'https://backendencase.cut.ac.cy:85/uploads/image.php?fb_url='.$fb_url.'&img='.$img_name_from_proxy;

?>
