<?php
session_start();
require('tables.php');
$noresults = "";
if (isset($_GET['search'])){
//    $words = array();
    $words = explode(" ", $_GET['search']);
    if ($words[sizeof($words)-1]==''){
        unset($words[sizeof($words)-1]);
    }
    $query = "";
    foreach($words as $x){
        if ($query) $query = $query." union ";
        if ($_GET['code'] == 1)
            $query = $query."select * from supply where uid!={$_SESSION['user']->id} and ((`supply`.tags like '%$x%' and status=1) or ((select username from user where id = uid) like '%$x%'))";
        elseif ($_GET['code'] == 2)
            $query = $query."select * from `require` where uid!={$_SESSION['user']->id} and ((`require`.tags like '%$x%' and status=1) or ((select username from user where id = uid) like '%$x%'))";
        else die($noresults);
    }
    $con = connect();
    $res = mysqli_query($con, $query);
    if (mysqli_num_rows($res)>0)
        while ($row = mysqli_fetch_array($res))
        {
            $username = mysqli_fetch_array(mysqli_query($con, "select username from user where id = ${row['uid']}"))['username']; ?>
                <a href="profile.php?username=<?php echo $username; ?>" title="See <?php echo $username; ?>'s profile"><div class="result">
                    <h5><?php echo $row['name']; ?></h5>
                    <p><?php echo $row['details']; ?></p>
                    <p><?php echo $row['number']." ".$row['units']."<br>"."Location : ".$row['location']."<br>Expires by ".$row['expiry']; ?></p>
                    <a href="profile.php?username=<?php echo $username; ?>" title="See <?php echo $username; ?>'s profile"><?php if ($_GET['code']==1) echo "Supplied by ".$username; else echo "Required by ".$username; ?></a>
                </div></a>
<?php
        }
    mysqli_close($con);
} else die($noresults);
?>