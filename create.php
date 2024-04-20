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
            .error-message {
                color: red;
                font-size: 1em;
            }

        </style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        document.querySelectorAll('.error-message').forEach(e => e.textContent = '');
    
        const code = form.elements['code'].value.trim();
        const name = form.elements['name'].value.trim();
        const description = form.elements['description'].value.trim();
        const price = form.elements['price'].value;
        let hasError = false;

        if (code === '') {
            document.getElementById('code-error').textContent = 'Knife code cannot be blank.';
            hasError = true;
        } else if (code.length < 4 || code.length > 10) {
            document.getElementById('code-error').textContent = 'Knife code must be between 4 and 10 characters long.';
            hasError = true;
        }

        if (name === '') {
            document.getElementById('name-error').textContent = 'Knife name cannot be blank.';
            hasError = true;
        } else if (name.length < 10 || name.length > 100) {
            document.getElementById('name-error').textContent = 'Knife name must be between 10 and 100 characters long.';
            hasError = true;
        }

        if (description === '') {
            document.getElementById('description-error').textContent = 'Knife description cannot be blank.';
            hasError = true;
        } else if (description.length < 10 || description.length > 255) {
            document.getElementById('description-error').textContent = 'Knife description must be between 10 and 255 characters long.';
            hasError = true;
        }

        if (price === '' || isNaN(price) || parseFloat(price) <= 0) {
            document.getElementById('price-error').textContent = 'Price must be greater than zero.';
            hasError = true;
        } else if (parseFloat(price) > 100000) {
            document.getElementById('price-error').textContent = 'Price must not exceed $100,000.';
            hasError = true;
        }

        // Only prevent form submission if there are validation errors
        if (hasError) {
            event.preventDefault(); 
        }
    });
});
</script>



    </head>
    <body>
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

        <h1>Add Knives</h1>
      
        <div id="frame">
    <form action="add.php" method="POST" id="form">
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
        <span class="error-message" id="code-error"></span><br>

        <label>Knife Name</label><br>
        <input name="name"><br>
        <span class="error-message" id="name-error"></span><br>

        <label>Knife Description</label><br>
        <textarea rows="4" cols="50" maxlength="200" name="description"></textarea><br>
        <span class="error-message" id="description-error"></span><br>

        <label>Price</label><br>
        <input name="price"><br>
        <span class="error-message" id="price-error"></span><br><br>

        <button type="submit">Submit</button>
        <button type="button" onclick="clearForm()">Clear</button>
    </div>
    </form>
        </div>
    </body>
</html>
