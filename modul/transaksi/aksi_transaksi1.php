<?php
session_start();
include "../../config/koneksi.php";



$module=$_GET['module'];
$act=$_GET['act'];


if ($module=='transaksi' AND $act=='penggunaan'){

		
$tahun1  = date('Y');
$bulan1  = date('m');
$tanggalawal=$tahun1."-".$bulan1."-"."01 ";
$now  = date('Y-m-d');

	$query=mysql_query("SELECT * FROM header_transaksi WHERE tanggal_input BETWEEN '$tanggalawal' AND '$now' AND status_transaksi='USE'");
	$row = mysql_num_rows($query);


$r=$row+1;
$length=strlen($r);	

if($length==1){$no_transaksi=$tahun1."".$bulan1."/USE/000".$r;}
else if($length==2){$no_transaksi=$tahun1."".$bulan1."/USE/00".$r;}
else if($length==3){$no_transaksi=$tahun1."".$bulan1."/USE/0".$r;}
else if($length==4){$no_transaksi=$tahun1."".$bulan1."/USE/".$r;}
	

mysql_query("INSERT INTO header_transaksi
								(no_transaksi,
                                 status_transaksi,
                                 tanggal_transaksi,
								 tanggal_input) 
	                       VALUES(
						   '$no_transaksi',
						   'USE',
						   '$_POST[tanggal]',
						   '$now')");


			
		
			
				$nomor=$_POST['nomor'];
			
			
			
	for($i=1; $i<=$nomor; $i++)
                    {
						
			mysql_query("INSERT INTO detail_transaksi
			
								(no_transaksi,
								kodeproduct,
                                 qty_transaksi,
                                 price_total_transaksi,
								 kode_application) 
								 
	                       VALUES(
						 '".$_POST['no_transaksi'][$i]."',
						   '".$_POST['kode_product'][$i]."',
						   '".$_POST['qty_transaksi'][$i]."',
						   '".$_POST['price_total_transaksi'][$i]."',
						   '".$_POST['kode_application'][$i]."'
						   )");
			


//=============================update============================

$query=mysql_query("SELECT * FROM masterpart WHERE kodeproduct='".$_POST['kode_product'][$i]."'");
$data=mysql_fetch_array($query);

$part_stock=$data['part_stock']-$_POST['qty_transaksi'][$i];


		
mysql_query("UPDATE masterpart SET part_stock       = '$part_stock'
           WHERE kodeproduct   = '".$_POST['kode_product'][$i]."'");	
					
                    }
	header('location:../../media.php?module='.$module.'&act=addpemakaian&halaman=1'); 	
		
	
}


else if ($module=='transaksi' AND $act=='updateorderpart'){
	
		
$tampil = "SELECT *	FROM  masterpart
							WHERE masterpart.kodeproduct='$_POST[kodeproduct]'";

$hasil  = mysql_query($tampil);
$data=mysql_fetch_array($hasil);
	
	$price_total_transaksi=$data['part_price']*$_POST['qty_transaksi'];
	
	 mysql_query("UPDATE detail_transaksi SET qty_transaksi='$_POST[qty_transaksi]',
											price_total_transaksi='$price_total_transaksi'
                           WHERE kodedetail      = '$_POST[kodedetail]'");

	
	header('location:../../media.php?module=transaksi&act=vieworder&id='.$_POST['no_po']);	
	
	
}







else if ($module=='transaksi' AND $act=='hapusorder'){
	

	
$tampil = "SELECT *	FROM  masterpart
							INNER JOIN detail_transaksi
							ON detail_transaksi.kodeproduct=masterpart.kodeproduct
							INNER JOIN header_transaksi
							ON header_transaksi.no_transaksi=detail_transaksi.no_transaksi
							WHERE header_transaksi.status_transaksi='ORD' AND header_transaksi.status_order='ORDER' AND
							detail_transaksi.kodedetail LIKE '%$_GET[id]%'";

$hasil  = mysql_query($tampil);
$data=mysql_fetch_array($hasil);
	
	 $no_po=$data['no_po'];
	
	
	 mysql_query("DELETE FROM detail_transaksi 
                           WHERE kodedetail      = '$_GET[id]'");

						   
	
	
	
	header('location:../../media.php?module=transaksi&act=vieworder&id='.$no_po);	
	
	
}






else if ($module=='transaksi' AND $act=='pembelian'){

$tahun1  = date('Y');
$bulan1  = date('m');
$tanggalawal=$tahun1."-".$bulan1."-"."01 ";
$now  = date('Y-m-d');


$query=mysql_query("SELECT * FROM header_transaksi WHERE tanggal_input BETWEEN '$tanggalawal' AND '$now' AND 
									header_transaksi.status_transaksi='BUY'");
	$row = mysql_num_rows($query);


$r=$row+1;
$length=strlen($r);	

if($length==1){$no_transaksi=$tahun1."".$bulan1."/BUY/000".$r;}
else if($length==2){$no_transaksi=$tahun1."".$bulan1."/BUY/00".$r;}
else if($length==3){$no_transaksi=$tahun1."".$bulan1."/BUY/0".$r;}
else if($length==4){$no_transaksi=$tahun1."".$bulan1."/BUY/".$r;}


mysql_query("INSERT INTO header_transaksi
								(no_transaksi,
                                 status_transaksi,
								 tanggal_input,
                                 tanggal_transaksi,
								 no_po
								 ) 
	                       VALUES(
						   '$no_transaksi',
						   'BUY',
						   '$now',
						   '$_POST[tanggal]',
						   '$_POST[no_po]')");


					   
	


$tampil = "SELECT *	FROM  masterpart
							INNER JOIN detail_transaksi
							ON detail_transaksi.kodeproduct=masterpart.kodeproduct
							INNER JOIN header_transaksi
							ON header_transaksi.no_transaksi=detail_transaksi.no_transaksi
							WHERE header_transaksi.status_transaksi='ORD' AND header_transaksi.status_order='ORDER' AND
							header_transaksi.no_po LIKE '%$_POST[no_po]%'
							 ORDER BY header_transaksi.no_transaksi DESC";
			
$hasil  = mysql_query($tampil);


while ($data=mysql_fetch_array($hasil)){
	
	
			
			mysql_query("INSERT INTO detail_transaksi
			
								(no_transaksi,
								kodeproduct,
                                 qty_transaksi,
                                 price_total_transaksi) 
								 
	                       VALUES(
						 '".$no_transaksi."',
						   '".$data['kodeproduct']."',
						   '".$data['qty_transaksi']."',
						   '".$data['price_total_transaksi']."')");
	

//=============================update============================

$query1=mysql_query("SELECT * FROM masterpart WHERE kodeproduct='".$data['kodeproduct']."'");
$data1=mysql_fetch_array($query1);

$part_stock=$data1['part_stock']+$data['qty_transaksi'];


mysql_query("UPDATE masterpart SET part_stock       = '$part_stock'
           WHERE kodeproduct   = '".$data['kodeproduct']."'");	
					
	
	
}


 mysql_query("UPDATE header_transaksi SET status_order='CLOSE'
                           WHERE no_po      = '$_POST[no_po]' AND status_transaksi='ORD'");	
						   
	header('location:../../media.php?module='.$module.'&act=addpembelian&halaman=1'); 					   
	
//header('location:../../media.php?module='.$module.'&act=addpembelian&halaman=1'); 
	/*	
$tahun1  = date('Y');
$bulan1  = date('m');
$tanggalawal=$tahun1."-".$bulan1."-"."01 ";
$now  = date('Y-m-d');

	$query=mysql_query("SELECT * FROM header_transaksi WHERE tanggal_transaksi BETWEEN '$tanggalawal' AND '$now' AND 
									header_transaksi.status_transaksi='BUY'");
	$row = mysql_num_rows($query);


$r=$row+1;
$length=strlen($r);	

if($length==1){$no_transaksi=$tahun1."".$bulan1."/BUY/000".$r;}
else if($length==2){$no_transaksi=$tahun1."".$bulan1."/BUY/00".$r;}
else if($length==3){$no_transaksi=$tahun1."".$bulan1."/BUY/0".$r;}
else if($length==4){$no_transaksi=$tahun1."".$bulan1."/BUY/".$r;}
	

mysql_query("INSERT INTO header_transaksi
								(no_transaksi,
                                 status_transaksi,
                                 tanggal_transaksi,
								 no_po,
								 tanggal_estimasi) 
	                       VALUES(
						   '$no_transaksi',
						   'BUY',
						   '$POST[tanggal]',
						   '$POST[no_po]',)");


			
				$nomor=$_POST['nomor'];
			
			
			
	for($i=1; $i<=$nomor; $i++)
                    {
						
				
						
			mysql_query("INSERT INTO detail_transaksi
			
								(no_transaksi,
								kodeproduct,
                                 qty_transaksi,
                                 price_total_transaksi) 
								 
	                       VALUES(
						 '".$_POST['no_transaksi'][$i]."',
						   '".$_POST['kode_product'][$i]."',
						   '".$_POST['qty_transaksi'][$i]."',
						   '".$_POST['price_total_transaksi'][$i]."')");
			


//=============================update============================

$query=mysql_query("SELECT * FROM masterpart WHERE kodeproduct='".$_POST['kode_product'][$i]."'");
$data=mysql_fetch_array($query);

$part_stock=$data['part_stock']+$_POST['qty_transaksi'][$i];


mysql_query("UPDATE masterpart SET part_stock       = '$part_stock'
           WHERE kodeproduct   = '".$_POST['kode_product'][$i]."'");	
					
                    }
			
			header('location:../../media.php?module='.$module.'&act=addpembelian&halaman=1'); 
	*/
	
}





else if ($module=='transaksi' AND $act=='order'){

		
$tahun1  = date('Y');
$bulan1  = date('m');
$tanggalawal=$tahun1."-".$bulan1."-"."01 ";
$now  = date('Y-m-d');

	$query=mysql_query("SELECT * FROM header_transaksi WHERE tanggal_transaksi BETWEEN '$tanggalawal' AND '$now' AND status_transaksi='ORD'");
	$row = mysql_num_rows($query);


$r=$row+1;
$length=strlen($r);	

if($length==1){$no_transaksi=$tahun1."".$bulan1."/ORD/000".$r;}
else if($length==2){$no_transaksi=$tahun1."".$bulan1."/ORD/00".$r;}
else if($length==3){$no_transaksi=$tahun1."".$bulan1."/ORD/0".$r;}
else if($length==4){$no_transaksi=$tahun1."".$bulan1."/ORD/".$r;}
	

mysql_query("INSERT INTO header_transaksi
								(no_transaksi,
                                 status_transaksi,
                                 tanggal_transaksi,
								 no_po,
								 tanggal_estimasi,
								 status_order) 
	                       VALUES(
						   '$no_transaksi',
						   'ORD',
						   '$now',
						   '$_POST[no_po]',
						   '$_POST[tanggal_estimasi]',
						   'ORDER')");


			
				$nomor=$_POST['nomor'];
			
			
			
	for($i=1; $i<=$nomor; $i++)
                    {
						
				
						
			mysql_query("INSERT INTO detail_transaksi
			
								(no_transaksi,
								kodeproduct,
                                 qty_transaksi,
                                 price_total_transaksi) 
								 
	                       VALUES(
						 '".$no_transaksi."',
						   '".$_POST['kode_product'][$i]."',
						   '".$_POST['qty_transaksi'][$i]."',
						   '".$_POST['price_total_transaksi'][$i]."')");
			


//=============================update============================
          }
			
			header('location:../../media.php?module='.$module.'&act=addorder&halaman=1'); 
		
	
}

?>