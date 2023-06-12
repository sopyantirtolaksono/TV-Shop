<?php 
    session_start();
    include 'koneksi.php';

    if(isset($_SESSION['pelanggan'])) {
        echo "<script>location ='index.php';</script>";
        header('Location: index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BekhanTV | Login</title>
    <link rel="stylesheet" href="admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/assets/bower_components/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/menu.css">
</head>
<body>
    <!-- Navbar -->
    <?php include 'menu.php'; ?>

    <div class="container">
        <div class="row" style="margin-top: 100px;">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title text-center">
                            <h4><strong>BekhanTV | Login</strong></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form method="post">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <button class="btn btn-primary btn-lg btn-block" name="login">Login</button>
                        </form>

                        <br>
                        <!-- link daftar pelanggan baru -->
                        <p><a href="daftar.php"> Belum punya akun ?</a></p>

                        <?php
                            if(isset($_POST['login'])) {
                                $email = $_POST['email'];
                                $password = $_POST['password'];

                                $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan = '$email' AND password_pelanggan = '$password' ");
                                $akun_cocok = $ambil->num_rows;

                                if($akun_cocok == 1) {
                                    $akun = $ambil->fetch_assoc();

                                    $_SESSION['pelanggan'] = $akun;
                                    echo "<br>";
                                    echo "<div class='alert alert-success text-center'>Login Berhasil</div>";

                                    // jika sudah belanja
                                    if(isset($_SESSION['keranjang']) OR !empty($_SESSION['keranjang'])) {
                                        echo "<meta http-equiv='refresh' content='1;url=checkout.php' ";
                                    }
                                    // jika belum belanja
                                    else {
                                        echo "<meta http-equiv='refresh' content='1;url=index.php' ";
                                    }

                                }
                                else {
                                    echo "<div class='alert alert-danger text-center'>Login Gagal, Silahkan periksa akun dan password anda!</div>";
                                    echo "<meta http-equiv='refresh' content='1;url=login.php' ";
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