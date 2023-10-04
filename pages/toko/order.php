<?php
ob_start();
?>
<h2 style="padding-bottom:10px">Permintaan Barang</h2>
<form name="form1" method="post" action="?cat=toko&page=order&act=1">

  <div class="table-responsive">
    <table class=" table-aom">
      <tr>
        <td><label>Nama Barang</label></td>
        <td><input type="text" name="namaobat" id="namaobat" required></td>
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
include("pages/toko/orderview.php");
?>
</span>
<?php
if(isset($_GET['act']))
{

  $sql_kode = mysqli_query($koneksi, "SELECT kode_obat FROM data_obat order by kode_obat DESC LIMIT 1");
   if($sql_kode === FALSE) {
     die(mysqli_error());
   }

   $data_kode=mysqli_fetch_array($sql_kode);

  	$crop=substr($data_kode[0],8);

  	if ($crop==0){
  		$urutan="KDB-".date("y").date("m")."001";
  	}

  	elseif ($crop<9){
  		$jum=$crop+1;
  		$urutan="KDB-".date("y").date("m")."00".$jum;}

  	elseif ($crop<99){
  		$jum=$crop+1;
  		$urutan="KDB-".date("y").date("m")."0".$jum;}

  	elseif ($crop<999){
  		$jum=$crop+1;
  		$urutan="KDB-".date("y").date("m").$jum;}

  	elseif ($crop>=999){
  		$urutan="KDB-".date("y").date("m")."001";
  		echo "<script>alert('SILAHKAN HUBUNGI tubagus.aom.swk@gmail.com'); location.href='dashboard.php?cat=web&page=logout'</script>";
  	};

  // var_dump($urutan); die();

	// $rs=mysqli_query($koneksi, "Insert into data_obat (`nama_obat`,`kode_lemari`,`stts_obat`) values ('".$_POST['namaobat']."','0','0')");

  $n_ob		=$_POST['namaobat'];
  $rs="INSERT INTO data_obat (`kode_obat`, `nama_obat`, `kode_lemari`, `stts_obat`)VALUES('$urutan','$n_ob','0','0')";
  $queryrs=mysqli_query($koneksi,$rs);
	if($queryrs)
	{
		echo "<script>window.location='?cat=toko&page=order'</script>";
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
		echo "<script>window.location='?cat=toko&page=order'</script>";
	}
}
?>
