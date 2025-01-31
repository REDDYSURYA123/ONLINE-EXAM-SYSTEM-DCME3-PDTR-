




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/reuse.css">
    <script>

    function validate(e) {

       
        const n = document.querySelector("#name").value;
        const p = document.querySelector("#pass").value;
        const m = document.querySelector("#mail").value;
        const ph = document.querySelector("#phone").value;
        var name_regex = /^[A-Za-z]+$/;
        var email_regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        document.getElementById("user").innerText = " ";
        document.getElementById("pas").innerText = " ";
        document.getElementById("ml").innerText = " ";
        document.getElementById("phn").innerText = " ";
        isValid=true;

        if (!name_regex.test(n)) {
            document.getElementById("user").innerText = "Inavlid name";
            isValid= false;
        }
        else if (p.length< 8) {
            document.getElementById("pas").innerText = "password must be atleast 8 characters";
            isValid= false;
        }
        else if (!email_regex.test(m)) {
            document.getElementById("ml").innerText = "Incorrect Email";
            isValid= false;
        }
        else if (!(/^[0-9]+$/).test(ph) || ph.length !== 10) {

            document.getElementById("phn").innerText = "Incorrect phone number";
            isValid= false;
        }
        else {
            alert("registered successfully");
            window.location.assign("login.php");
        }
        return isValid;
    }

    function display(){
        passType=document.getElementById('pass')
        text=document.getElementById('disp')
        if(passType.type=="password"){
            passType.type="text";
            text.innerText="Hide";
        }
        else{
        
            passType.type="password";
            text.innerText="Show";
        
        }
    }


</script>
</head>





<body>
<?php
    $nameerror=$passerror=$mailerror= $numerror=" ";
    // $uname=$upass=$umail=$uphone="";
    include "connect.php";
    if($_SERVER["REQUEST_METHOD"]==="POST"){

        $uname= str_replace(" ","",$_POST["rname"]);
        $upass =str_replace(" ","", $_POST["rpass"]);
        $umail = str_replace(" ","",$_POST["rmail"]);
        $uphone = str_replace(" ","",$_POST["rphone"]);
        $isvalid=true;
    
        if(!preg_match("/^[a-zA-Z-' ]*$/",$uname)){
            $nameerror=" Only letters and white space allowed";
            $isvalid=false;
        }
        if(strlen($upass)<8){
            $passerror="Password must be atleast 8 characters";
            $isvalid=false;
        }
        if(!filter_var($umail,FILTER_VALIDATE_EMAIL)){
            $mailerror="Invalid email format";
            $isvalid=false;
        }
        if(!preg_match("/^[0-9]{10}$/",$uphone)){
            $numerror=" Invalid phone number";
            $isvalid=false;
        }
   
    
        if($isvalid){
            $stmt2 = $conn->prepare("INSERT INTO USERDTLS VALUES (?, ?, ?, ?)");
            $stmt2->bind_param("ssss", $uname, $upass, $umail, $uphone);
        
        if($stmt2->execute()){
            
            header("Location:login.php");
            exit;
        }
        }
    }
     
    ?>




    <div>
        <a href="welcome.php" class="d-flex"
            style="text-decoration: none;align-items: cenetr;gap: 5px;font-size: 20px;"><i
                class="fa-solid fa-arrow-left"></i></a>
    </div>
    <section class="d-flex">
        <form class="login_form flex" onsubmit="validate()"  action="register.php" method="post">
            <h1>Register</h1>
            <div>
                <label for="name">Username:</label>
                <input type="text" id="name" name="rname" required>
                <span style="color: red;" id="user"><?php echo $nameerror;?></span>
            </div>
            <div>
                <label for="pass">Password:</label>
                <div style="display:flex;gap:10px;width:100%"><input type="password" id="pass" name="rpass" required> <button style="cursor:pointer;width:70px;height:30px;border-radius:4px;border:none;padding:5px; background-color: rgb(183, 199, 222)" type="button" id="disp" onclick="display()">Show</button>
                </div>
                <span style="color: red;" id="pas"><?php echo $passerror;?></span>
            </div>
            <div>
                <label for="mail">Gmail:</label>
                <input type="email" id="mail" name="rmail" required>
                <span style="color: red;" id="ml"><?php echo $mailerror;?></span>
            </div>
            <div>
                <label for="phone">Phone no:</label>
                <input type="number" id="phone" name="rphone" required>
                <span style="color: red;" id="phn"><?php echo $numerror;?></span>
            </div>
            <div>
                <p>Already Registered?&nbsp;&nbsp;<a href="login.php">Login</a></p>
            </div>
            <button type="submit" class="btn">REGISTER</button>
        </form>
        <img src="img/login.jpg" alt="">
    </section>
    
</body>


</html>