<?php
//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);

session_start();
include('../variable_settings/vars.php');
include('head.php');
include('menu.php');

// $conn = new mysqli($host, $username, $password, $dbname);
if (isset($_SESSION["parent_id"])) {

if (strpos($_SESSION["role"],  "pare") ===0) {
header("HTTP/1.0 404 Not Found");
die();
}

$child_id = $_GET['childid'];
require_once '../db.php';
$conn = new mysqli($host, $user, $pass,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

// Quiz creation/editing logic
if (isset($_POST['create_quiz'])) {
    // Establish the database connection

    $quiz_title = $_POST['quiz_title'];
    $childid = $_POST['childid'];
echo $childid;
    $questions = $_POST['questions'];
//   $start_datetime = strtotime($_POST['start_datetime']);

    // Insert the quiz into the database
    $sql = "INSERT INTO quizzes (title,start_datetime) VALUES (?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $quiz_title,$start_datetime);
    $stmt->execute();
    $quiz_id = $stmt->insert_id;
    // Insert questions and answers into the database
    foreach ($questions as $questionData) {
        $question_text = $questionData['question_text'];
        $answers = $questionData['answers'];

        // Insert the question
        $sql = "INSERT INTO questions (quiz_id, question_text) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $quiz_id, $question_text);
        $stmt->execute();
        $question_id = $stmt->insert_id;

    // Insert answers and mark one as correct
    $correct_answer_index = $questionData['correct_answer'];
    foreach ($answers as $answerIndex => $answer_text) {
        $is_correct = ($answerIndex == $correct_answer_index) ? 1 : 0;

        $sql = "INSERT INTO answers (question_id, answer_text, is_correct) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isi", $question_id, $answer_text, $is_correct);
        $stmt->execute();
    }
}
    // Close the connection
    $conn->close();
    
    // Show an alert on successful quiz creation
    echo "<script>alert('Quiz created successfully!');</script>";
}

 $url = $proxyencase.'/api/public/menu/child/'.$_SESSION["parent_id"];
                                         //echo $url;
                $content =file_get_contents($url, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
                                $json = json_decode($content, true);

}

?>
<style>
        input[type="text"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .answers{
            width: 60% !important
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
        .question{
            border: 1px solid;
    padding: 2%;
    margin-bottom: 3%;
        }

 .checkbox-wrapper-28 {
    --size: 25px;
    position: relative;
  }

  .checkbox-wrapper-28 *,
  .checkbox-wrapper-28 *:before,
  .checkbox-wrapper-28 *:after {
    box-sizing: border-box;
  }

  .checkbox-wrapper-28 .promoted-input-checkbox {
    border: 0;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }

  .checkbox-wrapper-28 input:checked ~ svg {
    height: calc(var(--size) * 0.6);
    -webkit-animation: draw-checkbox-28 ease-in-out 0.2s forwards;
            animation: draw-checkbox-28 ease-in-out 0.2s forwards;
  }
  .checkbox-wrapper-28 label:active::after {
    background-color: #e6e6e6;
  }
  .checkbox-wrapper-28 label {
    color: #0080d3;
    line-height: var(--size);
    cursor: pointer;
    position: relative;
  }
  .checkbox-wrapper-28 label:after {
    content: "";
    height: var(--size);
    width: var(--size);
    margin-right: 8px;
    float: left;
    border: 2px solid #0080d3;
    border-radius: 3px;
    transition: 0.15s all ease-out;
  }
.checkbox-wrapper-28 svg {
    stroke: #0080d3;
    stroke-width: 3px;
    height: 0;
    width: calc(var(--size) * 0.6);
    position: absolute;
    left: calc(var(--size) * 0.21);
    top: calc(var(--size) * 0.2);
    stroke-dasharray: 33;
  }

  @-webkit-keyframes draw-checkbox-28 {
    0% {
      stroke-dashoffset: 33;
    }
    100% {
      stroke-dashoffset: 0;
    }
  }
  @keyframes draw-checkbox-28 {
    0% {
      stroke-dashoffset: 33;
    }
    100% {
      stroke-dashoffset: 0;
    }
  }


.button-15 {
  background-image: linear-gradient(#42A1EC, #0070C9);
  border: 1px solid #0077CC;
  border-radius: 4px;
  box-sizing: border-box;
  color: #FFFFFF;
  cursor: pointer;
  direction: ltr;
  display: block;
  font-family: "SF Pro Text","SF Pro Icons","AOS Icons","Helvetica Neue",Helvetica,Arial,sans-serif;
  font-size: 17px;
  font-weight: 400;
  letter-spacing: -.022em;
  line-height: 1.47059;
  min-width: 30px;
  overflow: visible;
  padding: 4px 15px;
  text-align: center;
  vertical-align: baseline;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  white-space: nowrap;
}

.button-15:disabled {
  cursor: default;
  opacity: .3;
}

.button-15:hover {
  background-image: linear-gradient(#51A9EE, #147BCD);
  border-color: #1482D0;
  text-decoration: none;
}
.button-15:active {
  background-image: linear-gradient(#3D94D9, #0067B9);
  border-color: #006DBC;
  outline: none;
}

.button-15:focus {
  box-shadow: rgba(131, 192, 253, 0.5) 0 0 0 3px;
  outline: none;
}


    </style>
 </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>

                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                </ol>
            </section>


           <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
           <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
	<h2>Create Quiz</h2>
<div style=" padding: 1%; border: 1px solid; width: 60%; ">
<h3>Select Child</h3>
<?php
foreach ($json as $val) {
$child_id = $val["child_id"];
$child_first_name = $val["child_first_name"];
$child_last_name = $val["child_last_name"];
$checkbox_id = $child_first_name.''.$child_last_name.''.$child_id;
echo "<div class='checkbox-wrapper-28'><input type='checkbox' id='$checkbox_id' name='children_chk' value='$child_id' class='promoted-input-checkbox'>
<svg><use xlink:href='#checkmark-28' /></svg>
<label for='$checkbox_id'> $child_first_name $child_last_name</label><svg xmlns='http://www.w3.org/2000/svg' style='display: none'>
    <symbol id='checkmark-28' viewBox='0 0 24 24'>
      <path stroke-linecap='round' stroke-miterlimit='10' fill='none'  d='M22.9 3.7l-15.2 16.6-6.6-7.1'>
      </path>
    </symbol>
  </svg>
</div>";

}
?>
<button id="select_all" class="button-15" role="button">Select All</button>
<script>

 $("#select_all").click(function() {

        var checkBoxes = $("input[name=children_chk]");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
   });
$(document).ready(function(){
$("form").mouseenter(function(){
 var $chk = $('input[name=children_chk]:checked');
	$chk.each(function(){ 
     		$('input[name=childid]').val(this.value);
});
});
});
</script>
</div>
<br>


        <form method="post">
            <label for="quiz_title">Quiz Title:</label>
            <input type="text" name="quiz_title">
             <label for="start_datetime">Quiz Start Date and Time:</label>
<input type="datetime-local" id="start_datetime" name="start_datetime" required>
<input type="text" name="childid" val="" style="display:none">
            <!-- Add question and answer input fields here -->
            
            <!-- Question and answer input fields -->
            <div class="question-container">
                <div class="question">
                    <label for="question1">Question 1:</label>
                    <input type="text" name="questions[1][question_text]">
                    <label for="answer1">Answer Options:</label>
                    <div style="margin-top: 3%">
                        <div>
                            <label> Option 1</label>
                            <input type="text" class="answers" name="questions[1][answers][1]">
                            <input type="checkbox" name="questions[1][correct_answer]" value="1"> Correct
                        </div>
                        <div>
                            <label> Option 2</label>
                            <input type="text" class="answers" name="questions[1][answers][2]">
                            <input type="checkbox" name="questions[1][correct_answer]" value="2"> Correct
                        </div>
                        <div>
                            <label> Option 3</label>
                            <input type="text" class="answers" name="questions[1][answers][3]">
                            <input type="checkbox" name="questions[1][correct_answer]" value="3"> Correct
                        </div>
                        <div>
                            <label> Option 4</label>
                            <input type="text" class="answers" name="questions[1][answers][4]">
                            <input type="checkbox" name="questions[1][correct_answer]" value="4"> Correct
                        </div>
                        <div>
                            <label> Option 5</label>
                            <input type="text" class="answers" name="questions[1][answers][5]">
                            <input type="checkbox" name="questions[1][correct_answer]" value="5"> Correct
                        </div>
                    </div>

                   

                </div>
            </div>
            
            <!-- Add more questions and answers dynamically -->
            <button type="button" id="add-question" style=" background-color: green; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; ">+ Add Question</button>
            
            <input type="submit" name="create_quiz" value="Create Quiz">
        </form>

    <script>
         let questionCount = 1;

        document.addEventListener("DOMContentLoaded", function () {
            const addQuestionButton = document.getElementById("add-question");
            const questionContainer = document.querySelector(".question-container");

           
            addQuestionButton.addEventListener("click", function () {
                questionCount++;

                const newQuestion = document.createElement("div");
                newQuestion.classList.add("question");
                newQuestion.id = "div_"+questionCount;
                newQuestion.innerHTML = `
                 <span style=" float: right; color: red; " id="span_del_${questionCount}">X</span>
                    <label for="question${questionCount}">Question ${questionCount}:</label>
                    <input type="text" name="questions[${questionCount}][question_text]">
                    <label for="answer${questionCount}">Answer Options:</label>
                        <div style="margin-top: 3%;" >
                        <div>
                            <label> Option 1</label>
                            <input type="text" class="answers" name="questions[${questionCount}][answers][1]">
                            <input type="checkbox" name="questions[${questionCount}][correct_answer]" value="1"> Correct
                        </div>
                        <div>
                            <label> Option 2</label>
                            <input type="text" class="answers" name="questions[${questionCount}][answers][2]">
                            <input type="checkbox" name="questions[${questionCount}][correct_answer]" value="2"> Correct
                        </div>
                        <div>
                            <label> Option 3</label>
                            <input type="text" class="answers" name="questions[${questionCount}][answers][3]">
                            <input type="checkbox" name="questions[${questionCount}][correct_answer]" value="3"> Correct
                        </div>
                         <div>
                            <label> Option 4</label>
                            <input type="text" class="answers" name="questions[${questionCount}][answers][4]">
                            <input type="checkbox" name="questions[${questionCount}][correct_answer]" value="4"> Correct
                        </div>
                         <div>
                            <label> Option 5</label>
                            <input type="text" class="answers" name="questions[${questionCount}][answers][5]">
                            <input type="checkbox" name="questions[${questionCount}][correct_answer]" value="5"> Correct
                        </div>
                    </div>
        
                `;

                questionContainer.appendChild(newQuestion);
            });

             document.getElementById("add-question").onclick = function(){
            setTimeout(function(){

                // Get all the spans that start with "span_del_"
const deleteSpans = document.querySelectorAll('[id^="span_del_"]');

// Loop through each delete span and attach a click event listener
deleteSpans.forEach(span => {
    span.addEventListener('click', function() {
        // Get the div ID associated with the clicked span
        const divId = span.id.replace('span_del_', 'div_');

        // Find the corresponding div
        const divToDelete = document.getElementById(divId);

        // Delete the div if found
        if (divToDelete) {
            questionCount = 1;
            divToDelete.remove();
        }
    });

});
}, 10);
}
        });


    </script>


</section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
<section class="col-lg-5 connectedSortable" style="font-size: large;height:80%">
           <p>Report an Incident</p>
           <p>CyberSafety Cyprus: <a href="https://www.cybersafety.cy/">www.cybersafety.cy</a></p>
           <p>ESafe Cyprus: <a href="https://www.esafecyprus.ac.cy/">www.esafecyprus.ac.cy</a></p>
           <p>Internet Safety Cyprus: <a href="https://internetsafety.pi.ac.cy/">www.internetsafety.pi.ac.cy</a></p>
           <p>Help Line Cyprus: Call 1408</p>
<!-- List of quiz buttons -->
    <div id="quiz-list" style="border-top:1px solid black;margin-top=10px">
<p>Select A quiz from the following</p>
        <?php
        // Fetch quiz titles from the database
//        $sql = "SELECT id, title FROM quizzes where id=10";
//        $result = $conn->query($sql);
//        if ($result->num_rows > 0) {
//            while ($row = $result->fetch_assoc()) {
//                $id = $row['id'];
//                $quiz_title = $row['title'];
//                echo '<button class="load-quiz" data-quiz-id="' . $id . '">' . $quiz_title . '</button>';
//            }
//        }
//        ?>
<button class="load-quiz" style=" background-color: #ff8100; "> Knowledge
 Assessment Quiz</button>

<button class="load-quiz"> Knowledge GAINED
 Assessment Quiz</button>

<style>
.load-quiz {
    padding: 10px;
    font-size: 16px;
    background-color: #9700b3;
    color: #fff;
    border: none;
    cursor: pointer;
    border-radius: 25px;
    margin: 55px;
    font-size: large;
    white-space: pre;
    text-align: center;
}
</style>
    </div>
        </section>
<!-- right col -->
      </div>
      <!-- /.row (main row) -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
<?php include('footer.php'); ?>
