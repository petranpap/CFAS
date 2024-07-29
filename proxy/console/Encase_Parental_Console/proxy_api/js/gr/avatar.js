$(window).on('load', function() {
if(window.location.href.indexOf("proxyencase.cut.ac.cy") > -1) {
return false;
}
//alert(fb_url);
function insertAfter(el, referenceNode) {
    referenceNode.parentNode.insertBefore(el, referenceNode.nextSibling);
}

// Main Gurdian Avatar Div
 var body = document.getElementsByTagName('body')[0],
 gavatar = document.createElement("div");
 gavatar.style.position="fixed";
gavatar.style.top="55";
gavatar.style.zIndex="10000";
gavatar.style.width="150px";
gavatar.style.height="150px";
gavatar.id = 'gavatar';  //add an id
 body.insertBefore(gavatar,body.firstChild) //insert it
      //Create the avatar Div
      var gavatar = document.getElementById("gavatar"),
            avatar = document.createElement("div"); //create a div
                avatar.style.position="fixed";
                avatar.style.top="55%";
                // avatar.style.right="0";
                avatar.style.display="none";
                avatar.style.zIndex="10000";
                avatar.style.width="150px";
                avatar.style.height="150px";
                avatar.style.marginLeft="100px";
                avatar.id = 'avatar';  //add an id
                  gavatar.insertBefore(avatar,gavatar.firstChild) //insert it
                  
// Create the bubble
var avatar = document.getElementById("avatar"),
speech_bubble=document.createElement("hgroup");
speech_bubble.className="speech-bubble";
speech_bubble.id="speech-bubble";
avatar.insertBefore(speech_bubble,avatar.firstChild);
// Create the text inside the bubble
var speech_bubble = document.getElementsByClassName("speech-bubble")[0];
speech_bubble_text = document.createElement("p");
speech_bubble_text.id="speech_bubble_text";
speech_bubble_text.innerText="";
speech_bubble.insertBefore(speech_bubble_text,speech_bubble.firstChild);

  
      //     // cREATE THE CLOSE BUTTON
          var speech_bubble = document.getElementsByClassName("speech-bubble")[0],
        spanavatar = document.createElement("button");
        spanavatar.className="close_avatartxt";
                spanavatar.innerText="X";
        insertAfter(spanavatar, speech_bubble_text);

        // avatar.insertBefore(spanavatar,avatar.firstChild)
  
      // Avatar Image
      var avatar = document.getElementById("avatar");
    avatarimg = document.createElement("IMG"); //create a div
        avatarimg.setAttribute("src", "https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/avatars/boy-1/200829772.png");
        avatarimg.setAttribute("alt", "avatarimg");   
              avatarimg.style.position="fixed";
              // avatarimg.style.right="0";
              avatarimg.style.zIndex="10000";
              avatarimg.style.width="50px";
              avatarimg.style.height="50px";
              avatarimg.style.top="79%";
              avatarimg.style.background="#4ecaf7";
              avatarimg.style.cursor = "cell";
              avatarimg.style.border="1px solid black";
              avatarimg.style.borderRadius="25%";
          avatarimg.style.padding="10px";
              avatarimg.id = 'avatarimg';  //add an id
    
insertAfter(avatarimg, avatar);

// Return Position of Avatar
var body = document.getElementsByTagName('body')[0],
 avatar_return = document.createElement("div");

avatar_return.id = 'avatar_return';  //add an id
 body.insertBefore(avatar_return,body.firstChild) //insert it

document.getElementById("avatarimg").addEventListener("click", multiple_avatar);

document.getElementsByClassName("close_avatartxt")[0].addEventListener("click",close_ballon_text);

      function close_appear_ballon_text() {
        var x = document.getElementById("speech-bubble");
        if (x.style.display == "none") {
          x.style.display = "block";
        } 
        else {
          x.style.display = "none";
        }
      }
 function multiple_avatar(){
        
        if (document.getElementsByClassName("cyberavatar").length<3){
          // close_ballon_text();
          var x =document.getElementById("avatar");
           if (x.style.display == "none") {
          x.style.display = "block";
        } 
//Help Img  
      var avatar_img = document.getElementById('avatarimg');
        var avatar_img_1 = document.createElement("IMG"); //create a div
        avatar_img_1.setAttribute("src","https://proxyencase.cut.ac.cy:8090//proxy_api/avatar_module/images/help.png");
        avatar_img_1.setAttribute("alt", "helpimg"); 
        avatar_img_1.style.display="block";  
        avatar_img_1.style.position="fixed";
        // avatar_img_1.style.right="0";
        avatar_img_1.style.zIndex="10000";
        avatar_img_1.style.width="50px";
        avatar_img_1.style.height="50px";
        avatar_img_1.style.top="13%";
        avatar_img_1.style.background="rgb(71 79 112)";
        avatar_img_1.style.borderRadius="25%";
        avatar_img_1.style.cursor = "cell";
        // avatar_img_1.style.border="1px solid black";
        avatar_img_1.style.transition = "all 2s";
    avatar_img_1.style.padding="10px";
        avatar_img_1.onclick = function() {
    window.open('https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/en/edu/report_help_page.html', '_blank');
};
        avatar_img_1.id = 'avatarimg-1';  //add an id
        avatar_img_1.classList.add("cyberavatar");
//        insertAfter(avatar_img_1, avatar_img);
        document.body.appendChild(avatar_img_1);
  

  // Edu IMG
        var avatar_img = document.getElementById('avatarimg');
        var avatar_img0 = document.createElement("IMG"); //create a div
        avatar_img0.setAttribute("src", "https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/images/edu_new.png");
        avatar_img0.setAttribute("alt", "avatarimg"); 
        avatar_img0.style.display="block";  
        avatar_img0.style.position="fixed";
        // avatar_img0.style.right="0";
        avatar_img0.style.zIndex="10000";
        avatar_img0.style.width="50px";
        avatar_img0.style.height="50px";
        avatar_img0.style.top="26%";
        avatar_img0.style.background="rgb(255 199 38)";
        avatar_img0.style.borderRadius="25%";
        avatar_img0.style.cursor = "cell";
        // avatar_img0.style.border="1px solid black";
        avatar_img0.style.transition = "all 2s";
        avatar_img0.style.padding="10px";
        avatar_img0.onclick = function() {
    window.open('https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/en/edu/edu_main.php?fb_url='+fb_url, '_blank');
};
        avatar_img0.id = 'avatarimg0';  //add an id
        avatar_img0.classList.add("cyberavatar");
//        insertAfter(avatar_img0, avatar_img);
        document.body.appendChild(avatar_img0);


        // Settings IMG
        var avatar_img = document.getElementById('avatarimg');
        var avatar_img1 = document.createElement("IMG"); //create a div
        avatar_img1.setAttribute("src", "https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/images/set.png");
        avatar_img1.setAttribute("alt", "avatarimg"); 
        avatar_img1.style.display="block";  
        avatar_img1.style.position="fixed";
        // avatar_img1.style.right="0";
        avatar_img1.style.zIndex="10000";
        avatar_img1.style.width="50px";
        avatar_img1.style.height="50px";
        avatar_img1.style.top="39%";
        avatar_img1.style.background="#c0c0c0";
        avatar_img1.style.borderRadius="25%";
        avatar_img1.style.cursor = "cell";
        // avatar_img1.style.border="1px solid black";
        avatar_img1.style.transition = "all 2s";
    avatar_img1.style.padding="10px";
        avatar_img1.onclick = function() {
    window.open('https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/gr/options/index.php?fb_url='+fb_url, '_blank');
};
        avatar_img1.id = 'avatarimg1';  //add an id
        avatar_img1.classList.add("cyberavatar");
//        insertAfter(avatar_img1, avatar_img);
        document.body.appendChild(avatar_img1);
        
        // Notifications IMG
        var avatar_img1 = document.getElementById('avatarimg1');
        var avatar_img2 = document.createElement("IMG"); //create a div
        avatar_img2.setAttribute("src", "https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/images/notifications.png");
        avatar_img2.setAttribute("alt", "avatarimg"); 
        avatar_img2.style.display="block";    
        avatar_img2.style.position="fixed";
        // avatar_img2.style.right="0";
        avatar_img2.style.zIndex="10000";
        avatar_img2.style.width="50px";
        avatar_img2.style.height="50px";
        avatar_img2.style.top="52%";
        avatar_img2.style.background="rgb(255 3 53)";
        avatar_img2.style.borderRadius="25%";
        avatar_img2.style.cursor = "cell";
       avatar_img2.style.padding="10px";
        // avatar_img2.style.border="1px solid black";
        avatar_img2.style.transition = "all 2s";
          avatar_img2.onclick = function() {
    window.open('https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/gr/notifications/index.php?fb_url='+fb_url, '_blank');
};
        avatar_img2.id = 'avatarimg2';  //add an id
        avatar_img2.classList.add("cyberavatar");
//        insertAfter(avatar_img2, avatar_img);
        document.body.appendChild(avatar_img2);
        
        // Info IMG
        var avatar_img2 = document.getElementById('avatarimg2');
        var avatar_img3 = document.createElement("IMG"); //create a div
        avatar_img3.setAttribute("src", "https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/images/info.png");
        avatar_img3.setAttribute("alt", "avatarimg");   
        avatar_img3.style.display="block";  
        avatar_img3.style.position="fixed";
        // avatar_img3.style.right="0";
        avatar_img3.style.zIndex="10000";
        avatar_img3.style.width="50px";
        avatar_img3.style.height="50px";
        avatar_img3.style.top="65%";
        avatar_img3.style.cursor = "cell";
        avatar_img3.style.background="rgb(76 175 80)";
        avatar_img3.style.borderRadius="25%";
        // avatar_img3.style.border="1px solid black";
        avatar_img3.style.transitionDelay = "15s";
        avatar_img3.style.padding="10px";
         avatar_img3.onclick = function() {
    window.open('https://www.cybersafety.cy/', '_blank');
};
        avatar_img3.id = 'avatarimg3';  //add an id
        avatar_img3.classList.add("cyberavatar");
        //insertAfter(avatar_img3, avatar_img2);
        document.body.appendChild(avatar_img3);
      }else{
        Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}
NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
    for(var i = this.length - 1; i >= 0; i--) {
        if(this[i] && this[i].parentElement) {
            this[i].parentElement.removeChild(this[i]);
        }
    }
}

document.getElementsByClassName("cyberavatar").remove();
      }
        
      }
      function close_ballon_text() {
  insertAfter(document.getElementById("gavatar"), document.getElementById("avatar_return"));
$("#avatar").css("top","55%")
$("#avatarimg").css("top","79%")
        var x =document.getElementById("avatar");
           if (x.style.display == "none") {
          x.style.display = "block";
        } 
        else {
          x.style.display = "none";
        }
if(document.getElementById("speech_bubble_text").innerText===""){
document.getElementById("avatar").style.display="none"
}
      }       

      // Get Behaviors from mongo

 function get_twitter_behavior() {
            var settings = {
                "url":  host_ssl+"dal/ObtainData/twitter/0",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings).done(function(responseJSON) {
                var json_behavior = responseJSON;
                var json_data_behavior = json_behavior["Twitter_Names"];

                for (var i = 0; i < json_data_behavior.length; i++) {
      if(json_data_behavior[i]["screen_name"]!=="home"){
                    document.getElementById('speech_bubble_text').innerText = 'Νομίζω  ότι ο λογαριασμός : ' + json_data_behavior[i]["screen_name"] + ' στο Twitter είναι ' + json_data_behavior[i]["behavior"];
      document.getElementById("avatar").style.display="block";      
      }
                    update_twitter_behavior(json_data_behavior[i]["_id"]["$oid"]);
      

                }
            });


        }

        function get_twitter_fake() {
            var settings = {
                "url":  host_ssl+"dal/ObtainData/twitter_fakeaccounts/0",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings).done(function(responseJSON) {
                var json_fake = responseJSON;
                var json_data_fake = json_fake["Twitter_Names"];

                for (var i = 0; i < json_data_fake.length; i++) {
                    document.getElementById('speech_bubble_text').innerText = 'Νομίζω ότι ο λογαριασμός : ' + json_data_fake[i]["screen_name"] + ' στο Twitter είναι ' + json_data_fake[i]["fake_account"].replace("Account is a"," ");

                    update_twitter_fake(json_data_fake[i]["_id"]["$oid"]);
                    document.getElementById("avatar").style.display="block";


                }
            });



        }


        function get_chat_sexual() {

            var settings = {
                "url":  host_ssl+"dal/ObtainData/chat/sexualread/0",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings).done(function(responseJSON) {
                var json = responseJSON;
                var json_data = json["Chat_Logs"];
                for (var i = 0; i < json_data.length; i++) {
                    if (json_data[i]["read_sexual"] !== 1) {
                        document.getElementById('speech_bubble_text').innerText = 'Ανέλυσα την συνομιλία που είχες με τον :' + json_data[i]["fb_sender_name"] + ' στο Facebook ίσως η συνομιλία να περιέχει σεξουαλική παρενόχληση σε ποσοστό ' + json_data[i]["sexual_detection_percent"];

                        update_chat_sexual(json_data[i]["_id"]["$oid"]);
                        document.getElementById("avatar").style.display="block";

                    }
                }
            });


        }

        function get_chat_cyber() {

            var settings = {
                "url":  host_ssl+"dal/ObtainData/chat/cyberread/0",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings).done(function(responseJSON) {
                var json = responseJSON;
                var json_data = json["Chat_Logs"];

                for (var i = 0; i < json_data.length; i++) {
                    if (json_data[i]["read_cyberbull"] !== 1) {
                        // console.log('http://35.205.100.70:18082/dal/UpdateTwitterRead/' + json_data[i]["_id"]["$oid"]);
                        // console.log(json_data[i]);
                        document.getElementById('speech_bubble_text').innerText = 'Ανέλυσα την συνομιλία που είχες με τον :' + json_data[i]["fb_sender_name"] + ' στο Facebook και νομίζω ότι ίσως είναι cyberbully';

                        update_chat_cyber(json_data[i]["_id"]["$oid"]);
                        document.getElementById("avatar").style.display="block";

                    }
                }
            });


        }
  
