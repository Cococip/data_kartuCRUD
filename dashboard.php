<?php
session_start();

class TableContainer {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function generateTable() {
        $table = '<table border="1">';
        $table .= '<tr>';
        $table .= '<th>No</th>';
        $table .= '<th>Kantor Cabang</th>';
        $table .= '<th>Kabupaten/Kota</th>';
        $table .= '<th>Tanggal Cetak</th>';
        $table .= '<th>Nomor Kartu</th>';
        $table .= '<th>Nama Peserta</th>';
        $table .= '<th>Jenis Cetak</th>';
        $table .= '<th>Jumlah Cetak</th>';
        $table .= '<th>Penerima</th>';
        $table .= '<th>Hubungan</th>';
        $table .= '<th>Aksi</th>';
        $table .= '</tr>';

        $tampil = $this->getData();
        $numRows = mysqli_num_rows($tampil); // Mendapatkan jumlah baris

        $no = 1;
        while ($hasil = mysqli_fetch_array($tampil)) {
            $kantorCabang = $this->getKantorCabang($hasil['id_kantor_cabang']);

            $nomorKartu = $hasil['nomor_kartu'];
            if (strlen($nomorKartu) > 4) {
                $maskedNomorKartu = substr($nomorKartu, 0, -4) . str_repeat("*", 4);
            } else {
                $maskedNomorKartu = str_repeat("*", strlen($nomorKartu));
            }

            $namaPeserta = $hasil['nama_peserta'];
            $namaPesertaArr = explode(" ", $namaPeserta); // Memisahkan kata dalam Nama Peserta
            $maskedNamaPeserta = '';
            foreach ($namaPesertaArr as $kata) {
                if (strlen($kata) < 2) {
                    $maskedNamaPeserta .= substr($kata, 0, -1) . "*"; // Masking kata kurang dari 3 huruf
                } elseif (strlen($kata) > 2) {
                    $maskedNamaPeserta .= substr($kata, 0, 2) . str_repeat("*", strlen($kata) - 2) . " "; // Masking kata lebih dari 3 huruf
                } else {
                    $maskedNamaPeserta .= $kata . " ";
                }
            }

            $table .= '<tr>';
            $table .= '<td>' . $no++ . '</td>';
            $table .= '<td>' . $kantorCabang . '</td>';
            $table .= '<td>' . $hasil['kabupaten_kota'] . '</td>';
            $table .= '<td>' . $hasil['tanggal_cetak'] . '</td>';
            $table .= '<td>' . $maskedNomorKartu . '</td>';
            $table .= '<td>' . $maskedNamaPeserta . '</td>';
            $table .= '<td>' . $hasil['jenis_cetak'] . '</td>';
            $table .= '<td>' . $hasil['jumlah_cetak'] . '</td>';
            $table .= '<td>' . $hasil['penerima'] . '</td>';
            $table .= '<td>' . $hasil['hubungan'] . '</td>';
            $table .= '<td>';
            $table .= '<a href="ubah.php?no=' . $hasil['no'] . '">Ubah</a> || ';
            $table .= '<a onclick="return confirm(\'Apakah Anda Yakin Ingin Menghapus Data Ini?\')" href="hapus.php?id=' . $hasil['no'] . '">Hapus</a>';
            $table .= '</td>';
            $table .= '</tr>';
        }

        $table .= '</table>';

        return array($table, $numRows); // Mengembalikan tabel dan jumlah baris
    }

    function getData() {
        if (isset($_GET['cari'])) {
            $cari = $_GET['cari'];
            $query = "SELECT input_data.*, kantor_cabang.kantor_cabang 
                      FROM input_data 
                      INNER JOIN kantor_cabang ON input_data.id_kantor_cabang = kantor_cabang.id_kantor_cabang 
                      WHERE kabupaten_kota LIKE '%" . $cari . "%' 
                      OR kantor_cabang LIKE '%" . $cari . "%' 
                      OR input_data.id_kantor_cabang LIKE '%" . $cari . "%' 
                      OR tanggal_cetak LIKE '%" . $cari . "%' 
                      OR nomor_kartu LIKE '%" . $cari . "%' 
                      OR nama_peserta LIKE '%" . $cari . "%' 
                      OR jenis_cetak LIKE '%" . $cari . "%' 
                      OR jumlah_cetak LIKE '%" . $cari . "%' 
                      OR penerima LIKE '%" . $cari . "%' 
                      OR hubungan LIKE '%" . $cari . "%'";
            $tampil = mysqli_query($this->con, $query);
        } elseif (isset($_GET['tanggal1'])) {
            $tanggal1 = $_GET['tanggal1'];
            $tanggal2 = $_GET['tanggal2'];
            $query = "SELECT input_data.*, kantor_cabang.kantor_cabang 
                      FROM input_data 
                      INNER JOIN kantor_cabang ON input_data.id_kantor_cabang = kantor_cabang.id_kantor_cabang 
                      WHERE tanggal_cetak BETWEEN '" . $tanggal1 . "' AND '" . $tanggal2 . "'";
            $tampil = mysqli_query($this->con, $query);
        } else {
            $query = "SELECT input_data.*, kantor_cabang.kantor_cabang 
                      FROM input_data 
                      INNER JOIN kantor_cabang ON input_data.id_kantor_cabang = kantor_cabang.id_kantor_cabang";
            $tampil = mysqli_query($this->con, $query);
        }
    
        return $tampil;
    }
    

