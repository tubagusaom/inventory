<?php
ob_start();
?>
<form name="form1" method="post" action="?cat=finance&page=jenis&act=1">
  <div class="table-responsive">
    <table class=" table-aom">
      <tr>
        <td><label>Jenis Transaksi</label></td>
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
include("pages/finance/lemariview.php");
?>
</span>

<?php
if(isset($_GET['act']))
{
	$rs=mysql_query("Insert into lemari_uang (`nama_lemari`) values ('".$_POST['nama_lemari']."')") or die(mysql_error());
	if($rs)
	{
		echo "<script>window.location='?cat=finance&page=jenis'</script>";
	}
}
?>

<?php
if(isset($_GET['del']))
{
	$ids=$_GET['id'];
	$ff=mysql_query("Delete from lemari_uang Where sha1(kode_lemari)='".$ids."'");
	if($ff)
	{
		echo "<script>window.location='?cat=finance&page=jenis'</script>";
	}
}
?>
