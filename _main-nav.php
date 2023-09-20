<!--NAVIGASI MENU UTAMA-->

<div class="leftmenu">
  <ul class="nav nav-tabs nav-stacked">
    <li class="active"><a href="<?=base_url()?>dashboard.php"><span class="icon-align-justify"></span> Dashboard</a></li>

  <!--MENU GUDANG-->
  <?php
	if($_SESSION['login_hash']=="gudang")
	{
	?>
    <li class="dropdown"><a href="#"><span class="icon-th-list"></span> Data Master</a>
      <ul>
        <li><a href="?cat=gudang&page=jenis">Jenis Obat</a></li>
        <li><a href="?cat=gudang&page=barang">Obat</a></li>
      </ul>
    </li>
    <li class="dropdown"><a href="#"><span class="icon-pencil"></span> Transaksi</a>
      <ul>
        <li><a href="?cat=gudang&page=entry">Obat Masuk</a></li>
      </ul>
    </li>
    <li class="dropdown"><a href="#"><span class="icon-pencil"></span> Laporan</a>
      <ul>
        <li><a href="?cat=gudang&page=order">Laporan Permintaan Obat</a></li>
        <li><a href="?cat=gudang&page=stok">Laporan Stok Obat</a></li>
        <li><a href="?cat=gudang&page=monthreporting">Laporan Obat Masuk dan Keluar</a></li>
      </ul>
    </li>
    <?php
	}elseif($_SESSION['login_hash']=="apoteker"){
	?>
    <!--MENU apoteker-->
    <li class="dropdown"><a href="#"><span class="icon-th-list"></span> Transaksi</a>
      <ul>
        <li><a href="?cat=apoteker&page=order">Permintaan Obat</a></li>
        <li><a href="?cat=apoteker&page=sell">Obat Keluar</a></li>
      </ul>
    </li>
    <li class="dropdown"><a href="#"><span class="icon-pencil"></span> Laporan</a>
      <ul>
        <li><a href="?cat=apoteker&page=stok">Laporan Stok Obat</a></li>
        <li><a href="?cat=apoteker&page=monthreporting">Laporan Obat Masuk dan Keluar</a></li>
      </ul>
    </li>

   <!--MENU PIMPINAN-->
        <?php
	}elseif($_SESSION['login_hash']=="pimpinan"){
	?>
    <li class="dropdown"><a href="#"><span class="icon-pencil"></span> Laporan</a>
      <ul>
        <li><a href="?cat=pimpinan&page=order">Laporan Permintaan Obat</a></li>
        <li><a href="?cat=pimpinan&page=stok">Laporan Stok Obat</a></li>
        <li><a href="?cat=pimpinan&page=monthreporting">Laporan Obat Masuk dan Keluar</a></li>
      </ul>
    </li>
     <!--MENU ADMIN-->
        <?php
	}elseif($_SESSION['login_hash']=="admin"){
	?>

 <br> <div class="caption" style="background-color: #e4e4e4; text-align: center">
   <h6 style="color: #a66b41">DATA BARANG</h6>
 </div>
 <li class="dropdown"><a href="#"><span class="icon-star"></span> Master Barang</a>
   <ul>
     <li><a href="?cat=admin&page=jenis">Kategori Barang</a></li>
     <li><a href="?cat=admin&page=barang">Data Barang</a></li>
   </ul>
 </li>

 <li class="dropdown"><a href="#"><span class="icon-shopping-cart"></span> Transaksi Barang</a>
   <ul>
     <!-- <li><a href="?cat=tuliv&page=order">Permintaan Barang</a></li> -->
     <li><a href="?cat=pimpinan&page=entry">Barang Masuk</a></li>
     <li><a href="?cat=admin&page=sell">Barang Keluar</a></li>
   </ul>
 </li>

 <li class="dropdown"><a href="#"><span class="icon-book"></span> Laporan Barang</a>
   <ul>
     <!-- <li><a href="?cat=tera_byte_&page=order">Laporan Permintaan Barang</a></li> -->
     <li><a href="?cat=pimpinan&page=stok">Laporan Stok Barang</a></li>
     <li><a href="?cat=pimpinan&page=monthreporting">Laporan Barang Masuk dan Keluar</a></li>
   </ul>
 </li>

 <br> <div class="caption" style="background-color: #e4e4e4; text-align: center">
   <h6 style="color: #a66b41">DATA KEUANGAN</h6>
 </div>

 <li class="dropdown"><a href="#"><span class="icon-star"></span> Master Keuangan</a>
   <ul>
     <li><a href="?cat=finance&page=jenis">Jenis Transaksi</a></li>
     <li><a href="?cat=finance&page=barang">Data Transaksi</a></li>
   </ul>
 </li>

 <li class="dropdown"><a href="#"><span class="icon-inbox"></span> Transaksi Keuangan</a>
   <ul>
     <!-- <li><a href="?cat=tuliv&page=order">Permintaan Barang</a></li> -->
     <li><a href="?cat=finance&page=entry">Uang Masuk</a></li>
     <li><a href="?cat=finance&page=sell">Uang Keluar</a></li>
   </ul>
 </li>

 <li class="dropdown"><a href="#"><span class="icon-book"></span> Laporan Keuangan</a>
   <ul>
     <!-- <li><a href="?cat=tera_byte_&page=order">Laporan Permintaan Barang</a></li> -->
     <li><a href="?cat=pimpinan&page=stok">Laporan Stok Barang</a></li>
     <li><a href="?cat=pimpinan&page=monthreporting">Laporan Uang Masuk dan Keluar</a></li>
   </ul>
 </li>

     <!--MENU ROOT-->
        <?php
	}elseif($_SESSION['login_hash']=="_tera_byte"){
	?>
  <li class="dropdown"><a href="#"><span class="icon-pencil"></span> System</a>
   <ul>
     <li><a href="?cat=_tera_byte&page=user">User Management</a></li>

   </ul>
 </li>

 <li class="dropdown"><a href="#"><span class="icon-th-list"></span> Master Barang</a>
   <ul>
     <li><a href="?cat=admin&page=jenis">Kategori Barang</a></li>
     <li><a href="?cat=admin&page=barang">Data Barang</a></li>
   </ul>
 </li>

 <li class="dropdown"><a href="#"><span class="icon-th-list"></span> Transaksi Barang</a>
   <ul>
     <!-- <li><a href="?cat=tuliv&page=order">Permintaan Barang</a></li> -->
     <li><a href="?cat=pimpinan&page=entry">Barang Masuk</a></li>
     <li><a href="?cat=admin&page=sell">Barang Keluar</a></li>
   </ul>
 </li>

 <li class="dropdown"><a href="#"><span class="icon-pencil"></span> Laporan Barang</a>
   <ul>
     <!-- <li><a href="?cat=tera_byte_&page=order">Laporan Permintaan Barang</a></li> -->
     <li><a href="?cat=pimpinan&page=stok">Laporan Stok Barang</a></li>
     <li><a href="?cat=pimpinan&page=monthreporting">Laporan Barang Masuk dan Keluar</a></li>
   </ul>
 </li>
  	<?php
	}
	?>
  </ul>
</div>
<!--leftmenu-->

</div>
<!--mainleft-->
<!-- END OF LEFT PANEL -->
