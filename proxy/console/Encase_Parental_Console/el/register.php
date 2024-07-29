<?php
include('../variable_settings/vars.php');
session_start(); // Session starts here.
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cybersafety Family Advice Suite| Parental Console</title>
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
</head>
<body class="hold-transition login-page">
<div class="login-box">
 <div class="login-logo">
<h1> Cybersafety Family Advice Suite</h1>

  <!--  <a href="/"><img src="https://encase.socialcomputing.eu/wp-content/uploads/2017/07/image1-1.png" alt="ENCASE"></a>
  -->
</div>
  <!-- /.login-logo -->
  <div class="login-box-body">

    <?php if(empty($_SESSION["parent_id"])) { ?>
    <p class="login-box-msg">Εγγραφείτε για να ξεκινήσετε! </p>
<form action="register2.php" method="post" id="register">
 <label>Όνομα:<span>*</span></label>
 <input name="parent_first_name" type="text" placeholder="George" class="input-field form-control" required>
 <label>Επίθετο:<span>*</span></label>
 <input name="parent_last_name" type="text" placeholder="Papadopoulos" class="input-field form-control" required>
 <label>Όνομα Χρήστη(username):<span>*</span></label>
 <input name="parent_user_name" type="text" placeholder="George123" class="input-field form-control" required>
 <label>Ηλεκτρονικό Ταχυδρομείο(email):<span>*</span></label>
 <input name="parent_email" type="email" placeholder="Ex-anderson@gmail.com" class="input-field form-control" required>
 <label>Κωδικός Πρόσβασης:<span>*</span></label>
 <input name="pass" type="password" minlength="14" class="input-field form-control" placeholder="*****" required/>
  <div>
        <small id="passwordHelp" class="text-danger" style="display: none;">
          Πρέπει να είναι τουλάχιστον 14 χαρακτήρες.<br>
          Να μην περιέχει το όνομα χρήστη, όνομα, επίθετο ή ηλεκτρονικό ταχυδρομείο.
        </small>
      </div>
 <label>Επανάληψη κωδικού πρόσβασης:<span>*</span></label>
 <input name="confirm" type="password" class="input-field form-control" placeholder="*****" required>
 <div>
        <small id="passwordcheck" class="text-danger" style="display: none;">
         Οι κωδικοί δεν ταιριάζουν
        </small>
      </div>
 <input type="reset" value="Αναίρεση όλων" />
 <input id="next" type="submit" value="Επόμενο" />
 </form>


<?php
} else {
	$url = 'http://'.$_SERVER['HTTP_HOST'].'/api/public/parent/'.$_SESSION["parent_id"];
					// echo $url;
				$content = file_get_contents($url);
				$json = json_decode($content, true);
?>
<form action="" method="post" id="frmLogout">
<div class="member-dashboard">Καλωσορίσατε <?php echo ucwords($json['parent_first_name']); ?>, Έχετε συνδεθεί επιτυχώς!<br>
  <?php //echo ucwords($json['parent_id']); ?>
Πατήστε <input type="submit" name="logout" value="Αποσύνδεση" class="logout-button">.</div>
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
  $(document).ready(function() {
   $('input[type=password]').keyup(function() {
    var pswd = $(this).val();
    var cfrmpass = $('input[name=confirm]').val();
    var username = $('input[name=parent_user_name]').val();
    var parent_first_name = $('input[name=parent_first_name]').val();
    var parent_email = $('input[name=parent_email]').val();
    if (( pswd.length < 14 ) || (pswd.indexOf(username) != -1) || (pswd.indexOf(parent_first_name) != -1) || (pswd.indexOf(parent_email) != -1) || (pswd.indexOf("password") != -1) || (pswd.indexOf("12345") != -1) || (pswd != cfrmpass) ) {
    $('#passwordHelp').css("display","block");
    $(':input[type="submit"]').addClass('invalid');
    $(':input[type="submit"]').prop('disabled', true);
    $('#passwordcheck').css("display","block");

} else {
    $(':input[type="submit"]').removeClass('invalid').addClass('valid');
    $(':input[type="submit"]').prop('disabled', false);
    $('#passwordcheck').css("display","none");
}



});



});
</script>
</body>
</html>
