<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<?php
    $passerror = ""; // Initialize error message
    include "connect.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $uname = trim($_POST["rname"]); // Trim spaces
        $upass = trim($_POST["rpass"]); // Trim spaces
        $isvalid = true;

        // Validate password length
        if (strlen($upass) < 8) {
            $passerror = "Password must be at least 8 characters long.";
            $isvalid = false;
        }

        if ($isvalid) {
            // Check if the username exists first
            $stmt = $conn->prepare("SELECT st_phone FROM userdtls WHERE st_phone = ?");
            $stmt->bind_param("s", $uname);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // Username exists, proceed to update the password
                $stmt2 = $conn->prepare("UPDATE userdtls SET st_pass = ? WHERE st_phone = ?");
                $stmt2->bind_param("ss", $upass, $uname);

                if ($stmt2->execute()) {
                    echo "<script>alert('Password changed successfully.'); window.location.href = 'login.php';</script>";
                } else {
                    echo "<script>alert('An error occurred while updating the password.');</script>";
                }
                $stmt2->close();
            } else {
                // Username does not exist
                echo "<script>alert('Username not found.');</script>";
            }
            $stmt->close();
        }
    }
?>

<div>
    <a href="login.php" style="text-decoration: none; font-size: 20px;">
        <i class="fa-solid fa-arrow-left"></i> Back to Login
    </a>
</div>
<section>
    <form action="forgot_pass.php" method="post">
        <h1>Change Password</h1>
        
        <div>
            <label for="name">Phone No:</label>
            <input type="number" id="name" name="rname" required>
        </div>
        <div style="margin-top:30px">
            <label for="pass">New Password:</label>
            <div style="display: flex; gap: 10px; width: 100%;">
                <input type="password" id="pass" name="rpass" required>
                <button style="cursor: pointer; width: 70px; height: 30px; border-radius: 4px; border: none; padding: 5px; background-color: rgb(183, 199, 222);" 
                        type="button" id="disp" onclick="display()">Show</button>
            </div>
            <span style="color: red;" id="pas"><?php echo $passerror; ?></span>
        </div>
        
        <button type="submit" class="btn" style="margin-top:30px">Change Password</button>
    </form>
</section>

<script>
    function display() {
        const passInput = document.getElementById('pass');
        const toggleButton = document.getElementById('disp');
        if (toggleButton.innerHTML === "Show") {
            passInput.type = "text";
            toggleButton.innerHTML = "Hide";
        } else {
            passInput.type = "password";
            toggleButton.innerHTML = "Show";
        }
    }
</script>

</body>
</html>