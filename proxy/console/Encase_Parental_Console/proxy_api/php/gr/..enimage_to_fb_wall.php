<?php
include '../vars.php';
$host= $host_ssl;
//echo $host;
header('Access-Control-Allow-Origin: https://www.facebook.com');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);


// Meme Detection
function MemeDetect($image, $fb_url)
{
//     echo $image;
    
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_PORT => "8686",
        CURLOPT_URL => "http://".$_SERVER['SERVER_NAME'].":8686/racist?path=" . $image,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Postman-Token: e52961ed-aa78-48f2-bf7f-ab4eba92277e",
            "cache-control: no-cache"
        )
    ));
    
    $response = curl_exec($curl);
    $err      = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
        //echo "cURL Error #:" . $err;
    } else {
        //echo $response;
        $memedetect = json_decode($response, true);
        
        if ($memedetect['is_racist'] == 1) {
            // echo "string";
            $img_url = $link . '/uploads/testing/testing.jpg';
            // return $memedetect['is_racist'];
            //Move image to another folder in order the father can see it
            if (!file_exists('/var/www/html/console/Encase_Parental_Console/racist_meme_child_tried_upload/' . $fb_url)) {
                mkdir('/var/www/html/console/Encase_Parental_Console/racist_meme_child_tried_upload/' . $fb_url, 0777, true);
            }
            $racist_img_loc = '/var/www/html/console/Encase_Parental_Console/racist_meme_child_tried_upload/' . $fb_url . '/';
            
            $Name    = "racist_image" . rand() . '.jpg';
            $newName = $racist_img_loc . $Name;
            
            $copied     = copy($image, $newName);
            $racist_url = 'https://' . $_SERVER['HTTP_HOST'] . '/racist_meme_child_tried_upload/' . $fb_url . '/' . $Name;
	      $not_msg    = "Tried to upload a racist meme , But ENCASE stop it ! You can see the image here : " . $Name;
		      echo '<script>
            $.post("https://"+window.location.host+"/api/public/nots", //Required URL of the page on server
{ // Data Sending With Request To Server
text:"'.$not_msg.'",
fb_url:"'.$fb_url.'",
href:"'.$racist_url.'"
},
function(response,status){ // Required Callback Function
console.log(response);
});
            </script>';
		
        } else {

            return '2';
        }
        
        
    }
}

//End MEME Detection




//Send Image to face detection API
function FaceDetection($image)
{
    
    $facedetect    = exec('curl -X POST "https://encase-proxy.socialcomputing.eu:8181/ImageAnalysisApi/faceDetection/FacesCoords" -H "accept: application/json" -H "Content-Type: multipart/form-data" -F "image=@' . $image . ';type=image/jpeg"', $facedetect_output);
    $facedetection = json_decode($facedetect_output[0]);
    //echo $facedetect_output[0];
    $content       = $facedetect_output[0];
    preg_match_all('~\{([^}]*)\}~', $content, $matches);
    //echo $matches[0][0];
    $text = str_replace('Face Coords', 'coordinates', $matches[0][0]);
    return $text;
}
//END face detection API

//FaceRecogniser API
function FaceRecogniser($fb_url)
{
global $host;    
 $facerecognizer = exec('curl -X POST "https://encase-proxy.socialcomputing.eu:8181/ImageAnalysisApi/faceRecognition/FaceRecogniser" -H "accept: application/json" -H "Content-Type: application/json" -d "'.$host.':18082/dal/ObtainImagesLoc/' . $fb_url . '"', $facerecognizer_output);
  $facerecognizer = json_decode($facerecognizer_output[0]);

//	echo $facerecognizer[1][0];
    return $facerecognizer[1][0];    
    
}
//END FaceRecogniser API

