<?php require_once('./config/apis.php') ?>
<?php 
    if(isset($_SESSION['auth-user-login']) && isset($_GET['order'])){
        $name = $_SESSION['auth-user-login'];
        $email = $_SESSION['auth-user-login-email'];
        $fname = $_SESSION['auth-user-login-fullname'];
        $_SESSION['order'] = $_GET['order'];
    }elseif(isset($_SESSION['order']) && isset($_SESSION['auth-user-login'])){
        $name = $_SESSION['auth-user-login'];
        $email = $_SESSION['auth-user-login-email'];
        $fname = $_SESSION['auth-user-login-fullname'];
    }else{
        header('location: profile.php');
    }
?>
<?php 
    if(isset($_GET['logout'])){
        unset($_SESSION['auth-user-login']);
        unset($_SESSION['auth-user-login-email']);
        unset($_SESSION['auth-user-login-fullname']);
        unset($_SESSION['order']);
        header('location: login.php');
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
    <link rel="stylesheet" href="./css/order.css">
    <title>Order | MrCar</title>
</head>
<?php 
    if(isset($_GET['order']) || $_SESSION['order']){
        if(isset($_GET['order'])){
            $id = $_GET['order'];
            $sql = "SELECT * from cars_db WHERE id = '$id'";
            $res = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($res)){
                $img = './img/cars/'. $row['car_img'];
                $price = $row['car_price'];
            }
        }else{
            $id = $_SESSION['order'];
            $sql = "SELECT * from cars_db WHERE id = '$id'";
            $res = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($res)){
                $img = './img/cars/'. $row['car_img'];
                $price = $row['car_price'];
            }
        }
    }
?>
<body style="background-image: url('<?php echo $img; ?>');">
    <div class="overlay"></div>
    <!-------Go-To-Top-Button--------->
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-angle-up fa-fw"></i></button>

    <!-------NavBar--------->
    <section class="nav">
        <div class="container" id="nav-container">
            <h1><a href="index.php">MrCarOrder</a></h1>
            <ul class="res-btn">
                <a href="index.php">Home</a>
                <a href="about.php">About</a>
                <a href="listing.php">Listing</a>
                <a class="active" href="order.php">Order</a>
                <?php
                if(isset($_SESSION['auth-user-login'])){
                    $name = $_SESSION['auth-user-login'];
                ?>
                    <a class="left-link" href="profile.php"><?php echo $name; ?></a>
                    <a href="?logout=true">Logout</a>
                <?php } else {?>

                    <a class="left-link" href="login.php">Login</a>
                    <a href="signup.php">Register</a>
                <?php } ?>
            </ul>
            <button id="openBtn" onclick="openBar()"><i class="fas fa-bars"></i></button>
        </div>
    </section>

    <!-------Side-Bar--------->
    <section class="sidebar" id="sidebar">
        <div class="box">
            <button id="closeBtn" onclick="closeBar()"><i class="fas fa-times fa-fw"></i></button>
            <ul>
                <a href="index.php">Home</a>
                <a href="about.php">About</a>
                <a href="listing.php">Listing</a>
                <a class="active" href="order.php">Order</a>
                <p><?php
                    if(isset($_SESSION['auth-user-login'])){
                        $name = $_SESSION['auth-user-login'];
                ?>
                <a class="left-link" href="profile.php"><?php echo $name; ?></a>
                <a href="?logout=true">Logout</a><?php } else {?><a class="left-link" href="login.php">Login</a>
                <a href="signup.php">Register</a><?php } ?></p>
            </ul>

        </div>
    </section>


    <section class="form" id="order">
        <form action="order.php" method="POST" enctype="multipart/form-data">
            <?php 
                if(isset($_POST['order'])){
                    if($errors){
                        include('./config/errors.php');
                    }else{
                        echo $success;
                        unset($_SESSION['order']);
                    }
                }
            ?>
            
            <h1 class="title">Order Form</h1>
            <h2>Full Name:</h2>
            <input type="hidden" name="id" value="<?php echo $id; ?>" placeholder="Full Name"   autocomplete="off">
            <input type="text" name="name" placeholder="Full Name"   autocomplete="off">
            
            <h2>Father Name:</h2>
            <input type="text" name="fname" placeholder="Father Name"   autocomplete="off">
            
            <h2>Date Of Birth:</h2>
            <input type="date" name="dob" placeholder="date"   autocomplete="off">

            <h2>Phone Number:</h2>
            <input type="number" name="number" placeholder="number"   autocomplete="off">
            
            <h2>CNIC Number:</h2>
            <input type="number" name="cnic" placeholder="CNIC Number (Without -)"   autocomplete="off">
            
            <h2>CNIC Expiry Date:</h2>
            <input type="date" name="expire" placeholder="CNIC Expire"   autocomplete="off">
            
            <h2>Gender:</h2>
            <select name="gender" id="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="trans">Better Not Say</option>
            </select>

            <h2>Address:</h2>
            <textarea name="address" id="address" cols="30" rows="3" placeholder="Complete Address!"></textarea>
            
            <h2>Message:</h2>
            <textarea name="message" id="message" cols="30" rows="6" placeholder="Message Here! (Optional)"   autocomplete="off"></textarea>
            
            <h2>CNIC Image:</h2>
            <label for="for-img">
                    <img id="blah" src="./img/upload-place.png" alt="">
                </label>
            <input style="visibility:hidden; width:0; height:0" id="for-img" type="file" name="cnic_img" onchange="readURL(this);"   autocomplete="off">
            <div class="details">
                <h1>Total Price: PKR - <span><?php echo number_format($price); ?></span></h1>
                <input type="hidden" name="price" value="<?php echo $price; ?>" placeholder="Price"   autocomplete="off">
            </div>
            <p class="note"><i class="fas fa-exclamation"></i> Carefully Read data before submitting. It Can't Revert!</p>
            <button type="submit" name="order">Submit</button>
        </form>
    </section>

</body>
<script src="./js/scripts.js"></script>
<script>
    AOS.init();
</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah')
                    .attr('src', e.target.result)
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</html>