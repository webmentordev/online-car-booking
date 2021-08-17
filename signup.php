<?php require_once('./config/apis.php') ?>
<?php 
    if(isset($_SESSION['auth-user-login'])){
        header('location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/form.css">
    <link rel="shortcut icon" href="./img/logo-1.png">
    <title>Register | MrCar</title>
</head>

<body>
    <div class="main-body">
        <div class="overlay"></div>
        <div class="box">
            <div class="info">
                <p>have an account? <a href="login.php">Login</a></p>
                <h1>Register To MrCar</h1>
                <form action="signup.php" method="POST">
                    <?php 
                        if(isset($_POST['register'])){
                            if($errors){
                                include('./config/errors.php');
                            }
                        }
                    ?>
                    <input type="text" name="fullname" placeholder="Fullname" required autocomplete="off">
                    <input type="text" name="username" placeholder="Username" required autocomplete="off">
                    <input type="email" name="email" placeholder="Email" required autocomplete="off">
                    <input type="password" name="password1" placeholder="Password" required autocomplete="off">
                    <input type="password" name="password2" placeholder="Confirm Password" required autocomplete="off">
                    <div class="block">
                        <a href="forgot.php">Forgot Your Password?</a><br>
                        <button type="submit" class="btn" name="register">Register</button>
                    </div>
                </form>
            </div>
            <div class="left-s"></div>
        </div>
    </div>
</body>

</html>