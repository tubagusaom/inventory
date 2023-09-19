<?php

	define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
	define('FCPATH', str_replace(SELF, '', __FILE__));

	$jalur_sistem = "System";
	if (realpath($jalur_sistem) !== FALSE)
	{
		$jalur_sistem = realpath($jalur_sistem).'/';
	}

	define('SYSDIR', str_replace("\n\r", ".", rtrim($jalur_sistem)));

	$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));



	$path_app = "project-inventory";
	$view_path  = str_replace("\n\r", "", rtrim("\n\r\n\r".str_replace('-','/',$path_app)).'/');
	define('APPPATH', $view_path );


	$base_ = (empty($_SERVER['HTTPS']) OR strtolower($_SERVER['HTTPS']) === 'off') ? 'http' : 'https';
  $base_ .= '://'. $_SERVER['HTTP_HOST'];

  if ($_SERVER['HTTP_HOST'] == "localhost") {
		$base_url = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $base_.'/'.APPPATH);
  }else{
    $base_url = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $base_.'/');
  }
?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>403 - Akses Halaman Dilarang</title>
    <meta name="keywords" content="ERROR, ERROR 403, 403, DIRECTORY, HALAMAN, halaman, PAGE, page, error, error 403, eror, directory, page not found, akses halaman dilarang" />
    <meta name="description" content="403 AKSES DILARANG">
	  <meta name="author" content="https://www.instagram.com/tera.bytee/">

    <link rel="shortcut icon" href="<?= $base_url.'berkas/images/error_db.png'?>" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="<?=$base_url?>berkas/css/notfound.css">
  </head>

  <body>

    <div class="container">
      <div class="error">
        <h1>403</h1>
        <h2>AKSES HALAMAN DILARANG</h2>
        <p>
					<font class="font1">
						Halaman yang anda cari dilarang, Silahkan coba untuk <a href="<?=$base_url?>">KEMBALI</a> atau <a href="<?=$_homeurl_?>">KEMBALI</a>
					</font>
				</p>
        <p>
					<font class="font2">Silahkan coba untuk <a href="<?=$base_url?>">KEMBALI</a></font>
				</p>
      </div>
      <div class="stack-container">
        <div class="card-container">
          <div class="perspec" style="--spreaddist: 125px; --scaledist: .75; --vertdist: -25px;">
            <div class="card">
              <div class="writing">
                <div class="topbar">
                  <div class="red"></div>
                  <div class="yellow"></div>
                  <div class="green"></div>
                </div>
                <div class="code">
                  <ul>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card-container">
          <div class="perspec" style="--spreaddist: 100px; --scaledist: .8; --vertdist: -20px;">
            <div class="card">
              <div class="writing">
                <div class="topbar">
                  <div class="red"></div>
                  <div class="yellow"></div>
                  <div class="green"></div>
                </div>
                <div class="code">
                  <ul>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-container">
          <div class="perspec" style="--spreaddist:75px; --scaledist: .85; --vertdist: -15px;">
            <div class="card">
              <div class="writing">
                <div class="topbar">
                  <div class="red"></div>
                  <div class="yellow"></div>
                  <div class="green"></div>
                </div>
                <div class="code">
                  <ul>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-container">
          <div class="perspec" style="--spreaddist: 50px; --scaledist: .9; --vertdist: -10px;">
            <div class="card">
              <div class="writing">
                <div class="topbar">
                  <div class="red"></div>
                  <div class="yellow"></div>
                  <div class="green"></div>
                </div>
                <div class="code">
                  <ul>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-container">
          <div class="perspec" style="--spreaddist: 25px; --scaledist: .95; --vertdist: -5px;">
            <div class="card">
              <div class="writing">
                <div class="topbar">
                  <div class="red"></div>
                  <div class="yellow"></div>
                  <div class="green"></div>
                </div>
                <div class="code">
                  <ul>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-container">
          <div class="perspec" style="--spreaddist: 0px; --scaledist: 1; --vertdist: 0px;">
            <div class="card">
              <div class="writing">
                <div class="topbar">
                  <div class="red"></div>
                  <div class="yellow"></div>
                  <div class="green"></div>
                </div>
                <div class="code">
                  <ul>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </body>

  <script src="<?=$base_url?>berkas/js/notfound.js"></script>

  </html>
