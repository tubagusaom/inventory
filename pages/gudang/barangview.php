<link rel="stylesheet" href="../../css/style.default.css" type="text/css">
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

<?php
	/* Koneksi database*/
	include 'pages/web/paging.php'; //include pagination file

	//pagination variables
	$hal = (isset($_REQUEST['hal']) && !empty($_REQUEST['hal']))?$_REQUEST['hal']:1;
	$per_hal = 5; //berapa banyak blok
	$adjacents  = 5;
	$offset = ($hal - 1) * $per_hal;
	$reload="?cat=gudang&page=barang";
	//Cari berapa banyak jumlah data*/

	$count_query   = mysql_query("SELECT COUNT(data_obat.kode_obat) AS numrows,data_obat.kode_obat, data_obat.nama_obat, data_obat.kode_lemari, data_persediaan.stok_tersedia
		FROM data_obat LEFT JOIN data_persediaan ON data_obat.kode_obat = data_persediaan.kode_obat" );
	if($count_query === FALSE) {
    die(mysql_error());
	}
	$row     = mysql_fetch_array($count_query);
	$numrows = $row['numrows']; //dapatkan jumlah data

	$total_hals = ceil($numrows/$per_hal);


	//jalankan query menampilkan data per blok $offset dan $per_hal
	$query = mysql_query("SELECT
		data_obat.kode_obat,
		data_obat.nama_obat,
		data_obat.kode_lemari,
		data_obat.keterangan_barang,
		lemari_obat.nama_lemari
			FROM data_obat
				LEFT JOIN lemari_obat ON data_obat.kode_lemari = lemari_obat.kode_lemari
				WHERE data_obat.stts_obat = '1'
		-- LEFT JOIN data_persediaan ON data_obat.kode_obat = data_persediaan.kode_obat
		ORDER BY data_obat.kode_lemari LIMIT $offset,$per_hal");

?>
<table style="margin-top:10px" width="100%" border="0" cellspacing="0" cellpadding="0" class="responsive table table-striped table-bordered">
<thead >
  <tr>
    <td colspan="5" class="no_sort">
			<h2>DATA BARANG</h2>
		</td>
  </tr>
  <tr>
		<th width="5%" style="text-align:center; background:#ece8e8">No</th>
    <th style="background:#ece8e8">Kode Barang</th>
    <th style="background:#ece8e8">Kategori</th>
    <th style="background:#ece8e8">Nama Barang</th>
    <th style="background:#ece8e8">Keterangan</th>
    <!-- <th>Stok Tersedia</th> -->
    <td width="20%" style="text-align:center; background:#ece8e8">-</th>
    </tr>
  </thead>

<?php
	$no=1;
	while($result = mysql_fetch_array($query)){
?>
<tr >
		<td width="5%" style="text-align:center"><?=$no?>.</td>
    <td><?php echo $result['kode_obat']; ?></td>
    <td><?php echo $result['nama_lemari']; ?></td>
    <td><?php echo $result['nama_obat']; ?></td>
    <td><?php echo $result['keterangan_barang']; ?></td>
    <!-- <td><?php echo $result['stok_tersedia']; ?></td> -->

    <td style="text-align: center">
			<a href="?cat=gudang&page=barangedit&id=<?php echo sha1($result['kode_obat']); ?>" class="a-aom">Edit</a> -
			<a href="?cat=gudang&page=barang&del=1&id=<?php echo sha1($result['kode_obat']); ?>" class="a-aom" onclick="return confirm('apakah anda yakin hapus?')">Hapus</a>
		</td>
  </tr>
<?php $no++;} ?>

</table>
<?php
echo paginate($reload, $hal, $total_hals, $adjacents);
?>
