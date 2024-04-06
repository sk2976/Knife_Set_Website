<?php
/* DO NOT Execute




require_once('databaseConnection.php'); // 

// Dummy account details
$accounts = [
    ['email' => 'admin1@example.com', 'password' => 'password123', 'firstName' => 'Admin', 'lastName' => 'One'],
    ['email' => 'admin2@example.com', 'password' => 'password456', 'firstName' => 'Admin', 'lastName' => 'Two'],
    ['email' => 'admin3@example.com', 'password' => 'password789', 'firstName' => 'Admin', 'lastName' => 'Three'],
];

foreach ($accounts as $account) {

    $hashedPassword = password_hash($account['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO knifeshopmanagers (emailAddress, password, firstName, lastName, dateCreated) VALUES (?, ?, ?, ?, NOW())");
    
    $stmt->bind_param("ssss", $account['email'], $hashedPassword, $account['firstName'], $account['lastName']);
    

    if ($stmt->execute()) {
        echo "Account for " . $account['email'] . " created successfully.\n";
    } else {
        echo "Error creating account for " . $account['email'] . ": " . $conn->error . "\n";
    }


    $stmt->close();
}

// Close the connection
$conn->close();
?>
