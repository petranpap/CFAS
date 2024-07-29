<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('../variable_settings/vars.php');
session_start();
$url = $proxyencase.'/api/public/menu/child/'.$_SESSION["parent_id"];
          echo $url;
        $content = file_get_contents($url);
        $json = json_decode($content, true);
require '../dist/php/dbsettings.php';
/* Create connection */
$conn = new mysqli($host, $username, $password, $dbname);
/* Check connection  */
if ($conn->connect_error) {
die("Connection to database failed: " . $conn->connect_error);
}


if(!empty($_POST["login"])) {
    $password=hash('sha256', $_POST['password']);
  $url = $proxyencase.'/api/public/login/'.$_POST["user_name"].'/'.$password;
//          echo $url.'<br>';
//echo $_POST['password'].'<br>';
//echo $password;
        $content = file_get_contents($url, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
        $json = json_decode($content, true);
      print_r($json);
      echo 'ssss     ->'.$url;

  if($json) {
  echo "sssssssssssssss   sscdac we";
  $_SESSION["parent_id"] = $json["0"]['parent_id'];
  // echo $json["0"]['parent_id'];
  $_SESSION["parent_first_name"] = ucwords($json["0"]["parent_first_name"]);
  $_SESSION["parent_last_name"] = ucwords($json["0"]["parent_last_name"]);
  $_SESSION["child_id"] = $json["0"]['child_id'];
  $_SESSION["child_first_name"] = $json["0"]['child_first_name'];
  $_SESSION["child_fb_url"] = $json["0"]['child_fb_url'];
 $_SESSION["role"] = $json["0"]['role'];
  // echo $password;
$lang = $_POST['lang'];
  header("Location: $lang/home.php");
  } else {


  $message = "Invalid Username or Password!";

  }
}
if(!empty($_POST["logout"])) {
  $_SESSION["parent_id"] = "";
  session_destroy();
}
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cyber Safety Family Advice Suite | Parental Console</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/style.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style>
/* Style the buttons */
.btn {
  border: none;
  outline: none;
  padding: 10px 16px;
  background-color: #8987870d;
  cursor: pointer;
  font-size: 18px;
}

/* Style the active class, and buttons on mouse-over */
.active, .btn:hover {
  background-color: #205269;
  color: white !important;
}
</style>
</head>
<body class="hold-transition login-page">
<div class="login-box">

  <div class="login-logo">
     <a href="/">
<img alt="CFAS_logo" src="../cfas_logo.png"
 >
</a>
<h1>Cyber Safety Family Advice Suite</h1>
<h2>Parental Console</h2>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <?php if(empty($_SESSION["parent_id"])) { ?>
<form action="" method="post" id="frmLogin">
  <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>
  <div class="field-group">
    <div><label for="login">Username</label></div>
     <div class="form-group has-feedback"><input name="user_name" type="text" class="input-field form-control">
     <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
     </div>
  </div>
   <div class="field-group">
    <div><label for="login">Password</label></div>
     <div class="form-group has-feedback"><input name="password" type="password" class="input-field form-control">
     <span class="glyphicon glyphicon-lock form-control-feedback"></span>
     </div>
  </div>
 <div class="field-group" style=" display: none; ">
     <div class="form-group has-feedback"><input name="lang" type="text" class="input-field form-control" style=" display: none; ">
     <span class="glyphicon glyphicon-lock form-control-feedback"></span>
     </div>
  </div>
 <div class="field-group">
    <div><input type="submit" name="login" value="Login" class="form-submit-button btn btn-primary btn-block btn-flat"style=" background: blue; "></span></div>
  </div>
</form>
<br><br>

<div id="myDIV">
    <div><label for="login">Select Language</label></div>
  <button onClick="window.location.reload();" class="btn active" value="en">
<?xml version="1.0" encoding="UTF-8"?>

<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="15" viewBox="0 0 7410 3900">

<rect width="7410" height="3900" fill="#b22234"/>

<path d="M0,450H7410m0,600H0m0,600H7410m0,600H0m0,600H7410m0,600H0" stroke="#fff" stroke-width="300"/>

<rect width="2964" height="2100" fill="#3c3b6e"/>

<g fill="#fff">

<g id="s18">

<g id="s9">

<g id="s5">

<g id="s4">

<path id="s" d="M247,90 317.534230,307.082039 132.873218,172.917961H361.126782L176.465770,307.082039z"/>

<use xlink:href="#s" y="420"/>

<use xlink:href="#s" y="840"/>

<use xlink:href="#s" y="1260"/>

</g>

<use xlink:href="#s" y="1680"/>

</g>

<use xlink:href="#s4" x="247" y="210"/>

</g>

<use xlink:href="#s9" x="494"/>

</g>

<use xlink:href="#s18" x="988"/>

<use xlink:href="#s9" x="1976"/>

<use xlink:href="#s5" x="2470"/>

</g>

</svg>  English</button>
  <button onClick="greekURL();" class="btn" value="el">
<?xml version="1.0" encoding="UTF-8"?>
<svg xmlns="http://www.w3.org/2000/svg" width="25" height="15" viewBox="0 0 27 18">
<rect fill="#1453AD" width="27" height="18"/>
<path fill="none" stroke-width="2" stroke="#FFF" d="M5,0V11 M0,5H10 M10,3H27 M10,7H27 M0,11H27 M0,15H27"/>
</svg> Ελληνικά</button>
</div>
<script>
// Add active class to the current button (highlight it)
var header = document.getElementById("myDIV");
var btns = header.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  });
}
</script>

    <a href="#">I forgot my password</a><br>
    <a href="en/register.php" class="text-center">Create Account</a>

