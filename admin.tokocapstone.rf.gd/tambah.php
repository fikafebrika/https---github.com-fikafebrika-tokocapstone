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
            <div class="single-product-tab-area mg-tb-15" style="padding: 44px 10px;">
                <div class="single-pro-review-area">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="review-tab-pro-inner">
                                    <ul id="myTab3" class="tab-review-design">
                                        <li class="active">
                                            <a href="tambah.php"><i class="fa fa-pencil" aria-hidden="true"></i> Tambah Produk</a>
                                        </li>
                                    </ul>
                                    <div id="myTabContent" class="tab-content custom-product-edit">
                                        <div class="product-tab-list tab-pane fade active in" id="description">
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="review-content-section">
                                                            <div class="input-group mg-b-pro-edt">
                                                                <span class="input-group-addon"><i class="fa fa-image" aria-hidden="true"></i></span>
                                                                <input readonly="" class="form-control" placeholder="Foto Produk">
                                                                <input required="" accept="image/*" type="file" class="form-control" name="foto_produk">
                                                            </div>
                                                            <div class="input-group mg-b-pro-edt">
                                                                <span class="input-group-addon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                                                <input required="" type="text" class="form-control" name="nama_produk" placeholder="Nama Produk">
                                                            </div>
                                                            <div class="input-group mg-b-pro-edt">
                                                                <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                                                                <input required="" type="text" class="form-control" name="harga_produk" placeholder="Harga Produk (Rp)">
                                                            </div>
                                                            <div class="input-group mg-b-pro-edt">
                                                                <span class="input-group-addon"><i class="fa fa-inbox" aria-hidden="true"></i></span>
                                                                <input required="" type="number" class="form-control" name="berat_produk" placeholder="Berat Produk (Gr)">
                                                            </div>
                                                            <div class="input-group mg-b-pro-edt">
                                                                <span class="input-group-addon"><i class="fa fa-cube" aria-hidden="true"></i></span>
                                                                <input required="" type="number" class="form-control" name="stok_produk" placeholder="Stok Produk">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="review-content-section">
                                                            <div class="input-group mg-b-pro-edt">
                                                                <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                                                                <textarea required="" class="form-control" name="deskripsi_produk" rows="4" placeholder="Deskripsi Produk"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="text-center mg-b-pro-edt custom-pro-edt-ds">
                                                            <button name="simpan" type="submit" class="btn btn-primary waves-effect waves-light m-r-10">Simpan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <?php 
                                            if (isset($_POST['simpan'])) {
                                                $foto_produk = $_FILES['foto_produk']['name'];
                                                $lokasi = $_FILES['foto_produk']['tmp_name'];
                                                move_uploaded_file($lokasi, "foto_produk/".$foto_produk);

                                                $nama_produk = filter_input(INPUT_POST, 'nama_produk', FILTER_SANITIZE_SPECIAL_CHARS);
                                                $harga_produk = filter_input(INPUT_POST, 'harga_produk', FILTER_SANITIZE_SPECIAL_CHARS);
                                                $berat_produk = filter_input(INPUT_POST, 'berat_produk', FILTER_SANITIZE_SPECIAL_CHARS);
                                                $deskripsi_produk = filter_input(INPUT_POST, 'deskripsi_produk', FILTER_SANITIZE_SPECIAL_CHARS);
                                                $stok_produk = filter_input(INPUT_POST, 'stok_produk', FILTER_SANITIZE_SPECIAL_CHARS);

                                                $ambil = $dbh->prepare('INSERT INTO produk (nama_produk, harga_produk, berat_produk, foto_produk, deskripsi_produk, stok_produk) VALUES (:nama_produk, :harga_produk, :berat_produk, :foto_produk, :deskripsi_produk, :stok_produk)');

                                                $ambil->bindParam(':nama_produk', $nama_produk, PDO::PARAM_STR);
                                                $ambil->bindParam(':harga_produk', $harga_produk, PDO::PARAM_STR);
                                                $ambil->bindParam(':berat_produk', $berat_produk, PDO::PARAM_STR);
                                                $ambil->bindParam(':foto_produk', $foto_produk);
                                                $ambil->bindParam(':deskripsi_produk', $deskripsi_produk, PDO::PARAM_STR);
                                                $ambil->bindParam(':stok_produk', $stok_produk, PDO::PARAM_STR);
                                                $ambil->execute();

                                                echo "<script>alert('Produk Telah Ditambahkan')</script>";
                                                echo "<script>location='index.php'</script>";
                                            }
                                            ?>
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
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>