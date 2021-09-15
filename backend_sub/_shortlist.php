<?php



function wishlist(){
    if(isset($_GET["wishlist"])){
        shortlistType("wishlist");
    } else if (isset($_GET["cart"])) {
        shortlistType("cart");
    } else if (isset($_GET["completeremovewishlist"])) {
        removeShortlistWithoutCondition("wishlist",$_GET['completeremovewishlist']);
    } else if (isset($_GET["completeremovecart"])) {
        removeShortlistWithoutCondition("cart",$_GET['completeremovecart']);
    } else if (isset($_GET["removecart"])) {
        removeShortlist("cart",$_GET["removecart"]);
    } else if (isset($_GET["removewishlist"])) {
        removeShortlist("wishlist",$_GET["removewishlist"]);
    }  
}

// Remove from Cart & Wishlist

function redirect($tableName){
    if($tableName == "cart"){header('location: ./cart.php?ct');}
    else {
        header('location: ./cart.php?wl');
    }
}

    function removeShortlist($key1,$key2){

        $tableName = "$key1";
        $userId = userId();
        $productId = "$key2";
        $productQuantity = fetchQuantity($tableName,$userId,$productId);
                
        if ($productQuantity == 1 ){

           $query ="DELETE FROM `$tableName` WHERE `productId` ='$productId' AND `userId` = '$userId'";
            
            $query = mysqli_query($GLOBALS['conn'],$query);

            // header('location: ./cart.php?ct');
            redirect($tableName);

          
        } else if ($productQuantity > 0 ){

            $productQuantity = fetchQuantity($tableName,$userId,$productId) - 1;

            $query ="UPDATE `$tableName` SET `productQuantity`='$productQuantity' WHERE `userId` = '$userId' and `productId` = '$productId'";
            $query = mysqli_query($GLOBALS["conn"], $query);

            // header('location: ./cart.php?ct');
            redirect($tableName);
        }
    }

 function removeShortlistWithoutCondition($key1,$key2){
         $tableName = $key1;
        //  $tableName = "cart";
        $userId = userId();
        $productId = $key2;

    $query ="DELETE FROM `$tableName` WHERE `productId` ='$productId' AND `userId` = '$userId'";
            
            $query = mysqli_query($GLOBALS['conn'],$query);

        // if($tableName == "cart"){
        //     header('location: ./cart.php?ct');
        // } else {
        //     header('location: ./cart.php?wl');
        // }
        redirect($tableName);

 }
// Add to Cart & Wishlist

    function fetch($key1,$key2,$key3){
        $query = "SELECT * from `$key1` WHERE `userId` = '$key2' and `productId` = '$key3'";
        $query = mysqli_query($GLOBALS['conn'], $query);
        return mysqli_num_rows($query);
    }
    function fetchQuantity($key1,$key2,$key3){
        $query = "SELECT * from `$key1` WHERE `userId` = '$key2' and `productId` = '$key3'";
        $query = mysqli_query($GLOBALS['conn'], $query);

        $row = mysqli_fetch_assoc($query);
        return $row['productQuantity'];
    }

    function shortlistType($key){
        $tableName = $key;
        $userId = userId();
        $productId = $_GET["$tableName"];

            if (fetch($tableName,$userId,$productId) === 0 ) {
                $query = "INSERT INTO `$tableName`( `userId`, `productId`,`productQuantity`) VALUES ('$userId','$productId',1)";
                $query = mysqli_query($GLOBALS["conn"], $query);
                // header('location: ./cart.php?ct');
                header('location: ./index.php?ct');
            } else {
                $productQuantity = fetchQuantity($tableName,$userId,$productId) +1;
                $query ="UPDATE `$tableName` SET `productQuantity`='$productQuantity' WHERE `userId` = '$userId' and `productId` = '$productId'";
                $query = mysqli_query($GLOBALS["conn"], $query);

                // header('location: ./cart.php?ct');
                // header('location: ./index.php?ct');
                redirect($tableName);
            }
    }

   



// showing cart and swishlist 


function fetchShortlistType(){

    
    if(isset($_GET["wl"])){
        shortlistFetch("wishlist");
        // echo "wishlist";
    } if (isset($_GET["ct"])) {
        shortlistFetch("cart");
        // echo "cart";

    }
    
}

    function  shortlistFetch($key){
    
        $userId =userId();

    $query = "SELECT * FROM `$key` WHERE `userId` = '$userId'";
    $query = mysqli_query($GLOBALS["conn"],$query);

    $num =mysqli_num_rows($query);

    if ($num === 0) {
        ?>
            <div class="phpEchoMsg">
                <h6>Your Divine <?php echo $key; ?> is empty </h6>
            </div>
            <?php
            return true;
    }else {
    
        while ($row = mysqli_fetch_assoc($query)) {
            $productId = $row['productId'];
            fetchShortlistProduct($productId, $key);
        }
        
    }

};


function fetchShortlistProduct($productId,$tableName){
    $userId =userId();

 $query = "SELECT * FROM product WHERE`productId` = '$productId'";
    $query = mysqli_query($GLOBALS["conn"], $query);
    
    while ($row = mysqli_fetch_assoc($query)) {
    $pricePerUnit = $row['productPrice'];
    $productQuantityInCart = fetchQuantity($tableName,$userId,$productId);
    $totalPrice = $pricePerUnit * $productQuantityInCart;


        ?>
    <div class="productCard">
            <div class="cartProductImg">
                <img src="./img/<?php echo $row["productImage"] ?>" alt="">
                </div>
                <div class="cartProductDeatils">
                    <h2><?php echo $row['productOrigin']; ?></h2>
                    <h3><?php echo $row['productTitle']; ?></h3>
                    <div class="moreDetails">
                        <p>Qty: <span><?php  echo $productQuantityInCart ?></span></p>
                        <p>Price: <span>$<?php echo  $totalPrice ?></span></p>
                    </div>
                </div>
                <div class="delBtn hide">
                    <a href="./backend.php?completeremove<?php echo $tableName; ?>=<?php echo $row['productId']; ?>" style="padding-right: 1rem;">
                        <i class="fas fa-ban"></i>
                    </a>
                    <a href="./backend.php?<?php echo $tableName; ?>=<?php echo $row['productId']; ?>" style="padding-right: 1rem;">
                        <i class="fas fa-plus-circle"></i>
                    </a>
                    <a href="./backend.php?remove<?php echo $tableName ?>=<?php echo $row['productId']; ?>">
                        <i class="fas fa-minus-circle "></i>
                    </a>
                </div>
            </div>
    
        <?php
    }
}

// number of item in cart

function numberOfItem(){
    $userId = userId();

    $query = "SELECT * FROM `cart` WHERE `userId` = '$userId'";
    $query = mysqli_query($GLOBALS["conn"],$query);

    echo mysqli_num_rows($query);
}