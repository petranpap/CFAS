 
// Running every 5 second : It is opening the url that gets the database changes, it checks the condition (line 16) and closes the connection.
//Script to Load jQuery inside the Javascript
(function() {
    var startingTime = new Date().getTime();
    // Load the script
    var script = document.createElement("SCRIPT");
    script.src = 'js/jquery.js';
    script.type = 'text/javascript';


    // Poll for jQuery to come into existance
    var checkReady = function(callback) {
        if (window.jQuery) {
            callback(jQuery);
        }
        else {
            window.setTimeout(function() { checkReady(callback); }, 20);
        }
    };

    // Start polling...
    checkReady(function($) {
        $(function() {
            var endingTime = new Date().getTime();
            var tookTime = endingTime - startingTime;
            // window.alert("jQuery is loaded, after " + tookTime + "milliseconds!");
                    });
    });
})();

window.setInterval(function(){
// var request = new XMLHttpRequest();

// //Checks a database that changes according to the rule we want to check and if it is changed then it will do the action we want to 

// // It is a dummy database //
// request.open('GET', 'http://localhost/getrecords.php', true);

// request.onload = function () {
// 	// begin accessing JSON data here
// 	var res = JSON.parse(this.response);
// // alert("Entering the loop !");
// 	for (var i = 0; i < res.length; i++) {
// 		console.log(res[i].first_name);

// // checks the condition
//     if (res[i].first_name == "john1234") {s
//    		document.write('Website is blocked due to Content Filtering.');
//    		document.write('<br>');
//    		document.write('Please advise your parent.');
//    		document.write('\n'); 	
//         // throw new Error("Something went badly wrong!");
//         Abort();
//     }
// // document.write('1') 	s
// }
// }
//Facebook Messenger id = #facebook ._5yl5
var fbmsg_lenght = document.getElementById('facebook').getElementsByClassName('_5yl5').length;
  var count_fbmsgs = $("div.fbNub._50mz._s0f .fbDockChatTabFlyout").length;
  // console.log(count_fbmsgs);
var fbmsg_array=[];
var fbmsg_array_sender=[];
for (j=0;j<count_fbmsgs; j++){
for (i = 0; i < fbmsg_lenght; i++) { 
	// console.log(fbmsg_lenght);
	// console.log(i);
// Get the Facebook Messenger Conversation 
  var fbmsg = document.getElementById('facebook').getElementsByClassName('_5yl5')[i].innerText;
  //document.getElementsByClassName('_1nc6')[1].innerText;
  //   var fbmsg_child = document.getElementsByClassName('_1nc6')[i].innerText;;
  // console.log(fbmsg_child);
  //We also get the HTML just to bbe sure
  // var fbmsg_html = document.getElementById('facebook').getElementsByClassName('titlebarText').attr('data-tooltip')[i];
  // console.log(fbmsg_html);
  //Last we get the name of the one that the child conversates with
  //#facebook ._-kb a.titlebarText
  
  var fbmsg_name = document.getElementById('facebook').getElementsByClassName('titlebarText')[j].innerText;

	fbmsg_name=JSON.stringify(fbmsg_name);
  // console.log(fbmsg_name);
// throw new Error("Something went badly wrong!");
// document.write('2')  
// text = fbmsg.textContent;
//Push 
fbmsg_array.push(fbmsg);

var fbmsg_array_json=JSON.stringify(fbmsg_array);

fbmsg_array_json=fbmsg_array_json.replace("'", ' ');
fbmsg_array_json=fbmsg_array_json.replace("[", ' ');
fbmsg_array_json=fbmsg_array_json.replace("]", ' ');
 // console.log(fbmsg_lenght);
// console.log("fbmsg_html"+fbmsg_html);
// console.log("fbmsg_name"+fbmsg_name);
// console.log(fbmsg_array_json);
// $fb_msg_text=$_POST['fb_msg'];
          //
           // $fb_sender_name=$_POST['sender_name'];

$.ajax({
        type: "POST",
        dataType: "json",
        url: "https://3e8ab7ad.ngrok.io/dist/php/insertfromchild.php",
        data: {'fb_msg':fbmsg_array_json,'sender_name':fbmsg_name}, 
        cache: false,

        success: function(data){
            console.log(data);
        }
    });



// if (fbmsg == "Ναι έτσι μπράβο"){
//   alert (fbmsg);
// }

}
}

 }, 5000);

function Abort()
{
	//Now we stop the javascript so it now showing the messages every second .
	window.stop();
	//Console.log 
   throw new Error('This is not an error. This is just to abort javascript');
}
