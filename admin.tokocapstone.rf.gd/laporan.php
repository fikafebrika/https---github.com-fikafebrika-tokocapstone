<?php 
session_start();
require 'koneksi.php';

if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='login.php';</script>";
  
    header('location:login.php');
    exit();
}

$semuadata = array();
$tgl_mulai = "-";
$tgl_selesai = "-";

if (isset($_POST["lihat"])) {
    $tgl_mulai = $_POST['tglm'];
    $tgl_selesai = $_POST['tgls'];
    $ambil = $dbh->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON pm.id_pelanggan=pl.id_pelanggan WHERE tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai' AND status_pembelian!='Pending'");
    while($pecah = $ambil->fetch(PDO::FETCH_ASSOC)){
        $semuadata[]=$pecah;
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
                                <h3>Laporan Pembelian dari <?php echo $tgl_mulai ?> hingga <?php echo $tgl_selesai ?></h3>
                                <form method="post">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <div class="personal-info-wrap">
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                            <input type=date class="form-control" name="tglm" value="<?php echo $tgl_mulai ?>" placeholder="Tanggal Mulai">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <div class="personal-info-wrap">
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                            <input type=date class="form-control" name="tgls" value="<?php echo $tgl_selesai ?>" placeholder="Tanggal Selesai">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="personal-info-wrap">
                                        <button name="lihat" type="submit" class="btn btn-primary waves-effect waves-light m-r-10">Lihat</button>
                                    </div>
                                </div>
                                </form>
                                <table>
                                    <tr>
                                        <th colspan="2"></th>
                                        <th>No.</th>
                                        <th></th>
                                        <th>Pelanggan</th>
                                        <th></th>
                                        <th>Tanggal</th>
                                        <th></th>
                                        <th>Jumlah</th>
                                        <th></th>
                                        <th>Status</th>
                                    </tr>
                                    <?php $total=0; ?>
                                    <?php foreach ($semuadata as $key => $value): ?>
                                    <?php $total+=$value['total_pembelian'] ?>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td><?php echo $key+1; ?></td>
                                        <td></td>
                                        <td><?php echo $value["nama_pelanggan"] ?></td>
                                        <td></td>
                                        <td><?php echo date('d-m-Y', strtotime($value["tanggal_pembelian"])) ?></td>
                                        <td></td>
                                        <td>Rp <?php echo number_format($value["total_pembelian"],0,",",".") ?></td>
                                        <td></td>
                                        <td><?php echo $value["status_pembelian"] ?></td>
                                    </tr>
                                    <?php endforeach ?>
                                    <tr>
                                        <td colspan="6"></td>
                                        <td colspan="2" style="font-weight: bold;">Total</td>
                                        <td>Rp <?php echo number_format($total,0,",",".") ?></td>
                                        <td colspan="2"></td>
                                    </tr>
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