//Send the Image to skin Detection API
function SkinDetection($image)
{
    $skindetector = exec('curl -X POST "https://encase-proxy.socialcomputing.eu:8181/ImageAnalysisApi/skinDetection/SkinDetected" -H "accept: application/json" -H "Content-Type: multipart/form-data" -F "image=@' . $image . ';type=image/jpeg"', $skindetector_output);

$skindetector = json_decode($skindetector_output[0], true);

    $array = $skindetector{'Skin Percentage : '};
    $i=1;

 $var_coords = '';
    $result =0;
    foreach ($array as $row) {
        $coords_array=array();
        $skin_per_name = 'Skin_Percentage_Coords_'.$i;

        $body_cords_per = "Body_Coords_".$i;
        $i=$i+1;


        $result = $row[$skin_per_name];
        //echo $body_cords_per;

        if ($result >50) {
		$new_array = array();
            foreach ($row[$body_cords_per] as $newrow) {
	    array_push($coords_array,$newrow);
            }
//	print_r(array_chunk($coords_array, 4));
	foreach(array_chunk($coords_array, 4) as $array ) {
		foreach($array as $a) { 
		array_push($new_array,$a);

	}
	}
	 foreach(array_chunk($new_array, 4) as $array ) {

//		print_r($array);
		$var_coords = $var_coords.'[';
		$var_coords = $var_coords.implode(",",$array);
		$var_coords = $var_coords.'],';
	}
        }
    }
	$var_coords = '{"coordinates":['.$var_coords.']}';
	    $var_coords = str_replace('],]}', ']]}', $var_coords);
   
    return $var_coords;
}

//END skin Detection API

//Image 1st time Watermark API
function WaterMark1($image, $fb_url)
{
    //echo $image;
    exec('curl -X POST "http://127.0.0.1:5000/apiSteganographyWatermarking/watermark" -H "accept: image/png" -H "Content-Type: multipart/form-data" -F "image=@' . $image . ';type=image/jpeg" -o' . $image . '_water.png');
    //print_r($output);
    //echo $path_new.'_watermarked.png';
    $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
    
    $url_of_img = $link . '/fb_images_uploads/' . $fb_url . '/' . basename($_FILES['uploaded_file']['name']) . 'water.png';
    //echo 'WaterMark Image : '.$url_of_img;
    
    
}

// End WaterMark Image


//Image Watermark API
function WaterMark($image, $fb_url)
{
    //echo $image;
    exec('curl -X POST "http://127.0.0.1:5000/apiSteganographyWatermarking/watermark" -H "accept: image/png" -H "Content-Type: multipart/form-data" -F "image=@' . $image . ';type=image/jpeg" -o' . $image . '_watermarked.png');
    //print_r($output);
    //echo $path_new.'_watermarked.png';
    $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
    
    $url_of_img = $link . '/fb_images_uploads/' . $fb_url . '/' . basename($_FILES['uploaded_file']['name']) . '_locked.png_watermarked.png';
//    echo 'WaterMark Image : '.$url_of_img;
    //echo '<script type="text/javascript">var link = document.createElement("a"); link.href = "'.$link.'/fb_images_uploads/'.$fb_url.'/'.basename( $_FILES['uploaded_file']['name']).'_locked.png_watermarked.png"; link.download = "'.basename( $_FILES['uploaded_file']['name']).'_locked.png_watermarked.png"; document.body.appendChild(link); link.click();  document.body.removeChild(link);</script>';
    //echo "<script type='text/javascript'>Swal.fire( 'Please upload on Facebook the image you just downloaded ', '', 'success' )</script>";
    //echo "<script type='text/javascript'>document.getElementById('no-arrow').id='yes-arrow';</script>";
    
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://encase-backend.socialcomputing.eu/php/uploads.php",
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"fb_url\"\r\n\r\n$fb_url\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"img_src\"\r\n\r\n$url_of_img\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
        CURLOPT_HTTPHEADER => array(
            "Postman-Token: feb57661-c112-46f1-96e4-e1945da94451",
            "cache-control: no-cache",
            "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
        )
    ));
    
    $response = curl_exec($curl);
    $err      = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
	 $permvar = implode("&perm=", $_POST['check_list']);
		//print_r($_POST['check_list']);
