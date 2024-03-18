<?php
session_start();
include("connection.php");

$username=$_SESSION['chat_username'];

$delete_account=$con->query("DELETE FROM `users` WHERE `username`='$username'");

if($delete_account){
    header("Location: logout.php");
}

else{
    header("Location: delete_account?msg=failed to delete account...");
}

?>