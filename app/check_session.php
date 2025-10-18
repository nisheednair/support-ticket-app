<?php
session_start();

// check login 
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    // if not login redirect page to login
    header("Location: login.php");
    exit();
}
