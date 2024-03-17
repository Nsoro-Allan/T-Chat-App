<?php
session_start();
include("connection.php");
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
    <style>
        img{
            width: 80%;
            border-radius:20px;
            margin-top: 10px;
        }
        a{
            padding: 10px 15px;
            background: #fff;
            color: black;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            text-align: center;
            margin-top: 10px;
        }
    </style>
    <div class="login-container">
        <div class="title">
            <h1>Page Not Found</h1>
            <div class="line"></div>
        </div>
        <img src="./imgs/404_animation.gif" alt="">
        <a href="./chat">Go Home...</a>
    </div>
</body>
</html>