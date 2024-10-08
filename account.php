<?php
include("connection.php");
include("sessions.php");

$uname = $_SESSION['chat_username'];

// Select Data
$select = $con->query("SELECT * FROM `users` WHERE `username`='$uname'");
$row = mysqli_fetch_assoc($select);
$user_id = $row['user_id'];
$username = $row['username'];
$password = $row['password'];
$profile_picture = $row['profile_picture'];
$tel = $row['tel'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T - Chat || Account</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./imgs/icon.ico" type="image/x-icon">
</head>

<body>
    <div class="main-container">
        <div class="title">
            <a href="./chat">
                <h1><img src="./imgs/icon.ico" alt=""> T - Chat - [Account]</h1>
            </a>
            <div class="line"></div>
        </div>
        <div class="details">
            <h4>Logged In As @<a href="account"><?php echo $_SESSION['chat_username']; ?></a></h4>
            <a href="./logout.php" class="btn">SignOut</a>
        </div>
        <div class="content">
            <div class="account-container">
                <div class="account-head">
                    <img src="./uploads/<?php echo $profile_picture; ?>" alt="">
                    <h4>@<?php echo $username; ?></h4>
                    <a href="./settings">Account Settings</a>
                    <a href="./chat">Go Home...</a>
                </div>
                <div class="account-content">
                    <div class="title">
                        <h3>All Posts</h3>
                        <div class="line"></div>
                    </div>
                </div>
                <div class="content">
                    <?php
                    $select = $con->query("SELECT * FROM `posts` WHERE `user_id`='$user_id' ORDER BY `post_id` DESC");
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
                            <div class="content-card">
                                <div class="card-title">
                                    <img src="./uploads/<?php echo $profile_picture; ?>" alt="Avatar">
                                    <h4>Sent by <span>@<a href="#"><?php echo $username; ?></a> • <?php echo $formatted_time; ?> ago</span></h4>
                                    <a href="delete_post.php?post_id=<?php echo $row['post_id']; ?>" class="delete" alt="Delete Post..." title="Delete Post..."><img src="./imgs/delete.ico" alt=""></a>
                                </div>
                                <div class="card-content">
                                    <p><?php echo $row['post_content']; ?></p>
                                </div>
                                <div class="card-end">
                                    <form action="like.php" method="post" style="border: none; width:auto; margin-left:-10px; margin-top:-20px;">
                                        <input type="hidden" name="post_id" value="<?= $post_id ?>">
                                        <button type="submit">&#128077; <?= $like_count ?></button>
                                    </form>
                                    <form action="dislike.php" method="post" style="border: none; width:auto; margin-left:-30px; margin-top:-20px;">
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
            </div>
        </div>
    </div>
</body>

</html>