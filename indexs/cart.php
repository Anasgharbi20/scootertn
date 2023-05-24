<?php
session_start();
$status="";
$_SESSION['id'];
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
    foreach($_SESSION["shopping_cart"] as $key => $value) {
      if($_POST["code"] == $key){
      unset($_SESSION["shopping_cart"][$key]);
      $status = "<div class='box' style='color:red;'>
      Product is removed from your cart!</div>";
      }
      if(empty($_SESSION["shopping_cart"]))
      unset($_SESSION["shopping_cart"]);
      }		
}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['code'] === $_POST["code"]){
        $value['quantity'] = $_POST["quantity"];
        break; // Stop the loop after we've found the product
    }
}
  	
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../styles/stylehome.css">
    <title>Document</title>
</head>

<body>
    <div class="navbar_top ">
        <div class="logo"><a href="home.php"><img src="../images/logo.png"></a></div>
        <nav class="navbar navbar-expand-sm" id="n2">

            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manifacturing.html">Manifacturing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="team.html">Team</a>
                    </li>

                </ul>
            </div>
        </nav>
        <div class="icons">
        <a href="index.php"><img src="../images/dec.png" style="margin-top: 15px;height: 25px;width:28px;"></a>
        </div>
    </div>
<?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>	
<table class="table">
<tbody>
<tr>
<td></td>
<td>ITEM NAME</td>
<td>QUANTITY</td>
<td>UNIT PRICE</td>
<td>ITEMS TOTAL</td>
</tr>	
<?php		
foreach ($_SESSION["shopping_cart"] as $product){
?>
<tr>
<td>
<img src='<?php echo $product["image"]; ?>' width="50" height="40" />
</td>
<td><?php echo $product["name"]; ?><br />
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="remove" />
<button type='submit'  class="btn btn-danger">Remove Item</button>
</form>
</td>
<td>
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="change" />
<select name='quantity' class='quantity' onChange="this.form.submit()">
<option <?php if($product["quantity"]==1) echo "selected";?>
value="1">1</option>
<option <?php if($product["quantity"]==2) echo "selected";?>
value="2">2</option>
<option <?php if($product["quantity"]==3) echo "selected";?>
value="3">3</option>
<option <?php if($product["quantity"]==4) echo "selected";?>
value="4">4</option>
<option <?php if($product["quantity"]==5) echo "selected";?>
value="5">5</option>
</select>
</form>
</td>
<td><?php echo "$".$product["price"]; ?></td>
<td><?php echo "$".$product["price"]*$product["quantity"]; ?></td>
</tr>
<?php
$total_price += ($product["price"]*$product["quantity"]);
}
?>
<tr>
<td >
<strong>TOTAL: <?php echo "$".$total_price; ?></strong>
</td>
</tr>
</tbody>
</table>		
  <?php
}else{
	echo "<h3>Your cart is empty!</h3>";
	}
?>




<?php
require 'bdd.php';
$error=null;
if (isset($_POST['create_post'])){
    $title=$_POST['title'];
    $desc=$_POST['description'];
    $num=$_POST['num'];
    $created_at=date("y-m-d H:i:s");
    $stmt = $conn->prepare("INSERT INTO posts(title,description,num,created_at,user_id)values(:tl,:ds,:nu,:h,:u_id)");
    $stmt ->bindParam(':u_id',$_SESSION['id']);
    $stmt ->bindParam(':tl',$title);
    $stmt ->bindParam(':ds',$desc);
    $stmt ->bindParam(':nu',$num);
    $stmt ->bindParam(':h',$created_at);
    $stmt ->execute();
    if($stmt->rowCount()!=0){
        $success="Order successfully sent";
    }
    else { 
    $error= "Error";
    }
}
?>
</div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>
<!-- title input -->
<form method="post"  style="margin-left:400px;"class="card w-50 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3"
                              enctype="multipart/form-data">
                              <h3>insert your location to final your purchase</h3>

                              <?php
                        if ($error != null) {
                            echo '<badge class="badge bg-danger w-100">'.$error.'</badge>';
                        }
                        if (isset($success)){
                            echo"<span class='badge bg-success'>".$success."</span>";
                        }
                        ?>
  <div class="form-outline mb-4" >
    <input name="title" id="form4Example2" class="form-control" />
    <label class="form-label" for="form4Example2">Your address</label>
  </div>

  <!-- desc input -->
  <div class="form-outline mb-4">
    <textarea class="form-control"   name="description"id="form4Example3" rows="4"></textarea>
    <label class="form-label" for="form4Example3">Additional infos</label>
  </div>
  <div class="form-outline mb-4" >
    <input name="num" id="form4Example2" class="form-control" />
    <label class="form-label" for="form4Example2">Your Phone number</label>
  </div>

  <!-- Submit button -->
  <button type="submit" name="create_post" style="margin-bottom: 25px;"class="btn btn-success btn-block mb-4">Send</button>
</form>
                               
                   
<?php
?>
</body>
<footer>
        <div class="footer" style="margin-top: 55px;">&copy;<span id="year"> </span><span> ScooterTn. All rights reserved.</span></div>
    </footer>




</html>