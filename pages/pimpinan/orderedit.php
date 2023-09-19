<?php
ob_start();
if(isset($_GET['id']))
{
	$rs=mysql_query("Select * from data_obat where sha1(kode_obat)='".$_GET['id']."'");
	$row=mysql_fetch_array($rs);
?>
<script src="js/jquery-ui.js"></script>
<h2 style="padding-bottom:10px">Persetujuan Permintaan Obat</h2>
<form name="form1" method="post" action="" autocomplete="on">
  <div class="table-responsive">
    <table class=" table-aom">
      <tr>
        <td><label>Tanggal</label></td>
        <td><input type="text" name="tglr" id="datepicker" placeholder="Pilih tanggal.." required /></td>
      </tr>
      <tr>
        <td><label>Kode Obat</label></td>
        <td><input type="text" name="kodeobat" id="kodeobat" value="<?php echo $row['kode_obat']; ?>" class="full-width" readonly="readonly" style="background:#ddd"></td>
      </tr>
      <tr>
        <td><label>Nama Obat</label></td>
        <td><input name="namaobat" type="text" id="namaobat" value="<?php echo $row['nama_obat']; ?>"></td>
      </tr>
      <tr>
        <td><label>Jumlah</label></td>
        <td>
          <input type="number" name="qty" id="qty" required >
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="submit" class="btn btn-primary float-right" name="button" id="button" value="Tambah" style="float:right">
        </td>
      </tr>
    </table>
  </div>
</form>

<?php
ob_end_flush();
}else{
	echo "<script>window.location='?cat=pimpinan&page=order'</script>";
}
?>

<?php
if(isset($_POST['button']))
{
  $newDate = date("Y-m-d", strtotime($_POST['tglr']));
	$q=mysql_query("Insert into obat_masuk (`tgl`,`kode_obat`,`jumlah`,`username`) values ('".$newDate."','".$_POST['kodeobat']."','".$_POST['qty']."','".$_SESSION['login_user']."')") or die(mysql_error());
	$q2=mysql_query("Select * from data_persediaan where kode_obat='".$_POST['kodeobat']."'");
	$rc=mysql_num_rows($q2);
	if($rc==1)
	{
		$q3=mysql_query("Update data_persediaan SET masuk=masuk + ".$_POST['qty'].",stok_tersedia=stok_tersedia + ".$_POST['qty']." Where kode_obat='".$_POST['kodeobat']."'");
		if($q3)
		{
			echo "Data sudah disimpan";
		}
	}else{
    $rs=mysql_query("Update data_obat SET nama_obat='".$_POST['namaobat']."', stts_obat='1' Where sha1(kode_obat)='".$_GET['id']."' ");
		$q4=mysql_query("Insert into data_persediaan (`kode_persediaan`,`kode_obat`,`masuk`,`stok_tersedia`) values ('','".$_POST['kodeobat']."','".$_POST['qty']."','".$_POST['qty']."')");
		if($q4 AND $rs)
		{
			echo "<script>window.location='?cat=pimpinan&page=order'</script>";
		}
	}
}
?>