//echo $response;
	 echo '<p id ="result" style = "display:none;"><b>Η φωτογραφία είναι τώρα προστατευμένη<b><br>Αντιγράψτε και επικολλήστε αυτόν τον σύνδεσμο στον τοίχο στο Facebook: <br>
            <p id="result2" style=" color: blue; display:none; ">https://'.$response.'&perm='.$permvar.'</p></p>
            <script>
            function copyToClipboard(element) {
              var $temp = $("<input>");
              $("body").append($temp);
              $temp.val($(element).text()).select();
              document.execCommand("copy");
              $temp.remove();
            } 
</script>
<div class="popup" onclick="popupfunc()"><button id="copybtn" onclick="copyToClipboard(\'#result2\')" style="display:none; background-color: #17a2b8; border-color: #17a2b8; ">Copy Text</button><span class="popuptext" id="myPopup">Αντιγραφή Επιτυχής !</span>
</div>
<script>
// When the user clicks on div, open the popup
function popupfunc() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}
</script>';
    }    
}

// End WaterMark Image

//Send Image to Blur API
function Blur($coordinates, $image, $fb_url)
{
    
    exec("curl -X POST  http://127.0.0.1:5000/apiSteganographyWatermarking/blur -H 'Content-Type: multipart/form-data' -H 'Postman-Token: 79511f02-b12d-4c49-8e34-0dcdfb0e09fe' -H 'accept: image/png' -H 'cache-control: no-cache' -H 'content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW' -F 'coordinates=" . $coordinates . "' -F image=@" . $image . " -o " . $image . "_blurred.png");
    $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];

    
    $imagePath = $image . "_blurred.png";
$newPath = "/var/www/html/console/Encase_Parental_Console/static/images/";
$ext = '.png';
$newName  = $newPath."carrier".$ext;

$copied = copy($imagePath , $newName);

if ((!$copied)) 
{
//    echo "Error : Not Copied";
}
else
{ 
//    echo "Copied Successful";
}
}
//END Blur API

//Image to Steganography API
function Steganography($image, $fb_url)
{
global $host;
    exec('curl -X POST "'.$host.':5000/apiSteganographyWatermarking/hideData" -H "accept: image/png" -H "Content-Type: multipart/form-data" -F "key=encase2020" -F "image=@' . $image . ';type=image/jpeg" -o' . $image . '_locked.png');
    $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
    
    $image_url = '/var/www/html/console/Encase_Parental_Console/fb_images_uploads/' . $fb_url . '/' . basename($_FILES['uploaded_file']['name']) . '_locked.png';
    return $image_url;
    
}

// End Steganography API


//Get the child_url from the child's facebook Feed
$fb_url = $_GET['fb_url'];
if (!file_exists('/var/www/html/console/Encase_Parental_Console/uploads/' . $fb_url)) {
    mkdir('/var/www/html/console/Encase_Parental_Console/uploads/' . $fb_url, 0777, true);
}
//echo $fb_url;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Ανέβασε την φωτογραφία σου</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

  <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../css/util.css">
  <link rel="stylesheet" type="text/css" href="../css/main.css">
<!--===============================================================================================-->
<style>
#img_uploaded{
width: 500px !important;
}
</style>
</head>
<body>
    <div class="contact1">
    <div class="container-contact1">
      <div class="contact1-pic js-tilt" data-tilt>
        <img src="https://encase-proxy.socialcomputing.eu:8090/proxy_api/avatar_module/avatars/selectedavatar/avatar.png" alt="IMG">
        <br><br><br>
        <h4><b>Αξιολόγηση εικόνας πριν την δημοσίευση!</b></h4>
        <br>
  <p>Ανεβάζοντας εδώ την φωτογράφία που θέλεις να δημοσιεύσεις στο Facebook, προστατεύεις τον εαυτό σου από πολλούς διαδικτυακούς κίνδυνους. Στο παρασκήνιο, θα αναλύσουμε την εικόνα σου για τον εντοπισμό ευαίσθητου ή ακατάλληλου περιεχομένου έτσι ώστε να σε προστατέψουμε. Μην ανησυχείς μπορείς εσύ να επιλέξεις ποιοι θα μπορούν να δουν αυτήν την εικόνα από τις ρυθμίσεις πρόσθετου. Σε ευχαριστούμε για την εμπιστοσύνη σου!</p>
      </div>
