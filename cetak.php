	
	<title>Cetak Data</title><br><br>
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

			$tampil = mysqli_query($con, "SELECT * FROM input_data");

			$no =1;
			while ($hasil= mysqli_fetch_array($tampil)) {
				?>
			<tr>
				<td><center><?php echo $no++; ?></center></td>
				<td><center><?php echo $hasil['kantor_cabang']; ?></center></td>
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