<?php
session_start();
include "connect.php";
if (!isset($_GET['subject'])) {
    echo "Subject is not selected";
    exit;
}
$subject = $_GET['subject']; // Get the subject name from the URL
if (!isset($_SESSION['subject']) || $_SESSION['subject'] !== $subject) {
    $_SESSION['subject'] = $subject; // Save subject in session
    $_SESSION['questions'] = []; // Reset answers
    $_SESSION['current_question'] = 0;
    // Start with the first question
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
    } elseif (isset($_POST['submit'])) {
        $_SESSION['current_question'] = 0;
        header("Location: results.php");
        exit;
    }



}
$current = $_SESSION['current_question'];
$question = $questions[$current];
$selected_answer = (isset($_SESSION['questions'][$current])) ? $_SESSION['questions'][$current] : '';


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
        window.onload = function () {
            // Reset form to clear any pre-filled data or previously selected answers
            document.getElementById("examform").reset();
        };
    </script>
    <style>
        body {
            /* display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center; */
            height: 100vh;
            font-size: 25px;
        }

        button {
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
    </style>
</head>

<body>

    <h1><?php echo $subject; ?> Exam</h1>
    <!-- <div id="timer"></div> -->
    <form method="post" id="examform">
        <h3>Question <?php echo $current + 1; ?> of <?php echo $total_questions; ?></h3>
        <div style="display:flex;gap:50px;">
            <p><?php echo $question['question']; ?></p>

            <p>Time:<span id="timer"></span></p>

        </div>
        <label>
            <input type="radio" name="answer" value="A" <?php echo ($selected_answer === 'A') ? 'checked' : ''; ?>>
            <?php echo $question['option_A']; ?>
        </label><br>
        <label>
            <input type="radio" name="answer" value="B" <?php echo ($selected_answer === 'B') ? 'checked' : ''; ?>>
            <?php echo $question['option_B']; ?>
        </label><br>
        <label>
            <input type="radio" name="answer" value="C" <?php echo ($selected_answer === 'C') ? 'checked' : ''; ?>>
            <?php echo $question['option_C']; ?>
        </label><br>
        <label>
            <input type="radio" name="answer" value="D" <?php echo ($selected_answer === 'D') ? 'checked' : ''; ?>>
            <?php echo $question['option_D']; ?>
        </label><br>

        <div>
            <?php if ($current > 0): ?>
                <button type="submit" name="prev">Previous</button>
            <?php endif; ?>

            <?php if ($current < $total_questions - 1): ?>
                <button type="submit" name="next">Next</button>
            <?php else: ?>
                <button type="submit" name="submit">Submit</button>
            <?php endif; ?>
        </div>
    </form>
    <script>
        
    </script>
</body>

</html>