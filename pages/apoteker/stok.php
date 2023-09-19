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
FROM data_obat LEFT JOIN data_persediaan ON data_obat.kode_obat = data_persediaan.kode_obat");
	if($count_query === FALSE) {
    die(mysql_error());
	}
	$row     = mysql_fetch_array($count_query);
	$numrows = $row['numrows']; //dapatkan jumlah data

	$total_hals = ceil($numrows/$per_hal);


	//jalankan query menampilkan data per blok $offset dan $per_hal
  $query = mysql_query("SELECT
    data_obat.kode_obat, data_obat.nama_obat, data_obat.kode_lemari, jenis_obat.nama_jenis,
    data_persediaan.masuk, data_persediaan.keluar, data_persediaan.stok_tersedia
      FROM data_obat
    LEFT JOIN jenis_obat ON data_obat.kode_lemari = jenis_obat.kode_lemari
    LEFT JOIN data_persediaan ON data_obat.kode_obat = data_persediaan.kode_obat WHERE data_obat.stts_obat = '1'
    GROUP BY data_obat.kode_obat LIMIT $offset,$per_hal");

?>

<div>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td width="89%">&nbsp;</td>
    <td width="11%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>

        <td width="17%">
					Export To
					<a href='<?=$baseurl."pages/web/export-excel-stok-barang.php" ?>' target="_blank">
						<img src="img/excel.ico" border="1" width="32" height="32" alt="Tubagus Aom">
					</a>
				</td>

      </tr>
    </table></td>
  </tr>
</table>
</div>

<table style="margin-top:10px" width="100%" border="0" cellspacing="0" cellpadding="0" class="responsive table table-striped table-bordered">
<thead >
  <tr>
    <td colspan="5" class="no_sort">
			<h2>LAPORAN STOK OBAT</h2>
		</td>
  </tr>
  <tr>
    <th>Kode Obat</th>
    <th>Nama Obat</th>
    <th>jenis Obat</th>
    <th>Obat Masuk</th>
    <th>Obat Keluar</th>
    <th>Stok Tersedia</th>
    </tr>
  </thead>

<?php while($result = mysql_fetch_array($query)){ ?>
<tr >
    <td><?php echo $result['kode_obat']; ?></td>
    <td><?php echo $result['nama_obat']; ?></td>
    <td><?php echo $result['nama_jenis']; ?></td>
    <td><?php echo $result['masuk']; ?></td>
    <td><?php echo $result['keluar']; ?></td>
    <td><?php echo $result['stok_tersedia']; ?></td>
  </tr>
<?php } ?>

</table>
<?php
echo paginate($reload, $hal, $total_hals, $adjacents);
?>
