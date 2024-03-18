<?php
session_start();
include("connection.php");

$post_id=$_GET['post_id'];
$delete=$con->query("DELETE FROM `posts` WHERE `post_id`='$post_id'");

if($delete){
    header("Location: account");
}

else{
    header("location: account?msg=Failed to delete post...");
}

?>