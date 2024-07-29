<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../../../variable_settings/vars.php');
//echo $host_ssl;
$fb_url= $_GET['fb_url'];
//$json = file_get_contents('https://encase-backend.socialcomputing.eu:18082/dal/GetChildGroups/'.$fb_url,false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));

if(isset($_POST['SubmitButton'])){ //check if form was submitted

$imagePath = $_POST['inputText'];
$newPath = "../../avatars/selectedavatar/";
$ext = '.png';
$newName  = $newPath."avatar".$ext;

$copied = copy($imagePath , $newName);

if ((!$copied)) 
{
    echo "Error : Not Copied";
}else{
}
}    

?>
<!DOCTYPE html>

<body class="options_page" style="
    background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#fff), to(#1e73be));
">

<head>
<meta http-equiv="cache-control" content="no-cache"> <!-- tells browser not to cache -->
<meta http-equiv="expires" content="0"> <!-- says that the cache expires 'now' -->
<meta http-equiv="pragma" content="no-cache"> <!-- says not to use cached stuff, if there is any -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Options</title>
    <link rel="stylesheet" type="text/css" href="../css/options.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<style>
.selected{
 border-radius: 60px;
  box-shadow: 0px 0px 2px #888;
  padding: 0.5em 0.6em;
}
  
.circular {
position: relative;
    font-family: arial;
    /* font-size: 1.1em; */
    background: blue;
    color: #fff;
    border-radius: 89%;
    padding: 4%;
    /* max-width: 300px; */
    /* margin-right: 150px !important; */
    margin-left: 35%;
}
.circular1 {
background: blue;
    width: 20px;
    padding: 20px;
    border-radius: 50%;
    position: absolute;
    right: 75px;
    bottom: -10px;
}
.circular2 {
background: blue;
    width: 10px;
    padding: 10px;
    border-radius: 50%;
    position: absolute;
    right: 79px;
    bottom: -35px;
}
</style>

</head>

<body class="options_page">
    <!-- <script type="text/javascript" src="javascripts/cga.js"></script> -->
    <div id="wrapper">
<img src="../../images/backtotop.png" id="backtotop" style="position: fixed; right: 0px; z-index: 10000; width: 50px; height: 50px; top: 155px; border-radius: 50%; display: none;">
        <div id="header">
<a href= "<?php echo $proxyencase.'/proxy_api/avatar_module/en/options/index.php?fb_url=' . $fb_url;  ?> "> <button class="btn activebtn" value="en" disabled="">
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

</svg>  </button> </a>

<a href= "#"> <button class="btn" value="el">
<!--?xml version="1.0" encoding="UTF-8"?-->
<svg xmlns="http://www.w3.org/2000/svg" width="25" height="15" viewBox="0 0 27 18">
<rect fill="#1453AD" width="27" height="18"></rect>
<path fill="none" stroke-width="2" stroke="#FFF" d="M5,0V11 M0,5H10 M10,3H27 M10,7H27 M0,11H27 M0,15H27"></path>
</svg> 
 </button> </a>

<div class="circular">
<div id="avatar_txt" style="
    padding: 5%;
">
Γεια σου! Είμαι εδώ για να ενισχύσω την ασφάλεια σου στο διαδίκτυο!<br>Από αυτή την σελίδα μπορείς να τροποποιήσεις τις ρυθμίσεις μου!
</div>
<div class="circular1"></div>
<div class="circular2"></div>
</div><img src="../../avatars/selectedavatar/avatar.png?nocache=<?php echo time(); ?>" alt="" 
style="
    display: block;
    margin-left: auto;
    margin-right: auto;
    height: 100px;
    border-radius: 50%;
    margin-right: 1%;
    /* float: right; */
">
        </div>
        <!--Modal: Login / Register Form-->
