 $.each(json_sexual["Chat_Logs"], function (index, element) {
if(element.sexual_detection_percent >='50%'){
        $("facebook").append("<div class='card'><p><b style='color: blue; '>Cybersafety Family Advice Suite</b> has analysed your chat with <b style='color: blue; '>" + element.fb_sender_name + "</b> at Facebook and detected sexual grooming text with the percentage of: <b style='color:red'>" + element.sexual_detection_percent + "</b>. Be careful!</p></div>");
    }
    });
 $.each(json_cyber["Chat_Logs"], function (index, element) {
 if(element.angry >='40%'){
        $("facebook").append("<div class='card'><p><b style='color: blue; '>Cybersafety Family Advice Suite</b> has analysed your chat with <b style='color: blue; '>" + element.fb_sender_name + "</b> and detected signs of cyberbullying! Be careful! </p></div>");
    }
    });
 $.each(json_twitter["Twitter_Names"], function (index, element) {
if (element.fake_account !== undefined) {
            $("twitter").append(" <div class='card'><p><b style='color: blue; '>Cybersafety Family Advice Suite</b> describes the account <b style='color: blue; '>" + element.screen_name + "</b> " + element.fake_account.replace("Account is a bot","as a bot account. Be careful!") + "</p></div>");


        }
            $("twitter").append(" <div class='card'><p><b style='color: blue; '>Cybersafety Family Advice Suite</b> describes the account <b style='color: blue; '>" + element.screen_name + "</b> as a " + element.behavior.replace("bully","cyberbully account! Be careful!").replace("aggressive","an aggresive. Be careful!").replace("spam","spam account. Be careful!") + "</p></div>");

    });

