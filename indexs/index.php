<?php
require 'bdd.php';
$error = null;
if (isset($_POST['login'])){
    $stmt = $conn->prepare("SELECT * FROM users where email=:emx");
    $stmt->bindParam(':emx',$_POST['email']);
    $stmt->execute();
    $user_exists=$stmt->fetchObject();
    if($user_exists){
        if(password_verify($_POST['password'],$user_exists->password)){
           session_start();
           $_SESSION['id'] = $user_exists->id;
           $_SESSION['name'] = $user_exists->name;
           $_SESSION['avatar'] = $user_exists->avatar !=null?$user_exists->avatar:"images/profile-2.png";

           header('Location:home.php');

        }else{
            $error="wrong password";
        }
    }else{
        $error="Account does not exist";
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
    <link rel="stylesheet" href="../styles/stylelogin.css">
    <title>Document</title>
</head>

<body>
    <div class="navbar_top">
        <div class="logo"><a href="index.php"><img src="../images/logo.png"></a></div>
        <nav class="navbar navbar-expand-sm" id="n2">

            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <p>Welcome</p>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="icons">
            <a href="index.php"><img src="../images/hm.png" style="margin-top: 15px;"></a>
        </div>
    </div>
    <div >

    </div>
    <div class="row">
            <div class="col-xl-5 d-none d-xl-block p-0 bg-image-cover bg-no-repeat">
                <div class="h-100 d-flex align-items-center justify-content-end">
                    <img src="../images/t3.png" width="525" height="525">
                </div>
            </div>
            <div class="col-xl-7 vh-100 align-items-center d-flex bg-white rounded-3 overflow-hidden">
                <div class="card shadow-none border-0 ms-auto me-auto login-card">
                    <div class="card-body rounded-0 text-left">
                        <h2 class="fw-700 display1-size display2-md-size mb-3">Connecter a votre compte</h2>
                        <form method="post">
                        
                            <div class="form-group icon-input mb-3">
                                <i class="font-sm ti-email text-grey-500 pe-0"></i>
                                <input type="text" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600" placeholder="Your Email" name="email">
                            </div>
                            <div class="form-group icon-input mb-1">
                            <?php
                        if ($error != null) {
                            echo '<span class="badge bg-danger">' . $error . '</span>';
                        }
                        ?>
                                <input type="Password" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3" placeholder="Your Password" name="password">
                                <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                                <a href="" class="fw-700 ms-1">Forgot Password</a>
                            </div>
                            <div class="col-sm-12 p-0 text-left">
                                <div class="form-group mb-1"><button class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0" type="submit" name="login">Login</button></div>
                                <h6 class="text-grey-500 font-xsss fw-500 mt-0 mb-0 lh-32">You don't have an Account ?<a href="register.php" class="fw-700 ms-1">Register</a></h6>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>
        </div>


        <footer>
        <div class="footer" style="position: absolute;  bottom: -110px;">&copy;<span id="year"> </span><span> ScooterTn. All rights reserved.</span></div>
    </footer>




</html>
    