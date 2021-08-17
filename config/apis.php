<?php 
    require 'config.php';
    date_default_timezone_set('Asia/Karachi');
    $errors = array();
    session_start();
?>


<?php 

    //User Login
    if(isset($_POST['login'])){
        $email = htmlspecialchars(mysqli_real_escape_string($con, $_POST['email']));
        $pass = htmlspecialchars(mysqli_real_escape_string($con, $_POST['password']));

        $pass = strtolower($pass);
        $email = strtolower($email);

        $enc_pass = md5(md5($pass));

        if(empty($email) || empty($pass)){array_push($errors, "Fields are Empty");}

        if(strpos($email, '@') == false){ array_push($errors, "Email Format isn't correct"); }

        if(count($errors) == 0){
            $sql = "SELECT * from users_db WHERE email = '$email' AND password = '$enc_pass' LIMIT 1";
            $res = mysqli_query($con, $sql);
            if(mysqli_num_rows($res) == 1){
               $row = mysqli_fetch_assoc($res);
               $_SESSION['auth-user-login'] = $row['username'];
               $_SESSION['auth-user-login-email'] = $row['email'];
               $_SESSION['auth-user-login-fullname'] = $row['fullname'];

               header('location: index.php');
            }else{
                array_push($errors, "Invalid Login Details!");
            }
        }
    }
?>

