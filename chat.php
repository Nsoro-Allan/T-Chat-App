<?php
include("connection.php");
include("sessions.php");

$uname = $_SESSION['chat_username'];
$select = $con->query("SELECT * FROM `users` WHERE `username`='$uname'");
$row = mysqli_fetch_assoc($select);
$u_id = $row['user_id'];

if (isset($_POST['send_message'])) {
    $user_id = $u_id;
    $post_content = mysqli_real_escape_string($con, $_POST['post_content']);
    $post_date = date('Y-m-d H:i:s');

    $insert = $con->query("INSERT INTO `posts` (`user_id`,`post_content`,`post_date`) VALUES ('$u_id','$post_content','$post_date')");

    if ($insert) {
        header("location: chat");
    } else {
        echo
        '
                <script>
                    alert("Failed to create new post...");
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
    <title>T - Chat || Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./imgs/icon.ico" type="image/x-icon">
</head>

<body>
    <div class="main-container">
        <div class="title">
            <a href="./chat">
                <h1><img src="./imgs/icon.ico" alt=""> T - Chat - [Home]</h1>
            </a>
            <div class="line"></div>
        </div>
        <div class="details">
            <h4>Logged In As @<a href="./account"><?php echo $_SESSION['chat_username']; ?></a></h4>
            <a href="./logout.php" class="btn">SignOut</a>
        </div>
        <div class="content">
            <?php
            $select = $con->query("SELECT * FROM `posts` ORDER BY `post_id` DESC");
            if (mysqli_num_rows($select) > 0) {
                while ($row = mysqli_fetch_assoc($select)) {
                    $post_date = $row['post_date'];
                    $user_id = $row['user_id'];
                    $post_id = $row['post_id'];
                    include("time_converter.php");

                    // Like Counting
                    $view = $con->query("SELECT COUNT(*) AS `like_count` FROM `likes` WHERE `post_id`='$post_id'");
                    $post = mysqli_fetch_assoc($view);
                    $like_count = $post['like_count'];

                    // DisLike Counting
                    $view = $con->query("SELECT COUNT(*) AS `dislike_count` FROM `dislikes` WHERE `post_id`='$post_id'");
                    $post = mysqli_fetch_assoc($view);
                    $dislike_count = $post['dislike_count'];

                    $view = $con->query("SELECT * FROM `users` WHERE `user_id`='$user_id'");
                    $see = mysqli_fetch_assoc($view);
                    $username = $see['username'];
                    $profile_picture = $see['profile_picture'];

            ?>
                    <div class="content-card" id="<?= $post_id ?>">
                        <div class="card-title">
                            <img src="./uploads/<?php echo $profile_picture; ?>" alt="Avatar">
                            <h4>Sent by <span>@<a href="./profile?username=<?php echo urlencode($username); ?>"><?php echo $username; ?></a> • <?php echo $formatted_time; ?> ago</span></h4>
                        </div>
                        <div class="card-content">
                            <p><?php echo $row['post_content']; ?></p>
                        </div>
                        <div class="card-end">
                            <form action="like.php" method="post">
                                <input type="hidden" name="post_id" value="<?= $post_id ?>">
                                <button type="submit">&#128077; <?= $like_count ?></button>
                            </form>
                            <form action="dislike.php" method="post">
                                <input type="hidden" name="post_id" value="<?= $post_id ?>">
                                <button type="submit">&#128078; <?= $dislike_count ?></button>
                            </form>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "
                <div class='err'>
                <img src='./imgs/no_posts.webp'>
                <h1>No Posts Available...</h1>
                </div>
                ";
            }
            ?>
        </div>
        <div class="end">
            <form action="" method="post">
                <input type="text" name="post_content" placeholder="Type your message here..." required>
                <button type="submit" name="send_message"><img src="./imgs/send.ico" alt="Send"></button>
            </form>
        </div>
    </div>
</body>

</html>