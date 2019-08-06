<?php

include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";





$tanggalan=date('d-m-Y');
$filename="excellaporanpemakaianmesin-".$tanggalan.".xls";
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=$filename");
		header("Pragma: no-cache");
		header("Expires: 0");
		


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
			<td>$data[tanggal_transaksi]</td>
			<td>$data[part_name]</td>
			<td>$data[part_number]</td>
			<td>$data[name_location]</td>
			<td>$price</td>
			<td align='center'>$data[qty_transaksi]</td>
			<td>$data[price_total_transaksi]</td>
			</tr>";
  $no++;
}
echo "
<tr bgcolor='#d8d8d8'>
<td colspan='9' align='center'><b>TOTAL HARGA</b></td>
<td><b>$total_harga</b></td>
</tr>

</table><br>";
							
		

?>