<?php 
require('checksession.php');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Jitin J Gigi">
    <title>SARM</title>
    <link rel="stylesheet" href="source/bootstrapmin.css">
    <link rel="stylesheet" href="source/style.css">
</head>
<body>
<?php require("header.php"); ?>
    <div class="maindiv homemain">
        <div class="grid container">
            <div class="gridbox col-sm-12" onclick="window.location='supply.php';"><div>Supply</div></div>
            <div class="gridbox col-sm-12" onclick="window.location='require.php';"><div>Require</div></div>
        </div>
        <div class='container'>
          <h3>Items ready to ship</h3>
          <table class='table table-striped table-hover'>
            <thead class="thead-dark">
              <th>Good</th>
              <th>Quantity</th>
              <th>Unit</th>
            </thead>
            <tbody>
              <tr><td>Wood</td><td>50</td><td>kg</td></tr>
              <tr><td>Food</td><td>1000</td><td>People</td></tr>
              <tr><td>Mobile Recharge</td><td>10</td><td>Mobiles</td></tr>
              <tr><td>Wood</td><td>50</td><td>kg</td></tr>
              <tr><td>Food</td><td>1000</td><td>People</td></tr>
              <tr><td>Mobile Recharge</td><td>10</td><td>Mobiles</td></tr>
            </tbody>
          </table>
          <h3>Items Requested for</h3>
          <table class='table table-striped table-hover table2'>
            <thead class="thead-dark">
              <th>Good</th>
              <th>Quantity</th>
              <th>Unit</th>
            </thead>
            <tbody>
              <tr><td>Wood</td><td>50</td><td>kg</td></tr>
              <tr><td>Food</td><td>1000</td><td>People</td></tr>
              <tr><td>Wood</td><td>50</td><td>kg</td></tr>
              <tr><td>Food</td><td>1000</td><td>People</td></tr>
              <tr><td>Mobile Recharge</td><td>10</td><td>Mobiles</td></tr>
            </tbody>
          </table>
        </div>
    </div>
</body>
</html>
