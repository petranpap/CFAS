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
                // var table_var='<table class="table table-bordered table-hover"> <tr> <td> <b>Family Members</b> </td> </tr> <tr> <td ><a href="https://www.facebook.com/profile.php?id=100009250326366" target="_blank">https://www.facebook.com/profile.php?id=100009250326366</a></td> </tr> <tr> <td> <b>Friends - People you know</b> </td> </tr> <tr> <td ><a href="https://www.facebook.com/profile.php?id=100031062618572" target="_blank">https://www.facebook.com/profile.php?id=100031062618572</a></td> </tr> <tr> <td> <b>From School</b> </td> </tr> <tr> <td ><a href="https://www.facebook.com/pante.leonidou" target="_blank">https://www.facebook.com/pante.leonidou</a></td> </tr> <tr> <td> <b>Adults (>18 years old)</b> </td> </tr> <tr> <td ><a href="https://www.facebook.com/michael.sirivianos" target="_blank">https://www.facebook.com/michael.sirivianos</a></td> </tr> </table>';
                // $.getJSON("http://35.205.106.185:18082/dal/GetChildGroups/"+fb_url, function(result){
                $.each(json, function(result) {
                    var table_var = '<div class="card-body">';
                    if (json['child_img_groups'][0]['family']) {
                        table_var += '<table class="table table-bordered table-hover">';
                        table_var += '<tr> <td><b>Από την οικογένεια</b></td></tr>';

                        for (var i = 0; i < json['child_img_groups'][0]['family'].length; i++) {
                            var str = json['child_img_groups'][0]['family'][i];
                            window.alert(str);
                            var res = str.toString().replace(/-/g, "/");

                            table_var += '<tr><td ><a href="' + res + '" target="_blank">' + res + '</a></td></tr>';
                        }
                        table_var += '</table>';
                    }
                    if (json['child_img_groups'][0]['friends']) {
                        table_var += '<table class="table table-bordered table-hover">';
                        table_var += '<tr> <td><b>Φίλοι - Γνωστοί</b></td></tr>';
                        for (var i = 0; i < json['child_img_groups'][0]['friends'].length; i++) {
                            var str = json['child_img_groups'][0]['friends'][i];
                            var res = str.toString().replace(/-/g, "/");
                            table_var += '<tr><td><a href="' + res + '" target="_blank">' + res + '</td></tr>';
                        }
                        table_var += '</table>';
                    }
                    if (json['child_img_groups'][0]['school']) {
                        table_var += '<table class="table table-bordered table-hover">';
                        table_var += '<tr><td><b>Από το σχολείο</b></td></tr>';
                        for (var i = 0; i < json['child_img_groups'][0]['school'].length; i++) {
                            var str = json['child_img_groups'][0]['school'][i];
                            var res = str.toString().replace(/-/g, "/");
                            table_var += '<tr><td><a href="' + res + '" target="_blank">' + res + '</td></tr>';
                        }
                        table_var += '</table>';
                    }
                    if (json['child_img_groups'][0]['age']) {
                        table_var += '<table class="table table-bordered table-hover">';
                        table_var += '<tr> <td><b>Άτομα μεγαλύτερα των 18</td></b></tr>';
                        for (var i = 0; i < json['child_img_groups'][0]['age'].length; i++) {
                            var str = json['child_img_groups'][0]['age'][i];
                            var res = str.toString().replace(/-/g, "/");
                            table_var += '<tr><td><a href="' + res + '" target="_blank">' + res + '</td></tr>';
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
                    if (json['child_img_groups'][0]['family']) {
                        table_var += '<table id="family" class="table table-bordered table-hover">';
                        table_var += '<tr> <td><b>Οικογένεια</b></td></tr>';

                        for (var i = 0; i < json['child_img_groups'][0]['family'].length; i++) {
                            var str = json['child_img_groups'][0]['family'][i];
                            var res = str.toString().replace(/-/g, "/");
                            table_var += '<tr><td><input type="checkbox" name="record"></td><td id="family_' + i + '"><a href="' + res + '" target="_blank">' + res + '</a></td></tr>';
                        }
                        table_var += '</table><form> <input type="text" id="fb_family"> <input type="button" class="btn btn-light" id="add-row_fam" value="Πρόσθεσε το Facebook URL από κάποιο μέλος της οικογένειάς σου"> </form>';

                    }
                    table_var += '<hr style=" border-top: 1px solid black; ">';
                    if (json['child_img_groups'][0]['friends']) {
                        table_var += '<table id="friends" class="table table-bordered table-hover">';
                        table_var += '<tr> <td><b>Φίλοι</b></td></tr>';
                        for (var i = 0; i < json['child_img_groups'][0]['friends'].length; i++) {
                            var str = json['child_img_groups'][0]['friends'][i];
                            var res = str.toString().replace(/-/g, "/");
                            table_var += '<tr><td><input type="checkbox" name="record"></td><td id="friends_' + i + '><a href="' + res + '" target="_blank">' + res + '</td></tr>';
                        }
                        table_var += '</table><form> <input type="text" id="fb_friend"> <input type="button" class="btn btn-light" id="add-row_fri" value="Πρόσθεσε το Facebook URL κάποιου φίλου σου"> </form>';
                    }
                    table_var += '<hr style=" border-top: 1px solid black; ">';
                    if (json['child_img_groups'][0]['school']) {
                        table_var += '<table id="school" class="table table-bordered table-hover">';
                        table_var += '<tr><td><b>Σχολείο</b></td></tr>';
                        for (var i = 0; i < json['child_img_groups'][0]['school'].length; i++) {
                            var str = json['child_img_groups'][0]['school'][i];
                            var res = str.toString().replace(/-/g, "/");
                            table_var += '<tr><td><input type="checkbox" name="record"></td><td id="school_' + i + '><a href="' + res + '" target="_blank">' + res + '</td></tr>';
                        }
                        table_var += '</table><form> <input type="text" id="fb_school"> <input type="button" class="btn btn-light" id="add-row_sh" value="Πρόσθεσε το Facebook URL κάποιου από το σχολείο σου"> </form>';
                    }
                    table_var += '<hr style=" border-top: 1px solid black; ">';
                    if (json['child_img_groups'][0]['age']) {
                        table_var += '<table id="age" class="table table-bordered table-hover">';
                        table_var += '<tr> <td><b>Άτομα > 18</td></b></tr>';
                        for (var i = 0; i < json['child_img_groups'][0]['age'].length; i++) {
                            var str = json['child_img_groups'][0]['age'][i];
                            var res = str.toString().replace(/-/g, "/");
                            table_var += '<tr><td><input type="checkbox" name="record"></td><td id="age_' + i + '><a href="' + res + '" target="_blank">' + res + '</td></tr>';
                        }
                        table_var += '</table><form> <input type="text" id="fb_age"> <input type="button" class="btn btn-light" id="add-row_age" value="Πρόσθεσε το Facebook URL κάποιου γνωστού ο οποίος είναι πάνω από 18"> </form>';
                    }

                    table_var += ' <button type="button" class="btn btn-danger delete-row">Διαγραφή επιλεγμένων σειρών</button>';
                    table_var += '  <button type="submit" class="btn btn-primary" id="save_groups" style=" float: right; ">Αποθήκευση</button>';
                    $("#modal_edit").html(table_var);
                    $("#add-row_fam").click(function() {
                        var fb_family = $("#fb_family").val();
                        var markup = "<tr><td><input type='checkbox' name='record'></td><td id='family_new'>" + fb_family + "</td></tr>";
                        $("#family").append(markup);
                    });
                    $("#add-row_fri").click(function() {
                        var fb_friend = $("#fb_friend").val();
                        var markup = "<tr><td><input type='checkbox' name='record'></td><td id='friends_new'>" + fb_friend + "</td></tr>";
                        $("#friends").append(markup);
                    });
                    $("#add-row_sh").click(function() {
                        var fb_school = $("#fb_school").val();
                        var markup = "<tr><td><input type='checkbox' name='record'></td><td id='school_new'>" + fb_school + "</td></tr>";
                        $("#school").append(markup);
                    });
                    $("#add-row_age").click(function() {
                        var fb_age = $("#fb_age").val();
                        var markup = "<tr><td><input type='checkbox' name='record'></td><td id='age_new'>" + fb_age + "</td></tr>";
                        $("#age").append(markup);
                    });
                    $(".delete-row").click(function() {
                        $("table tbody").find('input[name="record"]').each(function() {
                            if ($(this).is(":checked")) {
                                $(this).parents("tr").remove();
                            }
                        });
                    });
                    $("#save_groups").click(function() {
                        var json_fam = [];
                        for (var i = 0; i < $('[id^=family_]').length; i++) {
                            json_fam.push($('[id^=family_]')[i].innerText);
                        }
                        var json_fri = [];
                        for (var i = 0; i < $('[id^=friends_]').length; i++) {
                            json_fri.push($('[id^=friends_]')[i].innerText);
                        }
                        var json_sch = [];
                        for (var i = 0; i < $('[id^=school_]').length; i++) {
                            json_sch.push($('[id^=school_]')[i].innerText);
                        }
                        var json_age = [];
                        for (var i = 0; i < $('[id^=age_]').length; i++) {
                            json_age.push($('[id^=age_]')[i].innerText);
                        }

                        //Post data to MOngoDB
                        var json_data = '{"fb_url":"' + decodeURIComponent(fb_url) + '","family":' + JSON.stringify(json_fam) + ',"school":' + JSON.stringify(json_sch) + ',"friends":' + JSON.stringify(json_fri) + ',"age":' + JSON.stringify(json_age) + '}';
                        console.log(json_data);
                        //var data = "json=pppp";
                        var xhr = new XMLHttpRequest();
                        xhr.withCredentials = true;
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
