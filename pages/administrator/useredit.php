<?php
ob_start();
if(isset($_GET['id']))
{
	$rs=mysqli_query($koneksi, "Select * from user_login where sha1(username)='".$_GET['id']."'");
	$row=mysqli_fetch_array($rs);
?>
<form name="form1" method="post" action="?cat=administrator&page=useredit&id=<?php echo $_GET['id']; ?>&edit=1">
	<div class="table-responsive">
	  <table class=" table-aom">
	    <tr>
	      <td><label>Nama User</label></td>
	      <td><input type="text" name="nama_user" id="nama_user" value="<?php echo $row['nama_user']; ?>"></td>
	    </tr>
	    <tr>
	      <td><label>Username</label></td>
	      <td><input type="text" readonly style="background:#ddd" name="username" id="username" value="<?php echo $row['username']; ?>"></td>
	    </tr>
	    <tr>
	      <td><label>password</label></td>
	      <td><input type="password" name="password" id="password" value="<?=($row['password']); ?>" disabled style="background:#ddd"></td>
	    </tr>
	    <tr>
	      <td><label>Jenis Login</label></td>
	      <td>
				<select name="jenis" id="jenis">
		        <option <?php if ($row['login_hash'] == "toko") { echo "selected"; }else{ echo "";} ?> value="toko">Toko</option>
		        <option <?php if ($row['login_hash'] == "gudang") { echo "selected"; }else{ echo "";} ?> value="gudang">Gudang</option>
		        <option <?php if ($row['login_hash'] == "admin") { echo "selected"; }else{ echo "";} ?> value="gudang">Admin</option>
		        <option <?php if ($row['login_hash'] == "pimpinan") { echo "selected"; }else{ echo "";} ?> value="pimpinan">Pimpinan</option>
		      </select>
	      </td>
	    </tr>
	    <tr>
	      <td colspan="2">
	        <input type="submit" class="btn btn-primary" name="button" id="button" value="Ubah" style="float:right;">
	        <input type="button" class="btn btn-danger" name="reset" id="reset" value="Cancel" onclick="window.location='?cat=administrator&page=user'" style="float:right; margin-right:10px">
	      </td>
	    </tr>
	  </table>
	</div>
</form>
<?php
ob_end_flush();
}else{
	echo "<script>window.location='?cat=administrator&page=user'</script>";
}
?>
<?php
if(isset($_GET['edit']))
{

	$rs=mysql_query("Update user_login SET login_hash='".$_POST['jenis']."',username='".$_POST['username']."',nama_user='".$_POST['nama_user']."' Where sha1(username)='".$_GET['id']."'");
	if($rs)
	{
		echo "<script>window.location='?cat=administrator&page=user'</script>";
	}
}
?>
