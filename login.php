<?php 
session_start();
if (!isset($login_message)) {
    $login_message = 'You must login to view this page.';
}

if (isset($_POST['logout'])) {
    
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Log In</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(35,35,35);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        main {
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        h1 {
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"], input[type="button"] {
            background-color: #5c67f2;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover, input[type="button"]:hover {
            background-color: #4a54e1;
        }
        p {
            color: #555;
        }
    </style>
</head>
<body>
    <main>
        <h1>Login</h1>
        <form action="authenticate.php" method="post">
            <label>Email:</label>
            <input type="text" name="email" value="">
            <br>
            <label>Password:</label>
            <input type="password" name="password" value="">
            <br>
            <input type="submit" value="Login">
        </form>
        <form method="post">
            <input type="submit" name="logout" value="Back" style="background-color: indianred;">
        </form>
        <p><?php echo $login_message; ?></p>
    </main>
    <?php if (!empty($_SESSION['logout_message'])): ?>
        <p><?= htmlspecialchars($_SESSION['logout_message']) ?></p>
        <?php unset($_SESSION['logout_message']); ?>
    <?php endif; ?>
</body>
</html>
