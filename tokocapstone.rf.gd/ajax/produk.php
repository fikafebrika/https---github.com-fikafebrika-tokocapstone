<?php 
require '../koneksi.php';

$keyword = $_GET["keyword"];

$ambil = $dbh->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%'");

?>
<div class="product_list" style="padding-top: 25px;">
    <div class="row">
        <?php while($perproduk=$ambil->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="col-lg-6 col-sm-6" style="text-align: center">
                <div class="single_product_item" style="padding-bottom: 50px">
                    <a href="detail.php?id=<?php echo $perproduk["id_produk"] ?>">
                        <img style="width: 360px; height: 320px" src="../admin.tokocapstone.rf.gd/foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="" class="img-fluid">
                    </a>
                    <h3><a href="detail.php?id=<?php echo $perproduk["id_produk"] ?>"><?php echo $perproduk['nama_produk']; ?></a></h3>
                     <p>Rp <?php echo number_format($perproduk['harga_produk'],0,",","."); ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
