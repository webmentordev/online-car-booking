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
    <title>Login | MrCar</title>
</head>

<body>
    <div class="main-body">
        <div class="overlay"></div>
        <div class="box">
            <div class="info">
                <p>Don't have an account? <a href="signup.php">Register</a></p>
                <h1>Login To MrCar</h1>
                <form action="login.php" method="POST">
                    <?php 
                        if(isset($_POST['login'])){
                            if($errors){
                                include('./config/errors.php');
                            }
                        }
                    ?>
                    <input type="email" name="email" placeholder="Email" required autocomplete="off">
                    <input type="password" name="password" placeholder="Password" required autocomplete="off">
                    <div class="flex">
                        <input type="checkbox" class="remember" name="remember" id="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <div class="block">
                        <a href="forgot.php">Forgot Your Password?</a><br>
                        <button type="submit" class="btn" name="login">Login</button>
                    </div>
                </form>
            </div>
            <div class="left-s"></div>
        </div>
    </div>
</body>

</html>