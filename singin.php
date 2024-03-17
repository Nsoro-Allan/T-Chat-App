<?php
session_start();
include("connection.php");

if(isset($_POST['login'])){
    $username=mysqli_real_escape_string($con,$_POST['username']);
    $password=mysqli_real_escape_string($con,$_POST['password']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T - Chat || Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./imgs/icon.ico" type="image/x-icon">
</head>
<body>
    <div class="login-container">
        <div class="title">
            <a href="./index.php"><h1><img src="./imgs/icon.ico" alt="Sign In"> T - Chat - [Login]</h1></a>
            <div class="line"></div>
        </div>
            <form action="" method="post">
            <label>Username:</label>
            <input type="text" name="username" placeholder="Enter your username..." required>
            <label>Password:</label>
            <input type="password" name="password" placeholder="Enter your password..." required>
            <button type="submit" name="login">Login</button>
            <p>Don't Have An Account? <a href="./signup.php">SignUp.</a></p>
            </form>
    </div>
</body>
</html>