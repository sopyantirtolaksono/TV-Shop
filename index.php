<?php
    session_start();
    include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BekhanTV | Beranda</title>
    <link rel="stylesheet" href="admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/assets/bower_components/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/menu.css">
    <link rel="stylesheet" href="assets/slider.css">
    <link rel="stylesheet" href="assets/footer.css">
    <!-- <link rel="stylesheet" href="assets/background_body.css"> -->
</head>
<body>
    <!-- navbar -->
    <?php include 'menu.php'; ?>

    <!-- slider -->
    <?php include 'slider.php'; ?>

    <!-- content -->
    <section class="konten">
        <div class="container">
            <h1>Produk Terbaru</h1>
            <br>
            <div class="row">
                <?php $ambil = $koneksi->query('SELECT * FROM produk ORDER BY id_produk DESC'); ?>
                <?php while($perproduk = $ambil->fetch_assoc()) { ?>
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img src="foto_produk/<?=$perproduk['foto_produk']; ?>" alt="error" style="height:250px;">
                        <div class="caption text-center">
                            <h3 style="color:black;"><?=$perproduk['nama_produk']; ?></h3>
                            <h5 style="color:grey;">Rp. <?=number_format($perproduk['harga_produk']); ?></h5>
                            <a href="beli.php?id=<?=$perproduk['id_produk']; ?>" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Beli Sekarang</a>
                            <a href="detail.php?id=<?=$perproduk['id_produk']; ?>" class="btn btn-primary"><i class="fa fa-list"></i> Detail</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="admin/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="admin/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>