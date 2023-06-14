<?php
include("config.php");

$username = $_POST['username'];
$password = $_POST['password'];

$sql = mysqli_query($con, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
$selek = mysqli_fetch_array($sql);
$row = mysqli_num_rows($sql);

if ($row >= 1) {
    // Jika login sebagai admin, arahkan ke halaman admin.php
    if ($selek['level'] === 'admin') {
        session_start();
        $_SESSION['username'] = $selek['username'];
        echo "<script>alert('Berhasil login');window.location.href='halaman_utama.php'</script>";
    } else {
        // Jika login sebagai warga, arahkan ke halaman warga.php dengan parameter ID
        session_start();
        $_SESSION['username'] = $selek['username'];
        echo "<script>alert('Berhasil login');window.location.href='warga/halaman_utama.php?id=" . $selek['id'] . "'</script>";
    }
} else {
    echo "<script>alert('Gagal login');window.location.href='index.php'</script>";
}
?>
