<?php
session_start();
include("connection.php");

if(!isset($_SESSION['chat_username'])){
    header("Location: login");
}

else{
    header("Location: chat");
}
?>