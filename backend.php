<?php

session_start();
ob_start();

$hostname = "localhost";
$username = "root";
$password = "";
$database = "wine divine";

$conn= mysqli_connect($hostname, $username, $password, $database);

    if (!$conn) {
        die("Connection un-successful with " . $database); 
    }
    
function queryErrorCheck($query, $msg){
    if(!$query){
        echo "</br> Error: $msg ". "</br>" .mysqli_error($GLOBALS["conn"]);
    }
}


function userId(){
    return $userId = $_SESSION['userId'];
}
function userName(){
    return $userId = $_SESSION['userName'];
}

@include "./backend_sub/_product.php";
@include "./backend_sub/_shortlist.php";
@include "./backend_sub/_seller.php";
@include "./backend_sub/_order.php";
@include "./backend_sub/_sign.php";
@include "./backend_sub/_profile.php";





if (isset($_GET) && !$_SESSION) {
    echo "<p class='ribbin'>To Get Access To Your Orders, Cart, Wishlist and Recommendations, <a href='./sign.php' style='color: blue;' >Sign In Now</a></p>";
} else {
    wishlist();
    orderDeatils();
}

// notAllowedIfSessionStart();


signUp();
signIn();
logout();
