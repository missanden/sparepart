<?php
date_default_timezone_set("Asia/Jakarta");

$server = "localhost";
$username = "root";
$password = "PSIak5352016";
$database = "spare_partdb";

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");


?>
