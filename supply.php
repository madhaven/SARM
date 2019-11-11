<?php
require('checksession.php');
if (!isset($_POST['submit'])){
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta name="author" content="Jitin J Gigi">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SARM | Supply</title>
    <link rel="stylesheet" href="source/bootstrapmin.css">
    <link rel="stylesheet" href="source/style.css">
    <script src="source/validate.js"></script>
    <script>
        var results=0;
        function fill(text){ //SUPPOSED TO BE AN AJAX FUNCTION
            var r=text.split(" ").length;
            for (var x=0; x<(r-results); x++){
                document.getElementsByClassName("searchresult")[0].getElementsByTagName("div")[0].innerHTML+=`                <div class="result">
                    <h5>${text.split(" ")[results-1]}</h5>
                    <p>Details Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita libero adipisci vitae ducimus iste facilis provident nam sit,     accusamus minus!</p>
                    <p>Amount and Units</p>
                    <p>Location</p>
                    <p>Expiry</p>
                    <a href="">Contact Me</a>
                </div>`;
            }
            results=r;
        }
    </script>
</head>
<body>
    <div class="maindiv row">
        <main class="searchpanel col-sm-6 col-md-4 homemain">
            <div class="searchcontainer container">
                <h4 class="signinheadmarg">Add Items You Could Supply</h4>
                <form action="supply.php" method="post">
                    <div class="form-group"><textarea placeholder="Add tags. This helps finding your supply eg: medicine health food expiry" class="form-control" name="tags" oninput="valtags(this);fill(this.value);" maxlength="500"></textarea></div>
                    <hr>
                    <div class="form-group"><input type="text" placeholder="Item Name" class="form-control" name="name" oninput="valname(this);"></div>
                    <div class="form-group"><textarea name="details" placeholder="Add some details" oninput="valdetails(this);" class="form-control"></textarea></div>
                    <div class="form-group">
                        <input type="number"min="0"placeholder="Number" class="form-group form-control col-sm-6 left" name="number" oninput="valnumber(this);">
                        <input list="units" placeholder="Unit" class="form-group form-control col-sm-6 left" name="units" oninput="valunits(this);" onselect="valunits(this);">
                        <datalist id="units">
                            <option value="kg">KG</option>
                            <option value="l">Litre</option>
                            <option value="m">Metre</option>
                            <option value="u">Unit</option>
                            <option value="person">Person</option>
                        </datalist>
                    </div>
                    <div class="form-group"><input type="text" name="location" placeholder="Supply Location" class="form-control"></div>
                    <div class="form-group">
                        <label for="time">Expires on</label>
                        <input type="datetime-local" name="time" class="form-control">
                    </div>
                    <div class="form-group"><input type="submit" id="submit" name="submit" value="Add Goods" class="form-control" disabled></div>
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
    if (isset($_POST['location'])) $loc = $_POST['location'];
    $expiry = $_POST['time'];
    
}
?>
