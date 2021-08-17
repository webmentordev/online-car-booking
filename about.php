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
    <link rel="stylesheet" href="./css/about.css">
    <title>About | MrCar</title>
</head>

<body>

    <!-------Go-To-Top-Button--------->
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-angle-up fa-fw"></i></button>

    <!-------NavBar--------->
    <section class="nav">
        <div class="container" id="nav-container">
            <h1><a href="about.php">MrCarAbout</a></h1>
            <ul class="res-btn">
                <a href="index.php">Home</a>
                <a class="active" href="about.php">About</a>
                <a href="listing.php">Listing</a>
                <a href="#map">Location</a>
                <a href="#brands">Brands</a>
                <a href="#team">Team</a>
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
                <a href="index.php">Home</a>
                <a class="active" href="about.php">About</a>
                <a href="listing.php">Listing</a>
                <a href="#map">Location</a>
                <a href="#brands">Brands</a>
                <a href="#brands">Team</a>
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
                <a href="login.php">Login</a>
                <a href="signup.php">Register</a>
            </ul>
            <?php } ?>
            
        </div>
    </section>

    <!--------Header--------->
    <section class="header">
        <div class="overlay-box"></div>
        <div class="container">
            <div class="details">
                <div class="inner-box">
                    <p class="title">About us</p>
                    <p class="quote">Curabitur aliquet quam id dui posuere blandit. Sed porttitor lectus nibh. Curabitur non <br> nulla sit amet nisl tempus convallis quis ac lectus. Nulla quis lorem ut libero malesuada feugiat. Vestibulum ante ipsum primis in faucibus
                        orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam</p>
                </div>
            </div>
        </div>
    </section>


    <!--------Header--------->
    <section class="services">
        <div class="container">
            <h1 class="title">A Leading Car Dealer For <br> Over 30 Years</h1>
            <div class="box">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eget lobortis justo, ut iaculis nulla. Donec varius magna ut turpis luctus aliquet. Nulla mauris eros, molestie non commodo eget, molestie ut nibh. Class aptent taciti sociosqu
                    ad litora torquent per conubia nostra, per inceptos himenaeos. Duis porttitor augue nibh, ut molestie tortor interdum vel. Aenean volutpat ultrices eros, non sodales lectus ultrices eu.</p>
                <p>Nullam scelerisque arcu lacus, at porttitor ex vestibulum semper. Phasellus luctus luctus facilisis. Vestibulum auctor ante velit, at sollicitudin tellus placerat qui.</p>
            </div>
        </div>
    </section>

    <!--------Working--------->
    <section class="working" id="working">
        <img class="top-asset" src="./img/asset/top-asset.png">
        <div class="container">
            <div class="details" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="title">Since 1983</h1>
                <div class="grid">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu velit rutrum, dignissim neque quis, venenatis nunc. Aliquam sodales neque quis arcu lacinia, in egestas metus semper. Mauris convallis lobortis ultrices. Lorem ipsum
                        dolor sit amet, consectetur adipiscing elit. Morbi eu velit rutrum, dignissim neque quis, venenatis nunc. Aliquam sodales neque quis arcu lacinia, in egestas metus semper. Mauris convallis</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu velit rutrum, dignissim neque quis, venenatis nunc. Aliquam sodales neque quis arcu lacinia, in egestas metus semper. Mauris convallis lobortis ultrices. Lorem ipsum
                        dolor sit amet, consectetur adipiscing elit. Morbi eu velit rutrum, dignissim neque quis, venenatis nunc. Aliquam sodales neque quis arcu lacinia, in egestas metus semper. Mauris convallis</p>
                </div>
            </div>
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

    <!--------Maps Section--------->
    <section class="map" id="map"></section>

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


    <!--------Team--------->
    <section class="team" id="team">
        <div class="container">
            <div class="box">
                <h1 class="title">Our Team</h1>
                <p>Nothing is achievable without a <br> a great & devoted team</p>
            </div>
            <div class="grid">
                <div class="box">
                    <img src="./img/team/team1.png">
                    <h1>Mehr Abbas</h1>
                    <p>Co-Founder</p>
                </div>
                <div class="box">
                    <img src="./img/team/team2.png">
                    <h1>Haseeb Ahmad</h1>
                    <p>Founder</p>
                </div>
                <div class="box">
                    <img src="./img/team/team3.jpg">
                    <h1>Rana Shehroz</h1>
                    <p>Admin</p>
                </div>
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
                <form action="about.php" method="POST" data-aos="zoom-up" data-aos-duration="1000">
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
<script>
    function initMap() {
        const pak = {
            lat: 30.219974,
            lng: 71.537299
        };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 16,
            center: pak,

        });
        const marker = new google.maps.Marker({
            position: pak,
            map: map
        });
    }
</script>
<script src="./js/scripts.js"></script>
<script>
    AOS.init();
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVL-beTRqeTi3oKIqr7DF_QP8GOPxiAa0&callback=initMap">
</script>


</html>