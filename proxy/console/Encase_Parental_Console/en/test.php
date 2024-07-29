<?php

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://proxyencase.cut.ac.cy:8090/api/public/quiz/get_grade/https:--www.facebook.com-peter.encase",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_SSL_VERIFYPEER =>false,
  CURLOPT_POSTFIELDS => "{\r\n  \"totalCores\": 36, \r\n}\r\n",
  CURLOPT_HTTPHEADER => [
    "User-Agent: Mozilla/5.0",
    "Accept: json",
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
//  echo $response;
$json = json_decode($response, true);

foreach ($json as $row) {
   echo '<tr>';
   echo '<td>'.$row["title"].'</td>'.'<td>'.$row["score"].'</td>';
   echo '</tr>';
}
}
