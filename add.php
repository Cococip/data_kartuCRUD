<?php
	//$id = $_GET['id'];
	$servername = "localhost";
	$username = "root";
	$pass = "";
	$dbname = "datacetakkartu";
	$con = mysqli_connect($servername,$username,$pass,$dbname);
	$kantor_cabang = $_POST['id_kantor_cabang'];
	$kabupaten_kota = $_POST['kabupaten_kota'];
	$tanggal_cetak = $_POST['tanggal_cetak'];
	$nomor_kartu = $_POST['nomor_kartu'];
	$nama_peserta = $_POST['nama_peserta'];
	$jenis_cetak = $_POST['jenis_cetak'];
	$jumlah_cetak = $_POST['jumlah_cetak'];
	$penerima = $_POST['penerima'];
	$hubungan = $_POST['hubungan'];
	$x = "INSERT INTO `input_data`(`id_kantor_cabang`, `kabupaten_kota`, `tanggal_cetak`, `nomor_kartu`, `nama_peserta`, `jenis_cetak`, `jumlah_cetak`, `penerima`, `hubungan`) VALUES ('".$kantor_cabang."','".$kabupaten_kota."','".$tanggal_cetak."','".$nomor_kartu."','".$nama_peserta."','".$jenis_cetak."','".$jumlah_cetak."','".$penerima."','".$hubungan."');";

	mysqli_query($con,$x);
	if($con ){
	echo "<script>alert('Data berhasil di tambahkan!');window.location.href='inputdata.php';</script>";
	} else{
	echo "<script>alert('Data berhasil di tambahkan!');history.go(-1);</script>";
	}

?>