<?php
require_once('tables.php');
checksession();
if ($_SESSION['user']->permissions == 0)
    header('Location: home.php');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SARM | Users</title>
    <meta name="author" content="Jitin J Gigi">
    <link rel="stylesheet" href="source/bootstrapmin.css">
    <link rel="stylesheet" href="source/style.css">
    <script>
        function makeuser(id, code=0){
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function (){
                if (this.status == 200 && this.readyState == 4){
                    if (this.response){
                        var el1 = document.getElementsByClassName(id+'_01')[0];
                        var el2 = document.getElementsByClassName(id+'_02')[0];
                        if (code == 1){
                            el1.classList.add('adminbutton');
                            el1.classList.remove('usergreen');
                            el1.innerHTML = "Make User";
                            el1.title = "This will disable the user of admin previleges";
                            el1.onclick = function(){makeuser(id, 0);};
                            el2.classList.add('userred');
                            el2.classList.remove('adminbutton');
                            el2.classList.remove('user');
                            el2.innerHTML = "Admin";
                            el2.title = "";
                            el2.onclick = "";
                        } else if (code == 0){
                            el1.classList.remove('adminbutton');
                            el1.classList.add('usergreen');
                            el1.innerHTML = "User";
                            el1.title = "";
                            el1.onclick = "";
                            el2.classList.remove('userred');
                            el2.classList.add('adminbutton');
                            el2.classList.add('user');
                            el2.innerHTML = "Make Admin";
                            el2.title = "This will enable the user to make critical changes to the data used on this website";
                            el2.onclick = function(){makeuser(id, 1);};
                        }
                    } else console.log("scene");
                }
            }
            xhr.open("post", "setadmin.php?code="+code+"&id="+id, true);
            xhr.send();
        }
    </script>
</head>
<body>
    <div class="maindiv homemain">
        <div class="container col-sm-12 col-md-10 col-xl-6">
            <table class="theh3 table table-hover table-stripped table-scroll">
                <thead>
                    <tr class="th">
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>User Type</th>
                    </tr>
                </thead>
                <tbody>
<?php
$con = connect();
$query = "select * from user order by username;";//where id != {$_SESSION['user']->id}
$res = mysqli_query($con, $query) or die("query tha moonchiyirikkunnu");
mysqli_close($con);
while ($id = mysqli_fetch_array($res)['id']){
$user_x = new userwithid($id);?>
                    <tr>
                        <td onclick="location.href='profile.php?username=<?php echo $user_x->username; ?>';"><img class="usersdp" src="<?php echo $user_x->dp; ?>"><?php echo $user_x->username; ?></td>
                        <td><?php echo $user_x->email; ?></td>
                        <td><?php echo $user_x->phone; ?></td>
                        <td><?php 
    if (!$user_x->permissions){ 
        ?><button class='usergreen <?php echo $user_x->id."_01"; ?>'>User</button><button class='adminbutton user <?php echo $user_x->id."_02"; ?>' title="This will enable the user to make critical changes to the data used on this website" onclick="makeuser(<?php echo $user_x->id ?>, 1);">Make Admin</button><?php
    } else {
        ?><button class='adminbutton <?php echo $user_x->id."_01"; ?>' title="This will disable the user of admin previleges" onclick="makeuser(<?php echo $user_x->id ?>, 0);">Make User</button><button class='userred <?php echo $user_x->id."_02"; ?>'>Admin</button><?php
    }                   ?></td>
                    </tr>
<?php } ?>
                </tbody>
            </table>
        </div>
<?php require_once('header.php'); ?>
    </div>
</body>
</html>