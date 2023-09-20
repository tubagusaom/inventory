<link rel="stylesheet" href="<?=base_url()?>css/style.default.css" type="text/css">
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

	$count_query   = mysqli_query($koneksi, "SELECT COUNT(data_obat.kode_obat) AS numrows,data_obat.kode_obat, data_obat.nama_obat, data_obat.kode_lemari, data_persediaan.stok_tersedia
FROM data_obat LEFT JOIN data_persediaan ON data_obat.kode_obat = data_persediaan.kode_obat");
	if($count_query === FALSE) {
    die(mysqli_error());
	}
	$row     = mysqli_fetch_array($count_query);
	$numrows = $row['numrows']; //dapatkan jumlah data

	$total_hals = ceil($numrows/$per_hal);


	//jalankan query menampilkan data per blok $offset dan $per_hal
	$query = mysqli_query($koneksi, "SELECT
		data_obat.kode_obat, data_obat.nama_obat, data_obat.stts_obat, jenis_obat.nama_jenis
			FROM data_obat
		    LEFT JOIN jenis_obat ON data_obat.kode_lemari = jenis_obat.kode_lemari WHERE data_obat.stts_obat NOT LIKE '1'
		-- LEFT JOIN data_persediaan ON data_obat.kode_obat = data_persediaan.kode_obat
		GROUP BY data_obat.kode_obat LIMIT $offset,$per_hal");

?>
<table style="margin-top:10px" width="100%" border="0" cellspacing="0" cellpadding="0" class="responsive table table-striped table-bordered">
<thead >
  <tr>
    <td colspan="5" class="no_sort">
			<h2>Data Permintaan Obat</h2>
		</td>
  </tr>
  <tr>
    <th>Kode Obat</th>
    <th>Nama Obat</th>
    <th>Status Permintaan</th>
    <th>&nbsp;</th>
    </tr>
  </thead>

<?php
  while($result = mysqli_fetch_array($query)){
    if ($result['stts_obat'] == "0") {
      $status_obat="Permintaan Baru";
    }else if ($result['stts_obat'] == "2") {
      $status_obat="Proses";
    }else {
      $status_obat="";
    }
?>
<tr >
    <td><?php echo $result['kode_obat']; ?></td>
    <td><?php echo $result['nama_obat']; ?></td>
    <td><?php echo $status_obat; ?></td>

    <?php if ($result['stts_obat'] == "0") { ?>

    <td>
			<a href="?cat=toko&page=ordergedit&id=<?php echo sha1($result['kode_obat']); ?>" class="a-aom">Edit</a> -
			<a href="?cat=toko&page=order&del=1&id=<?php echo sha1($result['kode_obat']); ?>" class="a-aom" onclick="return confirm('apakah anda yakin hapus?')">Hapus</a>
		</td>

	<?php }else { echo "<td>-</td>";} ?>
  </tr>
<?php } ?>

</table>
<?php
echo paginate($reload, $hal, $total_hals, $adjacents);
?>
