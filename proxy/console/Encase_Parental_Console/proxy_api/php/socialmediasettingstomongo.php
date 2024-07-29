<?php
include('../../variable_settings/vars.php');
echo 'sss'.$host_var;
$data = file_get_contents('php://input');

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_PORT => "18082",
  CURLOPT_URL => $host_var.":18082/dal/SaveSettings",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "$data",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Postman-Token: 4999c93a-719a-4acf-b6a6-afbdc9b4c5c3",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

?>
