<?php 
session_start();
if (!isset($login_message)) {
$login_message = 'You must login to view this page.';
}
?>
<!DOCTYPE html>
<html>
 <head>
   <title>Knife Shop Log In</title>
 </head>
 <body>
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
   <h1>Knife Shop Log In</h1>
 <main>
   <h1>Login</h1>
   <form action="authenticate.php" method="post">
     <label>Email:</label>
     <input type="text" name="email" value="">
     <br>
     <label>Password:</label>
     <input type="password" name="password" value="">
     <br>
     <input type="submit" value="Login">
   </form>
   <p><?php echo $login_message; ?></p>
 </main>
 </body>
</html>
<style>
    body{
        background-color: rgb(35,35,35);
        color:white;
        margin:0;
        font-family: Arial, Helvetica, sans-serif;
    }
    h1{
        font-size: 3em;
        margin-top: 60px;
    }
    .navbar {
    overflow: hidden;
    background-color: black;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    }

    .navbar a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    }

    .navbar a:hover {
    background-color: #ddd;
    color: black;
    }
</style>
<?php if (!empty($_SESSION['logout_message'])): ?>
    <p><?= htmlspecialchars($_SESSION['logout_message']) ?></p>
    <?php unset($_SESSION['logout_message']); ?>
<?php endif; ?>