<div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog cascading-modal" role="document" style=" max-width: 700px; ">
    <!--Content-->
    <div class="modal-content">


      <!--Modal cascading tabs-->
      <div class="modal-c-tabs">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#info" role="tab"><i class="far fa-eye"></i>
            Πληροφορίες</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#show" role="tab"><i class="far fa-eye"></i>
              Προβολή</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#edit" role="tab" id="edit_"><i class="fas fa-edit"></i>
              Eπεξεργασία</a>
          </li>
        </ul>

        <!-- Tab panels -->
        <div class="tab-content">
            <!--info-->
          <div class="tab-pane fade in show active" id="info" role="tabpanel">
           

            <!--Body-->
            <div class="modal-body mb-1" id="modal_info">
               <p>Έαν ανεβάσεις μια φωτογραφία το Cybersafety Family Advice Suite αυτόματα την κρυπτογραφεί. Στις επόμενες καρτέλες μπορείς να δεις ποιοί θα βλέπουν τις φωτογραφίες σου αποκρυπτογραφημένες και να προσθέσεις ή να αφαιρέσεις κάποιον, με το FACEBOOK URL του.</p>
               <img src="../../images/get_fb_url.jpg" style="width: 90%">


            
            </div>
          

          </div>
          <!--/.info-->

          <!--Show-->
          <div class="tab-pane fade in " id="show" role="tabpanel">
        

            <!--Body-->
            <div class="modal-body mb-1" id="modal_show">

            
            </div>
          

          </div>
          <!--/.Show-->

          <!--Edit-->
          <div class="tab-pane fade" id="edit" role="tabpanel">

            <!--Body-->
            <div class="modal-body" id="modal_edit">
             

            </div>
        
          </div>
          <!--/.Edit-->
        </div>

      </div>
    </div>
    <!-- /.Content-->
  </div>
</div>
<!--Modal: Login / Register Form-->

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header"<div class="modal-header" style="
    background: white;
    color: black;
">
          <h4 class="modal-title">Διάλεξε τον Guardian Avatar σου</h4>
        </div>
        <div class="modal-body">
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
        <div class="modal-footer"<div class="modal-header" style="
    background: white;
    color: black;
">
<form action="" method="post">
<?php echo $message; ?>
<input id="inputText" type="text" name="inputText" style="display:none"/>
  <input class="btn btn-success" id="SubmitButton" type="submit" name="SubmitButton" value="Αποθήκευση"/>
</form>    
 <button type="button" class="btn btn-danger" data-dismiss="modal">Κλείσιμο χωρίς αποθήκευση</button>

        </div>
      </div>
      
    </div>
  </div>

<div class="text-center" style="
    padding-bottom: 80%;
">
<p></p>
<p><b>Ρυθμίσεις</b></p>
<!-- Trigger the modal with a button --><button data-toggle="modal" data-target="#modalLRForm" id="myBtn" type="button" style="width:550px !important;" class="btn btn-primary">Επέλεξε ποιος θα μπορεί να βλέπει τις φωτογραφίες σου </button>
<p></p>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" style="width:550px !important;">Διάλεξε τον Guardian Avatar σου</button>
<p></p>
<button type="button" class="btn btn-info" id="scrolltooptions" style="width:550px !important;">Επεξεργάσου τις επιλογές ορατότητας</button>
</div>


        <div id="options">
            <fieldset id="format">
                <h1 style=" border-bottom: 1px solid; ">Επέλεξε τι θα βλέπει ο γονέας </h1>
                <p id="parental"></p>
               </fieldset>
           <fieldset id="format">
                <h1 style=" border-bottom: 1px solid; ">Επέλεξε τι θα βλέπει το σύστημα</h1>
                <p id="backend"></p>
               </fieldset>
            <fieldset>
             <fieldset id="format">
                <h1 style=" border-bottom: 1px solid; ">Επιλογές Κυβερνασφάλειας</h1>
                <p id="security"></p>
               </fieldset>
    </div>

</body>

  <script src="../js/popper.min.js"></script> 
     <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/vars.js"></script>

<script type="text/javascript">var fb_url = "<?= $fb_url ?>";</script>
<! --<script> var json = <?php echo $json ?>;</script> -->
<script src="../js/options.js"></script>
<script>
$(document).ready(function(){
  $(".avatar").click(function(){
    $(this).addClass("selected");
        $(".avatar").not($(this)).removeClass('selected');
  });
$(".avatar").click(function() {
$('#inputText').val($(".selected").attr('src'));

 
        });
$("#scrolltooptions").click(function() {
    $('html, body').animate({
        scrollTop: $("#options").offset().top
    }, 2000);
});
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
    $("#backtotop").css("display", "block"); 
  } else {
    $("#backtotop").css("display", "none"); 
  }
}
$("#backtotop").click(function() {
$('html, body').animate({
        scrollTop: $(".circular").offset().top
    }, 2000);
});
});
</script>

</html>


