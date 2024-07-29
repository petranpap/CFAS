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
$content = file_get_contents($url, false, stream_context_create(array ('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
$json = json_decode($content, true);
  echo $json["child_first_name"]. ' Options '?>
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
    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Options</li>
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

      <h1>Parental Visibility</h1><br>

      <p>Through the Parental Visibility options, Cyber Safety Family Advice Suite offers options about what information the parent can receive when the Suite detects any online risk in a child's online activity on Facebook. The selected options will be sent as a request to the child, and only if the child gives his/her consent the options will be applied.</p>

           <?php
             if (isset($_SESSION["parent_id"])) {
     	$url = $proxyencase.'/api/public/parental/options/'.$_SESSION["parent_id"].'/'.$child_id;
					 //echo $url;
				$content = file_get_contents($url, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
				$json = json_decode($content, true);
				 //print_r($content);
				if ($json){
					 echo '<button class="btn-change7 btn btn-primary btn-lg" id="button_show_parental_kid" style="margin-right: 55px;">Show</button>

      <div id="show_parental_kid" style="padding: 1%;float: right; border: 1px solid #0000001a; box-shadow: grey 16px 10px 5px;display: none">';



      echo 'Parental Visibility Level: '.$json["parental_visibility_level"].'<br>';


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
					echo '<button class="btn-change7 btn btn-primary btn-lg" id="button_show_parental_kid" style="margin-right: 55px;">Show</button>

      <div id="show_parental_kid" style="padding: 1%;float: right; border: 1px solid #0000001a; box-shadow: grey 16px 10px 5px;display: none">The child has <b>not accepted</b> the<br> Parental Visibility Options yet. </div>';
				}





      ?>
      <script type="text/javascript">
        $('#button_show_parental_kid').click(function(){
   $('#show_parental_kid').toggle(300)
   if($(this).text()=== "Show"){
            $(this).text("Hide");
        }
        else{
            $(this).text("Show");
        }
});
      </script>
      <button class="btn-change7 btn btn-primary btn-lg" data-toggle="modal" data-target="#editParental">
      Edit</button><br><br>

      <div class="modal fade" id="editParental" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">




        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="opacity: unset;">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Parental Visibility</h4>
              <p id="success_parental"></p>
            </div>
            <div class="modal-body">
              <div class="slidecontainer">
                <!-- <input type="range" min="1" max="3" value="1" step="1" class="slider slider-horizontal" id="ParentalVisibility"> -->
                <div class="dgradio-sb ">
                  <input type="radio" class="dg-item" name="ParentalVisibility" id="ParentalVisibility1"  value="1" />
                  <label for="ParentalVisibility1" class="dg-label dg-30"  data-caption="Level 1">
                    Level 1<span class="dg-bg"></span>
                  </label>
                  <input type="radio" class="dg-item" name="ParentalVisibility" id="ParentalVisibility2" value="2" />
                  <label for="ParentalVisibility2" class="dg-label dg-60"  data-caption="Level 2">
                    Level 2<span class="dg-bg"></span>
                  </label>
                  <input type="radio" class="dg-item" name="ParentalVisibility" id="ParentalVisibility3"  value="3">
                  <label for="ParentalVisibility3" class="dg-label dg-100"  data-caption="Level 3">
                    Level 3 <span class="dg-bg"></span>
                  </label>
                </div>
                <p class="panel">Visibility Level:
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
                outputtextParentalVisibility.innerHTML = "This is the lowest level of Parental Visibility. When this option is selected, the Suite notifies the parent about the detected online risk without providing any further information. The parent will receive notification through the Parental Console regarding the malicious activity detected, i.e., 'Cyberbullying detected'.";
                ParentalVisibilityCheckBoxes.innerHTML='';
                });
                $('#ParentalVisibility2').click(function () {
                outputParentalVisibility.innerHTML = $("#ParentalVisibility2").val();
                outputtextParentalVisibility.innerHTML ="This is the medium Parental Visibility level. When this option is selected, the Suite notifies the parent about the detected online risk along with further information(Facebook wall, Friends, Photos). The parent will receive a notification through the Parental Console regarding the malicious activity detected, along with some additional available data(e.g. Names of users involved, photo with inappropriate content, etc.). For example, the notification can be: 'Your child had a conversation with (Perpetrator's name) and Cyber Safety Family Advice Suite detected Cyberbullying'."
                ParentalVisibilityCheckBoxes.innerHTML=' <div class="checkbox"><div id="error" style=" float: right; display: none; "><p style=" color: red; ">Please Select</p></div><label><input type="checkbox" name="parental" id="parental_fb_wall" value="parental_fb_wall"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Wall</label><br><label><input type="checkbox" name="parental" id="parental_fb_friends" value="parental_fb_friends"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Friends</label><br><label><input type="checkbox" name="parental" id="parental_fb_notifications" value="parental_fb_notifications"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Notifications</label><br><label><input type="checkbox" name="parental" id="parental_fb_photos" value="parental_fb_photos"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Photos</label><br><label><input type="checkbox" name="parental" id="parental_fb_about" value="parental_fb_about"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook About</label></div>';
                });
                $('#ParentalVisibility3').click(function () {
                outputParentalVisibility.innerHTML = $("#ParentalVisibility3").val();
                outputtextParentalVisibility.innerHTML="This is the highest level of Parental Visibility. When this option is selected, the Suite notifies the parent about the detected online risk along with further information (Facebook wall, Facebook chat, Friends, Photos). The parent will receive a notification through the Parental Console regarding the malicious activity detected, along with all the additional available data. For example a notification can be: 'Your child had a conversation with (Perpetrator's name) and Cyber Safety Family Advice Suite detected Cyberbullying', and the parent will also be able to see the malicious content of the conversation.";
                ParentalVisibilityCheckBoxes.innerHTML='<div class="checkbox"><div id="error" style=" float: right; display: none; "><p style=" color: red; ">Please Select</p></div><label><input type="checkbox" name="parental" id="parental_fb_wall" value="parental_fb_wall" ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Wall</label><br><label><input type="checkbox" name="parental" id="parental_fb_friends" value="parental_fb_friends" ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Friends</label><br><label><input type="checkbox" name="parental" id="parental_fb_notifications" value="parental_fb_notifications" ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Notifications</label><br><label><input type="checkbox" name="parental" id="parental_fb_photos" value="parental_fb_photos" ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Photos</label><br><label><input type="checkbox" name="parental" id="parental_fb_about" value="parental_fb_about" ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook About</label><br><label><input type="checkbox" name="parental" id="parental_fb_chat" value="parental_fb_chat" checked><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Chat</label></div>';
                });
                });
                </script>
              </div>
              <div class="modal-footer">

                <button type="button" class="btn-change3 btn btn-primary" id="save">Save changes</button>
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
                success:function(result){
			console.log(result);
                	$("#error").css("display", "none");
                	$('#success_parental').css("display","block");
                	$('#success_parental').text('The Parental Visibility Options have successfully saved');
                	$('#success_parental').css("color","red");

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
        <h1>Back-end Visibility Level</h1><br>
        <p>Through the Back-end Visibility options, the console offers options about what the parent accepts to be sent to the Back-End of Cybersafety Family Advice Suite related to the child's online activities on Facebook. By sending this data to the Back-End, the parent can help in improving the Suite and enhancing the online protection of the minors. The options set by the parent, will be sent as a request to the child, and only after the child give his/her consent the options are applied.</p>
            <?php
            $url = $proxyencase.'/api/public/backend/options/'.$_SESSION["parent_id"].'/'.$child_id;
					 //echo $url;
				$content = file_get_contents($url, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
				$json = json_decode($content, true);
				// print_r($json);
				if ($json){
					 echo '<button class="btn-change7 btn btn-primary btn-lg" id="button_show_backend_kid" style="margin-right: 55px;">Show</button>

      <div id="show_backend_kid" style="padding: 1%;float: right; border: 1px solid #0000001a; box-shadow: grey 16px 10px 5px;display: none">';



      echo 'Backend Visibility Level: '.$json["backend_visibility_level"].'<br>';


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
					echo '<button class="btn-change7 btn btn-primary btn-lg" id="button_show_backend_kid" style="margin-right: 55px;">Show</button>

      <div id="show_backend_kid" style="padding: 1%;float: right; border: 1px solid #0000001a; box-shadow: grey 16px 10px 5px;display: none">The child has <b>not accepted</b> the<br> Parental Visibility Options yet. </div>';
				}


      ?>
      <script type="text/javascript">
        $('#button_show_backend_kid').click(function(){
   $('#show_backend_kid').toggle(300)
   if($(this).text()=== "Show"){
            $(this).text("Hide");
        }
        else{
            $(this).text("Show");
        }
});
      </script>
        <button class="btn-change7 btn btn-primary btn-lg" data-toggle="modal" data-target="#editBackend">
        Edit
        </button><br><br>
        <div class="modal fade" id="editBackend" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="opacity: unset;">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Back-end Visibility </h4>
                <p id="success_backend"></p>
              </div>
              <div class="modal-body">
                <div class="slidecontainer">
                  <div class="dgradio-sb ">
                    <input type="radio" class="dg-item" name="your-group-2" id="BackendVisibility1"  value="1" />
                    <label for="BackendVisibility1" class="dg-label dg-30"  data-caption="Level 1">
                      Level 1<span class="dg-bg"></span>
                    </label>
                    <input type="radio" class="dg-item" name="your-group-2" id="BackendVisibility2" value="2" />
                    <label for="BackendVisibility2" class="dg-label dg-60"  data-caption="Level 2">
                      Level 2<span class="dg-bg"></span>
                    </label>
                    <input type="radio" class="dg-item" name="your-group-2" id="BackendVisibility3"  value="3">
                    <label for="BackendVisibility3" class="dg-label dg-100"  data-caption="Level 3">
                      Level 3 <span class="dg-bg"></span>
                    </label>
                  </div>
                  <p class="panel">Back-end Visibility Level :
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
                  outputBackendResultText.innerHTML = "This is the lowest level of the Back-End visibility. In this option, nothing is sent to the Back-End regarding the Facebook wall, photos, notifications and friends of the child.";
                  BackendVisibilityCheckBoxes.innerHTML='';
                  });
                  $('#BackendVisibility2').click(function () {
                  outputBackendResult.innerHTML = $("#BackendVisibility2").val();
                  outputBackendResultText.innerHTML ="In this level the parent allows the console to send data to the Back-End regarding the Facebook wall, friends wall and, friends of the child. The parent will be able to select what he/she accepts to be sent. Also, the parent can choose to send the data anonymously or not.";
                  BackendVisibilityCheckBoxes.innerHTML='<div class="checkbox"><div id="error" style=" float: right; display: none; "><p style=" color: red; ">Please Select</p></div><div style=" float: right; ">Send Data :<br><label class="myradio">Anonymously <input type="radio" checked="checked" name="anonymously" value="1"> <span class="checkmark"></span> </label> <label class="myradio">Non-Anonymously <input type="radio" name="anonymously" value="0"> <span class="checkmark"></span> </label></div><label><input type="checkbox" name="backend" id="backend_fb_wall" value="backend_fb_wall"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Wall</label><br><label><input type="checkbox" name="backend" id="backend_fb_friends" value="backend_fb_friends"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Friends</label><br><label><input type="checkbox" name="backend" id="backend_fb_notifications" value="backend_fb_notifications"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Notifications</label><br><label><input type="checkbox" name="backend" id="backend_fb_photos" value="backend_fb_photos"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Photos</label><br><label><input type="checkbox" name="backend" id="backend_fb_about" value="backend_fb_about"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook About</label><br><label><input type="checkbox" name="backend" id="backend_fb_chat" value="backend_fb_chat"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Chat</label></div>';
                  });
                  $('#BackendVisibility3').click(function () {
                  outputBackendResult.innerHTML = $("#BackendVisibility3").val();
                  outputBackendResultText.innerHTML="This is the highest level of visibility. When this option is selected, it will send all the content from Level 2 plus the child's chat content. So in this Level, the parent accepts to send to the Back-end all the incoming and outgoing traffic of the child's’ Facebook wall, chat, friends and friends of friends. Additionally, he/she can choose to send content anonymously or not.";
                  BackendVisibilityCheckBoxes.innerHTML='<div class="checkbox"><div id="error" style=" float: right; display: none; "><p style=" color: red; ">Please Select</p></div><div style=" float: right; ">Send Data :<br><label class="myradio">Anonymously <input type="radio" checked="checked" name="anonymously" value="1"> <span class="checkmark"></span> </label> <label class="myradio">Non-Anonymously <input type="radio" name="anonymously" value="0"> <span class="checkmark"></span> </label></div><label><input type="checkbox" name="backend" id="backend_fb_wall" value="backend_fb_wall" ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Wall</label><br><label><input type="checkbox" name="backend" id="backend_fb_friends" value="backend_fb_friends" ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Friends</label><br><label><input type="checkbox" name="backend" id="backend_fb_notifications" value="backend_fb_notifications" ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Notifications</label><br><label><input type="checkbox" name="backend" id="backend_fb_photos" value="backend_fb_photos" ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Photos</label><br><label><input type="checkbox" name="backend" id="backend_fb_about" value="backend_fb_about" ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook About</label><br><label><input type="checkbox" name="backend" id="backend_fb_chat" value="backend_fb_chat" checked><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Facebook Chat</label></div>';
                  });
                  });
                  </script>
                </div>
                <div class="modal-footer">

                  <button type="button" class="btn-change3 btn btn-primary" id="saveBack">Save changes</button>
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
                	$('#success_backend').text('The Back-End Visibility Options have successfully saved');
                	$('#success_backend').css("color","red");


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
          <h1>Cybersafety Level</h1><br>
          <p>Through these options, the parent can select the Level of CyberSafety. These options let the parent decide what the child can see and what the Intelligent Web-Proxy will filter, replace, encrypt or, watermark respectively, regarding the child's incoming Facebook traffic. The options set by the parent will be sent as a request to the child, and only after the child give his/her consent the options are applied.</p>

          <?php
          $url = $proxyencase.'/api/public/safety/options/'.$_SESSION["parent_id"].'/'.$child_id;
					//echo $url;
				$content = file_get_contents($url, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
				$json = json_decode($content, true);
				// print_r($json);
				if ($json){
					 echo '<button class="btn-change7 btn btn-primary btn-lg" id="button_show_security_kid" style="margin-right: 55px;">Show</button>

      <div id="show_security_kid" style="padding: 1%;float: right; border: 1px solid #0000001a; box-shadow: grey 16px 10px 5px;display: none">';



      echo 'Cybersafety Level: '.$json["security_visibility_level"].'<br>';


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
					 echo '<button class="btn-change7 btn btn-primary btn-lg" id="button_show_security_kid" style="margin-right: 55px;">Show</button>

      <div id="show_security_kid" style="padding: 1%;float: right; border: 1px solid #0000001a; box-shadow: grey 16px 10px 5px;display: none">The child has <b>not accepted</b> the<br> Cybersafety Options yet. </div>';
				}
			}

    }


      ?>
      <script type="text/javascript">
        $('#button_show_security_kid').click(function(){
   $('#show_security_kid').toggle(300)
   if($(this).text()=== "Show"){
            $(this).text("Hide");
        }
        else{
            $(this).text("Show");
        }
});
      </script>
          <button class="btn-change7 btn btn-primary btn-lg" data-toggle="modal" data-target="#editSecurity">
          Edit
          </button><br><br>
          <div class="modal fade" id="editSecurity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="opacity: unset;">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">Cybersafety Level; </h4>
                  <p id="success_sec"></p>
                </div>
                <div class="modal-body">
                  <div class="slidecontainer">
                    <div class="dgradio-sb ">
                      <input type="radio" class="dg-item" name="your-group-2" id="SecurityVisibility1"  value="1" />
                      <label for="SecurityVisibility1" class="dg-label dg-50"  data-caption="Level 1">
                        Level 1<span class="dg-bg"></span>
                      </label>
                      <input type="radio" class="dg-item" name="your-group-2" id="SecurityVisibility2" value="2" />
                      <label for="SecurityVisibility2" class="dg-label dg-100"  data-caption="Level 2">
                        Level 2<span class="dg-bg"></span>
                      </label>
                    </div>
                    <p class="panel">Cybersafety Level:
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
                    outputtextSecurity.innerHTML = "This is the lowest level of cybersafety. It will only show notifications about the detected malicious activities. This means that the Intelligent Web-Proxy will detect the suspicious activity but it will not encrypt the picture or replace the text and it will only push the appropriate notifications to the browser add-on that will only warn the user about the activity detected.The parent can choose which online risks he/she wants to get notifications for.";
                    SecurityVisibilityCheckBoxes.innerHTML='<div class="checkbox"><div id="error" style=" float: right; display: none; "><p style=" color: red; ">Please Select</p></div><label><input type="checkbox" name="security" id="sexual_grooming" value="sexual_grooming"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Sexual Grooming</label><label><input type="checkbox" name="security" id="hate_speech" value="hate_speech"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Hate or inappropriate speech</label><label><input type="checkbox" name="security" id="cyberbullying" value="cyberbullying"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Cyberbullying</label><label><input type="checkbox" name="security" id="distressed_behavior" value="distressed_behavior"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Distressed Behavior </label></div>';
                    });
                    $('#SecurityVisibility2').click(function () {
                    outputSecurity.innerHTML = $("#SecurityVisibility2").val();
                    outputtextSecurity.innerHTML ="This is the highest level of Cybersafety, in this level the Suite shows notifications about the detected malicious activities to the users for all of the online risks listed below but also allows the parent to select for which risks the content will be replaced, filtered or, encrypted before it reaches the browser of the user. For example, the Suite will be able to encrypt sensitive images related to Hatespeech (if it's selected) but only notify the user about Cyberbullying detection (if it's not selected).";
                    SecurityVisibilityCheckBoxes.innerHTML='<div class="checkbox"><div id="error" style=" float: right; display: none; "><p style=" color: red; ">Please Select</p></div><label><input type="checkbox" name="security" id="sexual_grooming" value="sexual_grooming"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Sexual Grooming</label><label><input type="checkbox" name="security" id="hate_speech" value="hate_speech"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Hate or inappropriate speech</label><label><input type="checkbox" name="security" id="cyberbullying" value="cyberbullying"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Cyberbullying</label><label><input type="checkbox" name="security" id="distressed_behavior" value="distressed_behavior"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Distressed Behavior </label></div>';

                    });
                    });
                    </script>
                  </div>
                  <div class="modal-footer">

                    <button type="button" class="btn-change3 btn btn-primary" id="saveSec">Save changes</button>
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
                	$('#success_sec').text('The CyberSafety Visibility Options have successfully saved');
                	$('#success_sec').css("color","red");


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
