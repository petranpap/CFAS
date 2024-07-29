$(document).ready(function() {
//alert(fb_url);
    var res_par = '';
    var res_bac = '';
    var res_sec = '';
    console.log(host_8090+"/api/public/browser_addon/parental/options/" + fb_url);
    $.getJSON(host_8090+"/api/public/browser_addon/parental/options/" + fb_url, function(result) {
        var checkbox = result["checkbox"].split(" ");
        for (var i = 0; i < checkbox.length; i++) {
            res_par += checkbox[i].replace("parental_fb_", "<br> Facebook ");

        }
        if (result["child_aproved"] == 1) {
            document.querySelector("#parental").innerHTML = "<p> Επίπεδο Γονικής Ορατότητας : " + result["parental_visibility_level"] + "</p><br><p> Ο πατέρας σου θα ήθελε να βλέπει :" + res_par + "</p><br><p> Αποδοχή : Ναι</p><button id='revoke_parental' type='button' class='btn btn-danger' style='float: right; '>Aναίρεση επιλογών</button>";
             $("#revoke_parental").click(function(){
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": host_8090+"/api/public/update/browser_addon/parental_revoke/options/"+fb_url,
                "method": "PUT",
                "headers": {
                    "cache-control": "no-cache",
                    "Postman-Token": "c0a1861b-0325-48d7-88f2-687bf8ce9ad3"
                }
            }

            $.ajax(settings).done(function(response) {
                // console.log(response);
                location.reload();
            });
        });
        } else {
            document.querySelector("#parental").innerHTML = "<p> Επίπεδο Γονικής Ορατότητας : " + result["parental_visibility_level"] + "</p><br><p> Ο πατέρας σου θα ήθελε να βλέπει :" + res_par + "</p><br></p><button id='aprove_parental' type='button' class='btn btn-success'> Αποδέχεσαι ?</button>";
            $("#aprove_parental").click(function(){
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": host_8090+"/api/public/update/browser_addon/parental/options/"+fb_url,
                "method": "PUT",
                "headers": {
                    "cache-control": "no-cache",
                    "Postman-Token": "c0a1861b-0325-48d7-88f2-687bf8ce9ad3"
                }
            }

            $.ajax(settings).done(function(response) {
                // console.log(response);
                location.reload();
            });
        });
        }




    });

    $.getJSON(host_8090+"/api/public/browser_addon/backend/options/" + fb_url, function(result) {
        var checkbox = result["checkbox"].split(" ");
        for (var i = 0; i < checkbox.length; i++) {
            res_bac += checkbox[i].replace("backend_fb_", "<br> Facebook ");

        }


        if (result["child_aproved"] == 1) {
             if (result["anonymously"] ==0 ) {
            var anonymously = "No";
        } else {
            var anonymously = "Yes";

        }
            document.querySelector("#backend").innerHTML = "<p> Επίπεδο ορατότητας συστήματος: " + result["backend_visibility_level"] + "</p><br><p>Το Cybersafety Family Advice Suite βλέπει :" + res_bac + "</p><br><p> Αποδοχή : Ναι" + "</p><br><p> Αποστολή Δεδομένων Ανώνυμα : " + anonymously.replace("Yes", "Ναι").replace("No","Όχι") + "</p><button id='revoke_backend' type='button' class='btn btn-danger' style='float: right; '>Aναίρεση επιλογών</button>";
            $("#revoke_backend").click(function(){
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": host_8090+"/api/public/update/browser_addon/backend_revoke/options/"+fb_url,
                "method": "PUT",
                "headers": {
                    "cache-control": "no-cache",
                    "Postman-Token": "c0a1861b-0325-48d7-88f2-687bf8ce9ad3"
                }
            }

            $.ajax(settings).done(function(response) {
                // console.log(response);
                location.reload();
            });
        });
        } else {
            document.querySelector("#backend").innerHTML = "<p> Επίπεδο ορατότητας συστήματος : " + result["backend_visibility_level"] + "</p><br><p>Το Cybersafety Family Advice Suite θέλει να βλέπει :" + res_bac +"</p><br></p><button id='aprove_backend' type='button' class='btn btn-success'> Αποδέχεσαι ?</button>";
              $("#aprove_backend").click(function(){
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": host_8090+"/api/public/update/browser_addon/backend/options/"+fb_url,
                "method": "PUT",
                "headers": {
                    "cache-control": "no-cache",
                    "Postman-Token": "c0a1861b-0325-48d7-88f2-687bf8ce9ad3"
                }
            }

            $.ajax(settings).done(function(response) {
                // console.log(response);
                location.reload();
            });
        });
        }

        // document.querySelector("#backend").innerHTML = "<p> Backend Visibility Level : " + result["backend_visibility_level"] + "</p><br><p> The Encase backend can see your :" + res_bac + "</p><br><p> Approved :" + result["child_aproved"] +"</p><br><p> Anonymous : "+ result["anonymously"] +"</p>" ;

    });

    $.getJSON(host_8090+"/api/public/browser_addon/safety/options/" + fb_url, function(result) {
        var checkbox = result["checkbox"].split(" ");
        for (var i = 0; i < checkbox.length; i++) {

            res_sec += checkbox[i].replace("_", " ");



        }
        res_sec = res_sec.replace("hate speech", "Λεκτικό Μίσος ή Ανάρμοστη Ομιλία").replace("cyberbullying", "Εκφοβισμός στον Κυβερνοχώρο").replace("sexual grooming", "Σεξουαλική Αποπλάνηση").replace("distressed behavior", "Δυσχερής Συμπεριφορά");
        if (result["child_aproved"] == 1) {
            document.querySelector("#security").innerHTML = "<p> Cyber Security Level : " + result["security_visibility_level"] + "</p><br><p style='text-transform: capitalize;'>" + res_sec.replace("ηΛ", "η<br>Λ").replace("αΕ", "α<br>Ε").replace("οΔ", "ο<br>Δ") + "</p><br><p> Αποδοχή : Ναι</p><button id='revoke_safety' type='button' class='btn btn-danger' style='float: right; '>Aναίρεση επιλογών</button>";
            $("#revoke_safety").click(function(){
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": host_8090+"/api/public/update/browser_addon/safety_revoke/options/"+fb_url,
                "method": "PUT",
                "headers": {
                    "cache-control": "no-cache",
                    "Postman-Token": "c0a1861b-0325-48d7-88f2-687bf8ce9ad3"
                }
            }

            $.ajax(settings).done(function(response) {
                // console.log(response);
                location.reload();
            });
        });
        } else {
            document.querySelector("#security").innerHTML = "<p> Cyber Security Level : " + result["security_visibility_level"] + "</p><br><p style='text-transform: capitalize;'>" + res_sec.replace("ηΛ", "η<br>Λ").replace("αΕ", "α<br>Ε").replace("οΔ", "ο<br>Δ") + "</p><br></p><button id='aprove_security' type='button' class='btn btn-success'> Αποδέχεσαι ?</button>";
              $("#aprove_security").click(function(){
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": host_8090+"/api/public/update/browser_addon/safety/options/"+fb_url,
                "method": "PUT",
                "headers": {
                    "cache-control": "no-cache",
                    "Postman-Token": "c0a1861b-0325-48d7-88f2-687bf8ce9ad3"
                }
            }

            $.ajax(settings).done(function(response) {
                console.log(response);
                location.reload();
            });
        });
        }
        // document.querySelector("#security").innerHTML = "<p> Cyber Security Level : " + result["security_visibility_level"] + "</p><br><p> Checkbox :" + res_sec.replace("gh", "g h").replace("hc", "h c").replace("gd", "g d") + "</p><br><p> Approved :" + result["child_aproved"] +"</p>" ;

    });




