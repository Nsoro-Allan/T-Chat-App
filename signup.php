<?php
session_start();
include("connection.php");
// Login Verification
if(isset($_SESSION['chat_username'])){
    header("Location: chat");
}

if(isset($_POST['signup'])){
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $tel = mysqli_real_escape_string($con, $_POST['tel']);
    
        // Check if the username is already in use
        $check_username = $con->query("SELECT * FROM `users` WHERE username = '$username'");
        if ($check_username->num_rows > 0) {
            echo
            '
                <script>
                    alert("The username you used is already in use.<br> Please choose another username.");
                </script>
            ';
        } else {
            $hashed_password = md5($password);
        }
    
        // File Upload Logic
        if(isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture']['name'])) {
            $target_folder = "uploads/";
            $profile_picture = $_FILES['profile_picture']['name'];
            $target_path = $target_folder . $profile_picture;
    
            // Move the uploaded file to the target folder
            if(move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_path)) {
                // Insert user data into the database
                $insert = $con->query("INSERT INTO `users` (`username`,`password`,`profile_picture`,`tel`) VALUES ('$username', '$hashed_password', '$profile_picture','$tel')");
    
                if($insert){
                    $_SESSION['chat_username'] = $username;
                    header("location: chat");
                } else {
                    echo
                    '
                        <script>
                            alert("Failed to create user account...");
                        </script>
                    ';
                }
            } else {
                echo
                '
                    <script>
                        alert("Failed to upload profile picture");
                    </script>
                ';
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T - Chat || SignUp</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./imgs/icon.ico" type="image/x-icon">
</head>
<body>
    <div class="login-container">
        <div class="title">
            <a href="./signup"><h1><img src="./imgs/icon.ico" alt="Sign Up"> T - Chat - [SignUp]</h1></a>
            <div class="line"></div>
        </div>
            <form action="" method="post" enctype="multipart/form-data">
            <label>Username:</label>
            <input type="text" name="username" placeholder="Enter your username..." required>
            <label>Password:</label>
            <input type="password" name="password" placeholder="Enter your password..." required>
            <label>Profile Picture:</label>
            <input type="file" name="profile_picture" accept="image/*" required>
            <label>Tel:</label>
            <input type="tel" name="tel" placeholder="Enter your tel..." required>
            <button type="submit" name="signup">Sign Up</button>
            <p>Already Have An Account? <a href="./login">Sign In.</a></p>
            </form>
    </div>
</body>
</html>