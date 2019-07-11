<?php
echo "adasdea";
ob_start();
session_start();

session_destroy();
$err_msg = "Admin Logged out Successfully.";
header("Location: login.php?msg=" . $err_msg);
exit;
?>