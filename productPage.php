<?php
session_start();
require_once('databaseConnection.php');

$sql = "SELECT * FROM knives";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Knife List</title>
    <style>
        body{
            background-color: rgb(35,35,35);
            margin:0;
        }
        h1{
            color:white;
            margin-top:70px;
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        td{
            color:white;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
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
        .dropdown button {
            border: 2px solid white;
            background-color: black;
            padding: 5px;
            border-radius: 5px;
            color:red;
            z-index: 100; 
        }
        .dropdown button:hover{
            background-color: rgb(60,60,60);
        }
        .selected-row {
            background-color: black;
        }

    </style>
</head>
<body>
        <h1>Product List</h1>
<?php
if ($result->num_rows > 0) {
    
    echo "<table>";
    echo "<tr><th>knifeID</th><th>knifeCategoryID</th>
    <th>knifeCode</th><th>knifeName</th><th>description</th>
    <th>price</th><th>dateCreated</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["knifeID"] . "</td>";
        echo "<td>" . $row["knifeCategoryID"] . "</td>";
        echo "<td>" . $row["knifeCode"] . "</td>";
        echo "<td>" . $row["knifeName"] . "</td>";
        echo "<td>" . $row["knifeDescription"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td>" . $row["dateCreated"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>

</body>
</html>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var currentDropdown = null; 
    var selectedRow = null; 

    //Remove currentDropdown and seelected row
    function removeCurrentDropdown() {
        if (currentDropdown) {
            currentDropdown.remove();
            currentDropdown = null;
        }
        if (selectedRow) {
            selectedRow.classList.remove('selected-row');
            selectedRow = null;
        }
    }
    //Finds the row, adds double click event, creates the dropdown menu including delete function
    document.querySelectorAll('table tr').forEach(row => {
        row.addEventListener('dblclick', function(e) {
            e.stopPropagation(); 
            removeCurrentDropdown(); // Remove any existing dropdown and highlight
            
            var knifeID = this.cells[0].textContent;

            // Create and show the dropdown menu for deletion
            var dropdown = document.createElement('div');
            var deleteButton = document.createElement('button');
            deleteButton.textContent = 'Delete Product';
            deleteButton.onclick = function(event) { deleteProduct(knifeID, event); };
            dropdown.appendChild(deleteButton);

            dropdown.style.position = 'absolute';
            dropdown.className = 'dropdown';
            dropdown.style.left = e.clientX + 'px';
            dropdown.style.top = e.clientY + window.scrollY + 'px';
            document.body.appendChild(dropdown);
            currentDropdown = dropdown;

            this.classList.add('selected-row');
            selectedRow = this; 
        });
    });

    document.addEventListener('click', function(e) {
        removeCurrentDropdown(); // Remove the dropdown and the highlight when clicking elsewhere
    });

});
//Failed to work in scope of DOMContentLoaded event, so this runs outside
function deleteProduct(knifeID, event) {
    event.stopPropagation(); 

    // AJAX request to PHP for deletion
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "deleteProduct.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        if (this.responseText.trim() == 'success') {
            alert('Product deleted successfully');
            window.location.reload(); 
        } else {
            alert('Error deleting product');
        }
    }
    xhr.send("knifeID=" + knifeID);
}

</script>


