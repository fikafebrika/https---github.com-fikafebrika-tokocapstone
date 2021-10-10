<?php 
session_start();
include 'koneksi.php';

if (isset($_COOKIE['id_pelanggan']) && isset($_COOKIE['key'])) {
    $id_pelanggan = $_COOKIE['id_pelanggan'];
    $key = $_COOKIE['key'];

    $ambil = $dbh->query("SELECT email_pelanggan FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
    $akun = $ambil->fetch(PDO::FETCH_ASSOC);

    if ($key === hash('sha256', $akun['email_pelanggan'])) {
        $_SESSION["pelanggan"] = $akun;
    }
}

if (isset($_SESSION["pelanggan"])) {
  echo "<script>location='index.php';</script>";
  exit();
}

if (isset($_POST["login"])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $ambil = $dbh->prepare('SELECT * FROM pelanggan WHERE email_pelanggan = :email');
    $ambil->bindParam(':email', $email, PDO::PARAM_STR);
    $ambil->execute();
    if ($ambil->rowCount() === 1) {
        $akun = $ambil->fetch(PDO::FETCH_ASSOC);
        if(password_verify($password, $akun["password_pelanggan"])){
            $_SESSION["pelanggan"] = $akun;
            setcookie('id_pelanggan', $akun['id_pelanggan']);
            setcookie('key', hash('sha256', $akun['email_pelanggan']));

            if (isset($_POST["remember"])) {
                setcookie('id_pelanggan', $akun['id_pelanggan'], time()+15000);
                setcookie('key', hash('sha256', $akun['email_pelanggan']), time()+15000);
            }

            if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"])) {
                echo "<script>location='keranjang.php'</script>";
            }

            echo "<script>alert('Login Berhasil!')</script>";
            echo "<script>location='index.php'</script>";
        } else {
            echo "<script>alert('Password Salah!')</script>";
        }

    } else {
        echo "<script>alert('Login Gagal, Periksa Email dan Password Anda!')</script>";            
    }
}
?>
<!doctype html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TOKO CAPSTONE</title>
    <link rel="icon" href="img/icon.jpg">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <section class="breadcrumb_part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner">
                        <h2>login</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="login_part" style="padding-top: 35px">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_text text-center">
                        <div class="login_part_text_iner">
                            <h2>Baru di Toko Kami?</h2>
                            <p>Dengan membuat akun, Anda diberi kemudahan dalam mengakses berbagai fasilitas yang Kami berikan </p>
                            <a href="daftar.php" class="btn_3">Buat Akun</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <h3>Selamat Datang Kembali !<br>Silakan Login Sekarang</h3>
                            <form class="row contact_form" action="login.php" method="post">
                                <div class="col-md-12 form-group p_star">
                                    <input type="email" class="form-control" required="" id="name" name="email" placeholder="Email" autocomplete="off">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" required="" id="password" name="password" placeholder="Password" autocomplete="off">
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="creat_account d-flex align-items-center">
                                        <input type="checkbox" id="remember" name="remember">
                                        <label for="remember">Remember me</label>
                                    </div>
                                    <button type="submit" name="login" class="btn_3">login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.js"></script>
    <script src="js/swiper.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>
    <script src="js/custom.js"></script>
</body>    
</html>