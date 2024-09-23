<?php
include("connection.php");
include("sessions.php");

$post_id = $_POST['post_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];

    $uname = $_SESSION['chat_username'];
    $select = $con->query("SELECT * FROM `users` WHERE `username`='$uname'");
    $row = mysqli_fetch_assoc($select);
    $user_id = $row['user_id'];

    //  Check if the user has already liked the post
    $query = $con->query("SELECT * FROM `dislikes` WHERE `user_id` = '$user_id'  AND `post_id` = '$post_id'");

    if (mysqli_num_rows($query) == 0) {
        // User hasn't liked the post, so add the like
        $insert = $con->query("INSERT INTO `dislikes` (`user_id`, `post_id`) VALUES ('$user_id','$post_id')");
    } else {
        // User has already liked the post, so remove the like
        $remove=$con->query("DELETE FROM `dislikes` WHERE `user_id`='$user_id' AND `post_id`='$post_id'");
    }
}

// Redirect back to the previous page
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
