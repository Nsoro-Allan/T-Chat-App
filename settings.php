<?php
include("connection.php");
include("sessions.php");

$uname=$_SESSION['chat_username'];

// Select Data
$select=$con->query("SELECT * FROM `users` WHERE `username`='$uname'");
$row=mysqli_fetch_assoc($select);
$user_id=$row['user_id'];
$username=$row['username'];
$password=$row['password'];
$profile_picture=$row['profile_picture'];
$tel=$row['tel'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T - Chat || Settings</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./imgs/icon.ico" type="image/x-icon">
</head>
<body>
    <div class="main-container">
        <div class="title">
            <a href="./chat"><h1><img src="./imgs/icon.ico" alt=""> T - Chat - [Settings]</h1></a>
            <div class="line"></div>
        </div>
        <div class="details">
            <h4>Logged In As @<a href="account"><?php echo $_SESSION['chat_username'];?></a></h4>
            <a href="./logout.php" class="btn">SignOut</a>
        </div>
        <div class="content">
        <div class="account-container">
                <div class="account-head">
                    <img src="./uploads/<?php echo $profile_picture;?>" alt="">
                    <h4>@<?php echo $username;?></h4>
                    <div class="account-head-buttons">
                    <a href="./chat">Go Home...</a>
                    <a href="./edit_account">Edit Account Info</a>
                    <a href="./delete_verification">Delete Account</a>
                    </div>
                </div>
        </div>       
        </div>
        </div>
    </div>
</body>
</html>