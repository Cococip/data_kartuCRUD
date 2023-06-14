<?php
// Fungsi untuk memeriksa level pengguna dan mengalihkan ke halaman yang sesuai
function redirectUser($level)
{
    switch ($level) {
        case 'admin':
            header('Location: admin.php');
            break;
        case 'warga':
            header('Location: warga.php?id=' . $_SESSION['id']);
            break;
        default:
            header('Location: index.php');
            break;
    }
}

// Fungsi untuk melakukan proses login
function loginProcess($username, $password)
{
    // Lakukan proses autentikasi, misalnya dengan mengambil data pengguna dari database
    $users = [
        ['id' => 1, 'username' => 'admin', 'password' => 'adminpass', 'level' => 'admin'],
        ['id' => 2, 'username' => 'user1', 'password' => 'userpass', 'level' => 'warga'],
        ['id' => 3, 'username' => 'user2', 'password' => 'userpass', 'level' => 'warga']
    ];

    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            // Jika login berhasil, simpan informasi pengguna ke sesi
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['level'] = $user['level'];

            // Alihkan ke halaman yang sesuai dengan level pengguna
            redirectUser($user['level']);
            return;
        }
    }

    // Jika login gagal, tampilkan pesan error atau lakukan tindakan lainnya
    echo 'Login gagal. Periksa kembali username dan password.';
}

// Proses login saat tombol Masuk ditekan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tujuan']) && $_POST['tujuan'] === 'LOGIN') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Panggil fungsi untuk melakukan proses login
    loginProcess($username, $password);
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style_login.css">
    <style>
        /* CSS untuk tombol */
        .login-button,
        .register-button {
            background-color: #4CAF50; /* Warna latar belakang */
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
    <script>
        function validateForm() {
            var username = document.forms["loginForm"]["username"].value;
            var password = document.forms["loginForm"]["password"].value;

            if (username == "" || password == "") {
                alert("Username dan password harus diisi");
                return false;
            }
        }
    </script>
</head>
<body>  
    <div class="container">
        <h1>LOGIN</h1>
        <form name="loginForm" method="POST" action="index1.php" onsubmit="return validateForm()">
            <input name="tujuan" type="hidden" value="LOGIN">

            <label for="username">Nama Pengguna</label>
            <br>
            <input name="username" id="username" type="text"> 
            <br>
            <label for="password">Kata Sandi</label>
            <br>
            <input name="password" id="password" type="password">
            <br><br>
            <button class="login-button" type="submit">Masuk</button>
        </form>
        
        <!-- Tombol Daftar Anggota dengan tampilan yang sama -->
        <button class="register-button" onclick="window.location.href='register.php'">Daftar</button>
    </div>
</body>
</html>
