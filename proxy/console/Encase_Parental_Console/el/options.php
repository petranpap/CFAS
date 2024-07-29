<?php
session_start();
include('../variable_settings/vars.php');
 include('head.php');
include('menu.php');

$conn = new mysqli($host, $username, $password, $dbname);
if (isset($_SESSION["parent_id"])) {
$child_id = $_GET['childid'];

?>

<!-- ???????????? -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">

  <h1>
  <?php
  $url = $proxyencase.'/api/public/child/'.$child_id;
				$content = file_get_contents($url);
				$json = json_decode($content, true);
  echo 'Επιλογές του/της '. $json["child_first_name"]?>
  </h1>
<script>
                $(document).ready(function(){
var child_fb = '<?php echo $json["child_fb_url"] ?>';
$( '[data-target="#editParental"]')[0].addEventListener('click', function() {
$.getJSON(window.location.origin+"/api/public/browser_addon/parental/options/"+child_fb, function(result){
$( "#ParentalVisibility"+result["parental_visibility_level"] )[0].click();
$("#"+result["checkbox"].replace(/\ /g,",#")).prop( "checked", true );

});

}, false);
$( '[data-target="#editBackend"]')[0].addEventListener('click', function() {
$.getJSON(window.location.origin+"/api/public/browser_addon/backend/options/"+child_fb, function(result){
$( "#BackendVisibility"+result["backend_visibility_level"] )[0].click();
$("#"+result["checkbox"].replace(/\ /g,",#")).prop( "checked", true );
var val =result["anonymously"];
$('.myradio [value="'+val+'"]').prop( "checked", true );

});

}, false);

$( '[data-target="#editSecurity"]')[0].addEventListener('click', function() {
$.getJSON(window.location.origin+"/api/public/browser_addon/safety/options/"+child_fb, function(result){
$( "#SecurityVisibility"+result["security_visibility_level"] )[0].click();
$("#"+result["checkbox"].replace(/\ /g,",#")).prop( "checked", true );

});

}, false);

});
</script>
  <ol class="breadcrumb">
    <li><a href="/home.php"><i class="fa fa-dashboard"></i> Αρχική Σελίδα</a></li>
    <li class="active">Επιλογές</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <!-- ./col -->
  </div>
  <!-- /.row -->
  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <section class="col-lg-7 connectedSortable">
          <!-- Parental Visibility Options -->

      <h1>Επίπεδο Γονικής Ορατότητας</h1><br>

	<p>Μέσω των επιλογών γονικής ορατότητας, το Cyber Safety Family Advice Suite προσφέρει επιλογές για το τι μπορεί να δει ο γονιός, επιτρέποντας ταυτόχρονα διάφορα επίπεδα παρακολούθησης για τους γονείς με τη συγκατάθεση του παιδιού.
</p>
           <?php
             if (isset($_SESSION["parent_id"])) {
     	$url = $proxyencase.'/api/public/parental/options/'.$_SESSION["parent_id"].'/'.$child_id;
					 //echo $url;
				$content = file_get_contents($url, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
				$json = json_decode($content, true);
				 //print_r($content);
				if ($json){
					 echo '<button class="btn-change7 btn btn-primary btn-lg" id="button_show_parental_kid" style="margin-right: 55px;">Εμφάνιση</button>

      <div id="show_parental_kid" style="padding: 1%;float: right; border: 1px solid #0000001a; box-shadow: grey 16px 10px 5px;display: none">';



      echo 'Επίπεδο Γονικής Ορατότητας: '.$json["parental_visibility_level"].'<br>';


      $str= $json["checkbox"];
      $array=explode(" ",$str);
      // print_r($array);
      for( $i= 0 ; $i < sizeof($array); $i++ ){
      $array[$i]=str_replace('parental_', '', $array[$i]);
      $array[$i]=str_replace('_', ' ', $array[$i]);
      $array[$i]=str_replace('fb', 'Facebook', $array[$i]);

      echo ucwords($array[$i]).'<br>';


      }



      echo "</div>";
				}else{
					echo '<button class="btn-change7 btn btn-primary btn-lg" id="button_show_parental_kid" style="margin-right: 55px;">Εμφάνιση</button>

      <div id="show_parental_kid" style="padding: 1%;float: right; border: 1px solid #0000001a; box-shadow: grey 16px 10px 5px;display: none">Το παιδί δεν <b>ΑΠΟΔΕΚΤΗΚΕ</b> ακόμη <br>τις Επιλογές Γονικής Ορατότητας. </div>';
				}





      ?>
      <script type="text/javascript">
        $('#button_show_parental_kid').click(function(){
   $('#show_parental_kid').toggle(300)
   if($(this).text()=== "Εμφάνιση"){
            $(this).text("Απόκρυψη");
        }
        else{
            $(this).text("Εμφάνιση");
        }
});
      </script>
      <button class="btn-change7 btn btn-primary btn-lg" data-toggle="modal" data-target="#editParental">
      Επεξεργασία</button><br><br>

      <div class="modal fade" id="editParental" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">




        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="opacity: unset;">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Επίπεδο Γονικής Ορατότητας</h4>
              <p id="success_parental"></p>
            </div>
            <div class="modal-body">
              <div class="slidecontainer">
                <!-- <input type="range" min="1" max="3" value="1" step="1" class="slider slider-horizontal" id="ParentalVisibility"> -->
                <div class="dgradio-sb ">
                  <input type="radio" class="dg-item" name="ParentalVisibility" id="ParentalVisibility1"  value="1" />
                  <label for="ParentalVisibility1" class="dg-label dg-30"  data-caption="Επίπεδο 1">
                    Επίπεδο 1<span class="dg-bg"></span>
                  </label>
                  <input type="radio" class="dg-item" name="ParentalVisibility" id="ParentalVisibility2" value="2" />
                  <label for="ParentalVisibility2" class="dg-label dg-60"  data-caption="Επίπεδο 2">
                    Επίπεδο 2<span class="dg-bg"></span>
                  </label>
                  <input type="radio" class="dg-item" name="ParentalVisibility" id="ParentalVisibility3"  value="3">
                  <label for="ParentalVisibility3" class="dg-label dg-100"  data-caption="Επίπεδο 3">
                    Επίπεδο 3 <span class="dg-bg"></span>
                  </label>
                </div>
                <p class="panel">Επίπεδο :
                  <span id="ParentalVisibilityResult"></span><br>
                  <span id="ParentalVisibilityResultText"></span><br>
                  <span id="ParentalVisibilityCheckBoxes"></span></p>

                </div>
                <script>
                $(document).ready(function(){
                var outputParentalVisibility = document.getElementById("ParentalVisibilityResult");
                var outputtextParentalVisibility = document.getElementById("ParentalVisibilityResultText");
                var ParentalVisibilityCheckBoxes = document.getElementById("ParentalVisibilityCheckBoxes");
                $('#ParentalVisibility1').click(function () {
                outputParentalVisibility.innerHTML = $("#ParentalVisibility1").val();
                outputtextParentalVisibility.innerHTML = "Αυτό είναι το χαμηλότερο επίπεδο γονικής ορατότητας. Σε αυτήν την επιλογή, δεν αποστέλλονται τίποτα στην γονική κονσόλα σχετικά με τον τοίχο Facebook, τις φωτογραφίες, τις ειδοποιήσεις και τους φίλους του παιδιού. Ο γονέας λαμβάνει μόνο ειδοποιήσεις.";
                ParentalVisibilityCheckBoxes.innerHTML='';
                });
                $('#ParentalVisibility2').click(function () {
                outputParentalVisibility.innerHTML = $("#ParentalVisibility2").val();
                outputtextParentalVisibility.innerHTML ="Αυτό το επίπεδο ορατότητας επιτρέπει στο Intelligent Web Proxy να λαμβάνει δεδομένα σχετικά με τον τοίχο, τους φίλους, τις ειδοποιήσεις, τις φωτογραφίες και τις πληροφορίες του παιδιού στο Facebook στο Back-End, χωρίς όμως να αντιστοιχίζει αυτά τα δεδομένα σε αυτόν τον χρήστη. Επιπλέον, ο γονέας θα είναι σε θέση να επιλέξει τα πράγματα που θέλει να δει σχετικά με τον τοίχο, τους φίλους, τις ειδοποιήσεις, τις φωτογραφίες και τις πληροφορίες του παιδιού στο Facebook ."
                ParentalVisibilityCheckBoxes.innerHTML=' <div class="checkbox"><div id="error" style=" float: right; display: none; "><p style=" color: red; ">Please Select</p></div><label><input type="checkbox" name="parental" id="parental_fb_wall" value="parental_fb_wall"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Wall</label><br><label><input type="checkbox" name="parental" id="parental_fb_friends" value="parental_fb_friends"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Friends</label><br><label><input type="checkbox" name="parental" id="parental_fb_notifications" value="parental_fb_notifications"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Notifications</label><br><label><input type="checkbox" name="parental" id="parental_fb_photos" value="parental_fb_photos"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Photos</label><br><label><input type="checkbox" name="parental" id="parental_fb_about" value="parental_fb_about"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook About</label></div>';
                });
                $('#ParentalVisibility3').click(function () {
                outputParentalVisibility.innerHTML = $("#ParentalVisibility3").val();
                outputtextParentalVisibility.innerHTML="Αυτό είναι το προεπιλεγμένο και το υψηλότερο επίπεδο ορατότητας. Όταν αυτή η επιλογή είναι επιλεγμένη, τότε ο Intelligent Web Proxy θα στείλει όλα τα δεδομένα στο Back-End και αυτά τα δεδομένα θα αντιστοιχιστούν σε αυτόν τον συγκεκριμένο χρήστη. Επιπλέον, ο γονέας θα είναι σε θέση να δει όλη την εισερχόμενη και εξερχόμενη κυκλοφορία του παιδιού όπως wall, chat, φίλους και φίλους φίλων.";
                ParentalVisibilityCheckBoxes.innerHTML='<div class="checkbox"><div id="error" style=" float: right; display: none; "><p style=" color: red; ">Please Select</p></div><label><input type="checkbox" name="parental" id="parental_fb_wall" value="parental_fb_wall" checked ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Wall</label><br><label><input type="checkbox" name="parental" id="parental_fb_friends" value="parental_fb_friends" checked ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Friends</label><br><label><input type="checkbox" name="parental" id="parental_fb_notifications" value="parental_fb_notifications" checked><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Notifications</label><br><label><input type="checkbox" name="parental" id="parental_fb_photos" value="parental_fb_photos" checked ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Photos</label><br><label><input type="checkbox" name="parental" id="parental_fb_about" value="parental_fb_about" checked ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook About</label><br><label><input type="checkbox" name="parental" id="parental_fb_chat" value="parental_fb_chat" checked><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Chat</label></div>';
                });
                });
                </script>
              </div>
              <div class="modal-footer">

                <button type="button" class="btn-change3 btn btn-primary" id="save">Αποθήκευση</button>
                <script type="text/javascript">
                document.getElementById("save").onclick = function() {
                var outputParentalVisibility = $('#ParentalVisibilityResult');
                // alert(outputParentalVisibility.html());
                var parentalValues = $('input[name=parental]:checked').map(function()
                {
                return $(this).val();
                }).get();
                if ((outputParentalVisibility.html()==3 && parentalValues.length>0) || (outputParentalVisibility.html()==2 && parentalValues.length>0) || outputParentalVisibility.html()==1){
                $.ajax({
                url: window.location.origin+'/dist/php/data.php',
                type: 'post',
                data: {option_type:"parental", child_id: "<?php echo $child_id ?>",parent_id:"<?php echo $_SESSION["parent_id"] ?>",visibility_level_parental:outputParentalVisibility.html(),parentalValues: parentalValues },
                success:function(data){

                	$("#error").css("display", "none");
                	$('#success_parental').css("display","block");
                	$('#success_parental').text('Οι επιλογές επίπεδου Γονικής Ορατότητας έχουν αποθηκευτεί με επιτυχία!');
                	$('#success_parental').css("color","green");


       //         setTimeout(
					  // function()
					  // {
					  // 	$('#editParental').modal('hide');
       //          location.reload();
       //           }, 3000);
                }
                });
            }else{
            	$('#success_parental').css("display","none");
            	$("#error").css("display", "block");

            }





                };
                 $('#editParental').on('hidden.bs.modal', function () {
 				 location.reload();
				});



                </script>
              </div>
            </div>
          </div>
        </div><br><br>
        <!-- Back-end  Level -->
        <h1>Επίπεδο Ορατότητας Back-end</h1><br>
        <p>Με βάση τις επιλογές του Επίπεδου Ορατότητας Backend, η κονσόλα προσφέρει επιλογές σχετικά με το τι μπορεί να αποστέλλει ο γονέας στο Back-End. Με αυτό τον τρόπο θα βοηθήσει στο να γίνει η κονσόλα πιο ακριβής στο μέλλον, πάντα όμως με την συγκατάθεση του παιδιού.</p>
            <?php
            $url = $proxyencase.'/api/public/backend/options/'.$_SESSION["parent_id"].'/'.$child_id;
					 //echo $url;
				$content = file_get_contents($url, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
				$json = json_decode($content, true);
				// print_r($json);
				if ($json){
					 echo '<button class="btn-change7 btn btn-primary btn-lg" id="button_show_backend_kid" style="margin-right: 55px;">Εμφάνιση</button>

      <div id="show_backend_kid" style="padding: 1%;float: right; border: 1px solid #0000001a; box-shadow: grey 16px 10px 5px;display: none">';



      echo 'Επίπεδο Ορατότητας Backend: '.$json["backend_visibility_level"].'<br>';


      $str= $json["checkbox"];
      $array=explode(" ",$str);
      // print_r($array);
      for( $i= 0 ; $i < sizeof($array); $i++ ){
      $array[$i]=str_replace('parental_', '', $array[$i]);
      $array[$i]=str_replace('_', ' ', $array[$i]);
      $array[$i]=str_replace('fb', 'Facebook', $array[$i]);

      echo ucwords($array[$i]).'<br>';


      }



      echo "</div>";
				}else{
					echo '<button class="btn-change7 btn btn-primary btn-lg" id="button_show_backend_kid" style="margin-right: 55px;">Εμφάνιση</button>

      <div id="show_backend_kid" style="padding: 1%;float: right; border: 1px solid #0000001a; box-shadow: grey 16px 10px 5px;display: none">Το παιδί δεν <b>ΑΠΟΔΕΚΤΗΚΕ</b> ακόμη <br> τις επιλογές για το Έπιπεδο Ορατότητας Back-end. </div>';
				}


      ?>
      <script type="text/javascript">
        $('#button_show_backend_kid').click(function(){
   $('#show_backend_kid').toggle(300)
   if($(this).text()=== "Εμφάνιση"){
            $(this).text("Απόκρυψη");
        }
        else{
            $(this).text("Εμφάνιση");
        }
});
      </script>
        <button class="btn-change7 btn btn-primary btn-lg" data-toggle="modal" data-target="#editBackend">
        Επεξεργασία
        </button><br><br>
        <div class="modal fade" id="editBackend" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="opacity: unset;">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Ορατότητα Back-end </h4>
                <p id="success_backend"></p>
              </div>
              <div class="modal-body">
                <div class="slidecontainer">
                  <div class="dgradio-sb ">
                    <input type="radio" class="dg-item" name="your-group-2" id="BackendVisibility1"  value="1" />
                    <label for="BackendVisibility1" class="dg-label dg-30"  data-caption="Επίπεδο 1">
                      Επίπεδο 1<span class="dg-bg"></span>
                    </label>
                    <input type="radio" class="dg-item" name="your-group-2" id="BackendVisibility2" value="2" />
                    <label for="BackendVisibility2" class="dg-label dg-60"  data-caption="Επίπεδο 2">
                      Επίπεδο 2<span class="dg-bg"></span>
                    </label>
                    <input type="radio" class="dg-item" name="your-group-2" id="BackendVisibility3"  value="3">
                    <label for="BackendVisibility3" class="dg-label dg-100"  data-caption="Επίπεδο 3">
                      Επίπεδο 3 <span class="dg-bg"></span>
                    </label>
                  </div>
                  <p class="panel">Επίπεδο Ορατότητας Back-end:
                    <span id="BackendResult"></span> <br>
                    <span id="BackendResultText"></span>
                    <span id="BackendVisibilityCheckBoxes"></span></p>
                  </div>
                  <script>
                  $(document).ready(function(){
                  var outputBackendResult = document.getElementById("BackendResult");
                  var outputBackendResultText= document.getElementById("BackendResultText");
                  var BackendVisibilityCheckBoxes = document.getElementById("BackendVisibilityCheckBoxes");
                  $('#BackendVisibility1').click(function () {
                  outputBackendResult.innerHTML = $("#BackendVisibility1").val();
                  outputBackendResultText.innerHTML = "Αυτό είναι το πιο χαμηλό επίπεδο ορατότητας Back-end. Με αυτή την επιλογή, δεν αποστέλλεται καμία πληροφορία στο Back-End όσο αφορά τον τoίχο, τις φωτογράφίες, τις ειδοποιήσεις και τους φίλους του παιδιού στο Facebook.";
                  BackendVisibilityCheckBoxes.innerHTML='';
                  });
                  $('#BackendVisibility2').click(function () {
                  outputBackendResult.innerHTML = $("#BackendVisibility2").val();
                  outputBackendResultText.innerHTML ="Σε αυτό το επίπεδο ο γονέας επιτρέπει στην κονσόλα να αποστέλλει δεδομένα στο Back-End όσο αφορά τον τοίχο, τον τοίχο των φίλων και τους φίλους του παιδιού στο Facebook. Ο γονέας θα μπορεί να επιλέξει ποιες πληροφορίες επιθυμεί να αποστέλλει. Επίσης ο γονέας θα επιλέγει αν θα στέλνει τα δεδομένα ανώνυμα ή όχι.";
                  BackendVisibilityCheckBoxes.innerHTML='<div class="checkbox"><div id="error" style=" float: right; display: none; "><p style=" color: red; ">Please Select</p></div><div style=" float: right; ">Αποστολή Δεδομένων :<br><label class="myradio">Ανώνυμα <input type="radio" checked="checked" name="anonymously" value="1"> <span class="checkmark"></span> </label> <label class="myradio">Επώνυμα<input type="radio" name="anonymously" value="0"> <span class="checkmark"></span> </label></div><label><input type="checkbox" name="backend" id="backend_fb_wall" value="backend_fb_wall"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Wall</label><br><label><input type="checkbox" name="backend" id="backend_fb_friends" value="backend_fb_friends"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Friends</label><br><label><input type="checkbox" name="backend" id="backend_fb_notifications" value="backend_fb_notifications"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Notifications</label><br><label><input type="checkbox" name="backend" id="backend_fb_photos" value="backend_fb_photos"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Photos</label><br><label><input type="checkbox" name="backend" id="backend_fb_about" value="backend_fb_about"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook About</label><br><label><input type="checkbox" name="backend" id="backend_fb_chat" value="backend_fb_chat"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Chat</label></div>';
                  });
                  $('#BackendVisibility3').click(function () {
                  outputBackendResult.innerHTML = $("#BackendVisibility3").val();
                  outputBackendResultText.innerHTML="Αυτό είναι το υψηλότερο επίπεδο ορατότητας.Όταν αυτό το επίπεδο είναι επιλεγμένο, θα προσθέτονται όλες οι επιλογές από το Επίπεδο 2 όπως επίσης και οι συνομιλίες. Έτσι σε αυτό το επίπεδο ο γονέας θα αποστέλλει στο Back-end όλα τα εισερχόμενα και εξερχόμενα δεδομένα από τον τοίχο, τις συνομιλίες, τους φίλους  και τους φίλους φίλων στο Facebook του παιδιού. Επιπρόσθετα, θα μπορεί να επιλέξει αν θα αποστέλλει τις πληροφορίες ανώνυμα ή όχι.";
                  BackendVisibilityCheckBoxes.innerHTML='<div class="checkbox"><div id="error" style=" float: right; display: none; "><p style=" color: red; ">Please Select</p></div><div style=" float: right; ">Αποστολή Δεδομένων:<br><label class="myradio">Ανώνυμα <input type="radio" checked="checked" name="anonymously" value="1"> <span class="checkmark"></span> </label> <label class="myradio">Επώνυμα <input type="radio" name="anonymously" value="0"> <span class="checkmark"></span> </label></div><label><input type="checkbox" name="backend" id="backend_fb_wall" value="backend_fb_wall" checked ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Wall</label><br><label><input type="checkbox" name="backend" id="backend_fb_friends" value="backend_fb_friends" checked ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Friends</label><br><label><input type="checkbox" name="backend" id="backend_fb_notifications" value="backend_fb_notifications" checked ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Notifications</label><br><label><input type="checkbox" name="backend" id="backend_fb_photos" value="backend_fb_photos" checked ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Photos</label><br><label><input type="checkbox" name="backend" id="backend_fb_about" value="backend_fb_about" checked ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook About</label><br><label><input type="checkbox" name="backend" id="backend_fb_chat" value="backend_fb_chat" checked><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Chat</label></div>';
                  });
                  });
                  </script>
                </div>
                <div class="modal-footer">

                  <button type="button" class="btn-change3 btn btn-primary" id="saveBack">Αποθήκευση</button>
                  <script type="text/javascript">
                  document.getElementById("saveBack").onclick = function() {
                  var outputBackendResult = $('#BackendResult');
                  // alert(outputBackendResult.html());
                  var anonymously = $('input[name=anonymously]:checked').val();
                  // alert($('input[name=anonymously]:checked').val());
                  var backendValues = $('input[name=backend]:checked').map(function()
                  {
                  return $(this).val();
                  }).get();
                       if ((outputBackendResult.html()==3 && backendValues.length>0) || (outputBackendResult.html()==2 && backendValues.length>0) || outputBackendResult.html()==1){
                       	  $.ajax({
                  url: window.location.origin+'/dist/php/data.php',
                  type: 'post',
                  data: {option_type:"backend", child_id: "<?php echo $child_id ?>",parent_id:"<?php echo $_SESSION["parent_id"] ?>",visibility_level_backend:outputBackendResult.html(),backendValues: backendValues, anonymously: anonymously },
                  success:function(data){

                  	$("#error").css("display", "none");
                	$('#success_backend').css("display","block");
                	$('#success_backend').text('Οι επιλογές για την Ορατότητα του Back-End έχουν αποθηκευτεί με επιτυχία!');
                	$('#success_backend').css("color","green");


       //         setTimeout(
					  // function()
					  // {
					  // 	$('#editParental').modal('hide');
       //          location.reload();
       //           }, 3000);
                }
                  });

            }else{
            	$('#success_backend').css("display","none");
            	$("#error").css("display", "block");

            }




              };

              $('#editBackend').on('hidden.bs.modal', function () {
 				 location.reload();
				});




                  </script>
                </div>
              </div>
            </div>
          </div><br><br>
          <!-- Security Level -->
          <h1>Επίπεδο Κυβερνοασφάλειας</h1><br>
          <p>Ο γονέας μπορεί να επιλέγει το Επίπεδο Κυβερνοασφάλειας του παιδιού. Αυτές οι επιλογές αφήνουν τον γονέα να αποφασίσει τι θα βλέπει το παιδί και τι θα φιλτράρει, θα αντικαθιστά και τι θα κρυπτογραφεί ή υδατογραφεί, αντίστοιχα, ο Intelligent Web-Proxy.</p>

          <?php
          $url = $proxyencase.'/api/public/safety/options/'.$_SESSION["parent_id"].'/'.$child_id;
					//echo $url;
				$content = file_get_contents($url, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
				$json = json_decode($content, true);
				// print_r($json);
				if ($json){
					 echo '<button class="btn-change7 btn btn-primary btn-lg" id="button_show_security_kid" style="margin-right: 55px;">Εμφάνιση</button>

      <div id="show_security_kid" style="padding: 1%;float: right; border: 1px solid #0000001a; box-shadow: grey 16px 10px 5px;display: none">';



      echo 'Επίπεδο Κυβερνοασφάλειας : '.$json["security_visibility_level"].'<br>';


      $str= $json["checkbox"];
      $array=explode(" ",$str);
      // print_r($array);
      for( $i= 0 ; $i < sizeof($array); $i++ ){
      $array[$i]=str_replace('parental_', '', $array[$i]);
      $array[$i]=str_replace('_', ' ', $array[$i]);
      $array[$i]=str_replace('fb', 'Facebook', $array[$i]);

      echo ucwords($array[$i]).'<br>';


      }



      echo "</div>";
				}else{
					 echo '<button class="btn-change7 btn btn-primary btn-lg" id="button_show_security_kid" style="margin-right: 55px;">Εμφάνιση</button>

      <div id="show_security_kid" style="padding: 1%;float: right; border: 1px solid #0000001a; box-shadow: grey 16px 10px 5px;display: none">Το παιδί δεν
 <b>ΑΠΟΔΕΚΤΗΚΕ</b> ακόμη <br> τις Επιλογές Κυβερνοασφάλειας. </div>';
				}
			}

    }


      ?>
      <script type="text/javascript">
        $('#button_show_security_kid').click(function(){
   $('#show_security_kid').toggle(300)
   if($(this).text()=== "Εμφάνιση"){
            $(this).text("Απόκρυψη");
        }
        else{
            $(this).text("Εμφάνιση");
        }
});
      </script>
          <button class="btn-change7 btn btn-primary btn-lg" data-toggle="modal" data-target="#editSecurity">
          Επεξεργασία
          </button><br><br>
          <div class="modal fade" id="editSecurity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="opacity: unset;">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">Κυβερνοασφάλεια</h4>
                  <p id="success_sec"></p>
                </div>
                <div class="modal-body">
                  <div class="slidecontainer">
                    <div class="dgradio-sb ">
                      <input type="radio" class="dg-item" name="your-group-2" id="SecurityVisibility1"  value="1" />
                      <label for="SecurityVisibility1" class="dg-label dg-50"  data-caption="Επίπεδο 1">
                        Επίπεδο 1<span class="dg-bg"></span>
                      </label>
                      <input type="radio" class="dg-item" name="your-group-2" id="SecurityVisibility2" value="2" />
                      <label for="SecurityVisibility2" class="dg-label dg-100"  data-caption="Επίπεδο 2">
                        	Επίπεδο 2<span class="dg-bg"></span>
                      </label>
                    </div>
                    <p class="panel">Επίπεδο Ασφάλειας :
                      <span id="SecurityResult"></span> <br>
                      <span id="SecurityResultText"></span>
                      <span id="SecurityVisibilityCheckBoxes"></span></p>
                    </div>
                    <script>
                    $(document).ready(function(){
                    var outputSecurity = document.getElementById("SecurityResult");
                    var outputtextSecurity = document.getElementById("SecurityResultText");
                    var SecurityVisibilityCheckBoxes = document.getElementById("SecurityVisibilityCheckBoxes");
                    $('#SecurityVisibility1').click(function () {
                    outputSecurity.innerHTML = $("#SecurityVisibility1").val();
                    outputtextSecurity.innerHTML = "Αυτό είναι το πιο χαμηλό επίπεδο ασφάλειας. Θα τοποθετεί μόνο ειδοποιήσεις στο πρόσθετο προγράμματος περιήγησης. Αυτό σημαίνει ότι ο Intelligent Web-Proxy θα εντοπίζει ύποπτες δραστηριότητες χωρίς όμως να κρυπτογραφεί την εικόνα ή να αντικαθιστά το κείμενο παρά μόνο θα τοποθετεί τις κατάλληλες ειδοποιήσεις στο πρόσθετο προγράμματος περιήγησης για να προειδοποιούν τον χρήστη για την δραστηριότητα που εντοπίστηκε. Ο γονέας μπορεί να επιλέγει για ποιες κατηγορίες δραστηριοτήτων επιθυμεί να λαμβάνει ειδοποιήσεις.";
                    SecurityVisibilityCheckBoxes.innerHTML='<div class="checkbox"><div id="error" style=" float: right; display: none; "><p style=" color: red; ">Please Select</p></div><label><input type="checkbox" name="security" id="sexual_grooming" value="sexual_grooming"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Σεξουαλική αποπλάνηση</label><label><input type="checkbox" name="security" id="hate_speech" value="hate_speech"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Λεκτικό Μίσος ή Ανάρμοστη Ομιλία</label><label><input type="checkbox" name="security" id="cyberbullying" value="cyberbullying"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Εκφοβισμός στον Κυβερνοχώρο</label><label><input type="checkbox" name="security" id="distressed_behavior" value="distressed_behavior"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Δυσχερής Συμπεριφορά </label></div>';
                    });
                    $('#SecurityVisibility2').click(function () {
                    outputSecurity.innerHTML = $("#SecurityVisibility2").val();
                    outputtextSecurity.innerHTML ="Βασισμένο στις επιλογές του γονέα, αυτό το επίπεδο ασφάλειας επιτρέπει στον γονέα να επιλέγει τι θα αντικαθιστάται, φιλτράρεται ή κρυπτογραφείται πριν να φτάνει στο πρόγραμμα περιήγησης του χρήστη. Για παράδειγμα: ο γονέας θα μπορει να επιλέξει την κρυπτογράφηση εικόνων ευαίσθητου περιεχομένου παρά απλά να ειδοποιεί τον χρήστη μέσω της επιλόγής λήψης ειδοποιήσεων για εντοπισμό εκφοβισμού στον κυβερνοχώρο.";
                    SecurityVisibilityCheckBoxes.innerHTML='<div class="checkbox"><div id="error" style=" float: right; display: none; "><p style=" color: red; ">Παρακαλώ Επιλέξτε</p></div><label><input type="checkbox" name="security" id="sexual_grooming" value="sexual_grooming"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Σεξουαλική Αποπλάνηση</label><label><input type="checkbox" name="security" id="hate_speech" value="hate_speech"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Λεκτικό Μίσος ή Ανάρμοστη Ομιλία</label><label><input type="checkbox" name="security" id="cyberbullying" value="cyberbullying"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Εκφοβισμός στον Κυβερνοχώρο</label><label><input type="checkbox" name="security" id="distressed_behavior" value="distressed_behavior"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Δυσχερής Συμπεριφορά </label></div>';

                    });
                    });
                    </script>
                  </div>
                  <div class="modal-footer">

                    <button type="button" class="btn-change3 btn btn-primary" id="saveSec">Αποθήκευση</button>
                    <script type="text/javascript">
                    document.getElementById("saveSec").onclick = function() {
                    var SecurityResult = $('#SecurityResult');
                    var securityValues = $('input[name=security]:checked').map(function()
                    {
                    return $(this).val();
                    }).get();
                    if (securityValues.length>0){
                    // alert(securityValues);
                    $.ajax({
                    url: window.location.origin+'/dist/php/data.php',
                    type: 'post',
                    data: { option_type:"security",child_id: "<?php echo $child_id ?>",parent_id:"<?php echo $_SESSION["parent_id"] ?>",visibility_level_security:SecurityResult.html(),securityValues: securityValues },
                   success:function(data){

                   	$("#error").css("display", "none");
                   	$('#success_sec').css("display", "block");
                	$('#success_sec').text('Οι επιλογές για την Κυβερνοασφάλεια έχουν αποθηκευτεί με επιτυχία.');
                	$('#success_sec').css("color","green");


       //         setTimeout(
					  // function()
					  // {
					  // 	$('#editSecurity').modal('hide');
       //          location.reload();
       //           }, 3000);
                }
                  });
                }else{
                	$('#success_sec').css("display","none");
            	$("#error").css("display", "block");

                }
                };
                 $('#editSecurity').on('hidden.bs.modal', function () {
 				 location.reload();
				});

                    </script>
                  </div>
                </div>
              </div>
  </section>
  <!-- /.Left col -->
  <?php include('rightsidebar.php');?>

</div>
<!-- /.row (main row) -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include('footer.php');
?>
