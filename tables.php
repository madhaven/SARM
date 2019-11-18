<?php
function connect(){
    $server = "localhost";
    $db = "sarm";
    $user = "root";
    $pw = "";
    $con = mysqli_connect($server, $user, $pw, $db) or die("Unable to connect to db.");
    return $con;
}
function signin($username, $password){
    $con = connect();
    $res = mysqli_query($con, "select id from user where username='$username';") or die("Cannot Sign In.");
    if (mysqli_num_rows($res)==1){
        $id = mysqli_fetch_array($res)['id'];
        $res = mysqli_query($con, "select uid from login where uid=$id and password='$password'") or die("Cannot sign in");
        if (mysqli_num_rows($res)==1){
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $id;
            return true;
        } else {
            mysqli_close($con);
            return "password";
        }
    } else {
        mysqli_close($con);
        return "username";
    }
}
function deletesession(){
    session_start();
    if (isset($_SESSION['username'])){
        //$_SESSION['id'] = NULL;
        //$_SESSION['username'] = NULL;
        unset($_SESSION['id']);
        unset($_SESSION['username']);
        session_destroy();
    }
}
function checksession(){
    session_start();
    if (!isset($_SESSION['username'])){
        header('Location: signin.php');
    }
}
class supply{
    function __construct($uid, $tags, $name, $details, $number, $units, $location='-', $expiry, $status=1){
        $this->uid = $uid;
        $this->tags = $tags;
        $this->name = $name;
        $this->details = $details;
        $this->number = $number;
        $this->units = $units;
        $this->location = $location;
        $this->expiry = $expiry;
        $this->status = $status;
    }
    function insertindb(){
        $con = connect();
        $query = "insert into `supply`(uid, tags, name, details, number, units, location, expiry, status) values('$this->uid', '".addslashes($this->tags)."', '".addslashes($this->name)."', '".addslashes($this->details)."', $this->number, '$this->units', '".addslashes($this->location)."', '$this->expiry', $this->status);";
        mysqli_query($con, $query) or die($query);
        mysqli_close($con);
    }
}
class supplywithid extends supply{
    function __construct($id){
        $con = connect();
        $res = mysqli_query($con, "select * from `supply` where id = $id;") or die('unable to fetch Supply details');
        mysqli_close($con);
        $row = mysqli_fetch_array($res);
        $this->uid = $row['uid'];
        $this->tags = $row['tags'];
        $this->name = $row['name'];
        $this->details = $row['details'];
        $this->number = $row['number'];
        $this->units = $row['units'];
        $this->location = $row['location'];
        $this->expiry = $row['expiry'];
        $this->status = $row['status'];
    }
}
class reequire extends SUPPLY{
    function insertindb(){
        $con = connect();
        $query = "insert into `require`(uid, tags, name, details, number, units, location, expiry, status) values('$this->uid', '".addslashes($this->tags)."', '".addslashes($this->name)."', '".addslashes($this->details)."', $this->number, '$this->units', '".addslashes($this->location)."', '$this->expiry', $this->status);";
        mysqli_query($con, $query) or die($query);
        mysqli_close($con);
    }
}
class reequirewithid extends reequire{
    function __construct($id){
        $con = connect();
        $res = mysqli_query($con, "select * from `require` where id = $id;") or die('unable to fetch Requirement details');
        mysqli_close($con);
        $row = mysqli_fetch_array($res);
        $this->uid = $row['uid'];
        $this->tags = $row['tags'];
        $this->name = $row['name'];
        $this->details = $row['details'];
        $this->number = $row['number'];
        $this->units = $row['units'];
        $this->location = $row['location'];
        $this->expiry = $row['expiry'];
        $this->status = $row['status'];
    }
}
class user{
    function __construct($email, $phone, $username, $dp='source/dp.jpg', $permissions=0){
        $this->email = $email;
        $this->phone = $phone;
        $this->username = $username;
        $this->permissions = $permissions;
        $this->dp = $dp;
    }
    function selectsupplyrows($req = false){
        $con = connect();
        if ($req)
            $res = mysqli_query($con, "select id from `require` where uid = ${_SESSION['id']};") or die ("Unable to fetch reequire data");
        else
            $res = mysqli_query($con, "select id from `supply` where uid = ${_SESSION['id']};") or die ("Unable to fetch supply data");
            
        mysqli_close($con);
        if (mysqli_num_rows($res)>0){
            $arr = array();
            while ($row = mysqli_fetch_array($res)){
                if ($req)
                    array_push($arr, new reequirewithid($row['id']));
                else
                    array_push($arr, new supplywithid($row['id']));
            }
            return $arr;
        } else return false;
    }
    function selectrequirerows(){
        return $this->selectsupplyrows(true);
    }
    function insertindb($password){
        $con = connect();
        if (mysqli_num_rows(mysqli_query($con, "select username from user where username = '$this->username';")))
            return false;
        mysqli_query($con, "insert into user(username, email, phone, dp, permissions) values ('$this->username', '$this->email', '$this->phone', $this->dp, $this->permissions);") or die("Login error");
        $this->id = mysqli_insert_id($con);
        mysqli_query($con, "insert into login(uid, password) values('$this->id', '$password');") or die("Login Error");
        mysqli_close($con);
        return true;
    }
    function updateas($newuser){
        $con = connect();
        $res = mysqli_query($con, "update user set username='$newuser->username', email='$newuser->email', phone=$newuser->phone, dp='$newuser->dp' where username='$this->username';") or die("Unable to Update");
        mysqli_close($con);
        return true;
    }
}
class userwithid extends user{
    function __construct($uid){
        $con = connect();
        $res = mysqli_query($con, "select * from user where id = $uid;") or die("Unable to fetch user data");
        if (mysqli_num_rows($res)==1){
            $row = mysqli_fetch_array($res);
            $this->email = $row['email'];
            $this->phone = $row['phone'];
            $this->username = $row['username'];
            $this->dp = $row['dp'];
            $this->permissions = $row['permissions'];
        } else die ("Fatal user collision");
        mysqli_close($con);
    }
}
class userwithname extends user{
    function __construct($username){
        $con = connect();
        $res = mysqli_query($con, "select * from user where username = '$username';") or die("Unable to fetch user data");
        if (mysqli_num_rows($res)==1){
            $row = mysqli_fetch_array($res);
            $this->email = $row['email'];
            $this->phone = $row['phone'];
            $this->username = $row['username'];
            $this->dp = $row['dp'];
            $this->permissions = $row['permissions'];
        } else die("Fatal user collision");
        mysqli_close($con);
    }
}
?>