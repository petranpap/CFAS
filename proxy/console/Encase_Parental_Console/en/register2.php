<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();
 
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cyber Safety Family Advice Suite| Parental Console</title>
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
  <!--<div class="login-logo">
    <a href="/"><img src="https://encase.socialcomputing.eu/wp-content/uploads/2017/07/image1-1.png" alt="ENCASE"></a>
  </div>-->
<center>
<h1>Cyber Safety Family Advice Suite</h1>
<h2>Parental Console</h2>
</center>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Register Your Child</p>

    <?php 
    if (isset($_SESSION["parent_id"])) {?>
    <form action="../dist/php/newkid.php" method="post" id="form1">
 <label>Kid Name :<span>*</span></label>
 <input name="child_first_name" type="text" placeholder="George" class="input-field form-control" required>
 <input name="parent_id" type="text" value="<?php echo $_SESSION["parent_id"]; ?> class="input-field form-control" style="display: none;" required>
 <label>Last Name :  <span>*</span></label>
 <input name="child_last_name" type="text" value="<?php echo $_SESSION["parent_last_name"]; ?>" class="input-field form-control" required>
 <label>Email :<span>*</span></label>
 <input name="child_email" type="email" placeholder="Ex-anderson@gmail.com" class="input-field form-control" required>
<label>Child Facebook Url :<span>*</span></label>
 <input name="child_fb_url" type="text" placeholder="https://www.facebook.com/ENCASE.H2020" class="input-field form-control" required> 
<label>Child Twitter Url :<span>*</span></label>
 <input name="child_twitter" type="text" placeholder="https://twitter.com/ENCASE_H2020" class="input-field form-control" required>

<center>
 <input type="reset" value="Reset" />
 <input id="submit" type="submit" value="Save" />
 </center>

 </form>

 <?php }else{
 $password=hash('sha256', $_POST['pass']);
  ?>
<form action="../dist/php/register.php" method="post" id="form1">
 <label>Kid Name :<span>*</span></label>
 <input name="child_first_name" type="text" placeholder="George" class="input-field form-control" required>
 <label>Last Name :  <span>*</span></label>
 <input name="child_last_name" type="text" value="<?php echo $_POST['parent_last_name']; ?>" class="input-field form-control" required>
 <label>Email :<span>*</span></label>
 <input name="child_email" type="email" placeholder="Ex-anderson@gmail.com" class="input-field form-control" required>
<label>Child Facebook Url :<span>*</span></label>
 <input name="child_fb_url" type="text" placeholder="https://www.facebook.com/ENCASE.H2020" class="input-field form-control" required>
<label>Child Twitter Url :<span>*</span></label>
 <input name="child_twitter" type="text" placeholder="https://twitter.com/ENCASE_H2020" class="input-field form-control" required>



 <input name="parent_first_name" type="text" value="<?php echo $_POST['parent_first_name']; ?>" class="input-field form-control" style="display: none;">
 <input name="parent_last_name" type="text" value="<?php echo $_POST['parent_last_name']; ?>" style="display: none" class="input-field form-control" >

 <input name="parent_user_name" type="text" value="<?php echo $_POST['parent_user_name']; ?>" style="display: none" class="input-field form-control" >

 <input name="parent_email" type="email" value="<?php echo $_POST['parent_email']; ?>" style="display: none" class="input-field form-control" >

 <input name="pass" type="Password" value="<?php echo $password; ?>" style="display: none" class="input-field form-control" placeholder="*****" />

 <input type="reset" value="Reset" />
 <input type="submit" value="Save" />
 </form>
 <?php

  } ?>
 

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

</body>
</html>
