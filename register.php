<!DOCTYPE HTML>
<html>
<head>
    <title>Daftar</title>
    <link rel="stylesheet" href="style_login.css">
    <style>
        /* CSS untuk tombol */
        .login-button,
        .register-button {
            background-color: #b22222; /* Warna latar belakang */
            border: none;
            color: white; /* Warna teks */
            padding: 10px 20px; /* Ruang di dalam tombol */
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            font-family: Arial, sans-serif;
            font-weight: bold;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 20px;
            width: 100%;
        }

        /* CSS untuk tombol Daftar Anggota saat dihover */
        .register-button:hover {
            background-color: #008CBA;
        }
    </style>
</head>
<body>  
    <div class="container">
        <h1><center>DAFTAR</center></h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input name="tujuan" type="hidden" value="DAFTAR">

            <label>Nama Pengguna</label>
            <br>
            <input name="username" type="text" required> 
            <br>
            <label>Kata Sandi</label>
            <br>
            <input name="password" type="password" required>
            <br>
            <label>Konfirmasi Kata Sandi</label>
            <br>
            <input name="confirm_password" type="password" required>
            <br><br>
            <button type="submit">Daftar</button>
            <br>
            
        </form>
            <button class="register-button" onclick="window.location.href='index.php'">Kembali</button>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Koneksi ke database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "datacetakkartu";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Ambil data dari form
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        $level = "warga"; // Level diisi otomatis dengan "warga"

        // Validasi kata sandi
        if ($password !== $confirm_password) {
            echo "<script>alert('Konfirmasi kata sandi tidak cocok');</script>";
            exit;
        }

        // Buat query untuk menyimpan data admin ke tabel "admin"
        $sql = "INSERT INTO admin (username, password, level) VALUES ('$username', '$password', '$level')";

        if ($conn->query($sql) === TRUE) {
            // Jika penyimpanan berhasil, tampilkan alert "Data berhasil disimpan" dan arahkan ke index.php
            echo "<script>alert('Data berhasil disimpan'); window.location.href = 'index.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>
</html>
