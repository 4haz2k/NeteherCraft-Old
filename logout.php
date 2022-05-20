<?php
require "DB.php";
session_start();
unset($_SESSION['nickname']);
unset($_SESSION['user_hash']);
session_destroy();
header('Location: index.php');
?>