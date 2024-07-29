<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
include('../../../../variable_settings/vars.php');
$fb_url= $_GET['fb_url'];
$json = file_get_contents('https://backendencase.cut.ac.cy:18085/dal/GetChildGroups/'.$fb_url,false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
//echo $fb_url;
//print_r($json);
if(isset($_POST['SubmitButton'])){ //check if form was submitted

$imagePath = $_POST['inputText'];
$newPath = "../../avatars/selectedavatar/";
$ext = '.png';
$newName  = $newPath."avatar".$ext;
$copied = copy($imagePath , $newName);

if ((!$copied)) 
{
echo $imagePath;
    echo "Error : Not Copied";
}else{
}
}    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Σελίδα Επιλογών - <?= $fb_url ?></title>
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
    text-indent: -8px;
}
.list-group-item {
    padding-top: 16px;
    padding-bottom: 16px;
    -webkit-transition: all .3s;
    transition: all .3s;
    border: 1px solid #e7e7e7 !important;
    border-radius: 0 !important;
    color: #404040;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: .08em;
    text-transform: uppercase;
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

    </style>
</head>
<body>
<div id="header" style="background: white;color: #222d32;padding-left: 0pt;"><img src="../../../../cfas_logo_no_letters.png"><span style="padding-left: 3pt;"><b>CFAS</b></span></div>
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-4 pb-5">
            <!-- Account Sidebar-->
            <div class="author-card pb-3">
                <div class="author-card-cover" style="background-image: url(https://demo.createx.studio/createx-html/img/widgets/author/cover.jpg);"><a class="btn btn-style-1 btn-white btn-sm" href="#" data-toggle="tooltip" title="" data-original-title="You currently have 290 Reward points to spend"><i class="fa fa-award text-md"></i></a></div>
                <div class="author-card-profile">
                    <div class="author-card-avatar"><img src="https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/avatars/boy-1/20091002.png" alt="avatar">
                    </div>
                    <div class="author-card-details">
                        <h5 class="author-card-name text-lg">Γεια! είμαι εδώ για να σε βοηθήσω να παραμείνεις ασφαλής στο διαδίκτυο!</h5><span class="author-card-position">Από αυτή την σελίδα μπορείς να επεξεργαστείς τις ρυθμίσεις της διαδικτυακής σου ασφάλειας.</span>
                    </div>
                </div>
            </div>
            <div class="wizard">
                <nav class="list-group list-group-flush">
                    <a class="list-group-item active" href="#pictures" id="loadpicsettings"><i class="fe-icon-user text-muted"></i>Επελεξε ποιος μπορει να δει τις φωτογραφιες σου</a>
		    <a class="list-group-item" href="#avatarlook"><i class="fe-icon-user text-muted"></i>Επελεξε το στυλ του αβαταρ σου</a>
		    <a class="list-group-item" href="#visibility"><i class="fe-icon-map-pin text-muted"></i>Επεξεργασου τις επιλογες Ορατοτητας & Ασφαλειας</a>
		    <a class="list-group-item" href="#languages"><i class="fe-icon-map-pin text-muted"></i>Επελεξε γλωσσα</a>
                </nav>
            </div>
        </div>
	 <!-- Picture Settings-->
        <div class="col-lg-8 pb-5" id="pictures">
          <div class="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#info" aria-expanded="false" aria-controls="collapseOne">
          Πληροφορίες
        </button>
      </h2>
    </div>

    <div id="info" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample" style="">
      <div class="card-body">
       <p>Έαν ανεβάσεις μια φωτογραφία το Cybersafety Family Advice Suite αυτόματα την κρυπτογραφεί.<br>
          Από την καρτέλα <b>Προβολή</b> μπορείς να βρεις τη λίστα των λογαριασμών που μπορούν να δουν την φωτογραφία σου αποκρυπτογραφημένη, όποιος δεν είναι στη λίστα, δεν μπορεί να δει την φωτογραφία σου.<br>
          Από την καρτέλα <b>Eπεξεργασία</b> μπορείς να επεξεργαστείς τη λίστα προσθέτοντας / αφαιρώντας έναν λογαριασμό χρησιμοποιώντας τη διεύθυνση URL του Facebook του (όπως φαίνεται στην παρακάτω εικόνα).</p><img src="../../images/get_fb_url.jpg" style="width: 90%">
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#modal_show" aria-expanded="false" aria-controls="collapseTwo">
          Προβολή
        </button>
      </h2>
    </div>
    <div id="modal_show" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample" style="">
      
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#modal_edit" aria-expanded="false" aria-controls="collapseThree">
          Eπεξεργασία
        </button>
      </h2>
    </div>
    <div id="modal_edit" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample" style="">
     
    </div>
  </div>
</div>
        </div>
<!-- Avatar Look-->
	 <div class="col-lg-8 pb-5" id="avatarlook">
            <div>
		<?php
$dirname = "../../avatars/";
$images = glob($dirname."*.png");

foreach($images as $key=>$image) {
    echo '<img class="avatar" src="'.$image.'" style="height: 50px; border-radius: 50%;" />';
if ($key % 7 === 0){
echo '<br>';
}
}
//echo $key;
?>
	 </div>
<div>
<form action="" method="post">
<?php echo $message; ?>
<input id="inputText" type="text" name="inputText" style="display:none"/>
<br>
  <input class="btn btn-success" id="SubmitButton" type="submit" name="SubmitButton" value="Αποθήκευση"/style=" float: left; ">
</form>    
 <button type="button" class="btn btn-danger" data-dismiss="modal">Κλείσιμο χωρίς αποθήκευση</button>

        </div>
        </div>
        <!-- Visibility Settings-->
        <div class="col-lg-8 pb-5" id="visibility">
      <div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Επέλεξε τι θα βλέπει ο γονέας
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
       Μέσω των επιλογών γονικής ορατότητας, το Cyber ​​Safety Family Advice Suite προσφέρει επιλογές σχετικά με το τι μπορεί να δει ο γονέας, επιτρέποντας ταυτόχρονα διάφορα επίπεδα παρακολούθησης για τους γονείς. <i><b>*Αυτές οι επιλογές σου αποστέλλονται ως αίτημα και μπορούν να εφαρμοστούν μόνο αφού δώσεις τη συγκατάθεσή σου.</b></i>
       <div id="parental"></div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Επέλεξε τι θα βλέπει το σύστημα
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
Μέσω των επιλογών γονικής ορατότητας, το Cyber ​​Safety Family Advice Suite προσφέρει επιλογές σχετικά με το τι μπορεί να δει ο γονέας, επιτρέποντας ταυτόχρονα διάφορα επίπεδα παρακολούθησης για τους γονείς. Τα ληφθέντα δεδομένα θα χρησιμοποιηθούν για τη βελτίωση της ακρίβειας του Suite και θα βοηθήσουν στην ενίσχυση της διαδικτυακής σου προστασίας.<br><i><b>*Αυτές οι επιλογές σου αποστέλλονται ως αίτημα και μπορούν να εφαρμοστούν μόνο αφού δώσεις τη συγκατάθεσή σου.</b></i>
        <div id="backend"></div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Επιλογές Κυβερνασφάλειας
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        Μέσω των επιλογών Cybersafety, ο γονέας μπορεί να επιλέξει το Επίπεδο της κυβερνοασφάλεια σου. Αυτές οι επιλογές επιτρέπουν στον γονέα να επιλέξει τι θα δεις και τι θα φιλτράρει, αντικαταστήσει,  κρυπτογραφήσει ή υδατογράφημα το Intelligent Web-Proxy αντίστοιχα.<i><b>*Αυτές οι επιλογές σου αποστέλλονται ως αίτημα και μπορούν να εφαρμοστούν μόνο αφού δώσεις τη συγκατάθεσή σου.</b></i>
        <div id="security"></div>
      </div>
    </div>
  </div>
</div>
        </div>
	<!-- Language -->
        <div class="col-lg-8 pb-5" id="languages" style="display: block;">
          <div class="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        
       <button onClick="englishURL();" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#english" aria-expanded="false" aria-controls="collapseOne">
<!--?xml version="1.0" encoding="UTF-8"?-->
  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="15" viewBox="0 0 7410 3900">
  <rect width="7410" height="3900" fill="#b22234"></rect>
  <path d="M0,450H7410m0,600H0m0,600H7410m0,600H0m0,600H7410m0,600H0" stroke="#fff" stroke-width="300"></path>
  <rect width="2964" height="2100" fill="#3c3b6e"></rect>
  <g fill="#fff">
  <g id="s18">
  <g id="s9">
  <g id="s5">
  <g id="s4">
  <path id="s" d="M247,90 317.534230,307.082039 132.873218,172.917961H361.126782L176.465770,307.082039z"></path>
  <use xlink:href="#s" y="420"></use>
  <use xlink:href="#s" y="840"></use>
  <use xlink:href="#s" y="1260"></use>
  </g>
    <use xlink:href="#s" y="1680"></use>
  </g>
    <use xlink:href="#s4" x="247" y="210"></use>
  </g>
    <use xlink:href="#s9" x="494"></use>
  </g>
    <use xlink:href="#s18" x="988"></use>
    <use xlink:href="#s9" x="1976"></use>
    <use xlink:href="#s5" x="2470"></use>
  </g>

  </svg> English
      </button>
      </h2>
    </div>

    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button onClick="greekURL();" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#greek" aria-expanded="false" aria-controls="collapseTwo">
<!--?xml version="1.0" encoding="UTF-8"?-->
<svg xmlns="http://www.w3.org/2000/svg" width="25" height="15" viewBox="0 0 27 18">
  <rect fill="#1453AD" width="27" height="18"></rect>
<path fill="none" stroke-width="2" stroke="#FFF" d="M5,0V11 M0,5H10 M10,3H27 M10,7H27 M0,11H27 M0,15H27"></path>
</svg> Ελληνικά</button>
       
      </h2>
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
$('#pictures').show()
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
<script src="../js/vars.js"></script>
<script type="text/javascript">var fb_url = "<?= $fb_url ?>";</script>
<script> var json = <?php echo $json ?></script>
<script src="../js/options_new.js"></script>
<script src="../js/languages.js"></script>
<footer style="
    text-align: center;
    color: white;
background: white;
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
