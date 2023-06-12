<?php

	if(!isset($_SESSION['admin'])) {
		echo "<script>location ='login.php';</script>";
		header('location: login.php');
		exit();
	}

	// pagination
	// $jmlDataPerhalaman = 10;
	$result = mysqli_query($koneksi, "SELECT * FROM pelanggan");
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}

	$jmlData = count($rows);
	
	$jmlHalaman = ceil($jmlData / 10);

	$halamanAktif3 = ( isset($_GET['halamanaktif3']) ) ? $_GET['halamanaktif3'] : 1;

	$halamanAwal = ( 10 * $halamanAktif3) - 10;

?>

<h2 class="">Data Pelanggan</h2>
<div class="table-responsive">
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>No.</th>
				<th>Nama Pelanggan</th>
				<th>Telepon Pelanggan</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1; ?>
			<?php $ambil = $koneksi->query("SELECT * FROM pelanggan LIMIT $halamanAwal, 10"); ?>
			<?php while($pecah = $ambil->fetch_assoc()) { ?>
			<tr>
				<td><?=$no; ?></td>
				<td><?=$pecah['nama_pelanggan']; ?></td>
				<td><?=$pecah['telepon_pelanggan'] ?></td>
				<td><a href="index.php?halaman=hapus_pelanggan&id=<?=$pecah['id_pelanggan']; ?>" onclick="return confirm('Yakin ingin hapus data ini ?')" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a></td>
			</tr>
			<?php $no++; ?>
			<?php } ?>
		</tbody>
	</table>
</div>

<div class="panel-footer">
	<div class="row">
		<div class="col col-xs-4">
			<strong>Page <?php echo $halamanAktif3; ?> of <?php echo $jmlHalaman; ?></strong>
		</div>
		<div class="col col-xs-8">
			<ul class="pagination hidden-xs pull-right">

				<?php for($i = 1; $i <= $jmlHalaman; $i++) : ?>
				<?php if($i == $halamanAktif3) : ?>
					<li class="active"><a href="?halamanaktif3=<?=$i; ?>"><?=$i; ?></a></li>
				<?php else : ?>
					<li><a href="?halamanaktif3=<?=$i; ?>"><?=$i; ?></a></li>
				<?php endif; ?>
				<?php endfor; ?>

			</ul>
			<ul class="pagination visible-xs pull-right">
				<?php if($halamanAktif3 > 1) : ?>
					<li><a href="?halamanaktif3=<?=$halamanAktif3 - 1; ?>"><i class="fa fa-angle-double-left"></i></a></li>
				<?php endif; ?>
				<?php if($halamanAktif3 < $jmlHalaman) : ?>
					<li><a href="?halamanaktif3=<?=$halamanAktif3 + 1; ?>"><i class="fa fa-angle-double-right"></i></a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</div>

