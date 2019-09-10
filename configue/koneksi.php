<?php

// panggil fungsi validasi xss dan injection
require_once('fungsi_validasi.php');

$server =  "localhost";
$username = "root";
$password = "668844123";
$database = "kominfo";

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password)or die("Koneksi tidak bisa dibuka") ;
mysql_select_db($database) or die("Database tidak bisa dibuka");

// buat variabel untuk validasi dari file fungsi_validasi.php
$val = new Rizalvalidasi;

?>
