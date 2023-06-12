<?php 
	if(!isset($_SESSION['admin'])) {
		echo "<script>location ='login.php';</script>";
		header('location: login.php');
		exit();
	}

 	if(isset($_POST['ubah'])) {
 		$nama = $_FILES['foto']['name'];
 		$lokasi = $_FILES['foto']['tmp_name'];

 		if(!empty($lokasi)) {
 			move_uploaded_file($lokasi, "../foto_produk/$nama");

 			$koneksi->query("UPDATE produk SET nama_produk = '$_POST[nama]', harga_produk = '$_POST[harga]', berat_produk = '$_POST[berat]', stok_produk = '$_POST[stok]', foto_produk = '$nama', deskripsi_produk = '$_POST[deskripsi]' WHERE id_produk = '$_GET[id]' ");
 		}
 		else {
 			$koneksi->query("UPDATE produk SET nama_produk = '$_POST[nama]', harga_produk = '$_POST[harga]', berat_produk = '$_POST[berat]', stok_produk = '$_POST[stok]', deskripsi_produk = '$_POST[deskripsi]' WHERE id_produk = '$_GET[id]' ");
 		}

 		// echo "<br><div class='alert alert-success text-center'>Data berhasil diedit</div>";
		// echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
		echo "<script>alert('Data berhasil diedit')</script>";
		echo "<script>location ='index.php?halaman=produk';</script>";
 	}
?>

<h2 class="text-center">Edit Produk</h2>
<?php 
	$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$_GET[id]'");
	$pecah = $ambil->fetch_assoc();
 ?>
 <!-- <pre><?php //print_r($pecah); ?></pre> -->
 <form method="post" enctype="multipart/form-data">
 	<div class="form-group">
 		<label>Nama Produk</label>
 		<input type="text" name="nama" class="form-control" value="<?=$pecah['nama_produk']; ?>">
 	</div>
 	<div class="form-group">
 		<label>Harga (Rp)</label>
 		<input type="number" name="harga" class="form-control" value="<?=$pecah['harga_produk']; ?>">
 	</div>
 	<div class="form-group">
 		<label>Berat (Gr)</label>
 		<input type="number" name="berat" class="form-control" value="<?=$pecah['berat_produk']; ?>">
	</div>
	<div class="form-group">
 		<label>Stok</label>
 		<input type="number" name="stok" class="form-control" value="<?=$pecah['stok_produk']; ?>">
 	</div>
 	<div class="form-group">
 		<img src="../foto_produk/<?=$pecah['foto_produk']; ?>" width="200" height="150">
 	</div>
 	<div class="form-group">
 		<label>Ganti Foto Produk</label>
 		<input type="file" name="foto" class="form-control">
 	</div>
 	<div class="form-group">
 		<label>Deskripsi Produk</label>
 		<textarea name="deskripsi" class="form-control" rows="5"><?=$pecah['deskripsi_produk']; ?></textarea>
 	</div>
 	<button class="btn btn-primary" name="ubah"><i class="fa fa-save"></i> Simpan</button>
 	<a href="index.php?halaman=produk" class="btn btn-warning"><i class="fa fa-undo"></i> Kembali</a>
 </form>