 $.each(json_sexual["Chat_Logs"], function (index, element) {
if(element.sexual_detection_percent >='50%'){
        $("#facebook").append("<div class='card'><p>Το <b style='color: blue; '>Cybersafety Family Advice Suite</b> ανέλυσε την συνομιλία που είχες με <b style='color: blue; '>" + element.fb_sender_name + "</b> στο Facebook και θεωρεί ότι πιθανόν να υπάρχει σεξουαλική αποπλάνηση με ποσοστό : <b style='color:red'>" + element.sexual_detection_percent + "</b></p></div>");
    }
    });
 $.each(json_cyber["Chat_Logs"], function (index, element) {
 if(element.angry >='40%'){
        $("#facebook").append("<div class='card'><p>Το <b style='color: blue; '>Cybersafety Family Advice Suite</b> ανέλυσε την συνομιλία που είχες με <b style='color: blue; '>" + element.fb_sender_name + "</b> και θεωρεί ότι πιθανόν να είναι cyberbully</p></div>");
    }
    });
 $.each(json_twitter["Twitter_Names"], function (index, element) {
if (element.fake_account !== undefined) {
            $("#twitter").append(" <div class='card'><p>Το <b style='color: blue; '>Cybersafety Family Advice Suite</b> θεωρεί ότι ο λογαριασμός : <b style='color: blue; '>" + element.screen_name + "</b> " + element.fake_account.replace("Account is a bot","πιθανόν να είναι bot") + "</p></div>");


        }
            $("#twitter").append(" <div class='card'><p>Το <b style='color: blue; '>Cybersafety Family Advice Suite</b> θεωρεί ότι ο λογαριασμός : <b style='color: blue; '>" + element.screen_name + "</b> πιθανόν να είναι " + element.behavior.replace("bully","cyberbully").replace("aggressive","επιθετικός") + "</p></div>");

    });

