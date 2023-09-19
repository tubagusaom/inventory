<script src="js/jquery-ui.js"></script>
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
<script>
$(function() {
$("#datepicker3").datepicker({
		 dateFormat: "yy-mm-dd",
    });
});
$(function() {
$("#datepicker2").datepicker({
		 dateFormat: "yy-mm-dd",
    });
});

</script>
<h2>Laporan Barang Masuk dan Barang Keluar</h2>
<form name="form1" method="post" action="">
	<div class="table-responsive">
	  <table class=" table-aom">
	    <tr>
	      <td><label>Laporan</label></td>
	      <td>
					<select name="lp" id="lp">
			      <option value="masuk">Barang Masuk</option>
			      <option value="keluar">Barang Keluar</option>
			    </select>
				</td>

				<td><label>Cari tanggal</></td>
				<td><input type="text" name="tglr" id="datepicker3" placeholder="Pilih tanggal.." required /></td>

				<td><label>Hingga</label></td>
				<td><input type="text" name="tglr2" id="datepicker2" placeholder="Pilih tanggal.." required /></td>

				<td><input type="submit" name="submit" value="Cari" class="btn btn-primary"></td>
	    </tr>
	  </table>
	</div>
</form>
<?php

?>
<?php
	/* Koneksi database*/
	include 'pages/web/paging.php'; //include pagination _POST['lp']e

	//pagination variables
	$hal = (isset($_REQUEST['hal']) && !empty($_REQUEST['hal']))?$_REQUEST['hal']:1;
	$per_hal = 10; //berapa banyak blok
	$adjacents  = 10;
	$offset = ($hal - 1) * $per_hal;
	$reload="dashboard.php?cat=pimpinan&page=monthreporting";
	if(isset($_POST['submit']))
{
	?>
    <input type="hidden" value="<?php echo $_POST['tglr']; ?>" name="tgl1" />
<input type="hidden" value="<?php echo $_POST['tglr2']; ?>" name="tgl2" />
    <?php
	echo "Pencarian <b style='color:#449d44'>Barang ".$_POST['lp']."</b> tanggal <b style='color:#449d44'>". date("d M Y", strtotime($_POST['tglr']))."</b> s/d <b style='color:#449d44'>".date("d M Y", strtotime($_POST['tglr2']))."</b>";
	//Cari berapa banyak jumlah data*/
	$count_query=mysql_query("SELECT COUNT(ID_".$_POST['lp'].") AS numrows FROM obat_".$_POST['lp']."
		LEFT JOIN data_obat ON obat_".$_POST['lp'].".kode_obat = data_obat.kode_obat  WHERE tgl BETWEEN '".$_POST['tglr']."' AND '".$_POST['tglr2']."' GROUP BY ID_".$_POST['lp']."");

	$count_query2   = mysql_query("SELECT COUNT(ID_".$_POST['lp'].") AS numrows FROM obat_".$_POST['lp']." Where tgl BETWEEN '".$_POST['tglr']."' AND '".$_POST['tglr2']."'");
	if($count_query === FALSE) {
    die(mysql_error());
	}
	$row     = mysql_fetch_array($count_query);
	$numrows = $row['numrows']; //dapatkan jumlah data

	$total_hals = ceil($numrows/$per_hal);


	//jalankan query menampilkan data per blok $offset dan $per_hal
	$query2 = mysql_query("SELECT * from obat_".$_POST['lp']." Where tgl BETWEEN '".$_POST['tglr']."' AND '".$_POST['tglr2']."' GROUP BY ID_".$_POST['lp']." LIMIT $offset,$per_hal");
	$query=mysql_query("SELECT obat_".$_POST['lp'].".tgl, obat_".$_POST['lp'].".kode_obat, data_obat.nama_obat, data_obat.kode_lemari, lemari_obat.nama_lemari, obat_".$_POST['lp'].".jumlah, user_login.*
	FROM obat_".$_POST['lp']."
		LEFT JOIN data_obat ON obat_".$_POST['lp'].".kode_obat = data_obat.kode_obat
		LEFT JOIN lemari_obat ON data_obat.kode_lemari = lemari_obat.kode_lemari
		LEFT JOIN user_login ON obat_".$_POST['lp'].".username = user_login.username
		WHERE tgl BETWEEN '".$_POST['tglr']."' AND '".$_POST['tglr2']."' GROUP BY ID_".$_POST['lp']." LIMIT $offset,$per_hal");

?>
<?php
if($numrows > 0 )
{
?>
<div>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td width="89%">&nbsp;</td>
    <td width="11%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>

				<td width="17%">
					Export To
					<a href='<?=$baseurl."pages/web/export-excel-barang.php?tgl1=".$_POST['tglr']."&tgl2=".$_POST['tglr2']."&field=".$_POST['lp']; ?>' target="_blank">
						<img src="img/excel.ico" border="1" width="32" height="32" alt="Tubagus Aom">
					</a>
				</td>

      </tr>
    </table></td>
  </tr>
</table>
</div>
<?php
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="responsive table table-striped table-bordered">
  <thead>
  <tr>
    <td colspan="7" align="right" class="no_sort">
			<h2>Laporan Barang <?=$_POST['lp']; ?></h2>
		</td>
  </tr>
  <tr>
    <th class="no_sort">Tanggal Transaksi</th>
    <th class="no_sort">Kode Barang</th>
		<th class="no_sort">Kategori</th>
    <th class="no_sort">Nama Barang</th>
    <th class="no_sort">Jumlah</th>
		<th class="no_sort" colspan="2" style="text-align:center; width:18%">Created</th>
  </tr>
  </thead>
<?php
while($result = mysql_fetch_array($query)){
?>
<tr >

    <td width="15%"><?php echo date("d M Y", strtotime($result['tgl'])); ?></td>
    <td><?php echo $result['kode_obat']; ?></td>
		<td><?php echo $result['nama_lemari']; ?></td>
    <td><?php echo $result['nama_obat']; ?></td>
    <td><?php echo $result['jumlah']; ?></td>
		<td><?=$result['login_hash']; ?></td>
		<td style="border-left: none">| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$result['nama_user']; ?></td>
  </tr>
<?php
}
?>
</table>
<?php
echo paginate($reload, $hal, $total_hals, $adjacents);
?>
<?php
}
?>
