<?php
session_start();

// Hapus semua data sesi
session_destroy();

// Redirect ke halaman login
header("Location: ../index.php");
exit();
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Keluar</title>
    <script>
        alert("Anda telah keluar dari akun.");
    </script>
</head>
<body></body>
</html>
