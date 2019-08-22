<?php

session_start();
include "../../config/koneksi.php";

$module = $_GET['module'];
$act = $_GET['act'];



if ($module == 'master' AND $act == 'addpart') {

    mysql_query("INSERT INTO masterpart(
                                 part_name,
								 part_number,
								 part_price,
								 part_stock,
								 part_limit,
								 part_location,
								 part_supplier,
								 part_application
							) 
	                       VALUES('$_POST[part_name]',
									'$_POST[part_number]',
									'$_POST[part_price]',
									'0',
									'$_POST[part_limit]',
									'$_POST[part_location]',
									'$_POST[part_supplier]',
									'$_POST[part_application]'
								)");

    header('location:../../media.php?module=master&act=addpart&halaman=1');
} else if ($module == 'master' AND $act == 'updatepart') {



    mysql_query("UPDATE masterpart SET part_name='$_POST[part_name]',
                                                part_number='$_POST[part_number]',       
                                                part_price= '$_POST[part_price]',
                                                part_freq= '$_POST[part_freq]',
                                                part_limit= '$_POST[part_limit]',
                                                part_stock= '$_POST[part_stock]',
                                                part_location= '$_POST[part_location]',
                                                part_application= '$_POST[part_application]',
                                                part_supplier= '$_POST[part_supplier]'
                           WHERE kodeproduct      = '$_POST[kodeproduct]'");

    header('location:../../media.php?module=master&act=addpart&halaman=1');
} else if ($module == 'master' AND $act == 'adduser') {

    $password = md5($_POST['password']);

    mysql_query("INSERT INTO user(
                                 username,
								 password,
								 namalengkapuser
							) 
	                       VALUES('$_POST[username]',
									'$password',
									'$_POST[namalengkapuser]'
								)");

    header('location:../../media.php?module=master&act=adduser&halaman=1');
} else if ($module == 'master' AND $act == 'addsupplier') {

    $tampil = "SELECT * FROM  master_supplier
			order by master_supplier.kode_supplier DESC limit 0,1";
    $hasil = mysql_query($tampil);
    $data = mysql_fetch_array($hasil);


    $kode_supplier = $data['kode_supplier'] + 1;


    mysql_query("INSERT INTO master_supplier(
                                 kode_supplier,
					name_supplier,
					telpon_supplier,
                                        type_supplier
					alamat_supplier
							) 
	                       VALUES('$kode_supplier',
					'$_POST[name_supplier]',
					'$_POST[telpon_supplier]',
                                        '$_POST[type_supplier]',
					'$_POST[alamat_supplier]'
				)");

    header('location:../../media.php?module=master&act=addsupplier&halaman=1');
} else if ($module == 'master' AND $act == 'updatesupplier') {

    mysql_query("UPDATE master_supplier SET name_supplier='$_POST[name_supplier]',
							telpon_supplier='$_POST[telpon_supplier]',
                                                        type_supplier='$_POST[type_supplier]',
							alamat_supplier= '$_POST[alamat_supplier]'
                           WHERE kode_supplier      = '$_POST[kode_supplier]'");

    header('location:../../media.php?module=master&act=addsupplier&halaman=1');
}
?>