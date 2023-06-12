<?php 
    session_start();
    include 'koneksi.php'; 
?>

<?php
    $keyword = $_GET['keyword'];
    $semuaData = array();

    $ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%' ");
    while($pecah = $ambil->fetch_assoc()) {
        $semuaData[] = $pecah;
    }

    // echo "<pre>";
    // print_r($semuaData);
    // echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pencarian</title>
    <link rel="stylesheet" href="admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/assets/bower_components/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/menu.css">
</head>
<body>

    <?php include 'menu.php' ?>
    
    <div class="container">
        <h3>Hasil Pencarian : <?=$keyword; ?></h3>

        <?php if(empty($semuaData)) : ?>
            <div class="alert alert-danger">Produk <?=$keyword; ?> tidak ditemukan!</div>
        <?php endif; ?>

        <div class="row">

            <?php foreach($semuaData as $key => $value) : ?>
            <div class="col-md-4">
                <div class="thumbnail">
                    <img src="foto_produk/<?=$value['foto_produk']; ?>" class="img-responsive" alt="error" style="height:250px;">
                    <div class="caption text-center">
                        <h3><?=$value['nama_produk']; ?></h3>
                        <h5>Rp. <?=number_format($value['harga_produk']); ?></h5>
                        <a href="beli.php?id=<?=$value['id_produk']; ?>" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Beli Sekarang</a>
                        <a href="detail.php?id=<?=$value['id_produk']; ?>" class="btn btn-primary"><i class="fa fa-list"></i> Detail</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>

    <script src="admin/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="admin/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>