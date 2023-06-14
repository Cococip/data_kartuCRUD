<?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=\"laporan-excel.xls\"");

?>
	
	<p align="center" style="font-weight: bold; font-size: 26pt">LAPORAN DATA CETAK KARTU</p>

	<td><center><b><?php
		if (isset($_GET['tanggal1'])) {
				$tanggal1 = $_GET['tanggal1'];
				$tanggal2 = $_GET['tanggal2'];
			echo "Dari Tanggal " .$tanggal1. "Sampai Tanggal ".$tanggal2;
		}
	?></b></center>
	<br>

	<center><table border="1">
		<tr>
			<th>No</th>
			<th>Kantor Cabang</th>
			<th>Kabupaten/Kota</th>
			<th>Tanggal Cetak</th>
			<th>Nomor Kartu</th>
			<th>Nama Peserta</th>
			<th>Jenis Cetak</th>
			<th>Jumlah Cetak</th>
			<th>Penerima</th>
			<th>Hubungan</th>
		</tr></center>

		<?php
			include"config.php";

			if(isset($_GET['cari'])){
				$cari = $_GET['cari'];
				$tampil = mysqli_query($con, "SELECT * FROM input_data WHERE kabupaten_kota like '%".$cari."%' or kantor_cabang like '%".$cari."%' or tanggal_cetak like '%".$cari."%' or nomor_kartu like '%".$cari."%' or nama_peserta like '%".$cari."%' or jenis_cetak like '%".$cari."%' or jumlah_cetak like '%".$cari."%' or penerima like '%".$cari."%' or hubungan like '%".$cari."%'");
			} elseif (isset($_GET['tanggal1'])) {
				$tanggal1 = $_GET['tanggal1'];
				$tanggal2 = $_GET['tanggal2'];
				$tampil = mysqli_query($con, "SELECT * FROM input_data WHERE tanggal_cetak BETWEEN '".$tanggal1."' AND '".$tanggal2."'");
			} else{
				$tampil = mysqli_query($con, "SELECT * FROM input_data");
			}
			
	

			$no =1;
			while ($hasil = mysqli_fetch_array($tampil)) {
				$kantorCabang = $this->getKantorCabang($hasil['id_kantor_cabang']);
				?>
			<tr>
				<td><center><?php echo $no++; ?></center></td>
				<td><center><?php echo $kantorCabang ?></center></td>
				<td><center><?php echo $hasil['kabupaten_kota']; ?></center></td>
				<td><center><?php echo $hasil['tanggal_cetak']; ?></center></td>
				<td><center><?php echo $hasil['nomor_kartu']; ?></center></td>
				<td><center><?php echo $hasil['nama_peserta']; ?></center></td>
				<td><center><?php echo $hasil['jenis_cetak']; ?></center></td>
				<td><center><?php echo $hasil['jumlah_cetak']; ?></center></td>
				<td><center><?php echo $hasil['penerima']; ?></center></td>
				<td><center><?php echo $hasil['hubungan']; ?></center></td>
			</tr>
			<?php
			}
		?>
	</table>

	<script>
		window.print();
	</script>
</body>
</html>