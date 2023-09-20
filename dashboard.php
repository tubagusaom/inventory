<?php
error_reporting(0);
session_start();
if (!isset($_SESSION['login_hash'])) {
    echo "<script>window.location='login'</script>";
}
require_once("_db.php");
require_once("_app.php");
?>

<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="shortcut icon" type="image/x-icon" href="img\logoPP.jpg" />
    <title><?=company_name()?> | <?=app_name()?></title>
	  <?php include("_scr.php"); ?>
</head>

<body>

<div class="mainwrapper fullwrapper">

    <!-- START OF LEFT PANEL -->
    <div class="leftpanel">

        <div class="logopanel">
        	<h1><a href="dashboard.php"><?=company_name()?> - <?=app_name()?></a></h1>
        </div><!--logopanel-->

        <div class="datewidget">Hari ini: <?php echo date("d M Y"); ?></div>

        <?php include("_main-nav.php"); ?> <!--NAVIGASI MENU UTAMA-->

    <!-- START OF RIGHT PANEL -->
    <div class="rightpanel">
    	<div class="headerpanel">
        	<a href="" class="showmenu"></a>
            <div class="headerright">
            	<span style="color:#392914">
                <?php
                  echo "Selamat Datang Kembali <b style='text-transform: uppercase;'><u>".$_SESSION['login_hash']."</u></b>";
                ?>
                </span>
                <?php
                  include("_userinfo.php");
                ?>
            </div><!--headerright-->
    	</div><!--headerpanel-->

        <div class="breadcrumbwidget">
        	<ul class="breadcrumb">
                <li></li>
            </ul>
        </div>
        <!--breadcrumbwidget-->

		<div class="pagetitle">
        	<h1><?=$_SESSION['login_hash'] ?> - <?=$_SESSION['nama_user'] ?></h1> <!--<span>This is a sample description for dashboard page...</span>-->
    </div><!--pagetitle-->

      <div class="maincontent">
       	<div class="contentinner content-dashboard">
            	<!--<div class="alert alert-info">
                	<button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Welcome!</strong> This alert needs your attention, but it's not super important.
                </div>--><!--alert-->

        <div class="row-fluid"><!--span8-->
        <?php
          $v_cat = (isset($_REQUEST['cat'])&& $_REQUEST['cat'] !=null)?$_REQUEST['cat']:'';
          $v_page = (isset($_REQUEST['page'])&& $_REQUEST['page'] !=null)?$_REQUEST['page']:'';

          if (file_exists("pages/".$v_cat."/".$v_page.".php")) {
            include("pages/".$v_cat."/".$v_page.".php");
          } else {
            include("pages/web/homepage.php");
          }
        ?>

                <!--span4-->
              </div>
                <!--row-fluid-->
          </div><!--contentinner-->
        </div><!--maincontent-->

    </div><!--mainright-->
    <!-- END OF RIGHT PANEL -->

    <div class="clearfix"></div>

	<!--FOOTER-->
    <?php include("_footer.php"); ?>

</div><!--mainwrapper-->
	<!--SLIDE NAVIGASI-->
    <?php include("_nav-slider.php"); ?>
</body>
</html>
