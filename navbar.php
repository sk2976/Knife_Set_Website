<?php session_start()?>
<div class="navbar">
    <a href="index.php">Home</a>
    <a href="productDetails.php">Knife Details</a>
    <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']): ?>
        <a href="shipping.php">Shipping</a>
        <a href="productPage.php">Product Page</a>
        <a href="create.php">Add Knives</a>
        <a href="logout.php">Log Out</a>
    <?php else: ?>
        <a href="login.php">Log In</a>
    <?php endif; ?>
</div>
