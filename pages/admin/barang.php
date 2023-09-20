<?php
ob_start();

$sql_kode = mysqli_query($koneksi, "SELECT kode_obat FROM data_obat order by kode_obat DESC LIMIT 1");
 if($sql_kode === FALSE) {
   die(mysqli_error());
 }

 $data_kode=mysqli_fetch_array($sql_kode);

	$crop=substr($data_kode[0],8);

	if ($crop==0){
		$urutan="TLV-".date("y").date("m")."001";
	}

	elseif ($crop<9){
		$jum=$crop+1;
		$urutan="TLV-".date("y").date("m")."00".$jum;}

	elseif ($crop<99){
		$jum=$crop+1;
		$urutan="TLV-".date("y").date("m")."0".$jum;}

	elseif ($crop<999){
		$jum=$crop+1;
		$urutan="TLV-".date("y").date("m").$jum;}

	elseif ($crop>=999){
		$urutan="TLV".date("y").date("m")."001";
		echo "<script>alert('SILAHKAN HUBUNGI tubagus.aom.swk@gmail.com'); location.href='dashboard.php?cat=web&page=logout'</script>";
	};
?>
<form name="form1" method="post" action="?cat=tuliv&page=barang&act=1">

  <div class="table-responsive">
    <table class=" table-aom">
      <tr>
        <td><label>Nama Barang</label></td>
        <td width="50%">
          <input type="hidden" name="kode_obat" id="kode_obat" value="<?php echo $urutan; ?>">
          <input type="text" name="namaobat" id="namaobat">
        </td>
      </tr>
      <tr>
        <td><label>Kategori</label></td>
        <td width="50%">
          <select name="kode_lemari" id="kode_lemari" >
     					<option value="" style="color:darkblue; font-weight:700">- Pilih Kategori -</option>
     					<?php
     						$queryx = mysqli_query($koneksi, "SELECT * FROM lemari_obat");
                 if($queryx === FALSE) {
                   die(mysqli_error());
               	}
     						while($datax=mysqli_fetch_array($queryx)){
     							echo "<option value='$datax[0]'>$datax[1]</option>";
     						}
     					?>
     				</select>
        </td>
      </tr>
      <tr>
        <td><label>Keterangan</label></td>
        <td width="50%">
          <textarea name="keterangan_barang"></textarea>
        </td>
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
include("pages/admin/barangview.php");
?>
</span>
<?php
if(isset($_GET['act']))
{

	$rs=mysqli_query($koneksi, "Insert into data_obat (`kode_obat`,`nama_obat`,`kode_lemari`,`stts_obat`,`keterangan_barang`) values ('".$_POST['kode_obat']."','".$_POST['namaobat']."','".$_POST['kode_lemari']."','1','".$_POST['keterangan_barang']."')") or die(mysql_error());
	if($rs)
	{
		echo "<script>window.location='?cat=tuliv&page=barang'</script>";
	}
}
?>

<?php
if(isset($_GET['del']))
{
	$ids=$_GET['id'];
	$ff=mysqli_query($koneksi, "Delete from data_obat Where sha1(kode_obat)='".$ids."'");
	if($ff)
	{
		echo "<script>window.location='?cat=admin&page=barang'</script>";
	}
}
?>
