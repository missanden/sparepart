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

<link rel="stylesheet" href="/css/sty 


    le.css" type="text/css" />
		
<script type="text/javascript" src="config/jquery.js"></script>
<script type="text/javascript" src="config/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="config/flora.datepicker.css" />
<script type="text/javascript" src="config/customInput.jquery.js"></script>
</head>
<script type="text/javascript">
$(function(){
	$("#tanggal1").datepicker({dateFormat: 'yy-mm-dd' });
	$("#tanggal8").datepicker({dateFormat: 'dd-mm-y' });
	$("#tanggal2").datepicker({dateFormat: 'yy-mm-dd' });
	$("#tanggal3").datepicker({ dateFormat: 'yy-mm-dd' });
	$("#tanggal4").datepicker({ dateFormat: 'yy-mm-dd' });
	$("#tanggal5").datepicker({ dateFormat: 'yy-mm-dd' });
	$("#tanggal6").datepicker({ currentText: 'Skrg' })
	$("#tanggal7").datepicker({ prevText: '|<', nextText: '>|', currentText: 'Skrg', closeAtTop: false })	
})	
</script>	

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="config/css/general.css" type="text/css" media="screen" />
	
</head>
		

<?php
	

	$aksi="modul/transaksi/aksi_transaksi.php";
	switch($_GET['act']){

	
	case "menutransaksi":
	
	
	echo "<center>
<table class='noborder' border='0' cellspacing='0' celpadding='0'>
		<tr>
		
		<td align='center' class='noborder'>
		<a href='media.php?module=transaksi&act=addorder&halaman=1'><img src='images/menuorder.png'  width='140px' height='120px'></img></a></li>
		<br>
		<b>1. Order Part</b></td>
		
		<td align='center' class='noborder'>
		<img src='images/arow.png'  width='120px' height='120px'></img>
		<br>
		</td>
		
		<td align='center' class='noborder'>
		<a href='media.php?module=transaksi&act=addpembelian&halaman=1'><img src='images/pembelianpart.png'  width='140px' height='120px'></img></a></li>
		<br>
		<b>2. Penambahan Part</b></td>
		
		<td align='center' class='noborder'>
		<img src='images/arow.png'  width='120px' height='120px'></img>
		<br>
		</td>
		
		<td align='center' class='noborder'>
		<a href='media.php?module=transaksi&act=addpemakaian&halaman=1'><img src='images/pemakaianpart.png' width='140px' height='120px'></img></a></li>
		<br>
		<b>3. Penggunaan Part</b></td>
		
		
		
		</tr>

</table></center><br>";
	
	break;
	

case "searchpembelian":

echo "<h1>Hasil Pencarian No. PO : <b>$_POST[no_po]</b></h1>
<center><table border='1' cellspacing='0' cellpadding='0' width='98%'>
	<tr>
	<th><center>No</th>
	<th>No PO</th>						
	<th>No Transaksi</th>						
	<th>Estimasi Tanggal Datang</th>
	<th>Nama Part</th>
	<th>No. Part</th>
	<th>Harga Satuan</th>
	<th>Jumlah Barang Datang</th>
	<th>Total Harga</th>
	<th>Edit/Delete</th>
	";


//Langkah 1: Tentukan batas,cek halaman & posisi data
$batas=10;
$halaman=$_GET['halaman'];
if(empty($halaman)){
	$posisi=0;
	$halaman=1;
}
else{
	$posisi = ($halaman-1) * $batas;
}

//Langkah 2: Sesuaikan perintah SQL
$tampil = "SELECT *	FROM  masterpart
							INNER JOIN detail_transaksi
							ON detail_transaksi.kodeproduct=masterpart.kodeproduct
							INNER JOIN header_transaksi
							ON header_transaksi.no_transaksi=detail_transaksi.no_transaksi
							WHERE header_transaksi.status_transaksi='ORD' AND header_transaksi.status_order='ORDER' AND
							header_transaksi.no_po LIKE '%$_POST[no_po]%'
							 ORDER BY header_transaksi.no_transaksi DESC 
									LIMIT $posisi,$batas";
			
$hasil  = mysql_query($tampil);

$no=$posisi+1;
$total_harga=0;
while ($data=mysql_fetch_array($hasil)){
	
	$price=$data['price_total_transaksi']/$data['qty_transaksi'];
	$total_harga=$total_harga+$data['price_total_transaksi'];
	
  echo "<tr><td>$no</td>
			<td>$data[no_po]</td>
			<td>$data[no_transaksi]</td>
			<td>".tgl_indo($data['tanggal_estimasi'])."</td>
			<td>$data[part_name]</td>
			<td>$data[part_number]</td>
			<td>".number_format($price,0,',','.')."</td>
			<td align='center'> ".number_format($data['qty_transaksi'],0,',','.')."</td>
			<td>".number_format($data['price_total_transaksi'],0,',','.')."</td>
			<td align='center'>
			<a href=?module=transaksi&act=editorderpart&id=$data[kodedetail]><img src='images/edit.png' border='0' title='edit' /></a>
			<a href=$aksi?module=transaksi&act=hapusorder&id=$data[kodedetail]><img src='images/hapus.png' border='0' title='Hapus' /></a>
			</td>
			</tr>";
  $no++;
}
echo "
<tr bgcolor='#d8d8d8'>
<td colspan='8' align='center'><b> Total</b></td>
<td><b>".number_format($total_harga,0,',','.')." </b></td><td></td>
</tr>
</table></center>

<form id='forms' method='post' class='form2' action='$aksi?module=transaksi&act=pembelian' enctype='multipart/form-data'>
<br>
<b>TANGGAL KEDATANGAN BARANG </b> <input type='text' name='tanggal' id='tanggal1' />
<input type='hidden' name='no_po' value='$_POST[no_po]' />
<br>
<input type='submit' name='submit' value='Simpan Menjadi Penambahan Barang' />
							</form>
<br>";




break;	
	
	
case "vieworder":


echo "<h1>Hasil Pencarian No. PO : <b>$_GET[id]</b></h1>
<center><table border='1' cellspacing='0' cellpadding='0' width='98%'>
	<tr>
	<th><center>No</th>
	<th>No PO</th>						
	<th>No Transaksi</th>						
	<th>Estimasi Tanggal Datang</th>
	<th>Nama Part</th>
	<th>No. Part</th>
	<th>Harga Satuan</th>
	<th>Jumlah Barang Datang</th>
	<th>Total Harga</th>
	<th>Edit/Delete</th>
	";


//Langkah 1: Tentukan batas,cek halaman & posisi data

//Langkah 2: Sesuaikan perintah SQL
$tampil = "SELECT *	FROM  masterpart
							INNER JOIN detail_transaksi
							ON detail_transaksi.kodeproduct=masterpart.kodeproduct
							INNER JOIN header_transaksi
							ON header_transaksi.no_transaksi=detail_transaksi.no_transaksi
							WHERE header_transaksi.status_transaksi='ORD' AND header_transaksi.status_order='ORDER' AND
							header_transaksi.no_po LIKE '%$_GET[id]%'
							 ORDER BY header_transaksi.no_transaksi DESC";
			
$hasil  = mysql_query($tampil);

$no=1;
$total_harga=0;
while ($data=mysql_fetch_array($hasil)){
	
	$total_harga=$total_harga+$data['price_total_transaksi'];
	$price=$data['price_total_transaksi']/$data['qty_transaksi'];
	
  echo "<tr><td>$no</td>
			<td>$data[no_po]</td>
			<td>$data[no_transaksi]</td>
			<td>".tgl_indo($data['tanggal_estimasi'])."</td>
			<td>$data[part_name]</td>
			<td>$data[part_number]</td>
			<td>".number_format($price,0,',','.')."</td>
			<td align='center'> ".number_format($data['qty_transaksi'],0,',','.')."</td>
			<td>".number_format($data['price_total_transaksi'],0,',','.')."</td>
			<td align='center'>
			<a href=?module=transaksi&act=editorderpart&id=$data[kodedetail]><img src='images/edit.png' border='0' title='edit' /></a>
			<a href=$aksi?module=transaksi&act=hapusorder&id=$data[kodedetail]><img src='images/hapus.png' border='0' title='edit' /></a>
			</td>
			</tr>";
  $no++;
}
echo "
<tr bgcolor='#d8d8d8'>
<td colspan='8' align='center'><b> Total</b></td>
<td><b>".number_format($total_harga,0,',','.')." </b></td><td></td>
</tr>
</table></center>

<form id='forms' method='post' class='form2' action='$aksi?module=transaksi&act=pembelian' enctype='multipart/form-data'>
<br>
<b>TANGGAL KEDADATANGAN BARANG </b> <input type='text' name='tanggal' id='tanggal1' />
<input type='hidden' name='no_po' value='$_GET[id]' />
<br>
<input type='submit' name='submit' value='Simpan Menjadi Penambahan Barang' />
							</form>
<br>";



break;	
	
	
	
	
case "editorderpart":	
	
	
$tampil = "SELECT *	FROM  masterpart
							INNER JOIN detail_transaksi
							ON detail_transaksi.kodeproduct=masterpart.kodeproduct
							INNER JOIN header_transaksi
							ON header_transaksi.no_transaksi=detail_transaksi.no_transaksi
							WHERE header_transaksi.status_transaksi='ORD' AND header_transaksi.status_order='ORDER' AND
							detail_transaksi.kodedetail LIKE '%$_GET[id]%'";

$hasil  = mysql_query($tampil);
$data=mysql_fetch_array($hasil)

?>

<body>	
		<h1>EDIT ORDER PART</h1>
		
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
				      echo"<form method='post' class='form4' action='$aksi?module=transaksi&act=updateorderpart'>
                            <input type='hidden' name='kodedetail'  value='$data[kodedetail]' size='30'>
                            <input type='hidden' name='no_po'  value='$data[no_po]' size='30'>
                            <input type='hidden' name='kodeproduct'  value='$data[kodeproduct]' size='30'>
							<table id='tablemodul'>
                          
							<tr>
							<td align=left class=cc>NO. PO</td><td><input type='text' disabled name='no_po1' readonly='' value='$data[no_po]' size='30'></td>
							</tr>
							<tr>
							<td align=left class=cc>Nama Part</td><td><input type='text' disabled name='part_name' readonly='' value='$data[part_name]' size='30'></td>
							</tr>
							<tr>
							<td align=left class=cc>Jumlah Barang Datang</td><td><input type='text' name='qty_transaksi'  value='$data[qty_transaksi]' size='10'></td>
							</tr>
							
							<tr>
							<td colspan='2'>
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   <input type=submit value='EDIT' class=tombol></td></tr>
                            </table></form>";
                ?>      
              </ul>
              </span>
           <br />  	
	
<?php
break;		

case "hasilsearchpembelianpart":

	
	
?>            <span>
              <ul>  
				<h1>FORM INPUT PENAMBAHAN PART</h1>
        	
<?php
$date=date('Y-m');
$file="?module=transaksi&act=addpembelian";
echo "
<br>
<form method='post' class='form' action='?module=transaksi&act=searchpembelian&halaman=1'>
<b>Cari PO No.</b>

<select name='no_po' width='30'>
							<option value='' selected>No PO</option>";
							
							$c="SELECT *	FROM  header_transaksi
							
							WHERE header_transaksi.status_transaksi='ORD' AND header_transaksi.status_order='ORDER'
							 ORDER BY header_transaksi.no_transaksi ASC";
							
							$c=mysql_query($c);
										while ($d = mysql_fetch_array($c))
											{
											echo "<option value='$d[no_po]'>$d[no_po]</option>";
                    						}
							
							echo "</select>

<input type='submit' value='    CARI    '>
</form>

<BR>
<h1>PENAMBAHAN PART PERIODE ".tgl_indo($_POST['tanggal1'])." S/D ".tgl_indo($_POST['tanggal2'])."</h1>

<form method='post' class='form' action='modul/transaksi/excellaporantransaksipenambahan.php'>
<input type='hidden' name='filter' value='BUY'>
<input type='hidden' name='tanggal1' value='$date-1'>
<input type='hidden' name='tanggal2' value='$date-31'>
<input type='submit' value='Laporan Penambahan Part Bulan ini'>
</form><br>


<form method='post' class='form' action='?module=transaksi&act=hasilsearchpembelianpart'>
<input type='hidden' name='filter' value='BUY' id='tanggal1' size=15>
                            <table id='tablemodul'>
											
							<tr>
							<td>Tanggal</td><td><input type=text name='tanggal1' value='' id='tanggal3' size=15> s/d <input type=text name='tanggal2' value='' id='tanggal2' size=15>
							   <input type=submit value='CARI' class=tombol></td>
							 </tr>
                            </table></form>

<center><table border='1' cellspacing='0' cellpadding='0' width='98%'>
	<tr>
	<th><center>No</th>
	<th>No PO</th>						
	<th>No Transaksi</th>						
	<th>Tanggal Barang Datang</th>
	<th>Nama Part</th>
	<th>No. Part</th>
	<th>Harga Satuan</th>
	<th>Jumlah Order</th>
	<th>Total Harga</th>
	";


//Langkah 2: Sesuaikan perintah SQL
$tampil = "SELECT *	FROM  masterpart
							INNER JOIN detail_transaksi
							ON detail_transaksi.kodeproduct=masterpart.kodeproduct
							INNER JOIN header_transaksi
							ON header_transaksi.no_transaksi=detail_transaksi.no_transaksi 	AND 
									header_transaksi.tanggal_transaksi BETWEEN '".$_POST['tanggal1']."' AND '".$_POST['tanggal2']."'
							
							WHERE header_transaksi.status_transaksi='BUY' 
							 ORDER BY header_transaksi.no_transaksi DESC";
			
$hasil  = mysql_query($tampil);

$no=1;
$total_harga=0;
while ($data=mysql_fetch_array($hasil)){
	
	$price=$data['price_total_transaksi']/$data['qty_transaksi'];
	$total_harga=$data['price_total_transaksi']+$total_harga;
	
  echo "<tr><td>$no</td>
			<td>$data[no_po]</td>
			<td>$data[no_transaksi]</td>
			<td>".tgl_indo($data['tanggal_transaksi'])."</td>
			<td>$data[part_name]</td>
			<td>$data[part_number]</td>
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

	
case "addpembelian":

	
	
?>            <span>
              <ul>  
				<h1>FORM INPUT PENAMBAHAN PART</h1>
        	
<?php
$date=date('Y-m');
$file="?module=transaksi&act=addpembelian";
echo "
<br>
<form method='post' class='form' action='?module=transaksi&act=searchpembelian&halaman=1'>
<b>Cari PO No.</b>

<select name='no_po' width='30'>
							<option value='' selected>No PO</option>";
							
							$c="SELECT *	FROM  header_transaksi
							
							WHERE header_transaksi.status_transaksi='ORD' AND header_transaksi.status_order='ORDER'
							 ORDER BY header_transaksi.no_transaksi ASC";
							
							$c=mysql_query($c);
										while ($d = mysql_fetch_array($c))
											{
											echo "<option value='$d[no_po]'>$d[no_po]</option>";
                    						}
							
							echo "</select>

<input type='submit' value='    CARI    '>
</form>


<h1>Riwayat Penambahan Part</h1>

<form method='post' class='form' action='modul/transaksi/excellaporantransaksibulanan.php'>
<input type='hidden' name='filter' value='BUY'>
<input type='hidden' name='tanggal1' value='$date-1'>
<input type='hidden' name='tanggal2' value='$date-31'>
<input type='submit' value='Laporan Penambahan Part Bulan ini'>
</form><br>


<form method='post' class='form' action='?module=transaksi&act=hasilsearchpembelianpart'>
<input type='hidden' name='filter' value='BUY' id='tanggal1' size=15>
                            <table id='tablemodul'>
											
							<tr>
							<td>Tanggal</td><td><input type=text name='tanggal1' value='' id='tanggal3' size=15> s/d <input type=text name='tanggal2' value='' id='tanggal2' size=15>
							   <input type=submit value='CARI' class=tombol></td>
							 </tr>
                            </table></form>
<center>
<table border='1' cellspacing='0' cellpadding='0' width='100%'>
	<tr>
	<th><center>No</th>
	<th>No PO</th>						
	<th>No Transaksi</th>						
	<th>Tanggal Barang Datang</th>
	<th>Nama Part</th>
	<th>No. Part</th>
	<th>Harga Satuan</th>
	<th>Jumlah Order</th>
	<th>Total Harga</th>
	";


//Langkah 1: Tentukan batas,cek halaman & posisi data
$batas=10;
$halaman=$_GET['halaman'];
if(empty($halaman)){
	$posisi=0;
	$halaman=1;
}
else{
	$posisi = ($halaman-1) * $batas;
}

//Langkah 2: Sesuaikan perintah SQL
$tampil = "SELECT *	FROM  masterpart
							INNER JOIN detail_transaksi
							ON detail_transaksi.kodeproduct=masterpart.kodeproduct
							INNER JOIN header_transaksi
							ON header_transaksi.no_transaksi=detail_transaksi.no_transaksi
							
							WHERE header_transaksi.status_transaksi='BUY' 
							 ORDER BY header_transaksi.no_transaksi DESC 
									LIMIT $posisi,$batas";
			
$hasil  = mysql_query($tampil);

$no=$posisi+1;
while ($data=mysql_fetch_array($hasil)){
	
	$price=$data['price_total_transaksi']/$data['qty_transaksi'];
	
  echo "<tr><td>$no</td>
			<td>$data[no_po]</td>
			<td>$data[no_transaksi]</td>
			<td>".tgl_indo($data['tanggal_transaksi'])."</td>
			<td>$data[part_name]</td>
			<td>$data[part_number]</td>
			<td>".number_format($price,0,',','.')."</td>
			<td align='center'> ".number_format($data['qty_transaksi'],0,',','.')."</td>
			<td>".number_format($data['price_total_transaksi'],0,',','.')."</td>
			</tr>";
  $no++;
}
echo "</table><br>";

//Langkah 3: Hitung total data dan halaman 
$tampil2= "SELECT *	FROM  masterpart
							INNER JOIN detail_transaksi
							ON detail_transaksi.kodeproduct=masterpart.kodeproduct
							INNER JOIN header_transaksi
							ON header_transaksi.no_transaksi=detail_transaksi.no_transaksi
							
							WHERE header_transaksi.status_transaksi='BUY'
							 ORDER BY header_transaksi.no_transaksi DESC ";
$hasil2=mysql_query($tampil2);
$jmldata=mysql_num_rows($hasil2);

$jmlhalaman=ceil($jmldata/$batas);

//link ke halaman sebelumnya (previous)
if($halaman > 1)
{
	$previous=$halaman-1;
	echo "<A HREF=$file&halaman=1><< First</A> | 
        <A HREF=$file&halaman=$previous>< Previous</A> | ";
}
else
{ 
	echo "<< First | < Previous | ";
}

$angka=($halaman > 3 ? " ... " : " ");
for($i=$halaman-2;$i<$halaman;$i++)
{
  if ($i < 1) 
      continue;
  $angka .= "<a href=$file&halaman=$i>$i</A> ";
}

$angka .= " <b>$halaman</b> ";
for($i=$halaman+1;$i<($halaman+3);$i++)
{
  if ($i > $jmlhalaman) 
      break;
  $angka .= "<a href=$file&halaman=$i>$i</A> ";
}

$angka .= ($halaman+2<$jmlhalaman ? " ...  
          <a href=$file&halaman=$jmlhalaman>$jmlhalaman</A> " : " ");

echo "$angka";

//link kehalaman berikutnya (Next)
if($halaman < $jmlhalaman)
{
	$next=$halaman+1;
	echo " | <A HREF=$file&halaman=$next>Next ></A> | 
  <A HREF=$file&halaman=$jmlhalaman>Last >></A> ";
}
else
{ 
	echo " | Next > | Last >>";
}
echo "<p>Total Record : <b>$jmldata</b> Record</p></center>";	
			
break;
	
case "hasilsearchpenggunaanpart":
	
?> 
<body>	
<script type="text/javascript" src="search/jquery.js"></script>
<script type="text/javascript">

	
	function addTableRow(jQtable){
		jQtable.each(function(){
			var $table = $(this);
			var n = parseInt(document.getElementById('nomor').value) + 1;
			var brg = document.getElementById('barang').value;
			var app = document.getElementById('app').value;
			var qty = document.getElementById('qtyproduct').value;
			var tanggal = document.getElementById('tanggal1').value;
			var no_transaksi = document.getElementById('no_transaksi').value;
			
			var brgs= brg.split('~');	
			var apps= app.split('~');	
			
			stock = parseInt(brgs[4]);
			qty = parseInt(qty);
			
			
			 if(brg == "")
              {
				alert('Anda Harus Memilih Part');
                $("#barang").focus();
              }
			  
			  else if(app == "")
              {
				alert('Anda harus memilih penggunaan mesin');
                $("#barang").focus();
              }
			  
			  else if(qty == "")
              {
				alert('Anda Harus Memasukan QTY Penggunaan');
                $("#barang").focus();
              }
			  
			else if(qty == "0")
              {
				alert('Qty Tidak Boleh diisi Kosong');
                $("#barang").focus();
              }
			  
			  else if(stock<qty)
              {
				alert('Stock untuk Part '+brgs[1]+'('+brgs[2]+') hanya Tersedia '+brgs[4]+' Pcs');
                $("#barang").focus();
              }
			  
			  
			  
			  else{
			var tds = '<tr>';
    				tds += '<td>'+tanggal+'<input type="hidden" name="tanggaltransaksi['+n+']" value="'+tanggal+'" /></td>';
					tds += '<td>'+brgs[1]+'<input type="hidden" name="kode_product['+n+']" value="'+brgs[0]+'" /></td>';
					tds += '<td>'+brgs[2]+'<input type="hidden" name="no_transaksi['+n+']" value="'+no_transaksi+'" /></td>';
					tds += '<td>'+apps[1]+'<input type="hidden" name="kode_application['+n+']" value="'+apps[0]+'" /></td>';
					tds += '<td>'+brgs[3]+'</td>';
					tds += '<td>'+brgs[4]+'</td>';
					tds += '<td>'+qty+'<input type="hidden" name="qty_transaksi['+n+']" value="'+qty+'" /></td>';
					tds += '<td>'+qty*brgs[3]+'<input type="hidden" name="price_total_transaksi['+n+']" value="'+qty*brgs[3]+'" /></td>';
					tds += '<td align=center class="delete" onClick="$(this).parent().remove(); minTotal('+tanggal+')"><a href="javascript:void(0)">Hapus</a></td>';
					
					
					
    				tds += '</tr>';
    				if($('tbody', this).length > 0){
    					$('tbody', this).append(tds);
    				}else {
    					$(this).append(tds);
    				}
    				document.getElementById('nomor').value =  n;
              }
		});
	}

	function deleteAllRows() {
		$('#myTable tbody').remove();
		document.getElementById('total').innerHTML = 0;
		document.getElementById('totalharga').innerHTML = 0;
	}
</script>


              <span>
              <ul>  
				<h1>FORM INPUT PENGGUNAAN PART</h1>
                <?php	

		
$tahun1  = date('Y');
$bulan1  = date('m');
$tanggalawal=$tahun1."-".$bulan1."-"."01 ";
$now  = date('Y-m-d');

	$query=mysql_query("SELECT * FROM header_transaksi WHERE tanggal_input BETWEEN '$tanggalawal' AND '$now'  
				AND status_transaksi='USE'");
	$row = mysql_num_rows($query);


$r=$row+1;
$length=strlen($r);	

if($length==1){$no_transaksi=$tahun1."".$bulan1."/USE/000".$r;}
else if($length==2){$no_transaksi=$tahun1."".$bulan1."/USE/00".$r;}
else if($length==3){$no_transaksi=$tahun1."".$bulan1."/USE/0".$r;}
else if($length==4){$no_transaksi=$tahun1."".$bulan1."/USE/".$r;}
		
				
					$now=date('Y-m-d'); 

				      echo"<form id='forms' method='post' class='form2' action='$aksi?module=transaksi&act=penggunaan' enctype='multipart/form-data'>
							<table id='tablemodul' width='900'>
                            <tr>
							<td bgcolor='727272' colspan='4'><b>Input Penggunaan Part</b></td>
							</tr>
							<tr>
							<td align='left' width='45%'>Nama Part - Nomor Part</td><td><select name='kodespg' id='barang'>
							<option value='' selected>Part Name // Part Number</option>";
							
							$c="SELECT * FROM masterpart WHERE part_stock NOT IN ('0')
									 ORDER BY part_name ASC";
							
							$c=mysql_query($c);
										while ($d = mysql_fetch_array($c))
											{
											echo "<option value='".$d[0]."~".$d[1]."~".$d[2]."~".$d[3]."~".$d[4]."~".$d[5]."'>".$d[1]." (".$d[2].")</option>";
                    						}
							
							echo "</select></td>
							</tr>
							<tr>
							<td align='left' width='45%'>Pemakaian Mesin</td><td><select name='application' id='app'>
							<option value='' selected>Applikasi Mesin</option>";
							
							$c="SELECT * FROM master_application
									 ORDER BY name_application ASC";
							
							$c=mysql_query($c);
										while ($d = mysql_fetch_array($c))
											{
											echo "<option value='".$d[0]."~".$d[1]."'>".$d[1]."</option>";
                    						}
							
							echo "</select></td>
							</tr>
							<tr>
							<td>Jumlah Penggunaaan</td><td><input type='text' name='qtyproduct' id='qtyproduct'/>
							<input type='hidden' name='no_transaksi1' value='$no_transaksi' id='no_transaksi'/>
							</td>
							</tr>
							
							
							
							<tr>
							<td>Tanggal Penggunaan</td><td><input type='text' name='tanggal' id='tanggal1'/>
							";
							?>
				
				<input type="button" name="tambah" value=" Tambahkan " class="button" id="tambah" onClick="addTableRow($('#myTable')); hitTotal()" />
				<input type='hidden' name='nomor' id='nomor' value='0' >
					</td></tr>
						<tr>
						<td colspan="2">
						<table width="100%" border="1" style="border-collapse:collapse" id="myTable">
						<thead>
						<tr align="center">
							<td>Tanggal Penggunaan Part</td>
							<td>Nama Part</td>
							<td>Nomor Part</td>
							<td>Penggunaan Mesin</td>
							<td>Harga Satuan</td>
							<td>Stok</td>
							<td>JumlahPenggunaan</td>
							<td>Total Harga</td>
							<td>Act</td>
							</tr>
						</thead>
						<tfoot>
				
						</tfoot>
					</table>
						</td>
						</tr>
							<?PHP
								
								echo "</td>
							</tr>
							 <tr>
							<td colspan='4' align='center' class='noborder'>
							<table border='0' class='noborder'><tr><td class='noborder'>
							<input type='image' name='submit' src='images/buttonsimpan.png' width='100px' height='25px' border='0' alt='Submit' />
							</form></td>
							<td class='noborder'>
							
							<form method='post' action='?module=transaksi&act=addpemakaian&halaman=1'>
							<input type='hidden' name='agreement'>
							<input type='image' name='submit' src='images/buttoncancel.png' width='100px' height='25px' border='0' alt='Submit' /></form>
							</td></tr></table>
							</td></tr>
						    </table>";
					
                ?> 
			 
         
<?php

$file="?module=transaksi&act=addpemakaian";

$date=date('Y-m');


echo "
<form method='post' class='form' action='modul/transaksi/excellaporantransaksibulanan.php'>
<input type='hidden' name='filter' value='USE'>
<input type='hidden' name='tanggal1' value='$date-1'>
<input type='hidden' name='tanggal2' value='$date-31'>
<input type='submit' value='Laporan Penggunaan Part Bulan ini'>
</form>


<form method='post' class='form' action='?module=transaksi&act=hasilsearchpenggunaanpart'>
<input type='hidden' name='filter' value='USE' id='tanggal1' size=15>
                            <table id='tablemodul'>
											
							<tr>
							<td>Tanggal</td><td><input type=text name='tanggal1' value='' id='tanggal3' size=15> s/d <input type=text name='tanggal2' value='' id='tanggal2' size=15>
							   <input type=submit value='CARI' class=tombol></td>
							 </tr>
                            </table></form>

<h1>LAPORAN PENGGUNAAN PART PERIODE ".tgl_indo($_POST['tanggal1'])." S/D ".tgl_indo($_POST['tanggal2'])."</h1>
<center>
<table border='1' cellspacing='0' cellpadding='0' width='98%'>
	<tr>
	<th><center>No</th>
	<th>No Transaksi</th>						
	<th>Tanggal Penggunaan</th>
	<th>Nama Part</th>
	<th>Nomor Part</th>
	<th>Penggunaan Mesin</th>
	<th>Harga Satuan</th>
	<th>Jumlah Penggunaan</th>
	<th>Total Harga</th>
	";


//Langkah 1: Tentukan batas,cek halaman & posisi data


//Langkah 2: Sesuaikan perintah SQL
$tampil = "SELECT *	FROM  masterpart
							INNER JOIN detail_transaksi
							ON detail_transaksi.kodeproduct=masterpart.kodeproduct
							INNER JOIN header_transaksi
							ON header_transaksi.no_transaksi=detail_transaksi.no_transaksi
							INNER JOIN master_application
							ON master_application.kode_application=detail_transaksi.kode_application
							WHERE header_transaksi.status_transaksi='USE' AND 
									header_transaksi.tanggal_transaksi BETWEEN '".$_POST['tanggal1']."' AND '".$_POST['tanggal2']."'
							 ORDER BY header_transaksi.tanggal_transaksi DESC ";
			
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
			<td>$data[name_application]</td>
			<td>".number_format($price,0,',','.')."</td>
			<td> ".number_format($data['qty_transaksi'],0,',','.')."</td>
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
	
	
	
	case "addpemakaian":
	
	
?> 
<body>	
<script type="text/javascript" src="search/jquery.js"></script>
<script type="text/javascript">

	
	function addTableRow(jQtable){
		jQtable.each(function(){
			var $table = $(this);
			var n = parseInt(document.getElementById('nomor').value) + 1;
			var brg = document.getElementById('barang').value;
			var app = document.getElementById('app').value;
			var qty = document.getElementById('qtyproduct').value;
			var tanggal = document.getElementById('tanggal1').value;
			var no_transaksi = document.getElementById('no_transaksi').value;
			
			var brgs= brg.split('~');	
			var apps= app.split('~');	
			
			stock = parseInt(brgs[4]);
			qty = parseInt(qty);
			
			
		
			 if(brg == "")
              {
				alert('Anda Harus Memilih Part');
                $("#barang").focus();
              }
			  
			  else if(app == "")
              {
				alert('Anda harus memilih penggunaan mesin');
                $("#barang").focus();
              }
			  
			  else if(qty == "")
              {
				alert('Anda Harus Memasukan QTY Penggunaan');
                $("#barang").focus();
              }
			  
			else if(qty == "0")
              {
				alert('Qty Tidak Boleh diisi Kosong');
                $("#barang").focus();
              }
			  
			  else if(stock<qty)
              {
				alert('Stock untuk Part '+brgs[1]+'('+brgs[2]+') hanya Tersedia '+brgs[4]+' Pcs');
                $("#barang").focus();
              }
			  
			  
			  
			  else{
				  
				  stockakhir=brgs[4]-qty;
			var tds = '<tr>';
    				tds += '<td>'+tanggal+'<input type="hidden" name="tanggaltransaksi['+n+']" value="'+tanggal+'" /></td>';
					tds += '<td>'+brgs[1]+'<input type="hidden" name="kode_product['+n+']" value="'+brgs[0]+'" /></td>';
					tds += '<td>'+brgs[2]+'<input type="hidden" name="no_transaksi['+n+']" value="'+no_transaksi+'" /></td>';
					tds += '<td>'+apps[1]+'<input type="hidden" name="kode_application['+n+']" value="'+apps[0]+'" /></td>';
					tds += '<td>'+brgs[3]+'</td>';
					tds += '<td>'+brgs[4]+'</td>';
					tds += '<td>'+qty+'<input type="hidden" name="qty_transaksi['+n+']" value="'+qty+'" /></td>';
					tds += '<td>'+stockakhir+'</td>';
					tds += '<td>'+qty*brgs[3]+'<input type="hidden" name="price_total_transaksi['+n+']" value="'+qty*brgs[3]+'" /></td>';
					
					tds += '<td align=center class="delete" onClick="$(this).parent().remove(); minTotal('+tanggal+')"><a href="javascript:void(0)">Hapus</a></td>';
					
					
					
    				tds += '</tr>';
    				if($('tbody', this).length > 0){
    					$('tbody', this).append(tds);
    				}else {
    					$(this).append(tds);
    				}
    				document.getElementById('nomor').value =  n;
              }
		});
	}

	function deleteAllRows() {
		$('#myTable tbody').remove();
		document.getElementById('total').innerHTML = 0;
		document.getElementById('totalharga').innerHTML = 0;
	}
</script>


              <span>
              <ul>  
				<h1>FORM INPUT PNGGUNAAN PART</h1>
                <?php	

		
$tahun1  = date('Y');
$bulan1  = date('m');
$tanggalawal=$tahun1."-".$bulan1."-"."01 ";
$now  = date('Y-m-d');

	$query=mysql_query("SELECT * FROM header_transaksi WHERE tanggal_input BETWEEN '$tanggalawal' AND '$now'  
				AND status_transaksi='USE'");
	$row = mysql_num_rows($query);


$r=$row+1;
$length=strlen($r);	

if($length==1){$no_transaksi=$tahun1."".$bulan1."/USE/000".$r;}
else if($length==2){$no_transaksi=$tahun1."".$bulan1."/USE/00".$r;}
else if($length==3){$no_transaksi=$tahun1."".$bulan1."/USE/0".$r;}
else if($length==4){$no_transaksi=$tahun1."".$bulan1."/USE/".$r;}
		
				
					$now=date('Y-m-d'); 

				      echo"<form id='forms' method='post' class='form2' action='$aksi?module=transaksi&act=penggunaan' enctype='multipart/form-data'>
							<table id='tablemodul' width='900'>
                            <tr>
							<td bgcolor='727272' colspan='4'><b>Input Penggunaan Part</b></td>
							</tr>
							<tr>
							<td align='left' width='45%'>Nama Part - Nomor Part</td><td><select name='kodespg' id='barang'>
							<option value='' selected>Part Name // Part Number</option>";
							
							$c="SELECT * FROM masterpart WHERE part_stock NOT IN ('0')
									 ORDER BY part_name ASC";
							
							$c=mysql_query($c);
										while ($d = mysql_fetch_array($c))
											{
											echo "<option value='".$d[0]."~".$d[1]."~".$d[2]."~".$d[3]."~".$d[4]."~".$d[5]."'>".$d[1]." (".$d[2].")</option>";
                    						}
							
							echo "</select></td>
							</tr>
							<tr>
							<td align='left' width='45%'>Pemakaian Mesin</td><td><select name='application' id='app'>
							<option value='' selected>Applikasi Mesin</option>";
							
							$c="SELECT * FROM master_application
									 ORDER BY name_application ASC";
							
							$c=mysql_query($c);
										while ($d = mysql_fetch_array($c))
											{
											echo "<option value='".$d[0]."~".$d[1]."'>".$d[1]."</option>";
                    						}
							
							echo "</select></td>
							</tr>
							<tr>
							<td>Jumlah Penggunaaan</td><td><input type='text' name='qtyproduct' id='qtyproduct'/>
							<input type='hidden' name='no_transaksi1' value='$no_transaksi' id='no_transaksi'/>
							</td>
							</tr>
							
							
							
							<tr>
							<td>Tanggal Penggunaan</td><td><input type='text' name='tanggal' id='tanggal1'/>
							";
							?>
				
				<input type="button" name="tambah" value=" Tambahkan " class="button" id="tambah" onClick="addTableRow($('#myTable')); hitTotal()" />
				<input type='hidden' name='nomor' id='nomor' value='0' >
					</td></tr>
						<tr>
						<td colspan="2">
						<table width="100%" border="1" style="border-collapse:collapse" id="myTable">
						<thead>
						<tr align="center">
							<td>Tanggal Penggunaan Part</td>
							<td>Nama Part</td>
							<td>Nomor Part</td>
							<td>Penggunaan Mesin</td>
							<td>Harga Satuan</td>
							<td>Stok</td>
							<td>JumlahPenggunaan</td>
							<td>Stok Setelah Dikurangi</td>
							<td>Total Harga</td>
							<td>Act</td>
							</tr>
						</thead>
						<tfoot>
				
						</tfoot>
					</table>
						</td>
						</tr>
							<?PHP
								
								echo "</td>
							</tr>
							 <tr>
							<td colspan='4' align='center' class='noborder'>
							<table border='0' class='noborder'><tr><td class='noborder'>
							<input type='image' name='submit' src='images/buttonsimpan.png' width='100px' height='25px' border='0' alt='Submit' />
							</form></td>
							<td class='noborder'>
							
							<form method='post' action='?module=transaksi&act=addpemakaian&halaman=1'>
							<input type='hidden' name='agreement'>
							<input type='image' name='submit' src='images/buttoncancel.png' width='100px' height='25px' border='0' alt='Submit' /></form>
							</td></tr></table>
							</td></tr>
						    </table>";
					
             

$file="?module=transaksi&act=addpemakaian";

$date=date('Y-m');


echo "
<form method='post' class='form' action='modul/transaksi/excellaporantransaksibulanan.php'>
<input type='hidden' name='filter' value='USE'>
<input type='hidden' name='tanggal1' value='$date-1'>
<input type='hidden' name='tanggal2' value='$date-31'>
<input type='submit' value='Laporan Penggunaan Part Bulan ini'>
</form>


<form method='post' class='form' action='?module=transaksi&act=hasilsearchpenggunaanpart'>
<input type='hidden' name='filter' value='USE' id='tanggal1' size=15>
                            <table id='tablemodul'>
											
							<tr>
							<td>Tanggal</td><td><input type=text name='tanggal1' value='' id='tanggal3' size=15> s/d <input type=text name='tanggal2' value='' id='tanggal2' size=15>
							   <input type=submit value='CARI' class=tombol></td>
							 </tr>
                            </table></form>


<table border='1' cellspacing='0' cellpadding='0' width='98%'>
	<tr>
	<th><center>No</th>
	<th>No Transaksi</th>						
	<th>Tanggal Penggunaan</th>
	<th>Nama Part</th>
	<th>Nomor Part</th>
	<th>Penggunaan Mesin</th>
	<th>Harga Satuan</th>
	<th>Jumlah Penggunaan</th>
	<th>Total Harga</th>
	";


//Langkah 1: Tentukan batas,cek halaman & posisi data
$batas=10;
$halaman=$_GET['halaman'];
if(empty($halaman)){
	$posisi=0;
	$halaman=1;
}
else{
	$posisi = ($halaman-1) * $batas;
}

//Langkah 2: Sesuaikan perintah SQL
$tampil = "SELECT *	FROM  masterpart
							INNER JOIN detail_transaksi
							ON detail_transaksi.kodeproduct=masterpart.kodeproduct
							INNER JOIN header_transaksi
							ON header_transaksi.no_transaksi=detail_transaksi.no_transaksi
							INNER JOIN master_application
							ON master_application.kode_application=detail_transaksi.kode_application
							WHERE header_transaksi.status_transaksi='USE' 
							 ORDER BY header_transaksi.tanggal_transaksi DESC 
									LIMIT $posisi,$batas";
			
$hasil  = mysql_query($tampil);

$no=$posisi+1;
while ($data=mysql_fetch_array($hasil)){
	
	$price=$data['price_total_transaksi']/$data['qty_transaksi'];
	
  echo "<tr><td>$no</td>
			<td>$data[no_transaksi]</td>
			<td>".tgl_indo($data['tanggal_transaksi'])."</td>
			<td>$data[part_name]</td>
			<td>$data[part_number]</td>
			<td>$data[name_application]</td>
			<td>".number_format($price,0,',','.')."</td>
			<td> ".number_format($data['qty_transaksi'],0,',','.')."</td>
			<td>".number_format($data['price_total_transaksi'],0,',','.')."</td>
			</tr>";
  $no++;
}
echo "</table><br>";

//Langkah 3: Hitung total data dan halaman 
$tampil2= "SELECT *	FROM  masterpart
							INNER JOIN detail_transaksi
							ON detail_transaksi.kodeproduct=masterpart.kodeproduct
							INNER JOIN header_transaksi
							ON header_transaksi.no_transaksi=detail_transaksi.no_transaksi
							
							WHERE header_transaksi.status_transaksi='USE'
							 ORDER BY header_transaksi.no_transaksi DESC ";
$hasil2=mysql_query($tampil2);
$jmldata=mysql_num_rows($hasil2);

$jmlhalaman=ceil($jmldata/$batas);

//link ke halaman sebelumnya (previous)
if($halaman > 1)
{
	$previous=$halaman-1;
	echo "<A HREF=$file&halaman=1><< First</A> | 
        <A HREF=$file&halaman=$previous>< Previous</A> | ";
}
else
{ 
	echo "<< First | < Previous | ";
}

$angka=($halaman > 3 ? " ... " : " ");
for($i=$halaman-2;$i<$halaman;$i++)
{
  if ($i < 1) 
      continue;
  $angka .= "<a href=$file&halaman=$i>$i</A> ";
}

$angka .= " <b>$halaman</b> ";
for($i=$halaman+1;$i<($halaman+3);$i++)
{
  if ($i > $jmlhalaman) 
      break;
  $angka .= "<a href=$file&halaman=$i>$i</A> ";
}

$angka .= ($halaman+2<$jmlhalaman ? " ...  
          <a href=$file&halaman=$jmlhalaman>$jmlhalaman</A> " : " ");

echo "$angka";

//link kehalaman berikutnya (Next)
if($halaman < $jmlhalaman)
{
	$next=$halaman+1;
	echo " | <A HREF=$file&halaman=$next>Next ></A> | 
  <A HREF=$file&halaman=$jmlhalaman>Last >></A> ";
}
else
{ 
	echo " | Next > | Last >>";
}
echo "<p>Total Record : <b>$jmldata</b> Record</p>";	
				
	break;
	
case "searchpo":

	
	
?> 
<body>	
<script type="text/javascript" src="search/jquery.js"></script>
<script type="text/javascript">

	
	function addTableRow(jQtable){
		jQtable.each(function(){
			var $table = $(this);
			var n = parseInt(document.getElementById('nomor').value) + 1;
			var brg = document.getElementById('barang').value;
			var qty = document.getElementById('qtyproduct').value;
			var tanggal = document.getElementById('tanggal1').value;
			var no_transaksi = document.getElementById('no_transaksi').value;
			
			
			
			var brgs= brg.split('~');	
			
			
			 if(brg == "")
              {
				alert('Anda Harus Memilih Part');
                $("#barang").focus();
              }
			  
			  else if(qty == "")
              {
				alert('Anda Harus Memasukan QTY Penggunaan');
                $("#barang").focus();
              }
			  
			  
			  else if(tanggal == "")
              {
				alert('Anda Belum mengisi Estimasi Tanggal Datang');
                $("#barang").focus();
              }
			  
			  else if(qty == "0")
              {
				alert('Qty Tidak Boleh 0');
                $("#barang").focus();
              }
			  
			  
			  
			  else{
			
    				
    				
					
    				var tds = '<tr>';
    				tds += '<td>'+tanggal+'<input type="hidden" name="tanggaltransaksi['+n+']" value="'+tanggal+'" /></td>';
					tds += '<td>'+brgs[1]+'<input type="hidden" name="kode_product['+n+']" value="'+brgs[0]+'" /></td>';
					tds += '<td>'+brgs[2]+'<input type="hidden" name="no_transaksi['+n+']" value="'+no_transaksi+'" /></td>';
					tds += '<td>'+brgs[3]+'</td>';
					tds += '<td>'+qty+'<input type="hidden" name="qty_transaksi['+n+']" value="'+qty+'" /></td>';
					tds += '<td>'+qty*brgs[3]+'<input type="hidden" name="price_total_transaksi['+n+']" value="'+qty*brgs[3]+'" /></td>';
					tds += '<td align=center class="delete" onClick="$(this).parent().remove(); minTotal('+tanggal+')"><a href="javascript:void(0)">Hapus</a></td>';
					
					
					
    				tds += '</tr>';
    				if($('tbody', this).length > 0){
    					$('tbody', this).append(tds);
    				}else {
    					$(this).append(tds);
    				}
    				document.getElementById('nomor').value =  n;
              }
		});
	}

	function deleteAllRows() {
		$('#myTable tbody').remove();
		document.getElementById('total').innerHTML = 0;
		document.getElementById('totalharga').innerHTML = 0;
	}
</script>


              <span>
              <ul>  
				<h1>FORM INPUT ORDER</h1>
                <?php	

		
$tahun1  = date('Y');
$bulan1  = date('m');
$tanggalawal=$tahun1."-".$bulan1."-"."01 ";
$now  = date('Y-m-d');

	$query=mysql_query("SELECT * FROM header_transaksi WHERE tanggal_input BETWEEN '$tanggalawal' AND '$now' AND  status_transaksi='ORD'");
	$row = mysql_num_rows($query);


$r=$row+1;
$length=strlen($r);	

if($length==1){$no_transaksi=$tahun1."".$bulan1."/ORD/000".$r;}
else if($length==2){$no_transaksi=$tahun1."".$bulan1."/ORD/00".$r;}
else if($length==3){$no_transaksi=$tahun1."".$bulan1."/ORD/0".$r;}
else if($length==4){$no_transaksi=$tahun1."".$bulan1."/ORD/".$r;}
		
				
					$now=date('Y-m-d');
					
				      echo"<form id='forms' method='post' class='form2' action='$aksi?module=transaksi&act=order' enctype='multipart/form-data'>
							<table id='tablemodul' width='900'>
                            <tr>
							<td bgcolor='727272' colspan='4'><b>Input ORDER</b></td>
							</tr>
							<tr>
							<td>PO No.</td><td><input type='text' name='no_po' id='nopo'/>
							</tr>
							<tr>
							<td align='left' width='30%'>Nama Part (No. Part)</td><td>
							<select class='branch' name='kodespg' id='barang'>
							<option value='' selected>Nama Part (No. Part)</option>";
							
							$r=mysql_query("SELECT * FROM masterpart ORDER BY part_name ASC");
							
						
										while ($t = mysql_fetch_array($r))
											{
											echo "<option value='".$t[0]."~".$t[1]."~".$t[2]."~".$t[3]."~".$t[4]."~".$t[5]."'>".$t[1]." (".$t[2].")</option>";
                    						}
							
							echo "</select></td>
							</tr>
							<tr>
							<td>Jumlah Pembelian</td><td><input type='text' name='qtyproduct' id='qtyproduct'/>
							<input type='hidden' name='tanggal_penggunaan' value='$now' id='tanggal'/>
							<input type='hidden' name='no_transaksi1' value='$no_transaksi' id='no_transaksi'/>
							
							";
							?>
				
					</td>
					</tr>
					<tr>
							<td>Estimasi Tanggal Datang</td><td><input type='text' name='tanggal_estimasi' id='tanggal1' size='30'/>
							
				<input type="button" name="tambah" value=" Tambahkan " class="button" id="tambah" onClick="addTableRow($('#myTable')); hitTotal()" />
				<input type='hidden' name='nomor' id='nomor' value='0' >
							</td>
							</tr>
						<tr>
						<td colspan="2">
						<table width="100%" border="1" style="border-collapse:collapse" id="myTable">
						<thead>
						<tr align="center" bgcolor="#b1b1b1">
							<td>Estimasi Tanggal Datang</td>
							<td>Nama Part</td>
							<td>No. Part</td>
							<td>Harga Satuan</td>
							<td>Jumlah Order</td>
							<td>Total Harga</td>
							<td>Act</td>
							</tr>
						</thead>
						<tfoot>
				
						</tfoot>
					</table>
						</td>
						</tr>
							<?PHP
									
								echo "</td>
							</tr>
							 <tr>
							<td colspan='4' align='center' class='noborder'>
							<table border='0' class='noborder'><tr><td class='noborder'>
							<input type='image' name='submit' src='images/buttonsimpan.png' width='100px' height='25px' border='0' alt='Submit' />
							</form></td>
							<td class='noborder'>
							
							<form method='post' action='?module=transaksi&act=addpemakaian&halaman=1'>
							<input type='hidden' name='agreement'>
							<input type='image' name='submit' src='images/buttoncancel.png' width='100px' height='25px' border='0' alt='Submit' />
							</form>
							</td></tr></table>
							</td></tr>
						    </table>";
					
                ?> 
			 
          
<?php
$date=date('Y-m');
$file="?module=transaksi&act=searchpo";



//Langkah 1: Tentukan batas,cek halaman & posisi data
$batas=10;
$halaman=$_GET['halaman'];
if(empty($halaman)){
	$posisi=0;
	$halaman=1;
}
else{
	$posisi = ($halaman-1) * $batas;
}


$no=$posisi+1;

//Langkah 2: Sesuaikan perintah SQL
$tampil = "SELECT *	FROM  masterpart
							INNER JOIN detail_transaksi
							ON detail_transaksi.kodeproduct=masterpart.kodeproduct
							INNER JOIN header_transaksi
							ON header_transaksi.no_transaksi=detail_transaksi.no_transaksi
							
							WHERE header_transaksi.status_transaksi='ORD' AND 
							header_transaksi.status_order IN ('ORDER','CLOSE') and header_transaksi.no_po LIKE '%$_POST[no_po]%'
							 ORDER BY header_transaksi.no_transaksi DESC 
									LIMIT $posisi,$batas";
			
$hasil  = mysql_query($tampil);

echo "<br>

<form method='post' class='form' action='?module=transaksi&act=searchpo&halaman=1'>
<b>Cari PO No.</b>
<input type='text' name='no_po'>
<input type='submit' value='    CARI    '>
</form>


<form method='post' class='form' action='modul/transaksi/excellaporantransaksipo.php'>
<input type='hidden' name='filter' value='$_POST[no_po]'>
<input type='submit' value='CONVERT EXCEL PO $_POST[no_po]'>
</form>


<h1>Hasil Pencarian No. PO : <b>$_POST[no_po] </b></h1>
<center><table border='1' cellspacing='0' cellpadding='0' width='98%'>
	<tr>
	<th><center>No</th>
	<th>No PO</th>						
	<th>No Transaksi</th>						
	<th>Estimasi Tanggal Datang</th>
	<th>Nama Part</th>
	<th>No. Part</th>
	<th>Harga Satuan</th>
	<th>Jumlah Order</th>
	<th>Total Harga</th>
	";

	$total_harga=0;
while ($data=mysql_fetch_array($hasil)){
	
	$price=$data['price_total_transaksi']/$data['qty_transaksi'];
	$total_harga=$data['price_total_transaksi']+$total_harga;
	
  echo "<tr><td>$no</td>
			<td>$data[no_po]</td>
			<td>$data[no_transaksi]</td>
			<td>".tgl_indo($data['tanggal_estimasi'])."</td>
			<td>$data[part_name]</td>
			<td>$data[part_number]</td>
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

//Langkah 3: Hitung total data dan halaman 
$tampil2= "SELECT *	FROM  masterpart
							INNER JOIN detail_transaksi
							ON detail_transaksi.kodeproduct=masterpart.kodeproduct
							INNER JOIN header_transaksi
							ON header_transaksi.no_transaksi=detail_transaksi.no_transaksi
							
							WHERE header_transaksi.status_transaksi='ORD' AND 
							header_transaksi.status_order IN ('ORDER','CLOSE') and header_transaksi.no_po LIKE '%$_POST[no_po]%'
							 ORDER BY header_transaksi.no_transaksi DESC ";
$hasil2=mysql_query($tampil2);
$jmldata=mysql_num_rows($hasil2);

$jmlhalaman=ceil($jmldata/$batas);

//link ke halaman sebelumnya (previous)
if($halaman > 1)
{
	$previous=$halaman-1;
	echo "<A HREF=$file&halaman=1><< First</A> | 
        <A HREF=$file&halaman=$previous>< Previous</A> | ";
}
else
{ 
	echo "<< First | < Previous | ";
}

$angka=($halaman > 3 ? " ... " : " ");
for($i=$halaman-2;$i<$halaman;$i++)
{
  if ($i < 1) 
      continue;
  $angka .= "<a href=$file&halaman=$i>$i</A> ";
}

$angka .= " <b>$halaman</b> ";
for($i=$halaman+1;$i<($halaman+3);$i++)
{
  if ($i > $jmlhalaman) 
      break;
  $angka .= "<a href=$file&halaman=$i>$i</A> ";
}

$angka .= ($halaman+2<$jmlhalaman ? " ...  
          <a href=$file&halaman=$jmlhalaman>$jmlhalaman</A> " : " ");

echo "$angka";

//link kehalaman berikutnya (Next)
if($halaman < $jmlhalaman)
{
	$next=$halaman+1;
	echo " | <A HREF=$file&halaman=$next>Next ></A> | 
  <A HREF=$file&halaman=$jmlhalaman>Last >></A> ";
}
else
{ 
	echo " | Next > | Last >>";
}
echo "<p>Total Record : <b>$jmldata</b> Record</p>";	

break;
	
	
case "addorder":
	
	
?> 
<body>	
<script type="text/javascript" src="search/jquery.js"></script>
<script type="text/javascript">

	
	function addTableRow(jQtable){
		jQtable.each(function(){
			var $table = $(this);
			var n = parseInt(document.getElementById('nomor').value) + 1;
			var brg = document.getElementById('barang').value;
			var qty = document.getElementById('qtyproduct').value;
			var tanggal = document.getElementById('tanggal1').value;
			var no_transaksi = document.getElementById('no_transaksi').value;
			
			
			
			var brgs= brg.split('~');	
			
			
			 if(brg == "")
              {
				alert('Anda Harus Memilih Part');
                $("#barang").focus();
              }
			  
			  else if(qty == "")
              {
				alert('Anda Harus Memasukan QTY Penggunaan');
                $("#barang").focus();
              }
			  
			  
			  else if(tanggal == "")
              {
				alert('Anda Belum mengisi Estimasi Tanggal Datang');
                $("#barang").focus();
              }
			  
			  else if(qty == "0")
              {
				alert('Qty Tidak Boleh 0');
                $("#barang").focus();
              }
			  
			  
			  
			  else{
			
    				
    				
					
    				var tds = '<tr>';
    				tds += '<td>'+tanggal+'<input type="hidden" name="tanggaltransaksi['+n+']" value="'+tanggal+'" /></td>';
					tds += '<td>'+brgs[1]+'<input type="hidden" name="kode_product['+n+']" value="'+brgs[0]+'" /></td>';
					tds += '<td>'+brgs[2]+'<input type="hidden" name="no_transaksi['+n+']" value="'+no_transaksi+'" /></td>';
					tds += '<td>'+brgs[3]+'</td>';
					tds += '<td>'+qty+'<input type="hidden" name="qty_transaksi['+n+']" value="'+qty+'" /></td>';
					tds += '<td>'+qty*brgs[3]+'<input type="hidden" name="price_total_transaksi['+n+']" value="'+qty*brgs[3]+'" /></td>';
					tds += '<td align=center class="delete" onClick="$(this).parent().remove(); minTotal('+tanggal+')"><a href="javascript:void(0)">Hapus</a></td>';
					
					
					
    				tds += '</tr>';
    				if($('tbody', this).length > 0){
    					$('tbody', this).append(tds);
    				}else {
    					$(this).append(tds);
    				}
    				document.getElementById('nomor').value =  n;
              }
		});
	}

	function deleteAllRows() {
		$('#myTable tbody').remove();
		document.getElementById('total').innerHTML = 0;
		document.getElementById('totalharga').innerHTML = 0;
	}
</script>


              <span>
              <ul>  
				<h1>FORM INPUT ORDER</h1>
                <?php	

		
$tahun1  = date('Y');
$bulan1  = date('m');
$tanggalawal=$tahun1."-".$bulan1."-"."01 ";
$now  = date('Y-m-d');

	$query=mysql_query("SELECT * FROM header_transaksi WHERE tanggal_input BETWEEN '$tanggalawal' AND '$now' AND  status_transaksi='ORD'");
	$row = mysql_num_rows($query);


$r=$row+1;
$length=strlen($r);	

if($length==1){$no_transaksi=$tahun1."".$bulan1."/ORD/000".$r;}
else if($length==2){$no_transaksi=$tahun1."".$bulan1."/ORD/00".$r;}
else if($length==3){$no_transaksi=$tahun1."".$bulan1."/ORD/0".$r;}
else if($length==4){$no_transaksi=$tahun1."".$bulan1."/ORD/".$r;}
		
				
					$now=date('Y-m-d');
					
				      echo"<form id='forms' method='post' class='form2' action='$aksi?module=transaksi&act=order' enctype='multipart/form-data'>
							<table id='tablemodul' width='900'>
                            <tr>
							<td bgcolor='727272' colspan='4'><b>Input ORDER</b></td>
							</tr>
							<tr>
							<td>PO No.</td><td><input type='text' name='no_po' id='nopo'/>
							</tr>
							<tr>
							<td align='left' width='30%'>Nama Part (No. Part)</td><td>
							<select class='branch' name='kodespg' id='barang'>
							<option value='' selected>Nama Part (No. Part)</option>";
							
							$r=mysql_query("SELECT * FROM masterpart ORDER BY part_name ASC");
							
						
										while ($t = mysql_fetch_array($r))
											{
											echo "<option value='".$t[0]."~".$t[1]."~".$t[2]."~".$t[3]."~".$t[4]."~".$t[5]."'>".$t[1]." (".$t[2].")</option>";
                    						}
							
							echo "</select></td>
							</tr>
							<tr>
							<td>Jumlah Pembelian</td><td><input type='text' name='qtyproduct' id='qtyproduct'/>
							<input type='hidden' name='tanggal_penggunaan' value='$now' id='tanggal'/>
							<input type='hidden' name='no_transaksi1' value='$no_transaksi' id='no_transaksi'/>
							
							";
							?>
				
					</td>
					</tr>
					<tr>
							<td>Estimasi Tanggal Datang</td><td><input type='text' name='tanggal_estimasi' id='tanggal1' size='30'/>
							
				<input type="button" name="tambah" value=" Tambahkan " class="button" id="tambah" onClick="addTableRow($('#myTable')); hitTotal()" />
				<input type='hidden' name='nomor' id='nomor' value='0' >
							</td>
							</tr>
						<tr>
						<td colspan="2">
						<table width="100%" border="1" style="border-collapse:collapse" id="myTable">
						<thead>
						<tr align="center" bgcolor="#b1b1b1">
							<td>Estimasi Tanggal Datang</td>
							<td>Nama Part</td>
							<td>No. Part</td>
							<td>Harga Satuan</td>
							<td>Jumlah Order</td>
							<td>Total Harga</td>
							<td>Act</td>
							</tr>
						</thead>
						<tfoot>
				
						</tfoot>
					</table>
						</td>
						</tr>
							<?PHP
									
								echo "</td>
							</tr>
							 <tr>
							<td colspan='4' align='center' class='noborder'>
							<table border='0' class='noborder'><tr><td class='noborder'>
							<input type='image' name='submit' src='images/buttonsimpan.png' width='100px' height='25px' border='0' alt='Submit' />
							</form></td>
							<td class='noborder'>
							
							<form method='post' action='?module=transaksi&act=addpemakaian&halaman=1'>
							<input type='hidden' name='agreement'>
							<input type='image' name='submit' src='images/buttoncancel.png' width='100px' height='25px' border='0' alt='Submit' />
							</form>
							</td></tr></table>
							</td></tr>
						    </table>";
					
                ?> 
			 
            
<?php
$date=date('Y-m');
$file="?module=transaksi&act=addorder";

//Langkah 1: Tentukan batas,cek halaman & posisi data
$batas=10;
$halaman=$_GET['halaman'];
if(empty($halaman)){
	$posisi=0;
	$halaman=1;
}
else{
	$posisi = ($halaman-1) * $batas;
}


$no=$posisi+1;


//Langkah 2: Sesuaikan perintah SQL
$tampil = "SELECT *	FROM  masterpart
							INNER JOIN detail_transaksi
							ON detail_transaksi.kodeproduct=masterpart.kodeproduct
							INNER JOIN header_transaksi
							ON header_transaksi.no_transaksi=detail_transaksi.no_transaksi
							
							WHERE header_transaksi.status_transaksi='ORD' AND header_transaksi.status_order='ORDER'
							 ORDER BY header_transaksi.tanggal_transaksi ASC 
									LIMIT $posisi,$batas";
			
$hasil  = mysql_query($tampil);
$row  = mysql_num_rows($hasil);


echo "<br>
<form method='post' class='form' action='?module=transaksi&act=searchpo&halaman=1'>
<b>Cari PO No.</b>
<input type='text' name='no_po'>
<input type='submit' value='    CARI    '>
</form><BR>";

if ($row==0){}
else{
	

echo "

<h1>PART ORDER DALAM PROGRESS</h1>

<form method='post' class='form' action='modul/transaksi/excellaporantransaksibulanan.php'>
<input type='hidden' name='filter' value='BUY'>
<input type='hidden' name='tanggal1' value='$date-1'>
<input type='hidden' name='tanggal2' value='$date-31'>
<input type='submit' value='Laporan Pembelian Bulan ini'>
</form>
<center><table border='1' cellspacing='0' cellpadding='0' width='98%'>
	<tr>
	<th><center>No</th>
	<th>No PO</th>						
	<th>No Transaksi</th>						
	<th>Estimasi Tanggal Datang</th>
	<th>Nama Part</th>
	<th>No. Part</th>
	<th>Harga Satuan</th>
	<th>Jumlah Order</th>
	<th>Total Harga</th>
	";


while ($data=mysql_fetch_array($hasil)){
	
	$price=$data['price_total_transaksi']/$data['qty_transaksi'];
	
  echo "<tr><td>$no</td>
			<td>$data[no_po]</td>
			<td>$data[no_transaksi]</td>
			<td>".tgl_indo($data['tanggal_estimasi'])."</td>
			<td>$data[part_name]</td>
			<td>$data[part_number]</td>
			<td>".number_format($price,0,',','.')."</td>
			<td align='center'> ".number_format($data['qty_transaksi'],0,',','.')."</td>
			<td>".number_format($data['price_total_transaksi'],0,',','.')."</td>
			</tr>";
  $no++;
}
echo "</table><br>";

//Langkah 3: Hitung total data dan halaman 
$tampil2= "SELECT *	FROM  masterpart
							INNER JOIN detail_transaksi
							ON detail_transaksi.kodeproduct=masterpart.kodeproduct
							INNER JOIN header_transaksi
							ON header_transaksi.no_transaksi=detail_transaksi.no_transaksi
							
							WHERE header_transaksi.status_transaksi='ORD' AND header_transaksi.status_order='ORDER'
							 ORDER BY header_transaksi.no_transaksi DESC ";
$hasil2=mysql_query($tampil2);
$jmldata=mysql_num_rows($hasil2);

$jmlhalaman=ceil($jmldata/$batas);

//link ke halaman sebelumnya (previous)
if($halaman > 1)
{
	$previous=$halaman-1;
	echo "<A HREF=$file&halaman=1><< First</A> | 
        <A HREF=$file&halaman=$previous>< Previous</A> | ";
}
else
{ 
	echo "<< First | < Previous | ";
}

$angka=($halaman > 3 ? " ... " : " ");
for($i=$halaman-2;$i<$halaman;$i++)
{
  if ($i < 1) 
      continue;
  $angka .= "<a href=$file&halaman=$i>$i</A> ";
}

$angka .= " <b>$halaman</b> ";
for($i=$halaman+1;$i<($halaman+3);$i++)
{
  if ($i > $jmlhalaman) 
      break;
  $angka .= "<a href=$file&halaman=$i>$i</A> ";
}

$angka .= ($halaman+2<$jmlhalaman ? " ...  
          <a href=$file&halaman=$jmlhalaman>$jmlhalaman</A> " : " ");

echo "$angka";

//link kehalaman berikutnya (Next)
if($halaman < $jmlhalaman)
{
	$next=$halaman+1;
	echo " | <A HREF=$file&halaman=$next>Next ></A> | 
  <A HREF=$file&halaman=$jmlhalaman>Last >></A> ";
}
else
{ 
	echo " | Next > | Last >>";
}
echo "<p>Total Record : <b>$jmldata</b> Record</p>";	
}	
	break;
	

	}
?>	