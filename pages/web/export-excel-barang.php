<style media="screen">
	*{
		font-family: sans-serif;
	}

	table tr th{
		padding: 10px;
	}
	table tr td{
		padding: 6px;
	}
</style>

<?php
include("../../_db.php");
	$tg1 = (isset($_REQUEST['tgl1']) && !empty($_REQUEST['tgl1']))?$_REQUEST['tgl1']:"";
	$tg2 = (isset($_REQUEST['tgl2']) && !empty($_REQUEST['tgl2']))?$_REQUEST['tgl2']:"";
	$fil = (isset($_REQUEST['field']) && !empty($_REQUEST['field']))?$_REQUEST['field']:"";

	$result=mysql_query("SELECT obat_".$fil.".tgl, obat_".$fil.".kode_obat, data_obat.nama_obat, data_obat.kode_lemari, lemari_obat.nama_lemari, obat_".$fil.".jumlah, user_login.*
		FROM obat_".$fil."
			LEFT JOIN data_obat ON obat_".$fil.".kode_obat = data_obat.kode_obat
			LEFT JOIN lemari_obat ON data_obat.kode_lemari = lemari_obat.nama_lemari
			LEFT JOIN user_login ON obat_".$fil.".username = user_login.username
			Where tgl BETWEEN '".$tg1."' AND '".$tg2."' GROUP BY ID_".$fil."") or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());;

$filename="Laporan-Obat-$fil-$tg1-$tg1";
$file_ending = "xls";

if ($fil=="keluar") {
	$jenis="KELUAR";
}else {
	$jenis="MASUK";
}

$A=substr($tg1,8);
$b=substr($tg1,5,2);
$c=substr($tg1,0,4);

$d=substr($tg2,8);
$e=substr($tg2,5,2);
$f=substr($tg2,0,4);

//header info for browser
header("Content-Type: application/ms-excel");
header("Content-Disposition: attachment; filename=$filename.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>

<table border="1" style="width:100%">
		<tr>
			<th colspan="7" align="center">
				<b style="font-size:20px;">LAPORAN BARANG <?=$jenis?> "TULIV"</b> <br>
				<font>tanggal <?="$A-$b-$c"; ?> s/d <?="$d-$e-$f"; ?></font>
			</th>
		</tr>

    <tr align="center">
      <th style="width:10%">Tanggal Transaksi</th>
      <th style="width:5%">Kode Barang</th>
      <th style="width:35%">Nama Barang</th>
      <th style="width:25%">jenis Barang</th>
			<th style="width:5%">Jumlah</th>
			<th style="width:25%; text-align:center;" colspan="2">Created</th>
    </tr>

		<?php
		while($row = mysql_fetch_array($result)) {
			$g=substr($row['tgl'],8);
			$h=substr($row['tgl'],5,2);
			$i=substr($row['tgl'],0,4);
		?>
		<tr>
      <td align="left"><?="$g-$h-$i"; ?></td>
      <td align="left"><?=$row['kode_obat']; ?></td>
      <td align="left"><?=$row['nama_obat']; ?></td>
      <td align="left"><?=$row['nama_jenis']; ?></td>
			<td align="right"><?=$row['jumlah']; ?></td>
			<td style="border-right: none"><?=$row['login_hash']; ?></td>
			<td style="border-left: none">| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$row['nama_user']; ?></td>
    </tr>
		<?php } ?>
</table>
