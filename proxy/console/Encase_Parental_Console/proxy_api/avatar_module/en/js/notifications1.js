  $.each(json_sexual["Chat_Logs"], function (index, element) {
if(element.sexual_detection_percent >='50%'){
        $("#facebook").append("<div class='card body newstyle'><div class='media table-content-cell'><div class='media-body'><h5 class='media-heading'> Warning: Sexual Grooming is detected!</h5><span class='notification-location'><b>Cybersafety Family Advice Suite</b> has analysed your chat with <b>" + element.fb_sender_name + "</b> at Facebook and detected sexual grooming text with the percentage of: <b>" + element.sexual_detection_percent + "</b>. Be careful!</p> </span></div></div></div></div>");
    }
    });
 $.each(json_cyber["Chat_Logs"], function (index, element) {
 if(element.angry >='40%'){
  $("#facebook").append("<div class='card body newstyle'><div class='media table-content-cell'><div class='media-body'><h5 class='media-heading'>Warning: Cyberbullying is detected!</h5><span class='notification-location'><b>Cybersafety Family Advice Suite</b> has analysed your chat with <b>" + element.fb_sender_name + "</b> and detected signs of cyberbullying! Be careful! </p> </span></div></div></div></div>"); }
    });
 $.each(json_twitter["Twitter_Names"], function (index, element) {
if (element.fake_account !== undefined) {
         $("#twitter").append("<div class='card body newstyle'><div class='media table-content-cell'><div class='media-body'><h5 class='media-heading'>Warning: Bot account is detected!</h5><span class='notification-location'><p><b>Cybersafety Family Advice Suite</b> describes the account <b>" + element.screen_name + "</b> " + element.fake_account.replace("Account is a bot","as a bot account. Be careful!") + "</p> </span></div></div></div>");
 
        }
              $("#twitter").append(" <div class='card body newstyle'><div class='media table-content-cell'><div class='media-body'><h5 class='media-heading'>Warning: Spam account is detected!</h5><span class='notification-location'><p><b>Cybersafety Family Advice Suite</b> describes the account <b>" + element.screen_name + "</b> as a " + element.behavior.replace("bully","cyberbully account! Be careful!").replace("aggressive","an aggresive. Be careful!").replace("spam or abusive","spam or abusive account. Be careful!") + "</p></span></div></div></div>");
    });

