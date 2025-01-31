<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/admin_login.css">
    <link rel="stylesheet" href="css/reuse.css">
</head>


<body>

<?php

include "connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $admin = $_POST["aname"];
    $pass = $_POST["apass"];

    
    if (empty($admin) || empty($pass)) {
        echo "<script>alert('Please fill in all fields');</script>";
        exit();
    }

    
    $stmt = $conn->prepare("SELECT admin_pass FROM admindtls WHERE admin_id = ?");
    $stmt->bind_param("s", $admin); 
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
       
        $stmt->bind_result($dbPassword);
        $stmt->fetch();

        
        if ($pass == $dbPassword) {
            echo "<script>alert('Login successful!');window.location.assign('admin.html');</script>";
        } else {
            echo "<script>alert('Incorrect password!');</script>";
        }
    } else {
        echo "<script>alert('Username not found!');</script>";
    }

    $stmt->close();
   
}
?> 





    <div>
        <a href="welcome.php" class="d-flex"
            style="text-decoration: none;align-items: cenetr;gap: 5px;font-size: 20px;"><i
                class="fa-solid fa-arrow-left"></i></a>
    </div>
    <section>
        
        <form class="login_form flex" onsubmit="validate()" method="post" action="admin_login.php">

            <h1>Login</h1>
            <div>
                <label for="name">Admin Id:</label>
                <input type="number" id="name" class="username" name="aname" required>
                <span style="color: red;" id="userError"></span>

            </div>
            <div>
                <label for="pass">Password:</label>
                <input type="password" id="pass" class="password" name="apass" required>
                <span style="color: red;" id="passError"></span>
            </div>
            <div style="line-height:s 40px;">
                <p><a href="admin_forgot_pass.php">Forgot Password?</a></p>
            
            </div>
            <!-- <a href="index.html" class="index"> -->
            <button type="submit" class="btn">LOGIN</button>
            <!-- </a> -->
        </form>
    </section>

    <script>
        function validate() {
            let isValid = true;

            const username = document.getElementById("name").value.trim();
            const password = document.getElementById("pass").value.trim();

            document.getElementById("userError").innerText = "";
            document.getElementById("passError").innerText = "";

            if (username === "") {
                document.getElementById("userError").innerText = "Username is required";
                isValid = false;
            }

            if (password === "") {
                document.getElementById("passError").innerText = "Password is required";
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>


</html>