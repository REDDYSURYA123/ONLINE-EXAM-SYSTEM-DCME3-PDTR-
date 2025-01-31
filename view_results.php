<?php
session_start();
include "connect.php";
 // Replace with logged-in user ID
 if(!isset($_SESSION["phone_number"])){
    echo "session not initiated";
    exit;
 }
 else{
    $phone=$_SESSION['phone_number'];
 }

$query = "SELECT * FROM results WHERE st_phone = '$phone'";
$result = mysqli_query($conn, $query);

// unset($_SESSION['phone_number']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Results</title>
</head>

<body>
    <h1>Previous Results</h1>
    <table border="1" cellspacing="0">
        <tr>
            <th>Subject</th>
            <th>Correct answers</th>
            <th>Wrong answers</th>
            <th>Total Questions</th>
            <th>Date</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?php echo $row['subject_name']; ?></td>
                <td><?php echo $row['score']; ?></td>
                <td><?php echo $row['total_questions']-$row['score']; ?></td>
                <td><?php echo $row['total_questions']; ?></td>
                <td><?php echo $row['attempted_at']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>