<?php
session_start();
include("connection.php");
$username=$_SESSION['chat_username'];
if(isset($_POST['verify'])){
    $password=mysqli_real_escape_string($con, $_POST['password']);
    $hashed_password=md5($password);

    $verify=$con->query("SELECT * FROM `users` WHERE `username`='$username' && `password`='$hashed_password'");
    if($row=$verify->fetch_assoc()){
        header("location: delete_account");
    }
    else{
        echo
        '
            <script>
                alert("You Have Entered Invalid Password...");
            </script>
        ';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T - Chat || Delete Account Verification</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./imgs/icon.ico" type="image/x-icon">
</head>
<body>
    <div class="login-container">
        <div class="title">
            <a href="./login"><h1><img src="./imgs/icon.ico" alt="Sign In"> T - Chat - [Verification]</h1></a>
            <div class="line"></div>
        </div>
            <form action="" method="post">
            <label>Enter Your Password:</label>
            <input type="password" name="password" placeholder="Enter your password..." required>
            <button type="submit" name="verify">Verify</button>
            <p>Don't want to delete account? <a href="./chat">Go Home...</a></p>
            </form>
    </div>
</body>
</html>