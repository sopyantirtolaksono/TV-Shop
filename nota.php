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
    <title>Nota Pembelian</title>
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

            <h2 class="text-center">Detail Pembelian</h2>
            <?php 
                $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.id_pembelian = '$_GET[id]' ");
                $detail = $ambil->fetch_assoc();
            ?>

            <!-- <h3>Data orang yg beli</h3> -->
            <!-- <pre><?php //print_r($detail); ?></pre> -->
            <!-- <h3>Data orang yg login lewat session</h3> -->
            <!-- <pre><?php //print_r($_SESSION); ?></pre> -->

            <!-- yang boleh lihat data pembelian hanya yang login lewat session -->
            <?php
                // mendapatkan id_pelanggan yang beli
                $idPelangganYangBeli = $detail['id_pelanggan'];
                // mendapatkan id_pelanggan yang login
                $idPelangganYangLoginSession = $_SESSION['pelanggan']['id_pelanggan'];

                // jika $idPelangganYangBeli tidak sama dengan $idPelangganYangLoginSession maka jangan dibiarkan masuk & tendang ke halaman riwayat.php
                if($idPelangganYangBeli != $idPelangganYangLoginSession) {
                    echo "<script>alert('Maaf! Akses anda ilegal.')</script>";
                    echo "<script>location ='riwayat.php';</script>";
                    exit();
                }
            ?>

            <div class="row">
                <div class="col-md-4">
                    <h3>Pembelian</h3>
                    <strong>No. Pembelian : <?=$detail['id_pembelian']; ?></strong> <br>
                    <p>
                        Tanggal : <?=$detail['tanggal_pembelian']; ?> <br>
                        Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Rp. <?=number_format($detail['total_pembelian']); ?>
                    </p>
                </div>
                <div class="col-md-4">
                    <h3>Nama pelanggan</h3>
                    <strong><?=$detail['nama_pelanggan']; ?></strong> <br>
                    <p>
                        Telepon : <?=$detail['telepon_pelanggan']; ?> <br>
                        Email &nbsp;&nbsp;&nbsp;&nbsp; : <?=$detail['email_pelanggan']; ?>
                    </p>
                </div>
                <div class="col-md-4">
                    <h3>Pengiriman</h3>
                    <strong><?=$detail['nama_kota']; ?></strong> <br>
                    Ongkos Kirim : Rp. <?=number_format($detail['tarif']); ?> <br>
                    Alamat : <?=$detail['alamat_pengiriman']; ?>
                </div>
            </div>

            <br>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Berat</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">SubBerat</th>
                            <th class="text-center">SubTotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian = '$_GET[id]' "); ?>
                        <?php while($pecah = $ambil->fetch_assoc()) { ?>
                        <tr>
                            <td><?=$no; ?></td>
                            <td><?=$pecah['nama']; ?></td>
                            <td>Rp. <?=number_format($pecah['harga']); ?></td>
                            <td><?=$pecah['berat']; ?> Gr</td>
                            <td><?=$pecah['jumlah']; ?></td>
                            <td><?=$pecah['subberat']; ?> Gr</td>
                            <td>Rp. <?=number_format($pecah['subharga']); ?></td>
                        </tr>
                        <?php $no++; ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            
            <div class="row">
                <div class="col-md-7">
                    <div class="alert alert-info">
                        <p>
                            Silahkan melakukan pembayaran Rp. <?=number_format($detail['total_pembelian']); ?> ke <br>
                            <strong>BANK MANDIRI 1553-896755-4448 AN. Bekhan Supriyanto</strong>
                        </p>
                    </div>
                    <div class="alert alert-info">
                        <p>
                            Silahkan melakukan pembayaran Rp. <?=number_format($detail['total_pembelian']); ?> ke <br>
                            <strong>BANK BNI 5531-322243-8442 AN. Bekhan Supriyanto</strong>
                        </p>
                    </div>
                </div>
            </div>

            <a href='javascript:if(window.print)window.print()'>
                <button type="button" class="btn btn-primary"><i class="fa fa-print"></i> Cetak halaman ini</button>
            </a>

        </div>
    </section>

    <script src="admin/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="admin/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>