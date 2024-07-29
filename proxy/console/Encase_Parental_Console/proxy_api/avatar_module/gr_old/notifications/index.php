<?php
include('../../../../variable_settings/vars.php');
$json_sexual = file_get_contents($host_ssl.'/dal/ObtainData/chat/sexualread/1', false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
$json_cyber = file_get_contents($host_ssl.'/dal/ObtainData/chat/cyberread/1',false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
$json_twitter = file_get_contents($host_ssl.'/dal/ObtainData/twitter/1',false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));

?>
 <!DOCTYPE html>
<html>
<head>
<title>Notifications</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../css/notifications.css">
<style>
.circular {
  position: fixed;
/*  font-family: arial;
  font-size: 1.1em;*/
  background: blue;
  color: #fff;
  border-radius: 50%;
  padding: 55px 32px;
  max-width: 300px;
}
.circular1 {
  background: blue;
  width: 20px;
  padding: 20px;
  border-radius: 50%;
  position: absolute;
  bottom: -10px;
}

</style>
</head>
<body>


<div class="row">
<div class="leftcolumn">
  <div class="card" > </div>
  <div id="twitter"  style="margin-bottom: 20px;">
   
 
</div>
  <div class="card" ></div>

<div id="facebook" style="border-top: 2px solid red;">
   
 
</div>
</div>
<div class="rightcolumn">
<div class="circular">
<div id="avatar_txt"style="
    padding: 5%;
    text-align: center;
">
Γεια σου! Σε αυτήν την σελίδα μπορείς να δεις όλες τις ειδοποιήσεις! <br>
<button id="scrolltwitter" type="button" class="btn btn-info"style="
    width: 200px;
    margin-bottom: 1em;
">Ειδοποιήσεις Twitter</button>

<button id="scrollfacebook" type="button" class="btn btn-success"style="
    width: 200px;
    
">Ειδοποιήσεις Facebook</button>

</div>
<div class="circular1"></div>
<div class="circular2"></div>
</div><img src="../../avatars/selectedavatar/avatar.png" alt="ENCASE" style="
    display: block;
    margin-left: auto;
    margin-right: auto;
    height: 100px;
    border-radius: 50%;
    position: fixed;
    margin-right: 180px;
    top: 325px;
">
</div>

</div>

<div class="footer">

</div>

</body>
   <script src="../js/popper.min.js"></script>
     <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
     <script src="../js/vars.js"></script>
<script> var json_sexual = <?php echo $json_sexual ?>;</script>
<script> var json_cyber = <?php echo $json_cyber ?>;</script>
<script> var json_twitter = <?php echo $json_twitter ?>;</script>

<script src="../js/notifications.js"></script>
<script>
$("#scrolltwitter").click(function() {
    $('html, body').animate({
        scrollTop: $("#twitter").offset().top
    }, 2000);
});
$("#scrollfacebook").click(function() {
    $('html, body').animate({
        scrollTop: $("#facebook").offset().top
    }, 2000);
});

</script>
</html>

