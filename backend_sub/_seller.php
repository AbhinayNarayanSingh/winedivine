<?php


// add listing

function addNewListing(){
    if (isset($_POST["submit"])){

        
     $productTitle = mysqli_escape_string($GLOBALS["conn"], $_POST["productTitle"]);
   $productDiscription = mysqli_escape_string($GLOBALS['conn'], $_POST['productDiscription']);
   $productVolume = mysqli_escape_string($GLOBALS['conn'], $_POST['productVolume']);
   $productOrigin = mysqli_escape_string($GLOBALS['conn'], $_POST['productOrigin']);
   $productPrice = mysqli_escape_string($GLOBALS['conn'], $_POST['productPrice']);
   $productImage = mysqli_escape_string($GLOBALS['conn'], $_POST['productImage']);
//    $productSellerId = mysqli_escape_string($GLOBALS['conn'], $_POST['productSellerId']);
   $productSellerId = "abhinay";
   
   $query = "INSERT INTO `product`( `productTitle`, `productDiscription`, `productVolume`, `productOrigin`, `productPrice`, `productImage`, `productSellerId`) VALUES ('$productTitle', '$productDiscription', '$productVolume', '$productOrigin', '$productPrice', '$productImage', '$productSellerId')";
   $query = mysqli_query($GLOBALS["conn"], $query);
   
   queryErrorCheck($query, "addNewListing()");
}
}

// Show Listing

function showSellerListing(){
    $query = "SELECT * FROM product WHERE `productSellerId` = 'abhinay'";
    $query = mysqli_query($GLOBALS["conn"], $query);
    
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
</div>
<?php
    }
}