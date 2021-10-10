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
                        <?php
                        $id_pembelian = $_GET['id'];

                        $ambil = $dbh->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
                        $detail = $ambil->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="product-status-wrap" style="min-height: 544px">
                                <h3>Data Pembayaran</h3>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="personal-info-wrap">
                                            <img style="width: 500px;" alt="" class="img-responsive" src="../tokocapstone.rf.gd/bukti_pembayaran/<?php echo $detail['bukti'] ?>">
                                        </div>
                                    </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="personal-info-wrap">
                                        <div class="widget-text-box">
                                            <h4>Nama : <?php echo $detail['nama'] ?></h4>
                                        </div>
                                        <div class="widget-text-box">
                                            <h4>Bank : <?php echo $detail['bank'] ?></h4>
                                        </div>
                                        <div class="widget-text-box">
                                            <h4>Jumlah : Rp <?php echo number_format($detail['jumlah'],0,",",".") ?></h4>
                                        </div>
                                        <div class="widget-text-box">
                                            <h4>Tanggal : <?php echo date('d-m-Y', strtotime($detail["tanggal"])) ?></h4>
                                        </div>
                                        <form method="post">
                                            <div class="input-group mg-b-pro-edt">
                                                <span class="input-group-addon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                                <input required="" type="text" class="form-control" name="resi" placeholder="No. Resi Pengiriman">
                                            </div>
                                            <select name="status" class="form-control pro-edt-select form-control-primary">
                                                <option value="opt1">Pilih Status</option>
                                                <option value="Dalam Pengiriman">Dalam Pengiriman</option>
                                                <option value="Selesai">Selesai</option>
                                            </select>
                                            <br>
                                            <div class="text-center mg-b-pro-edt custom-pro-edt-ds">
                                                <button name="proses" type="submit" class="btn btn-primary waves-effect waves-light m-r-10">Proses</button>
                                            </div>
                                            </form>
                                            <?php 
                                            if (isset($_POST["proses"])) {
                                                $resi = filter_input(INPUT_POST, 'resi', FILTER_SANITIZE_SPECIAL_CHARS);
                                                $status = $_POST["status"];

                                                $ambil = $dbh->prepare("UPDATE pembelian SET resi_pengiriman = :resi, status_pembelian='$status' WHERE id_pembelian='$id_pembelian'");

                                                $ambil->bindParam(':resi', $resi, PDO::PARAM_STR);
                                                $ambil->execute();

                                                echo "<script>alert('Data Pembelian Berhasil Ditambahkan');</script>";
                                                echo "<script>location='pembelian.php';</script>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div id="myTabContent" class="tab-content custom-product-edit">
                                        <div class="product-tab-list tab-pane fade active in" id="description">
                                            <div class="row"></div>
                                        </div>
                                    </div>
                                </div>
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
