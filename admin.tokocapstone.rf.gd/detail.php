<?php 
session_start();
require 'koneksi.php';

if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='login.php';</script>";
  
    header('location:login.php');
    exit();
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
        <link rel="stylesheet" href="css/owl.transitions.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/meanmenu.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/morrisjs/morris.css">
        <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
        <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css">
        <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="css/responsive.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <?php require 'menu.php'; ?>
            <div class="product-status mg-tb-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="product-status-wrap" style="min-height: 544px">
                                <h3>Data Pembelian</h3>
                                <?php 
                                $ambil = $dbh->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
                                $detail = $ambil->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="personal-info-wrap">
                                        <div class="widget-text-box">
                                            <h4>Pembelian</h4>
                                            <p>Tanggal : <?php echo date('d-m-Y', strtotime($detail["tanggal_pembelian"])) ?>
                                            <br>Total : Rp <?php echo number_format($detail['total_pembelian'],0,",","."); ?>
                                            <br>Status : <?php echo $detail["status_pembelian"]; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="author-widgets-single res-mg-t-30">
                                        <div class="widget-text-box">
                                            <h4>Pelanggan</h4>
                                            <strong><?php echo $detail['nama_pelanggan']; ?></strong>        
                                            <p><?php echo $detail['telepon_pelanggan'] ?>
                                            <br><?php echo $detail['email_pelanggan'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="personal-info-wrap personal-info-ano res-mg-t-30">
                                        <div class="widget-text-box">
                                            <h4>Pengiriman</h4>
                                            <strong><?php echo $detail["nama_kota"] ?></strong><br>
                                            <p>Tarif : Rp <?php echo number_format($detail["tarif"],0,",","."); ?>
                                            <br>Alamat : <?php echo $detail["alamat_pengiriman"]; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <table>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                    <?php $nomor=1; ?>
                                    <?php $ambil = $dbh->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
                                    <?php while($pecah = $ambil->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <tr>
                                        <td><?php echo $nomor; ?></td>
                                        <td><?php echo $pecah['nama_produk']; ?></td>
                                        <td>Rp <?php echo number_format($pecah['harga_produk'],0,",","."); ?></td>
                                        <td><?php echo $pecah['jumlah']; ?></td>
                                        <td>Rp <?php echo number_format($pecah['harga_produk']*$pecah['jumlah'],0,",","."); ?></td>
                                    </tr>
                                    <?php $nomor++; ?>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require 'footer.php'; ?>
        </div>
        <script src="js/vendor/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/jquery.meanmenu.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/jquery.scrollUp.min.js"></script>
        <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="js/scrollbar/mCustomScrollbar-active.js"></script>
        <script src="js/metisMenu/metisMenu.min.js"></script>
        <script src="js/metisMenu/metisMenu-active.js"></script>
        <script src="js/morrisjs/raphael-min.js"></script>
        <script src="js/morrisjs/morris.js"></script>
        <script src="js/morrisjs/morris-active.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>