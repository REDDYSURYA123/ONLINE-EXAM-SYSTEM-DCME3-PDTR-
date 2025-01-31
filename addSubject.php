
<?php
// Include the database connection
include "connect.php";

// Initialize success message
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle the 'Add' button
    if (isset($_POST['add'])) {
        $subject_name = $_POST['subject_name'];
        $question = $_POST['question'];
        $option1 = $_POST['option1'];
        $option2 = $_POST['option2'];
        $option3 = $_POST['option3'];
        $option4 = $_POST['option4'];
        $correct_option = $_POST['correct_option'];

        // Insert the question and options into the database
        $stmt = $conn->prepare("INSERT INTO QUEST (subject_name, question, option_A, option_B, option_C, option_D, correct_option) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $subject_name, $question, $option1, $option2, $option3, $option4, $correct_option);
        if($stmt->execute()){
            echo"<script>alert('Question added successfully')</script>";
        }
        $stmt->close();

      
    }

    // Handle the 'Submit' button
    // if (isset($_POST['submit'])) {
    //     echo "<script>alert('Subject created successfully!');</script>";
    // }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subject</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css"> <!-- Optional for styling -->
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        label { display: block; margin: 5px 0; }
        input { margin-bottom: 10px; padding: 5px; width: 100%; }
        button { padding: 10px 15px; margin-right: 10px; cursor: pointer; }
        .container { max-width: 500px; margin: auto; }
        .success { color: green; }
    </style>
</head>
<body>
<div>
        <a href="admin.html" class="d-flex"
            style="text-decoration: none;align-items: cenetr;gap: 5px;font-size: 20px;"><i
                class="fa-solid fa-arrow-left"></i></a>
    </div>
    <div class="container">
        <h1>Add Subject and Questions</h1>
        <form method="POST" id="addingform" action="addSubject.php">
            <!-- Subject Name -->
            <label for="subject_name">Subject Name:</label>
            <input type="text" name="subject_name" id="subject_name" required>

            <!-- Question -->
            <label for="question">Question:</label>
            <input type="text" name="question" id="question" required>

            <!-- Options -->
            <label for="option1">Option A:</label>
            <input type="text" name="option1" id="option1" required>

            <label for="option2">Option B:</label>
            <input type="text" name="option2" id="option2" required>

            <label for="option3">Option C:</label>
            <input type="text" name="option3" id="option3" required>

            <label for="option4">Option D:</label>
            <input type="text" name="option4" id="option4" required>

            <!-- Correct Option -->
            <label for="correct_option">Correct Option:</label>
            <input type="text" name="correct_option" id="correct_option" required>

            <!-- Buttons -->
            <div>
                <button type="submit" name="add" onclick="checkEmpty()">Add</button>
                <button type="button" onclick="clearFields()">Clear</button>
                <!-- <button type="submit" name="submit">Submit</button> -->
            </div>
        </form>
        
        <!-- Success Message -->
        <?php if (!empty($message)): ?>
            <p class="success"><?php echo $message; ?></p>
           
        <?php endif; ?>

    </div>

    
    <script>
        window.onload = function() {
        // Reset form to clear any pre-filled data or previously selected answers
        document.getElementById("addingform").reset();
    };
        function checkEmpty() {
            var isvalid=true;
            var s=document.getElementById('subject_name').value;
            var q=document.getElementById('question').value;
            var opA=document.getElementById('option1').value;
            var opB=document.getElementById('option2').value;
            var opC=document.getElementById('option3').value;
            var opD=document.getElementById('option4').value;
            var corr_op=document.getElementById('correct_option').value;
            if(s==""||q==""||opA==""||opB==""||opC==""||opD==""||corr_op==""){
                isvalid=false;
            }
            return isvalid;
        }
        //  JavaScript for Clearing Fields 
        function clearFields() {
            // document.getElementById("subject_name").value = "";
            document.getElementById("question").value = "";
            document.getElementById("option1").value = "";
            document.getElementById("option2").value = "";
            document.getElementById("option3").value = "";
            document.getElementById("option4").value = "";
            document.getElementById("correct_option").value = "";
        }
    </script>
</body>
</html>
