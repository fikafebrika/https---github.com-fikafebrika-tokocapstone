<?php 
session_start();
include 'koneksi.php';

$id_produk = $_GET["id"];
$ambil = $dbh->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch(PDO::FETCH_ASSOC);
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
                        <h2><?php echo $detail["nama_produk"]; ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog_area" style="padding-top: 50px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img title="<?php echo $detail["nama_produk"]; ?>" class="card-img rounded-0" src="../admin.tokocapstone.rf.gd/foto_produk/<?php echo $detail["foto_produk"]; ?>" alt="">
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form method="post">
                        <div class="blog_right_sidebar">
                            <aside class="single_sidebar_widget post_category_widget">
                                <h4 class="">Stok : <?php echo $detail['stok_produk'] ?></h4>
                                <ul class="list cat-list">
                                    <li>
                                        <a href="#" class="d-flex">
                                            <p><?php echo $detail["deskripsi_produk"]; ?></p>
                                        </a>
                                    </li>
                                </ul>
                                <button name="beli" id="beli" class="btn_1">tambah ke keranjang</button>
                            </aside>
                        </div>
                        <div class="card_area">
                            <div class="product_count_area">
                                <p>Kuantitas</p>
                                <div class="product_count d-inline-block">
                                    <span class="product_count_item inumber-decrement"> <i class="ti-minus"></i></span>
                                    <input readonly class="product_count_item input-number" type="text" value="1" name="jumlah" min="1" max="<?php echo $detail['stok_produk'] ?>">
                                    <span class="product_count_item number-increment"> <i class="ti-plus"></i></span>
                                </div>
                                <p>Rp <?php echo number_format($detail["harga_produk"],0,",","."); ?></p>
                            </div>
                        </div>
                    </form>
                    <?php 
                    if (isset($_POST["beli"])) {
                        $jumlah = $_POST["jumlah"];
                        $_SESSION["keranjang"]["$id_produk"] = $jumlah;
                        echo "<script>location='keranjang.php'</script>";
                    }
                    ?>
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