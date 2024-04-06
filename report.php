<?php
//Retrieve "To" data
    $fullName = filter_input(INPUT_POST,'fullName');
    $streetAddress = filter_input(INPUT_POST,'streetAddress');
    $city = filter_input(INPUT_POST,'city');
    $state = filter_input(INPUT_POST,'state');
    $zipCode = filter_input(INPUT_POST,'zipCode');
//Retrieve "Package Details" data
    $shipDate = filter_input(INPUT_POST,'shipDate');
    $orderNumber = filter_input(INPUT_POST,'orderNumber');
    $dimensions1 = filter_input(INPUT_POST,'dimensions1');
    $dimensions2 = filter_input(INPUT_POST,'dimensions2');
    $dimensions3 = filter_input(INPUT_POST,'dimensions3');
    $valueOfPackages = filter_input(INPUT_POST,'valueOfPackages');

//Validate data
$error_message = '';
$listOfStates = ["Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware",
"Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky",
"Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri",
"Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York",
"North Carolina", "North Dakota", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island",
"South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington",
"West Virginia", "Wisconsin", "Wyoming"];

//Validate "To" data
if($fullName === FALSE){
    $error_message = 'Missing full name.<br>';
} else if (!is_string($fullName)){
    $error_message.= 'Enter a viable name.<br>';
}
if($state === FALSE){
    $error_message.= 'Missing state.<br>';
} else if(!in_array($state,$listOfStates)){
    $error_message.= 'Enter a viable state name.<br>';
}
if($city === FALSE){
    $error_message.= 'Missing city.<br>';
}
if($streetAddress === FALSE){
    $error_message.= 'Missing street address.<br>';
}
if($zipCode === FALSE){
    $error_message.= 'Missing zip code.<br>';
} else if(!is_numeric($zipCode)){
    $error_message.= 'Enter a viable zip code.<br>';
}
if($orderNumber === FALSE){
    $error_message.= 'Missing order number.<br>';
} else if(!is_numeric($orderNumber)){
    $error_message.= 'Enter a valid order number.<br>';
}
if($dimensions1 === FALSE || $dimensions2 === FALSE || $dimensions3 === FALSE){
    $error_message.= 'Missing one or more dimensions.<br>';
}else if(!is_numeric($dimensions1) || !is_numeric($dimensions2) || !is_numeric($dimensions2)){
    $error_message.= 'Enter viable dimensions.<br>';
}else if($dimensions1 > 36 || $dimensions2 > 36 || $dimensions3 > 36){
    $error_message.= 'Dimensions cannot exceed 36 inches.<br>';
}
if($valueOfPackages === FALSE){
    $error_message.= 'Missing value of packages.<br>';
}else if(!is_numeric($valueOfPackages)){
    $error_message.= 'Enter a viable value of packages.<br>';
}else if($valueOfPackages > 1000){
    $error_message.= 'Value of packages cannot exceed $1000';
}

if($error_message != ''){
    include('shipping.php');
    exit();
}

?>
<html>
    <head>
        <title>Report</title>
    </head>
    <body>
        <h1>Shipping To</h1>
        <label>Full Name:</label>
        <span><?php echo $fullName ?></span><br>

        <label>Street Address:</label>
        <span><?php echo $streetAddress ?></span><br>

        <label>City:</label>
        <span><?php echo $city ?></span><br>

        <label>State:</label>
        <span><?php echo $state ?></span><br>

        <label>Zip Code:</label>
        <span><?php echo $zipCode ?></span>

        <h1>Package Details</h1>
        <label>Ship Date:</label>
        <span><?php echo $shipDate ?></span><br>

        <label>Order Number:</label>
        <span><?php echo $orderNumber ?></span><br>

        <label>Dimensions:</label>
        <span><?php echo $dimensions1 . "x" . $dimensions2 . "x" . $dimensions3; ?></span><br>

        <label>Value of Packages:</label>
        <span><?php echo $valueOfPackages?></span>

        <img src="images/barcode.png">
        <p>Tracking Number: <?php echo rand(1,500)?></p>
        <p>Shipping Company: UPS</p>
    </body>        
</html>