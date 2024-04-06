<?php
  require_once('databaseConnection.php');
  session_start();

  $email = filter_input(INPUT_POST, 'email');
  $password = filter_input(INPUT_POST, 'password');
  if (is_valid_admin_login($email, $password)) {
    $_SESSION['is_logged_in'] = true;
    header('Location:index.php');
  } else {
  if ($email == NULL && $password == NULL) {
    $login_message ='You must login to view this page.';
  } else {
    $login_message = 'Invalid credentials.';
  }
    include('login.php');
  }
  function is_valid_admin_login($email, $password) {
    global $conn; // Use the mysqli connection established globally

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT password FROM knifeshopmanagers WHERE emailAddress = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Store the result so we can check the row count
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Fetch the row
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // If the password is correct
            return true;
        } else {
            // If the password is incorrect
            return false;
        }
    } else {
        // If no user is found with that email address
        return false;
    }

    // Close the statement
    $stmt->close();
}
?>