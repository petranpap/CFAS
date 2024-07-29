<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$fb_url = $_POST['fb_url'];
$facename= $_POST['facename'];


if(!file_exists($fb_url.".json")){

$myfile = fopen($fb_url.".json", "w");
fwrite($myfile,'{"facename":"'.$facename.'","fb_url":"'.$fb_url.'"}');
fclose($myfile);

}else{


//read and decode the file
$myfile = fopen($fb_url.".json", "r");
// Loading existing data:
$json = file_get_contents($fb_url.".json");
$data = json_decode($json, true);
echo $data['fb_url'];

//SET ID FROM THE POST JSON
//$current['facename']=$postarray[$uid];
}
