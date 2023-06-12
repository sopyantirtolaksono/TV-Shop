<?php

	if(!isset($_SESSION['admin'])) {
		echo "<script>location ='login.php';</script>";
		header('location: login.php');
		exit();
	}

	// pagination
	// $jmlDataPerhalaman = 5;
	$result = mysqli_query($koneksi, "SELECT * FROM produk");
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}

	$jmlData = count($rows);
	$jmlHalaman = ceil($jmlData / 5);

	$halamanAktif = ( isset($_GET['halamanaktif']) ) ? $_GET['halamanaktif'] : 1;

	$halamanAwal = ( 5 * $halamanAktif) - 5;

?>

<h2>Data Produk</h2>
<a href="index.php?halaman=tambah_produk" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Produk</a>
<br><br>

<div class="table-responsive">
	<table class="table table-bordered table-striped text-center">
		<thead>
			<tr>
				<th>No.</th>
				<th>Nama</th>
				<th>Harga</th>
				<th>Berat</th>
				<th>Stok</th>
				<th>Foto</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1; ?>
			<?php $ambil = $koneksi->query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT $halamanAwal, 5 "); ?>
			<?php while($pecah = $ambil->fetch_assoc()) { ?>
			<tr>
				<td><?=$no; ?></td>
				<td><?=$pecah['nama_produk']; ?></td>
				<td>Rp. <?=number_format($pecah['harga_produk']); ?></td>
				<td><?=$pecah['berat_produk']; ?> (gr)</td>
				<td><?=$pecah['stok_produk']; ?></td>
				<td><img src="../foto_produk/<?=$pecah['foto_produk']; ?>" width="150" height="100"></td>
				<td>
					<a href="index.php?halaman=ubah_produk&id=<?=$pecah['id_produk']; ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
					<a href="index.php?halaman=hapus_produk&id=<?=$pecah['id_produk']; ?>" onclick="return confirm('Yakin ingin hapus data ini ?')" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
				</td>
			</tr>
			<?php $no++; ?>
			<?php } ?>
		</tbody>
	</table>
</div>

<div class="panel-footer">
	<div class="row">
		<div class="col col-xs-4">
			<strong>Page <?php echo $halamanAktif; ?> of <?php echo $jmlHalaman; ?></strong>
		</div>
		<div class="col col-xs-8">
			<ul class="pagination hidden-xs pull-right">

				<?php for($i = 1; $i <= $jmlHalaman; $i++) : ?>
				<?php if($i == $halamanAktif) : ?>
					<li class="active"><a href="?halamanaktif=<?=$i; ?>"><?=$i; ?></a></li>
				<?php else : ?>
					<li><a href="?halamanaktif=<?=$i; ?>"><?=$i; ?></a></li>
				<?php endif; ?>
				<?php endfor; ?>

			</ul>
			<ul class="pagination visible-xs pull-right">
				<?php if($halamanAktif > 1) : ?>
					<li><a href="?halamanaktif=<?=$halamanAktif - 1; ?>"><i class="fa fa-angle-double-left"></i></a></li>
				<?php endif; ?>
				<?php if($halamanAktif < $jmlHalaman) : ?>
					<li><a href="?halamanaktif=<?=$halamanAktif + 1; ?>"><i class="fa fa-angle-double-right"></i></a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</div>