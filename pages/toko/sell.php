<style>
.modalvbr {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modalvbr-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.closevbr {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.closevbr:hover,
.closevbr:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.conmodal {
  width: 100%;
  background-color: red;
  z-index: 1060;
}
</style>

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
        <td>
          <!-- <input type="text" name="kodeobat" class="full-width" id="kodeobat" placeholder="Pilih Barang.." onClick="window.open('<?=base_url();?>pages/web/viewbarang.php','popuppage','width=700,toolbar=0,resizable=0,scrollbars=no,height=400,top=100,left=100');" required> -->
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

	$q2=mysqli_query($koneksi, "Select * from data_persediaan where kode_obat='".$_POST['kodeobat']."'");
	$rw=mysqli_fetch_array($q2);
	$rc=mysqli_num_rows($q2);
	if($rc==1)
	{
		if($_POST['qty'] < $rw['stok_tersedia'])
		{
			$q=mysqli_query($koneksi, "Insert into obat_keluar (`tgl`,`kode_obat`,`jumlah`,`username`) values ('".$newDate."','".$_POST['kodeobat']."','".$_POST['qty']."','".$_SESSION['login_user']."')") or die(mysqli_connect_error());
			if($q)
			{
				$qr=mysqli_query($koneksi, "Select sum(jumlah) as jl from obat_keluar Where kode_obat='".$_POST['kodeobat']."'");
				$rw22=mysqli_fetch_array($qr);

				$q3=mysqli_query($koneksi, "Update data_persediaan SET keluar=".$rw22['jl'].",stok_tersedia=stok_tersedia - ".$_POST['qty']." Where kode_obat='".$_POST['kodeobat']."'");
				if($q3)
				{
          echo "<script>alert('Data sudah disimpan'); location.href='?cat=toko&page=sell'</script>";
				}
			}
		}else{
		  echo "<b><h2 style='color:red; text-align:center; padding-top:20px'>Stok Barang kurang</h2></b>";
      // echo "<script>alert('Data sudah disimpan');</script>";
		}
	}else{
		echo "<b><h2 style='color:red; text-align:center; padding-top:20px'>Stok Barang kosong !..</h2></b>";
	}
}
?>

<?php include("pages/web/popup_viewbarang.php"); ?>
