

<?php
$sub=$_GET['subject'];
?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body{
            padding: 10px 20px;
        }
        li{
            font-size: 21px;
        }
      
       button{
            padding: 15px 30px;
            border-radius: 5px;
            color: #fff;
            background-color: #007bff;
            border: none;
            width: 20%;
            margin-top: 80px;
            cursor: pointer;
            font-size: 20px;
        }

    </style>
</head>
<body>
    <a href="avail_exams.php" target="middle"><i style="font-size: 25px;" class="fa-solid fa-arrow-left"></i></a>
    <h2>Instructions</h2>
    <p style="font-size:24px;">Please read the following instructions carefully before starting the exam:</p>
    <ul>
        <li>The exam is timed, so answer quickly but carefully.</li>
        <li>Do not refresh the page while the exam is in progress.</li>
        <li>Make sure you are in a quiet, well-lit environment with no distractions.</li>
        <li>Close all other applications or tabs to avoid interruptions.</li>
        <li>Ensure your internet connection is stable and your device is fully charged.</li>
        <li>Be aware of the time limit for the exam. The timer will start once you begin the exam and will not pause.</li>
        <li>Once you finish the exam, double-check your answers before submitting.</li>
        <li>Remember, once you submit, you cannot make changes to your answers.</li>
        <li>Click "I Agree" to proceed to the exam.</li>
    </ul>   
     <form action="timer.php" method="get" >
        <input type="hidden" name="subject" value="<?php echo $sub; ?>">
        <button type="submit"> I Agree</button>
    </form>
<script>
   
</script>
</body>
</html>