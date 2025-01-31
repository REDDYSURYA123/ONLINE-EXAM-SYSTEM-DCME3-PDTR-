<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/reuse.css">
</head>


<body>

 <?php
session_start();
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {    //$_SERVER IS A SUPERGLOBAL VARIABLE
    
    $userphone = str_replace(" ","",$_POST["lphone"]);  //$_POST IS A SUPERGLOBAL VARIABLE
    $password = str_replace(" ","",$_POST["lpass"]);;

    if (empty($userphone) || empty($password)) {

        echo " <script> alert('Please fill in all fields'); </script> ";

        exit();
    }

    
    $stmt = $conn->prepare("SELECT st_pass FROM USERDTLS WHERE st_phone = ?");
    $stmt->bind_param("s", $userphone); 
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      
        $stmt->bind_result($dbPassword);
        while( $stmt->fetch()){
        if ($password === $dbPassword) {
            echo "<script>alert('Login successful!');window.location.assign('index.html');</script>" ;
          
            $que="SELECT st_phone from userdtls WHERE st_pass='$dbPassword'";
            $res=mysqli_query($conn, $que);
            if($res){
                if (mysqli_num_rows($res ) > 0) {
                    // Fetch the user's details from the database
                    $user_data = mysqli_fetch_assoc($res);
                    $_SESSION["phone_number"] = $user_data["st_phone"];
                }                
            }
            exit();
        } else {
            echo "<script>alert('Incorrect password!');</script>";
        }
       }
        
    } else {
        echo "<script>alert('User not found!');</script>";
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
        <img src="img/register.jpg" alt="">
        <form class="login_form flex" onsubmit="validate()" method="post" action=" login.php">

            <h1>Login</h1>
            <div>
                <label for="phone">Phone_no:</label>
                <input type="number" id="phone" class="username" name="lphone" required>
                <span style="color: red;" id="userError"></span>

            </div>
            <div>
                <label for="pass">Password:</label>
                <div style="display:flex;gap:10px;width:100%"><input type="password" id="pass" name="lpass" required> <button style="cursor:pointer;width:70px;height:30px;border-radius:4px;border:none;padding:5px; background-color: rgb(183, 199, 222)" type="button" id="disp" onclick="display()">Show</button>
                </div>
                <span style="color: red;" id="passError"></span>
            </div>
            <div style="line-height:s 40px;">
                <p><a href="student_forgot_pass.php">Forgot Password?</a></p>
                <p>Have not Registered?&nbsp;&nbsp;<a href="register.php">Register</a></p>
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
        function display(){
            if(document.getElementById('disp').innerHTML=="Show"){
                document.getElementById('pass').type="text";
                document.getElementById('disp').innerHTML="Hide";
            }
            else{
                document.getElementById('pass').type="password";
                document.getElementById('disp').innerHTML="Show";
            }
        }
    </script>
</body>


</html>