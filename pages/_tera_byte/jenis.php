<?php
ob_start();
?>
<form name="form1" method="post" action="?cat=gudang&page=lemari&act=1">
  <div class="table-responsive">
    <table class=" table-aom">
      <tr>
        <td><label>Nama Lemari Obat</label></td>
        <td><input type="text" name="nama_lemari" id="nama_lemari" required></td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="submit" class="btn btn-primary" name="button" id="button" value="Tambah" style="float:right">
        </td>
      </tr>
    </table>
  </div>
</form>
<?php
ob_end_flush();
?>
<p></p>
<p></p>
<span>
<?php
include("pages/gudang/lemariview.php");
?>
</span>

<?php
if(isset($_GET['act']))
{
	$rs=mysql_query("Insert into lemari_obat (`nama_lemari`) values ('".$_POST['nama_lemari']."')") or die(mysql_error());
	if($rs)
	{
		echo "<script>window.location='?cat=gudang&page=lemari'</script>";
	}
}
?>

<?php
if(isset($_GET['del']))
{
	$ids=$_GET['id'];
	$ff=mysql_query("Delete from lemari_obat Where sha1(kode_lemari)='".$ids."'");
	if($ff)
	{
		echo "<script>window.location='?cat=gudang&page=lemari'</script>";
	}
}
?>
