<?php
    session_start();
    $_SESSION = [];
    session_destroy();

    session_start();
    header('Location: login.php');
exit;
?>