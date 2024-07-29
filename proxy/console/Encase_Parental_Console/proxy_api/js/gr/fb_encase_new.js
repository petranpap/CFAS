function new_fb_url() {
    var new_fb_url;
    //alert("here")
    new_fb_url = document.querySelectorAll('[style="padding-left:8px;padding-right:8px"]')[0].getElementsByTagName("a")[0].href;
    //alert(new_fb_url)
    new_fb_url = new_fb_url.replace(/\//g, "-");
    new_fb_url = new_fb_url.slice(0, -1);
    return new_fb_url;
}
// Meme Detection
function meme() {
    var fb_url = new_fb_url();

    for (var i = 0; i < document.querySelectorAll('img[alt^="Image"]').length; i++) {

        //         console.log("11 -->  "+fb_url);
        //                 console.log(i);
        var img_src = document.querySelectorAll('img[alt^="Image"]')[i].src;
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
                        document.querySelectorAll('img[alt^="Image"]')[index].src = "https://proxyencase.cut.ac.cy:8090/proxy_api/hateful_racist_meme_gr.jpg";


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
                                title: 'Εντοπίστηκε ευαίσθητη πληροφορία!',
 content: '<img src="https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/avatars/boy-1/10230724.png"  style="z-index: 10000; width: 50px; height: 50px; background: rgb(192, 192, 192); border: 1px solid black; border-radius: 50%; display: block; margin-left: auto; margin-right: auto;">Η δημοσίευσή σου : " ' + x + '" φαίνεται να περιέχει προσωπικές πληροφορίες!<br> Μήπως ήθελες να την στείλεις με προσωπικό μήνυμα;<br> Μάθε περισσότερα εδώ: <a href="https://proxyencase.cut.ac.cy:8090/courses/courses.html?id=A1-F">A1. Personal / Sensitive Data and Privacy</a>',                                buttons: {
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
        if (document.querySelectorAll('[draggable="false"]')[0]) {
            img_alt = document.querySelectorAll('[draggable="false"]')[0].alt;
            if (img_alt.includes("watermarked")) {
                clearInterval(refreshId);

            } else {
                clearInterval(refreshId);
                $.alert({
                    boxWidth: '500px',
                    useBootstrap: false,

                    title: 'Προσοχή!',
                    content: '<img src="https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/avatars/selectedavatar/avatar.png"  style="z-index: 10000; width: 50px; height: 50px; background: rgb(192, 192, 192); border: 1px solid black; border-radius: 50%; display:block;margin-left: auto; margin-right: auto;"> Aπό εδώ δεν μπορώ να βοηθήσω! Ανέβασε την φωτογραφία στην νέα σελίδα για να σε βοηθήσω!',
                    buttons: {
                        tryAgain: {
                            text: 'Ok!',
                            btnClass: 'btn-red',
                            action: function() {
                                document.querySelectorAll('[aria-label="Remove post attachment"]')[0].click();
                                setTimeout(function() {
                                    location.reload();
                                }, 100);
                                var win = window.open("https://proxyencase.cut.ac.cy:8090/proxy_api/php/gr/image_to_fb_wall.php?fb_url=" + fb_url, '_blank');
                                win.focus();
                            }
                        },

                    }

                });


            }

        }


    }, 3500);

}


// Replace BackendURL with image (To fix in future)
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
if(document.querySelectorAll('[aria-label="Messages"]')[0]){
var type = "chat";
var text_array = [];
 for (var i = 0; i < document.querySelectorAll('[aria-label="Messages"]')[0].children.length; i++) {
    if(document.querySelectorAll('[aria-label="Messages"]')[0].children[i].dataset.testid == "incoming_group"){
     text_array.push("Predator: " +document.querySelectorAll('[aria-label="Messages"]')[0].children[i].innerText);
    var predator_cyber = document.querySelectorAll('[aria-label="Messages"]')[0].children[i].innerText.includes("!!!!!!");
    if (predator_cyber === true ){
document.getElementById("avatarimg").src = 'https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/avatars/boy-1/20083340.png';
       document.querySelectorAll('[aria-label="Messages"]')[0].children[i].innerText = "Το μήνυμα έχει αποκρυφθεί! Πιθανόν να δέχεσαι CYBERBULLING";
document.getElementById("speech_bubble_text").innerText = '';
document.getElementById("speech_bubble_text").innerHTML = 'Πιθανόν να δέχεσαι Cyberbullying στον '+document.querySelectorAll('[data-testid="messenger-chat-title-text"]')[0].innerText+'. \n Πρόσεχε σε παρακαλώ!<br> Μάθε περισσότερα εδώ: <br><a href="https://proxyencase.cut.ac.cy:8090/courses/courses.html?id=A2-F">A2. Cyberbullying and Sexual Harassment</a>';
            document.getElementById("speech_bubble_text").innerText = 'Πιθανόν να δεχεσαι Cyberbullying από τον '+document.querySelectorAll('[data-testid="messenger-chat-title-text"]')[0].innerText+'. \n Πρόσεχε σε παρακαλώ!!';
        document.getElementById("avatar").style.display="block";

     }

          var predator_groom = document.querySelectorAll('[aria-label="Messages"]')[0].children[i].innerText.includes("-----");
            if (predator_groom === true ){
        document.getElementById("avatarimg").src = 'https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/avatars/boy-1/20083340.png';
               document.querySelectorAll('[aria-label="Messages"]')[0].children[i].innerText = "Το μήνυμα έχει αποκρυφθεί! Πιθανόν να δέχεσαι Grooming";
        document.getElementById("speech_bubble_text").innerText = '';
        document.getElementById("speech_bubble_text").innerHTML = 'Πιθανόν να δέχεσαι Grooming από '+document.querySelectorAll('[data-testid="messenger-chat-title-text"]')[0].innerText+'. \n Πρόσεχε σε παρακαλώ!<br> Μάθε περισσότερα εδώ: <br><a href="https://proxyencase.$            document.getElementById("speech_bubble_text").innerText = 'Πιθανόν να δεχεσαι Cyberbullying από τον '+document.querySelectorAll('[data-testid="messenger-chat-title-text"]')[0].innerText+'. \n Πρόσεχε σε παρακαλώ!!';
                document.getElementById("avatar").style.display="block";

             }
   

    }else if(document.querySelectorAll('[aria-label="Messages"]')[0].children[i].dataset.testid == "outgoing_group"){
  text_array.push("Child: " +document.querySelectorAll('[aria-label="Messages"]')[0].children[i].innerText);
var child_cyber = document.querySelectorAll('[aria-label="Messages"]')[0].children[i].innerText.includes("@@@@@@");
        if(child_cyber === true){
document.getElementById("avatarimg").src = 'https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/avatars/boy-1/20083340.png';
        document.querySelectorAll('[aria-label="Messages"]')[0].children[i].innerText = "Το μήνυμα έχει αποκρυφθεί! Πιθανόν να κάνεις Cyberbullying"
    
document.getElementById("speech_bubble_text").innerText = '';
       document.getElementById("speech_bubble_text").innerHTML = 'Πιθανόν να κάνεις Cyberbullying στον '+document.querySelectorAll('[data-testid="messenger-chat-title-text"]')[0].innerText+'. \n Πρόσεχε σε παρακαλώ!<br> Μάθε περισσότερα εδώ: <br><a href="https://proxyencase.cut.ac.cy:8090/courses/courses.html?id=A2-F">A2. Cyberbullying and Sexual Harassment</a>';

        document.getElementById("avatar").style.display="block";


        }

                var child_groom = document.querySelectorAll('[aria-label="Messages"]')[0].children[i].innerText.includes("ggggg");
                if(child_groom === true){
                document.getElementById("avatarimg").src = 'https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/avatars/boy-1/20083340.png';
                document.querySelectorAll('[aria-label="Messages"]')[0].children[i].innerText = "Το μήνυμα έχει αποκρυφθεί! Πιθανόν να κάνεις Grooming"

                document.getElementById("speech_bubble_text").innerText = '';
               document.getElementById("speech_bubble_text").innerHTML = 'Πιθανόν να κάνεις Grooming στον '+document.querySelectorAll('[data-testid="messenger-chat-title-text"]')[0].innerText+'. \n Πρόσεχε σε παρακαλώ!<br> Μάθε περισσότερα εδώ: <br><a href="https://proxye$
                document.getElementById("avatar").style.display="block";


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
    checkimg();
    chat();
    $(document).scroll(function() {
        imgreplace();
        meme()
    });
});