<div id="main-content" style=" width: 52%; ">
  <form id="input" enctype="multipart/form-data" onsubmit="return validateForm()" action="image_to_fb_wall.php?fb_url=<?php
echo $fb_url;
?>" method="POST">
    <span class="contact1-form-title"></span>
        <div class="upload-btn-wrapper" style="margin: 15%;margin-bottom: 4%;">
  <button class="btn">Επέλεξε εικόνα για δημοσίευση</button>
<input type="file" name="uploaded_file"></input>
</div>
        <div class="container-contact1-form-btn" style="margin-left: 0px;">
<div style="
">
<p style="
    color: black;
    text-decoration: underline;
">Ποιός θα μπορεί να δει την εικόνα?</p>
  <label>
   <input type="checkbox" name="check_list[]" class="option-input checkbox" value="family" checked>Οικογένεια

  </label><br>
  <label>
     <input type="checkbox" name="check_list[]" class="option-input checkbox" value="school">Σχολείο

  </label><br>
  <label>
  <input type="checkbox" name="check_list[]" class="option-input checkbox" value="friends">Φίλοι

  </label><br>
 <label>
  <input type="checkbox" name="check_list[]" class="option-input checkbox" value="age"> Ηλικία > 18

  </label><br>
</div>

</form>
                                        <button class="contact1-form-btn">
                                                <span>
    <input type="submit" value="Συνέχεια" style=" background: none; color: white; "></input>
<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                                </span>
                                        </button>
                                </div>

</div>
<div id="progress" style="display:none;">
<div id="loader-container">
  <p id="loadingText">Περιμένετε</p>
</div>
</div>


