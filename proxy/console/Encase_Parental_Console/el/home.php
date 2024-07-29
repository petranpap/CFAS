<?php
//                ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
include('../variable_settings/vars.php');
include('head.php');
include('menu.php');
?>
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
	Πλατφόρμα
	<small>Πίνακας Ελέγχου</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Αρχική</a></li>
		<li class="active">Πίνακας Ελέγχου</li>
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
			<!-- Custom tabs (Charts with tabs)-->
			<div class="nav-tabs-custom" style="position: relative; height: 300px;">
				<!-- Tabs within a box -->
				<ul class="nav nav-tabs pull-right">
					<li class="pull-left header"><i class="fa fa-inbox"></i> Με μια ματιά: Δείτε τι έχουν δεχτεί τα παιδιά</li>
				</ul>


				<?php

				if (isset($_SESSION["parent_id"])) {
					$url = $proxyencase.'/api/public/parent/child/approved/'.$_SESSION["parent_id"];
					//echo $url;
				$content = file_get_contents($url, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
				if ($content!='false'){
				$json = json_decode($content, true);
				//print_r($json.count());
				// echo $json["child_fb_url"];
				foreach($json as $json) {

				echo '<div class="tab-content no-padding"> <div class="col-md-3" style="width: 40%;"> <div class="box box-default collapsed-box"> <div class="box-header with-border"><h3 id="child_name' . $json["child_first_name"].'" class="box-title">' . $json["child_first_name"].'</h3> <script type="text/javascript">var child_name' . $json["child_first_name"].'="' . $row["child_first_name"].'";document.getElementById("child_name' . $json["child_first_name"].'").innerHTML = child_name' . $row["child_first_name"].';</script><div class="box-tools pull-right"> <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i> </button> </div> <!-- /.box-tools --> </div> <!-- /.box-header --> <div class="box-body" style="display: none;border-top: 1px solid black;">Επίπεδο Γονικής ορατότητας
 : ' . $json["parental_visibility_level"].' </div> <div class="box-body" style="display: none;border-top: 1px solid black;"> Επίπεδο Ορατότητας Παρασκηνίου : ' . $json["backend_visibility_level"].' <br> </div> <div class="box-body" style="display: none;border-top: 1px solid black;"> Επίπεδο Κυβερνασφάλειας : ' . $json["security_visibility_level"].' <br></div><div class="box-body" style="display: none;border-top: 1px solid black;"><a href="options.php?childid='.$json["child_id"].'"><button type="button" class="btn btn-success">Δείτε Περισσότερα</button></a></div> <!-- /.box-body --> </div> <!-- /.box --></div>';
				}
					// echo $_SESSION["parent_id"];
					}else{
					echo '<h3 class="box-title">Tα παιδίά δεν έχουν ακόμα αποδεχθεί τις επιλογές τους στο Encase Add-on</h3>';
					}
					}

					?>

					<!-- Morris chart - Sales -->
					<!--  <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
					<div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div> -->

					<!-- /.nav-tabs-custom -->
					<!-- TO DO List -->

					<!-- /.box -->
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
