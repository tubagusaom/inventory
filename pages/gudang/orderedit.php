<?php
ob_start();
if(isset($_GET['id']))
{
	$rs=mysql_query("Select * from data_obat where sha1(kode_obat)='".$_GET['id']."'");
	$row=mysql_fetch_array($rs);
?>
<form name="form1" method="post" action="?cat=gudang&page=orderedit&id=<?php echo $_GET['id']; ?>&edit=1">

	<div class="table-responsive">
		<table class="table-aom">
			<tr>
				<td><label>Nama Obat</label></td>
				<td><input type="text" name="nama_obat" id="nama_obat" value="<?php echo $row['nama_obat']; ?>" readonly></td>
			</tr>
			<tr>
				<td><label>Lemari Obat</label></td>
				<td>
					<select name="kode_lemari" id="kode_lemari" required>
							<?php

                  $queryx = mysql_query("SELECT * FROM lemari_obat WHERE kode_lemari = '$row[kode_lemari]'");
                  if($queryx === FALSE) {
                    die(mysql_error());
                  }
                  $datax=mysql_fetch_array($queryx);

                  echo "<option value='$datax[0]'>$datax[1]</option>";

								 $queryy = mysql_query("SELECT * FROM lemari_obat WHERE kode_lemari NOT LIKE '$row[kode_lemari]'");
 								 if($queryy === FALSE) {
 									 die(mysql_error());
 								 }
								while($datay=mysql_fetch_array($queryy)){
									echo "<option value='$datay[0]'>$datay[1]</option>";
								}

                if ($row['stts_obat'] == "0") {
                  $val="Ajukan";
                }else {
                  $val="Ubah";
                }
							?>
						</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" class="btn btn-primary" name="button" id="button" value="<?=$val ?>" style="float:right;">
					<input type="reset" class="btn btn-danger" name="reset" id="reset" value="Batal" onclick="window.location='?cat=gudang&page=order'" style="float:right; margin-right:10px">
				</td>
			</tr>
		</table>
	</div>
</form>
<?php
ob_end_flush();
}else{
	echo "<script>window.location='?cat=gudang&page=order'</script>";
}
?>
<?php
if(isset($_GET['edit'])){
	$rs=mysql_query("Update data_obat SET nama_obat='".$_POST['nama_obat']."', kode_lemari='".$_POST['kode_lemari']."', stts_obat='2' Where sha1(kode_obat)='".$_GET['id']."' ");
	if($rs){
		echo "<script>window.location='?cat=gudang&page=order'</script>";
	}
}
?>
