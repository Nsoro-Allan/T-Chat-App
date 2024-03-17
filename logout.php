<?php
session_start();
include("connetion.php");

unset($_SESSION['chat_username']);
session_destroy();

header("location: index.php");

?>