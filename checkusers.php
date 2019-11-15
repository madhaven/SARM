<?php
if (isset($_GET['username'])){
	$username = $_GET['username'];
	require('tables.php');
	if (mysqli_num_rows(mysqli_query(connect(), "select username from `user` where username = '$username';")) == 1)
		die("TRUE");
}
die('false');
?>