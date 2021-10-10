<?php 
session_start();

$_SESSION = [];

session_unset();
session_destroy();

setcookie('id_pelanggan', '', time() - 15000);
setcookie('key', '', time() - 15000);

echo "<script>location='login.php';</script>";