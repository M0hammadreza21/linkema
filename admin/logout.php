<?php
ob_start();
session_start();
// remove all session variables
session_unset();
// destroy the session
session_destroy();
header('Location: https://linkema.com/admin/login.php');
?>