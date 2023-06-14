<?php
    require_once "../config.php";
?>

<html>
<head>
		<title> Input Data </title>
		<link rel="stylesheet" href="../style_inp_data.css" type="text/css">
        <script src="../js/jQuery.js"></script>
        <script>
            $(document) .ready(function() {
                $('#kantor_cabang') .change(function() {
                    var kc = $(this).val();

                    $.ajax({
                        type: 'POST',
                        url : 'kota.php',
                        data : 'kantor_cabang='+kc,
                        success : function(response){
                            $('#kabupaten_kota').html(response);
                        }
                    });
                })
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
		<img src="../logo-bpjs.png" alt="Avatar" class="image" style="width:20%">
	<ul>
    <li><a href="halaman_utama.php">Halaman Utama</a></li>
            <li><a href="dashboard.php">Lihat Data</a></li>        
            <li><a href="keluar.php">Keluar</a></li>
        
	</ul>
	</nav> 

    <div class="container">
    <form action="add.php" method="POST">

    <div class="form-group">
        <label>Kantor Cabang</label>
        <?php
            $sql_kantor_cabang = mysqli_query($con, 'SELECT * FROM kantor_cabang');
        ?>
    <select name="id_kantor_cabang" id="kantor_cabang" type="option_kc" required>
        <option value="">- - - Pilih Kantor Cabang - - -</option>
        <?php while($row_kantor_cabang = mysqli_fetch_array($sql_kantor_cabang)){ ?>
        <option value="<?php echo $row_kantor_cabang['id_kantor_cabang']?>"><?php echo $row_kantor_cabang['kantor_cabang'] ?>
        </option>
    <?php } ?>

    </select>  
    </div><br>

    <div class="form-group">
    <label>Kabupaten / Kota</label>
    <select name="kabupaten_kota" type="option_kota" id="kabupaten_kota" required>
        <option value="">- - - Pilih Kabupaten / Kota - - -</option>
        <option></option>
    </select>
    </div><br>

    <div class="form-group">    
        <label>Tanggal Cetak</label>
    <input type="date" name="tanggal_cetak" required>
    </div><br>

    <div class="form-group">
        <label>Jenis Cetak</label>
    <select class="form-control" type="option_jeniscetak" name="jenis_cetak" required>
    <option value="">- - - Pilih Jenis Cetak - - -</option>
    <option>Pencetakan Kartu Peserta dan Anggota Keluarga Baru</option>
    <option>Pencetakan Kartu Peserta dan Anggota Keluarga Lama</option>
    <option>Penggantian Kartu Salah</option>
    <option>Penggantian Kartu Rusak/Hilang</option>
    <option>Kartu Gagal Cetak</option>
    </select>
    </div><br>
        
    <div class="form-group">    
        <label>Nomor Kartu</label>
    <input type="text_nomorkartu" name="nomor_kartu" required>
    </div><br>
        
    <div class="form-group">
        <label>Nama Peserta</label>
    <input type="text_namapeserta" name="nama_peserta" required>
    </div><br>
        
    <div class="form-group">
        <label>Jumlah Cetak</label>
    <input type="text_jumlahcetak" name="jumlah_cetak" size="100"/ required>
    </div><br>
        
    <div class="form-group">    
        <label>Penerima</label>
    <input type="text_penerima" name="penerima" required>
    </div><br>
        
    <div class="form-group">    
        <label>Hubungan</label>
    <select class="form-control" type="option_hubungan" name="hubungan" required>
    <option value="">- - - Pilih Hubungan - - - </option>
    <option>Yang Bersangkutan</option>
    <option>Suami / Istri</option>
    <option>Anak</option>
    <option>Orang Tua</option>
    <option>Lainnya</option>
    </select>
    </div><br><br>

        <input type="submit" Value="Simpan" align="right">
    </form>
</div>
</body>
</html>