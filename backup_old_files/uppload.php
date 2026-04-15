<?php
session_start();

// Fake registration
$_SESSION['user_name'] = 'Demo User';
$_SESSION['user_email'] = 'demo@unipath.com';

header("Location: mainpage.php");
exit();
?>