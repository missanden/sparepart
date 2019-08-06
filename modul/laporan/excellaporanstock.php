<?php

include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";





$tanggalan=date('d-m-Y');
$filename="excellaporanstock-".$tanggalan.".xls";
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=$filename");
		header("Pragma: no-cache");
		header("Expires: 0");
		

echo "<center>
	<table border='1' cellspacing='0' cellpadding='0' width='92%'>
	<tr>
	<th><center>No</th>
	<th>Nama Part</th>
	<th>No. Part</th>
	<th width='13%'>Price</th>
	<th>Stok Part</th>
	<th>Minimum Stok</th>
	<th>Lokasi</th>
	<th>Supplier</th>";

	
	
	
IF($_POST['filter']=='ORDER'){	
$tampil = "SELECT * FROM  masterpart
			WHERE masterpart.part_stock< masterpart.part_limit
			order by masterpart.part_name ASC";
}

ELSE {
	$tampil = "SELECT * FROM  masterpart
			order by masterpart.part_name ASC";
	
}
		
$hasil  = mysql_query($tampil);
$no=1;
while ($data=mysql_fetch_array($hasil)){
  echo "<tr><td>$no</td>
			<td>$data[part_name]</td>
			<td>$data[part_number]</td>
			<td>$data[part_price]</td>
			<td>$data[part_stock]</td>
			<td>$data[part_limit]</td>
			<td>$data[part_location]</td>
			<td>$data[part_supplier]</td>
			</tr>";
  $no++;
}
echo "</table><br>";

?>