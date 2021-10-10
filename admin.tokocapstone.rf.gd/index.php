<?php 
session_start();

require 'koneksi.php';
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='login.php';</script>";
  
    header('location:login.php');
    exit();
}

$jumlahdataperhalaman = 6;

$ambil = $dbh->query("SELECT * FROM produk");
$jumlahdata = $ambil->rowCount();
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
$halamanaktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;

$ambil = $dbh->query("SELECT * FROM produk LIMIT $awaldata, $jumlahdataperhalaman");

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
                                <h4>Daftar Produk</h4>
                                <div class="add-product">
                                    <a href="tambah.php">Tambah Produk</a>
                                </div>
                                <table>
                                    <tr>
                                        <th>No.</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Berat</th>
                                        <th>Stok</th>
                                        <th>Pilihan</th>
                                    </tr>
                                    <?php $nomor=1; ?>
                                    <?php while($pecah = $ambil->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <tr>
                                        <td><?php echo $nomor; ?></td>
                                        <td>
                                            <img title="<?php echo $pecah['nama_produk']; ?>" style="width: 100px;" src="foto_produk/<?php echo $pecah['foto_produk']; ?>">
                                        </td>
                                        <td><?php echo $pecah['nama_produk']; ?></td>
                                        <td><?php echo number_format($pecah['harga_produk'],0,",","."); ?></td>
                                        <td><?php echo $pecah['berat_produk']; ?></td>
                                        <td><?php echo $pecah['stok_produk']; ?></td>
                                        <td>
                                            <button data-toggle="tooltip" title="Ubah" class="pd-setting-ed">
                                                <a style="color: black" class="fa fa-pencil-square-o" aria-hidden="true"<?php echo "href='ubah.php?id=$pecah[id_produk]'";?>></a>
                                            </button>
                                            <button data-toggle="tooltip" title="Hapus" class="pd-setting-ed">
                                                <a style="color: black"class="fa fa-trash-o" aria-hidden="true"<?php echo "<a href='hapus.php?id=$pecah[id_produk]'";?>></a>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php $nomor++; ?>
                                    <?php } ?>
                                </table>
                                <div class="custom-pagination">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                <?php if($halamanaktif > 1) : ?>
                                            <li class="page-item"><a class="page-link" href="?halaman=<?= $halamanaktif - 1; ?>">Previous</a></li>
                                <?php endif; ?>

                                <?php for($i=1 ; $i<=$jumlahhalaman; $i++) : ?>
                                    <?php if($i == $halamanaktif) : ?>
                                            <li class="page-item"><a style="color: red" class="page-link" href="?halaman=<?=$i; ?>"><?= $i; ?></a></li>
                                    <?php else : ?>
                                            <li class="page-item"><a class="page-link" href="?halaman=<?=$i; ?>"><?= $i; ?></a></li>
                                    <?php endif; ?>
                                <?php endfor; ?>

                                <?php if($halamanaktif < $jumlahhalaman) : ?>
                                            <li class="page-item"><a class="page-link" href="?halaman=<?= $halamanaktif + 1; ?>">Next</a></li>
                                <?php endif; ?>
                                        </ul>
                                    </nav>
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