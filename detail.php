<?php session_start(); ?>
<?php include 'koneksi.php'; ?>
<?php
    $id_produk = $_GET['id'];
    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk' ");
    $detail = $ambil->fetch_assoc();

    // echo "<pre>";
    // print_r($detail);
    // echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Produk</title>
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
            <h1>Detail Produk</h1>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <img src="foto_produk/<?=$detail['foto_produk']; ?>" class="img-responsive" alt="error">
                </div>
                <div class="col-md-6">
                    <h2><?=$detail['nama_produk']; ?></h2>
                    <h4>Rp. <?=number_format($detail['harga_produk']); ?></h4>
                    <h5>Stok : <?=$detail['stok_produk']; ?></h5>

                    <form method="post">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" class="form-control" min="1" max="<?=$detail['stok_produk']; ?>" name="jumlah" value="1" required>
                                <div class="input-group-btn">
                                    <button class="btn btn-success" name="beli"><i class="fa fa-shopping-cart"></i> Beli</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Jika tombol beli ditekan -->
                    <?php
                        if(isset($_POST['beli'])) {
                            // mendapatkan jumlah yang diimputkan
                            $jumlah = $_POST['jumlah'];
                            // masukkan ke keranjang belanja
                            $_SESSION['keranjang'][$id_produk] = $jumlah;

                            echo "<script>alert('Produk berhasil dimasukkan ke keranjang!')</script>";
                            echo "<script>location ='keranjang.php';</script>";
                        }
                    ?>

                    <p><?=$detail['berat_produk']; ?> Gr</p>  
                    <p><?=$detail['deskripsi_produk']; ?></p>
                </div>
            </div>
        </div>
    </section>

    <script src="admin/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="admin/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>