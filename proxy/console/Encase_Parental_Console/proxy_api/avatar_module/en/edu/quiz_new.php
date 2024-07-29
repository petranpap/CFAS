<?php
 
 if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url= $_SERVER['REQUEST_URI'];    
      
    $variable_for_actionform ='https://proxyencase.cut.ac.cy:8090'.$url.'&show_answers=true';  

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../../../variable_settings/vars.php');
//$fb_url= $_GET['fb_url'];
// Quiz

// Mock database connection (replace with your actual connection)
require_once '../../../../db.php';
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve available quizzes from the database (replace with actual SQL query)
$sql = "SELECT * FROM quizzes where id = ".$_GET['quizid'];
$result = $conn->query($sql);
$quiz_data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $quiz_data[] = $row;
    }
}

// Handle quiz submission
if (isset($_POST['submit_quiz'])) {

    // Store student's answers in session
    $_SESSION['student_answers'] = $_POST['answers'];
 //    // Redirect to show the correct answers
   $quiz_id = $_POST['quiz_id'];
   $_SESSION['quiz_id'] =  $_POST['quiz_id'];
 // header("Location: student.php?quiz_id=" . $quiz_id . "&show_answers=true");

//        echo "<script>
//document.getElementsByTagName('form')[1].action = window.location.href.split('&quiz_id')[0]+'&quiz_id=" . $quiz_id . "&show_answers=true';
// window.location.href = window.location.href.split('&quiz_id')[0]+'&quiz_id=" . $quiz_id . "&show_answers=true'

//";

}


?>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Page</title>
<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<style>
                body {
            font-family: Arial, sans-serif;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
		margin: 10px;
            background-color: #00b0f03b;
            color: #fff;
        }
        header img {
            height: 80px;
        }
        .container {
            margin: 20px;
        }
        h2 {
            margin-top: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #0072b3;
            color: #fff;
            border: none;
            cursor: pointer;
        }

/* Style for the modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
}

.modal-content {
    position: relative;
    margin: 15% auto;
    width: 70%;
    background-color: #fefefe;
    padding: 20px;
    border: 1px solid #888;
}

.close {
    position: absolute;
    top: 0;
    right: 0;
    padding: 10px;
    cursor: pointer;
}

        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }

        .quiz-container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px;
        }

        h2 {
            font-size: 24px;
            margin: 0;
        }

        ul.quiz-list {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        a.quiz-link {
display: block;
    padding: 10px;
    color: #000;
    text-align: center;
    text-decoration: none;
    width: 30%;
    border-radius: 5px;
    margin: auto;
        }

        a.quiz-link:hover {
            text-decoration: underline;
        }

        .exit {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .exit:hover {
            background-color: #0056b3;
        }

        .quiz-options {
            margin-top: 20px;
        }

        .answer_style {
            margin-bottom: 10px;
        }

        input[type="radio"] {
            margin-right: 10px;
        }



        h1 {
            text-align: center;
        }
        ul.quiz-list {
            list-style: none;
            padding: 0;
        }
        ul.quiz-list li {
	margin-bottom: 10px;
    font-size: x-large;
    color: black;
    width: 30%;
    text-align: center;
    margin: auto;
    list-style-type: none;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }


section {
background: none;
    padding-top: 80px;
    overflow-y: hidden;
    border-radius: 25px;
    width: 80%;
    margin: auto
}

main {
    background: #404040;
    border-radius: 10px;
    padding: 5px 20px 50px;
    width: 95%;
    margin: 0 auto 214px;
}

.text-container {
     padding-top:10px;    
     text-align: center;
}

.quiz-options {
    margin: 60px 0;
}


label {
}

.answer_style:hover {
    background: linear-gradient(to right, #000, #fff);
  
}

label .span_answer {
    border-radius: 5px;
    border: solid 1px #000;
    padding: .4rem .5rem .4rem;
    width: 2.3rem;
    margin: 0 1.3rem 0 .7rem;
    display: flex;
    justify-content: center;
    color: #000;
    cursor: pointer !important;
}

label .icon {
    height: auto;
    position: absolute;
    left: 92%;
    top: 12px;
}

@keyframes flash {
    0% {
        background-color: #4cf5c2;
    }

    49% {
        background-color: #4cf5c2;
    }

    50% {
        background-color: #000;
    }

    99% {
        background-color: #000;
    }

    100% {
        background-color: #4cf5c2;
    }
}


#btn {
    border: 1px solid #000;
    border-radius: 50px;
    background: rgb(247, 206, 206);
    color: #000;
    display: block;
    font-size: 1.1rem;
    font-weight: 600;
    width: 57%;
    margin: 0 auto;
    outline: none;
    padding: 11px 0;
    text-align: center;
    cursor: pointer;
    -webkit-tap-highlight-color: transparent;
}
#btn:hover {
    background: rgba(255, 255, 255, 0.671);
    color: rgba(0, 0, 0, 0.749);
    border: 1px solid #000;
}

form:invalid #btn {
    pointer-events: none;
    background: rgba(248, 214, 214, 0.767);
}

.btn:hover {
    background: #000;
    color: #fff;
}

.score-counter {
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    width: 210px;
    height: 9%;
    background: rgba(0, 0, 0, 0.749);
    border: 4px solid #000;
    position: fixed;
    top: 5px;
    right: 10px;
    box-shadow: inset 2px -2px 9px #020202, inset -2px 2px 9px #d2d2d2;
}

.score-text {
    margin: 0 20px;
}

.score-counter::after {
    content: counter(points) "/5";
}

.one-a:checked,
.two-c:checked,
.three-c:checked,
.four-b:checked,
.five-a:checked {
    counter-increment: points;
}

#game-over {
    background: linear-gradient(rgb(28, 22, 49), rgba(18, 18, 25, 0.9)), repeating-linear-gradient(0, transparent, transparent 2px, black 3px, black 3px);
    font-family: 'Bungee', cursive;
    /* position: absolute; */
    width: 100%;
    height: 100vh;
}

