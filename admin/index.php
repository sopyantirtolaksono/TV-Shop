<?php include 'header.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content container-fluid">

      <?php 
        if(isset($_GET['halaman'])) {
          if($_GET['halaman'] == 'produk') {
            include 'produk.php';
          }
          elseif($_GET['halaman'] == 'pelanggan') {
            include 'pelanggan.php';
          }
          elseif($_GET['halaman'] == 'pembelian') {
            include 'pembelian.php';
          }
          elseif($_GET['halaman'] == 'detail') {
            include 'detail.php';
          }
          elseif($_GET['halaman'] == 'tambah_produk') {
            include 'tambah_produk.php';
          }
          elseif($_GET['halaman'] == 'hapus_produk') {
            include 'hapus_produk.php';
          }
          elseif($_GET['halaman'] == 'ubah_produk') {
            include 'ubah_produk.php';
          }
          elseif($_GET['halaman'] == 'logout') {
            include 'logout.php';
          }
          elseif($_GET['halaman'] == 'pembayaran') {
            include 'pembayaran.php';
          }
          elseif($_GET['halaman'] == 'laporan_pembelian') {
            include 'laporan_pembelian.php';
          }
          elseif($_GET['halaman'] == 'hapus_pelanggan') {
            include 'hapus_pelanggan.php';
          }
          elseif($_GET['halaman'] == 'home') {
            include 'home.php';
          }
        }
        elseif(isset($_GET['halamanaktif'])) {
          include 'produk.php';
        }
        elseif(isset($_GET['halamanaktif2'])) {
          include 'pembelian.php';
        }
        elseif(isset($_GET['halamanaktif3'])) {
          include 'pelanggan.php';
        }
        else{
          include 'home.php';
        }
      ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include 'footer.php'; ?>