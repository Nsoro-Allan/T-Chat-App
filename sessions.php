<?php
session_start();
include("connection.php");

if(!isset($_SESSION['chat_username'])){
    header("Location: index.php?msg=Loggin First...");
}

?>