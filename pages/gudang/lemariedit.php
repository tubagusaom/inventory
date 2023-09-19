<?php
ob_start();
if(isset($_GET['id']))
{
	$rs=mysql_query("Select * from lemari_obat where sha1(kode_lemari)='".$_GET['id']."'");
	$row=mysql_fetch_array($rs);
?>
<form name="form1" method="post" action="?cat=gudang&page=lemariedit&id=<?php echo $_GET['id']; ?>&edit=1">
	<div class="table-responsive">
    <table class=" table-aom">
      <tr>
        <td><label>Kategori Barang</label></td>
        <td><input type="text" name="namalemari" id="namalemari" value="<?php echo $row['nama_lemari']; ?>"></td>
      </tr>
      <tr>
        <td colspan="2">
					<input type="submit" class="btn btn-primary" name="button" id="button" value="Ubah" style="float:right">
					<input type="reset" class="btn btn-danger" name="reset" id="reset" value="Batal" onclick="window.location='?cat=gudang&page=jenis'" style="float:right; margin-right:10px">
        </td>
      </tr>
    </table>
  </div>
</form>
<?php
ob_end_flush();
}else{
	echo "<script>window.location='?cat=gudang&page=jenis'</script>";
}
?>
<?php
if(isset($_GET['edit']))
{

	$rs=mysql_query("Update lemari_obat SET nama_lemari='".$_POST['namalemari']."' Where sha1(kode_lemari)='".$_GET['id']."'");
	if($rs)
	{
		echo "<script>window.location='?cat=gudang&page=jenis'</script>";
	}
}
?>
