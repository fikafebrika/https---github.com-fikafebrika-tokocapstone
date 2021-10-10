$(document).ready(function() {

	$('#tombol-cari').hide();
	
	$('#keyword').on('keyup', function() {
		$('#container').load('ajax/produk.php?keyword=' + $('#keyword').val());
	});

});