.game-over-content {
    display: grid;
    justify-items: center;
    width: 80%;
    margin: 0 auto;
    padding: 120px 0;
}

#game-over h1 {
    background: url("https://res.cloudinary.com/dvhndpbun/image/upload/e_brightness:-20/v1588605696/01-01_web_designers_code_ld_img_dgytil.png");
    -webkit-background-clip: text;
    color: transparent;
    background-size: contain;
    font-size: 5rem;
    line-height: 1.2;
    margin: 0;
    position: relative;
}

h1::before {
    content: attr(data-heading);
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    background: linear-gradient(45deg, rgba(255, 255, 255, 0) 45%, rgba(255, 255, 255, 0.8) 50%, rgba(255, 255, 255, 0) 55%, rgba(255, 255, 255, 0) 100%);
    -webkit-background-clip: text;
    color: transparent;
    mix-blend-mode: screen;
    background-size: 200%;
    text-shadow: 2px 2px 10px rgba(#000, 0.2), -2px 2px 10px rgba(#000, 0.2), -2px -2px 10px rgba(#000, 0.2);
}

@keyframes pulse {
    0% {
        opacity: 1;
    }

    49% {
        opacity: 9;
    }

    50% {
        opacity: .8;
    }


    99% {
        opacity: .5;
    }

    100% {
        opacity: .3;
    }
}

@keyframes shine {
    0% {
        background-position: -100%;
    }

    100% {
        background-position: 100%;
    }
}

.over-text-cont {
    text-align: center;
}

.over-text-cont h2 {
    font-family: 'Sirin Stencil', cursive;
}

.over-text-cont h2::after {
    content: counter(points) "0/50";
    margin-left: 15px;
}

#refresh {
    color: #fff;
    position: relative;
    height: 100vh;
}

.refresh-content {
    display: grid;
    font-size: 1.2rem;
    place-items: center;
    width: 70%;
    line-height: 2;
    margin: 0 auto;
    text-align: center;
}

.refresh-content svg {
    width: 50px;
    height: auto;
}


/* MEDIA QUERY */

@media (max-width: 420px) {
    body {
        font-size: .8rem;
    }

    main {
        width: 92%;
    }


    label {
        font-size: .71rem;
    }

    label .span_answer {
        margin: 0 .9rem 0 .7rem;
    }


    #game-over h1 {
        font-size: 3rem;
    }

    .score-counter {
        width: 120px;
        height: 5%;
        font-size: .7rem;
    }

    .score-text {
        margin: 0 20px 0 0;
    }

    .over-text-cont h2 {
        margin-bottom: 40px;
    }

    .over-text-cont #btn {
        padding: 3px 0;
    }

    .refresh-content {
        width: 90%;
    }

    .refresh-content {
        display: grid;
        font-size: .8rem;
    }
}

