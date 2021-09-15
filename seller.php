<?php   include "./header.php";    ?>

<div class="seller">

<div class="card" onclick="optionToggel('.productAddForm')">
    <h2>ADD NEW LISTINGS</h2>
    <i class="fas fa-plus"></i>
</div>
<div class="card" onclick="optionToggel('.productListing')">
    <h2>LISTINGS</h2>
    <i class="fas fa-stream"></i>
</div>
<div class="card">
    <h2>order</h2>
    <i class="fas fa-sort"></i>
</div>
<div class="card">
    <h2>reports</h2>
    <i class="far fa-file-alt"></i>
</div>

</div>

<!-- Add Listing -->

  <form action="" class="productAddForm hide" method="POST">
            <label for="">Origin / Brand</label>
            <input type="text" name="productOrigin" id="" placeholder="Product Brand" required>
            <label for="pwd">Title</label>
            <input type="text" name="productTitle" id="pwd" placeholder="Product Title" required>
            <label for="img">Image</label>
            <input type="file" name="productImage" id="" required>
            <label for="pwd">Discription</label>
            <TEXTarea placeholder="Write product discription here" name="productDiscription"></TEXTarea required>
            <label for="">Volume / Size</label>
            <input type="text" placeholder="Volume / Size" name="productVolume" required>
            <label for="">Price</label>
            <input type="text" name="productPrice" placeholder="Price per unit" required>
            <button type="submit" class="submit" name="submit">Submit for Approval</button>

        </form>

<!-- Fetch Listing -->
    <div class="container">

        <main class="product productListing hide">
            
            <?php showSellerListing(); ?>

        </main>
    </div>



<?php   include "./footer.php";   
addNewListing();

?>