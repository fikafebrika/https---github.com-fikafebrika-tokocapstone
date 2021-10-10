<?php 
session_start();
require 'koneksi.php';

if (isset($_COOKIE['id_admin']) && isset($_COOKIE['key'])) {
    $id_admin = $_COOKIE['id_admin'];
    $key = $_COOKIE['key'];

    $ambil = $dbh->query("SELECT username FROM admin WHERE id_admin = '$id_admin'");
    $akun = $ambil->fetch(PDO::FETCH_ASSOC);

    if ($key === hash('sha256', $akun['username'])) {
        $_SESSION["admin"] = $akun;
    }
}

if (isset($_SESSION["admin"])) {
    echo "<script>location='index.php'</script>";
    exit();
}

if (isset($_POST['login'])) {
    $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
    $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS);
    $ambil = $dbh->prepare('SELECT * FROM admin WHERE username=:user AND password=:pass');
    $ambil->bindParam(':user', $user, PDO::PARAM_STR);
    $ambil->bindParam(':pass', $pass, PDO::PARAM_STR);
    $ambil->execute();
    
    if ($ambil->rowCount() === 1) {
        $akun = $ambil->fetch(PDO::FETCH_ASSOC);
        $_SESSION['admin']=$akun;
        if (isset($_POST["remember"])) {
            setcookie('id_admin', $akun['id_admin'], time()+15000);
            setcookie('key', hash('sha256', $akun['username']), time()+15000);
        }
        echo "<script>alert('Login Berhasil!')</script>";
        echo "<script>location='index.php'</script>";
    } else {
        echo "<script>alert('Login Gagal, Periksa Username dan Password Anda')</script>";
        echo "<script>location='login.php'</script>";
    }
}
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Admin Toko Capstone</title>
        <link rel="icon" href="../tokocapstone.rf.gd/img/icon.jpg">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/owl.theme.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/morrisjs/morris.css">
        <link rel="stylesheet" href="css/form/all-type-forms.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="css/responsive.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <div class="color-line"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="back-link back-backend">
                        <a href="../tokocapstone.rf.gd/index.php" class="btn btn-primary"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
                <div class="col-md-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="text-center m-b-md custom-login">
                        <h3>LOGIN ADMIN</h3>
                        <p>Silakan Login</p>
                    </div>
                    <div class="hpanel">
                        <div class="panel-body">
                            <form method="post" action="login.php" id="loginForm">
                                <div class="form-group">
                                    <label class="control-label" for="username">Username</label>
                                    <input type="text" placeholder="contohusername" title="Masukkan Username Anda" required="" name="user" id="username" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="password">Password</label>
                                    <input type="password" title="Masukkan Password Anda" placeholder="******" required="" name="pass" id="password" class="form-control">
                                </div>
                                <div class="checkbox login-checkbox">
                                    <label>
    									<input name="remember" type="checkbox" class="i-checks"> Remember me </label>
                                    <p class="help-block small">(Jika Komputer Hanya Anda yang Memakainya)</p>
                                </div>
                                <button type="submit" name="login" class="btn btn-success btn-block loginbtn">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
            </div>
            <div class="row">
                <div class="col-md-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> by Fika Febrika All rights reserved</p>
                </div>
            </div>
        </div>
        <script src="js/vendor/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/tab.js"></script>
        <script src="js/icheck/icheck.min.js"></script>
        <script src="js/icheck/icheck-active.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>