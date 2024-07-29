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
        spanavatar.style.cursor="pointer";
        spanavatar.style.position="absolute";
        spanavatar.style.background="white";
        spanavatar.style.fontSize="medium";
        spanavatar.style.marginTop="0px";
                spanavatar.innerText="OK !";
        insertAfter(spanavatar, speech_bubble_text);

        // avatar.insertBefore(spanavatar,avatar.firstChild)
  
      // Avatar Image
      var avatar = document.getElementById("avatar");
    avatarimg = document.createElement("IMG"); //create a div
        avatarimg.setAttribute("src", "https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/avatars/selectedavatar/avatar.png");
        avatarimg.setAttribute("alt", "avatarimg");   
              avatarimg.style.position="fixed";
              // avatarimg.style.right="0";
              avatarimg.style.zIndex="10000";
              avatarimg.style.width="50px";
              avatarimg.style.height="50px";
              avatarimg.style.top="68%";
              avatarimg.style.background="#c0c0c0";
              avatarimg.style.cursor = "cell";
              avatarimg.style.border="1px solid black";
              avatarimg.style.borderRadius="50%";
              avatarimg.id = 'avatarimg';  //add an id
    
insertAfter(avatarimg, avatar);

// Return Position of Avatar
var body = document.getElementsByTagName('body')[0],
 avatar_return = document.createElement("div");

avatar_return.id = 'avatar_return';  //add an id
 body.insertBefore(avatar_return,body.firstChild) //insert it

document.getElementById("avatarimg").addEventListener("click", multiple_avatar);

document.getElementsByClassName("close_avatartxt")[0].addEventListener("click",close_ballon_text);

$('.close_avatartxt').click(function(){
$('#gavatar').css({'right':''});
});

      function close_appear_ballon_text() {
        var x = document.getElementById("speech-bubble");
        if (x.style.display == "none") {
          x.style.display = "block";
        } 
        else {
          x.style.display = "none";
        }
	$('#gavatar').css({'right':''});
      }
 function multiple_avatar(){
        
        if (document.getElementsByClassName("cyberavatar").length<3){
          // close_ballon_text();
          var x =document.getElementById("avatar");
           if (x.style.display == "none") {
          x.style.display = "block";
        } 
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
        avatar_img1.style.borderRadius="50%";
        avatar_img1.style.cursor = "cell";
        // avatar_img1.style.border="1px solid black";
        avatar_img1.style.transition = "all 2s";
        avatar_img1.onclick = function() {
    window.open('https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/en/options/index.php?fb_url='+fb_url, '_blank');
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
        avatar_img2.style.top="49%";
        avatar_img2.style.background="#c0c0c0";
        avatar_img2.style.borderRadius="50%";
        avatar_img2.style.cursor = "cell";
        // avatar_img2.style.border="1px solid black";
        avatar_img2.style.transition = "all 2s";
          avatar_img2.onclick = function() {
    window.open('https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/en/notifications/index.php?fb_url='+fb_url, '_blank');
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
        avatar_img3.style.top="59%";
        avatar_img3.style.cursor = "cell";
        avatar_img3.style.background="#c0c0c0";
        avatar_img3.style.borderRadius="50%";
        // avatar_img3.style.border="1px solid black";
        avatar_img3.style.transitionDelay = "15s";
         avatar_img3.onclick = function() {
    window.open('https://www.cybersafety.cy/home-en', '_blank');
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
$("#avatarimg").css("top","68%")
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
                "url":  "https://proxyencase.cut.ac.cy:18082/dal/ObtainData/twitter/0",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings).done(function(responseJSON) {
                var json_behavior = responseJSON;
                var json_data_behavior = json_behavior["Twitter_Names"];

                for (var i = 0; i < json_data_behavior.length; i++) {
      if(json_data_behavior[i]["screen_name"]!=="home"){
                    document.getElementById('speech_bubble_text').innerText = 'Cybersafety Family Advice Suite believes that the account: ' + json_data_behavior[i]["screen_name"] + ' on Twitter is a ' + json_data_behavior[i]["behavior"]+'.';
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
                    document.getElementById('speech_bubble_text').innerText = 'Cybersafety Family Advice Suite believes that the account: ' + json_data_fake[i]["screen_name"] + ' on Twitter is a ' + json_data_fake[i]["fake_account"].replace("Account is a"," ")+'.';

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
                        document.getElementById('speech_bubble_text').innerText = 'I have analysed your chat with: ' + json_data[i]["fb_sender_name"] + '  on Facebook and I think that this conversation has signs of sexual harassment with the percentage of ' + json_data[i]["sexual_detection_percent"]+'.';

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
                        document.getElementById('speech_bubble_text').innerText = 'I have analysed your chat with: ' + json_data[i]["fb_sender_name"] + ' on Facebook and I think that he/she might be a cyberbully! Be careful!';

                        update_chat_cyber(json_data[i]["_id"]["$oid"]);
                        document.getElementById("avatar").style.display="block";

                    }
                }
            });


        }
  
   function get_youtube(fb_url) {
            var settings = {
                  "url":  "https://proxyencase.cut.ac.cy:18082/dal/youtube/"+fb_url,
                  "method": "GET",
                  "timeout": 0,
                  };

                  $.ajax(settings).done(function(responseJSON) {
                      var json = responseJSON;
                      var json_yt = json["youtube"];
                      for (var i = 0; i < json_yt.length; i++) {
                          if(json_yt[i]["prediction"] ==="inappropriate" && json_yt[i]["read"] ===0){
                              document.getElementById('speech_bubble_text').innerText = 'The video you just watched on YouTube, might be inappropriate for you, please be careful!';
                                update_yt(json_yt[i]["_id"]["$oid"]);
                                document.getElementById("avatar").style.display="block";
                          }
                      }
                  });



        }

        function update_twitter_behavior(_id) {
          // 5da5e91951fbf8444e534e39
          var settings = {
                "url":  "https://proxyencase.cut.ac.cy:18082/dal/UpdateTwitterRead/" + _id,
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
                "url":  "https://proxyencase.cut.ac.cy:18082/dal/UpdateYoutubeRead/" + _id,
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
            get_youtube(fb_url);
            interval = 0;
    // }
  }, 10000);

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

