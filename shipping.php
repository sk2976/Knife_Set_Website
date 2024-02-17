<?php
    //Checks if variables are set and if not, they are initialized as blank
    if(!isset($fullName)){$fullName = '';}
    if(!isset($streetAddress)){$streetAddress = '';}
    if(!isset($city)){$city = '';}
    if(!isset($state)){$state = '';}
    if(!isset($zipCode)){$zipCode = '';}
    if(!isset($shipDate)){$shipDate = '';}
    if(!isset($orderNumber)){$orderNumber = '';}
    if(!isset($dimension1)){$dimension1 = '';}
    if(!isset($dimension2)){$dimension2 = '';}
    if(!isset($dimension3)){$dimension3 = '';}
    if(!isset($valueOfPackages)){$valueOfPackages = '';}
?>

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
<html lang="en">
<head>
</head>
<body>
<div class="navbar">
        <a href="index.html">Home</a>
        <a href="shipping.php">Shipping</a>
    </div>
    <h1>Shipping Details</h1>
    <form method="post" action="report.php">
        <?php
            if(!empty($error_message)){
                echo "<p>";
                echo $error_message;
                echo "<p>";
            }
        ?>
        <!--
            Shipping form
        -->
        <h2>To:</h2>
        <label>Full Name</label>
        <input name="fullName" value="<?php echo htmlspecialchars($fullName)?>"><br>
        <label>Street Address</label>
        <input name="streetAddress" value="<?php echo htmlspecialchars($streetAddress)?>"><br>
        <label>City</label>
        <input name="city" value="<?php echo htmlspecialchars($city)?>"><br>
        <label>State</label>
        <input name="state" value="<?php echo htmlspecialchars($state)?>"><br>
        <label>Zip Code</label>
        <input name="zipCode" value="<?php echo htmlspecialchars($zipCode)?>"><br>

        <h2>Package Details:</h2>
        
        <label>Ship Date</label>
        <input type="date" name="shipDate" value="<?php echo htmlspecialchars($shipDate)?>"><br>
        <label>Order Number</label>
        <input name="orderNumber" value="<?php echo htmlspecialchars($orderNumber)?>"><br>
        <label>Dimensions</label>
        <input name="dimension1" type="number" value="<?php echo htmlspecialchars($dimension1)?>">
        <input name="dimension2" type="number" value="<?php echo htmlspecialchars($dimension2)?>">
        <input name="dimensions3" type="number" value="<?php echo htmlspecialchars($dimension3)?>"><br>
        <label>Value of Package</label>
        <input name="valueOfPackages" value="<?php echo htmlspecialchars($valueOfPackages)?>"><br>
        <input type="submit">
    </form>
</body>
</html>