<?php 
    //User Signup
    if(isset($_POST['register'])){

        $username = htmlspecialchars(mysqli_real_escape_string($con, $_POST['username']));
        $email = htmlspecialchars(mysqli_real_escape_string($con, $_POST['email']));
        $name = htmlspecialchars(mysqli_real_escape_string($con, $_POST['fullname']));
        $pass = htmlspecialchars(mysqli_real_escape_string($con, $_POST['password1']));
        $pass2 = htmlspecialchars(mysqli_real_escape_string($con, $_POST['password2']));


        $pass = strtolower($pass);
        $pass2 = strtolower($pass2);

        $username = strtolower($username);
        $email = strtolower($email);

        $enc_pass = md5(md5($pass));

        if(empty($email) || empty($name) || empty($username) || empty($pass2) || empty($pass)){
            array_push($errors, "Any field is empty");
        }

        if($pass != $pass2){array_push($errors, "Both Password Does Not Match");}

        if(strlen($pass) < 8){ array_push($errors, "Password must be 8 letters long"); }
        if(strlen($username) > 12){ array_push($errors, "Username must be less then 12 letters"); }

        if(strpos($email, '@') == false){ array_push($errors, "Email is not Correct"); }
        
        $sql1 = "SELECT * from users_db WHERE email = '$email' || username = '$username' LIMIT 1";
        $res1 = mysqli_query($con, $sql1);
        if(mysqli_num_rows($res1) == 1){
            array_push($errors, "Email or Username Already Exists");
        }

        if(count($errors) == 0){
            $date = date("d, M Y h:i:s A");
            $sql = "INSERT INTO users_db (fullname, username, email, password, created_at) VALUES ('$name', '$username', '$email','$enc_pass', '$date')";
            $res = mysqli_query($con, $sql);
            if($res){
                $_SESSION['auth-user-login'] = $username;
                $_SESSION['auth-user-login-email'] = $email;
                $_SESSION['auth-user-login-fullname'] = $name;
                header('location: index.php');
            }else{
                array_push($errors, "Something Went Wrong!");
            }
        }
    }


    //Contact Form Data
    if(isset($_POST['contact'])){
        $email = htmlspecialchars(mysqli_real_escape_string($con, $_POST['email']));
        $name = htmlspecialchars(mysqli_real_escape_string($con, $_POST['fullname']));
        $msg = htmlspecialchars(mysqli_real_escape_string($con, $_POST['message']));


        $email = strtolower($email);

        if(empty($email) || empty($name) || empty($msg)){array_push($errors, "Fields shouldn't be Empty");}

        if(strpos($email, '@') == false){ array_push($errors, "Email is not Correct"); }

        if(count($errors) == 0){
            $date = date("d, M Y h:i:s A");
            $sql = "INSERT INTO contact_db (email, fullname, message, created_at) VALUES ('$email', '$name', '$msg', '$date')";
            $res = mysqli_query($con, $sql);
            if($res){
                $success = "<p class='success'>Message Successfully Sent!</p>";
            }else{
                echo "Something Went Wrong!";
            }
        }
    }

    //Update User Details
    if(isset($_POST['update-account'])){
        $fullname = htmlspecialchars(mysqli_real_escape_string($con, $_POST['fullname']));
        $username = htmlspecialchars(mysqli_real_escape_string($con, $_POST['username']));

        $username = strtolower($username);

        if( empty($fullname) || empty($username)){
            array_push($errors, "Any field is empty");
        }
        
        $email = $_SESSION['auth-user-login-email'];

        
        if(count($errors) == 0){
            $date = date("d, M Y h:i:s A");
            $sql = "UPDATE users_db set username = '$username', fullname = '$fullname', updated_at = '$date' WHERE email = '$email' ";
            $res = mysqli_query($con, $sql);
            if($res){
                $_SESSION['auth-user-login'] = $username;
                $success = "<p class='success'>User Data Successfully Updated!</p>";
            }else{
                array_push($errors, "Something Went Wrong!");
            }
        }
    }

    //Update Password
    if(isset($_POST['update-pass'])){
        $old = htmlspecialchars(mysqli_real_escape_string($con, $_POST['oldpass']));
        $pass = htmlspecialchars(mysqli_real_escape_string($con, $_POST['password1']));
        $pass2 = htmlspecialchars(mysqli_real_escape_string($con, $_POST['password2']));

        $old  = strtolower($old );
        $pass = strtolower($pass);
        $pass2 = strtolower($pass2);

        $enc_pass = md5(md5($pass));
        $old = md5(md5($old));

        if( empty($old) || empty($pass2) || empty($pass)){
            array_push($errors, "Any field is empty");
        }
        
        $email = $_SESSION['auth-user-login-email'];

        $sql1 = "SELECT * from users_db WHERE email = '$email' AND password = '$old' LIMIT 1";
        $res1 = mysqli_query($con, $sql1);
        if(mysqli_num_rows($res1) != 1){
            array_push($errors, "Old Password is wrong!");
        }

        if($pass != $pass2){array_push($errors, "Both Password Does Not Match");}

        if(strlen($pass) < 8){ array_push($errors, "Password must be 8 letters long"); }


        if(count($errors) == 0){
            $date = date("d, M Y h:i:s A");
            $sql = "UPDATE users_db set password = '$enc_pass', updated_at = '$date' WHERE email = '$email' ";
            $res = mysqli_query($con, $sql);
            if($res){
                $success = "<p class='success'>Password Successfully Updated!</p>";
            }else{
                array_push($errors, "Something Went Wrong!");
            }
        }
    }

    //Add Car New Car to Database
    if(isset($_POST['addcar'])){
        $name = htmlspecialchars(mysqli_real_escape_string($con, $_POST['name']));
        $price = htmlspecialchars(mysqli_real_escape_string($con, $_POST['price']));
        $model = htmlspecialchars(mysqli_real_escape_string($con, $_POST['model']));
        $brand = htmlspecialchars(mysqli_real_escape_string($con, $_POST['brand']));
        $type = htmlspecialchars(mysqli_real_escape_string($con, $_POST['type']));
        $stock = htmlspecialchars(mysqli_real_escape_string($con, $_POST['stock']));
        $status = htmlspecialchars(mysqli_real_escape_string($con, $_POST['status']));
        $details = htmlspecialchars(mysqli_real_escape_string($con, $_POST['details']));
        $color = htmlspecialchars(mysqli_real_escape_string($con, $_POST['color']));
        $img =  $_FILES['carimg']['name'];

        if( empty($name) || empty($price) || empty($model) || empty($brand) || empty($color) || empty($type) || empty($stock) || empty($details) || empty($img)|| empty($status)){
            array_push($errors, "Any field is empty");
        }

        $file1 = rand(10,100000)."-".$_FILES['carimg']['name'];
        $file_loc1 = $_FILES['carimg']['tmp_name'];
        $folder1="./img/cars/";
        $new_file_name1 = strtolower($file1);
        $final_file1=str_replace(' ','-',$new_file_name1);

        $size = $_FILES['carimg']['size'];
        $f_size = $size / 1024;
        if($f_size >= 2024){ array_push($errors, "Image Must be Less then 2Mb"); }

        $allowed = array('jpeg', 'png', 'jpg');
        $filename = $img;
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed)) { array_push($errors, "Image Must Be Png, Jpeg, Jpg"); }
        
        if(count($errors) == 0){
            if(move_uploaded_file($file_loc1,$folder1.$final_file1)){
                $date = date("d, M Y h:i:s A");
                $sql = "INSERT INTO cars_db (car_name, car_img, car_model, car_price, car_brand, car_type, car_stock, car_status, car_details, car_color, created_at)
                 VALUES ('$name', '$final_file1','$model','$price', '$brand', '$type','$stock', '$status', '$details', '$color', '$date')";
                $res = mysqli_query($con, $sql);
                if($res){
                    $success = "<p class='success'>Car Successfully Added <i class='fas fa-check'></i></p>";
                }else{
                    array_push($errors, "Something Went Wrong!");
                }
            }else{
                array_push($errors, "There is a Problem with Image");
            }
        }
    }


    //Update Car Database
    if(isset($_POST['updatecar'])){
        $id = htmlspecialchars(mysqli_real_escape_string($con, $_POST['id']));
        $name = htmlspecialchars(mysqli_real_escape_string($con, $_POST['name']));
        $price = htmlspecialchars(mysqli_real_escape_string($con, $_POST['price']));
        $model = htmlspecialchars(mysqli_real_escape_string($con, $_POST['model']));
        $brand = htmlspecialchars(mysqli_real_escape_string($con, $_POST['brand']));
        $type = htmlspecialchars(mysqli_real_escape_string($con, $_POST['type']));
        $stock = htmlspecialchars(mysqli_real_escape_string($con, $_POST['stock']));
        $status = htmlspecialchars(mysqli_real_escape_string($con, $_POST['status']));
        $details = htmlspecialchars(mysqli_real_escape_string($con, $_POST['details']));
        $color = htmlspecialchars(mysqli_real_escape_string($con, $_POST['color']));

        if( empty($id) || empty($name) || empty($price) || empty($model) || empty($brand) || empty($color) || empty($type) || empty($stock) || empty($details) || empty($status)){
            array_push($errors, "Any field is empty");
        }


        if(!empty($_FILES['carimg']['name'])){
            $img = $_FILES['carimg']['name'];
            $file1 = rand(10,100000)."-".$_FILES['carimg']['name'];
            $file_loc1 = $_FILES['carimg']['tmp_name'];
            $folder1="./img/cars/";
            $new_file_name1 = strtolower($file1);
            $final_file1=str_replace(' ','-',$new_file_name1);

            $size = $_FILES['carimg']['size'];
            $f_size = $size / 1024;
            if($f_size >= 2024){ array_push($errors, "Image Must be Less then 2Mb"); }

            $allowed = array('jpeg', 'png', 'jpg');
            $filename = $img;
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!in_array($ext, $allowed)) { array_push($errors, "Image Must Be Png, Jpeg, Jpg"); }
        }
        
        
        if(count($errors) == 0){
            if(!empty($_FILES['carimg']['name'])){
                if(move_uploaded_file($file_loc1,$folder1.$final_file1)){
                    $date = date("d, M Y h:i:s A");
                    $sql = "UPDATE cars_db SET car_name = '$name', car_img = '$final_file1', 
                                    car_model = '$model', car_price = '$price', 
                                    car_brand = '$brand', car_type = '$type', 
                                    car_stock = '$stock', car_status = '$status',
                                    car_color = '$color',
                                    car_details = '$details', updated_at = '$date' WHERE id = '$id'";
                    $res = mysqli_query($con, $sql);
                    if($res){
                        $success = "<p class='success'>Car Successfully Added <i class='fas fa-check'></i></p>";
                    }else{
                        array_push($errors, "Something Went Wrong!");
                    }
                }else{
                    array_push($errors, "There is a Problem with Image");
                }
            }else{
                $date = date("d, M Y h:i:s A");
                $sql = "UPDATE cars_db SET car_name = '$name',
                                car_model = '$model', car_price = '$price', 
                                car_brand = '$brand', car_type = '$type', 
                                car_stock = '$stock', car_status = '$status',
                                car_color = '$color', 
                                car_details = '$details', updated_at = '$date' WHERE id = '$id'";
                $res = mysqli_query($con, $sql);
                if($res){
                    $success = "<p class='success'>Car Successfully Added <i class='fas fa-check'></i></p>";
                }else{
                    array_push($errors, "Something Went Wrong!");
                }
            }
        }
    }


    //Admin Login
    if(isset($_POST['admin-login'])){
        $email = htmlspecialchars(mysqli_real_escape_string($con, $_POST['email']));
        $pass = htmlspecialchars(mysqli_real_escape_string($con, $_POST['password']));

        $pass = strtolower($pass);
        $email = strtolower($email);

        $enc_pass = md5(md5($pass));

        if(empty($email) || empty($pass)){array_push($errors, "Fields are Empty");}

        if(strpos($email, '@') == false){ array_push($errors, "Email Format isn't correct"); }

        if(count($errors) == 0){
            $sql = "SELECT * from admin_db WHERE email = '$email' AND password = '$enc_pass' LIMIT 1";
            $res = mysqli_query($con, $sql);
            if(mysqli_num_rows($res) == 1){
               $row = mysqli_fetch_assoc($res);
               $_SESSION['auth-admin-login-email'] = $row['email'];
               header('location: admin.php');
            }else{
                array_push($errors, "Invalid Login Details!");
            }
        }
    }

    //Delet Contact
    if(isset($_GET['delete-cont']) && isset($_SESSION['auth-admin-login-email'])){
        $id = $_GET['delete-cont'];
        $sql = "DELETE from contact_db WHERE id = '$id'";
        $res = mysqli_query($con, $sql);
        if($res){
            header('location: admin.php');
        }else{
            header('location: admin.php');
        }
    }

    //Placing Order
    if(isset($_POST['order'])){
        $id = htmlspecialchars(mysqli_real_escape_string($con, $_POST['id']));
        $name = htmlspecialchars(mysqli_real_escape_string($con, $_POST['name']));
        $fname = htmlspecialchars(mysqli_real_escape_string($con, $_POST['fname']));
        $dob = htmlspecialchars(mysqli_real_escape_string($con, $_POST['dob']));
        $number = htmlspecialchars(mysqli_real_escape_string($con, $_POST['number']));
        $cnic = htmlspecialchars(mysqli_real_escape_string($con, $_POST['cnic']));
        $expire = htmlspecialchars(mysqli_real_escape_string($con, $_POST['expire']));
        $gender = htmlspecialchars(mysqli_real_escape_string($con, $_POST['gender']));
        $address = htmlspecialchars(mysqli_real_escape_string($con, $_POST['address']));
        $message = htmlspecialchars(mysqli_real_escape_string($con, $_POST['message']));
        $price = htmlspecialchars(mysqli_real_escape_string($con, $_POST['price']));
        $img =  $_FILES['cnic_img']['name'];

        if( empty($id) || empty($address) || empty($name) || empty($fname) || empty($dob) || empty($number) || empty($cnic) || empty($expire) || empty($gender) || empty($price)){
            array_push($errors, "Any field is empty");
        }

        if(strlen($cnic) != 13){
            array_push($errors, "CNIC Number is Incorrect");
        }

        if(strlen($number) != 11){
            array_push($errors, "Phone Number is Incorrect");
        }

        if(!is_numeric($number) || !is_numeric($price) || !is_numeric($id) || !is_numeric($cnic)){
            array_push($errors, "Don't Try to Change Types");
        }

        $file1 = rand(10,100000)."-".$_FILES['cnic_img']['name'];
        $file_loc1 = $_FILES['cnic_img']['tmp_name'];
        $folder1="./img/documents/";
        $new_file_name1 = strtolower($file1);
        $final_file1=str_replace(' ','-',$new_file_name1);

        $size = $_FILES['cnic_img']['size'];
        $f_size = $size / 1024;
        if($f_size >= 2024){ array_push($errors, "Image Must be Less then 2Mb"); }

        $allowed = array('jpeg', 'png', 'jpg');
        $filename = $img;
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed)) { array_push($errors, "Image Must Be Png, Jpeg, Jpg"); }
        
        if(count($errors) == 0){
            if(move_uploaded_file($file_loc1,$folder1.$final_file1)){
                $order_number = '33'.rand(10,10000000);
                $email = $_SESSION['auth-user-login-email'];
                $date = date("d, M Y h:i:s A");
                $sql = "INSERT INTO orders_db (order_id, email, fullname, cnic_img, fathername, phone, address, dateofbirth, cnic_number, car_id, expire, message, price, created_at)
                 VALUES ('$order_number', '$email', '$name', '$final_file1','$fname', '$number', '$address', '$dob', '$cnic', '$id','$expire', '$message', '$price', '$date')";
                $res = mysqli_query($con, $sql);
                if($res){
                    $success = "<p class='success'><i class='fas fa-check'></i> Application Submitted! Check Status <a href='profile.php'>Here</a></p>";
                    unset($_SESSION['order']);
                }else{
                    array_push($errors, "Something Went Wrong!");
                }
            }else{
                array_push($errors, "There is a Problem with Image");
            }
        }
    }


    //Change Application Status to Approve-Reject-Pending
    if(isset($_POST['update-app']) && isset($_SESSION['auth-admin-login-email'])){
        $status = $_POST['update-app'];
        $id = htmlspecialchars(mysqli_real_escape_string($con, $_POST['id']));
        $carid = htmlspecialchars(mysqli_real_escape_string($con, $_POST['car_id']));
        
        if(empty($status) || empty($id) || empty($carid)){
            array_push($errors, "Any field is empty");
        }

        if(count($errors) == 0){
            $sql = "UPDATE orders_db set status = '$status' WHERE order_id = '$id'";
            $sql1 = "SELECT * from cars_db WHERE id = '$carid'";
            $res1 = mysqli_query($con, $sql1);
            while($row = mysqli_fetch_assoc($res1)){
                $cars = $row['car_sold'];
                $stock = $row['car_stock'];
            }
            $res = mysqli_query($con, $sql);
            if($res){
                if($status == 'completed'){
                    $total = $cars + 1;
                    $t_stock = $stock - 1;
                    $sql2 = "UPDATE cars_db set car_stock = '$t_stock', car_sold = '$total' WHERE id = '$carid'";
                    $res2 = mysqli_query($con, $sql2);
                }
                header('location: admin.php');
            }else{
                array_push($errors, "Somthing Went Wrong!");
            }
        }
    }
?>