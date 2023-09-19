<?php ob_start(); ?>

<script src="js/jquery-ui.js"></script>
<h2 style="padding-bottom:10px">Input Barang Keluar</h2>
<form name="form1" method="post" action="" autocomplete="on">

  <div class="table-responsive">
    <table class=" table-aom">
      <tr>
        <td><label>Tanggal</label></td>
        <td><input type="text" name="tglr" id="datepicker" placeholder="Pilih tanggal.."/ required></td>
      </tr>
      <tr>
        <td><label>Kode Barang</label></td>
        <td><input type="text" name="kodeobat" class="full-width" id="kodeobat" placeholder="Pilih Barang.."  onClick="window.open('<?php echo $baseurl; ?>pages/web/viewbarang.php','popuppage','width=700,toolbar=0,resizable=0,scrollbars=no,height=400,top=100,left=100');" required></td>
      </tr>
      <tr>
        <td><label>Nama Barang</label></td>
        <td><input name="namaobat" type="text" id="namaobat" readonly="readonly" style="background:#ddd"></td>
      </tr>
      <tr>
        <td><label>Jumlah</label></td>
        <td>
          <input type="number" name="qty" id="qty" required>
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

	$q2=mysql_query("Select * from data_persediaan where kode_obat='".$_POST['kodeobat']."'");
	$rw=mysql_fetch_array($q2);
	$rc=mysql_num_rows($q2);
	if($rc==1)
	{
		if($_POST['qty'] <= $rw['stok_tersedia'])
		{
			$q=mysql_query("Insert into obat_keluar (`tgl`,`kode_obat`,`jumlah`,`username`) values ('".$newDate."','".$_POST['kodeobat']."','".$_POST['qty']."','".$_SESSION['login_user']."')") or die(mysql_error());
			if($q)
			{
				$qr=mysql_query("Select sum(jumlah) as jl from obat_keluar Where kode_obat='".$_POST['kodeobat']."'");
				$rw22=mysql_fetch_array($qr);

				$q3=mysql_query("Update data_persediaan SET keluar=".$rw22['jl'].",stok_tersedia=stok_tersedia - ".$_POST['qty']." Where kode_obat='".$_POST['kodeobat']."'");
				if($q3)
				{
					echo "<script>window.location='?cat=tuliv&page=sell'</script>";
				}
			}
		}else{
		  echo "<b><h2 style='color:red; text-align:center; padding-top:20px'>Stok Barang kurang</h2></b>";
		}
	}else{
		echo "<b><h2 style='color:red; text-align:center; padding-top:20px'>Stok Barang kosong !..</h2></b>";
	}
}
?>

<?php
ob_end_flush();
?>
<p></p>
<p></p>
<p></p>
<p></p>
<p></p>
<p></p>
<span>
<?php
include("pages/tuliv/stok.php");
?>
</span>
