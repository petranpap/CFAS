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
//                                print_r($json_child['child_fb_url']);
}

?>
</aside>
<link rel="stylesheet" type="text/css" href="../dist/css/chat_new.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $json_child['child_first_name'] ?>'s Facebook chat
        </h1>
        <?php

?>
        <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Chat</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <?php
            $url_child_parental = $proxyencase.'/api/public/parental/options/'.$_SESSION["parent_id"].'/'.$child_id;
//                                         echo $url_child_parental;
                                $content_child_parental = file_get_contents($url_child_parental, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
                                $json_child_parental = json_decode($content_child_parental, true);
                                // Check if the father can see the Chat !
            if ($json_child_parental['parental_visibility_level'] == 3) {

           ?>
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
                <div class="">
                    <h3 id="fb_sender_name" class="text-center"></h3>
                    <div class="messaging">
                        <div class="inbox_msg">
                            <div class="inbox_people">
                                <div class="headind_srch">
                                    <div class="recent_heading">
                                        <h4>Recent</h4>
                                    </div>
                                    <!--<div class="srch_bar">-->
                                    <!--  <div class="stylish-input-group">-->
                                    <!--    <input type="text" class="search-bar"  placeholder="Search" >-->
                                    <!--    <span class="input-group-addon">-->
                                    <!--    <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>-->
                                    <!--    </span> </div>-->
                                    <!--</div>-->
                                </div>
                                <div class="inbox_chat">
                                    <?php

                                   // echo $_GET['sender'];

//echo $host_var;

                        $url = $host_var.':18082/dal/ObtainData/chat/fb_url/'.$json_child["child_fb_url"];
                                         //echo $url;
                                $content = file_get_contents($url, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
                                $json = json_decode($content, true);
                                //echo $_SERVER['REQUEST_URI'];

            for ($i=0; $i < count($json['Chat Logs']); $i++) {
		if ($json["Chat Logs"][$i]['sexual_detection_percent'] >= '60%'){
               echo '  <div class="chat_list active_chat">
              <div class="chat_people">
                <div class="chat_img"></div>
                <div class="chat_ib">
                  <h5><a href="?childid='.$child_id.'&date_created='.$json["Chat Logs"][$i]["date_created"].'&case_id='.$json["Chat Logs"][$i]["case_id"].'">'.$json["Chat Logs"][$i]["fb_sender_name"].'<span class="chat_date">'.$json["Chat Logs"][$i]["date_created"].'</span></a></h5>
                </div>
              </div>
            </div>';
            }
		}
            ?>
                                </div>
                            </div>
                            <div class="mesgs">
                                <div class="msg_history">
                                    <?php
            if ($_GET['date_created'] && $_GET['case_id']) {


                $url_get_chat = $host_var.':18082/dal/ObtainData/chat/date_created/'.$_GET['date_created'].'/'.$_GET['case_id'];
                $content_chat = file_get_contents($url_get_chat, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
                                $json_chat = json_decode($content_chat, true);
                                $chat_text = $json_chat['Chat Logs'][0]['text_chat'];
				$chat_text = urldecode($chat_text);
				//echo $chat_text;
                                $keywords =  preg_split("/(Child:|Predator:)/", $chat_text,-1,PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
                                // print_r($keywords);
                          echo '<script type="text/javascript">$("#fb_sender_name").text("'.$json_chat["Chat Logs"][0]["fb_sender_name"].'");</script>';

                    for ($i = 0; $i < count($keywords); $i++) {

                                        if (strpos($keywords[$i], 'Child:') !== false) {
                                         //echo $keywords[$i]."<br>".$keywords[$i+1]."<br>";
                                          echo '<div class="incoming_msg">
              <!-- <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div> -->
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p>'.$keywords[$i].'<br>'.$keywords[$i+1].'<br></p>
                  </div>
              </div>
            </div>';

                                        }
                                         if (strpos($keywords[$i], 'Predator:') !== false) {
                                        echo '<div class="outgoing_msg"> <div class="sent_msg"><p>'.$keywords[$i]."<br>".$keywords[$i+1]."<br></p></div></div>";
                                        //echo '<div class="outgoing_msg">
//             <div class="sent_msg">
//                <p>'.$keywords[$i].'<br>'.$keywords[$i+1].'<br></p>
//
//            </div>';
                                        }
                                }

            }




            ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
      // End of Check if the father can see the Chat !

          }else{
            echo ' <!-- Left col --><section class="col-lg-7 connectedSortable">'.$json_child['child_first_name'].' has not approved to monitor his/her chat</section>';

          }

            ?>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <?php include('rightsidebar.php');?>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
include('footer.php');
?>