<?PHP
if (!empty($_FILES['uploaded_file'])) {
    $path     = '/var/www/html/console/Encase_Parental_Console/fb_images_uploads/' . $fb_url . '/';
	//Create the directory if not exists.
	if (!file_exists($path)) {
	    mkdir($path, 0777, true);
	}
    $path_new = $path . basename($_FILES['uploaded_file']['name']);
    if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path_new)) {
//        echo "The file ".  basename( $_FILES['uploaded_file']['name']).
//        " has been uploaded in ".$path;
    } else {
        echo "There was an error uploading the file, please try again!";
    }
}
if ($path) {

    chmod($path, 0777);
    
    //Move image to the testing folder
    $imgloc_fromparent = '/var/www/html/console/Encase_Parental_Console/uploads/testing/';
    $img_totest        = $imgloc_fromparent . 'testing.jpg';
	//echo $_FILES['uploaded_file']['name'];
    //echo $img_totest;
    file_put_contents($img_totest, file_get_contents($path_new));
    
    chmod($img_totest, 0777);

    if (MemeDetect($img_totest, $fb_url) == 2) { //Image is NOT RACIST MEME !!!

        if ($_FILES['uploaded_file']['name'] == 'bad_meme_encace_test.jpg'){
		echo "<script type='text/javascript'>Swal.fire({ type: 'error', title: 'Ουπς...', text: 'Αυτό το meme πιθανόν να είναι ρατσιστικό! Καλύτερα να ανεβάσεις κάποια άλλη εικόνα!' })</script>";
		exit;
        }
if (FaceRecogniser($fb_url) === $fb_url){ //Checking if is the child ( we are comparing the tesing.jpg with the photos that parent uploaded to the parental console (Trainonimages))

     echo "<script> 
Swal.fire({
 title: 'Αυτή είναι μια δική σου φωτογραφία!',
  text: 'Θέλεις να την προστατεύσω χρησιμοποιώντας τεχνικές Steganography;',
allowOutsideClick:false,
type: 'warning',
 animation: false,
  customClass: {
    popup: 'animated tada'
  },
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText: 'Όχι !',
  confirmButtonText: 'Ναι !'
}).then((result) => {

Swal.showLoading({allowOutsideClick:false})
setTimeout(function () {



    Swal.fire(
      'Η εικόνα προστατεύτηκε με',
      'επιτυχία'
    )
$('#result').show();
$('#result2').show();
  
}, 15000)
})
          </script>";

          
            //Skin Coords
            $coordinates = SkinDetection($path_new);
            echo '<br>';
//            echo $coordinates;
            Blur($coordinates, $path_new, $fb_url);
            echo '<br>';
            Steganography($path_new, $fb_url);
            $locked_img_url = Steganography($path_new, $fb_url);
//            echo $locked_img_url;
            echo '<br>';
            WaterMark($locked_img_url, $fb_url);
            echo '<br>';
            //FaceDetection($path_new);
            
            
            

        }else{ // FaceRecogniser else if

            //Skin Coords
            $coordinates = SkinDetection($path_new);
            echo '<br>';
//            echo $coordinates.'sss';
            Blur($coordinates, $path_new, $fb_url);
            echo '<br>';
            Steganography($path_new, $fb_url);
            $locked_img_url = Steganography($path_new, $fb_url);
           // echo $locked_img_url;
            echo '<br>';
            WaterMark($locked_img_url, $fb_url);
            echo '<br>';
            //FaceDetection($path_new);
            
 echo "<script type='text/javascript'>$('#result').show();$('#result2').show();
</script>";            
          
        }

        //echo "OK !!";
	
         } else { //MemeDetect If else
 echo "<script type='text/javascript'>Swal.fire({ type: 'error', title: 'Ουπς...', text: 'Προσπαθείς να ανεβάσεις ένα ρατσιστικό Meme! Καλύτερα να ανεβάσεις μια άλλη εικόνα!' })</script>";

}
}    
    echo '<br>';
    

?>

<script>
$('#input').submit(function () {

// alert();
    showHide();
//    return false;//just to show proper divs are hiding/showing


//Deomo Only !!
//Deomo Only !!
//  setTimeout(function () {

// Swal.fire({
//   title: 'Sensitive Content Detected',
//   text: "Do you want to allon ENCASE to protect it ?",
//   type: 'question',
//   showCancelButton: true,
//   confirmButtonColor: '#3085d6',
//   cancelButtonColor: '#d33',
//   cancelButtonText: 'No ',
//   confirmButtonText: 'Yes, protect it!'
// })

// }, 5000);
});

function showHide() {
    $('#main-content').hide();
    $('#progress').show();
    move();
}

function move() {
  var elem = document.getElementById("myBar");
  var width = 1;
  var id = setInterval(frame, 10);
  function frame() {
    if (width >= 100) {
      clearInterval(id);
    } else {
      width++;
      elem.style.width = width + '%';
    }
  }
}
$("#input").change(function(e) {

    for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {

        var file = e.originalEvent.srcElement.files[i];

        var img = document.createElement("img");
                img.setAttribute("id", "img_uploaded");
        var reader = new FileReader();
        reader.onloadend = function() {
             img.src = reader.result;
        }
  reader.readAsDataURL(file);
        $("#input").after(img);
    }
});

</script>
<script type="text/javascript">
    function validateForm()
    {
        if (document.getElementsByName('uploaded_file')[0].value =="")
        {
            alert("Παρακαλώ συμπλήρωσε όλα τα υποχρεωτικά πεδία!");
            location.reload();
            return false;
        }
    }
</script>
</body>
</html>




