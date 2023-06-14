<?php
include "config.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data berdasarkan ID
    $hapus = mysqli_query($con, "DELETE FROM input_data WHERE no = '$id'");

    if($hapus) {
        echo '<script>alert("Data berhasil dihapus."); window.location.href = "dashboard.php";</script>';
        exit;
    } else {
        echo '<script>alert("Terjadi kesalahan saat menghapus data."); window.location.href = "dashboard.php";</script>';
        exit;
    }
} else {
    echo '<script>alert("ID tidak ditemukan."); window.location.href = "dashboard.php";</script>';
    exit;
}
?>
