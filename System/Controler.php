<?php if ( ! defined('BASEPATH')) exit('Tidak ada akses skrip langsung yang diizinkan');

require_once BASEPATH.("_db".EXT);

$logSesion=logSesion($koneksi,'');

function connectdb($logSesion=FALSE){
  return $logSesion;
}

function base_url(){
  $base_ = (empty($_SERVER['HTTPS']) OR strtolower($_SERVER['HTTPS']) === 'off') ? 'http' : 'https';
  $base_ .= '://'. $_SERVER['HTTP_HOST'];

  $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

  if ($_SERVER['HTTP_HOST'] == "localhost") {
    $base_url = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
  }else{
    // $segmen = $this->segmen_url();
    $segmen = $uriSegments;
    if ($segmen[1] == '') {
      $base_url = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $base_);
    }else {
      $base_url = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $base_ . '/home'.'/');
    }
  }

  return $base_url;
}

// var_dump($uriSegments[0]); die();

function logSesion($koneksi){
  login($koneksi);
}

function login($koneksi){

   if (isset($_GET['login_attempt'])) {

     $username = $_POST["username"];
     $p = $_POST["password"];
     $pmd5 = md5($_POST["password"]);

     $cekuser	= mysqli_query($koneksi,"SELECT a.login_hash, a.username, a.nama_user, a.password
       FROM user_login a WHERE a.username='$username' OR a.password='$pmd5' limit 1");

     $hasil = mysqli_fetch_array($cekuser);
     $jumlah	= mysqli_num_rows($cekuser);

     // if ($jumlah>0){
       // var_dump($hasil); die();
     //
     //   session_unset();
      //  session_destroy();
     // }

    // var_dump($pmd5 . ' - ' . $hasil['password']); die();

     if ($jumlah==0){
         echo "<script>alert('WARNING, ANDA TIDAK BERHAK AKSES !!!'); location.href='login'</script>";
     } else{

       if($pmd5!=$hasil['password']) {
         echo "<script>alert('PASSWORD SALAH'); location.href='login'</script>";
       }else{
         $_SESSION['login_hash']=$hasil['login_hash'];
         $_SESSION['login_user']=$hasil['username'];
         $_SESSION['nama_user']=$hasil['nama_user'];
         echo"<script>window.location='".base_url()."dashboard".EXT."'</script>";
       }

     }

  }
}

function sesiOn($akses,$getdata){

  if ($akses == '' OR $akses == 0 OR $akses == NULL?$datasesion = 0:$datasesion =$akses);

  if ($getdata == '') {
    if ($datasesion > 0) {

      $timeout = 30; // setting timeout dalam menit
      $timeout = $timeout * 60; // menit ke detik

      if(isset($_SESSION['start_session'])){
        $elapsed_time = time()-$_SESSION['start_session'];
        if($elapsed_time >= $timeout){
          session_unset();
          session_destroy();
          echo "<script type='text/javascript'>alert('Sesi telah berakhir');window.location='../'</script>";
        }
      }
      $_SESSION['start_session']=time();


      // echo $direct = "<script type='text/javascript'>window.location='".base_url()."'</script>";

      // $this->logSesion();
    }else {

      $segmen = $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
      $inhome = in_array('home', $segmen);

      if ($inhome == 1) {
        echo "<script type='text/javascript'>
          window.location='".ERROR."'
        </script>";
      }

    }

  } else {
    // echo "<script type='text/javascript'>alert('LOGOUT $akses OK');</script>";

    $aksesusr = array(
      '' => '',
      'ketua' => 'Ketua Koperasi',
      'admin' => 'Sekertaris 1',
      'sekertaris' => 'Sekertaris 2',
      'akunting' => 'Bendahara 1',
      'analis' => 'Bendahara 2',
      'superuser' => 'Superuser'
    );

    if(isset($akses)){
      session_unset();
      session_destroy();
    }
    echo"<script>alert('Terima Kasih ".$aksesusr[$akses].", Silahkan datang kembali 😉 ');location.replace('../')</script>";
  }

  // echo "";

}