@media (max-width: 325px) {

    label {
        font-size: .63rem;
    }

    label .span_answer {
        margin: 0 .55rem 0 .7rem;
    }


}


.exit{
 --color: #560bad;
 font-family: inherit;
 display: inline-block;
 width: 8em;
 height: 2.6em;
 line-height: 2.5em;
 margin: 20px;
 position: relative;
 overflow: hidden;
 border: 2px solid var(--color);
 transition: color .5s;
 z-index: 1;
 font-size: 17px;
 border-radius: 6px;
 font-weight: 500;
 color: var(--color);
cursor: pointer;
}

.exit:before {
 content: "";
 position: absolute;
 z-index: -1;
 background: var(--color);
 height: 150px;
 width: 200px;
 border-radius: 50%;
}

.exit:hover {
 color: #fff;
}

.exit:before {
 top: 100%;
 left: 100%;
 transition: all .7s;
}

.exit:hover:before {
 top: -30px;
 left: -30px;
}

.exit:active:before {
 background: #3a0ca3;
 transition: background 0s;
}

div[class^="quiz-options"] {
  border-bottom: 1px solid white;
}

    </style>
</head>
<body>
<header>
        <img src="https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/images/cfas_trans.png" alt="CFAS Logo">
<h3 style="color: #595959;">CyberSafety Education</h3>
    </header>
<div class="container">
               <!-- Quiz -->
        <div class="" id="quiz" style="display: block;">
          <div class="accordion">
  <div class="card">

        <div class="quiz-container">
                <?php if (!empty($quiz_data)): ?>

                    <ul class="quiz-list">
                        <?php foreach ($quiz_data as $quiz): ?>
                            <?php //if($quiz['start_datetime'] >=time()){?>
<li>
<button class="quiz-link btn btn-success" onclick="gotoquiz(<?php echo $quiz['id']; ?>)" style="
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 5px;
">
        Start the quiz
    </button>
</li>
                            <script type="text/javascript">
		                               function gotoquiz(id) {
                                    window.location.href = window.location.href.split('#')[0]+"&quiz_id="+id
                                }
				//gotoquiz(<?php echo $quiz['id']; ?>);
                            </script>
                            <?php //}else{ ?>
                                <!--  <p>No quizzes available.</p> -->
                                 <?php // break;  } ?>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No quizzes available.</p>
                <?php endif; ?>
        </div>
<?php


if (isset($_GET['quiz_id'])) {
    ?>
    <script type="text/javascript">
        document.querySelectorAll(".quiz-container")[0].style.display='none'
    </script>
    <?php 
    $quiz_id = $_GET['quiz_id'];

    // Retrieve quiz details from the database (replace with actual SQL query)
    $sql = "SELECT * FROM quizzes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $quiz = $result->fetch_assoc();

    if ($quiz) {
        // Retrieve questions and answer options for the selected quiz
        $sql = "SELECT * FROM questions WHERE quiz_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $quiz_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $questions = [];
        while ($row = $result->fetch_assoc()) {
            $questions[] = $row;
        }
    }

      if (isset($quiz)): ?>
    <div class="quiz-data">
        <section class="section-1" id="section-1">
            <main>
                <div class="text-container">
                <!-- HTML !-->
<!-- <button class="exit" onclick="window.close()"> X Cancel Quiz</button> !-->
		
                    <h2 style="color:white">Quiz: <?php echo $quiz['title']; ?></h2>
                </div>
<style>
#quiz-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f4f4f4;
    border-radius: 10px;
    text-align: center;
}

#options {
    margin-top: 20px;
}

button {
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
}

button:hover {
    background-color: #45a049;
}
.option {
width: 95%;
    text-align: left;
    border-bottom: aliceblue;
    padding: 5px;
}
</style>

<div id="quiz-container">
        <h2 id="question"></h2>
        <div id="options"></div>
        <button id="next-btn">Next</button>
