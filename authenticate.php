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
    global $conn; 


    $stmt = $conn->prepare("SELECT password FROM knifeshopmanagers WHERE emailAddress = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

 
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
   
        $row = $result->fetch_assoc();


        if (password_verify($password, $row['password'])) {
     
            return true;
        } else {
         
            return false;
        }
    } else {
        
        return false;
    }

 
    $stmt->close();
}
?>