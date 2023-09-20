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
      <ul <?= $_GET['page'] == 'jenis' || $_GET['page'] == 'barang' ? 'style="display:block;"' : '' ?>>
        <li><a <?= $_GET['page'] == 'jenis' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=gudang&page=jenis">Etalase</a></li>
        <li><a <?= $_GET['page'] == 'barang' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=gudang&page=barang">Barang</a></li>
      </ul>
    </li>
    <li class="dropdown"><a href="#"><span class="icon-pencil"></span> Transaksi</a>
      <ul <?= $_GET['page'] == 'entry' ? 'style="display:block;"' : '' ?>>
        <li><a <?= $_GET['page'] == 'entry' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=gudang&page=entry">Obat Masuk</a></li>
      </ul>
    </li>
    <li class="dropdown"><a href="#"><span class="icon-pencil"></span> Laporan</a>
      <ul <?= $_GET['page'] == 'order' || $_GET['page'] == 'stok' || $_GET['page'] == 'monthreporting' ? 'style="display:block;"' : '' ?>>
        <li><a <?= $_GET['page'] == 'order' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=gudang&page=order">Permintaan Obat</a></li>
        <li><a <?= $_GET['page'] == 'stok' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=gudang&page=stok">Stok Obat</a></li>
        <li><a <?= $_GET['page'] == 'monthreporting' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=gudang&page=monthreporting">Obat Masuk dan Keluar</a></li>
      </ul>
    </li>
    <?php
	}elseif($_SESSION['login_hash']=="toko"){
	?>
    <!--MENU toko-->
    <li class="dropdown"><a href="#"><span class="icon-th-list"></span> Transaksi</a>
      <ul <?= $_GET['page'] == 'order' || $_GET['page'] == 'sell' ? 'style="display:block;"' : '' ?>>
        <li><a <?= $_GET['page'] == 'order' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=toko&page=order">Permintaan Obat</a></li>
        <li><a <?= $_GET['page'] == 'sell' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=toko&page=sell">Obat Keluar</a></li>
      </ul>
    </li>
    <li class="dropdown"><a href="#"><span class="icon-pencil"></span> Laporan</a>
      <ul <?= $_GET['page'] == 'stok' || $_GET['page'] == 'monthreporting' ? 'style="display:block;"' : '' ?>>
        <li><a <?= $_GET['page'] == 'stok' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=toko&page=stok">Stok Obat</a></li>
        <li><a <?= $_GET['page'] == 'monthreporting' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=toko&page=monthreporting">Obat Masuk dan Keluar</a></li>
      </ul>
    </li>

   <!--MENU PIMPINAN-->
        <?php
	}elseif($_SESSION['login_hash']=="pimpinan"){
	?>
    <li class="dropdown"><a href="#"><span class="icon-pencil"></span> Laporan</a>
      <ul <?= $_GET['page'] == 'order' || $_GET['page'] == 'stok' || $_GET['page'] == 'monthreporting' ? 'style="display:block;"' : '' ?>>
        <li><a <?= $_GET['page'] == 'order' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=pimpinan&page=order">Permintaan Obat</a></li>
        <li><a <?= $_GET['page'] == 'stok' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=pimpinan&page=stok">Stok Obat</a></li>
        <li><a <?= $_GET['page'] == 'monthreporting' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=pimpinan&page=monthreporting">Obat Masuk dan Keluar</a></li>
      </ul>
    </li>
     <!--MENU ADMIN-->
        <?php
	}elseif($_SESSION['login_hash']=="admin"){
	?>

 <br> <div class="caption" style="background-color: #e4e4e4; text-align: center">
   <h6 style="color: #a66b41">DATA BARANG</h6>
 </div>
 <li class="dropdown"><a href="#"><span class="icon-star"></span> Data Master</a>
   <ul <?= $_GET['page'] == 'jenis' || $_GET['page'] == 'barang' ? 'style="display:block;"' : '' ?>>
     <li><a <?= $_GET['page'] == 'jenis' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=admin&page=jenis">Etalase</a></li>
     <li><a <?= $_GET['page'] == 'barang' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=admin&page=barang">Barang</a></li>
   </ul>
 </li>

 <li class="dropdown"><a href="#"><span class="icon-shopping-cart"></span> Transaksi Barang</a>
   <ul <?= $_GET['page'] == 'entry' || $_GET['page'] == 'sell' ? 'style="display:block;"' : '' ?>>
     <!-- <li><a href="?cat=tuliv&page=order">Permintaan Barang</a></li> -->
     <li><a <?= $_GET['page'] == 'entry' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=pimpinan&page=entry">Barang Masuk</a></li>
     <li><a <?= $_GET['page'] == 'sell' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=admin&page=sell">Barang Keluar</a></li>
   </ul>
 </li>

 <li class="dropdown"><a href="#"><span class="icon-book"></span> Laporan Barang</a>
   <ul <?= $_GET['page'] == 'stok' || $_GET['page'] == 'monthreporting' ? 'style="display:block;"' : '' ?>>
     <!-- <li><a href="?cat=tera_byte_&page=order">Laporan Permintaan Barang</a></li> -->
     <li><a <?= $_GET['page'] == 'stok' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=pimpinan&page=stok">Laporan Stok Barang</a></li>
     <li><a <?= $_GET['page'] == 'monthreporting' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=pimpinan&page=monthreporting">Laporan Barang Masuk dan Keluar</a></li>
   </ul>
 </li>

 <br> <div class="caption" style="background-color: #e4e4e4; text-align: center">
   <h6 style="color: #a66b41">DATA KEUANGAN</h6>
 </div>

 <li class="dropdown"><a href="#"><span class="icon-star"></span> Master Keuangan</a>
   <ul <?= $_GET['page'] == 'jenis' || $_GET['page'] == 'barang' ? 'style="display:block;"' : '' ?>>
     <li><a <?= $_GET['page'] == 'jenis' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=finance&page=jenis">Jenis Transaksi</a></li>
     <li><a <?= $_GET['page'] == 'barang' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=finance&page=barang">Data Transaksi</a></li>
   </ul>
 </li>

 <li class="dropdown"><a href="#"><span class="icon-inbox"></span> Transaksi Keuangan</a>
   <ul <?= $_GET['page'] == 'entry' || $_GET['page'] == 'sell' ? 'style="display:block;"' : '' ?>>
     <!-- <li><a href="?cat=tuliv&page=order">Permintaan Barang</a></li> -->
     <li><a <?= $_GET['page'] == 'entry' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=finance&page=entry">Uang Masuk</a></li>
     <li><a <?= $_GET['page'] == 'sell' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=finance&page=sell">Uang Keluar</a></li>
   </ul>
 </li>

 <li class="dropdown"><a href="#"><span class="icon-book"></span> Laporan Keuangan</a>
   <ul <?= $_GET['page'] == 'stok' || $_GET['page'] == 'monthreporting' ? 'style="display:block;"' : '' ?>>
     <!-- <li><a href="?cat=tera_byte_&page=order">Laporan Permintaan Barang</a></li> -->
     <li><a <?= $_GET['page'] == 'stok' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=pimpinan&page=stok">Stok Barang</a></li>
     <li><a <?= $_GET['page'] == 'monthreporting' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=pimpinan&page=monthreporting">Uang Masuk dan Keluar</a></li>
   </ul>
 </li>

     <!--MENU ROOT-->
        <?php
	}elseif($_SESSION['login_hash']=="_tera_byte"){
	?>
  <li class="dropdown"><a href="#"><span class="icon-pencil"></span> System</a>
   <ul <?= $_GET['page'] == 'user' ? 'style="display:block;"' : '' ?>>
    <li><a <?= $_GET['page'] == 'user' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=_tera_byte&page=user">User Management</a></li>

   </ul>
 </li>

 <li class="dropdown"><a href="#"><span class="icon-th-list"></span> Data Master</a>
   <ul <?= $_GET['page'] == 'jenis' || $_GET['page'] == 'barang' ? 'style="display:block;"' : '' ?>>
     <li><a <?= $_GET['page'] == 'jenis' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=admin&page=jenis">Etalase</a></li>
     <li><a <?= $_GET['page'] == 'barang' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=admin&page=barang">Barang</a></li>
   </ul>
 </li>

 <li class="dropdown"><a href="#"><span class="icon-th-list"></span> Transaksi</a>
   <ul <?= $_GET['page'] == 'entry' || $_GET['page'] == 'sell' ? 'style="display:block;"' : '' ?>>
     <!-- <li><a href="?cat=tuliv&page=order">Permintaan Barang</a></li> -->
     <li><a <?= $_GET['page'] == 'entry' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=pimpinan&page=entry">Barang Masuk</a></li>
     <li><a <?= $_GET['page'] == 'sell' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=admin&page=sell">Barang Keluar</a></li>
   </ul>
 </li>

 <li class="dropdown"><a href="#"><span class="icon-pencil"></span> Laporan</a>
   <ul <?= $_GET['page'] == 'stok' || $_GET['page'] == 'monthreporting' ? 'style="display:block;"' : '' ?>>
     <!-- <li><a href="?cat=tera_byte_&page=order">Laporan Permintaan Barang</a></li> -->
     <li><a <?= $_GET['page'] == 'stok' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=pimpinan&page=stok">Stok Barang</a></li>
     <li><a <?= $_GET['page'] == 'monthreporting' ? 'style="font-weight:bold; color:#634927"' : '' ?> href="?cat=pimpinan&page=monthreporting">Barang Masuk dan Keluar</a></li>
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
