<?php
require('tables.php');
checksession();
if (!isset($_POST['submit'])){
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta name="author" content="Jitin J Gigi">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SARM | Require</title>
    <link rel="stylesheet" href="source/bootstrapmin.css">
    <link rel="stylesheet" href="source/style.css">
    <script src="source/validate.js"></script>
    <script>
        function fill(element){
            text = element.value;
            if (/\n/.test(text))
                if (text[text.length-2]!=' ') element.value = text = text.replace(/\n/, ' ');
                else element.value = text = text.replace(/\n/, '');
            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    console.log(text);
                    console.log(this.responseText);
                    document.getElementsByClassName("searchresult")[0].getElementsByTagName("div")[0].innerHTML = this.responseText;
                }
            }
            if (text){
                ajax.open("GET", "getsupplies.php?code=1&search="+encodeURIComponent(text), true);
                ajax.send();
            }
        }
    </script>
</head>
<body>
    <div class="maindiv row">
        <main class="searchpanel col-sm-6 col-md-4 homemain">
            <div class="searchcontainer container">
                <h4 class="signinheadmarg">Request Items You Need</h4>
                <form action="require.php" method="post">
                    <div class="form-group"><textarea placeholder="Search for tags. This helps finding your request eg: medicine health food expiry" class="form-control" name="tags" oninput="fill(this);" maxlength="500"></textarea></div>
                    <hr>
                    <div class="form-group"><input type="text" placeholder="Item Name" class="form-control" name="name" oninput="valname(this);"></div>
                    <div class="form-group"><textarea name="details" placeholder="Add some details" oninput="valdetails(this);" class="form-control"></textarea></div>
                    <div class="form-group">
                        <input type="number" min="0" placeholder="Number" class="form-group form-control col-sm-6 left" name="number" oninput="valnumber(this);">
                        <input list="units" placeholder="Unit" class="form-group form-control col-sm-6 left" name="units" oninput="valunits(this);" onchange="valunits(this);">
                        <datalist id="units">
                            <option value="kg">KG</option>
                            <option value="l">Litre</option>
                            <option value="m">Metre</option>
                            <option value="u">Unit</option>
                            <option value="person">Person</option>
                        </datalist>
                    </div>
                    <div class="form-group"><input type="text" name="location" placeholder="Location Required At" class="form-control"></div>
                    <div class="form-group">
                        <label for="time">Expires on</label>
                        <input type="datetime-local" name="time" class="form-control">
                    </div>
                    <div class="form-group"><input name="submit" id="submit" type="submit" value="Place A Request" class="form-control" disabled></div>
                </form>
            </div>
        </main>
        <aside class="searchresult col-sm-6 col-md-8 homemain">
            <div class="container">
            </div>
        </aside>
<?php require("header.php"); ?>
    </div>
</body>
</html>
<?php
} else {
    $uid = $_SESSION['id'];
    $tags = $_POST['tags'];
    $name = $_POST['name'];
    $details = $_POST['details'];
    $number = $_POST['number'];
    $units = $_POST['units'];
    if (isset($_POST['location'])) $loc = $_POST['location']; else $loc=NULL;
    $expiry = $_POST['time'];
    (new reequire($uid, $tags, $name, $details, $number, $units, $loc, $expiry, 1))->insertindb();
    header('Location:home.php#require');
}
?>