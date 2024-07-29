<?php

session_start();
include('../variable_settings/vars.php');
include('head.php');
include('menu.php');

if (isset($_SESSION["parent_id"])) {
$child_id = $_GET['childid'];
$url_child = $proxyencase.'/api/public/child/'.$child_id;
                                         //echo $url;
                                $content_child = file_get_contents($url_child, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
                                $json_child = json_decode($content_child, true);
                                // print_r($json_child['child_fb_url']);
}

?>

 </aside>

	<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?php echo $json_child['child_first_name'] ?>'s Facebook wall

                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Wall</li>
                </ol>
            </section>


           <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <?php
         $url_child_parental = $proxyencase.'/api/public/parental/options/'.$_SESSION["parent_id"].'/'.$child_id;
                                         //echo $url;
                                $content_child_parental = file_get_contents($url_child_parental, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
                                $json_child_parental = json_decode($content_child_parental, true);
                                // Check if the father can see the Wall !
            if (strpos($json_child_parental['checkbox'], 'parental_fb_wall') !== false) {

           ?>
           <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <script type="text/javascript">
            window.setInterval(function() {
    $(function() {

        $(document).ready(function() {

            $.ajax({

                method: "GET",

                url: "https://"+window.location.host+"/dist/php/getwall.php?childid=<?php echo $child_id ?>",



            }).done(function(data) {

                var result = $.parseJSON(data);

                // var button_for_chat = '';

                var string = '';

                /* from result create a string of data and append to the div */

                $.each(result, function(key, value) {



                    string += '<div id ="chat_for_' + value['child_first_name'] + value['child_last_name'] + '">' + value['fb_wall_text'] + '</div>';






                });

                string += '</ul>';
                // button_for_chat += '';

                $("#child_wall").html(string);
                // $("#button_for_chat").html(button_for_chat);


            });
        });
    });

}, 5000);
          </script>
          <div id="child_wall"></div>
</section>
	<!-- /.Left col -->
         <!-- right col (We are only adding the ID to make the widgets sortable)-->
 <?php 
include('rightsidebar.php');?>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->






            </section>
             <?php
      // End of Check if the father can see the Wall !

          }else{
            echo ' <!-- Left col --><section class="col-lg-7 connectedSortable">'.$json_child['child_first_name'].' has not approved to monitor his/her wall</section>';

          }?>
            <!-- /.content -->
        </div>
	<!-- /.content-wrapper -->

                      <?php
include('footer.php');
?>
