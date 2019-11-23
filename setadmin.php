<?php
require_once('tables.php');
session_start();
if (isset($_SESSION['user']) && isset($_GET['id'])){
    if ($_GET['code'] == 0) $p = 0;
    elseif ($_GET['code'] == 1) $p = 1;
    else die("");
    
    $query = "update user set permissions = ".$p.", authorizedby = {$_SESSION['user']->id} where id = {$_GET['id']};";
    $con = connect();
    mysqli_query($con, $query) or die($query);
    mysqli_close($con);
    die("working");
} else die("");
?>