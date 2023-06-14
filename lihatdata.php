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
       // $table .= '<th>Aksi</th>';
        $table .= '</tr>';

        $tampil = $this->getData();

        if ($tampil) {
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
                // $table .= '<td><a href="edit.php?id=' . $hasil['id_kantor_cabang'] . '">Edit</a> | <a href="hapus.php?id=' . $hasil['id_kantor_cabang'] . '">Hapus</a></td>';
                $table .= '</tr>';
            }

            $table .= '</table>';

            if ($numRows > 0) {
                echo '<h3>Jumlah Data Cetak Kartu: ' . $numRows . '</h3>';
                echo $table;
            } else {
                echo '<p>Tidak ada data yang ditemukan.</p>';
            }
        } else {
            echo '<p>Terjadi kesalahan saat mengambil data.</p>';
        }
    }

    private function getData() {
        $query = "SELECT input_data.*, kantor_cabang.kantor_cabang 
                  FROM input_data 
                  INNER JOIN kantor_cabang ON input_data.id_kantor_cabang = kantor_cabang.id_kantor_cabang";

        if (isset($_GET['kantor_cabang'])) {
            $kantorCabang = $_GET['kantor_cabang'];
            $query .= " WHERE kantor_cabang.kantor_cabang LIKE '%" . $kantorCabang . "%'";
        }

        $tampil = mysqli_query($this->con, $query);
        return $tampil;
    }

    private function getKantorCabang($idKantorCabang) {
        $query = "SELECT kantor_cabang FROM kantor_cabang WHERE id_kantor_cabang = '$idKantorCabang'";
        $result = mysqli_query($this->con, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['kantor_cabang'];
    }
}

$con = mysqli_connect("localhost", "root", "", "datacetakkartu");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$queryKantorCabang = "SELECT DISTINCT kantor_cabang FROM kantor_cabang";
$resultKantorCabang = mysqli_query($con, $queryKantorCabang);

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
    <p align="center" style="font-weight: bold; font-size: 26pt">LAPORAN DATA CETAK KARTU</p>
    <center>
    <center>
        <form method="get" action="" align="center">
            <input type="text" name="cari" placeholder="Cari Data Cetak Kartu" autocomplete="off" style="width: 400px; padding: 8px;">
            <input type="submit" value="Cari" class="button">
        </form>
        <h3>Cari Data Berdasarkan Tanggal</h3>
        <form method="get" action="" align="center">
            <input type="date" id="tanggal1" name="tanggal1">
            <input type="date" id="tanggal2" name="tanggal2">
            <input type="submit" value="Cari" class="button">
        </form>
        <br>
        <form method="get" action="" align="center">
        <select name="kantor_cabang">
            <option value="">Cari Berdasarkan Kantor Cabang</option>
            <?php
            if ($resultKantorCabang) {
                while ($rowKantorCabang = mysqli_fetch_assoc($resultKantorCabang)) {
                    $kantorCabang = $rowKantorCabang['kantor_cabang'];
                    echo '<option value="' . $kantorCabang . '">' . $kantorCabang . '</option>';
                }
            }
            ?>
        </select>
        <input type="submit" value="Filter" class="button">
    </form><br>


    </center>

        <br>
        <button class="button" onclick="printTable()">Print</button>
        <!-- <button class="button" onclick="downloadPDF()">Download PDF</button> -->
        <button class="button" onclick="downloadExcel()">Unduh Excel</button>
        <br><br><br>

    </center>
<body>


    <div align="center">
        <?php
        $tableContainer = new TableContainer($con);
        $tableContainer->generateTable();
        ?>
        <br><br>
    </div>
</body>
</html>

<?php
mysqli_close($con);
?>
