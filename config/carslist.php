<?php 
    $res = mysqli_query($con, $sql);
    if(mysqli_num_rows($res) > 0){
        while($row = mysqli_fetch_assoc($res)){
            $image = './img/cars/'.$row['car_img'];
            $detailsArray = explode("--", $row['car_details']);
            $id = $row['id'];
    
?>
<div class="box" data-aos="fade-up" data-aos-duration="1000">
    <div class="overlay"></div>
    <div class="img">
        <h2><?php echo $row['car_stock']; ?> In Stock</h2>
        <img src="<?php echo $image; ?>">
    </div>
    <div class="details">
        <h1><span><?php echo $row['car_model']; ?></span> <?php echo $row['car_name']; ?>  - <span><?php echo $row['car_status']; ?></span></h1>
        <h2>PKR: <?php echo number_format($row['car_price']); ?></h2>
    </div>
    <button type="button" class="collapsible">FEATURES <i class="fas fa-stop-circle"></i></button>
    <div class="content">
        <ul>
            <?php
                foreach($detailsArray as $detail){
                    echo "<li>". $detail ."</li>";
                }
            ?>
        </ul>
    </div>
        <?php 
            if($row['car_stock'] == 0){
                echo "<h1>Out Of Stock</h1>";
            }else{
                echo "<a class='ordernow' href='order.php?order=$id'>OrderNow</a>";
            }
        ?>
</div>

<?php } }else{ ?>
    <div class="box" data-aos="fade-up" data-aos-duration="1000">
        <div class="overlay"></div>
        <div class="img">
            <h2>No Car</h2>
            <img src="./img/palaceholderimg.jpg">
        </div>
        <div class="details">
            <h1><span>No Car Record</span></h1>
            <h2>PKR: No Car Record</h2>
        </div>
        <button type="button" class="collapsible">FEATURES <i class="fas fa-stop-circle"></i></button>
        <div class="content">
            <ul>
                <li>No Record Found</li>
            </ul>
        </div>
    </div>
<?php } ?>