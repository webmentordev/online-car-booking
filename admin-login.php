<?php require_once('./config/apis.php') ?>
<?php 
    if(isset($_SESSION['auth-admin-login-email'])){
        header('location: admin.php');
    }
    if(isset($_GET['logout'])){
        unset($_SESSION['auth-admin-login-email']);
        header('location: admin-login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;600;800;900&family=Teko:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" href="./img/logo-1.png">
    <link rel="stylesheet" href="./css/admin-form.css">
    <title>Login | Admin Panel</title>
</head>

<body>

    <div class="nav">
        <h1 class="title"><a href="admin.php">Admin Login</a></h1>
        <ul>
            <a href="index.php">Home</a>
            <a href="index.php">About</a>
            <a href="index.php">Listing</a>
        </ul>
    </div>


    <section class="form">
        <form action="admin-login.php" method="POST">
            <h3 class="note">Only For Admin use</h3>
            <?php 
                if(isset($_POST['admin-login'])){
                    if($errors){
                        include('./config/errors.php');
                    }else{
                        echo $success;
                    }
                }
            ?>
            
            <h2>Email Address:</h2>
            <input type="email" name="email" placeholder="Email Address" required autocomplete="off">
            <h2>Password:</h2>
            <input type="password" name="password" placeholder="Password" required autocomplete="off">
            <button type="submit" name="admin-login">Login</button>
        </form>
    </section>
</body>


</html>