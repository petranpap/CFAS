<?php
include('../../../../variable_settings/vars.php');
$json_sexual = file_get_contents($host_ssl.'/dal/ObtainData/chat/sexualread/1', false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
$json_cyber = file_get_contents($host_ssl.'/dal/ObtainData/chat/cyberread/1',false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
$json_twitter = file_get_contents($host_ssl.'/dal/ObtainData/twitter/1',false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Ειδοποιήσεις<?= $fb_url ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">

.selected{
 border-radius: 60px;
  box-shadow: 0px 0px 2px #888;
  padding: 0.5em 0.6em;
}
      body{
    background:#eee;    
}
.widget-author {
  margin-bottom: 58px;
}
.author-card {
  position: relative;
  padding-bottom: 48px;
  background-color: #fff;
  box-shadow: 0 12px 20px 1px rgba(64, 64, 64, .09);
}
.author-card .author-card-cover {
  position: relative;
  width: 100%;
  height: 100px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.author-card .author-card-cover::after {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  content: '';
  opacity: 0.5;
}
.author-card .author-card-cover > .btn {
  position: absolute;
  top: 12px;
  right: 12px;
  padding: 0 10px;
}
.author-card .author-card-profile {
  display: table;
  position: relative;
  margin-top: -22px;
  padding-right: 15px;
  padding-bottom: 16px;
  padding-left: 20px;
  z-index: 5;
}
.author-card .author-card-profile .author-card-avatar, .author-card .author-card-profile .author-card-details {
  display: table-cell;
  vertical-align: middle;
}
.author-card .author-card-profile .author-card-avatar {
  width: 85px;
  border-radius: 50%;
  box-shadow: 0 8px 20px 0 rgba(0, 0, 0, .15);
  overflow: hidden;
}
.author-card .author-card-profile .author-card-avatar > img {
  display: block;
  width: 100%;
}
.author-card .author-card-profile .author-card-details {
  padding-top: 20px;
  padding-left: 15px;
}
.author-card .author-card-profile .author-card-name {
  margin-bottom: 2px;
  font-size: 14px;
  font-weight: bold;
}
.author-card .author-card-profile .author-card-position {
  display: block;
  color: #8c8c8c;
  font-size: 12px;
  font-weight: 600;
}
.author-card .author-card-info {
  margin-bottom: 0;
  padding: 0 25px;
  font-size: 13px;
}
.author-card .author-card-social-bar-wrap {
  position: absolute;
  bottom: -18px;
  left: 0;
  width: 100%;
}
.author-card .author-card-social-bar-wrap .author-card-social-bar {
  display: table;
  margin: auto;
  background-color: #fff;
  box-shadow: 0 12px 20px 1px rgba(64, 64, 64, .11);
}
.btn-style-1.btn-white {
    background-color: #fff;
}
.list-group-item i {
    display: inline-block;
    margin-top: -1px;
    margin-right: 8px;
    font-size: 1.2em;
    vertical-align: middle;
}
.mr-1, .mx-1 {
    margin-right: .25rem !important;
}

.list-group-item.active:not(.disabled) {
    border-color: #e7e7e7;
    background: #fff;
    color: #ac32e4;
    cursor: default;
    pointer-events: none;
}
.list-group-flush:last-child .list-group-item:last-child {
    border-bottom: 0;
}

.list-group-flush .list-group-item {
    border-right: 0 !important;
    border-left: 0 !important;
}

.list-group-flush .list-group-item {
    border-right: 0;
    border-left: 0;
    border-radius: 0;
}
.list-group-item.active {
    z-index: 2;
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}
.list-group-item:last-child {
    margin-bottom: 0;
    border-bottom-right-radius: .25rem;
    border-bottom-left-radius: .25rem;
}
a.list-group-item, .list-group-item-action {
    color: #404040;
    font-weight: 600;
}
.list-group-item {
    padding-top: 16px;
    padding-bottom: 16px;
    -webkit-transition: all .3s;
    transition: all .3s;
    border: 1px solid #e7e7e7 !important;
    border-radius: 0 !important;
    color: #404040;
    font-size: 17px;
    <!-- font-weight: 600;-->
    letter-spacing: .08em;
    text-transform: inherit;
    text-decoration: none;
}
.list-group-item {
    position: relative;
    display: block;
    padding: .75rem 1.25rem;
    margin-bottom: -1px;
    background-color: #fff;
    border: 1px solid rgba(0,0,0,0.125);
}
.list-group-item.active:not(.disabled)::before {
    background-color: #ac32e4;
}

.list-group-item::before {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    width: 3px;
    height: 100%;
    background-color: transparent;
    content: '';
}

.newstyle {
    padding-top: 16px;
    padding-bottom: 16px;
    -webkit-transition: all .3s;
    transition: all .3s;
    border: 1px solid #e7e7e7 !important;
    border-radius: 0 !important;
    color: #404040;
    font-size: 17px;
   <!-- font-weight: 600;-->
    letter-spacing: .08em;
    text-transform: inherit;
    text-decoration: none;
    position: relative;
    display: block;
    padding: .75rem 1.25rem;
    margin-bottom: -1px;
    background-color: #fff;
    border: 1px solid rgba(0,0,0,0.125);
}


    </style>
</head>
<body>
<div id="header" style="background: white;color: #222d32;padding-left: 0pt;"><img style="width:10%;" src="https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/images/cfas_trans.png"></div>
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-4 pb-5">
            <!-- Account Sidebar-->
            <div class="author-card pb-3">
                <div class="author-card-cover" style="background-image: url(https://demo.createx.studio/createx-html/img/widgets/author/cover.jpg);"><a class="btn btn-style-1 btn-white btn-sm" href="#" data-toggle="tooltip" title="" data-original-title="You currently have 290 Reward points to spend"><i class="fa fa-award text-md"></i></a></div>
                <div class="author-card-profile">
                    <div class="author-card-avatar"><img src="https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/avatars/boy-1/20053414.png" alt="avatar">
                    </div>
                    <div class="author-card-details">
                        <h5 class="author-card-name text-lg">Γεια σου! Σε αυτήν την σελίδα μπορείς να δεις όλες τις ειδοποιήσεις!</h5><span class="author-card-position">Από το κάτω μενού, μπορείτε να επιλέξετε για ποιο διαδικτυακό κοινωνικό δίκτυο (Facebook ή Twitter) θέλετε να δείτε τις ειδοποιήσεις!</span>
                    </div>
                </div>
            </div>
            <div class="wizard">
                <nav class="list-group list-group-flush">
                    <a class="list-group-item active" href="#facebook"><i class="fe-icon-user text-muted"></i>Facebook</a>
                    <a class="list-group-item" href="#twitter"><i class="fe-icon-user text-muted"></i>Twitter</a>
                </nav>
            </div>
        </div>
   <!-- Facebook Notifications -->
        <div class="col-lg-8 pb-5" id="facebook">
          <div class="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          Ειδοποιήσεις Facebook
        </button>
        
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
       <button class="bt1" id="toggle-collapse-fb">Eμφάνιση παλαιότερων ειδοποιήσεων</button>
      
      </div>
    </div>
  </div>
  </div>
</div>
        
        <!-- Twitter Notifications -->
        <div class="col-lg-8 pb-5" id="twitter">
      <div class="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseOne">
          Ειδοποιήσεις Twitter
        </button>
        
      </h2>
    </div>

    <div id="collapseTwo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
       <button class="bt2" id="toggle-collapse-tw">Eμφάνιση περισσότερων πληροφοριών</button>
      </div>
    </div>
  </div>
</div>
        </div>
    </div>
  </div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$('.list-group-item').on('click', function() {

$('.col-lg-8.pb-5').hide()
$(this.hash).show()
 $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");




}); 
$('.col-lg-8.pb-5').hide()
$('#facebook').show()
$(".avatar").click(function(){
    $(this).addClass("selected");
        $(".avatar").not($(this)).removeClass('selected');
  });
$(".avatar").click(function() {
$('#inputText').val($(".selected").attr('src'));

 
        });


if(window.location.hash){
  var hash = window.location.hash; 
$('.col-lg-8.pb-5').hide();
$(hash).show();
$('.list-group-item').siblings('a.active').removeClass("active");
$('.list-group-item').each(function( index ) {
if($( this )[0].hash ==hash ){
$( this ).addClass("active")
   }
  
});


}

});


</script>
<script src="../js/popper.min.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/vars.js"></script>
<script> var json_sexual = <?php echo $json_sexual ?>;</script>
<script> var json_cyber = <?php echo $json_cyber ?>;</script>
<script> var json_twitter = <?php echo $json_twitter ?>;</script>
<script src="../js/notifications1.js"></script>
<script src="../js/showfb.js" ></script>
<script src="../js/showtw.js" ></script>
<footer style="
background: white;
    text-align: center;
    color: white;
    border-top: 1px solid black;
">
 <img src="https://proxyencase.cut.ac.cy:8090/fundedeu.jpg" alt="School Bus" style="
    width: 300px;
"><img src="https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/en/edu/cybersafety.jpg" alt="School Bus" style="
    width: 200px;
    height: 100px;
">
</footer>
</body>
</html>
