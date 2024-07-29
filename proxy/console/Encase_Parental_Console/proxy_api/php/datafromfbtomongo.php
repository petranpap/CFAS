<?php
include('../../variable_settings/vars.php');
//header ("Access-Control-Allow-Origin: https://www.facebook.com");
//header ("Access-Control-Expose-Headers: Content-Length, X-JSON");
//header ("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
//header ("Access-Control-Allow-Headers: *");
//header ("Access-Control-Allow-Credentials : true");
//header('content-type: application/json; charset=utf-8');
//header("access-control-allow-origin: *");

  // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

    //echo "You have CORS!";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$case_id= $_POST['case_id'];
//echo $case_id;
$type = $_POST['type'];
//echo $type;
$from_date= $_POST['from_date'];
//echo $from_date;
$to_date =$_POST['to_date'];
//echo $to_date;
$date_created= $_POST['date_created'];
//echo $date_created;
$text_chat =$_POST['text_chat'];
//echo $text_chat;
$fb_url= $_POST['fb_url'];
echo $fb_url;
$fb_sender_name =$_POST['fb_sender_name'];
//echo $fb_sender_name;
//echo $host_ssl;
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://encase-proxy.socialcomputing.eu:18082/dal/SaveChat",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"case_id\":\"$case_id\",\"type\":\"$type\",\"from_date\":\r\n\"$from_date\",\"to_date\": \"$to_date\",\"text_chat\":\"$text_chat\",\"date_created\":\"$date_created\",\"fb_url\":\"$fb_url\",\"fb_sender_name\":\"$fb_sender_name\"}\r\n",
 CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo "123 ".$response;