    private function getKantorCabang($idKantorCabang) {
        $queryKantorCabang = "SELECT kantor_cabang FROM kantor_cabang WHERE id_kantor_cabang = '$idKantorCabang'";
        $resultKantorCabang = mysqli_query($this->con, $queryKantorCabang);
        $rowKantorCabang = mysqli_fetch_assoc($resultKantorCabang);
        $kantorCabang = isset($rowKantorCabang['kantor_cabang']) ? $rowKantorCabang['kantor_cabang'] : '';

        return $kantorCabang;
    }
}

include "config.php";

// // Cek apakah sudah login atau belum
// if (!isset($_SESSION['login'])) {
//     header("Location: login.php");
//     exit();
// }

$tableContainer = new TableContainer($con);
$tableResult = $tableContainer->generateTable();
$table = $tableResult[0];
$numRows = $tableResult[1];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lihat Data</title>
    <link rel="stylesheet" href="style_index.css"/>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        th {
            background-color: #7fb9fb;
            color: white;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <nav class="menu">
        <br>&nbsp;&nbsp;&nbsp;&nbsp;
        <img src="logo-bpjs.png" alt="Avatar" class="image" style="width:20%">
        <ul>            
            <li><a href="halaman_utama.php">Halaman Utama</a></li>
            <li><a href="dashboard.php">Tambah Data</a></li>            
            <li><a href="lihatdata.php">Lihat & Cetak Data</a></li>
            <li><a href="index.php">Keluar</a></li>
        </ul>
    </nav>
    <p align="center" style="font-weight: bold; font-size: 26pt">TAMBAH DATA CETAK KARTU</p>
    <center>
    <button class="button"><a href="inputdata.php" style="color: white; text-decoration: none;">Tambah Data Cetak Kartu</a></button><br><br>

    <!-- <center>
        <form method="get" action="" align="center">
            <input type="text" name="cari" placeholder="Cari Data" autocomplete="off" style="width: 400px; padding: 8px;">
            <input type="submit" value="Cari" class="button">
        </form><br>

        <form method="get" action="" align="center">
            <label for="tanggal1">Pilih Tanggal</label>
            <input type="date" id="tanggal1" name="tanggal1">
            <input type="date" id="tanggal2" name="tanggal2">
            <input type="submit" value="Cari" class="button">
        </form>
        <br>
        
    </center> -->

        <br>

        <?php echo $table; ?>
        <br>
        
    </center>

    <script>
        function printTable() {
            // Menghapus elemen-elemen di luar tabel
            var body = document.body.innerHTML;
            var table = document.querySelector('table').outerHTML;
            document.body.innerHTML = table;

            // Mencetak tabel
            window.print();

            // Mengembalikan elemen-elemen yang dihapus
            document.body.innerHTML = body;
        }

        function downloadPDF() {
            const doc = new jsPDF();
            const table = document.querySelector('table').outerHTML;
            doc.fromHTML(table, 15, 15, {
                'width': 170
            });
            doc.save('table.pdf');
        }

        function downloadExcel() {
            const table = document.querySelector('table');
            const rows = table.querySelectorAll('tr');
            const csvData = [];

            // Loop through each row and get the cell data
            for (let i = 0; i < rows.length; i++) {
                const row = [];
                const cells = rows[i].querySelectorAll('td, th');
                for (let j = 0; j < cells.length; j++) {
                    row.push(cells[j].innerText);
                }
                csvData.push(row.join(','));
            }

            // Create a CSV file and download it
            const csvContent = csvData.join('\n');
            const blob = new Blob([csvContent], {
                type: 'text/csv'
            });
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', 'table.csv');
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
</body>
</html>
