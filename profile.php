<?php
require('tables.php');
checksession();
$user = $_SESSION['user'];
if(!isset($_POST['submit'])){
    if (isset($_GET['username']))
        $user_x = new userwithname($_GET['username']);
    else $user_x = $user;
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Jitin J Gigi">
        <title>SARM | <?php echo $user_x->username; ?></title>
        <link rel="stylesheet" href="source/bootstrapmin.css">
        <link rel="stylesheet" href="source/style.css">
        <script src="source/validate.js"></script>
        <script>
            var lights = {
                username:1,
                phone:1,
                email:1,
                dp:1
            },
            origs = {
                username: '<?php echo $user->username; ?>',
                phone: <?php echo $user->phone; ?>,
                email: '<?php echo $user->email; ?>',
                dp:'<?php echo $user->dp; ?>'
            };
            function checklights(){
                console.log(lights);
                var submit = document.getElementsByName('submit')[0];
                if (lights.dp+lights.phone+lights.email+lights.username == 4)
                    submit.disabled = false;
                else submit.disabled = true;
            }
            function shift(){
                var seens = document.getElementsByClassName('profilevisible');
                var unseens = document.getElementsByClassName('profilehidden');
                var temp = document.getElementsByClassName('temp');
                while(unseens.length!=0){
                    unseens[0].classList.add('temp');
                    unseens[0].classList.remove('profilehidden');
                }
                while (seens.length!=0){
                    seens[0].classList.add('profilehidden');
                    seens[0].classList.remove('profilevisible');
                }
                while (temp.length!=0){
                    temp[0].classList.add('profilevisible');
                    temp[0].classList.remove('temp');
                }
            }
            function valuser(){
                username = document.getElementsByName('username')[0];
                username.value = username.value.replace(' ', '');
                if (username.value){
                    var ajax = new XMLHttpRequest();
                    ajax.onreadystatechange = function(){
                        if (this.readyState==4 && this.status==200){
                            console.log(this);
                            if (this.response == "TRUE"){
                                lights.username=0;
                                username.classList.add('val-true');
                                username.title = "this username is already taken";
                            } else {
                                lights.username=1;
                                username.classList.remove('val-true');
                                username.title = "";
                            }
                            checklights();
                        }
                    }
                    ajax.open("GET", "checkusers.php?username="+username.value, true);
                    ajax.send();
                } else
                    lights.username = 0;
                if (lights.username == 0){
                    username.classList.add('val-true');
                    username.title = "This username is not available";
                }
                username.classList.add('val-true');
                username.title = "Enter a valid username";
                checklights();
            }
            function valphone(){
                phone = document.getElementsByName('phone')[0];
                if (checkPhone(phone.value)){
                    lights.phone = 1;
                    phone.classList.remove('val-true');
                } else {
                    lights.phone = 0;
                    phone.classList.add('val-true');
                }
                checklights();
            }
            function valemail(){
                email = document.getElementsByName('email')[0];
                if (checkEmail(email.value)){
                    lights.email = 1;
                    email.classList.remove('val-true');
                } else {
                    lights.email = 0;
                    email.classList.add('val-true');
                }
                checklights();
            }
        </script>
    </head>
    <body>
<?php require('header.php'); ?>
        <div class="maindiv">
            <div class="container col-xl-6">
                <center>
                    <form class="signinpanel shad" action="profile.php" method="post" enctype="multipart/form-data">
                        <div class="profilepagedp profilevisible"><img src="<?php echo $user_x->dp; ?>" alt="Display Picture"></div>
                        <div class="form-group profilehidden"><input type="file" class="form-control col-md-6" value="<?php echo $user_x->dp; ?>" name="dp"></div>
                        <h3 class="profilevisible"><?php echo $user_x->username; ?></h3>
                        <h3 class="form-group profilehidden"><input type="text" class="form-control col-md-6" value="<?php echo $user_x->username; ?>" placeholder="Username" name="username" oninput="valuser();"></h3>
                        <p class="profilevisible"><?php echo $user_x->phone; ?><br><?php echo $user_x->email; ?></p>
                        <div class="form-group profilehidden"><input type="number" class="form-control col-md-6" value="<?php echo $user_x->phone; ?>" placholder="Phone" name="phone" oninput="valphone();"></div>
                        <div class="form-group profilehidden"><input type="email" class="form-control col-md-6" value="<?php echo $user_x->email; ?>" placholder="E-mail" name="email" oninput="valemail();"></div>
                        <div class="form-group profilevisible"><input type="button" value="<?php 
if (isset($_GET['username'])) 
    echo("Send Message");
else echo("Edit"); 
?>" class="form-control col-md-6" onclick="<?php 
if (!isset($_GET['username']))
    echo("shift();");
else echo "window.location.href='messages.php?user=".$_GET['username']."'";?>"></div>
                        <div class="form-group profilehidden"><input type="submit" class="form-control col-md-6" value="Save Changes" name="submit"></div>
                    </form>
                </center>
            </div>
        </div>
    </body>
</html><?php
} else {
    if (isset($_POST['username'])) $username = $_POST['username']; else $username = $user->username;
    if (isset($_POST['email'])) $email = $_POST['email']; else $email = $user->email;
    if (isset($_POST['phone'])) $phone = $_POST['phone']; else $phone = $user->phone;
    if ($_FILES['dp']['error'] == 0){
        $filename = explode('.', $_FILES['dp']['name']);
        $filename = "dp/".$filename[0].date("YmdHis").".".$filename[1];
    } else $filename = $user->dp;
    move_uploaded_file($_FILES['dp']['tmp_name'], $filename);
    $user->updateas(new user($email, $phone, $username, $filename)) or die("USERSCENE");
    $_SESSION['user'] = $user;
    header('location: profile.php');
}