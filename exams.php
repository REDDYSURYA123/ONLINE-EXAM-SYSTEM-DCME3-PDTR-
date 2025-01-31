<?php
session_start();
include("connect.php");
$subject = $_GET['subject'];

if(!isset($_SESSION['subject'] )|| $_SESSION['subject']!==$subject){
    $_SESSION['subject'] = $subject;
    $subject= $_SESSION['subject'];
    $_SESSION['curr_que'] = 0;
    $_SESSION['questions'] = [];
}
// echo $subject;

$questions=[];
$query = "SELECT * FROM QUEST WHERE subject_name='$subject'";
$res = mysqli_query($conn, $query);
if ($res && mysqli_num_rows($res) > 0) {
    $i=-1;
    while ($row = mysqli_fetch_assoc($res)) {
        $i++;
        $questions[] = $row;
        // echo $questions[$i]['question'];
    }
}else{
    echo 'No questions available';
}
$total_questions = count($questions);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_SESSION['curr_que'];
    if (isset($_POST['answer'])) {
        $_SESSION['questions'][$current] = $_POST['answer'];
    } else {
        $_SESSION['questions'][$current] = '';
    }


    if (isset($_POST['next'])) {
        $_SESSION['curr_que']++;
    } elseif (isset($_POST['prev'])) {
        $_SESSION['curr_que']--;
    } elseif (isset($_POST['submit'])) {
        header("Location:results.php");
        exit;
    }
}

$current = $_SESSION["curr_que"];
$question = $questions[$current];
$selected_answer=(isset($_SESSION['questions'][$current]))?$_SESSION['questions'][$current]:'' ;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>

<body>
<div>
        <h1>SubjectName: <?php echo $subject; ?></h1>
        <form action="exams.php" method="post">
            <h2>Question <?php echo $current + 1; ?> of <?php echo $total_questions; ?></h2>
            <p><?php echo $question['question'] ?></p>
            <input type="radio" name="answer" value="A" <?php ( $selected_answer == 'A') ? 'checked' : ''; ?>><?php echo $question['option_A'] ?><br>
            <input type="radio" name="answer" value="B" <?php ( $selected_answer == 'B') ? 'checked' : ''; ?>><?php echo $question['option_B'] ?><br>
            <input type="radio" name="answer" value="C" <?php ( $selected_answer == 'C') ? 'checked' : ''; ?>><?php echo $question['option_C'] ?><br>
            <input type="radio" name="answer" value="D" <?php ( $selected_answer == 'D') ? 'checked' : ''; ?>><?php echo $question['option_D'] ?><br>
            <div>
                <?php if ($current > 0): ?>
                    <button type="submit" name="prev" class="btn">Previous</button>
                <?php endif; ?>

                <?php if ($current < $total_questions - 1): ?>
                    <button type="submit" name="next" class="btn">Next</button>
                <?php else: ?>
                    <button type="submit" name="submit" class="btn">Submit</button>
                <?php endif; ?>
            </div>
        </form>

    </div>

    
    <script>

    </script>
</body>

</html>