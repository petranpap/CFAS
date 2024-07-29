    <?php
include('../variable_settings/vars.php');
    header("Content-Type: text/html; charset=utf-8");  
                        
                        if (isset($_SESSION["parent_id"])) {
                        
                        $url = $proxyencase.'/api/public/notifications/'.$_SESSION["parent_id"];
                       
                        }
                        ?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Cyber Safety Family Advice Suite | Γονική Πλατφόρμα</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
         <!-- CHAT -->
        <link rel="stylesheet" type="text/css" href="../dist/css/chat.css">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/style.css">
        <link rel="stylesheet" href="../dist/css/skin-blue.min.css">
        <!-- Sliders -->
        <link rel="stylesheet" href="../dist/css/theme.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
       
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
        <!-- JS -->
        <!-- jQuery 3 -->
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- Sparkline -->
        <script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="../bower_components/moment/min/moment.min.js"></script>
        <script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- datepicker -->
        <script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Slimscroll -->
        <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="../bower_components/fastclick/lib/fastclick.js"></script>
        <script src="../dist/js/admin.js"></script>
	 <script src="../dist/js/upload.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){ 
               $.ajax({
                                            url: url,
                                            success: function(data) {
                                                var j = 0;
                                                for (var i = 0, len = data.length; i < len; i++) {

                                                    if (data[i]["read"] == 0) {
                                                        var j = j + 1;

                                                        var text = data[i]["child_first_name"] + ': ' + data[i]["text"];
                                                        var li_count = $('#notify_body li').length;
                                                        //console.log('data[i]["read"] ==0 '+text);
                                                        if (li_count < j) {
                                                            
                                                            
                                                            $('#notify_body').append('<li><a href=' + data[i]["href"] + '><i class="fa fa-user text-aqua"> ' + text + ' </i></a></li>');
                                                        }
                                                     


                                                    }
                                                    else if (data[i]["read"] ==1){
                                                        var text = data[i]["child_first_name"] + ': ' + data[i]["text"];
                                                        
                                                        //console.log('data[i]["read"] ==1 '+text);
                                                         $('#notify_body_old').append('<li><a href=' + data[i]["href"] + '><i class="fa fa-history  text-red"> ' + text + '</i></a></li>');

                                                    }

                                                }
                                                
                                                if (j >0){
                                                    $("#warning").text(j);

                                                }

                                                    
                                                
                                                }
                                                
                                                
                                              
                                               
                                            
                                        }); 
               });
        </script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />


    </head>

    <body class="hold-transition skin-blue sidebar-mini">
		<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '326188564655088',
      xfbml      : true,
      version    : 'v3.2'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="/en/home.php" class="logo" style="background:white;color:#222d32;padding-left: 0pt;">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>Γονική</b>Κονσόλα</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><img src="../cfas_logo_no_letters.png"><b style="padding-left:3pt;">Γονική</b>Κονσόλα</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" style="background-color: #222d32;">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                                    <!-- Notifications: style can be found in dropdown.less -->
                                    <li class="dropdown notifications-menu">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o" ></i>
                                <span id="warning" class="label label-warning"></span>
                            </a>
                                        <ul class="dropdown-menu" style="width: 95em;">
                                            <li id="notify_header" class="header" style="border-bottom: 1px solid black;">Ειδοποιήσεις</li>


                                            <li>Νέες
                                                <ul id="notify_body" class="menu" style="border-bottom: 1px solid black">

                                                </ul>Παλιές
                                                <ul id="notify_body_old" class="menu">
                                                </ul>
                                        </li>

                                            <li class="footer"><a href="#">View all</a></li>
                                        </ul>
                                <script>
                                    var url = "<?php echo $url;?>";
                                    setInterval(function() {
                                        $.ajax({
                                            url: url,
                                            success: function(data) {
                                                var j = 0;
                                                for (var i = 0, len = data.length; i < len; i++) {

                                                    if (data[i]["read"] == 0) {
                                                        var j = j + 1;

                                                        var text = data[i]["child_first_name"] + ': ' + data[i]["text"];
                                                        var li_count = $('#notify_body li').length;
                                                        //console.log(li_count);
                                                        if (li_count < j) {
                                                            
                                                            
                                                            $('#notify_body').append('<li><a href="#"><i class="fa fa-user text-aqua">' + text + '</i></a></li>');
                                                        }
                                                     


                                                    }

                                                    // else if (data[i]["read"] ==1){
                                                    //     $("#warning").css("display", "none");

                                                    // }

                                                }
                                                //console.log(j);
                                                if (j >0){
                                                    $("#warning").text(j);

                                                }else{
                                                    $("#warning").text('0');
                                                }

                                                    
                                                
                                                }
                                                
                                                
                                              
                                               
                                            
                                        });
                                    }, 8000);
                                </script>
                       

                    </div>
                </nav>
            </header>
