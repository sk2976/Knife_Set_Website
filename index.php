<?php
session_start(); 
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stephen's Knives</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/jpg" href="">
    <script src="script.js"></script>
</head>

<body id="body">
    <header>
    <div class="heading">
        <h1>Kankam's Knives</h1>
    </div>
    <div class="navbar">
        <a href="index.php">Home</a>
        <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']): ?>
            <!-- These links are only shown to logged-in users -->
            <a href="shipping.php">Shipping</a>
            <a href="productPage.php">Product Page</a>
            <a href="create.php">Add Knives</a>
            <a href="logout.php">Log Out</a>
        <?php else: ?>
            <!-- The login link is shown if the user is not logged in -->
            <a href="login.php">Log In</a>
        <?php endif; ?>
    </div>
    </header>
    <div class="content">
        <h1 style="color:white">Our Knives</h1>
    <div class="left-content"><table>
        <tr>
            <td><a href="chef_knife.html"><div class="knife_selector"><img src="images/chef_knife_images/chef_knife.webp" width="300px" alt="Chef's Knife"> <h2>Chef's Knives</h2></div></a></td>
            <td><a href="#"><div class="knife_selector"><img src="images/paring_knife_images/paring_knife.webp" width="300px" alt="Paring Knife"><h2>Paring Knives</h2></div></a></td>
        </tr>
        <tr>
            <td><a href="#"><div class="knife_selector"><img src="images/steak_knife_images/steak_knife_set.jpg" width="300px" alt="Steak Knife"><h2>Steak Knives</h2></div></a></td>
            <td><a href="#"><div class="knife_selector"><img src="images/butter_knife_images/butter_knife.webp" width="300px" alt="Butter Knife"><h2>Butter Knives</h2></div></a></td>
        </tr>
        <tr>
            <td><a href="#"><div class="knife_selector"><img src="images/bread_knife_images/bread_knife.webp" width="300px" alt="Bread Knife"><h2>Bread Knives</h2></div></a></td>
        </tr>
    </table></div>
    
    <div class="right-content">
        <p>Welcome to Kankam Knives! Kankam Knives was created in February 2024 by a New York local. We are dedicated
            to brining you only the best knives in town, guaranteed. Located on 123 River Street in the heart of the 
            city, we are sure you will find just what you're looking for.
        </p>
    </div>
    </div>

    <footer>
        
    </footer>
</body>
</html>
