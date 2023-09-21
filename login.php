<html>
  <head>
    <meta charset="utf-8">
    <title>Inventory | <?=company_name()?></title>
    <link rel="shortcut icon" type="image/x-icon" href='<?=base_url()?>img/logoPP.jpg' />
    <link rel="stylesheet" href="<?=base_url()?>css/style.default.css" type="text/css" />
    <!-- <script type="text/javascript" src="js/jquery-1.9.0.min.js"></script> -->
    <!-- <script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script> -->
  </head>
  <body class="loginbody">

      <div class="loginwrapper">
          <div class="loginwrap zindex100 animate2 bounceInDown">
          <h1 class="logintitletuliv"><span class="iconfa-lock"></span> <?=app_name()?><span class="subtitle" style="color:#4f2b11!important">Please log in to get started.</span></h1>
              <div class="loginwrapperinner">
                <form id="loginform" action="index.php?login_attempt=1" method="post">
                    <p class="animate4 bounceIn"><input type="text" id="username" name="username" placeholder="Username" /></p>
                    <p class="animate5 bounceIn"><input type="password" id="password" name="password" placeholder="Password" /></p>
                    <p class="animate6 bounceIn"><button class="btn-tuliv btn-block">Log in</button></p>
                </form>
              </div>
          </div>
          <div class="loginshadow animate3 fadeInUp"></div>
      </div>
      <!-- <script type="text/javascript" src="js/form/tera_byte.js"></script> -->
  </body>
</html>



<?php
//   if (isset($_GET['login_attempt'])) {
//
//     // $spf=sprintf("Select * from user_login where username='%s' and password='%s'", $_POST['username'], md5($_POST['password']));
//     // $spf="select * from user_login where username='$_POST[username]' and password='$pwmd5'";
//     // $rs=mysqli_query($spf);
//     // $rw=mysqli_fetch_array($rs);
//     // // $rc=mysqli_num_rows($rs);
//     //
//     // // var_dump($rs); die();
//     //
//     // if ($rw=='') {
//     //     $_SESSION['login_hash']=$rw['login_hash'];
//     //     $_SESSION['login_user']=$rw['username'];
//     //     $_SESSION['nama_user']=$rw['nama_user'];
//     //     echo "<script>window.location='dashboard.php'</script>";
//     // }
//
//     $username = $_POST["username"];
//     $p = $_POST["password"];
//     $pmd5 = md5($_POST["password"]);
//
//     $sql = "select * from user_login where username='".$username."' and login_hash='".$p."' limit 1";
//     $hasil = mysqli_query ($koneksi,$sql);
//     $data = mysqli_fetch_array($hasil);
//     $jumlah = mysqli_num_rows($hasil);
//
//     // echo $data['password'];
//     // var_dump($jumlah); die();
//
//     if ($jumlah=='1') {
//         $_SESSION['login_hash']=$data['login_hash'];
//         $_SESSION['login_user']=$data['username'];
//         $_SESSION['nama_user']=$data['nama_user'];
//         echo "<script>window.location='".base_url()."dashboard".EXT."'</script>";
//     }
//
// }
?>