function youtube_demo(){

if ((window.location.href =='https://www.youtube.com/watch?v=BH0WjoKbA9M') || window.location.href =='https://www.youtube.com/watch?v=tRClqoZDvbo' || window.location.href =='https://www.youtube.com/watch?v=zVI8f6StmNk'){

document.getElementById('speech_bubble_text').innerHTML = 'Το βίντεο που είδες στο Youtube: ' + window.location.href + ' ίσως είναι ακατάλληλο για εσένα !<br> Μάθε περισσότερα εδώ: <br><a href="https://proxyencase.cut.ac.cy:8090/courses/courses.html?id=A3-F">A3. Inappropriate Content</a>';
document.getElementById("avatarimg").src = 'https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/avatars/boy-1/200341852.png';
document.getElementById("avatar").style.display="block"
}
}



   function get_youtube(fb_url) {
console.log("EDWWWWWWWW!!!");            
console.log(fb_url);
var settings = {
                 "url":  "https://proxyencase.cut.ac.cy:18082/dal/youtube/https:--www.facebook.com-peter.encase",
                  "method": "GET",
                  "timeout": 0,
                  };

                  $.ajax(settings).done(function(responseJSON) {
                      var json = responseJSON;
                      var json_yt = json["youtube"];
                      for (var i = 0; i < json_yt.length; i++) {
                          if(json_yt[i]["prediction"] ==="inappropriate" && json_yt[i]["read"] ===0){
                              document.getElementById('speech_bubble_text').innerText = 'Το βίντεο που είδες στο Youtube : https://www.youtube.com/watch?v=' + json_yt[i]["video_id"] + ' ίσως είναι ακατάλληλο για εσένα !';
                                update_yt(json_yt[i]["_id"]["$oid"]);
                                document.getElementById("avatar").style.display="block";
                          }
                      }
                  });



        }

        function update_twitter_behavior(_id) {
          // 5da5e91951fbf8444e534e39
          var settings = {
                "url":  host_ssl+"dal/UpdateTwitterRead/" + _id,
                "method": "PUT",
                "timeout": 0,
            };

            $.ajax(settings).done(function(responseJSON) {
               // console.log(responseJSON);
            });

           
        }

        function update_twitter_fake(_id) {
           var settings = {
                "url":  host_ssl+"dal/UpdateTwitterFakeRead/" + _id,
                "method": "PUT",
                "timeout": 0,
            };

            $.ajax(settings).done(function(responseJSON) {
               // console.log(responseJSON);
            });
         

        }

        function update_chat_sexual(_id) {
           var settings = {
                "url":  host_ssl+"dal/UpdateChatSexualRead/" + _id,
                "method": "PUT",
                "timeout": 0,
            };

            $.ajax(settings).done(function(responseJSON) {
               // console.log(responseJSON);
            });
            

        }

        function update_chat_cyber(_id) {
          var settings = {
                "url":  host_ssl+"dal/UpdateChatCyberRead/" + _id,
                "method": "PUT",
                "timeout": 0,
            };

            $.ajax(settings).done(function(responseJSON) {
               // console.log(responseJSON);
            });
            
           

        }
  
  
  function update_yt(_id) {
          // 5da5e91951fbf8444e534e39
          var settings = {
                "url":  host_ssl+"dal/UpdateYoutubeRead/" + _id,
                "method": "PUT",
                "timeout": 0,
            };

            $.ajax(settings).done(function(responseJSON) {
               // console.log(responseJSON);
            });

           
        }


      // End Behaviors

var interval = 0; // The display interval, in minutes.
  setInterval(function() {
    interval++;
    // if (
    //   JSON.parse(localStorage.isActivated) &&
    //     localStorage.frequency <= interval
    // ) {
         get_twitter_behavior();
         setTimeout(function(){ get_twitter_fake(); }, 3500);
            
            get_chat_cyber();
            setTimeout(function(){ get_chat_sexual(); }, 3500);
            //get_youtube(fb_url);
            setTimeout(function(){youtube_demo();},3600);
            interval = 0;
    // }
  }, 15000);

setTimeout(function() {

document.getElementById("avatar").style.display="none"


    }, 10000);

$('#avatarimg').click(function() {
              if(document.getElementById("speech_bubble_text").innerText===""){
document.getElementById("avatar").style.display="none"
}
            });
if(document.getElementById("speech_bubble_text").innerText===""){
//document.getElementById("avatar").style.display="none"
}

    });

