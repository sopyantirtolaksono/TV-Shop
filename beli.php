<?php
    session_start();
    // Mendapatkan id produk dari url
    $id_produk = $_GET['id'];
    // Jika produk itu sudah dikeranjang maka produk ditambah satu
    if(isset($_SESSION['keranjang'][$id_produk])) {
        $_SESSION['keranjang'][$id_produk] += 1;
    }
    // Selain itu (belum ada dikeranjang), maka produk itu dianggap dibeli 1
    else {
        $_SESSION['keranjang'][$id_produk] = 1;
    }
    // Hubungkan ke keranjang.php
    echo"<script>alert('Produk dimasukkan ke keranjang belanja')</script>";
    echo"<script>location='keranjang.php';</script>";
?>