<?php
session_start();
include('../variable_settings/vars.php');
include('head.php');
include('menu.php');

// $conn = new mysqli($host, $username, $password, $dbname);
if (isset($_SESSION["parent_id"])) {
$child_id = $_GET['childid'];
$url_child = $proxyencase.'/api/public/child/'.$child_id;
                                         //echo $url;
                                $content_child =file_get_contents($url_child, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
                                $json_child = json_decode($content_child, true);
//print_r($json_child);
$fb_url=$json_child["child_fb_url"];
//echo $fb_url;
$url_blocked_sites = $host_var.':18082/dal/GetSettings/'.urlencode($fb_url);
//echo $url_blocked_sites;
$content_blocked_sites = file_get_contents($url_blocked_sites, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
$json_blocked_sites = json_decode($content_blocked_sites, true);
//print_r($json_blocked_sites);

}

?>

 </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                   Ρυθμίσεις Κοινωνικών Δικτύων για <?php echo $_SESSION["child_first_name"] ?>

                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Ρυθμίσεις κοινωνικών μέσων</li>
                </ol>
            </section>


           <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
           <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
	<h2>Αποκλείστε ανεπιθύμητες τοποθεσίες</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Ιστοσελίδες</th>
        <th>Αποκλεισμένες</th>
      </tr>
    </thead>
    <tbody>
       <tr>
        <td>Όλες</td>
        <td><button class="btn btn-danger" onclick="blockall()">Αποκελισμός Όλων </button></td>
      </tr>
      <tr>
        <td>Facebook</td>
        <td><input type="checkbox" name="type" id="toggle-fb" value="https://www.facebook.com/"></td>
      </tr>
      <tr>
        <td>Twitter</td>
        <td><input type="checkbox" name="type" id="toggle-twitter" value="https://twitter.com/"></td>
      </tr>
      <tr>
       <td>Instagram</td>
       <td><input type="checkbox" name="type" id="toggle-insta" value="https://www.instagram.com/"></td>
      </tr>
      <tr>
        <td>GAB</td>
        <td><input type="checkbox" name="type" id="toggle-gab" value="https://gab.com/"></td>
      </tr>
      <tr>
        <td>Snapchat</td>
        <td><input type="checkbox" name="type" id="toggle-snap" value="https://www.snapchat.com/"></td>
      </tr>
      <tr>
      <td>4Chan</td>
      <td><input type="checkbox" name="type" id="toggle-4chan" value="https://www.4chan.org/"></td>
      </tr>
        <tr>
      <td>Reddit</td>
      <td><input type="checkbox" name="type" id="toggle-reddit" value="https://www.reddit.com/"></td>
      </tr>
       <tr>
      <td>Adult Sites</td>
      <td><input type="checkbox" name="type" id="toggle-adult" value="adult"></td>
      </tr>
    </tbody>
</table>
<button type="button" class="btn btn-success" id="send_settings">Αποθήκευση</button>

<script>
  function blockall() {
    $('#toggle-all,#toggle-fb,#toggle-twitter,#toggle-insta,#toggle-gab,#toggle-snap,#toggle-4chan,#toggle-reddit,#toggle-adult').bootstrapToggle('on')
  }
777
<?php

foreach ($json_blocked_sites as $value) {
foreach ($value as $values) {
$values[blocked_sites] = '[value="'.$values[blocked_sites].'"]';

    echo "$('input[type=checkbox]".$values[blocked_sites]."').bootstrapToggle('on');";
}
}

?>


  $(function() {

//    $('#toggle-all,#toggle-fb,#toggle-twitter,#toggle-insta,#toggle-gab,#toggle-snap,#toggle-4chan,#toggle-reddit,#toggle-adult').bootstrapToggle({
	$('input[type=checkbox]').bootstrapToggle({
      on: 'Ναι',
      off: 'Όχι'
    });
  })


$("#send_settings").click(function(){
var array = [];
$("input:checkbox[name=type]:checked").each(function(){
    array.push($(this).val());
});
if (array.length ===0) {
  var json_data = '[{"fb_url":"<?php echo $fb_url ?>","blocked_sites": ""}]';
}else{
$.each(array, function (index, value) {
array[index] = '{"fb_url":'+'"<?php echo $fb_url ?>"'+',"blocked_sites": '+'"'+value+'"}';
// console.log();
});
var json_data = '['+array.join(", ")+']';
}
//Send data to MondoDB

var settings = {
  "async": true,
  "crossDomain": true,
  "url": window.location.origin+"/proxy_api/php/socialmediasettingstomongo.php",
  "method": "POST",
  "headers": {
    "Content-Type": "application/json",
    "cache-control": "no-cache",
    "Postman-Token": "c69e10fe-6d94-4b44-914d-28841f74b757"
  },
  "processData": false,
  "data": json_data
}

$.ajax(settings).done(function (response) {
//console.log(response);
location.reload();

});
});
</script>

</section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
<section class="col-lg-5 connectedSortable" style="position: fixed;float: right;margin-left: 55%;font-size: large;">
           <p>Μπορείτε να αναφέρετε κάποιο περιστατικό στους παρακάτω οργανισμούς</p>
           <p>CyberSafety Cyprus: <a href="https://www.cybersafety.cy/">www.cybersafety.cy</a></p>
           <p>ESafe Cyprus: <a href="https://www.esafecyprus.ac.cy/">www.esafecyprus.ac.cy</a></p>
           <p>Internet Safety Cyprus: <a href="https://internetsafety.pi.ac.cy/">www.internetsafety.pi.ac.cy</a></p>
           <p>Γραμμή βοήθειας Helpline - 1480</p>
        </section>
<!-- right col -->
      </div>
      <!-- /.row (main row) -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
<?php include('footer.php'); ?>