<h2 id="res_per" style='text-align:center'></h2>

    </div>
<script>
for (let index = 0; index < document.getElementsByTagName('label').length; index++) {
        if (document.getElementsByTagName('label')[index].innerText.includes('4')) {
            document.getElementsByTagName('label')[index].style.display='none';
        }
    if (document.getElementsByTagName('label')[index].innerText.includes('5')) {
            document.getElementsByTagName('label')[index].style.display='none';
        }
}


document.addEventListener('DOMContentLoaded', function() {
    const quizContainer = document.getElementById('quiz-container');
    const questionElement = document.getElementById('question');
    const optionsForm = document.getElementById('options');
    const nextButton = document.getElementById('next-btn');
    let currentQuestionIndex = 0;
    let score = 0;

    // Fetch quiz data from JSON file
    fetch('quiz_data.json')
        .then(response => response.json())
        .then(data => {
            const quizSections = data.quiz_sections;
            loadQuestion(currentQuestionIndex);

            function loadQuestion(index) {
                const currentQuestion = quizSections[index].questions[0];
                questionElement.innerHTML = currentQuestion.question;
                optionsForm.innerHTML = '';

                currentQuestion.options.forEach(option => {
                    const optionElement = document.createElement('div');
                    optionElement.classList.add('option');
                    const input = document.createElement('input');
                    input.type = 'radio';
                    input.name = 'option';
                    input.id = option.id;
                    input.value = option.id;
                    const label = document.createElement('label');
                    label.htmlFor = option.id;
                    label.textContent = option.text;
                    optionElement.appendChild(input);
                    optionElement.appendChild(label);
                    optionsForm.appendChild(optionElement);
                });
            }

            nextButton.addEventListener('click', () => {
                const selectedOption = document.querySelector('input[name="option"]:checked');

                if (selectedOption) {
                    const selectedOptionId = selectedOption.value;
                    const currentQuestion = quizSections[currentQuestionIndex].questions[0];

                    if (selectedOptionId === currentQuestion.correct_option_id) {
                        score++;
                    }

                    currentQuestionIndex++;

                    if (currentQuestionIndex < quizSections.length) {
                        loadQuestion(currentQuestionIndex);
                    } else {
                        showResults();
                    }
                } else {
                    alert('Please select an option.');
                }
            });

function showResults() {
    const percentage = (score / quizSections.length) * 100;
    const formattedPercentage = percentage.toFixed(2); // Rounds to 2 decimal places
    quizContainer.innerHTML = `
        <h2>Your Score: ${score} out of ${quizSections.length} (${formattedPercentage}%)</h2>
        <button onclick="location.reload()">Try Again</button>
    `;
}
        })
        .catch(error => console.error('Error fetching quiz data:', error));
});


</script>

<?php endif;
}


