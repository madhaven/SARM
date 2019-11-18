    <header class="head shad">
        <div class="container">
            <nav class="col-sm-6">
                <a href="" class="right"><?php echo $_SESSION['username']; ?> <div class="headdp"><img src="<?php echo (new userwithname($_SESSION['username']))->dp; ?>" class="responsive"></div></a>
                <ul>
<!--                    <li><a href="messages.php">Messages</a></li>-->
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="signout.php">Sign Out</a></li>
                </ul>
            </nav>
            <div class="col-sm-6">
                <a href="home.php" class="left">S.A.R.M</a> 
            </div>
        </div>
    </header>
