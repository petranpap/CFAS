<?php
header ("Access-Control-Allow-Origin: https://www.facebook.com");
header ("Access-Control-Expose-Headers: Content-Length, X-JSON");
header ("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: *");


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$fb_body= $_POST['fb_body'];
echo $fb_body;

$obj = json_decode($fb_body,true);
//echo $obj->html;
