<?php
//                ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
include('../variable_settings/vars.php');
include('head.php');
include('menu.php');
?>
<style>

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<!--         <h1>
	Dashboard
        <small>Control panel</small>
        </h1> -->
	<ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Encase Consent Form</li>
        </ol>
</section>
<!-- Main content -->
<section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
                <!-- ./col -->
                       <h3>Quiz Results</h3>
                        <table>
  <tr>
    <th>Student Name</th>
    <th>Quiz Title</th>
    <th>Score</th>
   <th> Attempts</th> 
 </tr>
<?php
if (isset($_SESSION["parent_id"])) {


$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://proxyencase.cut.ac.cy:8090/api/public/quiz/get_grade/".$_GET['fb_url']
,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_SSL_VERIFYPEER =>false,
  CURLOPT_POSTFIELDS => "{\r\n  \"totalCores\": 36, \r\n}\r\n",
  CURLOPT_HTTPHEADER => [
    "User-Agent: Mozilla/5.0",
    "Accept: json",
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
//  echo $response;
$json = json_decode($response, true);

foreach ($json as $row) {
   echo '<tr>';
   echo '<td>'.$row["child_first_name"].' '.$row["child_last_name"].'</td>';
   echo '<td>'.$row["title"].'</td>'.'<td>'.$row["score"].'</td>';
   echo '<td>'.$row["attempt"].'</td>';
   echo '</tr>';
}
}

}
?>
 </table>
        </div>
	<!-- /.row -->
        <!-- Main row -->
        <!-- <div class="row"> -->
                <!-- Left col -->
              <!--   <section class="col-lg-7 connectedSortable">
                                </section> -->
                                <!-- /.Left col -->

                        <!-- </div> -->
                        <!-- /.row (main row) -->
                </section>
                <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php
        include('footer.php');
        ?>
