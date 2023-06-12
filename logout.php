<?php
    session_start();
    // session_destroy();
    unset($_SESSION['pelanggan']);
    echo "<script>alert('Logout Berhasil!')</script>";
    echo "<script>location='index.php';</script>"
?>