

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
</head>

<body>
  
<?php
    
    include "connect.php";
    
    $query="SELECT DISTINCT subject_name from quest";
    $result=mysqli_query($conn,$query);
    if($result && mysqli_num_rows($result)> 0){
        echo "<h2>Available Exams! </h2>";
        while($row=mysqli_fetch_assoc($result)){
            $subject=$row['subject_name'];
            echo "<a href='instructions.php?subject=". urlencode($subject) ."' target='new' style='display:inline-block
            ;margin:10px;padding:10px 20px;width:100px;background-color:#007bff;color:#fff;text-align:center;text-decoration:none;border-radius:5px;'>$subject</a><br>";
        }
    }else{
        echo "No subjects found";
    }
   

?>  
</body>

</html>