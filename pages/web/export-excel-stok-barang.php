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


$query = mysqli_query($koneksi, "SELECT
  data_obat.kode_obat, data_obat.nama_obat, data_obat.kode_lemari, lemari_obat.nama_lemari,
  data_persediaan.masuk, data_persediaan.keluar, data_persediaan.stok_tersedia
    FROM data_obat
  LEFT JOIN lemari_obat ON data_obat.kode_lemari = lemari_obat.kode_lemari
  LEFT JOIN data_persediaan ON data_obat.kode_obat = data_persediaan.kode_obat WHERE data_obat.stts_obat = '1'
  GROUP BY data_obat.kode_obat");

$filename="Laporan-Stok-Obat-Periode-".date("M-Y");

header("Content-Type: application/ms-excel");
header("Content-Disposition: attachment; filename=$filename.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>

<table border="1" style="width:100%">
		<tr>
			<th colspan="6" align="center">
				<b style="font-size:20px;">LAPORAN STOK BARANG "___"</b> <br>
				<font>Periode <?=date("M-Y"); ?></font>
			</th>
		</tr>

    <tr align="center">
      <th style="width:5%">Kode Barang</th>
      <th style="width:35%">Nama Barang</th>
      <th style="width:30%">Kategori</th>
      <th style="width:10%">Barang Masuk</th>
			<th style="width:10%">Barang Keluar</th>
      <th style="width:10%">Stok Tersedia</th>
    </tr>

		<?php
		while($result = mysqli_fetch_array($query)){
		?>
		<tr>
      <td align="left"><?=$result['kode_obat']; ?></td>
      <td align="left"><?=$result['nama_obat']; ?></td>
      <td align="left"><?=$result['nama_lemari']; ?></td>
      <td align="right"><?=$result['masuk']; ?></td>
			<td align="right"><?=$result['keluar']; ?></td>
      <td align="right"><?=$result['stok_tersedia']; ?></td>
    </tr>
		<?php } ?>
</table>
