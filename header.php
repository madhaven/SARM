    <header class="head shad">
        <div class="container">
            <nav class="col-sm-6">
                <a href="" class="right"><?php echo $_SESSION['user']->username; ?> <div class="headdp"><img src="<?php echo $_SESSION['user']->dp; ?>" class="responsive"></div></a>
                <ul>        
<!--                    <li><a href="messages.php">Messages</a></li>-->
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="signout.php">Sign Out</a></li>
                </ul>
            </nav>
            <div class="col-sm-6">
                <a href="home.php" class="left">S.A.R.M</a>
                <?php if ($_SESSION['user']->permissions == 1) { ?><a href="users.php" class="left">Manage Users</a><?php } ?>
            </div>
        </div>
    </header>
