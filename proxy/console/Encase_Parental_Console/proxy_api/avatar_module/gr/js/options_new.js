$(document).ready(function() {
            //alert(fb_url);
            var res_par = '';
            var res_bac = '';
            var res_sec = '';
            console.log("sssss" + host_8090 + "/api/public/browser_addon/parental/options/" + fb_url);
            $.getJSON(host_8090 + "/api/public/browser_addon/parental/options/" + fb_url, function(result) {
                var checkbox = result["checkbox"].split(" ");
                for (var i = 0; i < checkbox.length; i++) {
                    res_par += checkbox[i].replace("parental_fb_", "<br> Facebook ");
                }
                if (result["child_aproved"] == 1) {
                    document.querySelector("#parental").innerHTML = "<br><h5> Επίπεδο Γονικής Ορατότητας: " + result["parental_visibility_level"] + "</h5><br><p>Ο γονέας σου θα ήθελε να βλέπει:" + res_par + "</p><br><p><i>Έχεις αποδεχτεί τις επιλογές αυτές!</i></p><button id='revoke_parental' type='button' class='btn btn-danger' style='float: right; '>Aναίρεση επιλογών</button>";
                    $("#revoke_parental").click(function() {
                        var settings = {
                            "async": true,
                            "crossDomain": true,
                            "url": host_8090 + "/api/public/update/browser_addon/parental_revoke/options/" + fb_url,
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
                    document.querySelector("#parental").innerHTML = "<br><h5> Επίπεδο Γονικής Ορατότητας: " + result["parental_visibility_level"] + "</h5><br><p>Ο γονέας σου θα ήθελε να βλέπει:" + res_par + "</p><br><p><i>Το Cybersafety Family Advice Suite χρειάζεται τη συγκατάθεσή σου για να εφαρμόσει αυτές τις επιλογές!</i></p><button id='aprove_parental' type='button' class='btn btn-success'> Αποδέχομαι</button>";
                    $("#aprove_parental").click(function() {
                        var settings = {
                            "async": true,
                            "crossDomain": true,
                            "url": host_8090 + "/api/public/update/browser_addon/parental/options/" + fb_url,
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
            $.getJSON(host_8090 + "/api/public/browser_addon/backend/options/" + fb_url, function(result) {
                var checkbox = result["checkbox"].split(" ");
                for (var i = 0; i < checkbox.length; i++) {
                    res_bac += checkbox[i].replace("backend_fb_", "<br> Facebook ");
                }
                if (result["child_aproved"] == 1) {
                    if (result["anonymously"] == 0) {
                        var anonymously = "Όχι";
                    } else {
                        var anonymously = "Ναι";
                    }
                    document.querySelector("#backend").innerHTML = "<br><h5> Επίπεδο ορατότητας συστήματος: " + result["backend_visibility_level"] + "</h5><br><p>Το Cybersafety Family Advice Suite μπορεί να λάβει δεδομένα σχετικά με:" + res_bac + "</p><br><p><i>Έχεις αποδεχτεί αυτές τις επιλογές!</i>" + "</p><br><p> Αποστολή δεδομένων ανώνυμα: " + anonymously.replace("Yes", "Yes").replace("No", "No") + "</p><button id='revoke_backend' type='button' class='btn btn-danger' style='float: right; '>Aναίρεση επιλογών</button>";
                    $("#revoke_backend").click(function() {
                        var settings = {
                            "async": true,
                            "crossDomain": true,
                            "url": host_8090 + "/api/public/update/browser_addon/backend_revoke/options/" + fb_url,
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
                    document.querySelector("#backend").innerHTML = "<br><h5>Επίπεδο ορατότητας συστήματος: " + result["backend_visibility_level"] + "</h5><br><p>Ο γονέας σου ζήτησε να δώσει πρόσβαση στο Cybersafety Family Advice Suite για να λάβει δεδομένα σχετικά με: " + res_bac + "</p><br><p><i>Το Cybersafety Family Advice Suite χρειάζεται τη συγκατάθεσή σας για να εφαρμόσει αυτές τις επιλογές!</i></p><button id='aprove_backend' type='button' class='btn btn-success'> Αποδέχομαι</button>";
                    $("#aprove_backend").click(function() {
                        var settings = {
                            "async": true,
                            "crossDomain": true,
                            "url": host_8090 + "/api/public/update/browser_addon/backend/options/" + fb_url,
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
                // document.querySelector("#backend").innerHTML = "<p> Επίπεδο ορατότητας συστήματος: " + result["backend_visibility_level"] + "</p><br><p>Ο γονέας σου ζήτησε να δώσει πρόσβαση στο Cybersafety Family Advice Suite για να λάβει δεδομένα σχετικά με:" + res_bac + "</p><br><p> Αποδοχή: " + result["child_aproved"] +"</p><br><p> Ανώνυμα: "+ result["anonymously"] +"</p>" ;
            });
            $.getJSON(host_8090 + "/api/public/browser_addon/safety/options/" + fb_url, function(result) {
                var checkbox = result["checkbox"].split(" ");
                for (var i = 0; i < checkbox.length; i++) {
                    res_sec += checkbox[i].replace("_", " ");
                }
                res_sec = res_sec.replace("hate speech", "Λεκτικό Μίσος ή Ανάρμοστη Ομιλία<br>").replace("cyberbullying", "Εκφοβισμός στον Κυβερνοχώρο<br>").replace("sexual grooming", "Σεξουαλική Αποπλάνηση<br>").replace("distressed behavior", "Δυσχερής Συμπεριφορά<br>");
                if (result["child_aproved"] == 1) {
                    document.querySelector("#security").innerHTML = "<br><h5> Επίπεδο Κυβερνοασφάλειας: " + result["security_visibility_level"] + "</h5><br><p>Προστατεύεστε από: <br>" +res_sec+ "</p><br><p><i>Έχεις αποδεχτεί αυτές τις επιλογές!</i/></p><button id='revoke_safety' type='button' class='btn btn-danger' style='float: right; '>Aναίρεση επιλογών</button>";
                    $("#revoke_safety").click(function() {
                        var settings = {
                            "async": true,
                            "crossDomain": true,
                            "url": host_8090 + "/api/public/update/browser_addon/safety_revoke/options/" + fb_url,
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
                    document.querySelector("#security").innerHTML = "<br><h5> Επίπεδο κυβερνοασφάλειας: " + result["security_visibility_level"] + "</h5><br><p>Ο γονέας σας ζητά να επιτρέψει στο Cybersafety Family Advice Suite να σας προστατεύσει από:<br>" + res_sec.replace("Î·Î›", "Î·<br>Î›").replace("Î±Î•", "Î±<br>Î•").replace("Î¿Î”", "Î¿<br>Î”") + "</p><br><p><i>Το Cybersafety Family Advice Suite χρειάζεται τη συγκατάθεσή σου για να εφαρμόσει αυτές τις επιλογές!</i></p><button id='aprove_security' type='button' class='btn btn-success'> Αποδέχομαι</button>";
                    $("#aprove_security").click(function() {
                        var settings = {
                            "async": true,
                            "crossDomain": true,
                            "url": host_8090 + "/api/public/update/browser_addon/safety/options/" + fb_url,
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
                // document.querySelector("#security").innerHTML = "<h4> Επίπεδο κυβερνοασφάλειας: " + result["security_visibility_level"] + "</h4><br><p> Πλαίσιο ελέγχου:" + res_sec.replace("gh", "g h").replace("hc", "h c").replace("gd", "g d") + "</p><br><p> Αποδοχή: " + result["child_aproved"] +"</p>" ;
            });
			
			
			$( document ).ready(function() {
                // var table_var='<table class="table table-bordered table-hover"> <tr> <td> <b>Οικογένεια</b> </td> </tr> <tr> <td ><a href="https://www.facebook.com/profile.php?id=100009250326366" target="_blank">https://www.facebook.com/profile.php?id=100009250326366</a></td> </tr> <tr> <td> <b>Friends - People you know</b> </td> </tr> <tr> <td ><a href="https://www.facebook.com/profile.php?id=100031062618572" target="_blank">https://www.facebook.com/profile.php?id=100031062618572</a></td> </tr> <tr> <td> <b>From School</b> </td> </tr> <tr> <td ><a href="https://www.facebook.com/pante.leonidou" target="_blank">https://www.facebook.com/pante.leonidou</a></td> </tr> <tr> <td> <b>Adults (>18 years old)</b> </td> </tr> <tr> <td ><a href="https://www.facebook.com/michael.sirivianos" target="_blank">https://www.facebook.com/michael.sirivianos</a></td> </tr> </table>';
                // $.getJSON("http://35.205.106.185:18082/dal/GetChildGroups/"+fb_url, function(result){
                $.each(json, function(result) {
                    var table_var = '<div class="card-body">';
                    if (json['child_img_groups'][0]['family']) {
                        table_var += '<table class="table table-bordered table-hover">';
                        table_var += '<tr> <td><b>Οικογένεια</b></td></tr>';
                                                var family_length=json['child_img_groups'][0]['family'].length;
                                                if(family_length>0){
                                                        for (var i = 0; i < json['child_img_groups'][0]['family'].length; i++) {
                                                                var str = json['child_img_groups'][0]['family'][i];
                                                                var name= str['name'];
                                                                var url=str['url'].replace(/-/g,"/");
                                                                //var res = str.replace(/-/g, "/");
                                                                table_var += '<tr><td ><a href="' + url + '" target="_blank">' + name + '</a></td></tr>';
                                                        }
                                                }
                        table_var += '</table>';
                    }
                    if (json['child_img_groups'][0]['friends']) {
                        table_var += '<table class="table table-bordered table-hover">';
                        table_var += '<tr> <td><b>Φίλοι-Άτομα που γνωρίζω</b></td></tr>';
                                                var friends_length=json['child_img_groups'][0]['friends'].length;
                                                if(friends_length>0){
                                                        for (var i = 0; i < json['child_img_groups'][0]['friends'].length; i++) {
                                                                var str = json['child_img_groups'][0]['friends'][i];
                                                                var name= str['name'];
                                                                var url=str['url'].replace(/-/g,"/");
                                                                //var res = str.replace(/-/g, "/");
                                                                table_var += '<tr><td><a href="' + url + '" target="_blank">' + name + '</a></td></tr>';
                                                        }
                                                }
                        table_var += '</table>';
                    }
                                        if (json['child_img_groups'][0]['school']) {
                        table_var += '<table class="table table-bordered table-hover">';
                        table_var += '<tr><td><b>Σχολείο</b></td></tr>';
                                                var school_length=json['child_img_groups'][0]['school'].length;
                                                if(school_length>0){
                                                        for (var i = 0; i < json['child_img_groups'][0]['school'].length; i++) {
                                                                var str = json['child_img_groups'][0]['school'][i];
                                                                var name= str['name'];
                                                                var url=str['url'].replace(/-/g,"/");
                                                                //var res = str.replace(/-/g, "/");
                                                                table_var += '<tr><td><a href="' + url + '" target="_blank">' + name + '</a></td></tr>';
                                                        }
                                                }
                        table_var += '</table>';
                    }
                    if (json['child_img_groups'][0]['age']) {
                        table_var += '<table class="table table-bordered table-hover">';
                        table_var += '<tr> <td><b>Ενήλικοι (άνω των 18 ετών)</td></b></tr>';
                                                var age_length=json['child_img_groups'][0]['age'].length;
                                                if(age_length>0){
                                                        for (var i = 0; i < json['child_img_groups'][0]['age'].length; i++) {
                                                                var str = json['child_img_groups'][0]['age'][i];
                                                                var name= str['name'];
                                                                var url=str['url'].replace(/-/g,"/");
                                                                //var res = str.replace(/-/g, "/");
                                                                table_var += '<tr><td><a href="' + url + '" target="_blank">' + name + '</a></td></tr>';
                                                        }
                                                }

                        table_var += '</table></div>';
                    }
                    $("#modal_show").html(table_var);
                    $("#modal_edit").html(table_var);
                });


                //EDIT the Image Groups
                //  $.getJSON("http://35.205.106.185:18082/dal/GetChildGroups/"+fb_url, function(result){
                $.each(json, function(result) {
                    var table_var = '';
                                        table_var += '<table id="family" class="table table-bordered table-hover">';
                        table_var += '<tr> <td><b>Οικογένεια</b></td></tr>';
                    if (json['child_img_groups'][0]['family']) {
                                                var family_length=json['child_img_groups'][0]['family'].length;
                                                if(family_length>0){
                                                        for (var i = 0; i < json['child_img_groups'][0]['family'].length; i++) {
                                                                var str = json['child_img_groups'][0]['family'][i];
                                                                var name= str['name'];
                                                                var url=str['url'].replace(/-/g,"/");

                                                                //var res = str.replace(/-/g, "/");
                                                                table_var += '<tr><td><input type="checkbox" name="record"></td><td id="family_' + i + '"><a href="' + url + '" target="_blank">' + name + '</a></td></tr>';
                                                        }
                                                }
                    }
                                        table_var += '</table><p class="form_instruction">*Συμπλήρωσε για να προσθέσεις άτομο στο γκρουπ Οικογένεια:</p><form class="forms_style"><div class="form-group"><input type="text" placeholder="Name" class="form-control" id="fb_family_name"><input type="text" placeholder="Surname" class="form-control" id="fb_family_surname"><input type="text" placeholder="Facebook URL i.e. https://www.facebook.com/john.doe/" class="form-control" id="fb_family_url"></div><div class="center" ><input  type="button" class="btn btn-primary" id="add-row_fam" value="Προσθήκη"></div></form>';

                                        table_var += '<hr style=" border-top: 1px solid black; ">';
                                        table_var += '<table id="friends" class="table table-bordered table-hover">';
                    table_var += '<tr> <td><b>Φίλοι-Άτομα που γνωρίζω</b></td></tr>';
                    if (json['child_img_groups'][0]['friends']) {
                                                var friends_length=json['child_img_groups'][0]['friends'].length;
                                                if(friends_length>0){
                                                        for (var i = 0; i < json['child_img_groups'][0]['friends'].length; i++) {
                                                                var str = json['child_img_groups'][0]['friends'][i];
                                                                var name= str['name'];
                                                                var url=str['url'].replace(/-/g,"/");
                                                                //var res = str.replace(/-/g, "/");
                                                                table_var += '<tr><td><input type="checkbox" name="record"></td><td id="friends_' + i + '"><a href="' + url + '" target="_blank">' + name + '</td></tr>';
                                                        }
                                                }
                    }
                                        table_var += '</table><p class="form_instruction">*Συμπλήρωσε για να προσθέσεις άτομο στο γκρουπ Φίλοι-Άτομα που γνωρίζω</p><form class="forms_style"><div class="form-group center"><input type="text" placeholder="Name" class="form-control" id="fb_friend_name"><input  type="text" placeholder="Surname" class="form-control" id="fb_friend_surname"><input class="form-control" placeholder="Facebook URL i.e. https://facebook.com/john.doe/" type="text" id="fb_friend_url"></div><div class="center"><input type="button" class="btn btn-primary center" id="add-row_fri" value="Προσθήκη"></div></form>';
                    table_var += '<hr style=" border-top: 1px solid black; ">';
                                        table_var += '<table id="school" class="table table-bordered table-hover">';
                    table_var += '<tr><td><b>Σχολείο</b></td></tr>';
                    if (json['child_img_groups'][0]['school']) {
                                                var school_length=json['child_img_groups'][0]['school'].length;
                                                if(school_length>0){
                                                        for (var i = 0; i < json['child_img_groups'][0]['school'].length; i++) {
                                                                var str = json['child_img_groups'][0]['school'][i];
                                                                var name= str['name'];
                                                                var url=str['url'].replace(/-/g,"/");
                                                                //var res = str.replace(/-/g, "/");
                                                                table_var += '<tr><td><input type="checkbox" name="record"></td><td id="school_' + i + '"><a href="' + url + '" target="_blank">' + name + '</td></tr>';
                                                        }
                                                }
                    }
                                        table_var += '</table><p>*Συμπλήρωσε για να προσθέσεις άτομο στο γκρουπ Σχολείο</p><form class="forms_style"><div class="form-group center"><input class="form-control" type="text" id="fb_school_name"placeholder="Name"><input class="form-control" type="text" placeholder="Surname" id="fb_school_surname"><input class="form-control" type="text" placeholder="Facebook URL i.e. https://facebook.com/john.doe/" id="fb_school_url"></div><div class="center"><input type="button" class="btn btn-primary center" id="add-row_sh" value="Προσθήκη"></div></form>';
                    table_var += '<hr style=" border-top: 1px solid black; ">';
                    table_var += '<table id="age" class="table table-bordered table-hover">';
                    table_var += '<tr> <td><b>Ενήλικες (άνω των 18 ετών)</td></b></tr>';
                                        if (json['child_img_groups'][0]['age']) {

                                                var age_length=json['child_img_groups'][0]['age'].length;
                                                if(age_length>0){
                                                        for (var i = 0; i < json['child_img_groups'][0]['age'].length; i++) {
                                                                var str = json['child_img_groups'][0]['age'][i];
                                                                //var res = str.replace(/-/g, "/");
                                                                var name= str['name'];
                                                                var url=str['url'].replace(/-/g,"/");
                                                                table_var += '<tr><td><input type="checkbox" name="record"></td><td id="age_' + i + '"><a href="' + url + '" target="_blank">' + name + '</td></tr>';
                                                        }
                                                }
                    }
                                        table_var += '</table><p>*Συμπλήρωησε για να προσθέσεις άτομο στο γκρουπ Ενήλικες (άνω των 18 ετών)</p><form class="forms_style"><div class="form-group center"><input class ="form-control" placeholder="Name" type="text" id="fb_age_name"><input class="form-control" type="text" placeholder="Surname" id="fb_age_surname"><input class="form-control" placeholder="Facebook URL i.e. https://facebook.com/john.doe/" type="text" id="fb_age_url"></div><div class="center"><input type="button" class="btn btn-primary center" id="add-row_age" value="Προσθήκη"></div></form>';
                                        table_var += '<hr style=" border-top: 1px solid black; ">';

                    table_var += ' <div style="text-align:center;"><button type="button" class="btn btn-danger delete-row">Διαγραφή επελεγμένων</button>';
                    table_var += '  <button type="submit" class="btn btn-primary" id="save_groups">Αποθήκευση Αλλαγών</button></div>';
                                        $("#modal_edit").html(table_var);
                    $("#add-row_fam").click(function() {
                        //var fb_family = $("#fb_family").val();
                                                var fb_family_name=$("#fb_family_name").val();
                                                var fb_family_surname=$("#fb_family_surname").val();
                                                var fb_family_url=$("#fb_family_url").val();
                                                var markup = "<tr><td><input type='checkbox' name='record'></td><td id='family_"+family_length+"'><a href='"+fb_family_url+"'target=_blank>" + fb_family_name+" "+fb_family_surname + "</a></td></tr>";
                        family_length+=1
                                                $("#family").append(markup);
                                                $("#fb_family_name").val("");
                                                $("#fb_family_surname").val("");
                                                $("#fb_family_url").val("");
                    });
                    $("#add-row_fri").click(function() {
                                                var fb_friend_name=$("#fb_friend_name").val();
                                                var fb_friend_surname=$("#fb_friend_surname").val();
                                                var fb_friend_url=$("#fb_friend_url").val();
                        var markup = "<tr><td><input type='checkbox' name='record'></td><td id='friends_"+friends_length+"'><a href='"+fb_friend_url+"'target=_blank>" + fb_friend_name+" "+fb_friend_surname + "</a></td></tr>";
                        friends_length+=1
                                                $("#friends").append(markup);
                                                $("#fb_friend_name").val("");
                                                $("#fb_friend_surname").val("");
                                                $("#fb_friend_url").val("");

                    });
                    $("#add-row_sh").click(function() {

                                                var fb_school_name=$("#fb_school_name").val();
                                                var fb_school_surname=$("#fb_school_surname").val();
                                                var fb_school_url=$("#fb_school_url").val();
                        var markup = "<tr><td><input type='checkbox' name='record'></td><td id='school_"+school_length+"'><a href='"+fb_school_url+"'target=_blank>" + fb_school_name+" "+fb_school_surname + "</a></td></tr>";
                        school_length+=1
                                                $("#school").append(markup);
                                                $("#fb_school_name").val("");
                                                $("#fb_school_surname").val("");
                                                $("#fb_school_url").val("");

                    });
                    $("#add-row_age").click(function() {
                                                var fb_age_name=$("#fb_age_name").val();
                                                var fb_age_surname=$("#fb_age_surname").val();
                                                var fb_age_url=$("#fb_age_url").val();
                        var markup = "<tr><td><input type='checkbox' name='record'></td><td id='age_"+age_length+"'><a href='"+fb_age_url+"'target=_blank>" + fb_age_name+" "+fb_age_surname + "</a></td></tr>";
                        age_length+=1
                                                $("#age").append(markup);
                                                $("#fb_age_name").val("");
                                                $("#fb_age_surname").val("");
                                                $("#fb_age_url").val("");
                    });
                    $(".delete-row").click(function() {
                                                to_delete=[]
                        $("table tbody").find('input[name="record"]').each(function() {
                            if ($(this).is(":checked")) {

                                                                //var url =$(this).parents("td").siblings("td").first().children().first().attr('href');

                                                                //alert(url);
                                                                //to_delete.push(url);

                                $(this).parents("tr").remove();
                                }
                    });


                    });
                    $("#save_groups").click(function() {
                        var json_fam = [];
                        for (var i = 0; i < $('[id^=family_]').length; i++) {
                                                        //json_fam.push($('[id^=family_]')[i].innerText);
                                                        var family_name=$('[id^=family_]')[i].firstChild.innerText;
                                                        var family_url= $('[id^=family_]')[i].firstChild.href;
                                                        family_record = { "name": family_name, "url":family_url.replace(/\//g,"-")  };
                            json_fam.push(family_record);
                        }
                        var json_fri = [];
                        for (var i = 0; i < $('[id^=friends_]').length; i++) {
                            var friends_name=$('[id^=friends_]')[i].firstChild.innerText;
                                                        var friends_url= $('[id^=friends_]')[i].firstChild.href;
                                                        friend_record = { "name": friends_name, "url":friends_url.replace(/\//g,"-")  };
                            json_fri.push(friend_record);
                                                        //json_fri.push($('[id^=friends_]')[i].innerText);
                        }
                        var json_sch = [];
                        for (var i = 0; i < $('[id^=school_]').length; i++) {
                                                        var school_name=$('[id^=school_]')[i].firstChild.innerText
                                                        var school_url= $('[id^=school_]')[i].firstChild.href
                                                        school_record = { "name": school_name, "url":school_url.replace(/\//g,"-")  };
                            json_sch.push(school_record);
                            //json_sch.push($('[id^=school_]')[i].innerText);
                        }
                        var json_age = [];
                                                for (var i = 0; i < $('[id^=age_]').length; i++) {
                                                        var age_name=$('[id^=age_]')[i].firstChild.innerText
                                                        var age_url= $('[id^=age_]')[i].firstChild.href
                                                        age_record = { "name": age_name, "url":age_url.replace(/\//g,"-")  };
                            json_age.push(age_record);
                            //json_age.push($('[id^=age_]')[i].innerText);
                        }

                        //Post data to MOngoDB
                        var json_data = '{"fb_url":"' + decodeURIComponent(fb_url) + '","family":' + JSON.stringify(json_fam) + ',"school":' + JSON.stringify(json_sch) + ',"friends":' + JSON.stringify(json_fri) + ',"age":' + JSON.stringify(json_age) + '}';
                        console.log(json_data);
                        //var data = "json=pppp";
                        var xhr = new XMLHttpRequest();
                        xhr.withCredentials = false;
                        xhr.addEventListener("readystatechange", function() {
                            if (this.readyState === 4) {
                                //    console.log(this.responseText);
                                location.reload();
                            }
                        });
                        xhr.open("POST", "https://backendencase.cut.ac.cy:18085/dal/SaveChildGroups");
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
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
