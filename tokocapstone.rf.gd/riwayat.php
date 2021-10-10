<?php 
session_start();
include 'koneksi.php';

if (!isset($_COOKIE['id_pelanggan']) && !isset($_COOKIE['key'])) {
  echo "<script>location='logout.php';</script>";
  exit();
}

if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) {
  echo "<script>alert('Silakan Login');</script>";
  echo "<script>location='login.php';</script>";
  exit();
}

$id_pelanggan = $_COOKIE['id_pelanggan'];

$ambil = $dbh->query("SELECT nama_pelanggan FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
$akun = $ambil->fetch(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <section class="breadcrumb_part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner">
                        <h2>Status Pemesanan  <?php echo $akun["nama_pelanggan"]; ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="cart_area" style="padding: 50px;">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table" style="text-align: center;">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Bukti Bayar</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Status</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nomor=1;
                            $ambil = $dbh->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
                            while($pecah = $ambil->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td>
                                    <h5><?php echo $nomor; ?></h5>
                                </td>
                                <td>
                                    <?php if ($pecah['status_pembelian'] !== "Pending"): ?>
                                    <?php 
                                    $id_pembelian=$pecah["id_pembelian"];
                                    $bayar = $dbh->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
                                    $detbay = $bayar->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <img style="width: 300px" title="<?php echo $detbay["bank"] ?>" src="bukti_pembayaran/<?php echo $detbay["bukti"] ?>" alt="" />
                                    <?php else : ?>
                                    <h5 style="color: red">Belum Konfirmasi Pembayaran</h5>
                                    <?php endif; ?>                
                                </td>
                                <td>
                                    <h5><?php echo date('d-m-Y', strtotime($pecah["tanggal_pembelian"])) ?></h5>
                                </td>
                                <td>
                                    <h5 style="color: purple"><?php echo $pecah["status_pembelian"] ?>
                                    <br>
                                        <?php if (!empty($pecah['resi_pengiriman'])): ?>
                                            Resi : <?php echo $pecah['resi_pengiriman']; ?>
                                        <?php endif ?>
                                    </h5>
                                </td>
                                <td>
                                    <h5>Rp<?php echo number_format($pecah["total_pembelian"],0,",",".") ?></h5>
                                </td>
                                <td style="width: 250px;">
                                    <?php if ($pecah['status_pembelian']=="Pending"): ?>
                                    <a href="konfirmasi.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn_3 genric-btn primary">Konfirmasi</a>
                                    <?php endif ?>                
                                    <a href="nota.php?id=<?php echo $pecah["id_pembelian"] ?>" class=" btn_3 genric-btn primary">nota</a>
                                </td>
                            </tr>
                            <?php $nomor++; ?>
                            <?php } ?>
                        </tbody>
                    </table>
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