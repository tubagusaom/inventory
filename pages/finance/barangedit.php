<?php
ob_start();
if(isset($_GET['id']))
{
	$rs=mysql_query("Select * from data_finance where sha1(kode_obat)='".$_GET['id']."'");
	$row=mysql_fetch_array($rs);
?>
<form name="form1" method="post" action="?cat=finance&page=barangedit&id=<?php echo $_GET['id']; ?>&edit=1">

	<div class="table-responsive">
		<table class="table-aom">
			<tr>
				<td><label>Nama Transaksi</label></td>
				<td><input type="text" name="nama_obat" id="nama_obat" value="<?php echo $row['nama_obat']; ?>"></td>
			</tr>
			<tr>
				<td><label>jenis</label></td>
				<td>
					<select name="kode_lemari" id="kode_lemari" >
							<?php
								$queryx = mysql_query("SELECT * FROM lemari_uang WHERE kode_lemari = '$row[kode_lemari]'");
								 if($queryx === FALSE) {
									 die(mysql_error());
								 }
								 $datax=mysql_fetch_array($queryx);

								 echo "<option value='$datax[0]'>$datax[1]</option>";

								 $queryy = mysql_query("SELECT * FROM lemari_uang WHERE kode_lemari NOT LIKE '$row[kode_lemari]'");
 								 if($queryy === FALSE) {
 									 die(mysql_error());
 								 }
								while($datay=mysql_fetch_array($queryy)){
									echo "<option value='$datay[0]'>$datay[1]</option>";
								}
							?>
						</select>
				</td>
			</tr>
			<tr>
        <td><label>Keterangan</label></td>
        <td width="50%">
          <textarea name="keterangan_barang"><?=$row['keterangan_barang'] ?></textarea>
        </td>
      </tr>
			<tr>
				<td colspan="2">
					<input type="submit" class="btn btn-primary" name="button" id="button" value="Ubah" style="float:right;">
					<input type="reset" class="btn btn-danger" name="reset" id="reset" value="Batal" onclick="window.location='?cat=gudang&page=barang'" style="float:right; margin-right:10px">
				</td>
			</tr>
		</table>
	</div>
</form>
<?php
ob_end_flush();
}else{
	echo "<script>window.location='?cat=finance&page=barang'</script>";
}
?>
<?php
if(isset($_GET['edit'])){
	$rs=mysql_query("Update data_finance SET nama_obat='".$_POST['nama_obat']."', kode_lemari='".$_POST['kode_lemari']."', keterangan_barang='".$_POST['keterangan_barang']."' Where sha1(kode_obat)='".$_GET['id']."' ");
	if($rs){
		echo "<script>window.location='?cat=finance&page=barang'</script>";
	}
}
?>
