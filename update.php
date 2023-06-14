<?php
require_once "config.php";

if(isset($_POST['no'])) {
    $no = $_POST['no'];

    // Ambil data dari form
    $id_kantor_cabang = $_POST['id_kantor_cabang'];
    $kabupaten_kota = $_POST['kabupaten_kota'];
    $tanggal_cetak = $_POST['tanggal_cetak'];
    $jenis_cetak = $_POST['jenis_cetak'];
    $nomor_kartu = $_POST['nomor_kartu'];
    $nama_peserta = $_POST['nama_peserta'];
    $jumlah_cetak = $_POST['jumlah_cetak'];
    $penerima = $_POST['penerima'];
    $hubungan = $_POST['hubungan'];

    // Update data ke dalam database
    $sql = "UPDATE input_data SET id_kantor_cabang='$id_kantor_cabang', kabupaten_kota='$kabupaten_kota', tanggal_cetak='$tanggal_cetak', jenis_cetak='$jenis_cetak', nomor_kartu='$nomor_kartu', nama_peserta='$nama_peserta', jumlah_cetak='$jumlah_cetak', penerima='$penerima', hubungan='$hubungan' WHERE no='$no'";

    if(mysqli_query($con, $sql)) {
        // Menggunakan alert JavaScript untuk memberikan pesan sukses
        echo '<script>alert("Data berhasil diupdate."); window.location.href = "dashboard.php";</script>';
    } else {
        // Menggunakan alert JavaScript untuk memberikan pesan kesalahan
        echo '<script>alert("Terjadi kesalahan: ' . mysqli_error($con) . '"); window.history.back();</script>';
    }
}

mysqli_close($con);
?>
