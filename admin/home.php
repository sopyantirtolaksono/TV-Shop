<?php 
    if(!isset($_SESSION['admin']) OR empty($_SESSION['admin'])) {
        echo "<script>location ='login.php';</script>";
    }
?>
<h2 class="text-center">Selamat Datang <?=$_SESSION['admin']['nama_lengkap']; ?></h2>
<!-- <pre><?php //print_r($_SESSION); ?></pre> -->