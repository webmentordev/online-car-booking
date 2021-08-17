<?php require_once('./config/apis.php') ?>
<?php 
    if(!isset($_SESSION['auth-admin-login-email']) || !isset($_GET['update-id'])){
        header('location: admin-login.php');
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
    <link rel="stylesheet" href="./css/update.css">
    <title>Update Admin Panel | MrCar</title>
</head>

<body>

    <div class="nav">
        <h1 class="title"><a href="admin.php">Admin Panel</a></h1>
        <ul>
            <button><a href="?logout=true"><span class="name logout">Logout</span></a></button>
        </ul>
    </div>

    <section class="form">
        <?php 
        
            if($_GET['update-id']){
                $id = $_GET['update-id'];
                $sql = "SELECT * from cars_db WHERE id = '$id'";
                $res = mysqli_query($con, $sql);
                while($row = mysqli_fetch_assoc($res)){

        ?>
        <form action="addcar.php" method="POST" enctype="multipart/form-data">
            <div class="img">
                <img id="blah" src="./img/palaceholderimg.jpg" />
            </div>
            <?php 
                if(isset($_POST['updatecar'])){
                    if($errors){
                        include('./config/errors.php');
                    }else{
                        echo $success;
                    }
                }
            ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>" placeholder="Car Id" required autocomplete="off">
            <h2>Car Name</h2>
            <input type="text" name="name" value="<?php echo $row['car_name'] ?>" placeholder="Car Name" required autocomplete="off">
            <h2>Car Price</h2>
            <input type="number" name="price" value="<?php echo $row['car_price'] ?>" placeholder="Price" required autocomplete="off">
            <h2>Car Model</h2>
            <input type="number" name="model" value="<?php echo $row['car_model'] ?>" placeholder="Model (Year)" required autocomplete="off">
            <h2>Car Brand</h2>
            <input type="text" name="brand" value="<?php echo $row['car_brand'] ?>" placeholder="BMW, Ferrari e.t.c" required autocomplete="off">
            <h2>Car Type</h2>
            <input type="text" name="type" value="<?php echo $row['car_type'] ?>" placeholder="SUV, Sports e.t.c" required autocomplete="off">
            <h2>Car Stock</h2>
            <input type="number" name="stock" placeholder="Stock" value="<?php echo $row['car_stock'] ?>" required autocomplete="off">
            <h2>Car color</h2>
            <input type="text" name="color" placeholder="Color" value="<?php echo $row['car_color'] ?>" required autocomplete="off">
            <h2>Car Status</h2>
            <select name="status" id="status" required autocomplete="off">
                <option value="new">New</option>
                <option value="used">Used</option>
            </select>
            <h2>Car Details</h2>
            <textarea name="details" id="details" cols="30" rows="5" placeholder="Car Details Here! add -- to saperate lines" required autocomplete="off"><?php echo $row['car_details'] ?></textarea>
            <h2>Car Image</h2>
            <input type="file" name="carimg" onchange="readURL(this);" autocomplete="off">
            <button type="submit" name="updatecar">Update</button>
        </form>

        <?php  } } ?>
    </section>
</body>
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