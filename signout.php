<?php
session_start();
$_SESSION['id'] = NULL;
session_destroy();
header('Location: signin.php');
?>