$("#myBtn").click(function(){

 $.getJSON("http://35.205.106.185:18082/dal/GetChildGroups/"+fb_url, function(result){
var table_var = '';

    if(result['child_img_groups'][0]['family']){
        table_var+='<table class="table table-bordered table-hover">';
      table_var+='<tr> <td><b>Από την οικογένεια</b></td></tr>';  
    
    for (var i=0;i<result['child_img_groups'][0]['family'].length;i++){
        var str = result['child_img_groups'][0]['family'][i];
        var res = str.replace(/-/g, "/");
    table_var +='<tr><td ><a href="'+res+'" target="_blank">'+res+'</a></td></tr>';


    }
        table_var+='</table>';
    }



    if(result['child_img_groups'][0]['friends']){
        table_var+='<table class="table table-bordered table-hover">';
    table_var+='<tr> <td><b>Φίλοι - Γνωστοί</b></td></tr>';

    for (var i=0;i<result['child_img_groups'][0]['friends'].length;i++){
        var str = result['child_img_groups'][0]['friends'][i];
        var res = str.replace(/-/g, "/");
    table_var +='<tr><td><a href="'+res+'" target="_blank">'+res+'</td></tr>';
    }
    table_var+='</table>';
    }

    if(result['child_img_groups'][0]['school']){
         table_var+='<table class="table table-bordered table-hover">';
    table_var+='<tr><td><b>Από το σχολείο</b></td></tr>';

    for (var i=0;i<result['child_img_groups'][0]['school'].length;i++){
     var str = result['child_img_groups'][0]['school'][i];
        var res = str.replace(/-/g, "/");
    table_var +='<tr><td><a href="'+res+'" target="_blank">'+res+'</td></tr>';
    }
     table_var+='</table>';
    }

    if(result['child_img_groups'][0]['age']){
 table_var+='<table class="table table-bordered table-hover">';
    table_var+='<tr> <td><b>Άτομα μεγαλύτερα των 18</td></b></tr>';
    for (var i=0;i<result['child_img_groups'][0]['age'].length;i++){
   var str = result['child_img_groups'][0]['age'][i];
        var res = str.replace(/-/g, "/");
    table_var +='<tr><td><a href="'+res+'" target="_blank">'+res+'</td></tr>';
}
     table_var+='</table>';

    }

    $("#modal_show").html(table_var);
 });

 //EDIT the Image Groups

  $.getJSON("http://35.205.106.185:18082/dal/GetChildGroups/"+fb_url, function(result){
var table_var = '';
console.log("http://35.205.106.185:18082/dal/GetChildGroups/"+fb_url);

    if(result['child_img_groups'][0]['family']){
        table_var+='<table id="family" class="table table-bordered table-hover">';
      table_var+='<tr> <td><b>Οικογένεια</b></td></tr>';  
    
    for (var i=0;i<result['child_img_groups'][0]['family'].length;i++){
        var str = result['child_img_groups'][0]['family'][i];
        var res = str.replace(/-/g, "/");
    table_var +='<tr><td><input type="checkbox" name="record"></td><td id="family_'+i+'"><a href="'+res+'" target="_blank">'+res+'</a></td></tr>';


    }
        table_var+='</table><form> <input type="text" id="fb_family"> <input type="button" class="btn btn-light" id="add-row_fam" value="Πρόσθεσε το Facebook URL από κάποιο μέλος της οικογένειάς σου"> </form>';

       
    }

table_var +='<hr style=" border-top: 1px solid black; ">';

    if(result['child_img_groups'][0]['friends']){
        table_var+='<table id="friends" class="table table-bordered table-hover">';
    table_var+='<tr> <td><b>Φίλοι</b></td></tr>';

    for (var i=0;i<result['child_img_groups'][0]['friends'].length;i++){
        var str = result['child_img_groups'][0]['friends'][i];
        var res = str.replace(/-/g, "/");
    table_var +='<tr><td><input type="checkbox" name="record"></td><td id="friends_'+i+'><a href="'+res+'" target="_blank">'+res+'</td></tr>';
    }
    table_var+='</table><form> <input type="text" id="fb_friend"> <input type="button" class="btn btn-light" id="add-row_fri" value="Πρόσθεσε το Facebook URL κάποιου φίλου σου"> </form>';
    }
table_var +='<hr style=" border-top: 1px solid black; ">';
    if(result['child_img_groups'][0]['school']){
         table_var+='<table id="school" class="table table-bordered table-hover">';
    table_var+='<tr><td><b>Σχολείο</b></td></tr>';

    for (var i=0;i<result['child_img_groups'][0]['school'].length;i++){
     var str = result['child_img_groups'][0]['school'][i];
        var res = str.replace(/-/g, "/");
    table_var +='<tr><td><input type="checkbox" name="record"></td><td id="school_'+i+'><a href="'+res+'" target="_blank">'+res+'</td></tr>';
    }
     table_var+='</table><form> <input type="text" id="fb_school"> <input type="button" class="btn btn-light" id="add-row_sh" value="Πρόσθεσε το Facebook URL κάποιου από το σχολείο σου"> </form>';
    }
table_var +='<hr style=" border-top: 1px solid black; ">';
    if(result['child_img_groups'][0]['age']){
 table_var+='<table id="age" class="table table-bordered table-hover">';
    table_var+='<tr> <td><b>Άτομα > 18</td></b></tr>';
    for (var i=0;i<result['child_img_groups'][0]['age'].length;i++){
   var str = result['child_img_groups'][0]['age'][i];
        var res = str.replace(/-/g, "/");
    table_var +='<tr><td><input type="checkbox" name="record"></td><td id="age_'+i+'><a href="'+res+'" target="_blank">'+res+'</td></tr>';
}
     table_var+='</table><form> <input type="text" id="fb_age"> <input type="button" class="btn btn-light" id="add-row_age" value="Πρόσθεσε το Facebook URL κάποιου γνωστού ο οποίος είναι πάνω από 18"> </form>';



    }
      
      table_var+=' <button type="button" class="btn btn-danger delete-row">Διαγραφή επιλεγμένων σειρών</button>';
      table_var+='  <button type="submit" class="btn btn-primary" id="save_groups" style=" float: right; ">Αποθήκευση</button>';

    $("#modal_edit").html(table_var);
         $("#add-row_fam").click(function(){
            var fb_family = $("#fb_family").val();
            var markup = "<tr><td><input type='checkbox' name='record'></td><td id='family_new'>" + fb_family + "</td></tr>";
            $("#family").append(markup);
        });
          $("#add-row_fri").click(function(){
            var fb_friend = $("#fb_friend").val();
            var markup = "<tr><td><input type='checkbox' name='record'></td><td id='friends_new'>" + fb_friend + "</td></tr>";
            $("#friends").append(markup);
        });
           $("#add-row_sh").click(function(){
            var fb_school = $("#fb_school").val();
            var markup = "<tr><td><input type='checkbox' name='record'></td><td id='school_new'>" + fb_school + "</td></tr>";
            $("#school").append(markup);
        });
            $("#add-row_age").click(function(){
            var fb_age = $("#fb_age").val();
            var markup = "<tr><td><input type='checkbox' name='record'></td><td id='age_new'>" + fb_age + "</td></tr>";
            $("#age").append(markup);
        });

        $(".delete-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
                if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
        });
        $("#save_groups").click(function(){
            var json_fam=[];
            for (var i = 0; i < $('[id^=family_]').length; i++) {
                json_fam.push($('[id^=family_]')[i].innerText);
            }
            var json_fri=[];
            for (var i = 0; i < $('[id^=friends_]').length; i++) {
                json_fri.push($('[id^=friends_]')[i].innerText);
            }
             var json_sch=[];
            for (var i = 0; i < $('[id^=school_]').length; i++) {
                json_sch.push($('[id^=school_]')[i].innerText);
            }
              var json_age=[];
            for (var i = 0; i < $('[id^=age_]').length; i++) {
                json_age.push($('[id^=age_]')[i].innerText);
            }

            

//Post data to MOngoDB

var json_data = '[{"fb_url":"'+decodeURIComponent(fb_url)+'","family":'+JSON.stringify(json_fam)+',"school":'+JSON.stringify(json_sch)+',"friends":'+JSON.stringify(json_fri)+',"age":'+JSON.stringify(json_age)+'}]';

var xhr = new XMLHttpRequest();
xhr.withCredentials = true;

xhr.addEventListener("readystatechange", function () {
  if (this.readyState === 4) {
    // console.log(this.responseText +"  "+ json_data);
location.reload();
  }
});

xhr.open("POST", "http://35.205.106.185:18082/dal/SaveChildGroups");
xhr.setRequestHeader("Content-Type", "application/json");
xhr.setRequestHeader("cache-control", "no-cache");
xhr.setRequestHeader("Postman-Token", "8550cbe1-c359-4eea-9a57-62a90c1c9036");

xhr.send(json_data);



        });
 });


});



// [
//     {https:--www.facebook.com-petran88",  
//     "family" : [
//         "https:--www.facebook.com-apapasavva",
//         "https:--www.facebook.com-aaaaa",
//         "https:--www.facebook.com-marcos"
//     ],
//     "school" : [ ],
//     "friends" : [
//         "https:--www.facebook.com-44444"
//     ],
//     "age" : [
//         "https:--www.facebook.com-1231241"
//     ]}
// ]
});

