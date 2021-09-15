<?php

// Seller Page

function fetchProduct(){

    $query = "SELECT * FROM product";
    $query = mysqli_query($GLOBALS["conn"], $query);
    
    queryErrorCheck($query, "fetchProduct()");

    while ($row = mysqli_fetch_assoc($query)) {
        ?>
 <div class="card">
        <a href="./product.php?pd=<?php echo $row['productId']; ?>">
         <div class="img"><img src="./img/<?php echo $row['productImage']; ?>" alt=""></div>
         <div class="details">
             <h2><?php echo $row['productOrigin']; ?></h2>
            <h3><?php echo $row['productTitle']; ?></h3>
                </div>
            </a>
            <a href="./backend.php?cart=<?php echo $row['productId']; ?>">
            <div class="addtocart">
                <i class="fas fa-cart-plus"></i>
            </div>
        </a>
        <a href="./backend.php?wishlist=<?php echo $row['productId']; ?>">
                <div class="addtowishlist">
                    <i class="fas fa-heart"></i>
                </div>
            </a>
            </div>
        <?php
    }

};











// Individual Product Page


function individualProductPage(){
    $productId = $_GET["pd"];
    $query = "SELECT * FROM product WHERE `productId` = '$productId'";
    $query = mysqli_query($GLOBALS["conn"], $query);
    
    while ($row = mysqli_fetch_assoc($query)) {
        ?>

    <div class="productImage">
     <img src="./img/<?php echo $row['productImage']; ?>" alt="">
    </div>

    <div class="productDetails">
        <div class="top">
            <h2><?php echo $row['productOrigin']; ?></h2>
            <h3><?php echo $row['productTitle']; ?></h3>
            <div class="moreDetails">
                <h2>Volume: <?php echo $row['productVolume']; ?></h2>
                <h2>$<?php echo $row['productPrice']; ?></h2>
            </div>
        </div>
        <div class="bottom">
            <p><?php echo $row['productDiscription']; ?></p>
        </div>
    </div>

<?php
    }
}