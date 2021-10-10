<?php 
session_start();
include 'koneksi.php';

if (!isset($_SESSION["pelanggan"])) {
    echo "<script>alert('Silakan Login');</script>";
    echo "<script>location='login.php';</script>";
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
                        <h2>nota pemesanan</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="confirmation_part" style="padding-top: 35px">
        <div class="container">
            <?php 
            $ambil = $dbh->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
            $detail = $ambil->fetch(PDO::FETCH_ASSOC);
            ?>
            <?php 
            $idpelangganyangbeli = $detail["id_pelanggan"];
            $idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

            if ($idpelangganyangbeli !== $idpelangganyanglogin) {
                echo "<script>location='riwayat.php'</script>";
                exit();
            }
            ?>
            <div class="row">
                <div class="col-lg-6 col-lx-4">
                    <div class="single_confirmation_details">
                        <h4>Pelanggan</h4>
                        <ul>
                            <li>
                                <p>Nama</p><span> : <?php echo $detail['nama_pelanggan']; ?></span>
                            </li>
                            <li>
                                <p>Telp/HP</p><span> : <?php echo $detail['telepon_pelanggan'] ?></span>
                            </li>
                            <li>
                                <p>Email</p><span> : <?php echo $detail['email_pelanggan'] ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-lx-4">
                    <div class="single_confirmation_details">
                        <h4>Pengiriman</h4>
                        <ul>
                            <li>
                                <p>Alamat</p><span> : <?php echo $detail['alamat_pengiriman']; ?></span>
                            </li>
                            <li>
                                <p>Kota</p><span> : <?php echo $detail['nama_kota'] ?></span>
                            </li>
                            <li>
                                <p>Ongkos Kirim</p><span> : Rp <?php echo number_format($detail['tarif'],0,",","."); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-lx-4">
                    <div class="single_confirmation_details">
                        <h4>Pembelian</h4>
                        <ul>
                            <li>
                                <p>No. Pembelian</p><span> : <?php echo $detail['id_pembelian'] ?></span>
                            </li>
                            <li>
                                <p>Tanggal</p><span> : <?php echo date('d-m-Y', strtotime($detail["tanggal_pembelian"])) ?></span>
                            </li>
                            <li>
                                <p>Total</p><span> : Rp <?php echo number_format($detail['total_pembelian'],0,",",".") ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-lg-12" style="width: 200%">
                        <div class="checkout_btn_inner float-right">
                        <br>
                        <a class="btn_1" name="status" href="riwayat.php">Lihat Status Pemesanan</a>
                    </div>
                <div class="order_details_iner">
                <h3>Detail Pemesanan</h3>
                <table class="table table-borderless" style="text-align: center">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align: left;">Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Berat</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Subberat</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $ambil=$dbh->query("SELECT* FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
                        <?php while($pecah=$ambil->fetch(PDO::FETCH_ASSOC)) { ?>     
                        <tr>
                            <th style="text-align: left;"><span><?php echo $pecah['nama']; ?></span></th>
                            <th> <span>Rp<?php echo number_format($pecah['harga'],0,",","."); ?></span></th>
                            <th><?php echo $pecah['berat']; ?></th>
                            <th><?php echo $pecah['jumlah']; ?></th>
                            <th><?php echo $pecah['subberat']; ?> gram</th>
                            <th>Rp<?php echo number_format($pecah['subharga'],0,",","."); ?></th>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <?php if ($detail['status_pembelian']=="Pending") : ?>
                    <tfoot>
                        <tr><th></th></tr>
                        <tr>
                          <th colspan="6" class="alert alert-info">silakan melakukan  pembayaran &nbsp; Rp <?php echo number_format($detail['total_pembelian'],0,",","."); ?> &nbsp; ke &nbsp;<strong>BANK MANDIRI 190-647117632-7381 &nbsp; atas nama &nbsp; fika febrika</strong></p></th>
                      </tr>
                    </tfoot>
                    <?php else : ?>
                    <tfoot hidden="">
                        <tr><th></th></tr>
                        <tr>
                            <th colspan="6" class="alert alert-info">silakan melakukan  pembayaran &nbsp; Rp <?php echo number_format($detail['total_pembelian'],0,",","."); ?> &nbsp; ke &nbsp;<strong>BANK MANDIRI 190-647117632-7381 &nbsp; atas nama &nbsp; fika febrika</strong></p></th>
                        </tr>
                    </tfoot>
                    <?php endif ?>
                </table>
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