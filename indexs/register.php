

    <?php
    require 'bdd.php';
    $error = null;
    if (isset($_POST['register'])) {
    
        if($_POST['password']==$_POST['confirm_password']) {
    
    $name=$_POST['user_name'];
    $email=$_POST['email'];
    $stmt = $conn->prepare("SELECT * FROM users where email=:emx");
    $stmt ->bindParam(':emx',$email);
    $stmt->execute();
    $user_exist=$stmt->fetchObject();
    if(!$user_exist){
    $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
    $confirm_password=$_POST['confirm_password'];
    $created_at=date("y-m-d H:i:s");
    $stmt = $conn->prepare("INSERT INTO users(name,password,email,created_at)values(:nm,:pwd,:em,:h)");
    $stmt ->bindParam(':nm',$name);
    $stmt ->bindParam(':pwd',$password);
    $stmt ->bindParam(':em',$email);
    $stmt ->bindParam(':h',$created_at);
    $stmt ->execute();
    }
    else{
        $error="email exists";
    }
    }
    else { 
    $error= "passwords do not match";
    
    }
    if($stmt->rowCount()!=0){
        $success="Account successfully created";
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
    <script src="signupform.php"></script>
    <title>Document</title>

</head>

<body>
    <div class="navbar_top ">
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
    <body class="color-theme-blue">

<div class="preloader"></div>

<div class="main-wrap">


    </div>

    <div class="row">
        <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat">
            <div class="h-100 d-flex align-items-center justify-content-end">
                <img src="../images/t2.png" width="525" height="525">
            </div>
        </div>
        <div class="col-xl-5 vh-100 align-items-center d-flex bg-white rounded-3 overflow-hidden">
            <div class="card shadow-none border-0 ms-auto me-auto login-card">
                <div class="card-body rounded-0 text-left">
                    <h2 class="fw-700 display1-size display2-md-size mb-4">Crée votre Compte</h2>
                    <form method="POST">
                        <?php
                        if ($error != null) {
                            echo '<span class="badge bg-danger">' . $error . '</span>';                        }
                        else if (isset($success)){
                            echo'<span class="badge bg-success">'. $success .'</span>';
                        }
                        ?>
                        <div class="form-group icon-input mb-3">
                            <i class="font-sm ti-user text-grey-500 pe-0"></i>
                            <input type="text" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                                   placeholder="Nom et prénom" name="user_name" required>
                        </div>
                        <div class="form-group icon-input mb-3">
                            <i class="font-sm ti-email text-grey-500 pe-0"></i>
                            <input type="text" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                                   placeholder="Addresse Email" name="email" required>
                        </div>
                        <div class="form-group icon-input mb-3">
                            <input type="Password" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3"
                                   placeholder="Mot de passe" name="password" required>
                            <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                        </div>
                        <div class="form-group icon-input mb-1">
                            <input type="Password" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3"
                                   placeholder="Confirmer votre Mot de passe" name="confirm_password" required>
                            <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                        </div>
                        <div class="col-sm-12 p-0 text-left">
                            <div class="form-group mb-1">
                                <button type="submit"
                                        class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0"
                                        name="register">S'insrire
                                </button>
                            </div>
                            <h6 class="text-grey-500 font-xsss fw-500 mt-0 mb-0 lh-32">Vous avez deja un compte ? <a
                                        href="index.php" class="fw-700 ms-1">Se connecter</a></h6>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



    <footer>
        <div class="footer" style="position: absolute;  bottom: -110px;width:100%">&copy;<span id="year"> </span><span> ScooterTn. All rights reserved.</span></div>
    </footer>




</html>





    
    
    
    
    
    
    
    
    
    
    
    
    
    
   
    

   