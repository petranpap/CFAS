<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

session_start();
include('../variable_settings/vars.php');
include('head.php');
include('menu.php');


require_once '../db.php';
$conn = new mysqli($host, $user, $pass, $db);
// Retrieve quiz details from the database based on quiz_id

if (isset($_GET['quiz_id'])) {
    $quiz_id = $_GET['quiz_id'];

    // Retrieve quiz details from the database (similar to previous queries)
    $sql_quiz = "SELECT * FROM quizzes WHERE id = ?";
    $stmt_quiz = $conn->prepare($sql_quiz);
    $stmt_quiz->bind_param("i", $quiz_id);
    $stmt_quiz->execute();
    $result_quiz = $stmt_quiz->get_result();
    $quiz = $result_quiz->fetch_assoc();

    // Retrieve questions and answer options for the quiz
    $sql_questions = "SELECT * FROM questions WHERE quiz_id = ?";
    $stmt_questions = $conn->prepare($sql_questions);
    $stmt_questions->bind_param("i", $quiz_id);
    $stmt_questions->execute();
    $result_questions = $stmt_questions->get_result();
    $questions = [];
    while ($row = $result_questions->fetch_assoc()) {
        $questions[] = $row;
    }
}
if (isset($_POST['update_quiz'])) {
    $quiz_id = $_GET['quiz_id'];

    // Update quiz details
    $new_quiz_title = $_POST['new_quiz_title'];
    $sql_update_quiz = "UPDATE quizzes SET title = ? WHERE id = ?";
    $stmt_update_quiz = $conn->prepare($sql_update_quiz);
    $stmt_update_quiz->bind_param("si", $new_quiz_title, $quiz_id);
    $stmt_update_quiz->execute();

    foreach ($_POST['answer_text'] as $key => $value) {
        //Set All asnsers as not correct (is_correct=0)
        $is_correct = 0;
        $sql_update_answer = "UPDATE answers SET answer_text = ?, is_correct = ? WHERE id = ?";
        $stmt_update_answer = $conn->prepare($sql_update_answer);
        $stmt_update_answer->bind_param("sii", $value, $is_correct, $key);
        $stmt_update_answer->execute();
    }

    // Update questions and answers
    foreach ($_POST['question_text'] as $question_id => $new_question_text) {
        // Update question text
        $sql_update_question = "UPDATE questions SET question_text = ? WHERE id = ?";
        $stmt_update_question = $conn->prepare($sql_update_question);
        $stmt_update_question->bind_param("si", $new_question_text, $question_id);
        $stmt_update_question->execute();

        foreach ($_POST['answer_text'] as $answer_id => $new_answer_text) {
            //Loop througth all the answers and if ithe anser id is in the corrent correct_answer array make the is_corret as 1

            if ($_POST['correct_answer'][$question_id] == $answer_id) {
                $is_correct = 1;
                $sql_update_answer = "UPDATE answers SET answer_text = ?, is_correct = ? WHERE id = ?";
                $stmt_update_answer = $conn->prepare($sql_update_answer);
                $stmt_update_answer->bind_param("sii", $new_answer_text, $is_correct, $answer_id);
                $stmt_update_answer->execute();
            }
        }

    }

    // Redirect to quiz list or show success message
    echo "<script>alert('Quiz created successfully!');</script>";
}
?>
 </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?php echo $_SESSION["child_first_name"] ?>'s Social Media Settings

                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Social Media Settings</li>
                </ol>
            </section>


           <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
           <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
    <form method="post">
        <!-- Display and allow editing of quiz details -->
        <input type="text" name="new_quiz_title" value="<?php echo $quiz['title']; ?>">
        <!-- Loop through questions and display/edit question details and answers -->
        <?php foreach ($questions as $question): ?>
            <div class="question">
                <label>Question Text:</label>
                <textarea name="question_text[<?php echo $question['id']; ?>]" rows="3"><?php echo $question['question_text']; ?></textarea>

                <label>Answer Options:</label>
                <?php
                // Retrieve answer options for the current question
                $sql_answers = "SELECT * FROM answers WHERE question_id = ?";
                $stmt_answers = $conn->prepare($sql_answers);
                $stmt_answers->bind_param("i", $question['id']);
                $stmt_answers->execute();
                $result_answers = $stmt_answers->get_result();
                while ($row = $result_answers->fetch_assoc()) {
                    $answer_text = $row['answer_text'];
                    $answer_id = $row['id'];
                    $is_correct = $row['is_correct'] == 1 ? 'checked' : '';
                    echo '<div class="answer">';
                    echo '<input type="radio" name="correct_answer[' . $question['id'] . ']" value="' . $answer_id . '" ' . $is_correct . '> Correct';
                    echo '<input type="text" name="answer_text[' . $answer_id . ']" value="' . $answer_text . '">';
                    echo '</div>';
                }
                ?>
            </div>
        <?php endforeach; ?>

        <input type="submit" name="update_quiz" value="Update Quiz">
    </form>

</section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
<section class="col-lg-5 connectedSortable" style="position: fixed;float: right;margin-left: 47%;font-size: large;">
           <p>Report an Incident</p>
           <p>CyberSafety Cyprus: <a href="https://www.cybersafety.cy/">www.cybersafety.cy</a></p>
           <p>ESafe Cyprus: <a href="https://www.esafecyprus.ac.cy/">www.esafecyprus.ac.cy</a></p>
           <p>Internet Safety Cyprus: <a href="https://internetsafety.pi.ac.cy/">www.internetsafety.pi.ac.cy</a></p>
           <p>Help Line Cyprus: Call 1408</p>
        </section>
<!-- right col -->
      </div>
      <!-- /.row (main row) -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
<?php include('footer.php'); ?>
