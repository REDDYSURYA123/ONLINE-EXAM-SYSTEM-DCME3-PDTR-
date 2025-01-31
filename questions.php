<?php
session_start();
include "connect.php";
if(!isset($_GET['subject'])){
    echo "Subject is not selected";
    exit;
}
$subject = $_GET['subject']; // Get the subject name from the URL
if (!isset($_SESSION['subject']) || $_SESSION['subject'] !== $subject) {
    $_SESSION['subject'] = $subject; // Save subject in session
    $_SESSION['questions'] = []; // Reset answers
    $_SESSION['current_question'] = 0; // Start with the first question
    // $_SESSION['start_time'] = time(); // Set timer start time
}

// Fetch all questions for the subject
$query = "SELECT * FROM quest WHERE subject_name = '$subject'";
$result = mysqli_query($conn, $query);
$questions = [];
while ($row = mysqli_fetch_assoc($result)) {
    $questions[] = $row;
}
$total_questions = count($questions);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Save the selected answer for the current question
    $current = $_SESSION['current_question'];
    if (isset($_POST['answer'])) {
        $_SESSION['questions'][$current] = $_POST['answer'];
    } else {
        $_SESSION['questions'][$current] = '';
    }
    // Navigate based on button clicked
    if (isset($_POST['next'])) {
        $_SESSION['current_question']++;
    } elseif (isset($_POST['prev'])) {
        $_SESSION['current_question']--;
    }elseif (isset($_POST['update'])) {
        $s=$_POST['sub'];
       $que=$_POST['question'];
       $optA=$_POST['optionA'];
       $optB=$_POST['optionB'];
       $optC=$_POST['optionC'];
       $optD=$_POST['optionD'];
       $coropt=$_POST['corr_opt'];
       $upd_query=mysqli_prepare($conn,"UPDATE QUEST SET subject_name=?,question=?,option_A=?,option_B=?,option_C=?,option_D=?,correct_option=? WHERE id=?");
       mysqli_stmt_bind_param($upd_query,"sssssssi",$s,$que,$optA,$optB,$optC,$optD,$coropt,$questions[$current]['id']);
       if(mysqli_stmt_execute($upd_query)){
        echo "<script>alert('Updated Successfully');</script> ";
       }else{
        echo "<script>alert('Error in updating');</script> ";
       }
    }


    
}
$current = $_SESSION['current_question'];
$question = $questions[$current];
$selected_answer=(isset($_SESSION['questions'][$current]))?$_SESSION['questions'][$current]:'' ;


// $time_remaining = (30 * 60) - (time() - $_SESSION['start_time']); // 30-minute timer

// if ($time_remaining <= 0) {
//     header("Location: results.php"); // Redirect to results if time is up
//     exit;
// }
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam</title>
    <script>
    window.onload = function() {
        // Reset form to clear any pre-filled data or previously selected answers
        document.getElementById("examform").reset();
    };
</script>
<style>
    body{
        /* display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center; */
        height: 100vh;
        font-size: 20px;
        padding: 60px 80px;
    }
        button{
            width: 60px;
            height: 40px;
            padding: 4px 6px;
            background-color: #007bff;
            border-radius: 4px;
            color: #fff;
            border: none;
            margin-top: 10px;
            cursor: pointer;
        }
        input{margin:10px}
    </style>
</head>

<body>
    <h1><?php echo $subject; ?> Exam</h1>
    <!-- <div id="timer"></div> -->
    <form method="post" id="examform">
        <h3>Question <?php echo $current + 1; ?> of <?php echo $total_questions; ?></h3>
        Subject Name:<input style="width:300px;height:30px" type="text" name="sub" value="<?php echo $question['subject_name']; ?>" ><br>
       Question: <input style="width:700px;height:30px" type="text" name="question" value="<?php echo $question['question']; ?>" ><br>
           Option A: <input type="text" name="optionA" value="<?php echo $question['option_A']; ?>" style="width:500px;height:25px"> <br>
           Option B:<input type="text" name="optionB" value="<?php echo $question['option_B']; ?>" style="width:500px;height:25px"><br>
           Option C: <input type="text" name="optionC" value="<?php echo $question['option_C']; ?>" style="width:500px;height:25px"><br>
           Option D:<input type="text" name="optionD" value="<?php echo $question['option_D']; ?>" style="width:500px;height:25px"><br>
           Correct Option:<input type="text" name="corr_opt" value="<?php echo $question['correct_option']; ?>" style="width:500px;height:25px"><br>

           <div>
            <?php if ($current > 0) : ?>
                <button type="submit" name="prev">Previous</button>
            <?php endif; ?>

            <?php if ($current < $total_questions - 1) : ?>
                <button type="submit" name="next">Next</button>
            <?php endif; ?>
            <?php if ($current > -1) : ?>
                <button type="submit" name="update">Update</button>
            <?php endif; ?>
        </div>
    </form>
</body>

</html>