<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            body{
                background-color: rgb(35,35,35);
                margin:0;
                font-family: Arial, Helvetica, sans-serif;
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
            h1{
                margin-top:70px;
                color:white;
                font-size: 4em;
                text-align: center;
            }
            #dropdown{
                font-size: 2em;
            }
            #frame label{
                color:white;
                font-size:2em;
            }
            .right-content{
                float:right;
                margin-right: 200px;
            }
            .left-content{
                float:left;
                margin-left: 200px;
            }
            button{
                background-color:indianred;
                color:white;
                font-size:2em;
                border:2px solid black;
                border-radius: 15px;
            }
            button:hover{
                background-color: rgb(210, 60, 60);
            }
            input{
                font-size: 2em;
            }
            textarea{
                resize: none;
            }
        </style>
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

        <h1>Add Knives</h1>
      
        <div id="frame">
    <form action="add.php" method="POST">
        <div class="left-content">
        <label>Knife Category</label>
        <br>
        <select id="dropdown" name="category">
            <option value="bread">Bread Knives</option>
            <option value="butter">Butter Knives</option>
            <option value="chef">Chef's Knives</option>
            <option value="paring">Paring Knives</option>
            <option value="steak">Steak Knives</option>
        </select>
        <?php
            if(!empty($errorMessage)){
                echo "<p style = 'color:red; font-size:2em; ;'>";
                echo $errorMessage;
                echo "<p>";
            }
            if(!empty($successMessage)){
                echo "<p style = 'color:green; font-size:2em; ;'>";
                echo $successMessage;
                echo "<p>";
            }
        ?>
        </div>
        <div class="right-content">
        <label>Knife Code</label><br>
        <input name="code"><br>
        <label>Knife Name</label><br>
        <input name="name"><br>
        <label>Knife Description</label><br>
        <textarea rows="4" cols="50" maxlength="200" type="text" name="description"></textarea><br>
        <label>Price</label><br>
        <input name="price"><br><br>
        <button type="submit">Submit</button>
        </div>
    </form>
        </div>
    </body>
</html>
