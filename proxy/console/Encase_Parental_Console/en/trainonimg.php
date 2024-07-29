<?php
//              ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

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
//print_r($json);
if (!file_exists('/var/www/html/console/Encase_Parental_Console/uploads/'.$json_child["child_fb_url"])) {
    mkdir('/var/www/html/console/Encase_Parental_Console/uploads/'.$json_child["child_fb_url"], 0777, true);

}
$testing_loc = '/var/www/html/console/Encase_Parental_Console/uploads/testing/';
  if (!file_exists('/var/www/html/console/Encase_Parental_Console/uploads/testing/')) {
       mkdir($testing_loc, 0777, true);
}

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $host_var.":18082/dal/ObtainImagesLoc/".$fb_url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$response = json_decode($response, true); //because of true, it's in an array

}
$imgspath = '/var/www/html/console/Encase_Parental_Console/uploads/';
$img_locs = array_diff(scandir($imgspath), array('.', '..','testing'));
$img_locs = array_values($img_locs);
$count_child = count($img_locs);

$keys = array('data_id', 'count_child', 'test_loc');

$values = array($fb_url,$count_child , $testing_loc);
$array1 = array_combine($keys, $values);

//print_r($array1);

$array2 = array();

// for example
for ($i = 0; $i <$count_child; ++$i) {
$j=$i+1;
    $array2['child_'.$j] = $imgspath.$img_locs[$i];
}
//print_r($array2);
$data_for_loizos = array_merge($array1,$array2);
//print_r(json_encode($data_for_loizos));
?>

 </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                   Help Cyber Safety Family Advice Suite detect <?php echo $json_child["child_first_name"] ?> in Online Social Networks
                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Train On Images</li>
                </ol>
            </section>


           <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
           <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
    <form enctype="multipart/form-data" action="" method="post">
                    <p>Cyber Safety Family Advice Suite can detect when <?php echo $json_child["child_first_name"] ?> is uploading a picture in Online Social Networks.</p>
                    <p>To activate this feature, you need to upload about 12 pictures of <?php echo $json_child["child_first_name"]?> using the "<i>Choose file</i>" button below.
                       Then, use the "<i>Add More Files</i>" button to upload more pictures of <?php echo $json_child["child_first_name"] ?>.</p>
                    <p>Please make sure that <?php echo $json_child["child_first_name"] ?>'s face is clearly shown in the image and that the image is of high quality.</p>
                    <hr/>
                    <div id="filediv"><input name="file[]" type="file" id="file"/></div><br/>

                    <input type="button" id="add_more" class="upload" value="Add More Files"/>
                    <input type="submit" value="Upload File" name="submit" id="upload" class="upload"/>
                </form>
                <?php
                $images_array=array();
                                if (isset($_POST['submit'])) {
    $j = 0; //Variable for indexing uploaded image

        $target_path = '/var/www/html/console/Encase_Parental_Console/uploads/'.$json_child["child_fb_url"].'/'; //Declaring Path for uploaded images
	$images_loc = $target_path;
        // print_r($images_loc);
	$xml_loc = '/var/www/html/console/Encase_Parental_Console/uploads/'.$json_child["child_fb_url"].'/xml/';

    for ($i = 0; $i < count($_FILES['file']['name']); $i++) {//loop to get individual element from the array

        $validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.)
        $file_extension = end($ext); //store extensions in the variable

        $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];//set the target path with a new name of image
        $j = $j + 1;//increment the number of uploaded images according to the files in array

          if (($_FILES["file"]["size"][$i] < 10000000000) //Approx. 100kb files can be uploaded.
                && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {//if file moved to uploads folder
                echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
//echo 'data_id: '.$fb_url.'<br>count_child : '.count($img_locs).'<br>test_loc :'.$testing_loc.'<br>';
//$count_child = count($img_locs);
//$i=1;
//$i=1; foreach($img_locs as $item) { echo 'child('.$i.'): location :'.$imgspath.$item.'<br>'; $i=$i+1; }
//print_r( $data_for_loizos);
if ($response['Images'][0]['data_id'] == $fb_url) {

}else{


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_PORT => "18082",
  CURLOPT_URL => $host_var.":18082/dal/SaveImages",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($data_for_loizos),
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: ece56d6a-842a-210d-0d8e-18aa3d799df8"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}


}
            } else {//if file was not moved.
              echo $j. ').<span id="error">please try again!.</span><br/><br/>';
   }
   } else {//if file size and file type was incorrect.
  echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
   }
   }
  }
  ?> </section>
  <!-- /.Left col -->
  <!-- right col (We are only adding the ID to make the widgets sortable)-->
<section class="col-lg-5 connectedSortable" style="float: right;width: 35.667%;">
<?php
 //include('rightsidebar.php');
$dirname = '../uploads/'.$fb_url.'/';
$images = glob($dirname."*.*");

foreach($images as $image) {
$image =  str_replace($fb_url, "to_change", $image);
$image = str_replace("to_change",urlencode($fb_url), $image);
    echo '<a href="'.$image.'" target="_blank"><img src="'.$image.'" style=" width: 250px; height: auto;border-style: solid;border-width: medium; "></a><br /><br />';

}?>
</section>
   <!-- right col -->
    </div>
<!-- /.row (main row) -->





            </section> <!-- /.content --> </div>
        <!-- /.content-wrapper -->
                      <?php include('footer.php'); ?>
