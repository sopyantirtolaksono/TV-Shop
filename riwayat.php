<?php
    session_start();

    // jika tidak ada session pelanggan/belum login
    if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])) {
        echo "<script>alert('Silahkan anda login terlebih dahulu!')</script>";
        echo "<script>location ='login.php';</script>";
        exit();
    }

    include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Riwayat Belanja</title>
    <link rel="stylesheet" href="admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/assets/bower_components/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/menu.css">
</head>
<body>
    <!-- navbar -->
    <?php include 'menu.php'; ?>

    <!-- <pre><?php //print_r($_SESSION); ?></pre> -->

    <!-- Content -->
    <section class="riwayat">
        <div class="container">
            <h3>Riwayat Belanja <strong><?=$_SESSION['pelanggan']['nama_pelanggan']; ?></strong></h3>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // menampilkan nomor urut biasa
                        $no = 1;
                        // mendapatkan id_pelanggan yang login dari session
                        $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
                        $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan = '$id_pelanggan' ");
                        while($riwayat = $ambil->fetch_assoc()) { ?>
                        <tr>
                            <td><?=$no; ?></td>
                            <td><?=$riwayat['tanggal_pembelian']; ?></td>
                            <td><?=$riwayat['status_pembelian']; ?>
                            <br>
                            <?php if(!empty($riwayat['resi_pengiriman'])) : ?>
                            Resi : <?=$riwayat['resi_pengiriman']; ?>
                            <?php endif; ?>
                            </td>
                            <td>Rp. <?=number_format($riwayat['total_pembelian']); ?></td>
                            <td>
                                <a href="nota.php?id=<?=$riwayat['id_pembelian']; ?>" class="btn btn-info"><i class="fa fa-clipboard"></i> Nota</a>

                                <?php if($riwayat['status_pembelian'] == 'Pending') : ?>
                                <a href="pembayaran.php?id=<?=$riwayat['id_pembelian']; ?>" class="btn btn-success"><i class="fa fa-folder"></i> Input Pembayaran</a>

                                <?php else : ?>
                                <a href="lihat_pembayaran.php?id=<?=$riwayat['id_pembelian']; ?>" class="btn btn-warning"><i class="fa fa-eye"></i> Lihat Pembayaran</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php $no++; ?>
                        <?php } ?>
                    </tbody>
                </table>  
            </div>
        </div>
    </section>
    
    <script src="admin/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="admin/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>