<?php
include '../../../variable_settings/vars.php';
$host= $host_var;

$fb_url = $_GET['fb_url'];
echo $fb_url;
echo "<br>";
echo str_replace("https:--www.facebook.com-","",$fb_url);
echo "<br>";

//FaceRecogniser API
function FaceRecogniser()
{
global $host;    
 $facerecognizer = exec('curl -X POST -F "file=@/var/www/html/console/Encase_Parental_Console/uploads/testing/testing.jpg" http://localhost:8080/', $facerecognizer_output);
 $facerecognizer = json_decode($facerecognizer_output[0], true);
 return $facerecognizer[faces][0][id];

    
}
//END FaceRecogniser API

echo FaceRecogniser();
if (FaceRecogniser() === str_replace("https:--www.facebook.com-","",$fb_url)){
echo "ss";

}
