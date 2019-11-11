<?php
session_start();
//$_SESSION['id'] = NULL;
//$_SESSION['username'] = NULL;
unset($_SESSION['id']);
unset($_SESSION['username']);
session_destroy();
header('Location: signin.php');
?>