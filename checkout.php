<?php 
    session_start();
    if(!isset($_SESSION['pelanggan'])) {
        echo "<script>alert('Silahkan login terlebih dahulu!')</script>";
        echo "<script>location='login.php';</script>";
    }

    if(!isset($_SESSION['keranjang']) OR empty($_SESSION['keranjang'])) {
        echo "<script>alert('Silahkan anda belanja dahulu!')</script>";
        echo "<script>location='index.php';</script>";
    }
    
    // echo "<pre>";
    // print_r($_SESSION['keranjang']);
    // echo "</pre>";
    include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BekhanTV | Checkout</title>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php $total_belanja = 0; ?>
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
                        </tr>
                        <?php $no++; ?>
                        <?php $total_belanja += $subharga; ?>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center" colspan="4">Total Belanja</th>
                            <th class="text-center">Rp. <?=number_format($total_belanja); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control" readonly value="<?=$_SESSION['pelanggan']['nama_pelanggan']; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control" readonly value="<?=$_SESSION['pelanggan']['telepon_pelanggan']; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="id_ongkir">
                            <option value="">Pilih ongkos kirim</option>

                            <?php $ambil = $koneksi->query("SELECT * FROM ongkir");
                            while($perongkir = $ambil->fetch_assoc()) { ?>

                                <option value="<?=$perongkir['id_ongkir']; ?>">
                                    <?=$perongkir['nama_kota']; ?> -
                                    Rp. <?=number_format($perongkir['tarif']); ?>
                                </option>

                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <textarea class="form-control" name="alamat_pengiriman" placeholder="Masukkan alamat lengkap beserta (kode pos)!" cols="30" rows="5" required></textarea>
                        </div>
                    </div>
                </div>
                
                <button class="btn btn-primary" name="checkout"><i class="fa fa-check"></i> Checkout</button>
            </form>
            
            <?php
                if(isset($_POST['checkout'])) {
                    $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
                    $id_ongkir = $_POST['id_ongkir'];
                    $tanggal_pembelian = date("y-m-d");
                    $alamat_pengiriman = $_POST['alamat_pengiriman'];

                    $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir = '$id_ongkir' ");
                    $arrayongkir = $ambil->fetch_assoc();
                    $nama_kota = $arrayongkir['nama_kota'];
                    $tarif = $arrayongkir['tarif'];

                    $total_pembelian = $total_belanja + $tarif;

                    //    menyimpan data ke tabel pembelian
                    $koneksi->query("INSERT INTO pembelian (id_pelanggan, id_ongkir, tanggal_pembelian, total_pembelian, nama_kota, tarif, alamat_pengiriman) VALUES ('$id_pelanggan', '$id_ongkir', '$tanggal_pembelian', '$total_pembelian', '$nama_kota', '$tarif', '$alamat_pengiriman') ");

                    // mendapatkan id_pembelian barusan terjadi
                    $id_pembelian_barusan = $koneksi->insert_id;

                    foreach($_SESSION['keranjang'] as $id_produk => $jumlah) {
                        // mendapatkan data produk berdasarkan id_produk
                        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk' ");
                        $perproduk = $ambil->fetch_assoc();
                        $nama = $perproduk['nama_produk'];
                        $harga = $perproduk['harga_produk'];
                        $berat = $perproduk['berat_produk'];
                        $subberat = $perproduk['berat_produk'] * $jumlah;
                        $subharga = $perproduk['harga_produk'] * $jumlah;

                        $koneksi->query("INSERT INTO pembelian_produk (id_pembelian, id_produk, nama, harga, berat, subberat, subharga, jumlah) VALUES ('$id_pembelian_barusan', '$id_produk', '$nama', '$harga', '$berat', '$subberat', '$subharga', '$jumlah') ");

                        $koneksi->query("UPDATE produk SET stok_produk = stok_produk - $jumlah WHERE id_produk = '$id_produk' ");
                    }

                    // mengkosongkan keranjang belanja
                    unset($_SESSION['keranjang']);

                    // tampilan dialihkan ke halaman nota, nota dari pembelian yang barusan
                    echo "<script>alert('Pembelian sukses!')</script>";
                    echo "<script>location ='nota.php?id=$id_pembelian_barusan';</script>";
                }
            ?>

        </div>
    </section>

    <!-- <pre><?php //print_r($_SESSION['pelanggan']); ?></pre> -->
    <!-- <pre><?php //print_r($_SESSION['keranjang']); ?></pre> -->

    <script src="admin/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="admin/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>