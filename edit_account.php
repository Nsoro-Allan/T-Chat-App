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
$hashpassword=$password;

if (isset($_POST['edit_account'])) {
    // Update user information
    $new_username = mysqli_real_escape_string($con,$_POST['username']);
    $new_password = mysqli_real_escape_string($con,$_POST['password']);
    $new_tel = mysqli_real_escape_string($con,$_POST['tel']);

    // Update the user's information in the database
    $update = $con->query("UPDATE `users` SET `username`='$new_username', `password`='$new_password', `tel`='$new_tel' WHERE `user_id`='$user_id'");
    
    if ($update) {
        echo "Account updated successfully!";
        // Refresh the page or redirect to show the updated information
        header("Refresh:0");
    } else {
        echo "Failed to update account.";
    }
}

$profile_picture=$row['profile_picture'];
$tel=$row['tel'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T - Chat || Edit Account</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./imgs/icon.ico" type="image/x-icon">
</head>
<body>
    <div class="main-container">
        <div class="title">
            <a href="./chat"><h1><img src="./imgs/icon.ico" alt=""> T - Chat - [Edit Account]</h1></a>
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
                    </div>
                </div>
            
                <form action="" method="post">
                    <label>Username:</label>
                    <input type="text" name="username" value="<?php echo $username;?>">
                    <label>Password:</label>
                    <input type="text" name="password" value="<?php echo $hashpassword;?>">
                    <label>Tel:</label>
                    <input type="tel" name="tel" value="<?php echo $tel;?>">
                    <button type="submit" name="edit_account">Edit Account...</button>
                </form>
            </div>       
        </div>
    </div>
</body>
</html>
