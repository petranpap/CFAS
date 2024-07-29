<?php
$txt= $_GET['text'];
$myfile = fopen("newfile.txt", "a") or die("Unable to open file!");
fwrite($myfile, $txt);
fwrite($myfile, "\n");
fclose($myfile);
?>
