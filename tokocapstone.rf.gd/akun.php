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

$ambil = $dbh->query("SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
$akun = $ambil->fetch(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TOKO CAPSTONES</title>
    <link rel="icon" href="img/icon.jpg">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/slick.css">

		<!-- My Own CSS -->
    <link rel="stylesheet" href="css/style.css">
		
</head>
<body>
	<header class="main_menu home_menu">
		<div class="container">
			<div class="row align-items-center justify-content-center">
				<div class="col-lg-12">
					<nav class="navbar navbar-expand-lg navbar-light">
						<a class="navbar-brand" href="index.php" style="margin-left: 90px; color: purple">TOKO CAPSTONE</a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="menu_icon"><i class="fas fa-bars"></i></span>
						</button>
						<div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
							<ul class="navbar-nav">
								<li class="nav-item">
									<a class="nav-link" href="index.php">beranda</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="produk.php">produk</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="keranjang.php">keranjang</a>
								</li>
								<?php if (isset($_SESSION["pelanggan"])): ?>
								<li class="nav-item">
									<a class="nav-link" href="riwayat.php">riwayat</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="logout.php">logout</a>
								</li>
								<?php else: ?>
								<li class="nav-item">
									<a class="nav-link" href="login.php">login</a>
								</li>
								<?php endif ?>
							</ul>
						</div>
						<?php if (isset($_SESSION["pelanggan"])): ?>
						<div class="hearer_icon d-flex align-items-center">
							<a title="Ubah Password" href="ubah.php"><i class="ti-lock"></i></a>
						</div>
						<?php endif ?>
					</nav>
				</div>
			</div>
		</div>
	</header>
    <section class="breadcrumb_part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner">
                        <h2>Akun Anda</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<section class="contact-section" style="padding-top: 60px;">
		<div class="container">
			<div class="row">
				<div class="col-lg-4"></div>
				<div class="col-lg-4" style="padding-left: 70px;">
					<h2 class="contact-title">Informasi Akun &nbsp;
						<a title="Perbarui Akun" href="update.php">
							<span class="contact-info__icon">
								<i class="ti-pencil" style="font-size: 23px;"></i>
							</span>
						</a>
					</h2>
					<div class="media contact-info">
						<span class="contact-info__icon"><i title="Nama" class="ti-user"></i></span>
						<div class="media-body">
							<h3><?php echo $akun["nama_pelanggan"]; ?></h3>
						</div>
					</div>
					<div class="media contact-info">
						<span class="contact-info__icon"><i title="Email" class="ti-email"></i></span>
						<div class="media-body">
							<h3><?php echo $akun["email_pelanggan"]; ?></h3>
						</div>
					</div>
					<div class="media contact-info">
						<span class="contact-info__icon"><i title="Alamat Rumah" class="ti-home"></i></span>
						<div class="media-body">
							<h3><?php echo $akun["alamat_pelanggan"]; ?></h3>
						</div>
					</div>
					<div class="media contact-info">
						<span class="contact-info__icon"><i title="No. HP/ Telpon" class="ti-tablet"></i></span>
						<div class="media-body">
							<h3><?php echo $akun["telepon_pelanggan"]; ?></h3>
						</div>
					</div>
					<div class="media contact-info"></div>
					<h2 class="contact-title">Transaksi Anda</h2>
					<?php 
					$ambil = $dbh->query("SELECT COUNT(id_pelanggan) AS jumlah_pembelian FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
					$akun = $ambil->fetch(PDO::FETCH_ASSOC);
					?>
					<div class="media contact-info">
						<span class="contact-info__icon"><i title="Pemesanan" class="ti-shopping-cart"></i></span>
						<div class="media-body">
							<h3><?php echo $akun["jumlah_pembelian"]; ?> Pemesanan</h3>
						</div>
					</div>
					<?php 
					$ambil = $dbh->query("SELECT COUNT(id_pelanggan) AS jumlah_pembayaran FROM pembelian JOIN pembayaran 
											ON pembelian.id_pembelian=pembayaran.id_pembelian WHERE pembelian.id_pelanggan='$id_pelanggan'");
					$akun = $ambil->fetch(PDO::FETCH_ASSOC);
					?>
					<div class="media contact-info">
						<span class="contact-info__icon"><i title="Pembayaran" class="ti-money"></i></span>
						<div class="media-body">
							<h3><?php echo $akun["jumlah_pembayaran"]; ?> Pembayaran</h3>
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