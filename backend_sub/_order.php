<?php

function fetchPrice($key){
        $query = "SELECT * from `product` WHERE `productId` = '$key'";
        $query = mysqli_query($GLOBALS['conn'], $query);

        $row = mysqli_fetch_assoc($query);
        return $row['productPrice'];
    }



function subtotal(){
    $userId = userId();

    $query = "SELECT * from `cart` where `userId` = '$userId'";
    $query = mysqli_query($GLOBALS['conn'],$query);

    $subTotal = [];
    $noOfRow = mysqli_num_rows($query);

    $orderedProductId =[];
    $orderedProductQuantity =[];

    while ($row = mysqli_fetch_assoc($query)) {
        $productId = $row['productId'];
        $quantity = $row['productQuantity'];
        $price = fetchPrice($productId);
        $subtotalPrice = $quantity * $price;

        array_push($subTotal,$subtotalPrice);
        array_push($orderedProductId,$productId);
        array_push($orderedProductQuantity,$quantity);
    }



function orderloop($orderedProductId,$orderedProductQuantity,$noOfRow){

    for ($i=0; $i <=$noOfRow-1 ; $i++) { 
            $varxyz = "pId($i)=$orderedProductId[$i]&";
            $varxyza = "pQt($i)=$orderedProductQuantity[$i]&";
            print_r($varxyz.$varxyza);
        }   
    }
 
    $taxRate=18;
    $totalBeforeTax = array_sum($subTotal);
    $tax = round( array_sum($subTotal)/105*$taxRate,2);
    $totalAfterTax = round($totalBeforeTax - $tax,2);

    ?><div class="subtotal">
        <h2>total (<?php numberOfItem() ?> items):  $<?php echo $totalBeforeTax; ?> <span> (inclusive of all taxes)</span></h2>
        <div class="subsubtotal">

            <div class="heading">
                <p>subtotal</p>
                <p>shipping & handling</p>
                <p>taxes @ <?php echo $taxRate ?>%</p>
            </div>
            <div class="value">
                <p>$<?php echo $totalAfterTax; ?></p>
                <p>free</p> 
                <p>$<?php echo $tax ?></p>
            </div>
        </div>
            <a href="./backend.php?order=<?php echo $noOfRow; ?>&<?php orderloop($orderedProductId,$orderedProductQuantity,$noOfRow) ?>">ORDER NOW</a>
            <h2>
                <span style="text-transform: none;">The price and availability of items are subject to change. The shopping cart is a temporary place to store a list of your items and reflects each item's most recent price.
                </span>
            </h2>
        </div>
    <?php
}


// order placement

function orderPlacing($productSellerId, $orderProductId, $orderUserId, $orderProductQuantity, $orderPrice,$orderProductTitle, $orderUserName){

    // echo $productSellerId." ". $orderProductId." ".$orderProductTitle." " . $orderUserId." ". $orderUserName." " . $orderProductQuantity." ". $orderPrice."  orderPlacingFunction() " ."</br>";

    $query = "INSERT INTO `orders` ( `productSellerId`, `orderProductId`, `orderUserId`, `orderUserName`, `orderProductQuantity`, `orderPrice`, `orderProductTitle`) VALUES ('$productSellerId', '$orderProductId', '$orderUserId', '$orderUserName', '$orderProductQuantity', '$orderPrice', '$orderProductTitle')";
    $query = mysqli_query($GLOBALS['conn'], $query);

    queryErrorCheck($query, "orderPlacing");
}

function shortlistRemoval($orderUserId, $orderProductId){
    $table = ["cart", "wishlist"];
    
    for ($i=0; $i <=1 ; $i++) { 
        $query = "DELETE FROM $table[$i] WHERE `userId` = '$orderUserId' and `productId` = $orderProductId";
        $query = mysqli_query($GLOBALS['conn'], $query);
    }
}

function orderDeatils(){

    $order= [];
    $orderQuantity= [];

    if(isset($_GET['order'])){
        $noOfOrderProduct = $_GET['order'];

        for ($i=0; $i <=$noOfOrderProduct-1 ; $i++) { 
            array_push($order,$_GET["pId($i)"]);
            array_push($orderQuantity,$_GET["pQt($i)"]);
        };

        function fetchOrder($productId,$orderQuantity){
            $query = "SELECT * FROM product WHERE`productId` = '$productId'";
            $query = mysqli_query($GLOBALS["conn"], $query);
            
            $row = mysqli_fetch_assoc($query);
            
            $productSellerId = $row['productSellerId'];
            $orderProductTitle = $row['productTitle'];
            $orderUserId = userId();
            $orderUserName = userName();
            $orderProductId = $productId;
            $orderProductQuantity = $orderQuantity;
            $orderPrice = $row['productPrice'];

            // echo $productSellerId." ". $orderProductId." ".$orderProductTitle." " . $orderUserId." ". $orderUserName." " . $orderProductQuantity." ". $orderPrice."  orderDetailFunction() " . "</br>";

            orderPlacing($productSellerId, $orderProductId, $orderUserId, $orderProductQuantity, $orderPrice,$orderProductTitle, $orderUserName);

            shortlistRemoval($orderUserId, $orderProductId);

        };

        for ($i=0; $i <=count($order)-1 ; $i++) { 
            fetchOrder($order["$i"],$orderQuantity["$i"]);
        };
        header("location: ./index.php");
    };
}


// fetch order --- customer point of view

// function fetchOrder(){
    //     $userId = userId();
    // $query = "SELECT * FROM `order` WHERE `userId` = '$userId'";
    // $query = mysqli_query($GLOBALS['conn'], $query);
// }