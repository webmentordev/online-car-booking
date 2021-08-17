<?php require_once('./config/apis.php') ?>
<?php 
    if(!isset($_SESSION['auth-admin-login-email'])){
        header('location: admin-login.php');
    }
    if(isset($_GET['logout'])){
        unset($_SESSION['auth-admin-login-email']);
        header('location: admin-login.php');
    }

    $limit = 10;
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
    <link rel="stylesheet" href="./css/admin.css">
    <title>Admin Panel | MrCar</title>
</head>

<body>
    <div class="main-body">
        <div class="box1">
            <h1 class="title">Admin Panel</h1>
            <ul>
                <button class="tablink" onclick="openTab('s1', this)" id="defaultOpen"><span class="name">Dashboard</span></button>
                <button class="tablink" onclick="openTab('s2', this)"><span class="name">Users</span></button>
                <button class="tablink" onclick="openTab('s3', this)"><span class="name">Cars</span></button>
                <button class="tablink" onclick="openTab('s4', this)"><span class="name">Orders</span></button>
                <button class="tablink" onclick="openTab('s5', this)"><span class="name">Contacts</span></button>
                <button class="tablink" onclick="openTab('s6', this)"><span class="name">Sold</span></button>
            </ul>

            <ul>
                <button><a href="?logout=true"><span class="name logout">Logout</span></a></button>
            </ul>
        </div>
        <div class="box2">
            <div id="s1" class="section tabcontent">
                <h1 class="title">Dasboard</h1>
                <div class="grid">
                    <div class="box">
                        <i class="fas fa-crown" style="background-color: #e64495;"></i>
                        <div class="block">
                            <h2>Stock Worth</h2>
                            <?php 
                                $sql = "SELECT * FROM cars_db";
                                $res = mysqli_query($con, $sql);
                                $total = 0;
                                $t_stock = 0;
                                $sold = 0;
                                if(mysqli_num_rows($res) > 0){
                                    while($row = mysqli_fetch_assoc($res)){
                                        $total += $row['car_price'];
                                        $t_stock += $row['car_stock'];
                                        $sold += $row['car_sold'];
                                    }
                                    echo "<p>PKR: <strong>".number_format($total)."</strong></p>";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="box">
                        <i class="fas fa-car" style="background-color: #28a366; padding: 12px 13px;"></i>
                        <div class="block">
                            <h2>Vehicles Stock</h2>
                            <p>In Shock: <strong><?php echo $t_stock; ?></strong></p>
                        </div>
                    </div>
                    <div class="box">
                        <i class="fas fa-chart-line" style="background-color: #da4329; padding: 12px 13px;"></i>
                        <div class="block">
                            <h2>Vehicles Sold</h2>
                            <p>Sold: <strong><?php echo $sold; ?></strong></p>
                        </div>
                    </div>
                    <div class="box">
                        <i class="fas fa-user" style="background-color: #297cda; padding: 12px 13px;"></i>
                        <div class="block">
                            <h2>Registered Users</h2>
                            <?php 
                                $sql = "SELECT COUNT(*) from users_db";
                                $res = mysqli_query($con, $sql);
                                $total_rows = mysqli_fetch_array($res)[0];
                                echo "<p>Users: <strong>$total_rows</strong></p>";
                            ?>
                            
                        </div>
                    </div>
                </div>
                <div class="grid2">
                    <div class="box">
                        <i class="fas fa-exclamation" style="background-color: #FFC405; padding: 12px 18px;"></i>
                        <div class="block ">
                            <h2>Orders Pending</h2>
                            <?php 
                                $sql = "SELECT COUNT(*) from orders_db WHERE status = 'pending'";
                                $res = mysqli_query($con, $sql);
                                $pending = mysqli_fetch_array($res)[0];
                                echo "<p>Pending: <strong>$pending</strong></p>";
                            ?>
                            
                        </div>
                    </div>
                    <div class="box ">
                        <i class="fas fa-check " style="background-color: #28a366;"></i>
                        <div class="block ">
                            <h2>Orders Completed</h2>
                            <?php 
                                $sql = "SELECT COUNT(*) from orders_db WHERE status = 'approved'";
                                $res = mysqli_query($con, $sql);
                                $approved = mysqli_fetch_array($res)[0];
                                echo "<p>Completed: <strong>$approved</strong></p>";
                            ?>
                        </div>
                    </div>
                    <div class="box ">
                        <i class="fas fa-times " style="background-color: #f11010; padding: 12px 15px;"></i>
                        <div class="block ">
                            <h2>Orders Rejected</h2>
                            <?php 
                                $sql = "SELECT COUNT(*) from orders_db WHERE status = 'rejected'";
                                $res = mysqli_query($con, $sql);
                                $rejected = mysqli_fetch_array($res)[0];
                                echo "<p>Rejected: <strong>$rejected</strong></p></p>";
                            ?>
                        </div>
                    </div>
                </div>
            </div>



            <div class="section tabcontent" id="s2">
                <h1 class="title">Users</h1>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>CreatedAT</th>
                        <th>UpdatedAT</th>
                        <th>Status</th>
                        <th>VerifiedStats</th>
                    </tr>
                    <?php
                        $sql = "SELECT * from users_db ORDER BY id DESC LIMIT $offset, $limit";
                        $res = mysqli_query($con, $sql);
                        while($row = mysqli_fetch_assoc($res)){
                            $status = $row['status'];
                            $verify = $row['verified'];
                            if($verify == "pending"){
                                $verified = "Pending";
                            }else{
                                $verified = "Verified <i class='fas fa-check check'></i>";
                            }
                    ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['fullname'] ?></td>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['created_at'] ?></td>
                        <td><?php echo $row['updated_at'] ?></td>
                        <td><?php echo $row['status'] ?></td>
                        <td><?php echo $verified; ?></td>
                    </tr>
                    <?php } ?>
                </table>
                <?php
                    $sql = "SELECT COUNT(*) from users_db";
                    $res = mysqli_query($con, $sql);
                    $total_rows = mysqli_fetch_array($res)[0];
                    $total_page = ceil($total_rows / $limit);
                ?>
                <div class="pagination">
                    <ul>
                        <li>
                            <a class="nav-link" href="<?php if($page <= 1){echo '#';}else{echo "?page=".$page -1;} ?>"><i class="fas fa-caret-left"></i></a>
                        </li>
                        <li>
                            <form action="admin.php" method="GET">
                                <select name="page" onchange="this.form.submit()">
                                    <?php 
                                        echo "<option value='$page'>Active:".$page."</option>";
                                        for($i = 1; $i <= $total_page; $i++){
                                            echo "<option value='$i'>".$i."</option>";
                                        }
                                    ?>
                                </select>
                            </form>
                        </li>
                        <li>
                            <a class="nav-link" href="<?php if($page == $total_page ){echo '#';}else{echo "?page=".$page + 1;} ?>"><i class="fas fa-caret-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div>



            <div class="section tabcontent" id="s3">
                <h1 class="title">Cars</h1>
                <table>
                    <tr>
                        
                        <th>Id</th>
                        <th>CarName</th>
                        <th>Price</th>
                        <th>Model</th>
                        <th>Type</th>
                        <th>Brand</th>
                        <th>Stock</th>
                        <th>Sold</th>
                        <th>Status</th>
                        <th>Color</th>
                        <th>CreatedAT</th>
                        <th>UpdatedAT</th>
                        <th>Action</th>
                    </tr>

                <?php 
                
                    $sql = "SELECT * from cars_db ORDER BY id desc LIMIT $offset, $limit";
                    $res = mysqli_query($con, $sql);
                    if(mysqli_num_rows($res) > 0){
                        while($row = mysqli_fetch_assoc($res)){
                ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['car_name'] ?></td>
                        <td>PKR: <?php echo number_format($row['car_price']) ?></td>
                        <td><?php echo $row['car_model'] ?></td>
                        <td><?php echo $row['car_type'] ?></td>
                        <td><?php echo $row['car_brand'] ?></td>
                        <td><?php echo $row['car_stock'] ?> Left</td>
                        <td><?php echo $row['car_sold'] ?> Sold</td>
                        <td><?php echo $row['car_status'] ?></td>
                        <td><?php echo $row['car_color'] ?></td>
                        <td><?php echo $row['created_at'] ?></td>
                        <td><?php echo $row['updated_at'] ?></td>
                        <td><a href="update.php?update-id=<?php echo $row['id'] ?>" class="view">Action <i class="fas fa-eye"></i></a></td>
                    </tr>
                <?php } } ?>


                </table>
                
                <a class="link" href="addcar.php">AddCar</a>
                <?php
                    $sql = "SELECT COUNT(*) from cars_db";
                    $res = mysqli_query($con, $sql);
                    $total_rows = mysqli_fetch_array($res)[0];
                    $total_page = ceil($total_rows / $limit);
                ?>
                <div class="pagination">
                    <ul>
                        <li>
                            <a class="nav-link" href="<?php if($page <= 1){echo '#';}else{echo "?page=".$page -1;} ?>"><i class="fas fa-caret-left"></i></a>
                        </li>
                        <li>
                            <form action="admin.php" method="GET">
                                <select name="page" onchange="this.form.submit()">
                                    <?php 
                                        echo "<option value='$page'>Active:".$page."</option>";
                                        for($i = 1; $i <= $total_page; $i++){
                                            echo "<option value='$i'>".$i."</option>";
                                        }
                                    ?>
                                </select>
                            </form>
                        </li>
                        <li>
                            <a class="nav-link" href="<?php if($page == $total_page ){echo '#';}else{echo "?page=".$page + 1;} ?>"><i class="fas fa-caret-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="section tabcontent" id="s4">
                <h1 class="title">Orders</h1>
                
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
                                    $car_id = $rows['id'];
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

                <?php } } }  ?>

                <form class="ordering" action="admin.php" method="get">
                    <input list="order-list" name="order-id" placeholder="Choose Order Number!" onchange="this.form.submit()" />
                    <datalist id="order-list">
                        <?php 
                            $sql = "SELECT * from Orders_db";
                            $res = mysqli_query($con, $sql);
                            if(mysqli_num_rows($res) > 0){
                                while($row = mysqli_fetch_object($res)){
                                    echo "<option value='".$row->order_id."' />";
                                }
                            }else{
                                echo "<option value='No Data Found' />";
                            }
                        ?>
                    </datalist>           
                </form>
                <form class="filter" action="admin.php" method="get">
                    <select name="filter" onchange="this.form.submit()">
                        <option value="<?php if(isset($_GET['filter'])){ echo $_GET['filter']; } else { echo "pending"; } ?>">Current: <?php if(isset($_GET['filter'])){ echo $_GET['filter']; } else { echo "pending"; } ?></option>
                        <option value="pending">Pending</option>
                        <option value="rejected">Rejected</option>
                        <option value="approved">Approved</option>
                        <option value="completed">Completed</option>
                    </select>
                </form>

                <table>
                    <tr>
                        <th>OrderID</th>
                        <th>CarID</th>
                        <th>FullName</th>
                        <th>FatherName</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>DateOfBirth</th>
                        <th>CNICNumber</th>
                        <th>CNICExpire</th>
                        <th>Price</th>
                        <th>CreatedAT</th>
                        <th>Status</th>
                        <th>View</th>
                    </tr>


                    <?php 
                        if(isset($_GET['filter'])){
                            $filter = $_GET['filter'];
                            $sql = "SELECT * from orders_db WHERE status = '$filter' ORDER BY id desc LIMIT $offset, $limit";
                        }else{
                            $sql = "SELECT * from orders_db ORDER BY id desc LIMIT $offset, $limit";
                        }
                        $res = mysqli_query($con, $sql);
                        if(mysqli_num_rows($res) > 0){
                            while($row = mysqli_fetch_assoc($res)){
                                $carid = $row['car_id'];
                    ?>
                    <tr>
                        <td>#<?php echo $row['order_id'] ?></td>
                        <td><?php echo  $carid; ?></td>
                        <td><?php echo $row['fullname'] ?></td>
                        <td><?php echo $row['fathername'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['phone'] ?></td>
                        <td><?php echo $row['dateofbirth'] ?></td>
                        <td><?php echo $row['cnic_number'] ?></td>
                        <td><?php echo $row['expire'] ?></td>
                        <td>PKR: <?php echo number_format($row['price']) ?></td>
                        <td><?php echo $row['created_at'] ?></td>
                        <td>
                            <form action="admin.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['order_id'] ?>">
                                <input type="hidden" name="car_id" value="<?php echo $carid; ?>">
                                <select name="update-app" id="update-app" onchange="this.form.submit()">
                                    <option value="<?php echo $row['status'] ?>">Current: <?php echo $row['status'] ?></option>
                                    <option value="pending">Pending</option>
                                    <option value="rejected">Rejected</option>
                                    <option value="approved">Approved</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </form>
                        </td>
                        <td class="view"><a href="admin.php?order-id=<?php echo $row['order_id'] ?>"><i class="fas fa-eye"></i></a></td>
                    </tr>
                <?php } } ?>
                
                <?php
                    $sql = "SELECT COUNT(*) from orders_db";
                    $res = mysqli_query($con, $sql);
                    $total_rows = mysqli_fetch_array($res)[0];
                    $total_page = ceil($total_rows / $limit);
                ?>
                    
                </table>

                <div class="pagination">
                    <ul>
                        <li>
                            <a class="nav-link" href="<?php if($page <= 1){echo '#';}else{echo "?page=".$page -1;} ?>"><i class="fas fa-caret-left"></i></a>
                        </li>
                        <li>
                            <form action="admin.php" method="GET">
                                <select name="page" onchange="this.form.submit()">
                                    <?php 
                                        echo "<option value='$page'>Active:".$page."</option>";
                                        for($i = 1; $i <= $total_page; $i++){
                                            echo "<option value='$i'>".$i."</option>";
                                        }
                                    ?>
                                </select>
                            </form>
                        </li>
                        <li>
                            <a class="nav-link" href="<?php if($page == $total_page ){echo '#';}else{echo "?page=".$page + 1;} ?>"><i class="fas fa-caret-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="section tabcontent" id="s6">
                <h1 class="title">Sold Cars</h1>
                <form class="ordering" action="admin.php" method="get">
                    <input list="order-list" name="order-id" placeholder="Choose Order Number!" onchange="this.form.submit()" />
                    <datalist id="order-list">
                        <?php 
                            $sql = "SELECT * from Orders_db WHERE status = 'completed'";
                            $res = mysqli_query($con, $sql);
                            if(mysqli_num_rows($res) > 0){
                                while($row = mysqli_fetch_object($res)){
                                    echo "<option value='".$row->order_id."' />";
                                }
                            }else{
                                echo "<option value='No Data Found' />";
                            }
                        ?>
                    </datalist>           
                </form>
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
                                    $car_id = $rows['id'];
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

                <?php } } }  ?>
                <table>
                    <tr>
                        <th>OrderID</th>
                        <th>CarID</th>
                        <th>FullName</th>
                        <th>FatherName</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>DateOfBirth</th>
                        <th>CNICNumber</th>
                        <th>CNICExpire</th>
                        <th>Price</th>
                        <th>CreatedAT</th>
                        <th>Status</th>
                        <th>View</th>
                    </tr>


                    <?php 
                        $sql = "SELECT * from orders_db WHERE status = 'completed' ORDER BY  id desc LIMIT $offset, $limit";
                        $res = mysqli_query($con, $sql);
                        if(mysqli_num_rows($res) > 0){
                            while($row = mysqli_fetch_assoc($res)){
                                $carid = $row['car_id'];
                    ?>
                    <tr>
                        <td>#<?php echo $row['order_id'] ?></td>
                        <td><?php echo  $carid; ?></td>
                        <td><?php echo $row['fullname'] ?></td>
                        <td><?php echo $row['fathername'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['phone'] ?></td>
                        <td><?php echo $row['dateofbirth'] ?></td>
                        <td><?php echo $row['cnic_number'] ?></td>
                        <td><?php echo $row['expire'] ?></td>
                        <td>PKR: <?php echo number_format($row['price']) ?></td>
                        <td><?php echo $row['created_at'] ?></td>
                        <td><?php echo $row['status'] ?></td>
                        <td class="view"><a href="admin.php?order-id=<?php echo $row['order_id'] ?>"><i class="fas fa-eye"></i></a></td>
                    </tr>
                <?php } } ?>
                
                <?php
                    $sql = "SELECT COUNT(*) from orders_db";
                    $res = mysqli_query($con, $sql);
                    $total_rows = mysqli_fetch_array($res)[0];
                    $total_page = ceil($total_rows / $limit);
                ?>
                    
                </table>

                <div class="pagination">
                    <ul>
                        <li>
                            <a class="nav-link" href="<?php if($page <= 1){echo '#';}else{echo "?page=".$page -1;} ?>"><i class="fas fa-caret-left"></i></a>
                        </li>
                        <li>
                            <form action="admin.php" method="GET">
                                <select name="page" onchange="this.form.submit()">
                                    <?php 
                                        echo "<option value='$page'>Active:".$page."</option>";
                                        for($i = 1; $i <= $total_page; $i++){
                                            echo "<option value='$i'>".$i."</option>";
                                        }
                                    ?>
                                </select>
                            </form>
                        </li>
                        <li>
                            <a class="nav-link" href="<?php if($page == $total_page ){echo '#';}else{echo "?page=".$page + 1;} ?>"><i class="fas fa-caret-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="section tabcontent" id="s5">
                <h1 class="title">Contacts</h1>
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>CreatedAT</th>
                        <th>Action</th>
                    </tr>

                <?php 
                    $sql = "SELECT * from contact_db ORDER BY id desc LIMIT $offset, $limit";
                    $res = mysqli_query($con, $sql);
                    if(mysqli_num_rows($res) > 0){
                        while($row = mysqli_fetch_assoc($res)){
                            
                ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['fullname'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['message'] ?></td>
                        <td><?php echo $row['created_at'] ?></td>
                        <td><a href="?delete-cont=<?php echo $row['id']; ?>" class="delete">Delete</a></td>
                    </tr>
                <?php } } ?>


                </table>

                <?php
                    $sql = "SELECT COUNT(*) from contact_db";
                    $res = mysqli_query($con, $sql);
                    $total_rows = mysqli_fetch_array($res)[0];
                    $total_page = ceil($total_rows / $limit);
                ?>
                <div class="pagination">
                    <ul>
                        <li>
                            <a class="nav-link" href="<?php if($page <= 1){echo '#';}else{echo "?page=".$page -1;} ?>"><i class="fas fa-caret-left"></i></a>
                        </li>
                        <li>
                            <form action="admin.php" method="GET">
                                <select name="page" onchange="this.form.submit()">
                                    <?php 
                                        echo "<option value='$page'>Active:".$page."</option>";
                                        for($i = 1; $i <= $total_page; $i++){
                                            echo "<option value='$i'>".$i."</option>";
                                        }
                                    ?>
                                </select>
                            </form>
                        </li>
                        <li>
                            <a class="nav-link" href="<?php if($page == $total_page ){echo '#';}else{echo "?page=".$page + 1;} ?>"><i class="fas fa-caret-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function openTab(service, elmnt) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = " ";
        }
        document.getElementById(service).style.display = "block";
        elmnt.style.backgroundColor = color;

    }
    document.getElementById("defaultOpen").click();
</script>

</html>