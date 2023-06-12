<?php 
	if(!isset($_SESSION['admin'])) {
		echo "<script>location ='login.php';</script>";
		header('location: login.php');
		exit();
	}

	$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$_GET[id]'");
	$pecah = $ambil->fetch_assoc();
	$foto_produk = $pecah['foto_produk'];

	if(file_exists("../foto_produk/$foto_produk")) {
		unlink("../foto_produk/$foto_produk");
	}

	$koneksi->query("DELETE FROM produk WHERE id_produk = '$_GET[id]'");

	echo "<script> location='index.php?halaman=produk'; </script>";
 ?>