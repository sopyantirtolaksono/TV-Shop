<?php
	if(!isset($_SESSION['admin'])) {
		echo "<script>location ='login.php';</script>";
		header('location: login.php');
		exit();
	}
?>

<h2 class="text-center">Detail Pembelian</h2>
<?php 
	$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.id_pembelian = '$_GET[id]' ");
	$detail = $ambil->fetch_assoc();
?>

<!-- <pre><?php //print_r($detail); ?></pre> -->

<div class="row">
	<div class="col-md-4">
		<h3>Pembelian</h3>
		<p>
			Tanggal : <?=$detail['tanggal_pembelian']; ?> <br>
			Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Rp. <?=number_format($detail['total_pembelian']); ?> <br>
			Status : <?=$detail['status_pembelian']; ?>
		</p>
	</div>
	<div class="col-md-4">
		<h3>Pelanggan</h3>
		<strong><?=$detail['nama_pelanggan']; ?></strong> <br>
		<p>
			Telepon : <?=$detail['telepon_pelanggan']; ?> <br>
			Email &nbsp;&nbsp;&nbsp;&nbsp; : <?=$detail['email_pelanggan']; ?>
		</p>
	</div>
	<div class="col-md-4">
		<h3>Pengiriman</h3>
		<strong><?=$detail['nama_kota']; ?></strong> <br>
		<p>
			Tarif : Rp. <?=number_format($detail['tarif']); ?> <br>
			Alamat : <?=$detail['alamat_pengiriman']; ?>
		</p>
	</div>
</div>

<br>

<div class="table-responsive">
	<table class="table table-bordered table-striped text-center">
		<thead>
			<tr>
				<th>No.</th>
				<th>Nama Produk</th>
				<th>Harga Produk</th>
				<th>Jumlah</th>
				<th>Subtotal</th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1; ?>
			<?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk = produk.id_produk WHERE pembelian_produk.id_pembelian = '$_GET[id]' "); ?>
			<?php while($pecah = $ambil->fetch_assoc()) { ?>
			<tr>
				<td><?=$no; ?></td>
				<td><?=$pecah['nama_produk']; ?></td>
				<td>Rp. <?=number_format($pecah['harga_produk']); ?></td>
				<td><?=$pecah['jumlah']; ?></td>
				<td>Rp. <?=$jml = number_format($pecah['harga_produk'] * $pecah['jumlah']); ?></td>
			</tr>
			<?php $no++; ?>
			<?php } ?>
		</tbody>
	</table>
</div>