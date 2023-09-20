<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tampil Barang</title>

	<?php
include("../../_db.php");
?>
<link rel="stylesheet" href="../../css/style.default.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function sendValue (s,s2){

window.opener.document.getElementById('kodeobat').value = s;
window.opener.document.getElementById('namaobat').value = s2;
window.close();
}
//  End -->
</script>

<style>
.pagin {
padding: 10px 0;
font:bold 11px/30px arial, serif;
}
.pagin * {
padding: 2px 6px;
color:#0A7EC5;
margin: 2px;
border-radius:3px;
}
.pagin a {
		border:solid 1px #8DC5E6;
		text-decoration:none;
		background:#F8FCFF;
		padding:6px 7px 5px;
}

.pagin span, a:hover, .pagin a:active,.pagin span.current {
		color:#FFFFFF;
		background:-moz-linear-gradient(top,#B4F6FF 1px,#63D0FE 1px,#58B0E7);

}
.pagin span,.current{
	padding:8px 7px 7px;
}
.content{
	padding:10px;
	font:bold 12px/30px gegoria,arial,serif;
	border:1px dashed #0686A1;
	border-radius:5px;
	background:-moz-linear-gradient(top,#E2EEF0 1px,#CDE5EA 1px,#E2EEF0);
	margin-bottom:10px;
	text-align:left;
	line-height:20px;
}
.outer_div{
	margin:auto;
	width:600px;
}
#loader{
	position: absolute;
	text-align: center;
	top: 75px;
	width: 100%;
	display:none;
}

</style>
</head>

<body>
	
<h2 style="text-align:center; padding:15px 5px 5px 5px;color:#634927">Data Barang</h2>
<?php
	/* Koneksi database*/
	include 'paging.php'; //include pagination file

	//pagination variables
	$hal = (isset($_REQUEST['hal']) && !empty($_REQUEST['hal']))?$_REQUEST['hal']:1;
	$per_hal = 5; //berapa banyak blok
	$adjacents  = 5;
	$offset = ($hal - 1) * $per_hal;
	$reload="viewbarang.php?";
	//Cari berapa banyak jumlah data*/

	$count_query   = mysqli_query($koneksi, "SELECT COUNT(data_obat.kode_obat) AS numrows,data_obat.kode_obat, data_obat.nama_obat, data_obat.kode_lemari, data_persediaan.stok_tersedia
FROM data_obat LEFT JOIN data_persediaan ON data_obat.kode_obat = data_persediaan.kode_obat");
	if($count_query === FALSE) {
    die(mysql_error());
	}
	$row     = mysqli_fetch_array($count_query);
	$numrows = $row['numrows']; //dapatkan jumlah data

	$total_hals = ceil($numrows/$per_hal);

	//jalankan query menampilkan data per blok $offset dan $per_hal
	$query = mysqli_query($koneksi, "SELECT
		data_obat.kode_obat,
		data_obat.nama_obat,
		data_obat.kode_lemari,
		data_obat.keterangan_barang,
		lemari_obat.nama_lemari,
		data_persediaan.stok_tersedia
		FROM data_obat
			LEFT JOIN data_persediaan ON data_obat.kode_obat = data_persediaan.kode_obat
			LEFT JOIN lemari_obat ON data_obat.kode_lemari = lemari_obat.kode_lemari WHERE data_obat.stts_obat = '1'
			GROUP BY data_obat.kode_obat LIMIT $offset,$per_hal");

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="responsive table table-striped table-bordered" style="background:whitesmoke">
<thead>
  <tr>
    <td colspan="3" class="no_sort"></td>
    <td colspan="2" class="no_sort"></td>
  </tr>
  <tr>
    <th style="background: burlywood!important;color:#634927!important" class="no_sort">Barang</th>
	<th style="background: burlywood!important;color:#634927!important" class="no_sort">Etalase</th>
    <th style="background: burlywood!important;color:#634927!important" class="no_sort">Catatan</th>
    <th style="background: burlywood!important;color:#634927!important" class="no_sort">Stok Tersedia</th>
    <th style="background: burlywood!important;color:#634927!important;text-align:center" class="no_sort">-</th>
    </tr>
  </thead>
<?php
while($result = mysqli_fetch_array($query)){
?>
<tr >

		<td><?php echo $result['nama_lemari']; ?></td>
    <td><?php echo $result['nama_obat']; ?></td>
    <td><?php echo $result['keterangan_barang']; ?></td>
    <td><?php echo $result['stok_tersedia']; ?></td>
    <?php $ids=sha1($result['kode_obat']); ?>
    <td style="text-align:center">
			<a href="#" onClick="sendValue('<?php echo $result['kode_obat']; ?>','<?php echo $result['nama_obat']; ?>');">
				<span class="btn btn-success" style="border-radius:4px!important;">Pilih</span>
			</a>
		</td>

  </tr>
<?php
}
?>
</table>
<?php
echo paginate($reload, $hal, $total_hals, $adjacents);
?>


</body>

</html>

