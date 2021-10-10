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

if (isset($_POST["ubah"])) {
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $password1 = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_SPECIAL_CHARS);
    $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_SPECIAL_CHARS);
    $ambil = $dbh->prepare('SELECT * FROM pelanggan WHERE id_pelanggan = :id_pelanggan');
    $ambil->bindParam(':id_pelanggan', $id_pelanggan, PDO::PARAM_STR);
    $ambil->execute();
    if ($ambil->rowCount() === 1) {
        $akun = $ambil->fetch(PDO::FETCH_ASSOC);
        if(password_verify($password, $akun["password_pelanggan"])){
            $_SESSION["pelanggan"] = $akun;

            if ( $password1 !== $password2) {
                echo "<script>alert('Konfirmasi Password Salah')</script>";
                echo "<script>location='ubah.php'</script>";
                return false;
            }

            $password1 = password_hash($password1, PASSWORD_DEFAULT);
            
            $ambil = $dbh->prepare("UPDATE pelanggan SET password_pelanggan=:password1 WHERE id_pelanggan='$id_pelanggan'");
                $ambil->bindParam(':password1', $password1, PDO::PARAM_STR);
                $ambil->execute();
                echo "<script>alert('Ubah Password Berhasil, Silakan Login')</script>";
                echo "<script>location='logout.php'</script>";
        } else {
            echo "<script>alert('Password Sebelumnya Salah!')</script>";
        }

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
                        <h2>Ubah Password</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="login_part" style="height: 470px; margin-top: -80px">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3"></div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <form class="row contact_form" action="ubah.php" method="post">
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" required="" title="Password Sebelumnya" id="password" name="password" placeholder="Password Sebelumnya" autocomplete="off">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" required="" title="Password Baru" id="password1" name="password1" placeholder="Password Baru" autocomplete="off">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" required="" title="Konfirmasi Password Baru" id="password2" name="password2" placeholder="Konfirmasi Password Baru" autocomplete="off">
                                </div>
                                <div class="col-md-12 form-group">
                                    <button type="submit" name="ubah" class="btn_3">Ubah Password</button>
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