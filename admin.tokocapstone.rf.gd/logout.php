<?php 
session_start();

$_SESSION = [];

session_unset();
session_destroy();

setcookie('id_admin', '', time() - 15000);
setcookie('key', '', time() - 15000);

echo "<script>alert('Anda Telah Logout')</script>";
echo "<script>location='login.php';</script>";