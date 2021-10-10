<?php 
session_start();
include 'koneksi.php';

if (!isset($_SESSION["pelanggan"])) {
    echo "<script>alert('Silakan Login');</script>";
    echo "<script>location='login.php';</script>";
}

if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])) {
  echo "<script>alert('Keranjang Anda Kosong');</script>";
  echo "<script>location='produk.php';</script>";
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
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php include 'header.php'; ?>
    <section class="breadcrumb_part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner">
                        <h2>keranjang belanja</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="cart_area" style="padding-top: 50px">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <form method="post">
                        <table class="table" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php $totalbelanja=0; ?>
                                    <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
                                    <?php
                                    $ambil = $dbh->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                                    $pecah = $ambil->fetch(PDO::FETCH_ASSOC);
                                    $subharga = $pecah["harga_produk"]*$jumlah;
                                    ?>
                                    <td>
                                        <img style="width: 150px" title="<?php echo $pecah["nama_produk"]; ?>" src="../admin.tokocapstone.rf.gd/foto_produk/<?php echo $pecah["foto_produk"]; ?>" alt="" />
                                    </td>
                                    <td>
                                        <h5>Rp<?php echo number_format($pecah["harga_produk"],0,",","."); ?></h5>
                                    </td>
                                    <td>
                                        <h5><?php echo $jumlah; ?></h5>
                                    </td>
                                    <td>
                                        <h5>Rp<?php echo number_format($subharga,0,",","."); ?></h5>
                                    </td>
                                    <td>
                                        <a href="hapus.php?id=<?php echo $id_produk ?>" class=" btn_3 genric-btn primary">hapus</a>
                                    </td>
                                </tr>
                                <?php $totalbelanja+=$subharga; ?>
                                <?php endforeach ?>
                                <tr class="bottom_button">
                                    <td>
                                        <a class="btn_1" href="produk.php">Lanjut Belanja</a>
                                    </td>
                                    <td></td>
                                    <td>
                                        <h5>TOTAL</h5>
                                    </td>
                                    <td>
                                        <h5>Rp<?php echo number_format($totalbelanja,0,",","."); ?></h5>
                                    </td>
                                    <td></td>
                                  </tr>
                                  <tr class="shipping_area">
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <h5>Daerah Pengiriman</h5>
                                    </td>
                                    <td></td>
                                    <td>
                                        <div class="shipping_box">
                                            <ul class="list">
                                                <?php
                                                $ambil = $dbh->query("SELECT * FROM ongkir");
                                                while ($perongkir = $ambil->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <li>
                                                    <?php echo $perongkir['nama_kota'] ?> : Rp <?php echo number_format($perongkir['tarif'],0,",",".") ?>
                                                    <input required name="id_ongkir" value="<?php echo $perongkir["id_ongkir"] ?>" type="radio" aria-label="Radio button for following text input">
                                                    <?php } ?>
                                                </li>
                                            </ul>
                                            <br>
                                            <?php 
                                            $id_pelanggan = $_COOKIE['id_pelanggan'];
                                            $ambil = $dbh->query("SELECT alamat_pelanggan FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
                                            $akun = $ambil->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <h5>Alamat Pengiriman</h5>
                                            <br>
                                            <input type="text" name="alamat_pengiriman" class="post_code" required="" placeholder="Alamat Pengiriman" value="<?php echo $akun["alamat_pelanggan"]; ?>">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="checkout_btn_inner float-right">
                            <button class="btn_1" name="checkout">Proses</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <?php 
        if (isset($_POST["checkout"])) {
            $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
            $id_ongkir = $_POST["id_ongkir"];
            $tanggal_pembelian = date("Y-m-d");
            $alamat_pengiriman = filter_input(INPUT_POST, 'alamat_pengiriman', FILTER_SANITIZE_SPECIAL_CHARS);

            $ambil = $dbh->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
            $ambil->execute();
            $arrayongkir = $ambil->fetch(PDO::FETCH_ASSOC);

            $nama_kota = $arrayongkir['nama_kota'];
            $tarif = $arrayongkir['tarif'];
            $total_pembelian = $totalbelanja + $tarif;

            $ambil = $dbh->prepare('INSERT INTO pembelian (id_pelanggan, id_ongkir, tanggal_pembelian, total_pembelian, nama_kota, tarif, alamat_pengiriman) VALUES (:id_pelanggan, :id_ongkir, :tanggal_pembelian, :total_pembelian, :nama_kota, :tarif, :alamat_pengiriman)');

            $ambil->bindParam(':id_pelanggan', $id_pelanggan);
            $ambil->bindParam(':id_ongkir', $id_ongkir);
            $ambil->bindParam(':tanggal_pembelian', $tanggal_pembelian);
            $ambil->bindParam(':total_pembelian', $total_pembelian);
            $ambil->bindParam(':nama_kota', $nama_kota);
            $ambil->bindParam(':tarif', $tarif);
            $ambil->bindParam(':alamat_pengiriman', $alamat_pengiriman, PDO::PARAM_STR);
            $ambil->execute();

            $id_pembelian = $dbh->lastInsertId();

            foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) {
                $ambil = $dbh->query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
                $ambil->execute();
                $perproduk = $ambil->fetch(PDO::FETCH_ASSOC);
                $nama = $perproduk['nama_produk'];
                $harga = $perproduk['harga_produk'];
                $berat = $perproduk['berat_produk'];
                $subberat = $perproduk['berat_produk']*$jumlah;
                $subharga = $perproduk['harga_produk']*$jumlah;
                $stok_produk = $perproduk['stok_produk']-$jumlah;

                $ambil = $dbh->prepare('INSERT INTO pembelian_produk (id_pembelian, id_produk, nama, harga, berat, subberat, subharga, jumlah) VALUES (:id_pembelian, :id_produk,:nama, :harga, :berat, :subberat, :subharga, :jumlah)');
                
                $ambil->bindParam(':id_pembelian', $id_pembelian);
                $ambil->bindParam(':id_produk', $id_produk);
                $ambil->bindParam(':nama', $nama);
                $ambil->bindParam(':harga', $harga);
                $ambil->bindParam(':berat', $berat);
                $ambil->bindParam(':subberat', $subberat);
                $ambil->bindParam(':subharga', $subharga);
                $ambil->bindParam(':jumlah', $jumlah);
                $ambil->execute();

                $ambil = $dbh->prepare('UPDATE produk SET stok_produk = :stok_produk WHERE id_produk = :id_produk');
                $ambil->bindParam(':stok_produk', $stok_produk);
                $ambil->bindParam(':id_produk', $id_produk);
                $ambil->execute();
            }
            unset($_SESSION["keranjang"]);
            echo "<script>location='nota.php?id=$id_pembelian'</script>";
        }
        ?>
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