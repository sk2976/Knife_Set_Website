<?php
require_once('databaseConnection.php');

$sql = "SELECT * FROM knives";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knife List</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

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
        echo "<td>" . $row["description"] . "</td>";
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