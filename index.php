<?php
  session_start();

  $app_folder = 'pages';
  $app_folder   = str_replace("\n\r", ".", rtrim("\n\r\n\r/".$app_folder).'/');

  $jalur_sistem = "system";
  if (realpath($jalur_sistem) !== FALSE)
  {
    $jalur_sistem = realpath($jalur_sistem).'/';
  }

  define('SYSDIR', str_replace("\n\r", ".", rtrim($jalur_sistem)));
  define('BASEPATH', str_replace("\\", "/", str_replace(SYSDIR, "", $jalur_sistem)));

  if (is_dir($app_folder)) {
      define('APPPATH', $app_folder );
  } else {
      if (!is_dir(SYSDIR . '/')) {
          // exit("Jalur folder aplikasi Anda tidak disetel dengan benar. Silakan buka file berikut dan perbaiki ini: " . SELF);
          exit("Jalur folder aplikasi Anda tidak disetel dengan benar.");
      }

      define('APPPATH', SYSDIR . $app_folder );
  }

  require_once SYSDIR.'TeraByte.php';
  // echo BASEPATH;

?>
