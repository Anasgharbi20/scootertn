<?php
session_start();
include('bdd.php');
include('db.php');

$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query(
$conn,
"SELECT * FROM `products` WHERE `code`='$code'"
);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$code = $row['code'];
$price = $row['price'];
$image = $row['image'];

$cartArray = array(
	$code=>array(
	'name'=>$name,
	'code'=>$code,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image)
);

if(empty($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = $cartArray;
    $status = "<div class='box'>Product is added to your cart!</div>";
}else{
    $array_keys = array_keys($_SESSION["shopping_cart"]);
    if(in_array($code,$array_keys)) {
	$status = "<div class='box' style='color:red;'>
	Product is already added to your cart!</div>";	
    } else {
    $_SESSION["shopping_cart"] = array_merge(
    $_SESSION["shopping_cart"],
    $cartArray
    );
    $status = "<div class='box'>Product is added to your cart!</div>";
	}

	}
}

if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
<div class="cart_div" style="position: absolute;top: 34px; left: 1440px;">
<a href="cart.php"><img src="../images/basket.png">
<?php echo '<p style="background-color: rgb(243, 87, 87);color: aliceblue; border-radius: 20%; border:none;width:15px ;height: 15px; text-align: center; font-size: x-small;margin-top:-15px ;margin-left: 20px;">'.$cart_count.'</p>'; ?></a>

</div>
<?php
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <div class="main">

    
        <!-- Carousel -->
        <div id="demo" class="carousel  carousel-fade carousel-dark" data-bs-ride="carousel">

            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            </div>

            <!--  -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../images/t1.png">
                    <div class="carousel-caption">
                        <h3>Comfy Pro®</h3>
                        <p>We had such a great time Scooter!</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="../images/t2.png">
                    <div class="carousel-caption">
                        <h3>Comfy Pro®</h3>
                        <p>Thank you, Scooter!</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="../images/t3.png">
                    <div class="carousel-caption">
                        <h3>Comfy Pro®</h3>
                        <p>We love the Scooter!</p>
                    </div>
                </div>
            </div>
            
        </div>
        
        <div class="shop">
        <?php
$result = mysqli_query($conn,"SELECT * FROM `products`");
if($row = mysqli_fetch_assoc($result)){
    echo "<div class='product_wrapper'>
    <form method='post' action=''>
    <input type='hidden' name='code' value=".$row['code']." />
    </div>
            <button type='submit' class='btn btn-outline-dark btn-sm'>Add To Card</button>
            <button type='button' class='btn btn-outline-danger btn-sm'><a class='nav-link' href='embed.html'>Watch
                    trailer</a>
            </button>

        </div>
    </form>
    </div>";
        }
mysqli_close($conn);
?>




<div class="stars" style="margin-left:725px;" >
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star "></span>
        </div>
<div class="message_box" style="margin-top:-50px;margin-left: 650px;">
<?php echo $status; ?>


    </div>
</body>
<footer>
    <div class="footer">&copy;<span id="year"> </span><span> ScooterTn. All rights reserved.</span></div>
</footer>



</html>