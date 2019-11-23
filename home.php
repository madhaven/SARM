<?php 
require_once('tables.php');
checksession();
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
<?php
$rows = $_SESSION['user']->selectsupplyrows();
if ($rows){
?>
         <div class="col-md-6" style="float:left;">
          <h3 id="supply">Items ready to ship</h3>
          <table class='table table-striped table-hover'>
            <thead class="thead-dark">
              <th>Item</th>
              <th>Quantity</th>
              <th>Unit</th>
            </thead>
            <tbody>
<?php   foreach($rows as $x){ ?>
                <tr>
                    <td><?php echo $x->name; ?></td>
                    <td><?php echo $x->number; ?></td>
                    <td><?php echo $x->units; ?></td>
                </tr>
<?php   } ?>
            </tbody>
          </table>
          </div>
<?php
}
$rows = $_SESSION['user']->selectrequirerows(true);
if ($rows){
?>
         <div class="col-md-6" style="float:left;">
          <h3 id="require">Items Requested for</h3>
          <table class='table table-striped table-hover table2'>
            <thead class="thead-dark">
              <th>Good</th>
              <th>Quantity</th>
              <th>Unit</th>
            </thead>
            <tbody>
<?php   foreach($rows as $x){ ?>
                <tr>
                    <td><?php echo $x->name; ?></td>
                    <td><?php echo $x->number; ?></td>
                    <td><?php echo $x->units; ?></td>
                </tr>
<?php   } ?>
            </tbody>
          </table>
          </div>
<?php } ?>
        </div>
    </div>
</body>
</html>
