<?php
    
require_once "config.php";

$kantor_cabang = $_POST['kantor_cabang'];

$sql_kabupaten_kota = mysqli_query($con, "SELECT * FROM kabupaten_kota WHERE id_kantor_cabang = $kantor_cabang");

echo '<option> - - - Pilih Kabupaten / Kota - - -</option>';
while($row_kabupaten_kota = mysqli_fetch_array($sql_kabupaten_kota)) {
    echo '<option value="'.$row_kabupaten_kota['kabupaten_kota'].'">'.$row_kabupaten_kota['kabupaten_kota'].'</option>';
}
?>
