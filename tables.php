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
    if (isset($_SESSION['usernmae'])){
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
class user{
    function __construct($email, $phone, $username, $permissions=0){
        $this->email = $email;
        $this->phone = $phone;
        $this->username = $username;
        $this->permissions = $permissions;
    }
    function insertindb($password){
        $con = connect();
        mysqli_query($con, "insert into user(username, email, phone, permissions) values ('$this->username', '$this->email', '$this->phone', $this->permissions);") or die("Login error");
        $this->id = mysqli_insert_id($con);
        mysqli_query($con, "insert into login(uid, password) values('$this->id', '$password');") or die("Login Error");
        mysqli_close($con);
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
class reequire extends SUPPLY{
    function insertindb(){
        $con = connect();
        $query = "insert into `require`(uid, tags, name, details, number, units, location, expiry, status) values('$this->uid', '".addslashes($this->tags)."', '".addslashes($this->name)."', '".addslashes($this->details)."', $this->number, '$this->units', '".addslashes($this->location)."', '$this->expiry', $this->status);";
        mysqli_query($con, $query) or die($query);
        mysqli_close($con);
    }
}
?>