<?php
include "config/koneksi.php";
include "config/fungsi_indotgl.php";

if ($_GET['module']=='master'){
  include "modul/master/master.php";
}

else if ($_GET['module']=='transaksi'){
  include "modul/transaksi/transaksi.php";
}

else if ($_GET['module']=='laporan'){
  include "modul/laporan/laporan.php";
}


// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>
