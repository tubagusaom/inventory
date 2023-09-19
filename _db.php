<?php
	error_reporting(1);

	$env = 'lokal'; // lokal atau online

	if($env=='lokal'){
		$host	 		= "localhost";
		$user	 		= "root";
		$pass	 		= "";
		$dabname		= "inventory_db";
		$base			= "http://localhost/tera_byte/project/inventory/";
	}else{
		$host	 		= "localhost";
		$user		 	= "u240976257_berta";
		$pass	 		= "berta12345";
		$dabname 		= "u240976257_sb";
		$base			= "http://ebe.esy.es/";
	} 

	// $conn = mysql_connect( $host, $user, $pass) or die('Could not connect to mysql server.' );
	// mysql_select_db($dabname, $conn) or die('Could not select database.');

	// $koneksi = mysqli_connect($host, $user, $pass, $dabname);
	$koneksi = mysqli_connect($host, $user, $pass, $dabname) or die('<script>location.replace("error/")</script>');
	$baseurl=$base;
?>
