<!-- right col (We are only adding the ID to make the widgets sortable)-->
<section class="col-lg-5 connectedSortable" style="float: right;">
	<a href="register2.php" class="small-box-footer">
	<div class="small-box bg-yellow">
		<div class="inner">
			<h3 style=" white-space: inherit; ">Προσθήκη Νέου Παιδιού στην Πλατφόρμα</h3>
			<p></p>
		</div>
		<div class="icon">
			<i class="ion ion-person-add"></i>
		</div>
		
	</div>
</a>
	<!-- quick flag sidebar -->
	<div class="box box-info">
		<div class="box-header">
			<i class="fa fa-envelope"></i>
			<h3 class="box-title">Γρήγορη επισήμανση κακού κειμένου<?php if (isset($_SESSION["parent_id"])) {
$child_id = $_GET['childid'];}
// echo $child_id.'  '.$_SESSION["parent_id"];
 ?></h3>
			<!-- tools box -->
			<!-- <div class="pull-right box-tools">
				<button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
				<i class="fa fa-times"></i></button>
			</div> -->
			<!-- /. tools -->
		</div>
		<div class="box-body">
			<form action="#" method="post">
				<div class="form-group">
					<input type="email" class="form-control" name="emailto" value="info@encase" readonly style="display: none">
				</div>
				<div class="form-group">
					<p>Για ποιον λόγο : 	<select id="flag" name="flag" class="selectpicker"  multiple title="Διάλεξε από τα παρακάτω...">
						<option value="sexualgrooming">Σεξουαλική αποπλάνηση</option>
						<option value="hatespeech">Λεκτικό Μίσος ή Ανάρμοστη Ομιλία</option>
						<option value="cyberbullying">Εκφοβισμός στον Κυβερνοχώρο</option>
						<option value="distressedbehavior">Δυσχερής συμπεριφορά</option>
					</select></p>
					<!-- <input type="text" class="form-control" name="subject" placeholder="θέμα"> -->
				
				</div>
				<div><input type="text" class="form-control" id="from" name="from" placeholder="Από"></div><br>
				<div>
					<textarea class="textarea" id=message placeholder="Μήνυμα" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
				</div>
			</form>
		</div>
		<div class="box-footer clearfix">
			<button type="button" class="pull-right btn btn-default" id="sendEmail">Αποστολή
			<i class="fa fa-arrow-circle-right"></i></button>
		</div>
		<script type="text/javascript">
			$('#sendEmail').click(function () {

				alert($('#flag').val()+' From : '+$('#from').val()+ ' Message : '+$('#message').val());
			});
		</script>
	</div>
</section>
<!-- right col -->
