<?php 
session_start();
include 'koneksi.php';

if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) {
    echo "<script>alert('Silakan Login');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

$ambil = $dbh->query("SELECT * FROM pembelian WHERE id_pembelian='$_GET[id]'");
$detail = $ambil->fetch(PDO::FETCH_ASSOC);

$id_pelanggan_beli = $detail["id_pelanggan"];
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login !== $id_pelanggan_beli) {
    echo "<script>location='riwayat.php';</script>";
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
                        <h2>konfirmasi pembayaran</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="login_part" style="height: 500px; margin-top:-50px;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3"></div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <h3 style="margin-bottom: 20px">Kirim bukti pembayaran Anda</h3>
                            <div class="alert alert-info">Total Pembayaran Anda <strong>Rp <?php echo number_format($detail['total_pembelian'],0,",","."); ?></strong></div>
                            <form enctype="multipart/form-data" action="" method="post">
                                <div class="col-md-12 form-group">
                                    <input  type="text" class="form-control" name="nama" placeholder="Nama Penyetor" required="" autocomplete="off">
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" name="bank" placeholder="Nama Bank" required="" autocomplete="off">
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="file" class="form-control" name="bukti" accept="image/*" required="" style="border-bottom: 0px">
                                </div>
                                <div class="col-md-12 form-group">
                                    <button type="submit"  name="kirim" class="btn_3">Kirim</button>
                                </div>
                            </form>
                            <?php 
                            if (isset($_POST["kirim"])) {
                            $namabukti = $_FILES["bukti"]["name"];
                            $lokasibukti = $_FILES["bukti"]["tmp_name"];
                            $bukti = date("YmdHis").$namabukti;
                            move_uploaded_file($lokasibukti, "bukti_pembayaran/$bukti");

                            $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_SPECIAL_CHARS);
                            $bank = filter_input(INPUT_POST, 'bank', FILTER_SANITIZE_SPECIAL_CHARS);
                            $jumlah = $detail['total_pembelian'];
                            $tanggal = date("Y-m-d");
                            $id_pembelian = $detail["id_pembelian"];

                            $ambil = $dbh->prepare('INSERT INTO pembayaran (id_pembelian, nama, bank, jumlah, tanggal, bukti) VALUES (:id_pembelian, :nama, :bank, :jumlah, :tanggal, :bukti)');
                            
                            $ambil->bindParam(':id_pembelian', $id_pembelian);
                            $ambil->bindParam(':nama', $nama, PDO::PARAM_STR);
                            $ambil->bindParam(':bank', $bank, PDO::PARAM_STR);
                            $ambil->bindParam(':jumlah', $jumlah, PDO::PARAM_STR);
                            $ambil->bindParam(':tanggal', $tanggal);
                            $ambil->bindParam(':bukti', $bukti);
                            $ambil->execute();

                            $status_pembelian = "Sudah Konfirmasi";
                            
                            $ambil = $dbh->prepare('UPDATE pembelian SET status_pembelian = :status_pembelian WHERE id_pembelian = :id_pembelian');
                            
                            $ambil->bindParam(':status_pembelian', $status_pembelian);
                            $ambil->bindParam(':id_pembelian', $id_pembelian);
                            $ambil->execute();
                            
                            echo "<script>location='riwayat.php';</script>";
                            }
                            ?>                
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