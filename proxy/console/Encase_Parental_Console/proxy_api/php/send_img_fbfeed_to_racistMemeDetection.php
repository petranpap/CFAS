<?php

include 'vars.php';

//Get The post Items and store them in variables
$fb_url = $_POST['fb_url'];
$img_src = $_POST['img_src'];

if (isset($_SERVER["HTTP_ORIGIN"]) === true)
{
    $origin = $_SERVER["HTTP_ORIGIN"];
    $allowed_origins = array(
        "http://www.facebook.com",
        "https://www.facebook.com"
    );
    if (in_array($origin, $allowed_origins, true) === true)
    {
        header('Access-Control-Allow-Origin: ' . $origin);
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Content-Type');
    }
    if ($_SERVER["REQUEST_METHOD"] === "OPTIONS")
    {
        exit; // OPTIONS request wants only the policy, we can stop here
        
    }
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Create the Directory
if (!file_exists('/var/www/html/console/Encase_Parental_Console/facebook_feed/' . $fb_url . '/'))
{
    mkdir('/var/www/html/console/Encase_Parental_Console/facebook_feed/' . $fb_url . '/', 0777, true);
}
// Create the image with Random number
$child_loc_img = '/var/www/html/console/Encase_Parental_Console/facebook_feed/' . $fb_url . '/';
$img_totest = $child_loc_img . rand() . 'facebook_feed_testing.jpg';


//Execute the Curl to get the image and store it, in the above image we just created
exec("curl -X GET -v '$img_src' --output $img_totest");

//Send Image path to Racist Classifier (Savvas Zannetou)
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_PORT => "8687",
    CURLOPT_URL => "http://127.0.0.1:8687/racist?path=" . $img_totest,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "",
    CURLOPT_HTTPHEADER => array(
        "Postman-Token: d2e474e4-8f28-42e1-9c6b-2499afdce783",
        "cache-control: no-cache"
    ) ,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err)
{
//    echo "cURL Error #:" . $err;
}
else
{
    //Get the response
    echo $response;

}


