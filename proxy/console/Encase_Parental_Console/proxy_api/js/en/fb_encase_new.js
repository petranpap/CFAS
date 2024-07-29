function new_fb_url() {
    var new_fb_url;
//    alert(document)
    new_fb_url = document.querySelectorAll('[style="padding-left:8px;padding-right:8px"]')[0].getElementsByTagName("a")[0].href;
    new_fb_url = new_fb_url.replace(/\//g, "-");
    new_fb_url = new_fb_url.slice(0, -1);
    return new_fb_url;
}
// Meme Detection
function meme() {
    var fb_url = new_fb_url();

    for (var i = 0; i < document.querySelectorAll('img').length; i++) {

        //         console.log("11 -->  "+fb_url);
        //                 console.log(i);
        var img_src = document.querySelectorAll('img')[i].src;
        //                 console.log(img_src);
        (function(index) {

            // In this closure : parameters of a function in JS 
            // are available only in the function,
            // and cannot be changed from outside of it
            var xhr = new XMLHttpRequest();
            // variables declared in a function in JS
            // are available only inside the function
            // and cannot be changed from outside of it

            xhr.upload.onprogress = function(e) {

            };

            xhr.onreadystatechange = function(e) {
                if (this.readyState === 4) {
                    var obj = this.responseText;
                    var json = JSON.parse(obj);
                    // console.log(index);
                    if (json['is_racist'] == true) {
                        document.querySelectorAll('img')[index].src = "https://proxyencase.cut.ac.cy:8090/proxy_api/hateful_racist_meme.jpg";
            document.querySelectorAll('img')[index].style.height="70%"

                    }
                }
            };
            var data = new FormData();
            data.append("fb_url", fb_url);
            data.append("img_src", img_src); // `index` has nothing to do with `i`, now:
            // if `i` changes outside of the function,
            //`index` will not
            //         console.log(files[index]); // Don't keep `console.log()` in production code ;-)
            xhr.open('POST', 'https://proxyencase.cut.ac.cy:8090/proxy_api/php/send_img_fbfeed_to_racistMemeDetection.php');
            xhr.send(data);
        })(i)

    }



}

// Antonis Classifier (Sensitive Content)

function sensitiveContent() {

    var check = function() {
        if (document.querySelector('[aria-label^="What\'s on your mind,"]')) {
            document.querySelector('[aria-label^="What\'s on your mind,"]').onmouseleave = function() {
                var text_to_check = document.querySelector('[aria-label^="What\'s on your mind,"]').getElementsByTagName("span")[0].innerText;
                console.log(text_to_check);
                //////////////////////////

                var data = new FormData();
                var x = '';

                var xhr = new XMLHttpRequest();
                xhr.withCredentials = true;

                xhr.addEventListener("readystatechange", function() {
                    if (this.readyState === 4) {
                        var myStringArray = JSON.parse(this.responseText);
                        // var arrayLength = myStringArray.length;

                        if (myStringArray["dates"].length > 0) {
                            //  console.log(myStringArray["dates"][0]);
                            x += myStringArray["dates"][0] + " ";
                        }
                        if (myStringArray["times"].length > 0) {
                            x += myStringArray["times"][0] + " ";
                        }
                        if (myStringArray["links"].length > 0) {
                            x += myStringArray["links"][0] + " ";
                        }
                        if (myStringArray["phones"].length > 0) {
                            x += myStringArray["phones"][0] + " ";
                        }
                        if (myStringArray["ext_phones"].length > 0) {
                            x += myStringArray["ext_phones"][0] + " ";
                        }
                        if (myStringArray["emails"].length > 0) {
                            x += myStringArray["emails"][0] + " ";
                        }
                        if (myStringArray["ips"].length > 0) {
                            x += myStringArray["ips"][0] + " ";
                        }
                        if (myStringArray["prices"].length > 0) {
                            x += myStringArray["prices"][0] + " ";
                        }
                        if (myStringArray["credit_cards"].length > 0) {
                            x += myStringArray["credit_cards"][0] + " ";
                        }
                        if (myStringArray["street_addresses"].length > 0) {
                            x += myStringArray["street_addresses"][0] + " ";
                        }
                        if (myStringArray["po_boxes"].length > 0) {
                            x += myStringArray["po_boxes"][0] + " ";
                        }
                        if (myStringArray["zip_codes"].length > 0) {
                            x += myStringArray["zip_codes"][0] + " ";
                        }
                        //Do something
                        if (x) {


                            $.confirm({
                                boxWidth: '500px',
                                useBootstrap: false,
                                title: 'Sensitive information detected!',
                                content: '<img src="https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/avatars/boy-1/10230724.png"  style="z-index: 10000; width: 50px; height: 50px; background: rgb(192, 192, 192); border: 1px solid black; border-radius: 50%; display: block; margin-left: auto; margin-right: auto;">Your post: " ' + x + '" seems to contain sensitive information!<br> It is better not to share sensitive information, if you need to share something with a friend send it via personal message!',
                                buttons: {
                                    post_anyway: {
                                        btnClass: 'btn-blue',
                                        text: 'Ok'
                                    }
                                }
                            });




                        }



                    }
                });

                xhr.open("GET", "https://proxyencase.cut.ac.cy:8090/proxy_api/php/sensitive_cors.php?text=" + text_to_check);

                xhr.send(data);

            }
        } else {
            setTimeout(check, 1000); // check again in a second
        }
    }

    check();

}
// Antonis Classifier (Sensitive Content) END


// Check the image and send Minor to new page (in the IWP)

function checkimg() {
    var fb_url = new_fb_url();
    var img_alt;
    var refreshId = setInterval(function() {
        alert(document.querySelectorAll('[draggable="false"]')[0])
    if (document.querySelectorAll('[draggable="false"]')[0]) {
            img_alt = document.querySelectorAll('[draggable="false"]')[0].alt;
            if (img_alt.includes("watermarked")) {
                clearInterval(refreshId);

            } else {
                clearInterval(refreshId);
                $.alert({
                    boxWidth: '500px',
                    useBootstrap: false,

                    title: 'Let me help you!',
                    content: '<img src="https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/avatars/selectedavatar/avatar.png"  style="z-index: 10000; width: 50px; height: 50px; background: rgb(192, 192, 192); border: 1px solid black; border-radius: 50%; display:block;margin-left: auto; margin-right: auto;"> Please click "Ok" to open a new tab where you can upload your picture through Cybersafety Family Advice Suite to ensure your online safety!',
                    buttons: {
                        tryAgain: {
                            text: 'Ok',
                            btnClass: 'btn-red',
                            action: function() {
                                document.querySelectorAll('[aria-label="Remove post attachment"]')[0].click();
                                setTimeout(function() {
                                    location.reload();
                                }, 100);
                                var win = window.open("https://proxyencase.cut.ac.cy:8090/proxy_api/php/en/image_to_fb_wall.php?fb_url=" + fb_url, '_blank');
                                win.focus();
                            }
                        },

                    }

                });


            }

        }


    }, 3500);

}


function checkimg_new() {
    var fb_url = new_fb_url();
    var img_alt;
    var refreshId = setInterval(function() {

if (document.querySelectorAll('[accept="image/*,image/heif,image/heic,video/*,video/mp4,video/x-m4v,video/x-matroska,.mkv" ]').length>0) {
    // Find the span element by its innerText
const spanElements = document.getElementsByTagName('span');

let targetSpan;

// Loop through all the span elements and find the one with the desired innerText
for (let i = 0; i < spanElements.length; i++) {
  const span = spanElements[i];
  
  if (span.innerText === "Add Photos/Videos") {
    targetSpan = span;
    break;
  }
}

// Now you can add an onclick function to the target span element
if (targetSpan) {
    // Perform your desired action here Alert The Avatar Helper and clear the interval to stop the loop!
                    clearInterval(refreshId);
                $.alert({
                    boxWidth: '500px',
                    useBootstrap: false,

                    title: 'Let me help you!',
                    content: '<img src="https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/avatars/boy-1/102233022.png"  style="z-index: 10000; width: 50px; height: 50px; background: rgb(192, 192, 192); border: 1px solid black; border-radius: 50%; display:block;margin-left: auto; margin-right: auto;"> Please click "Ok" to open a new tab where you can upload your picture through Cybersafety Family Advice Suite to ensure your online safety!',
                    buttons: {
                        tryAgain: {
                            text: 'Ok',
                            btnClass: 'btn-red',
                            action: function() {
                                document.querySelectorAll('[aria-label="Remove post attachment"]')[0].click();
                                setTimeout(function() {
                                    location.reload();
                                }, 100);
                                var win = window.open("https://proxyencase.cut.ac.cy:8090/proxy_api/php/en/image_to_fb_wall.php?fb_url=" + fb_url, '_blank');
                                win.focus();
                            }
                        },

                    }

                });


}
} else {
  console.log("Span element not found.");
//    if (document.querySelectorAll('[draggable="false"]')[0]) {
//            img_alt = document.querySelectorAll('[draggable="false"]')[0].alt;
//            if (img_alt.includes("watermarked")) {
//                clearInterval(refreshId);
//
//        }
//        }
}






    }, 3500);




    

}



// Replace BackendURL with image (To fix in future)
function imgreplace() {
setTimeout(function(){
        for (var i = 0; i < document.querySelectorAll('a').length; i++) {
 if (document.querySelectorAll('a')[i].innerText.includes('https://backendencase.cut.ac.cy:85') === true) {
var number = i;
//             console.log(document.querySelectorAll('a')[i].innerText);
var url_string = document.querySelectorAll('a')[i].innerText
var url = new URL(url_string);
var fb_url = url.searchParams.get("fb_url");
// console.log(fb_url);
var uid = url.searchParams.get("uid");
// console.log(uid);
var img = url.searchParams.get("img");
// console.log(img);


var settings = {
  "url": "https://proxyencase.cut.ac.cy:3201/decryption?uid="+uid+"&fb_url="+fb_url+"&img="+img,
  "method": "GET",
  "timeout": 0,
};

$.ajax(settings).done(function (response) {
  console.log(response);
  var imgurl = document.querySelectorAll('a')[number].innerText.replace("/image.php?fb_url=", "/").replace("&img=", "/").split('&perm=')[0].split('&uid=')[0];
document.querySelectorAll('a')[number].style.pointerEvents = "none";
            document.querySelectorAll('a')[number].innerHTML = '<img src="' + response + '">';
});
 }
    }
}, 3000);
}

function chat(){



var refresh_chat = setInterval(function() {
if(document.querySelectorAll('[aria-label^="Messages in conversation with"]')[0]){
var type = "chat";
var text_array = [];
 for (var i = 0; i < document.querySelectorAll('[aria-label^="Messages in conversation with"]')[0].querySelectorAll('[style^="background-color:"]').length; i++) {
    if(document.querySelectorAll('[aria-label^="Messages in conversation with"]')[0].querySelectorAll('[style^="background-color:"]')[i].style.backgroundColor == "var(--chat-incoming-message-bubble-background-color)"){ //Incoming Chat
     text_array.push("Predator: " +document.querySelectorAll('[aria-label^="Messages in conversation with"]')[0].querySelectorAll('[style^="background-color:"]')[i].innerText);
    var predator_cyber = document.querySelectorAll('[aria-label^="Messages in conversation with"]')[0].querySelectorAll('[style^="background-color:"]')[i].innerText.includes("!!!!!!");
    if (predator_cyber === true ){
       document.querySelectorAll('[aria-label^="Messages in conversation with"]')[0].querySelectorAll('[style^="background-color:"]')[i].innerText = "MESSAGE BLOCKED! The sender might be a cyberbully.";
document.getElementById("speech_bubble_text").innerText = '';
            document.getElementById("speech_bubble_text").innerText = 'Warning!\nYour latest Facebook chat with '+document.querySelectorAll('[aria-label="Chat settings"]')[0].getElementsByTagName("h1")[0].innerText+' shows signs of cyberbullying. Be careful!';
        document.getElementById("avatar").style.display="block";
    $('#gavatar').css({'right':'550px'});
     }
    var predator_groom = document.querySelectorAll('[aria-label^="Messages in conversation with"]')[0].querySelectorAll('[style^="background-color:"]')[i].innerText.includes("-----");

if (predator_groom === true ){
document.getElementById("avatarimg").src = 'https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/avatars/boy-1/20083340.png';
       document.querySelectorAll('[aria-label^="Messages in conversation with"]')[0].querySelectorAll('[style^="background-color:"]')[i].innerText = "MESSAGE BLOCKED! The sender might be a Groomer.";
document.getElementById("speech_bubble_text").innerHTML = '';
document.getElementById("speech_bubble_text").innerHTML = 'Warning!\nYour latest Facebook chat with  '+document.querySelectorAll('[data-testid="messenger-chat-title-text"]')[0].innerText+'. \n shows signs of cyberbullying. Be careful!<br> Learn More Here: <br><a href="https://proxyencase.cut.ac.cy:8090/courses/courses.html?id=A2-F">A2. Cyberbullying and Sexual Harassment</a>';
        document.getElementById("avatar").style.display="block";
        $('#gavatar').css({'right':'550px'});

     }
   

    }else if(document.querySelectorAll('[aria-label^="Messages in conversation with"]')[0].querySelectorAll('[style^="background-color:"]')[i].style.backgroundColor == "rgb(0, 132, 255)"){ //OutGoing Chat
  text_array.push("Child: " +document.querySelectorAll('[aria-label^="Messages in conversation with"]')[0].querySelectorAll('[style^="background-color:"]')[i].innerText);
var child_cyber = document.querySelectorAll('[aria-label^="Messages in conversation with"]')[0].querySelectorAll('[style^="background-color:"]')[i].innerText.includes("@@@@@@");
        if(child_cyber === true){
        document.querySelectorAll('[aria-label^="Messages in conversation with"]')[0].querySelectorAll('[style^="background-color:"]')[i].innerText = "MESSAGE BLOCKED! Your message contains Cyberbullying text!"
    
document.getElementById("speech_bubble_text").innerText = '';
            document.getElementById("speech_bubble_text").innerText = 'Your message to '+document.querySelectorAll('[aria-label="Chat settings"]')[0].getElementsByTagName("h1")[0].innerText+' shows signs of cyberbullying.\nPlease be careful, don\'t be a cyberbully!';
        document.getElementById("avatar").style.display="block";
    $('#gavatar').css({'right':'40%'});
        }
             var child_groom = document.querySelectorAll('[aria-label^="Messages in conversation with"]')[0].querySelectorAll('[style^="background-color:"]')[i].innerText.includes("ggggg");
                if(child_groom === true){
                document.getElementById("avatarimg").src = 'https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/avatars/boy-1/20083340.png';
                document.querySelectorAll('[aria-label^="Messages in conversation with"]')[0].querySelectorAll('[style^="background-color:"]')[i].innerText= "MESSAGE BLOCKED! Your message contains Grooming text!"

                document.getElementById("speech_bubble_text").innerText = '';
               document.getElementById("speech_bubble_text").innerHTML = 'our message to '+document.querySelectorAll('[data-testid="messenger-chat-title-text"]')[0].innerText+'. \n  shows signs of cyberbullying.\nPlease be careful!<br> Μάθε περισσότερα εδώ: <br>Learn More Here: <br><a href="https://proxyencase.cut.ac.cy:8090/courses/courses.html?id=A2-F">A2. Cyberbullying and Sexual Harassment</a>';
                document.getElementById("avatar").style.display="block";
                    $('#gavatar').css({'right':'40%'});


                }
    }
 }
var text_chat = text_array.toString();
//        console.log(text_chat);
// console.log(text_array.length - 1);
var child_cyber = text_array[text_array.length - 1].includes("@@@@@@");
// console.log(child_cyber);
var predator_cyber = text_array[text_array.length - 1].includes("!!!!!!");
  //   console.log(predator_cyber);
// if (predator_cyber === true ){
// alert("pre");
// }
// if(child_cyber === true){
// alert("s");
// console.log(text_array.length - 1);
// }
}
}, 4000);
}


// ------------------------------------------------------




$(document).ready(function() {
    sensitiveContent();
//    checkimg();
  checkimg_new(); 
   chat();
    $(document).scroll(function() {
  //      imgreplace();
        meme()
    });
});



