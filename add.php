<?php
    //Based on the responses of the form, variables are initialized.
    require_once("databaseConnection.php");

    $category = $_POST['category'];
    $categoryId;
    switch ($category){
        case "bread": $categoryId = 1;
        break;
        case "butter": $categoryId = 2;
        break;
        case "chef": $categoryId = 3;
        break;
        case "paring": $categoryId = 4;
        break;
        case "steak": $categoryId = 5;
        break;
    }
    $code = $_POST['code'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $errorMessage = '';
    //Try to create a new PDO object. If error, include error page
    try{
        $db = new PDO("mysql:host=localhost;dbname=kankamsknives","root","password");
    }catch(PDOException $e){
        $errorMessage = $e->getMessage()."<br>";
        include("create.php");
        exit();
    }

    //validation
    if(empty($code)){
        $errorMessage.= "Missing Code <br>";
    }
    if(empty($name)){
        $errorMessage.= "Missing Name <br>";
    }
    if(empty($description)){
        $errorMessage.= "Missing Description <br>";
    }
    if(empty($price)){
        $errorMessage.= "Missing Price <br>";
    }else if(!is_numeric($price)){
        $errorMessage .= "Price must be a number <br>";
    }else if($price <= 0){
        $errorMessage .= "Price must be greater than $50 <br>";
    }else if($price > 5000){
        $errorMessage .= "Price cannot be greater than $5000 <br>";
    }
    //Checks if the knife code exists already in the database
        $query = "SELECT knifeCode FROM knives";
        $statement = $db->prepare($query);
        $statement->execute();
        $codes = $statement->fetchAll(PDO::FETCH_COLUMN);
        if(in_array($code,$codes)){
            $errorMessage .= "Cannot add a duplicate code <br>";
        }
        $statement->closeCursor();
    if($errorMessage != ''){
        include("create.php");
        exit();
    }
    $price = number_format(intval($price),2);
    //Gets the largest id in the table, and sets the next ID to be one larger
        $query = "SELECT MAX(knifeID) AS max_id FROM knives";
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $nextID = intval($result['max_id']) + 1;
        $statement->closeCursor();

    //Inserts the new item into the table
        $query = "INSERT INTO knives VALUES(:knifeID,:knifeCategoryID,:knifeCode,:knifeName,:knifeDescription,:price,NOW())";
        $statement = $db->prepare($query);
        $statement->bindValue(":knifeID",$nextID);
        $statement->bindValue(":knifeCategoryID",$categoryId);
        $statement->bindValue(":knifeCode",$code);
        $statement->bindValue(":knifeName",$name);
        $statement->bindValue(":knifeDescription",$description);
        $statement->bindValue(":price",$price);
        $statement->execute();
        $statement->closeCursor();
    
        $successMessage = "Knife added successfully";
        include("create.php");
        exit();
?>
