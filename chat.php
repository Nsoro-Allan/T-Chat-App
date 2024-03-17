<?php
include("connection.php");
include("sessions.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T - Chat || Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./imgs/icon.ico" type="image/x-icon">
</head>
<body>
    <div class="main-container">
        <div class="title">
            <a href="./chat"><h1><img src="./imgs/icon.ico" alt=""> T - Chat - [Home]</h1></a>
            <div class="line"></div>
        </div>
        <div class="details">
            <h4>Logged In As @<?php echo $_SESSION['chat_username'];?></h4>
            <a href="./logout.php">SignOut</a>
        </div>
        <div class="content">
            <?php
            $select=$con->query("SELECT * FROM `posts` ORDER BY `post_id` DESC");
            if(mysqli_num_rows($select)>0){
                while($row=mysqli_fetch_assoc($select)){
            ?>
            <div class="content-card">
                <div class="card-title">
                    <img src="./uploads/<?php echo $row['profile_picture'];?>" alt="Avatar">
                    <h4>Sent by <span>@<?php echo $row['username'];?> • <?php echo $row['post_date'];?> ago</span></h4>
                </div>
                <div class="card-content">
                    <p><?php echo $row['post_content'];?></p>
                </div>
                <div class="card-end">
                    <button>👍 0</button>
                    <button>😄 0</button>
                    <button>🔥 0</button>
                    <button>👎 0</button>
                </div>
            </div>
            <?php        
                }
            }
            else{
                echo"<h1>No Posts Available...</h1>";
            }
            ?>
        </div>
        <div class="end">
            <form action="" method="post">
                <input type="text" name="message" placeholder="Type your message here..." required>
                <button type="submit" name="send_message"><img src="./imgs/send.ico" alt="Send"></button>
            </form>
        </div>
    </div>
</body>
</html>