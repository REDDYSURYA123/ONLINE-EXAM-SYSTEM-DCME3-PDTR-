<?php
include("connect.php");
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['submit']) ){
    $adminId=$_POST['adminId'];
    $adminPass=$_POST['adminPass'];
    $isvalid=true;

    if(empty($adminId) || empty($adminPass)){
        echo "<script>alert('Id and Password should not be empty');</script> ";
        $isvalid=false;
        
    }
    if(strlen((string)$adminPass)<8){
        // echo "<script>alert('Password length should not contain less than 8 characters');</script> ";
        $isvalid=false;
    }
    if($isvalid){
        $stmt1=mysqli_prepare($conn,"SELECT admin_id FROM admindtls WHERE admin_id=?");
        mysqli_stmt_bind_param($stmt1,"s", $adminId);
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_store_result($stmt1);
        if($stmt1->num_rows> 0){
            
            $stmt2="UPDATE admindtls SET admin_pass='$adminPass' WHERE admin_id='$adminId'";
            $res=mysqli_query($conn,$stmt2);
            if($res){
                echo "<script>alert('Password changed');window,location.assign('admin_login.php')</script>";
                
                exit;
            }
            
        }else{
                echo "<script>alert('Admin with that id not found');</script> ";
            }
      
    }
    
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<div>
        <a href="admin_login.php" class="d-flex"
            style="text-decoration: none;align-items: cenetr;gap: 5px;font-size: 20px;"><i
                class="fa-solid fa-arrow-left"></i></a>
    </div>
    <section>
        
        <form class="" method="post" action="admin_forgot_pass.php" onsubmit="validate()">

            <h1>Forgot Password</h1>
            <div>
                <label for="name">Admin Id:</label>
                <input type="text" id="name" class="username" name="adminId" required>
                <span style="color: red;" id="userError"></span>

            </div>
            <div style="margin-top:25px">
                <label for="pass">New Password:</label>
                <input type="password" id="pass" class="password" name="adminPass" required><br><br>
                <span style="color: red;" id="passError"></span>
            </div>
           
            <!-- <a href="index.html" class="index"> -->
            <button type="submit" name="submit" class="btn" style="margin-top:25px">Change</button>
            <!-- </a> -->
        </form>
    </section>
    <script>
        function validate(){
            let id=document.getElementById('name').value;
            let pass=document.getElementById('pass').value;
            let isvalid=true;
            if(id==" " || pass==" "){
                alert('Please fill all the details');
                isvalid=false;
            }
            else if(pass.length<8){
                alert('Password must contain more than 8 characters');
                isvalid=false;
            }
            return isvalid;
        }
    </script>
</body>
</html>