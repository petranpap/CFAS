<?php
include('../../../../variable_settings/vars.php');
$json_sexual = file_get_contents($host_ssl.'/dal/ObtainData/chat/sexualread/1', false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
$json_cyber = file_get_contents($host_ssl.'/dal/ObtainData/chat/cyberread/1',false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
$json_twitter = file_get_contents($host_ssl.'/dal/ObtainData/twitter/1',false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));

?>
<!DOCTYPE html>

<html>
<head>
<title>Ειδοποιήσεις</title>
<link rel="stylesheet" href="notifications.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
<script src='https://code.jquery.com/jquery-3.3.1.min.js' integrity='sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=' crossorigin='anonymous'></script>


<!--peter-->

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/notifications.css">




</head>


<style>
body {
background: white;}

.center {
  margin: auto;
  width: 80%;
  border: 1px solid #51deb6;
  padding: 10px;
}
.circular {
    background: #51deb6;
    color: black;
    border-radius: 30%;
    padding: 5%;
    max-width: 100%;
}
.notification_title {
	color: black;
	width:100%;
	background: #51deb6;
	text-align: center;
	padding:5%;

}
</style>
<body>

<div id="viewport">
  <!-- Sidebar -->
  <div id="sidebar">
    <header>
      <a href="#">Ειδοποιήσεις</a>
    </header>
    <ul class="nav" style="width:100%;" >
      <li style="width:100%; padding:10%; margin:5%;">
        <a href="#facebook"
          class="fa fa-facebook">
        Facebook</a>
      </li>
      <li style="width:100%; padding:10%; margin:5%;">
        <a href="#twitter" 
          class="fa fa-twitter">
        Twitter</a>
      </li>

    </ul>
  </div>
  <!-- Content -->
  <div id="content">
    <div class="container-fluid">     
	<div style=" height:150px; margin-bottom:10%;" class="center">
		
		<div style="float:left; width:25%;">
			<img src="../../avatars/selectedavatar/avatar.png" alt="ENCASE" style="
		    		height: 100px;
 		    		border: 1px solid #51deb6;
    		    		border-radius: 50%;">
		</div>
		
		<div id="avatar_text" style="width: 75%; float: left;">
			<h5>Γεια σου! Σε αυτήν την σελίδα μπορείς να δεις όλες τις ειδοποιήσεις!</h5>
			<p>Από το αριστερό μενού, μπορείτε να επιλέξετε για ποιο διαδικτυακό κοινωνικό δίκτυο (Facebook ή Twitter) θέλετε να δείτε τις ειδοποιήσεις!</p>
		</div>
	</div>
		


<!--     Notification list container/box -->
    <div class="notification-list-box center">
      <div class="custom-scrollBar">
        

	<div id="facebook" class="list-group">
          <div class="notification_title"><h5>Ειδοποιήσεις Facebook</h5></div>
	  <button class="bt1" id="toggle-collapse-fb">Eμφάνιση περισσότερων πληροφοριών</button>	  
        </div>
        
	<div id="twitter" class="list-group">
	<div class="notification_title"><h5>Ειδοποιήσεις Twitter</h5></div>
	<button class="bt2" id="toggle-collapse-tw">Eμφάνιση περισσότερων πληροφοριών</button>
        </div>
       </div>
    </div>


    </div>
  </div>
</div>

<script src="../js/popper.min.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/vars.js"></script>
<script> var json_sexual = <?php echo $json_sexual ?>;</script>
<script> var json_cyber = <?php echo $json_cyber ?>;</script>
<script> var json_twitter = <?php echo $json_twitter ?>;</script>
<script src="../js/notifications1.js"></script>
<script src="../js/showfb.js"></script>
<script src="../js/showtw.js"></script>

</body>
