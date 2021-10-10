<?php 
session_start();
include 'koneksi.php';

$jumlahdataperhalaman = 6;

$ambil = $dbh->query("SELECT * FROM produk");
$jumlahdata = $ambil->rowCount();
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
$halamanaktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;

$ambil = $dbh->query("SELECT * FROM produk LIMIT $awaldata, $jumlahdataperhalaman");

if (isset($_POST["cari"])) {
    $keyword = $_POST["keyword"];
    $ambil = $dbh->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%'");
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
    <link rel="stylesheet" href="css/style1.css">
    <script src="js/jquery-3.5.0.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
    <?php include 'header.php'; ?>
    <section class="breadcrumb_part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner">
                        <h2>daftar produk</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product_list" style="padding-top: 50px;">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="product_sidebar" style="padding-top: 25px;">
                        <div class="single_sedebar">
                            <form action="produk.php" method="POST">
                                <input type="text" name="keyword" placeholder="Cari Produk..." autocomplete="off" id="keyword">
                                <button type="submit" name="cari" id="tombol-cari"></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8" id="container">
                    <div class="product_list" style="padding-top: 25px;">
                        <div class="row">
                            <?php while($perproduk=$ambil->fetch(PDO::FETCH_ASSOC)) { ?>
                            <div class="col-lg-6 col-sm-6" style="text-align: center">
                                <div class="single_product_item" style="padding-bottom: 50px">
                                    <a title="<?php echo $perproduk['nama_produk']; ?>" href="detail.php?id=<?php echo $perproduk["id_produk"] ?>">
                                    <img style="height: 320px" src="../admin.tokocapstone.rf.gd/foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="" class="img-fluid">
                                    </a>
                                    <h3><a href="detail.php?id=<?php echo $perproduk["id_produk"] ?>"><?php echo $perproduk['nama_produk']; ?></a></h3>
                                    <p>Rp <?php echo number_format($perproduk['harga_produk'],0,",","."); ?></p>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                <?php if($halamanaktif > 1) : ?>
                                <li class="page-item">
                                    <a href="?halaman=<?= $halamanaktif - 1; ?>" class="page-link" title="Previous" aria-label="Previous"><i class="ti-angle-left"></i></a>
                                </li>
                                <?php endif; ?>

                                <?php for($i=1 ; $i<=$jumlahhalaman; $i++) : ?>
                                    <?php if($i == $halamanaktif) : ?>
                                    <li class="page-item">
                                        <a style="color: purple" href="?halaman=<?=$i; ?>" class="page-link"><?= $i; ?></a>
                                    </li>
                                    <?php else : ?>
                                    <li class="page-item">
                                        <a href="?halaman=<?=$i; ?>" class="page-link"><?= $i; ?></a>
                                    </li>
                                    <?php endif; ?>
                                <?php endfor; ?>

                                <?php if($halamanaktif < $jumlahhalaman) : ?>
                                    <li class="page-item">
                                        <a href="?halaman=<?= $halamanaktif + 1; ?>" class="page-link" title="Next" aria-label="Next"><i class="ti-angle-right"></i></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
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