<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$directory = '/var/www/html/uploads/https:--www.facebook.com-peter.encase/';
$img_name_from_proxy = 'download.jpg_locked.png_watermarked.png';
exec('curl -X POST "http://127.0.0.1:5000/apiSteganographyWatermarking/unhideData" -H "accept: image/png" -H "Content-Type: multipart/form-data" -F "key=encase2020" -F "image=@' . $directory.$img_name_from_proxy . ';type=image/jpeg" -o' . $directory. 'unlocked.png');

?>
