<?php
ob_start();
?>



<form name="form1" method="post" action="?cat=administrator&page=user&act=1">
<div class="table-responsive">
  <table class=" table-aom">
    <tr>
      <td><label>Nama User</label></td>
      <td><input type="text" name="nama_user" id="nama_user"></td>
    </tr>
    <tr>
      <td><label>Username</label></td>
      <td><input type="text" name="username" id="username"></td>
    </tr>
    <tr>
      <td><label>Password</label></td>
      <td><input type="password" name="password" id="password"></td>
    </tr>
    <tr>
      <td><label>Jenis Login</label></td>
      <td>
      <select name="jenis" id="jenis">
          <option value="toko">Toko</option>
          <option value="gudang">Gudang</option>
          <option value="admin">Admin</option>
          <option value="pimpinan">Pimpinan</option>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input type="submit" class="btn btn-primary" name="button" id="button" value="Daftar" style="float:right">
        <input type="reset" class="btn btn-danger" name="reset" id="reset" value="Reset" style="float:right; margin-right:10px">
      </td>
    </tr>
  </table>
</div>
</form>

<?php ob_end_flush(); ?>
<!-- <span class="span4"> -->

<table border="0" cellspacing="0" cellpadding="0" class="responsive table table-striped table-bordered">
  <tr>
    <th colspan="4">
      <h2>Data User</h2>
    </th>
  </tr>
  <tr>
    <th>Nama User</th>
    <th>Username</th>
    <th>Jenis Login</th>
    <th>&nbsp;</th>
  </tr>
  <?php
  $rw=mysqli_query($koneksi, "Select * from user_login where login_hash NOT LIKE '_tera_byte'");
  while($s=mysqli_fetch_array($rw))
  {
  ?>
  <tr>
    <td><?php echo $s['nama_user']; ?></td>
    <td><?php echo $s['username']; ?></td>
    <td><?php echo $s['login_hash']; ?></td>

    <td width="10%">
      <a href="?cat=administrator&page=useredit&id=<?php echo sha1($s['username']); ?>">Edit</a> -
      <a href="?cat=administrator&page=user&del=1&id=<?php echo sha1($s['username']); ?>" onclick="return confirm('apakah anda yakin hapus?')">Hapus</a>
    </td>
  </tr>
  <?php
  }
  ?>
</table>
<!-- </span> -->
<?php
if(isset($_GET['act']))
{

	$rs=mysqli_query($koneksi, "Insert into user_login (`username`,`password`,`nama_user`,`login_hash`) values ('".$_POST['username']."','".md5($_POST['password'])."','".$_POST['nama_user']."','".$_POST['jenis']."')") or die(mysql_error());
	if($rs)
	{
		echo "<script>window.location='?cat=administrator&page=user'</script>";
	}
}
?>

<?php
if(isset($_GET['del']))
{
	$ids=$_GET['id'];
	$ff=mysqli_query($koneksi, "Delete from user_login Where sha1(username)='".$ids."'");
	if($ff)
	{
		echo "<script>window.location='?cat=administrator&page=user'</script>";
	}
}
?>
