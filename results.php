<?php
session_start();
include "connect.php";

$subject = $_SESSION['subject'];
$questions = $_SESSION['questions'];
unset($_SESSION['questions']);
$query = "SELECT * FROM quest WHERE subject_name = '$subject'";
$result = mysqli_query($conn, $query);

$correct_answers = 0;
$total_questions = 0;
$id=0;
// Calculate total questions and correct answers
while ($row = mysqli_fetch_assoc($result)) {
    $total_questions++;
    if (isset($questions[$id]) && $questions[$id] === $row['correct_option']) {
        $correct_answers++;
    }
    $id++;
}
if(!isset( $_SESSION['phone_number'])) {
    echo "Session not initiated";
}
else{
    // Store the result in the database
$st_phone = $_SESSION['phone_number']; // Replace with the logged-in user's ID
$insert_query = "INSERT INTO results(st_phone,subject_name,score,total_questions)  VALUES ('$st_phone', '$subject', '$correct_answers', '$total_questions')";
mysqli_query($conn, $insert_query);
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
</head>

<body>
    <h1>Results</h1>
    <p>Subject: <?php echo $subject; ?></p>
    <p>Score: <?php echo $correct_answers; ?> out of <?php echo $total_questions; ?></p>
    <a href="view_results.php">View Previous Results</a>
</body>

</html>