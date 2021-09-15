<?php
include "./header.php";
?>

<div class="cartContainer">

    <div class="cartList">
        
        <?php  fetchShortlistType(); 
        
        ?>
        
    </div>
    <?php if(isset($_GET['ct'])){
        $userId = userId();
        
        $query = "SELECT * FROM `cart` WHERE `userId` = '$userId'";
        $query = mysqli_query($GLOBALS["conn"],$query);
        
        if(!mysqli_num_rows($query)==0){
            
            subtotal(); 
        }
    }
    
    ?>

</div>
    <?php include "./footer.php"; ?>