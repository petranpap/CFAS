  $.each(json_sexual["Chat_Logs"], function (index, element) {
if(element.sexual_detection_percent >='50%'){
        $("#facebook").append("<div class='card body newstyle'><div class='media table-content-cell'><div class='media-body'><h5 class='media-heading'>Προσοχή: Έχει εντοπιστεί περιεχόμενο Σεξουαλικής Αποπλάνησης!</h5><span class='notification-location'><b>Το Cybersafety Family Advice Suite</b> έχει αναλύσει την συνομιλία σου με τον/την <b>" + element.fb_sender_name + "</b> στο Facebook εντόπισε κείμενο με στοιχεία σεξουαλικής αποπλάνησης με ποσοστό: <b>" + element.sexual_detection_percent + "</b>. Να είσαι προσεκτικός!</p> </span></div></div></div>");
    }
    });
 $.each(json_cyber["Chat_Logs"], function (index, element) {
 if(element.angry >='40%'){
  $("#facebook").append("<div class='card body newstyle'><div class='media table-content-cell'><div class='media-body'><h5 class='media-heading'>Προσοχή: Έχει εντοπιστεί περεχόμενο εκφοβισμού(Cyberbullying)!</h5><span class='notification-location'><b>Το Cybersafety Family Advice Suite</b> έχει αναλύσει την συνομιλία σου με τον/την <b>" + element.fb_sender_name + "</b> και έχει εντοπίσει στοιχεία από εκφοβισμό! Να είσαι προσκτικός! </p> </span></div></div></div>"); }
    });
 $.each(json_twitter["Twitter_Names"], function (index, element) {
if (element.fake_account !== undefined) {
         $("#twitter").append("<div class='card body newstyle'><div class='media table-content-cell'><div class='media-body'><h5 class='media-heading'>Προσοχή: Έχει εντοπιστεί λογαριασμός Bot!</h5><span class='notification-location'><p><b>Το Cybersafety Family Advice Suite</b> περιγράφει τον λογαριασμό <b>" + element.screen_name + "</b> " + element.fake_account.replace("Account is a bot","ως λογαριασμό bot. Να είσαι προσεκτικός!") + "</p> </span></div></div></div>");
 
        }
              $("#twitter").append(" <div class='card body newstyle'><div class='media table-content-cell'><div class='media-body'><h5 class='media-heading'>Προσοχή: Έχει εντοπιστεί ύποπτος λογαριασμός!</h5><span class='notification-location'><p><b>Το Cybersafety Family Advice Suite</b> περιγράφει τον λογαριασμό <b>" + element.screen_name + "</b> ως " + element.behavior.replace("bully","λογαριασμό που είναι cyberbully! Να είσαι προσεκτικός!").replace("aggressive","λογαριασμό που είναι επιθετικός. Να είσαι προσεκτικός!").replace("spam or abusive","λογαριασμό spam ή βιαίο. Να είσαι προσεκτικός!") + "</p></span></div></div></div>");
    });
