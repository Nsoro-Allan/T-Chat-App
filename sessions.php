<?php
session_start();
include("connection.php");

if(!isset($_SESSION['chat_username'])){
    header("Location: login.php?msg=Loggin First...");
}

?>