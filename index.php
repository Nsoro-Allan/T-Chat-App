<?php
session_start();
include("connection.php");

if(!isset($_SESSION['chat_username'])){
    header("Location: signin.php");
}

else{
    header("Location: chat.php");
}
?>