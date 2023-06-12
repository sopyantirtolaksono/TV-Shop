<?php
    session_start();

    // jika tidak ada session pelanggan/belum login
    if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])) {
        echo "<script>alert('Silahkan anda login terlebih dahulu!')</script>";
        echo "<script>location ='login.php';</script>";
        exit();
    }

    include 'koneksi.php';

    // mendapatkan id_pembelian dari url
    $idpem = $_GET['id'];
    $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian = '$idpem' ");
    $detpem = $ambil->fetch_assoc();

    // mendapatkan id_pelanggan yang beli
    $idPelangganYangBeli = $detpem['id_pelanggan'];
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
    <title>Pembayaran</title>
    <link rel="stylesheet" href="admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/assets/bower_components/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/menu.css">
</head>
<body>
    <?php include 'menu.php'; ?>

    <div class="container">
        <h2>Konfirmasi Pembayaran</h2>
        <br>
        <strong><p class="text-success">Kirim bukti pembayaran anda disini!</p></strong>
        <div class="alert alert-info">Total tagihan anda Rp. <?=number_format($detpem['total_pembelian']); ?></div>

        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Penyetor</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="form-group">
            <label>Bank</label>
                <input type="text" class="form-control" name="bank" required>
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="jumlah" min="1" required>
            </div>
            <div class="form-group">
                <label>Foto Bukti</label>
                <input type="file" class="form-control" name="bukti" required>
                <em><p class="text-danger">* File harus berupa foto / gambar</p></em>
            </div>
            <button class="btn btn-primary" name="kirim"><i class="fa fa-send"></i> Kirim</button>
        </form>
    </div>

    <?php
        if(isset($_POST['kirim'])) {
            // upload dulu file bukti
            $namaBukti = $_FILES['bukti']['name'];
            $lokasiBukti = $_FILES['bukti']['tmp_name'];
            $namaFiks = date("YmdHis").$namaBukti;
            move_uploaded_file($lokasiBukti, "bukti_pembayaran/$namaFiks");

            // ambil semua data dari setiap field di form pembayaran
            $nama = $_POST['nama'];
            $bank = $_POST['bank'];
            $jumlah = $_POST['jumlah'];
            $tanggal = date("Y-m-d");

            // upload bukti ke database
            $koneksi->query("INSERT INTO pembayaran (id_pembelian, nama, bank, jumlah, tanggal, bukti) VALUES ('$idpem', '$nama', '$bank', '$jumlah', '$tanggal', '$namaFiks') ");

            // rubah status dari pending menjadi sudah terbayarkan
            $koneksi->query("UPDATE pembelian SET status_pembelian = 'Sudah kirim pembayaran' WHERE id_pembelian = '$idpem' ");

            echo "<script>alert('Terimakasih sudah melakukan pembayaran.')</script>";
            echo "<script>location ='riwayat.php';</script>";
        }
    ?>

    <script src="admin/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="admin/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>