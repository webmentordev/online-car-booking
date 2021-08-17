<?php require_once('./config/apis.php') ?>
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
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" href="./img/logo-1.png">
    <link rel="stylesheet" href="./css/index.css">
    <title>MrCar | Booking & Selling</title>
</head>

<body>

    <!-------Go-To-Top-Button--------->
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-angle-up fa-fw"></i></button>

    <!-------NavBar--------->
    <section class="nav">
        <div class="container" id="nav-container">
            <h1><a href="index.php">MrCar</a></h1>
           <ul class="res-btn">
                <a class="active" href="index.php">Home</a>
                <a href="about.php">About</a>
                <a href="listing.php">Listing</a>
                <a href="#inventory">Inventory</a>
                <a href="#brands">Brands</a>
                <a href="#contact">Contact</a>
            </ul>

            <?php
                if(isset($_SESSION['auth-user-login'])){
                    $name = $_SESSION['auth-user-login'];
            ?>
                <ul class="res-btn">
                    <a class="left-link" href="profile.php"><?php echo $name; ?></a>
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
                <a class="active" href="index.php">Home</a>
                <a href="about.php">About</a>
                <a href="listing.php">Listing</a>
                <a href="#inventory">Inventory</a>
                <a href="#brands">Brands</a>
                <a href="#contact">Contact</a>
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



    <!--------Header--------->
    <section class="header">
        <div class="overlay-box"></div>
        <div class="container">
            <div class="details">
                <h1>0% APR FINANCING FOR UP TO 12 MONTHS</h1>
                <div class="inner-box">
                    <p class="title">PURCHASE YOUR PERFECT CAR</p>
                    <p class="quote">Proin eget tortor risus. Nulla porttitor accumsan tincidunt. Vestibulum ante ipsum primis in faucibus orci <br> luctus et ultrices posuere cubilia auctor sit amet aliquam vel.</p>
                    <a href="listing.php">View All Inventory</a>
                </div>
            </div>
        </div>
    </section>


    <!--------About--------->
    <section class="about">
        <div class="container">
            <div class="box-1" data-aos="zoom-in-up">
                <i class="fas fa-reply"></i>
                <h1>PRE OWNED VEHICLES</h1>
                <p>Vivamus suscipit tortor eget felis porttitor volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
                    posuere cubilia Curae; Donec velit neque</p>
                <a class="button" href="listing.php?type=used">View Used <i class="fas fa-arrow-right"></i></a>
                <div class="bottom-1"></div>
            </div>
            <div class="box-2" data-aos="zoom-in-up">
                <i class="fas fa-tag"></i>
                <h1>BRAND NEW CARS</h1>
                <p>Vivamus suscipit tortor eget felis porttitor volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
                    posuere cubilia Curae; Donec velit neque</p>
                <a class="button" href="listing.php">Shop Now <i class="fas fa-arrow-right"></i></a>
                <div class="bottom-2"></div>
            </div>
        </div>
    </section>



    <!--------Services--------->
    <section class="services">
        <img class="bottom-img" src="./img/asset/bottom-asset.png">
        <div class="container">
            <h1 class="title">Leading Dealers in New <br> & Used Cars</h1>
            <div class="grid">
                <div class="box" data-aos="fade-up" data-aos-duration="1000">
                    <h1>New & Used</h1>
                    <p>Consectetur adipiscing elit. Quisque <br> pellentesque viverra quam.</p>
                    <a href="#">VIEW DETAILS <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="box" data-aos="fade-up" data-aos-duration="1000">
                    <h1>0% APR Financing</h1>
                    <p>Consectetur adipiscing elit. Quisque <br> pellentesque viverra quam.</p>
                    <a href="#">VIEW DETAILS <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="box" data-aos="fade-up" data-aos-duration="1000">
                    <h1>Maintenance Packages</h1>
                    <p>Consectetur adipiscing elit. Quisque <br> pellentesque viverra quam.</p>
                    <a href="#">VIEW DETAILS <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="box" data-aos="fade-up" data-aos-duration="1000">
                    <h1>Free Test Drives</h1>
                    <p>Consectetur adipiscing elit. Quisque <br> pellentesque viverra quam.</p>
                    <a href="#">VIEW DETAILS <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="box" data-aos="fade-up" data-aos-duration="1000">
                    <h1>Vehicle History Reports</h1>
                    <p>Consectetur adipiscing elit. Quisque <br> pellentesque viverra quam.</p>
                    <a href="#">VIEW DETAILS <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="box" data-aos="fade-up" data-aos-duration="1000">
                    <h1>Buy, Sell, Trade</h1>
                    <p>Consectetur adipiscing elit. Quisque <br> pellentesque viverra quam.</p>
                    <a href="#">VIEW DETAILS <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>



    <!--------Inventory--------->
    <section class="inventory" id="inventory">
        <div class="container">
            <div class="box">
                <h1 class="title" data-aos="fade-up" data-aos-duration="1000">New Inventory</h1>
                <p data-aos="fade-up" data-aos-duration="1000">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque pellentesque <br> viverra quam in aliquam laoreet quis justo.</p>
            </div>

            <div class="grid">
                <?php 
                    $sql = "SELECT * from cars_db ORDER BY id DESC LIMIT 9";
                ?>
                <?php include('./config/carslist.php');?> 
            </div>
            <a href="listing.php" class="view-all">View All <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>


    <!--------Fincing--------->
    <section class="financing" id="financing">
        <img class="top-asset" src="./img/asset/top-asset.png">
        <div class="container">
            <h1 class="title">0% APR FINANCING</h1>
        </div>
    </section>

    <!--------Brands--------->
    <section class="brands" id="brands">
        <div class="container">
            <div class="box">
                <h1 class="title">Our Trusted Brands</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque pellentesque <br> viverra quam in aliquam laoreet quis justo.</p>
            </div>
            <div class="grid" data-aos="fade-up" data-aos-duration="1000">
                <i class="fab fa-d-and-d"></i>
                <i class="fab fa-gitkraken"></i>
                <i class="fab fa-shopware"></i>
                <i class="fab fa-salesforce"></i>

                <i class="fab fa-servicestack"></i>
                <i class="fab fa-y-combinator"></i>
                <i class="fab fa-yelp"></i>
                <i class="fab fa-wodu"></i>

            </div>
        </div>
    </section>



    <!--------Contact--------->
    <section class="contact" id="contact">
        <img class="bottom-img" src="./img/asset/bottom-asset.png">
        <div class="container">
            <div class="box-1">
                <div class="overlay-box"></div>
                <div class="inner">
                    <h1>Get In Touch</h1>
                    <h2>(0300) 123-4562</h2>
                    <div class="flex">
                        <ul data-aos="fade-up" data-aos-duration="2000">
                            <li><span><strong>Location</strong></span></li>
                            <li class="gap">Near MDA Chowk, Workshop 12, <br> Multan, Pakistan</li>
                            <li><span><strong>Email</strong></span></li>
                            <li>info@mrcar.com</li>
                        </ul>

                        <ul data-aos="fade-up" data-aos-duration="2000">
                            <li><span><strong>Hours</strong></span></li>
                            <li>Mon:10am – 5pm</li>
                            <li>Tue: 10am – 5pm</li>
                            <li>Wed: Closed</li>
                            <li>Thur: 10am – 5pm</li>
                            <li>Fri: 10am – 3pm</li>
                            <li>Sat: 10am – 3pm</li>
                            <li>Sun: Closed</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="box-2">
                <h1>Send Message</h1>
                <form action="index.php" method="POST" data-aos="zoom-up" data-aos-duration="1000">
                    <?php 
                        if(isset($_POST['contact'])){
                            if($errors){
                                include('./config/errors.php');
                            }else{
                                echo $success;
                            }
                        }
                    ?>
                    <input type="text" name="fullname" placeholder="Full Name" autocomplete="off" required>
                    <input type="email" name="email" placeholder="Email Address" autocomplete="off" required>
                    <textarea name="message" id="message" cols="30" rows="7" placeholder="Message!" autocomplete="off" required></textarea>
                    <button type="submit" name="contact">Send Message</button>
                </form>
            </div>
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

</html>