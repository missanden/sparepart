<?php

include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";



$tanggalan=date('d-m-Y');
$filename="excellaporanpart-".$tanggalan.".xls";
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=$filename");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		
if($_POST['filter']=='BUY'){$header="<h1>Laporan Pembelian Part periode  $_POST[tanggal1] s/d $_POST[tanggal2]</h1>";}
else if($_POST['filter']=='USE') {$header="<h1>Laporan penggunaan Part periode  $_POST[tanggal1] s/d $_POST[tanggal2]</h1>";}		
		

echo "$header

<table border='1' cellspacing='0' cellpadding='0' width='92%'>
	<tr>
	<th><center>No</th>
	<th>No Transaksi</th>						
	<th>Tanggal</th>
	<th>Part Name</th>
	<th>Penggunaan Mesin</th>
	<th>Part Number</th>
	<th>Price</th>
	<th>Qty Penggunaan</th>
	<th>Total Harga</th>
	";



//Langkah 2: Sesuaikan perintah SQL
if($_POST['filter']=='BUY'){
$tampil = "SELECT *	FROM  masterpart
							INNER JOIN detail_transaksi
							ON detail_transaksi.kodeproduct=masterpart.kodeproduct
							INNER JOIN header_transaksi
							ON header_transaksi.no_transaksi=detail_transaksi.no_transaksi
							INNER JOIN master_application
							ON master_application.kode_application=masterpart.part_application
							
							WHERE header_transaksi.status_transaksi='".$_POST['filter']."' AND 
									header_transaksi.tanggal_transaksi BETWEEN '".$_POST['tanggal1']."' AND '".$_POST['tanggal2']."'
							 ORDER BY header_transaksi.no_transaksi DESC";
}

else if($_POST['filter']=='USE') {
	$tampil = "SELECT *	FROM  masterpart
							INNER JOIN detail_transaksi
							ON detail_transaksi.kodeproduct=masterpart.kodeproduct
							INNER JOIN header_transaksi
							ON header_transaksi.no_transaksi=detail_transaksi.no_transaksi
							INNER JOIN master_application
							ON master_application.kode_application=detail_transaksi.kode_application
							
							WHERE header_transaksi.status_transaksi='".$_POST['filter']."' AND 
									header_transaksi.tanggal_transaksi BETWEEN '".$_POST['tanggal1']."' AND '".$_POST['tanggal2']."'
							 ORDER BY header_transaksi.no_transaksi DESC";
	
}
		
$hasil  = mysql_query($tampil);

$no=1;
$total_harga=0;
while ($data=mysql_fetch_array($hasil)){
	
	$price=$data['price_total_transaksi']/$data['qty_transaksi'];
	$total_harga=$data['price_total_transaksi']+$total_harga;
	
  echo "<tr><td>$no</td>
			<td>$data[no_transaksi]</td>
			<td>$data[tanggal_transaksi]</td>
			<td>$data[part_name]</td>
			<td>$data[name_application]</td>
			<td>$data[part_number]</td>
			<td>$price</td>
			<td>$data[qty_transaksi]</td>
			<td>$data[price_total_transaksi]</td>
			</tr>";
  $no++;
}
echo "

<tr bgcolor='#d8d8d8'>
<td colspan='8' align='center'><b>TOTAL HARGA</b></td>
<td><b>$total_harga</b></td>
</tr>
</table><br>";

?>