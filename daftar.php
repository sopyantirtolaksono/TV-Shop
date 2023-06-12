<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Pelanggan Baru</title>
    <link rel="stylesheet" href="admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/assets/bower_components/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/menu.css">
</head>
<body>
    <!-- Navbar -->
    <?php include 'menu.php'; ?>

    <!-- Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center"><strong>Daftar Pelanggan Baru</strong></h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-md-3">Nama</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="nama" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Email</label>
                                <div class="col-md-7">
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Password</label>
                                <div class="col-md-7">
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Alamat</label>
                                <div class="col-md-7">
                                    <textarea class="form-control" name="alamat" cols="30" rows="5" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Telp/HP</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="telepon" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-3">
                                    <button class="btn btn-primary" name="daftar">Daftar</button>
                                </div>
                            </div>
                        </form>

                        <!-- link login pelanggan yang sudah punya akun -->
                        <div class="container">
                            <p><a href="login.php"> Sudah punya akun ?</a></p>
                        </div>

                        <?php
                            // jika tombol deftar ditekan
                            if(isset($_POST['daftar'])) {
                                // ambil semua data dari setiap field pada form daftar pelanggan
                                $nama = $_POST['nama'];
                                $email = $_POST['email'];
                                $password = $_POST['password'];
                                $alamat = $_POST['alamat'];
                                $telepon = $_POST['telepon'];

                                // cek apakah ada email yang sama
                                $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan = '$email' ");
                                $emailCocok = $ambil->num_rows;

                                if($emailCocok == 1) {
                                    echo "<script>alert('Maaf email yang anda inputkan sudah ada! Pendaftaran gagal!')</script>";
                                    echo "<script>location ='daftar.php';</script>";
                                }
                                else {
                                    // masukkan semua data pelanggan baru ke database
                                    $koneksi->query("INSERT INTO pelanggan (email_pelanggan, password_pelanggan, nama_pelanggan, telepon_pelanggan, alamat_pelanggan) VALUES ('$email', '$password', '$nama', '$telepon', '$alamat') ");

                                    echo "<script>alert('Pendaftaran berhasil! Silahkan login!')</script>";
                                    echo "<script>location ='login.php';</script>";
                                }
                            }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="admin/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="admin/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>