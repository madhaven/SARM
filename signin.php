<?php
if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "select id from login where username='$username' and password='$password';";
    require "serverdb.php";
    $res = mysqli_query($con, $query);
    if (mysqli_num_rows($res)==1){
        mysqli_close($con);
        session_start();
        $row = mysqli_fetch_array($res);
        $_SESSION['id'] = $row['id'];
        header('Location: home.php');
    } else {
//        print_r(mysqli_query($con, $query));
        mysqli_close($con);
//        print_r($_POST);
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Jitin J Gigi">
    <title>SARM | Sign In</title>
    <link rel="stylesheet" href="source/bootstrapmin.css">
    <link rel="stylesheet" href="source/style.css">
    <script src="source\validate.js"></script>
    <script>
        var greenlight=[0,0];
        count=0
        function islightgreen(){
            console.log(greenlight);
            if (greenlight[0]+greenlight[1]==2){
                document.getElementById("submit").disabled=false;
                console.log("enabled"+count++);
            } else {
                document.getElementById("submit").disabled=true;
                console.log("disabled"+count++);
            }
        }
        function valusername(){ //requires AJAX
            greenlight[0]=1;
            islightgreen();
        }
        function valpassword(){
            element = document.getElementById('password');
            pass = element.value;
            if (checkPassword(pass)){
                // console.log(`${pass} is okay`);
                greenlight[1]=1;
                element.classList.remove("val-true");
            } else {
                // console.log(`${pass} is okay`);
                greenlight[1]=0;
                element.classList.add("val-true");
            }
            islightgreen();
        }
    </script>
</head>
<body onload="valusername();">
    <div class="maindiv">
        <div class="container col-xl-6">
            <center>
                <div class="signinpanel shad">
                    <h3 class="signinheadmarg">SARM | Sign In</h3>
                    <form action="signin.php" method="post">
                        <div class="form-group"><input type="text" name="username" id="username" placeholder="Username" class="form-control" onload="valusername(this);" oninput="valusername();" <?php if (isset($username)) echo "value=\"".$username."\";" ?> ></div>
                        <div class="form-group"><input type="password" name="password" id="password" placeholder="Password" class="form-control" oninput="valpassword();"></div>
                        <div class="form-group"><input type="submit" name="submit" id="submit" value="Sign In" class="form-control but" disabled></div>
                    </form>
                    <p>New to S.A.R.M ?<br><a href="signup.php">Sign up Here</a></p>
                </div>
            </center>
        </div>
    </div>
</body>
</html>
