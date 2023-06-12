<?php 
    session_start();
    include 'koneksi.php';
    $id_pembelian = $_GET['id'];

    $ambil = $koneksi->query("SELECT * FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian = pembelian.id_pembelian WHERE pembelian.id_pembelian = '$id_pembelian' ");
    $detail_pembayaran = $ambil->fetch_assoc();

    // echo "<pre>";
    // print_r($detail_pembayaran);
    // echo "</pre>";

    // jika belum ada data pembayaran
    if(empty($detail_pembayaran)) {
        echo "<script>alert('Belum ada data pembayaran!')</script>";
        echo "<script>location ='riwayat.php';</script>";
        exit();
    }

    // mendapatkan id_pelanggan yang beli
    $idPelangganYangBeli = $detail_pembayaran['id_pelanggan'];
    // mendapatkan id_pelanggan yang login
    $idPelangganYangLoginSession = $_SESSION['pelanggan']['id_pelanggan'];

    // jika $idPelangganYangBeli tidak sama dengan $idPelangganYangLoginSession maka jangan dibiarkan masuk & tendang ke halaman riwayat.php
    if($idPelangganYangBeli != $idPelangganYangLoginSession) {
        echo "<script>alert('Maaf! Akses anda ilegal.')</script>";
        echo "<script>location ='riwayat.php';</script>";
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lihat Pembayaran</title>
    <link rel="stylesheet" href="admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/assets/bower_components/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/menu.css">
</head>
<body>

    <?php include 'menu.php'; ?>

    <div class="container">
        <h2>Lihat Pembayaran</h2>
        <br>
        <div class="row">
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Nama</th>
                            <td><?=$detail_pembayaran['nama']; ?></td>
                        </tr>
                        <tr>
                            <th>Bank</th>
                            <td><?=$detail_pembayaran['bank']; ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td><?=$detail_pembayaran['tanggal']; ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td>Rp. <?=number_format($detail_pembayaran['jumlah']); ?> </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <img src="bukti_pembayaran/<?=$detail_pembayaran['bukti']; ?>" class="img-responsive" alt="error">
            </div>
        </div>
    </div>

    <script src="admin/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="admin/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
</body>
</html>