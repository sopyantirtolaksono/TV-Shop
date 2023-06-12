<?php
	if(!isset($_SESSION['admin'])) {
		echo "<script>location ='login.php';</script>";
		header('location: login.php');
		exit();
	}

    // mendapatkan id_pembelian dari url
    $id_pembelian = $_GET['id'];

    // menampilkan data pembayaran berdasarkan id_pembelian
    $ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian = '$id_pembelian' ");
    $detail = $ambil->fetch_assoc();

    // echo "<pre>";
    // print_r($detail);
    // echo "</pre>";

?>

<h2>Data Pembayaran</h2>
<div class="row">
    <div class="col-md-6">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Nama</th>
                    <td><?=$detail['nama']; ?></td>
                </tr>
                <tr>
                    <th>Bank</th>
                    <td><?=$detail['bank']; ?></td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>Rp. <?=number_format($detail['jumlah']); ?></td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td><?=$detail['tanggal']; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <img src="../bukti_pembayaran/<?=$detail['bukti']; ?>" class="img-responsive" alt="error" width="50%">
    </div>
</div>

<br><br><br>

<form method="post">
    <div class="form-group">
        <label>No. Resi Pengiriman</label>
        <input type="text" name="resi" class="form-control">
    </div>
    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="">Pilih Status</option>
            <option value="Lunas">Lunas</option>
            <option value="Barang dikirim">Barang Dikirim</option>
            <option value="Batal">Batal</option>
        </select>
    </div>
    <button class="btn btn-primary" name="proses"><i class="fa fa-send"></i> Proses</button>
</form>

<?php
    if(isset($_POST['proses'])) {
        // ambil data dari setiap field di form
        $resi = $_POST['resi'];
        $status = $_POST['status'];

        // lakukan query update status pembelian
        $koneksi->query("UPDATE pembelian SET resi_pengiriman = '$resi', status_pembelian = '$status' WHERE id_pembelian = '$id_pembelian' ");

        echo "<script>alert('Data pembelian terupdate!')</script>";
        echo "<script>location ='index.php?halaman=pembelian';</script>";
    }
?>
