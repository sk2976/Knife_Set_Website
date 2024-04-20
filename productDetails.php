<?php
include("databaseConnection.php");

function getAllKnives($conn) {
    $sql = "SELECT knifeID, knifeName FROM knives ORDER BY knifeName";
    $result = $conn->query($sql);
    $knives = [];
    while ($row = $result->fetch_assoc()) {
        $knives[$row['knifeID']] = $row['knifeName'];
    }
    return $knives;
}

$allKnives = getAllKnives($conn);
$knife_id = isset($_GET['knife_id']) ? $_GET['knife_id'] : 0;
$stmt = $conn->prepare("SELECT * FROM knives WHERE knifeID = ?");
$stmt->bind_param("i", $knife_id);
$stmt->execute();
$result = $stmt->get_result();
$knife = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knife Details</title>
    <style>
    body {
        background-color: rgb(35,35,35);
        color: white;
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 100vh;
    }
    h1 {
        margin-top: 80px; 
        text-align: center;
    }
    .navbar {
        font-family: Arial, Helvetica, sans-serif;
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
    .details-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 20px;
        width: 80%; 
    }
    select {
        width: 200px; 
        padding: 5px;
        margin-bottom: 20px;
    }
    p {
        font-size: 18px;
        line-height: 1.6;
    }
    img {
        width: 300px; 
        margin-top: 20px;
    }
    .blackandwhite {
        filter: grayscale(100%);
    }
</style>
</head>
<body>
<?php include("navbar.php"); ?>

<h1>Knife Details</h1>
<select onchange="window.location.href='productDetails.php?knife_id=' + this.value;">
    <?php foreach ($allKnives as $id => $name): ?>
        <option value="<?php echo $id; ?>" <?php echo $id == $knife_id ? 'selected' : ''; ?>>
            <?php echo htmlspecialchars($name); ?>
        </option>
    <?php endforeach; ?>
</select>

<?php if ($knife): ?>
    <p>Knife Name: <?php echo $knife['knifeName']; ?></p>
    <p>Description: <?php echo $knife['knifeDescription']; ?></p>
    <p>Price: <?php echo $knife['price']; ?></p>
    <img src="images/<?php echo $knife_id; ?>.jpg" alt="Image of <?php echo $knife['knifeName']; ?>" width="300px" id="knife-image">
<?php else: ?>
    <p>Knife not found.</p>
<?php endif; ?>

</body>
</html>
<script>
    document.addEventListener("DOMContentLoaded", function(){
        image = document.getElementById("knife-image");
        image.addEventListener('mouseenter', function(){
            image.classList.add('blackandwhite');
        })
        image.addEventListener('mouseleave', function(){
            image.classList.remove('blackandwhite');
        })
    })
</script>
