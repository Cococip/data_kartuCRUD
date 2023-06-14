<?php
require_once "config.php";

if(isset($_GET['no'])) {
    $no = $_GET['no'];

    $query = mysqli_query($con, "SELECT * FROM input_data WHERE no='$no'");
    $hasil = mysqli_fetch_assoc($query);

    if(mysqli_num_rows($query) == 0) {
        echo "Data tidak ditemukan.";
        exit();
    }
} else {
    echo "No tidak ditemukan.";
    exit();
}
?>

<html>
<head>
    <title>Edit Data</title>
    <link rel="stylesheet" href="style_inp_data.css" type="text/css">
    <script src="js/jQuery.js"></script>
    <script>
        $(document).ready(function() {
            $('#kantor_cabang').change(function() {
                var kc = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: 'kota.php',
                    data: 'kantor_cabang=' + kc,
                    success: function(response) {
                        $('#kabupaten_kota').html(response);
                    }
                });
            });
        });
    </script>
</head>
<style>
    body {font-family: Arial, Helvetica, sans-serif;}

    * {box-sizing: border-box;}
</style>

<body>
<nav class="menu">
    <br>&nbsp;&nbsp;&nbsp;&nbsp;
    <img src="logo-bpjs.png" alt="Avatar" class="image" style="width:20%">
    <ul>
        <li><a href="index.php">Lihat & Ambil Data Cetak Kartu</a></li>
        <li><a href="login.php">Keluar</a></li>
    </ul>
</nav>

<div class="container">
    <form action="update.php" method="POST">

        <div class="form-group">
            <label>Kantor Cabang</label>
            <?php
            $sql_kantor_cabang = mysqli_query($con, 'SELECT * FROM kantor_cabang');
            ?>
            <select name="id_kantor_cabang" id="kantor_cabang" type="option_kc" required>
                <option value="">- - - Pilih Kantor Cabang - - -</option>
                <?php while ($row_kantor_cabang = mysqli_fetch_array($sql_kantor_cabang)) { ?>
                    <option value="<?php echo $row_kantor_cabang['id_kantor_cabang'] ?>" <?php if ($hasil['id_kantor_cabang'] == $row_kantor_cabang['id_kantor_cabang']) echo 'selected'; ?>>
                        <?php echo $row_kantor_cabang['kantor_cabang'] ?>
                    </option>
                <?php } ?>
            </select>
        </div><br>

        <div class="form-group">
            <label>Kabupaten / Kota</label>
            <?php
            $selected_kc = $hasil['id_kantor_cabang'];
            $sql_kota = mysqli_query($con, "SELECT * FROM kabupaten_kota WHERE id_kantor_cabang='$selected_kc'");
            ?>
            <select name="kabupaten_kota" type="option_kota" id="kabupaten_kota" required>
                <option value="">- - - Pilih Kabupaten / Kota - - -</option>
                <?php while ($row_kota = mysqli_fetch_array($sql_kota)) { ?>
                    <option value="<?php echo $row_kota['kabupaten_kota'] ?>" <?php if ($hasil['kabupaten_kota'] == $row_kota['kabupaten_kota']) echo 'selected'; ?>>
                        <?php echo $row_kota['kabupaten_kota'] ?>
                    </option>
                <?php } ?>
            </select>
        </div><br>

        <div class="form-group">
            <label>Tanggal Cetak</label>
            <input type="date" name="tanggal_cetak" value="<?php echo $hasil['tanggal_cetak'] ?>" required>
        </div><br>

        <div class="form-group">
            <label>Jenis Cetak</label>
            <select class="form-control" type="option_jeniscetak" name="jenis_cetak" required>
                <option value="">- - - Pilih Jenis Cetak - - -</option>
                <option <?php if ($hasil['jenis_cetak'] == "Pencetakan Kartu Peserta dan Anggota Keluarga Baru") echo 'selected'; ?>>
                    Pencetakan Kartu Peserta dan Anggota Keluarga Baru
                </option>
                <option <?php if ($hasil['jenis_cetak'] == "Pencetakan Kartu Peserta dan Anggota Keluarga Lama") echo 'selected'; ?>>
                    Pencetakan Kartu Peserta dan Anggota Keluarga Lama
                </option>
                <option <?php if ($hasil['jenis_cetak'] == "Penggantian Kartu Salah") echo 'selected'; ?>>
                    Penggantian Kartu Salah
                </option>
                <option <?php if ($hasil['jenis_cetak'] == "Penggantian Kartu Rusak/Hilang") echo 'selected'; ?>>
                    Penggantian Kartu Rusak/Hilang
                </option>
                <option <?php if ($hasil['jenis_cetak'] == "Kartu Gagal Cetak") echo 'selected'; ?>>
                    Kartu Gagal Cetak
                </option>
            </select>
        </div><br>

        <div class="form-group">
            <label>Nomor Kartu</label>
            <input type="text_nomorkartu" name="nomor_kartu" value="<?php echo $hasil['nomor_kartu'] ?>" required>
        </div><br>

        <div class="form-group">
            <label>Nama Peserta</label>
            <input type="text_namapeserta" name="nama_peserta" value="<?php echo $hasil['nama_peserta'] ?>" required>
        </div><br>

        <div class="form-group">
            <label>Jumlah Cetak</label>
            <input type="text_jumlahcetak" name="jumlah_cetak" size="100" value="<?php echo $hasil['jumlah_cetak'] ?>" required>
        </div><br>

        <div class="form-group">
            <label>Penerima</label>
            <input type="text_penerima" name="penerima" value="<?php echo $hasil['penerima'] ?>" required>
        </div><br>

        <div class="form-group">
            <label>Hubungan</label>
            <select class="form-control" type="option_hubungan" name="hubungan" required>
                <option value="">- - - Pilih Hubungan - - -</option>
                <option <?php if ($hasil['hubungan'] == "Yang Bersangkutan") echo 'selected'; ?>>Yang Bersangkutan</option>
                <option <?php if ($hasil['hubungan'] == "Suami / Istri") echo 'selected'; ?>>Suami / Istri</option>
                <option <?php if ($hasil['hubungan'] == "Anak") echo 'selected'; ?>>Anak</option>
                <option <?php if ($hasil['hubungan'] == "Orang Tua") echo 'selected'; ?>>Orang Tua</option>
                <option <?php if ($hasil['hubungan'] == "Lainnya") echo 'selected'; ?>>Lainnya</option>
            </select>
        </div><br><br>

        <input type="hidden" name="no" value="<?php echo $no; ?>">
        <input type="submit" Value="Simpan" align="right">
        
    </form>
</div>
</body>
</html>
