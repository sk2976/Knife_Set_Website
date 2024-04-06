<?php
session_start();
require_once('databaseConnection.php');

if (isset($_POST['knifeID'])) {
    $knifeID = $conn->real_escape_string($_POST['knifeID']);

    // SQL to delete the product
    $sql = "DELETE FROM knives WHERE knifeID = $knifeID";

    if ($conn->query($sql) === TRUE) {
        echo 'success';
    } else {
        echo 'error';
    }

    $conn->close();
} else {
    echo 'error';
}
?>
