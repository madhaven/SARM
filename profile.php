<?php
require('tables.php');
checksession();
if (isset($_GET['username']))
    $user = new userwithname($_GET['username']);
else
    $user = new userwithid($_SESSION['id']);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Jitin J Gigi">
    <title>SARM | Username</title>
    <link rel="stylesheet" href="source/bootstrapmin.css">
    <link rel="stylesheet" href="source/style.css">
    <script src="source/validate.js"></script>
</head>
<body>
<?php require("header.php"); ?>
    <div class="maindiv">
        <div class="container col-xl-6">
            <center>
                <div class="signinpanel shad">
                    <div class="profilepagedp"><img src="source\dp.jpg" alt="Display Picture"></div>
                    <h3><?php echo $user->username; ?></h3>
                    <p><?php echo $user->phone; ?></p>
                </div>
            </center>
        </div>
    </div>
</body>
</html>