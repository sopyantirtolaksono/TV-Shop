<?php 
	if(!isset($_SESSION['admin'])) {
		echo "<script>location ='login.php';</script>";
		header('location: login.php');
		exit();
	}

	$koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan = '$_GET[id]'");
	echo "<script> location='index.php?halaman=pelanggan'; </script>";
 ?>