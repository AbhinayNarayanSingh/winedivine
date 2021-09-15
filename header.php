<?php
    include "./backend.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wine Divine - eCommerce</title>
    <link rel="stylesheet" href="./CSS/main.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="./JS/app.js"></script>

</head>

<body>
    <div class="navContainer">
        <nav>
            <a href="./index.php">Wine Divine</a>
            <p onclick="menu()">Navigation</p>
        </nav>
    </div>
    <div class="nav hide">

    <?php if(isset($_SESSION['signIn'])){
        ?>
        <a href="./cart.php?ct">Cart(<?php  numberOfItem()  ?>)</a>
        <a href="./cart.php?wl">Wishlist</a>
        <a href="./profile.php">Profile</a>
        <a href="./order.php">My Orders</a>
        <a href="./backend.php?logout">Logout</a>
        
        <?php
    } else {
        ?>
        <a href="./sign.php">Sign In / Sign Up</a>
        <?php
    }
    ?>
        <a href="">Support</a>

    </div>


