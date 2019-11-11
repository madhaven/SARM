<?php
require ('checksession.php');
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
                <h4 class="signinheadmarg">Request Items You Need</h4>
                <form action="home.html" method="post">
                    <div class="form-group"><textarea placeholder="Search for tags. This helps finding your request eg: medicine health food expiry" class="form-control" name="tags" oninput="valtags(this);fill(this.value);"></textarea></div>
                    <hr>
                    <div class="form-group"><input type="text" placeholder="Item Name" class="form-control" name="name" id="name" oninput="valname(this);"></div>
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
                    <div class="form-group"><input type="text" placeholder="Location Required At" class="form-control"></div>
                    <div class="form-group">
                        <label for="time">Expires on</label>
                        <input type="datetime-local"name="time" class="form-control">
                    </div>
                    <div class="form-group"><input name="submit" id="submit" type="submit"value="Place A Request" class="form-control" disabled></div>
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
