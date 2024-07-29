$(document).ready(function() {
	
	////to delete all records from db - child groups
	// json_fam=[];
	// json_fri=[];
	// json_sch=[];
	// json_age=[];
	////Post data to MOngoDB
                        // var json_data = '{"fb_url":"' + decodeURIComponent(fb_url) + '","family":' + JSON.stringify(json_fam) + ',"school":' + JSON.stringify(json_sch) + ',"friends":' + JSON.stringify(json_fri) + ',"age":' + JSON.stringify(json_age) + '}';
                        // console.log(json_data);
                        var data = "json=pppp";
                        // var xhr = new XMLHttpRequest();
                        // xhr.withCredentials = false;
                        // xhr.addEventListener("readystatechange", function() {
                            // if (this.readyState === 4) {
                                   console.log(this.responseText);
                                // location.reload();
                            // }
                        // });
                        // xhr.open("POST", "https://backendencase.cut.ac.cy:18085/dal/SaveChildGroups");
                        // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        // xhr.send(json_data);

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
                    document.querySelector("#parental").innerHTML = "<br><h5> Parental Visibility Level: " + result["parental_visibility_level"] + "</h5><br><p>Your parent can monitor:" + res_par + "</p><br><p><i>You have accepted these options!</i></p><button id='revoke_parental' type='button' class='btn btn-danger' style='float: right; '>Erase options</button>";
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
                }else {
                    document.querySelector("#parental").innerHTML = "<br><h5> Parental Visibility Level: " + result["parental_visibility_level"] + "</h5><br><p>Your parent requested to monitor:" + res_par + "</p><br><p><i>Cybersafety Family Advice Suite needs your consent to apply these options!</i></p><button id='aprove_parental' type='button' class='btn btn-success'> Accept</button>";
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
                        var anonymously = "No";
                    } else {
                        var anonymously = "Yes";
                    }
                    document.querySelector("#backend").innerHTML = "<br><h5> Backend Visibility Level: " + result["backend_visibility_level"] + "</h5><br><p>Cybersafety Family Advice Suite can receive data about:" + res_bac + "</p><br><p><i>You have accepted these options!</i>" + "</p><br><p> Send Data Anonymously: " + anonymously.replace("Yes", "Yes").replace("No", "No") + "</p><button id='revoke_backend' type='button' class='btn btn-danger' style='float: right; '>Erase options</button>";
					
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
                    document.querySelector("#backend").innerHTML = "<br><h5>Backend Visibility Level: " + result["backend_visibility_level"] + "</h5><br><p>Your parent requested to give access to Cybersafety Family Advice Suite to receive data about:" + res_bac + "</p><br><p><i>Cybersafety Family Advice Suite needs your consent to apply these options!</i></p><button id='aprove_backend' type='button' class='btn btn-success'> Accept</button>";
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
                // document.querySelector("#backend").innerHTML = "<p> Backend Visibility Level : " + result["backend_visibility_level"] + "</p><br><p>Cybersafety Family Advice Suite can see your :" + res_bac + "</p><br><p> Accepted :" + result["child_aproved"] +"</p><br><p> Anonymous : "+ result["anonymously"] +"</p>" ;
            });$.getJSON(host_8090 + "/api/public/browser_addon/safety/options/" + fb_url, function(result) {
                var checkbox = result["checkbox"].split(" ");
                for (var i = 0; i < checkbox.length; i++) {
                    res_sec += checkbox[i].replace("_", " ");
                }
                res_sec = res_sec.replace("hate speech", "Hate Speech<br>").replace("cyberbullying", "Cyberbullying<br>").replace("sexual grooming", "Sexual Grooming<br>").replace("distressed behavior", "Distressed Behavior<br>");
                if (result["child_aproved"] == 1) {
                    document.querySelector("#security").innerHTML = "<br><h5> Cybersafety Level: " + result["security_visibility_level"] + "</h5><br><p>You are protected from:<br>" +res_sec+ "</p><br><p><i>You have accepted these options!</i/></p><button id='revoke_safety' type='button' class='btn btn-danger' style='float: right; '>Erase options</button>";
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
                    document.querySelector("#security").innerHTML = "<br><h5> Cybersafety Level: " + result["security_visibility_level"] + "</h5><br><p>Your parent requests to allow Cybersafety Family Advice Suite to protect you from:<br>" + res_sec.replace("ÎÎ", "Î<br>Î").replace("ÎÎ", "Î<br>Î").replace("ÎÎ", "Î<br>Î") + "</p><br><p><i>Cybersafety Family Advice Suite needs your consent to apply these options!</i></p><button id='aprove_security' type='button' class='btn btn-success'> Accept</button>";
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
                // document.querySelector("#security").innerHTML = "<h4> Cyber Safety Level: " + result["security_visibility_level"] + "</h4><br><p> Checkbox :" + res_sec.replace("gh", "g h").replace("hc", "h c").replace("gd", "g d") + "</p><br><p> Approved :" + result["child_aproved"] +"</p>" ;
            });
            $( document ).ready(function() {
                // var table_var='<table class="table table-bordered table-hover"> <tr> <td> <b>Family Members</b> </td> </tr> <tr> <td ><a href="https://www.facebook.com/profile.php?id=100009250326366" target="_blank">https://www.facebook.com/profile.php?id=100009250326366</a></td> </tr> <tr> <td> <b>Friends - People you know</b> </td> </tr> <tr> <td ><a href="https://www.facebook.com/profile.php?id=100031062618572" target="_blank">https://www.facebook.com/profile.php?id=100031062618572</a></td> </tr> <tr> <td> <b>From School</b> </td> </tr> <tr> <td ><a href="https://www.facebook.com/pante.leonidou" target="_blank">https://www.facebook.com/pante.leonidou</a></td> </tr> <tr> <td> <b>Adults (>18 years old)</b> </td> </tr> <tr> <td ><a href="https://www.facebook.com/michael.sirivianos" target="_blank">https://www.facebook.com/michael.sirivianos</a></td> </tr> </table>';
                // $.getJSON("http://35.205.106.185:18082/dal/GetChildGroups/"+fb_url, function(result){
                $.each(json, function(result) {
                    var table_var = '<div class="card-body">';
                    if (json['child_img_groups'][0]['family']) {
                        table_var += '<table class="table table-bordered table-hover">';
                        table_var += '<tr> <td><b>Family Members</b></td></tr>';
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
                        table_var += '<tr> <td><b>Friends-People you know</b></td></tr>';
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
                        table_var += '<tr><td><b>From School</b></td></tr>';
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
                        table_var += '<tr> <td><b>Adults(>18 years old)</td></b></tr>';
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
                        table_var += '<tr> <td><b>Family</b></td></tr>';
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
					table_var += '</table><p class="form_instruction">*Fill the form to add a family member:</p><form class="forms_style"><div class="form-group"><input type="text" placeholder="Name" class="form-control" id="fb_family_name"><input type="text" placeholder="Surname" class="form-control" id="fb_family_surname"><input type="text" placeholder="Facebook URL i.e. https://www.facebook.com/john.doe/" class="form-control" id="fb_family_url"></div><div class="center" ><input  type="button" class="btn btn-primary" id="add-row_fam" value="Add family member"></div></form>';

					table_var += '<hr style=" border-top: 1px solid black; ">';
					table_var += '<table id="friends" class="table table-bordered table-hover">';
                    table_var += '<tr> <td><b>Friends</b></td></tr>';
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
					table_var += '</table><p class="form_instruction">*Fill the form to add a friend</p><form class="forms_style"><div class="form-group center"><input type="text" placeholder="Name" class="form-control" id="fb_friend_name"><input  type="text" placeholder="Surname" class="form-control" id="fb_friend_surname"><input class="form-control" placeholder="Facebook URL i.e. https://facebook.com/john.doe/" type="text" id="fb_friend_url"></div><div class="center"><input type="button" class="btn btn-primary center" id="add-row_fri" value="Add friend"></div></form>';
                    table_var += '<hr style=" border-top: 1px solid black; ">';
					table_var += '<table id="school" class="table table-bordered table-hover">';
                    table_var += '<tr><td><b>School</b></td></tr>';
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
					table_var += '</table><p>*Fill the form to add a school friend</p><form class="forms_style"><div class="form-group center"><input class="form-control" type="text" id="fb_school_name"placeholder="Name"><input class="form-control" type="text" placeholder="Surname" id="fb_school_surname"><input class="form-control" type="text" placeholder="Facebook URL i.e. https://facebook.com/john.doe/" id="fb_school_url"></div><div class="center"><input type="button" class="btn btn-primary center" id="add-row_sh" value="Add school friend"></div></form>';
                    table_var += '<hr style=" border-top: 1px solid black; ">';
                    table_var += '<table id="age" class="table table-bordered table-hover">';
                    table_var += '<tr> <td><b>Adults I know</td></b></tr>';
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
					table_var += '</table><p>*Fill the form to add an adult you know</p><form class="forms_style"><div class="form-group center"><input class ="form-control" placeholder="Name" type="text" id="fb_age_name"><input class="form-control" type="text" placeholder="Surname" id="fb_age_surname"><input class="form-control" placeholder="Facebook URL i.e. https://facebook.com/john.doe/" type="text" id="fb_age_url"></div><div class="center"><input type="button" class="btn btn-primary center" id="add-row_age" value="Add adult"></div></form>';
                                        table_var += '<hr style=" border-top: 1px solid black; ">';

                    table_var += ' <div style="text-align:center;"><button type="button" class="btn btn-danger delete-row">Delete selected rows</button>';
                    table_var += '  <button type="submit" class="btn btn-primary" id="save_groups">Save changes</button></div>';
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
				
