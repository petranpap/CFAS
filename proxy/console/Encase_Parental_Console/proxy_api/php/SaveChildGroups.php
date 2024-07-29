<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$json= $_POST['json'];
$curl = curl_init();
echo $json;
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://35.205.106.185:18082/dal/SaveChildGroups",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $json,
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/javascript"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;


?>
