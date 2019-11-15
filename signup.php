<?php
require('tables.php');
deletesession();
if (isset($_POST['submit'])){
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ((new user($email, $phone, $username, 0))->insertindb($password))
        $_POST['erroruser'] = true;
    header('Location: signin.php');
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Jitin J Gigi">
    <title>SARM | Sign Up</title>
    <link rel="stylesheet" href="source/bootstrapmin.css">
    <link rel="stylesheet" href="source/style.css">
    <script src="source/validate.js"></script>
    <script>
    var greenlight={
        email:<?php if (isset($email)) echo 1; else echo 0; ?>,
        phone:<?php if (isset($phone)) echo 1; else echo 0; ?>,
        username:<?php if (isset($username)) echo 1; else echo 0; ?>,
        password:0,
        confirm:0
    }
    function islightgreen(){
        console.log(greenlight);
        if (greenlight.email+greenlight.phone+greenlight.username+greenlight.password+greenlight.confirm==5){
            document.getElementById("submit").disabled=false;
        } else {
            document.getElementById("submit").disabled=true;
        }
    }
    function valEmail(){
        var element = document.getElementById("email");
        var email=element.value;
//        console.log(element);
        if (checkEmail(email)){
            // console.log(`${email} is okay`);
            greenlight.email=1;
            element.classList.remove("val-true");
        } else {
            // console.log(`${email} is not okay`);
            greenlight.email=0;
            element.classList.add("val-true");
        }
        islightgreen();
    }
    function valUsername(){ //requires AJAX
        var username = document.getElementById('username').value;
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                var uname = document.getElementById('username');
                if (this.response == "TRUE"){
                    uname.classList.add("val-true");
                    uname.title = "Username already exists.";
                    greenlight.username=0;
                } else {
                    uname.classList.remove("val-true");
                    uname.title="";
                    greenlight.username=1;
                }
                console.log("ehcking for logs");
                islightgreen();
            }
        }
        ajax.open("GET", "checkusers.php?username="+username, true);
        ajax.send();
    }
    function valPass(){
        var element = document.getElementById("password");
        var pass=element.value;
        if (checkPassword(pass)){
//            console.log(`${pass} is okay`);
            greenlight.password=1;
            element.classList.remove("val-true");
            element.title = "";
        } else {
//            console.log(`${pass} is okay`);
            greenlight.password=0;
            element.classList.add("val-true");
            element.title = "This is an invalid password";
        }
        islightgreen();
    }
    function valConfirm(){
        var element = document.getElementById("pass2");
        var pass = document.getElementById("password").value;
        var pass2 = element.value;
        if (pass==pass2){
            // console.log(`${pass2} is okay`);
            greenlight.confirm=1;
            element.classList.remove("val-true");
            element.title = "";
        } else {
            // console.log(`${pass2} is okay`);
            greenlight.confirm=0;
            element.classList.add("val-true");
            element.title = "Passwords don't match.";
        }
        islightgreen();
    }
    function valPhone(){
        var element = document.getElementById('phone');
//        console.log(element.value);
//        console.log("valphone");
        if (checkPhone(element.value)){
            greenlight.phone=1;
            element.classList.remove("val-true");
        } else {
            greenlight.phone=0;
            element.classList.add("val-true");
        }
        islightgreen();
    }
    </script>
</head>
<body>
    <div class="maindiv">
        <div class="container col-xl-6">
            <center>
                <div class="signinpanel shad">
                    <h3 class="signinheadmarg">SARM | Sign Up</h3>
                    <form action="signup.php" method="post">
                        <div class="form-group"><input name="email" type="email" class="form-control validate" placeholder="Email address" oninput="valEmail();" id="email"></div>
                        <div class="form-group"><input name="phone" type="number" min="1000000000" max="9999999999" class="form-control validate" placeholder="Contact Number" oninput="valPhone();" id="phone"></div>
                        <div class="form-group"><input name="username" type="text" class="form-control validate" placeholder="Username" oninput="valUsername();" id="username"></div>
                        <div class="form-group"><input name="password" type="password" class="form-control validate" placeholder="Password" oninput="valPass();" id="password"></div>
                        <div class="form-group"><input type="password" class="form-control validate" placeholder="Confirm Password" oninput="valConfirm();" id="pass2"></div>
                        <div class="form-group"><input name="submit" type="submit" id="submit" class="form-control validate" disabled></div>
                    </form>
                    <p>Already registered on S.A.R.M ?<br><a href="signin.php">Sign in Here</a></p>
                </div>
            </center>
        </div>
    </div>
</body>
</html>
