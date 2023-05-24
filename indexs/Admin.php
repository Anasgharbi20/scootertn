<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../styles/stylelogin.css">
    <title>Document</title>
</head>

<body>
    <div class="navbar_top ">
        <div class="logo"><img src="../images/logo.png"></div>
        <nav class="navbar navbar-expand-sm" id="n2">

            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <p>Admin</p>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="icons">
        <a href="index.php"><img src="../images/dec.png" style="margin-top: 15px;height: 25px;width:28px;"></a>
        </div>
    </div>
    <table class="table">
<tbody>
<tr> 
<td></td>
<td>ORDER LOCATION</td>
<td>ORDER DESCRIPTION</td>
<td>PHONE NUMBER</td>
<td>ORDER TIME</td>
</tr>	
<tr>
<td></td>

<td>
<?php
require 'bdd.php';
require 'db.php';
$sql = "SELECT * FROM posts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo $row["title"]. "<br>";
  }
}
?>
</td>
<td>
<?php
$sql = "SELECT * FROM posts";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo $row["description"]. "<br>";
    }
  }
?>
</td>
<td>
<?php
$sql = "SELECT * FROM posts";
$result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo $row["num"]. "<br>";
    }
  }
?>
</td>
<td>
<?php
$sql = "SELECT * FROM posts";
$result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo $row["created_at"]. "<br>";
    }
  }
?>
</td>

</tr>
</table>
<button onClick="window.print()" style="margin-left: 725px;"class="btn btn-success btn-block mb-4">Print Orders</button>





        <footer>
        <div class="footer" style="position: absolute;  bottom: -110px;width:100%">&copy;<span id="year"> </span><span> ScooterTn. All rights reserved.</span></div>
    </footer>




</html>












