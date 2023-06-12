<?php
	if(!isset($_SESSION['admin'])) {
		echo "<script>location ='login.php';</script>";
		header('location: login.php');
		exit();
	}

	// pagination
	// $jmlDataPerhalaman = 10;
	$result = mysqli_query($koneksi, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan");
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}

	$jmlData = count($rows);
	$jmlHalaman = ceil($jmlData / 10);

	$halamanAktif2 = ( isset($_GET['halamanaktif2']) ) ? $_GET['halamanaktif2'] : 1;

	$halamanAwal = ( 10 * $halamanAktif2) - 10;
?>

<h2>Data Pembelian</h2>

<div class="table-responsive">
	<table class="table table-bordered table-striped text-center">
		<thead>
			<tr>
				<th>No.</th>
				<th>Nama Pelanggan</th>
				<th>Tanggal</th>
				<th>Status Pembelian</th>
				<th>Total</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>

			<?php
				$no = 1;
				$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan LIMIT $halamanAwal, 10");
				while($pecah = $ambil->fetch_assoc()) {
			?>

			<tr>
				<td><?=$no; ?></td>
				<td><?=$pecah['nama_pelanggan']; ?></td>
				<td><?=$pecah['tanggal_pembelian']; ?></td>
				<td><?=$pecah['status_pembelian']; ?></td>
				<td>Rp. <?=number_format($pecah['total_pembelian']); ?></td>
				<td>
					<a href="index.php?halaman=detail&id=<?=$pecah['id_pembelian']; ?>" class="btn btn-info"><i class="fa fa-list"></i> Detail</a>

					<?php if($pecah['status_pembelian'] != 'Pending') : ?>
					<a href="index.php?halaman=pembayaran&id=<?=$pecah['id_pembelian']; ?>" class="btn btn-success"><i class="fa fa-dollar"></i> Pembayaran</a>
					<?php endif; ?>
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
			<strong>Page <?php echo $halamanAktif2; ?> of <?php echo $jmlHalaman; ?></strong>
		</div>
		<div class="col col-xs-8">
			<ul class="pagination hidden-xs pull-right">

				<?php for($i = 1; $i <= $jmlHalaman; $i++) : ?>
				<?php if($i == $halamanAktif2) : ?>
					<li class="active"><a href="?halamanaktif2=<?=$i; ?>"><?=$i; ?></a></li>
				<?php else : ?>
					<li><a href="?halamanaktif2=<?=$i; ?>"><?=$i; ?></a></li>
				<?php endif; ?>
				<?php endfor; ?>

			</ul>
			<ul class="pagination visible-xs pull-right">
				<?php if($halamanAktif2 > 1) : ?>
					<li><a href="?halamanaktif2=<?=$halamanAktif2 - 1; ?>"><i class="fa fa-angle-double-left"></i></a></li>
				<?php endif; ?>
				<?php if($halamanAktif2 < $jmlHalaman) : ?>
					<li><a href="?halamanaktif2=<?=$halamanAktif2 + 1; ?>"><i class="fa fa-angle-double-right"></i></a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</div>