<?php
} else {

  $url = $proxyencase.'/api/public/parent/'.$_SESSION["parent_id"];
          // echo $url;
        $content = file_get_contents($url);
        $json = json_decode($content, true);
        // print_r($json);

?>
<form action="" method="post" id="frmLogout">
<div class="member-dashboard">Welcome <b><?php echo ucwords($json['parent_first_name'])." ".ucwords($json['parent_last_name']); ?></b>, You have successfully logged in!<br><br>
Click to <input type="submit" name="logout" value="Logout" class="logout-button"><br><br>
Or Go to <a href="en/home.php">
      <i class="fa fa-dashboard"></i> <span>Dashboard</span>

    </a></div>
</form>
</div>
</div>
<?php } ?>





  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
<script>
$(document).ready(function(){
  document.getElementsByName('lang')[0].value = document.getElementsByClassName("active")[0].value;
  document.getElementsByName('login')[0].onclick= function() {

 document.getElementsByName('lang')[0].value = document.getElementsByClassName("active")[0].value;
};

});
//Sha256 pass

function sha256(ascii) {
	function rightRotate(value, amount) {
		return (value>>>amount) | (value<<(32 - amount));
	};

	var mathPow = Math.pow;
	var maxWord = mathPow(2, 32);
	var lengthProperty = 'length'
	var i, j; // Used as a counter across the whole file
	var result = ''

	var words = [];
	var asciiBitLength = ascii[lengthProperty]*8;

	//* caching results is optional - remove/add slash from front of this line to toggle
	// Initial hash value: first 32 bits of the fractional parts of the square roots of the first 8 primes
	// (we actually calculate the first 64, but extra values are just ignored)
	var hash = sha256.h = sha256.h || [];
	// Round constants: first 32 bits of the fractional parts of the cube roots of the first 64 primes
	var k = sha256.k = sha256.k || [];
	var primeCounter = k[lengthProperty];
	/*/
	var hash = [], k = [];
	var primeCounter = 0;
	//*/

	var isComposite = {};
	for (var candidate = 2; primeCounter < 64; candidate++) {
		if (!isComposite[candidate]) {
			for (i = 0; i < 313; i += candidate) {
				isComposite[i] = candidate;
			}
			hash[primeCounter] = (mathPow(candidate, .5)*maxWord)|0;
			k[primeCounter++] = (mathPow(candidate, 1/3)*maxWord)|0;
		}
	}

	ascii += '\x80' // Append Ƈ' bit (plus zero padding)
	while (ascii[lengthProperty]%64 - 56) ascii += '\x00' // More zero padding
	for (i = 0; i < ascii[lengthProperty]; i++) {
		j = ascii.charCodeAt(i);
		if (j>>8) return; // ASCII check: only accept characters in range 0-255
		words[i>>2] |= j << ((3 - i)%4)*8;
	}
	words[words[lengthProperty]] = ((asciiBitLength/maxWord)|0);
	words[words[lengthProperty]] = (asciiBitLength)

	// process each chunk
	for (j = 0; j < words[lengthProperty];) {
		var w = words.slice(j, j += 16); // The message is expanded into 64 words as part of the iteration
		var oldHash = hash;
		// This is now the undefinedworking hash", often labelled as variables a...g
		// (we have to truncate as well, otherwise extra entries at the end accumulate
		hash = hash.slice(0, 8);

		for (i = 0; i < 64; i++) {
			var i2 = i + j;
			// Expand the message into 64 words
			// Used below if
			var w15 = w[i - 15], w2 = w[i - 2];

			// Iterate
			var a = hash[0], e = hash[4];
			var temp1 = hash[7]
				+ (rightRotate(e, 6) ^ rightRotate(e, 11) ^ rightRotate(e, 25)) // S1
				+ ((e&hash[5])^((~e)&hash[6])) // ch
				+ k[i]
				// Expand the message schedule if needed
				+ (w[i] = (i < 16) ? w[i] : (
						w[i - 16]
						+ (rightRotate(w15, 7) ^ rightRotate(w15, 18) ^ (w15>>>3)) // s0
						+ w[i - 7]
						+ (rightRotate(w2, 17) ^ rightRotate(w2, 19) ^ (w2>>>10)) // s1
					)|0
				);
			// This is only used once, so *could* be moved below, but it only saves 4 bytes and makes things unreadble
			var temp2 = (rightRotate(a, 2) ^ rightRotate(a, 13) ^ rightRotate(a, 22)) // S0
				+ ((a&hash[1])^(a&hash[2])^(hash[1]&hash[2])); // maj

			hash = [(temp1 + temp2)|0].concat(hash); // We don't bother trimming off the extra ones, they're harmless as long as we're truncating when we do the slice()
			hash[4] = (hash[4] + temp1)|0;
		}

		for (i = 0; i < 8; i++) {
			hash[i] = (hash[i] + oldHash[i])|0;
		}
	}

	for (i = 0; i < 8; i++) {
		for (j = 3; j + 1; j--) {
			var b = (hash[i]>>(j*8))&255;
			result += ((b < 16) ? 0 : '') + b.toString(16);
		}
	}
	return result;
};

$('[name="login"]').click(function(){
 sha256($('[name="password"]'))
});

</script>
<script>
function greekURL() {
        //var newURL = window.location.toString();
        var newURL="../el/index.php";
        window.location = newURL;
        //window.location = newURL.replace('/en', '/el');
 }
</script>
</body>
</html>
