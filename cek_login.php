<?php
session_start();
include "config/koneksi.php";


$username = $_POST['username'];
$pass     = $_POST['password'];

$pass=md5($pass);


$login=mysql_query("SELECT * FROM user
WHERE user.username='$username' AND user.password='$pass'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

echo $ketemu;
// Apabila no_employee dan password ditemukan
if ($ketemu > 0){
	
  $_SESSION['s_user']     	= $r['username'];
 header('location:menu.php');
 
}
else{
	
	echo "<script>window.alert('User or Password Failed.'); window.location=('index.php')</script>";

	
}

?>
