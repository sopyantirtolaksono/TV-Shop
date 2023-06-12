<?php
    session_start();

    if(empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])) {
        echo "<script>alert('Keranjang anda kosong, silahkan belanja dulu!')</script>";
        echo "<script>location ='index.php';</script>";
    };
    
    // echo "<pre>";
    // print_r(($_SESSION['keranjang']));
    // echo "</pre>";

    include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BekhanTV | keranjang</title>
    <link rel="stylesheet" href="admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/assets/bower_components/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/menu.css">
</head>
<body>
    <!-- Navbar -->
    <?php include 'menu.php'; ?>

    <!-- Content -->
    <section class="konten">
        <div class="container">
            <h1>Keranjang Belanja</h1>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Produk</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Sub Harga</th>
                            <th class="text-center">Hapus</th>  
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach($_SESSION['keranjang'] as $id_produk => $jumlah) : ?>
                        <?php 
                        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk' ");
                        $pecah = $ambil->fetch_assoc();
                        $subharga = $pecah['harga_produk'] * $jumlah;
                        ?>
                        <tr>
                            <td><?=$no; ?></td>
                            <td><?=$pecah['nama_produk']; ?></td>
                            <td>Rp. <?=number_format($pecah['harga_produk']); ?></td>
                            <td><?=$jumlah; ?></td>
                            <td>Rp. <?=number_format($subharga); ?></td>
                            <td><a href="hapuskeranjang.php?id=<?=$id_produk; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a></td>
                        </tr>
                        <?php $no++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <a href="index.php" class="btn btn-default"><i class="fa fa-shopping-cart"></i> Lanjut Belanja</a>
            <a href="checkout.php" class="btn btn-success"><i class="fa fa-check"></i> Checkout</a>
        </div>
    </section>

    <script src="admin/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="admin/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
</body>
</html>