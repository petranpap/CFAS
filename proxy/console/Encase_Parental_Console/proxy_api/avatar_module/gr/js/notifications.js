 $.each(json_sexual["Chat_Logs"], function (index, element) {
if(element.sexual_detection_percent >='50%'){
        $("#facebook").append("<div class='card'><p><b style='color: blue; '>Το Cybersafety Family Advice Suite</b> έχει αναλύσει την συνομιλία σου με τον/την <b style='color: blue; '>" + element.fb_sender_name + "</b> στο Facebook και έχει εντοπίσει κείμενο με περιεχόμενο σεξουαλικής αποπλάνησης με ποσοστό:  <b style='color:red'>" + element.sexual_detection_percent + "</b>. Να είσαι προσεκτικός!</p></div>");
    }
    });
 $.each(json_cyber["Chat_Logs"], function (index, element) {
 if(element.angry >='40%'){
        $("#facebook").append("<div class='card'><p><b style='color: blue; '>Το Cybersafety Family Advice Suite</b> έχει αναλύσει την συνομιλία σου με τον/την <b style='color: blue; '>" + element.fb_sender_name + "</b> και έχει εντοπίσει στοιχεία εκφοβισμού(cyberbullying)! Να είσαι προσεκτικός! </p></div>");
    }
    });
 $.each(json_twitter["Twitter_Names"], function (index, element) {
if (element.fake_account !== undefined) {
            $("#twitter").append(" <div class='card'><p><b style='color: blue; '>Το Cybersafety Family Advice Suite</b> περιγράφει τον λογαριασμό <b style='color: blue; '>" + element.screen_name + "</b> " + element.fake_account.replace("Account is a bot","ως λογαριασμό bot. Να είσαι προσεκτικός!") + "</p></div>");


        }
            $("#twitter").append(" <div class='card'><p><b style='color: blue; '>Cybersafety Family Advice Suite</b> describes the account <b style='color: blue; '>" + element.screen_name + "</b> as a " + element.behavior.replace("bully","cyberbully account! Be careful!").replace("aggressive","an aggresive. Be careful!").replace("spam","spam account. Be careful!") + "</p></div>");

    });

