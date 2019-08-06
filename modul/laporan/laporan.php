<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>OTS</title>
        <meta name="description" content="Custom Login Form Styling with CSS3" />
        <meta name="keywords" content="css3, login, form, custom, input, submit, button, html5, placeholder" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
      
        <script src="form/js/modernizr.custom.63321.js"></script>
        <!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->

<script type="text/javascript" src="config/jquery.js"></script>
<script type="text/javascript" src="config/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="config/flora.datepicker.css" />
<script type="text/javascript" src="config/customInput.jquery.js"></script>
</head>
<script type="text/javascript">
$(function(){
	$("#tanggal1").datepicker({dateFormat: 'yy-mm-dd' });
	$("#tanggal2").datepicker({dateFormat: 'yy-mm-dd' });
	$("#tanggal3").datepicker({ dateFormat: 'yy-mm-dd' });
	$("#tanggal4").datepicker({ dateFormat: 'yy-mm-dd' });
	$("#tanggal5").datepicker({ dateFormat: 'yy-mm-dd' });
	$("#tanggal6").datepicker({ currentText: 'Skrg' })
	$("#tanggal7").datepicker({ prevText: '|<', nextText: '>|', currentText: 'Skrg', closeAtTop: false })	
})	
</script>	

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="inc/css/general.css" type="text/css" media="screen" />

</head>
	

