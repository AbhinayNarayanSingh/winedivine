<?php

function fullAddress($row){
    echo $row['address'].", ".$row['city'].", ".$row['state'].", ".$row['country']." ".$row['postalCode'];
}

function allSavedAddress(){
    $userId = userId();
    $query = "SELECT * FROM `useraddressbook` WHERE `userId` = '$userId'";
    $query = mysqli_query($GLOBALS['conn'], $query);

    while ($row = mysqli_fetch_assoc($query)) {
?>
    <div class="savedAddress">
        <h2><?php echo $row['fullName'] ?></h2>
        <p>Address: <?php fullAddress($row) ;?></p>
        <p>Mob: <?php echo $row['mob'] ?></p>
        <p>email: <?php echo $row['email'] ?></p>
    </div>

<?php
    }
}