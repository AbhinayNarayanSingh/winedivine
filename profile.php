<?php include "./header.php"; ?>


<div class="profileContainer">

    <div class="profileImg">
        <h1><?php echo $_SESSION['userName'][0] ?></h1>
    </div>
    <h2><?php echo $_SESSION['userName'] ?></h2>

    <div class="sections">

        <div class="subSection">
            <h3>My Orders</h3>
            <a href="./order.php">View All Orders</a>
        </div>
        
        <div class="subSection">
            <h3>My Wishlist</h3>
            <a href="./cart.php?wl">View Your Wishlist</a>
        </div>
        
        <div class="subSection">
            <h3>My Address</h3>
            <a onclick="optionToggel('.addressContainer')">View All Saved Address</a>
        </div>
    </div>
</div>

<div class="addressContainer hide">

    <?php  allSavedAddress() ?>

</div>

<div class="addNewAddressContainer hide">




</div>