<?php
	

	$aksi="laporan/aksi_laporan.php";
	switch($_GET['act']){
	
case "menulaporan";


	
	echo "<center>
<table class='noborder' border='0' cellspacing='0' celpadding='0'>
		<tr>
		
		<td align='center' class='noborder'>
		<a href='media.php?module=laporan&act=filterlaporanstock'><img src='images/laporanpartstock.png' width='150px' height='150px'></img></a></li>
		<br>
		<b>Laporan<br> Stock Part</b></td>
		
		<td align='center' class='noborder'>
		<a href='media.php?module=laporan&act=filterlaporanpart'><img src='images/laporanpakaibuy.png' width='150px' height='150px'></img></a></li>
		<br>
		<b>Laporan Penggunaan <br>& Pembelian Part</b></td>
		
		<td align='center' class='noborder'>
		<a href='media.php?module=laporan&act=filterlaporanmesin'><img src='images/machine.png' width='150px' height='150px'></img></a></li>
		<br>
		<b>Laporan Penggunaan Part <br>Untuk Mesin</b></td>
		</tr>

</table></center><br>";


break;	
	
case "filterlaporanmesin":	


echo"<h1>Filter Pemakaian Mesin</h1>
<form method='post' class='form4' action='?module=laporan&act=hasillaporanmesin&halaman=1'>
                            <table id='tablemodul'>
                          
							<tr>
							<td align=left class=cc>Pemakaian Mesin</td><td>
							<select name='part_application'>
		 								<option value=''>- Pemakaian Mesin -</option>";
		 								$tampil=mysql_query("SELECT * FROM master_application ORDER BY name_application ASC");
														while($w=mysql_fetch_array($tampil)){
																				echo "<option value='$w[kode_application]'>$w[name_application]</option>";
															}
											echo "</select>
							
							</td>
							</tr>
							
							<tr>
							<tr>
							<td>Tanggal Penggunaan</td><td><input type=text name='tanggal1' value='' id='tanggal3' size=15> s/d <input type=text name='tanggal2' value='' id='tanggal2' size=15></td>
							</tr>
							<td colspan='2'>
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   <input type=submit value='Rekap Laporan' Laporan' class=tombol></td></tr>
                            </table></form>";

break;


case "hasillaporanmesin";


echo"<h1>Filter Pemakaian Mesin</h1>
<form method='post' class='form4' action='?module=laporan&act=hasillaporanmesin&halaman=1'>
                            <table id='tablemodul'>
                          
							<tr>
							<td align=left class=cc>Pemakaian Mesin</td><td>
							<select name='part_application'>
		 								<option value=''>- Pemakaian Mesin -</option>";
		 								$tampil=mysql_query("SELECT * FROM master_application ORDER BY name_application ASC");
														while($w=mysql_fetch_array($tampil)){
																				echo "<option value='$w[kode_application]'>$w[name_application]</option>";
															}
											echo "</select>
							
							</td>
							</tr>
							
							<tr>
							<tr>
							<td>Tanggal Penggunaan</td><td><input type=text name='tanggal1' value='' id='tanggal3' size=15> s/d <input type=text name='tanggal2' value='' id='tanggal2' size=15></td>
							</tr>
							<td colspan='2'>
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   <input type=submit value='Rekap Laporan' Laporan' class=tombol></td></tr>
                            </table></form><br>";

$tampil = "SELECT *	FROM  masterpart
							INNER JOIN detail_transaksi
							ON detail_transaksi.kodeproduct=masterpart.kodeproduct
							INNER JOIN header_transaksi
							ON header_transaksi.no_transaksi=detail_transaksi.no_transaksi
							INNER JOIN master_location
										ON master_location.kode_location=masterpart.part_location
									INNER JOIN master_supplier
										ON master_supplier.kode_supplier=masterpart.part_supplier
							INNER JOIN master_application
									ON master_application.kode_application=detail_transaksi.kode_application
										
							WHERE detail_transaksi.kode_application='".$_POST['part_application']."' AND 
									header_transaksi.tanggal_transaksi BETWEEN '".$_POST['tanggal1']."' AND '".$_POST['tanggal2']."'
							 ORDER BY header_transaksi.no_transaksi DESC";
			
$hasil  = mysql_query($tampil);

$no=1;
$total_harga=0;

			
echo "
<form method='post' class='form' action='modul/laporan/excellaporanmesin.php'>
<input type='hidden' name='part_application' value='$_POST[part_application]'>
<input type='hidden' name='tanggal1' value='$_POST[tanggal1]'>
<input type='hidden' name='tanggal2' value='$_POST[tanggal2]'>

<input type='image' name='submit' src='images/convertexcel.png' width='230px' height='45px' border='0' alt='Submit' />
</form>";


echo "<h1>LAPORAN PEMAKAIAN MESIN PERIODE ".tgl_indo($_POST['tanggal1'])." S/D ".tgl_indo($_POST['tanggal2'])."</h1>
<center>
<table border='1' cellspacing='0' cellpadding='0' width='98%'>
	<tr>
	<th><center>No</th>
	<th>Mesin</th>
	<th>No Transaksi</th>						
	<th>Tanggal</th>
	<th>Nama Part</th>
	<th>No. Part</th>
	<th>Lokasi</th>
	<th>Harga</th>
	<th>Jumlah part</th>
	<th>Total Harga</th>";


while ($data=mysql_fetch_array($hasil)){
	
	$price=$data['price_total_transaksi']/$data['qty_transaksi'];
	$total_harga=$data['price_total_transaksi']+$total_harga;
	
  echo "<tr><td>$no</td>
			<td>$data[name_application]</td>
			<td>$data[no_transaksi]</td>
			<td>".tgl_indo($data['tanggal_transaksi'])."</td>
			<td>$data[part_name]</td>
			<td>$data[part_number]</td>
			<td>$data[name_location]</td>
			<td>".number_format($price,0,',','.')."</td>
			<td align='center'> ".number_format($data['qty_transaksi'],0,',','.')."</td>
			<td>".number_format($data['price_total_transaksi'],0,',','.')."</td>
			</tr>";
  $no++;
}
echo "
<tr bgcolor='#d8d8d8'>
<td colspan='9' align='center'><b>TOTAL HARGA</b></td>
<td><b>".number_format($total_harga,0,',','.')."</b></td>
</tr>

</table><br>";
							
							
							
break;
	
	
case "filterlaporanstock":
	
	
?> 

 
<body>	
		<h1>Search Laporan  Stock</h1>
		
		<style type="text/css" xml:space="preserve">
			BODY, P,TD{ font-family: Arial,Verdana,Helvetica, sans-serif; font-size: 10pt }
			A{font-family: Arial,Verdana,Helvetica, sans-serif;}
			B {	font-family : Arial, Helvetica, sans-serif;	font-size : 12px;	font-weight : bold;}
				</style><script language="JavaScript" src="inc/gen_validatorv4.js"
			type="text/javascript" xml:space="preserve"></script>
		
	</nav>
              <span>
              <ul>        
                <?php
				      echo"<form method='post' class='form' action='?module=laporan&act=hasillaporanstock&halaman=1'>
                            <table id='tablemodul'>
							<tr>
							<td align=right class=cc>Laporan</td><td><select class='branch' name='filter' >
							<option value='' selected>Silakan Pilih</option>
							<option value='ALL'>ALL</option>
							<option value='ORDER'>ORDER</option>
							</td>
							</tr>
							<tr>
							<td colspan='2'>
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   <input type=submit value='Rekap Laporan' class=tombol></td></tr>
                            </table></form>
                  
              </ul>
              </span>
            <br/>";  

	
	break;

	
case "hasillaporanpart":

	
?> 

 
<body>	
		<h1>Search Laporan  Part</h1>
		
		<style type="text/css" xml:space="preserve">
			BODY, P,TD{ font-family: Arial,Verdana,Helvetica, sans-serif; font-size: 10pt }
			A{font-family: Arial,Verdana,Helvetica, sans-serif;}
			B {	font-family : Arial, Helvetica, sans-serif;	font-size : 12px;	font-weight : bold;}
				</style><script language="JavaScript" src="inc/gen_validatorv4.js"
			type="text/javascript" xml:space="preserve"></script>
		
	</nav>
              <span>
              <ul>        
                <?php
				      echo"<form method='post' class='form' action='?module=laporan&act=hasillaporanpart'>
                            <table id='tablemodul'>
							<tr>
							<td align=right class=cc>Laporan</td><td><select class='branch' name='filter' >
							<option value='' selected>Silakan Pilih</option>
							<option value='USE'>Penggunaan Part</option>
							<option value='BUY'>Pembelian Part</option>
							</td>
							</tr>
							
							<tr>
							<td>Tanggal</td><td><input type=text name='tanggal1' value='' id='tanggal1' size=15> s/d <input type=text name='tanggal2' value='' id='tanggal2' size=15></td>
							</tr>
							<tr>
							<td colspan='2'>
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   <input type='submit' value='Rekap Laporan' class='tombol'></td></tr>
                            </table></form>
                  
              </ul>
              </span>
            <br/>";  

IF ($_POST['filter']=='USE') {$header="PENGGUNAAN";}
ELSE {$header="PENAMBAHAN";}
			
echo "
<form method='post' class='form' action='modul/laporan/excellaporanpart.php'>
<input type='hidden' name='filter' value='$_POST[filter]'>
<input type='hidden' name='tanggal1' value='$_POST[tanggal1]'>
<input type='hidden' name='tanggal2' value='$_POST[tanggal2]'>

<input type='image' name='submit' src='images/convertexcel.png' width='230px' height='45px' border='0' alt='Submit' />
</form>

<h1>LAPORAN $header PART PERIODE ".tgl_indo($_POST['tanggal1'])." S/D ".tgl_indo($_POST['tanggal2'])."</h1>
<center>
<table border='1' cellspacing='0' cellpadding='0' width='95%'>
	<tr>
	<th><center>No</th>
	<th>No Transaksi</th>						
	<th>Tanggal</th>
	<th>Nama Part</th>
	<th>No. Part</th>
	<th>Lokasi</th>
	<th>Harga</th>
	<th>Jumlah $header</th>
	<th>Total Harga</th>
	";



//Langkah 2: Sesuaikan perintah SQL
$tampil = "SELECT *	FROM  masterpart
							INNER JOIN detail_transaksi
							ON detail_transaksi.kodeproduct=masterpart.kodeproduct
							INNER JOIN header_transaksi
							ON header_transaksi.no_transaksi=detail_transaksi.no_transaksi
							INNER JOIN master_location
										ON master_location.kode_location=masterpart.part_location
									INNER JOIN master_supplier
										ON master_supplier.kode_supplier=masterpart.part_supplier
										
							WHERE header_transaksi.status_transaksi='".$_POST['filter']."' AND 
									header_transaksi.tanggal_transaksi BETWEEN '".$_POST['tanggal1']."' AND '".$_POST['tanggal2']."'
							 ORDER BY header_transaksi.no_transaksi DESC";
			
$hasil  = mysql_query($tampil);

$no=1;
$total_harga=0;

while ($data=mysql_fetch_array($hasil)){
	
	$price=$data['price_total_transaksi']/$data['qty_transaksi'];
	$total_harga=$data['price_total_transaksi']+$total_harga;
	
  echo "<tr><td>$no</td>
			<td>$data[no_transaksi]</td>
			<td>".tgl_indo($data['tanggal_transaksi'])."</td>
			<td>$data[part_name]</td>
			<td>$data[part_number]</td>
			<td>$data[name_location]</td>
			<td>".number_format($price,0,',','.')."</td>
			<td align='center'> ".number_format($data['qty_transaksi'],0,',','.')."</td>
			<td>".number_format($data['price_total_transaksi'],0,',','.')."</td>
			</tr>";
  $no++;
}
echo "
<tr bgcolor='#d8d8d8'>
<td colspan='8' align='center'><b>TOTAL HARGA</b></td>
<td><b>".number_format($total_harga,0,',','.')."</b></td>
</tr>

</table><br>";

break;	
	
	
	

case "filterlaporanpart":
	
	
?> 

 
<body>	
		<h1>Search Laporan  Part</h1>
		
		<style type="text/css" xml:space="preserve">
			BODY, P,TD{ font-family: Arial,Verdana,Helvetica, sans-serif; font-size: 10pt }
			A{font-family: Arial,Verdana,Helvetica, sans-serif;}
			B {	font-family : Arial, Helvetica, sans-serif;	font-size : 12px;	font-weight : bold;}
				</style><script language="JavaScript" src="inc/gen_validatorv4.js"
			type="text/javascript" xml:space="preserve"></script>
		
	</nav>
              <span>
              <ul>        
                <?php
				      echo"<form method='post' class='form' action='?module=laporan&act=hasillaporanpart'>
                            <table id='tablemodul'>
							<tr>
							<td align=right class=cc>Laporan</td><td><select class='branch' name='filter' >
							<option value='' selected>Silakan Pilih</option>
							<option value='USE'>Penggunaan Part</option>
							<option value='BUY'>Pembelian Part</option>
							</td>
							</tr>
							
							<tr>
							<td>Tanggal</td><td><input type=text name='tanggal1' value='' id='tanggal1' size=15> s/d <input type=text name='tanggal2' value='' id='tanggal2' size=15></td>
							</tr>
							<tr>
							<td colspan='2'>
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   <input type=submit value='Rekap Laporan' class=tombol></td></tr>
                            </table></form>
                  
              </ul>
              </span>
            <br/>";  

	
	
	
	break;	
	
	
	
	
case "hasillaporanstock":
?>
<body>	
		<h1>Search Laporan  Stock</h1>
		
		<style type="text/css" xml:space="preserve">
			BODY, P,TD{ font-family: Arial,Verdana,Helvetica, sans-serif; font-size: 10pt }
			A{font-family: Arial,Verdana,Helvetica, sans-serif;}
			B {	font-family : Arial, Helvetica, sans-serif;	font-size : 12px;	font-weight : bold;}
				</style><script language="JavaScript" src="inc/gen_validatorv4.js"
			type="text/javascript" xml:space="preserve"></script>
		
	</nav>
              <span>
              <ul>        
                <?php
				      echo"<form method='post' class='form' action='?module=laporan&act=hasillaporanstock&halaman=1'>
                            <table id='tablemodul'>
							<tr>
							<td align=right class=cc>Laporan</td><td><select class='branch' name='filter' >
							<option value='' selected>Silakan Pilih</option>
							<option value='ALL'>ALL</option>
							<option value='ORDER'>ORDER</option>
							</td>
							</tr>
							<tr>
							<td colspan='2'>
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   <input type=submit value='Rekap Laporan' class=tombol></td></tr>
                            </table></form>
                  
              </ul>
              </span>
            <br/>";  
	

	
IF($_POST['filter']=='ORDER'){	
$tampil = "SELECT * FROM  masterpart INNER JOIN master_location
										ON master_location.kode_location=masterpart.part_location
									INNER JOIN master_supplier
										ON master_supplier.kode_supplier=masterpart.part_supplier
			WHERE masterpart.part_stock< masterpart.part_limit
			order by masterpart.part_name ASC";
			
	$header="Laporan Part Order";		
}

ELSE {
	$tampil = "SELECT * FROM  masterpart INNER JOIN master_location
										ON master_location.kode_location=masterpart.part_location
									INNER JOIN master_supplier
										ON master_supplier.kode_supplier=masterpart.part_supplier
			order by masterpart.part_name ASC";
			
	$header="Laporan Stock";
}	
			
	echo "<h1>$header</h1>
	<br>

<form method='post' class='form' action='modul/laporan/excellaporanstock.php'>
<input type='hidden' name='filter' value='$_POST[filter]'>
<input type='image' name='submit' src='images/convertexcel.png' width='230px' height='45px' border='0' alt='Submit' />
</form>

	<center>
	<table border='1' cellspacing='0' cellpadding='0' width='92%'>
	<tr>
	<th><center>No</th>
	<th>Nama Part</th>
	<th>No. Part</th>
	<th width='13%'>HARGA</th>
	<th>STOK PART</th>
	<th>MINIMUM STOK</th>
	<th>LOKASI</th>
	<th>SUPPLIER</th>";

	
$batas=10;
$halaman=$_GET['halaman'];
if(empty($halaman)){
	$posisi=0;
	$halaman=1;
}
else{
	$posisi = ($halaman-1) * $batas;
}	
	

		
$hasil  = mysql_query($tampil);
$no=1;
$file="?module=laporan&act=hasillaporanstock";
while ($data=mysql_fetch_array($hasil)){
  echo "<tr><td>$no</td>
			<td>$data[part_name]</td>
			<td>$data[part_number]</td>
			<td>".number_format($data['part_price'],0,',','.')."</td>
			<td>".number_format($data['part_stock'],0,',','.')."</td>
			<td>".number_format($data['part_limit'],0,',','.')."</td>
			<td>$data[name_location]</td>
			<td Title='$data[name_supplier]
				\n Alamat :  $data[alamat_supplier] \n Telpon Supplier : $data[telpon_supplier]'>
				$data[name_supplier]</td>
			</tr>";
  $no++;
}
echo "</table><br>";

break;
	
	}
?>	