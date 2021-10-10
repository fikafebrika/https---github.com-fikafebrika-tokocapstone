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
            <div class="single-product-tab-area mg-tb-15">
                <div class="single-pro-review-area">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="review-tab-pro-inner">
                                    <ul id="myTab3" class="tab-review-design">
                                        <li class="active">
                                            <a href="tambah.php"><i class="fa fa-pencil" aria-hidden="true"></i> Ubah Produk</a>
                                        </li>
                                    </ul>
                                    <div id="myTabContent" class="tab-content custom-product-edit">
                                        <div class="product-tab-list tab-pane fade active in" id="description">
                                        <?php 
                                        $ambil = $dbh->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
                                        $pecah = $ambil->fetch(PDO::FETCH_ASSOC);
                                        ?>
                                            <form method="post"z enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="review-content-section">
                                                            <div class="input-group mg-b-pro-edt">
                                                                <span class="input-group-addon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                                                <input required="" type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_produk']; ?>" placeholder="Nama Produk">
                                                            </div>
                                                            <div class="input-group mg-b-pro-edt">
                                                                <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                                                                <input required="" type="text" class="form-control" name="harga" value="<?php echo $pecah['harga_produk']; ?>" placeholder="Harga Produk (Rp)">
                                                            </div>
                                                            <div class="input-group mg-b-pro-edt">
                                                                <span class="input-group-addon"><i class="fa fa-inbox" aria-hidden="true"></i></span>
                                                                <input required="" type="number" class="form-control" name="berat" value="<?php echo $pecah['berat_produk']; ?>" placeholder="Berat Produk (Gr)">
                                                            </div>
                                                            <div class="input-group mg-b-pro-edt">
                                                                <span class="input-group-addon"><i class="fa fa-cube" aria-hidden="true"></i></span>
                                                                <input required="" type="number" class="form-control" name="stok" value="<?php echo $pecah['stok_produk']; ?>" placeholder="Stok Produk">
                                                            </div>
                                                            <div class="input-group mg-b-pro-edt">
                                                                <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                                                                <textarea required="" class="form-control" name="deskripsi" rows="4" placeholder="Deskripsi Produk"><?php echo $pecah['deskripsi_produk']; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="review-content-section">
                                                            <div class="input-group mg-b-pro-edt">
                                                                <span class="input-group-addon"><i class="fa fa-image" aria-hidden="true"></i></span>
                                                                <input readonly="" class="form-control" placeholder="Ganti Foto Produk" value="<?php echo $pecah['foto_produk']; ?>">
                                                                <input accept="image/*" type="file" class="form-control" name="foto">
                                                            </div>
                                                            <div class="input-group mg-b-pro-edt">
                                                                <img src="foto_produk/<?php echo $pecah['foto_produk'] ?>" style="height: 269px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="text-center mg-b-pro-edt custom-pro-edt-ds">
                                                            <button name="ubah" type="submit" class="btn btn-primary waves-effect waves-light m-r-10">Ubah</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <?php 
                                            if (isset($_POST['ubah'])) {
                                                $namafoto = $_FILES['foto']['name'];
                                                $lokasifoto = $_FILES['foto']['tmp_name'];
                                                
                                                $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_SPECIAL_CHARS);
                                                $harga = filter_input(INPUT_POST, 'harga', FILTER_SANITIZE_SPECIAL_CHARS);
                                                $berat = filter_input(INPUT_POST, 'berat', FILTER_SANITIZE_SPECIAL_CHARS);
                                                $deskripsi = filter_input(INPUT_POST, 'deskripsi', FILTER_SANITIZE_SPECIAL_CHARS);
                                                $stok = filter_input(INPUT_POST, 'stok', FILTER_SANITIZE_SPECIAL_CHARS);
                                                
                                                if (!empty($lokasifoto)) {
                                                    move_uploaded_file($lokasifoto, "foto_produk/$namafoto");

                                                    $ambil = $dbh->prepare("UPDATE produk SET nama_produk=:nama, harga_produk=:harga, berat_produk=:berat, foto_produk=:foto, deskripsi_produk=:deskripsi, stok_produk=:stok WHERE id_produk='$_GET[id]'");
                                                
                                                    $ambil->bindParam(':nama', $nama, PDO::PARAM_STR);
                                                    $ambil->bindParam(':harga', $harga, PDO::PARAM_STR);
                                                    $ambil->bindParam(':berat', $berat, PDO::PARAM_STR);
                                                    $ambil->bindParam(':foto', $namafoto);
                                                    $ambil->bindParam(':deskripsi', $deskripsi, PDO::PARAM_STR);
                                                    $ambil->bindParam(':stok', $stok, PDO::PARAM_STR);
                                                    $ambil->execute();

                                                } else {
                                                    $ambil = $dbh->prepare("UPDATE produk SET nama_produk=:nama, harga_produk=:harga, berat_produk=:berat, deskripsi_produk=:deskripsi, stok_produk=:stok WHERE id_produk='$_GET[id]'");
                                                    
                                                    $ambil->bindParam(':nama', $nama, PDO::PARAM_STR);
                                                    $ambil->bindParam(':harga', $harga, PDO::PARAM_STR);
                                                    $ambil->bindParam(':berat', $berat, PDO::PARAM_STR);
                                                    $ambil->bindParam(':deskripsi', $deskripsi, PDO::PARAM_STR);
                                                    $ambil->bindParam(':stok', $stok, PDO::PARAM_STR);
                                                    $ambil->execute();
                                                }
                                                echo "<script>alert('Data Produk Berhasil Diubah');</script>";
                                                echo "<script>location='index.php';</script>";
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