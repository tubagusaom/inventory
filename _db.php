<?php
	error_reporting(1);

	$env = 'online'; // lokal atau online

	if($env=='lokal'){
		$host	 		= "localhost";
		$user	 		= "root";
		$pass	 		= "";
		$dabname		= "inventory_db";
		$base			= "http://localhost/tera_byte/project/inventory/";
	}else{
		$host	 		= "151.106.119.249";
		$user		 	= "deelabs_terabyte";
		$pass	 		= "bismIll@h";
		$dabname 		= "deelabs_inventory_terabyte_db";
		$base			= "https://inventory.itconsultant.biz.id";
	}

	// $conn = mysql_connect( $host, $user, $pass) or die('Could not connect to mysql server.' );
	// mysql_select_db($dabname, $conn) or die('Could not select database.');

	// $koneksi = mysqli_connect($host, $user, $pass, $dabname);
	$koneksi = mysqli_connect($host, $user, $pass, $dabname) or die('<script>location.replace("error/")</script>');
	$baseurl=$base;
?>
