<?php require_once('./config/apis.php') ?>
<?php 
    if(isset($_SESSION['auth-user-login'])){
        $name = $_SESSION['auth-user-login'];
        $email = $_SESSION['auth-user-login-email'];
        $fname = $_SESSION['auth-user-login-fullname'];
    }else{
        header('location: login.php');
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
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" href="./img/logo-1.png">
    <link rel="stylesheet" href="./css/profile.css">
    <title><?php echo $name; ?> | MrCar</title>
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
                <a href="listing.php">Listing</a>
                <a class="active" href="profile.php">Profile</a>
            </ul>
            <ul class="res-btn">
                <a class="logout" href="?logout=true">Logout</a>
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
                <a class="active" href="profile.php">Profile</a>
                <a class="logout" href="?logout=true">Logout</a>
            </ul>
        </div>
    </section>

    <!--------Header--------->
    <section class="header">
        <div class="container">
            <p class="title">Profile <br> <span>Welcome, <?php echo $name; ?></span></p>
        </div>
    </section>
    <?php
        if(isset($_GET['order-id'])){
            $id = $_GET['order-id'];
            $sql = "SELECT * from orders_db WHERE order_id = '$id'";
            $res = mysqli_query($con,$sql);
            if(mysqli_num_rows($res) > 0){
                while($row = mysqli_fetch_assoc($res)){
                    $card = './img/documents/'.$row['cnic_img'];
                    $carid = $row['car_id'];
                    $sql2 = "SELECT * from cars_db WHERE id = '$carid'";
                    $res2 = mysqli_query($con, $sql2);
                    while($rows = mysqli_fetch_assoc($res2)){
                        $carname = $rows['car_name'];
                        $carimg = './img/cars/'.$rows['car_img'];
                        $status = $rows['car_status'];
                    }
                    
    ?>

    <section class="info">
        <div class="container">
            <h1 class="title">OrderID #<span><?php echo $id; ?></span> Information</h1>
            <ul class="grid">
                <div class="box">
                    <h1>Order ID:</h1>
                    <p><?php echo $id; ?></p>
                </div>
                <div class="box">
                    <h1>Car Name:</h1>
                    <p><?php echo $carname; ?></p>
                </div>
                <div class="box">
                    <h1>Car Status:</h1>
                    <p class="status"><?php echo $status; ?></p>
                </div>
                <div class="box">
                    <h1>Full Name:</h1>
                    <p><?php echo $row['fullname']; ?></p>
                </div>
                <div class="box">
                    <h1>Father Name:</h1>
                    <p><?php echo $row['fathername']; ?></p>
                </div>
                <div class="box">
                    <h1>Email Address:</h1>
                    <p class="email"><?php echo $row['email']; ?></p>
                </div>
                <div class="box">
                    <h1>Address:</h1>
                    <p><?php echo $row['address']; ?></p>
                </div>
                <div class="box">
                    <h1>Phone Number:</h1>
                    <p><?php echo $row['phone']; ?></p>
                </div>
                <div class="box">
                    <h1>Date Of Birth:</h1>
                    <p><?php echo $row['dateofbirth']; ?></p>
                </div>
                <div class="box">
                    <h1>CNICNumber:</h1>
                    <p><?php echo $row['cnic_number']; ?></p>
                </div>
                <div class="box">
                    <h1>CNICExpire:</h1>
                    <p><?php echo $row['expire']; ?></p>
                </div>
                <div class="box">
                    <h1>Price:</h1>
                    <p>PKR: <?php echo number_format($row['price']); ?></p>
                </div>
                <div class="box">
                    <h1>SubmittedAT:</h1>
                    <p><?php echo $row['created_at']; ?></p>
                </div>
                <div class="box">
                    <h1>Status:</h1>
                    <p style="text-transform: capitalize;"><?php echo $row['status']; ?></p>
                </div>
            </ul>
            <div class="info-box">
                <div class="block">
                    <h1>CNICImage:</h1><br>
                    <img src="<?php echo $card; ?>">
                </div>
                <div class="block">
                    <h1>ORDERED CAR:</h1><br>
                    <img src="<?php echo $carimg; ?>">
                </div>
            </div>       
        </div>
    </section>

    <?php } } } ?>
    <!--------Note--------->
    <section class="note">
        <div class="container">
            <h1>Important Note</h1>
            <ul>
                <li>Order Section is Where You Can See All of your Orders</li>
                <li>In Account Details Section, Only Change What you want to. Otherwise Anything can go wrong!</li>
                <li><span class="pending">Pending</span> means your application is waiting for action.</li>
                <li><span class="rejected">Rejected</span> means your application is rejected due to some reason.</li>
                <li><span class="approved">Approved</span> means your application is approved. Now Contact ShowRoom for procedure.</li>
                <li><span class="completed">Completed</span> means your car has been delievered.</li>
                <li><span class="view">View <i class="fas fa-eye"></i></span> Click it and view your submited Document.</li>
            </ul>
        </div>
    </section>


    <!--------Order--------->
    <section class="orders" id="order">
        <div class="container">
            <h1 class="title">Orders <i class="fas fa-shopping-cart"></i></h1>
            <table>
                <tr>
                    <th>OrderId</th>
                    <th>Date</th>
                    <th>CarName</th>
                    <th>Model</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                <?php 
                    $email = $_SESSION['auth-user-login-email'];
                    $sql = "SELECT * from orders_db WHERE email = '$email'";
                    $res = mysqli_query($con, $sql);
                    if(mysqli_num_rows($res) > 0){
                        while($row = mysqli_fetch_assoc($res)){
                            $order = $row['order_id'];
                            $status = $row['status'];
                            
                            $id = $row['car_id'];
                            
                            $sql2 = "SELECT * from cars_db WHERE id = '$id'";
                            $res2 = mysqli_query($con, $sql2);
                            while($rows = mysqli_fetch_assoc($res2)){
                                $carname = $rows['car_name'];
                                $model = $rows['car_model'];
                            }
                            if($status == 'pending'){
                                $status = "<span class='pending'>Pending</span>";
                            }elseif($status == 'rejected'){
                                $status = "<span class='rejected'>Rejected</span>";
                            }elseif($status == 'completed'){
                                $status = "<span class='completed'>Completed <i class='fas fa-check'></i> </span>";
                            }
                            else{
                                $status = "<span class='approved'>Approved</span>";
                            }
                ?>

                <tr>
                    <td>#<?php echo $order; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td><?php echo $carname; ?></td>
                    <td><?php echo $model; ?></td>
                    <td><?php echo $status; ?></td>
                    <td>PKR: <?php echo number_format($row['price']); ?> </td>
                    <td class="view"><a href="profile.php?order-id=<?php echo $order; ?>">View<i class="fas fa-eye"></i></a></td>
                </tr>
                <?php } }else{ ?>

                <tr>
                    <td>No Data</td>
                    <td>No Data</td>
                    <td>No Data</td>
                    <td>No Data</td>
                    <td>No Data</td>
                    <td>No Data</td>
                    <td>No Data</td>
                </tr>

                <?php } ?>
            </table>
        </div>
    </section>


    <!--------Order--------->
    <section class="account">
        <div class="container">
            <h1 class="title">Account Details<i class="fas fa-user"></i></h1>
            <form action="profile.php" method="post">
                <?php 
                    if(isset($_POST['update-account'])){
                        if($errors){
                            include('./config/errors.php');
                        }else{
                            echo $success;
                        }
                    }
                ?>
                <div class="flex">
                    <div class="block">
                        <label for="fullname">Full Name</label>
                        <input type="text" name="fullname" id="fullname" value="<?php echo $fname; ?>" placeholder="Full Name" autocomplete="off" required>
                    </div>
                    <div class="block">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="<?php echo $name; ?>" placeholder="Username" autocomplete="off" required>
                    </div>
                </div>
                <button type="submit" name="update-account">Save Changes</button>
            </form>


            <h1 class="sm-title">Change Password</h1>
            <form action="profile.php" method="post">
                <?php 
                    if(isset($_POST['update-pass'])){
                        if($errors){
                            include('./config/errors.php');
                        }else{
                            echo $success;
                        }
                    }
                ?>
                <label for="oldpass">Old Password:</label>
                <input type="password" name="oldpass" placeholder="Previous Password" id="oldpass" required>
                <div class="flex">
                    <div class="block">
                        <label for="password1">New Password:</label>
                        <input type="password" name="password1" id="password1" placeholder="New Password" required>
                    </div>
                    <div class="block">
                        <label for="password2">Repeat New Password:</label>
                        <input type="password" name="password2" id="password2" placeholder="Repeat New Password" required>
                    </div>
                </div>
                <button type="submit" name="update-pass">Save Changes</button>
            </form>
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