<?php
ob_start();
?>
<h2 style="padding-bottom:10px">Permintaan Obat</h2>
<form name="form1" method="post" action="?cat=apoteker&page=order&act=1">

  <div class="table-responsive">
    <table class=" table-aom">
      <tr>
        <td><label>Nama Obat</label></td>
        <td><input type="text" name="namaobat" id="namaobat"></td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="submit" class="btn btn-primary" name="button" id="button" value="Tambah" style="float:right;">
          <input type="reset" class="btn btn-danger" name="reset" id="reset" value="Reset" style="float:right; margin-right:10px">
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
include("pages/apoteker/orderview.php");
?>
</span>
<?php
if(isset($_GET['act']))
{

	$rs=mysql_query("Insert into data_obat (`nama_obat`,`kode_jenis`,`stts_obat`) values ('".$_POST['namaobat']."','','0')") or die(mysql_error());
	if($rs)
	{

		echo "<script>window.location='?cat=apoteker&page=order'</script>";
	}
}
?>

<?php
if(isset($_GET['del']))
{
	$ids=$_GET['id'];
	$ff=mysql_query("Delete from data_obat Where sha1(kode_obat)='".$ids."'");
	if($ff)
	{
		echo "<script>window.location='?cat=apoteker&page=order'</script>";
	}
}
?>
