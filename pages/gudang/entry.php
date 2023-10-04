<script src="js/jquery-ui.js"></script>
<h2 style="padding-bottom:10px">Tambah Barang Masuk</h2>
<form name="form1" method="post" action="" autocomplete="on">
  <div class="table-responsive">
    <table class=" table-aom">
      <tr>
        <td><label>Tanggal</label></td>
        <td><input type="text" name="tglr" id="datepicker" placeholder="Pilih tanggal.." required /></td>
      </tr>
      <tr>
        <td><label>Kode Barang</label></td>
        <td>
          <!-- <input type="text" name="kodeobat" id="kodeobat" placeholder="Pilih Barang.." class="full-width"  onClick="window.open('<?= base_url(); ?>pages/web/viewbarang.php','popuppage','width=700,toolbar=0,resizable=0,scrollbars=no,height=400,top=100,left=100');" required> -->
          <input type="text" name="kodeobat" id="kodeobat" class="full-width" placeholder="Pilih Barang.." required>
        </td>
      </tr>
      <tr>
        <td><label>Nama Barang</label></td>
        <td><input name="namaobat" type="text" id="namaobat" readonly="readonly" style="background:#ddd"></td>
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
		$q4=mysql_query("Insert into data_persediaan (`kode_obat`,`masuk`,`stok_tersedia`) values ('".$_POST['kodeobat']."','".$_POST['qty']."','".$_POST['qty']."')");
		if($q4)
		{
			echo "Data sudah disimpan";
		}
	}
}
?>

<?php include("pages/web/popup_viewbarang.php"); ?>
