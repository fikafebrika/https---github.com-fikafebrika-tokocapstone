<?php 
require 'koneksi.php';

$ambil = $dbh->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch(PDO::FETCH_ASSOC);

$fotoproduk = $pecah['foto_produk'];
if (file_exists("foto_produk/$fotoproduk")) {
	unlink("foto_produk/$fotoproduk");
}

$ambil = $dbh->query("DELETE FROM produk WHERE id_produk='$_GET[id]'");

echo "<script>alert('Produk Berhasil Dihapus');</script>";
echo "<script>location='index.php';</script>";