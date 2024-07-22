<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://backendencase.cut.ac.cy:18085/0/dal/SaveChildGroups',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"fb_url":"https:--www.facebook.com-peter.encase","family":["https://www.facebook.com/profile.php?id=100009250326366","123123"],"school":["https://www.facebook.com/profile.php?id=100009250326366","https://www.facebook.com/profile.php?id=100009250326366"],"friends":["https://www.facebook.com/profile.php?id=100031062618572","https://www.facebook.com/profile.php?id=100031062618572"],"age":["https://www.facebook.com/profile.php?id=100031062618572","https://www.facebook.com/profile.php?id=100031062618572"]}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