if (isset($_GET['show_answers']) && isset($_SESSION['quiz_id'])) {
    $sql = "SELECT  a.id,a.question_id,a.answer_text,a.is_correct,q.quiz_id FROM answers a INNER JOIN questions q ON a.question_id=q.id INNER JOIN quizzes qu ON qu.id=q.quiz_id WHERE qu.id=".$_SESSION['quiz_id'];
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
        $is_correct_db = [];
        while ($row = $result->fetch_assoc()) {

            
            if ($row['is_correct'] ==1) {
array_push($is_correct_db,$row['id']);
               echo "<script>
               document.getElementById('answer_".$row['id']."').parentElement.style.background='green'
               document.getElementById('answer_".$row['id']."').parentElement.innerHTML = document.getElementById('answer_".$row['id']."').parentElement.innerHTML +'Correct Answer ✔';
               </script>";

            }

        }
           $myArray = explode(',', $_SESSION['student_answers']);
               foreach ($myArray as $key => $value) {
                   echo "<script>
                   document.getElementById('answers').style.display='none';
                   document.getElementById('submit_quiz').style.display='none';
                   document.getElementById('quiz_id').style.display='none';
               document.getElementById('answer_".$value."').parentElement.style.background='RED'
               document.getElementById('answer_".$value."').parentElement.innerHTML = document.getElementById('answer_".$value."').parentElement.innerHTML +'Your Answer X';
                

               </script>";
               }
               echo "<script>
                for (let index = 0; index < $('.answer_style').length; index++) {
                    var innserhtml_el = $('.answer_style')[index].innerHTML;
                   
                    if($('.answer_style')[index].innerHTML.includes('Correct Answer ✔Your Answer X')){
                        var innserhtml_el = innserhtml_el.replace('Correct Answer ✔Your Answer X','');
                    //     console.log(innserhtml_el)
                        $('.answer_style')[index].innerHTML =innserhtml_el + 'Correct Answer (Your Answer) ✔';
                        document.getElementsByClassName('answer_style')[index].setAttribute('style', 'background: blue !important');
                        document.getElementsByClassName('answer_style')[index].style.color='white';
                    }

}

               </script>";

$corect_std = 0;
foreach ($myArray as $key => $value) {
if($value == $is_correct_db[$key]){
$corect_std = $corect_std+1;

}
}
$percentage_result = $corect_std*100/ count($myArray);
echo "<script>$('#res_per').text('Total Result: ".$percentage_result."%')</script>";
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => "https://proxyencase.cut.ac.cy:8090/api/public/quiz_result_add/".$_GET['childid']."/".$_GET['quiz_id']."/".$percentage_result,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_SSL_VERIFYHOST =>0,
 CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json",
    "User-Agent: Mozilla/5.0",
    "Accept: json",
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

    ?>
    <script type="text/javascript">
        $("#answers").hide()
        $("#quiz_id").hide()
        $("#submit_quiz").hide()
    </script>
<?php 
}




?>
<!-- ... -->
 



    </div>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
 if (window.location.href.indexOf("&show_answers=true") > -1) {
     document.getElementsByClassName("exit")[0].style.display="none" 
}


    const quizLinks = document.querySelectorAll(".quiz-link");
    const quizContainers = document.querySelectorAll(".quiz-container");

    quizLinks.forEach(link => {
        link.addEventListener("click", function(event) {
            event.preventDefault();

            // Hide all quiz containers
            quizContainers.forEach(container => {
                container.style.display = "none";
            });

            // Show the selected quiz container
            const quizId = link.dataset.quizId;
            const selectedQuizContainer = document.getElementById(`quiz_${quizId}`);
            if (selectedQuizContainer) {
                selectedQuizContainer.style.display = "block";
            }
        });
    });


$("input").click(function(){
     var selector = 'label[for=' +this.id + ']';
    var label = document.querySelector(selector);
    $('.'+label.parentElement.parentElement.className+' > .answer_style').css("background","none")


    label.parentElement.style.background="green"
});

var check_ans = $("[class^=quiz-options_]").length //get the number of the div that contains all the answers of a question (so that we will know how may answers we should have.
// 3 questions --> check_ans will be 3


$("#submit_quiz").mouseenter(function(){

var answers_data = '';

$(".answer_style").each(function( index ) {

    if($( this ).css("background") =="rgb(0, 128, 0) none repeat scroll 0% 0% / auto padding-box border-box"){
        answers_data = answers_data+'__'+$( this ).find( "input" ).val();
        

    }
});

const answers_dataArray = answers_data.split("__");
    answers_dataArray.shift();
    console.log(answers_dataArray)
    if(check_ans == answers_dataArray.length){
  $("#answers").val(answers_dataArray  );
    }else{
        Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Please Answer All The Questions!',
  allowOutsideClick:false
})
    }

  
});



});




    </script>
  </div>

        </div>
    </div>
</div>
</div>
<script src="https://netdna.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script>


 if((window.location.hash=="#quiz") || (window.location.href.includes("quiz_id="))){

$(".col-lg-8.pb-5").hide()
$("#quiz").show()
 }

$(document).ready(function(){
                                var url_string = window.location.href
var url = new URL(url_string);
var quizid = url.searchParams.get("quizid");
//gotoquiz(quizid);
console.log(quizid);
});

</script>
<footer style="
    text-align: center;
    color: white;
    border-top: 1px solid black;
">
 <img src="https://proxyencase.cut.ac.cy:8090/fundedeu.jpg" alt="School Bus" style="
    width: 300px;
"><img src="https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/en/edu/cybersafety.jpg" alt="School Bus" style="
    width: 200px;
    height: 100px;
">
</footer>
</body>
</html>
