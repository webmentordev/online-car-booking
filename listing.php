<?php require_once('./config/apis.php') ?>
<?php 
    if(isset($_GET['logout'])){
        unset($_SESSION['auth-user-login']);
        header('location: login.php');
    }
?>

<?php 
    $limit = 12;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $offset = ($page - 1) * $limit;
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
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" href="./img/logo-1.png">
    <link rel="stylesheet" href="./css/listing.css">
    <title>Listing | MrCar</title>
</head>

<body>

    <!-------Go-To-Top-Button--------->
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-angle-up fa-fw"></i></button>

    <!-------NavBar--------->
    <section class="nav">
        <div class="container" id="nav-container">
            <h1><a href="about.php">MrCarListing</a></h1>
            <ul class="res-btn">
                <a href="index.php">Home</a>
                <a href="about.php">About</a>
                <a class="active" href="listing.php">Listing</a>
                <a href="#inventory">Inventory</a>
            </ul>

            <?php
                if(isset($_SESSION['auth-user-login'])){
                    $name = $_SESSION['auth-user-login'];
            ?>
                <ul class="res-btn">
                    <a class="left-link" href="profile.php?profile=<?php echo $name; ?>">
                        <?php echo $name; ?>
                    </a>
                    <a href="?logout=true">Logout</a>
                </ul>
                <?php } else {?>

                <ul class="res-btn">
                    <a class="left-link" href="login.php">Login</a>
                    <a href="signup.php">Register</a>
                </ul>
                <?php } ?>

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
                <a class="active" href="listing.php">Listing</a>
            </ul>

            <?php
                if(isset($_SESSION['auth-user-login'])){
                    $name = $_SESSION['auth-user-login'];
            ?>
                <ul class="res-btn">
                    <a class="left-link" href="profile.php?profile=<?php echo $name; ?>">
                        <?php echo $name; ?>
                    </a>
                    <a href="?logout=true">Logout</a>
                </ul>
                <?php } else {?>

                <ul class="res-btn">
                    <a href="login.php">Login</a>
                    <a href="signup.php">Register</a>
                </ul>
                <?php } ?>

        </div>
    </section>

    <!--------Header--------->
    <section class="header">
        <div class="container">
            <p class="title">Listing</p>
        </div>
    </section>

    <!--------years--------->
    <section class="years" id="years">
        <div class="container">
            <div class="grid">
                <div class="box" data-aos="zoom-in" data-aos-duration="1000">
                    <?php 
                        $sql = "SELECT * FROM cars_db";
                        $res = mysqli_query($con, $sql);
                        $total = 0;
                        $sold = 0;
                        if(mysqli_num_rows($res) > 0){
                            while($row = mysqli_fetch_assoc($res)){
                                $total += $row['car_stock'];
                                $sold += $row['car_sold'];
                            }
                            echo "<h1>".$total."</h1>";
                        }
                    ?>
                    <p>Vehicles in Stock</p>
                </div>
                <div class="box" data-aos="zoom-in" data-aos-duration="1000">
                    <h1><?php echo $sold; ?></h1>
                    <p>Vehicles Sold</p>
                </div>
                <div class="box" data-aos="zoom-in" data-aos-duration="1000">
                    <h1>
                        <script> var year = new Date().getFullYear();
                                 var current = year - 1995;
                                 document.write(current);
                        </script>
                    </h1>
                    <p>Years in Business</p>
                </div>
            </div>
        </div>
    </section>


    <!--------Inventory--------->
    <section class="inventory" id="inventory">
        <div class="container">
            <div class="box">
                <h1 class="title" data-aos="fade-up" data-aos-duration="1000">Inventory</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque pellentesque <br> viverra quam in aliquam laoreet quis justo.</p>
            </div>
            <div class="filter">
                <form action="listing.php" method="GET">
                    
                    <select name="type" id="type">
                        
                        <?php 
                            $sql = "SELECT DISTINCT car_type from cars_db";
                            $res = mysqli_query($con, $sql);
                            if(mysqli_num_rows($res) > 0){
                                while($row = mysqli_fetch_assoc($res)){    
                        ?>
                            <option value="<?php echo strtolower($row['car_type']); ?>"><?php echo $row['car_type']; ?></option>
                        <?php } } ?>
                    </select>

                    <select name="brand" id="brand">
                        
                        <?php 
                            $sql = "SELECT DISTINCT car_brand from cars_db";
                            $res = mysqli_query($con, $sql);
                            if(mysqli_num_rows($res) > 0){
                                while($row = mysqli_fetch_assoc($res)){    
                        ?>
                            <option value="<?php echo strtolower($row['car_brand']); ?>"><?php echo $row['car_brand']; ?></option>
                        <?php } } ?>
                    </select>

                    <select name="model" id="model">
                        
                        <?php 
                            $sql = "SELECT DISTINCT car_model from cars_db";
                            $res = mysqli_query($con, $sql);
                            if(mysqli_num_rows($res) > 0){
                                while($row = mysqli_fetch_assoc($res)){    
                        ?>
                            <option value="<?php echo strtolower($row['car_model']); ?>"><?php echo $row['car_model']; ?></option>
                        <?php } } ?>
                    </select>

                    
                    <div>
                        <input style="width: 100%;" type="range" name="price" id="range" min="200000" max="150000000">
                        <h2>200,000 - <span id="span"></span></h2>
                    </div>
                    


                    <select name="status" id="status">
                        <option value="new">New</option>
                        <option value="used">Used</option>
                    </select>

                    <button type="submit" name="filter" value="true">Filter</button>
                </form>
            </div>
            <div class="grid">
                <?php 
                    if(isset($_GET['type']) && isset($_GET['brand']) && isset($_GET['model']) && isset($_GET['status']) && isset($_GET['price'])){
                        $type = $_GET['type'];
                        $brand = $_GET['brand'];
                        $model = $_GET['model'];
                        $status = $_GET['status'];
                        $range = $_GET['price'];
                        $sql = "SELECT * from cars_db WHERE car_type = '$type' 
                                AND car_model = '$model' 
                                AND car_brand = '$brand' 
                                AND car_status = '$status' 
                                AND car_price BETWEEN 200000 AND $range
                                ORDER BY id DESC LIMIT $offset, $limit";
                    }else{
                        $sql = "SELECT * from cars_db ORDER BY id DESC LIMIT $offset, $limit";
                    }
                ?>
                <?php include('./config/carslist.php');?> 
            </div>

             <?php
                $sql = "SELECT COUNT(*) from cars_db";
                $res = mysqli_query($con, $sql);
                $total_rows = mysqli_fetch_array($res)[0];
                $total_page = ceil($total_rows / $limit);
            ?>

            <ul class="pagination">
                <a class="nav-link-left nav-link" href="?page=1"><i class="fas fa-angle-double-left"></i></a>
                <a class="nav-link" href="<?php if($page <= 1){echo '#';}else{echo " ?page=".$page -1;} ?>"><i class="fas fa-caret-left"></i></a>
                <?php 
                    for($i = 1; $i <= $total_page; $i++){
                        if($page == $i){
                            echo "<a class='active links' href='?page=$i'>".$i."</a>";
                        }else{
                            echo "<a class='links' href='?page=$i'>".$i."</a>";
                        }
                    }
                ?>
                <a class="nav-link" href="<?php if($page == $total_page ){echo '#';}else{echo " ?page=".$page + 1;} ?>"><i class="fas fa-caret-right"></i></a>
                <a class="nav-link-right nav-link" href="?page=<?php echo $total_page;?>"><i class="fas fa-angle-double-right"></i></a>

            </ul>
        </div>
    </section>


    <!--------Footer--------->
    <section class="footer">
        <div class="container">
            <p>Designed By <a href="admin.php"><strong>Haseeb & Group</strong></a> | Powered by <strong>PHP 8.0</strong></p>
            <ul>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </ul>

            <ul class="payment">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-stripe"></i>
                <i class="fab fa-cc-paypal"></i>
                <i class="fab fa-cc-discover"></i>
                <i class="fab fa-cc-mastercard"></i>
            </ul>
        </div>
    </section>
</body>
<script src="./js/scripts.js"></script>
<script>
    AOS.init();
</script>
<script>
    var slider = document.getElementById("range");
    var output = document.getElementById("span");
    output.innerHTML = slider.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    slider.oninput = function() {
    output.innerHTML = this.value;
    }
</script>
</script>


</html>