<?php
	if(!isset($_SESSION['admin'])) {
		echo "<script>location ='login.php';</script>";
		header('location: login.php');
		exit();
	}

	if(isset($_POST['save'])) {
		$nama = $_FILES['foto']['name'];
		$lokasi = $_FILES['foto']['tmp_name'];
		move_uploaded_file($lokasi, '../foto_produk/' . $nama);
		$koneksi->query("INSERT INTO produk(nama_produk, harga_produk, berat_produk, stok_produk, foto_produk, deskripsi_produk) VALUES('$_POST[nama]', '$_POST[harga]', '$_POST[berat]', '$_POST[stok]', '$nama', '$_POST[deskripsi]')");

		// echo "<br><div class='alert alert-success text-center'>Data berhasil disimpan</div>";
		// echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
		echo "<script>alert('Data berhasil disimpan')</script>";
		echo "<script>location ='index.php?halaman=produk';</script>";
	}
?>

<h2 class="text-center">Tambah Produk</h2>
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="nama">Nama </label>
		<input type="text" name="nama" class="form-control">
	</div>
	<div class="form-group">
		<label for="harga">Harga (Rp)</label>
		<input type="number" name="harga" class="form-control">
	</div>
	<div class="form-group">
		<label for="berat">Berat (Gr)</label>
		<input type="number" name="berat" class="form-control">
	</div>
	<div class="form-group">
		<label for="stok">Stok</label>
		<input type="number" name="stok" class="form-control">
	</div>
	<div class="form-group">
		<label for="deskripsi">Deskripsi </label>
		<textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control"></textarea>
	</div>
	<div class="form-group">
		<label for="foto">Foto </label>
		<input type="file" name="foto" class="form-control">
	</div>
	<button class="btn btn-primary" name="save"><i class="fa fa-save"></i> Simpan</button>
	<a href="index.php?halaman=produk" class="btn btn-warning"><i class="fa fa-undo"></i> Kembali</a>
</form>