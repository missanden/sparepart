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
			
<script type="text/javascript" src="inc/tiny_mce.js"></script>
			<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple",
		// update validation status on change
		onchange_callback: function(editor) {
			tinyMCE.triggerSave();
			$("#" + editor.id).valid();
		}
	});
	$(function() {
		var validator = $("#customForm").submit(function() {
			// update underlying textarea before submit validation
			tinyMCE.triggerSave();
		}).validate({
			ignore: "",
			rules: {
				title: "required",
				content: "required"
			},
			errorPlacement: function(label, element) {
				// position error label after generated textarea
				if (element.is("textarea")) {
					label.insertAfter(element.next());
				} else {
					label.insertAfter(element)
				}
			}
		});
		validator.focusInvalid = function() {
			// put focus on tinymce on submit validation
			if( this.settings.focusInvalid ) {
				try {
					var toFocus = $(this.findLastActive() || this.errorList.length && this.errorList[0].element || []);
					if (toFocus.is("textarea")) {
						tinyMCE.get(toFocus.attr("id")).focus();
					} else {
						toFocus.filter(":visible").focus();
					}
				} catch(e) {
					// ignore IE throwing errors when focusing hidden elements
				}
			}
		}
	})
</script>
<link rel="stylesheet" href="inc/css/style.css" type="text/css" />
		
<script type="text/javascript" src="inc/jquery.js"></script>
<script type="text/javascript" src="inc/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="inc/flora.datepicker.css" />
<script type="text/javascript" src="inc/customInput.jquery.js"></script>
</head>
<script type="text/javascript">
$(function(){
	$("#tanggal1").datepicker({dateFormat: 'yy-mm-dd' });
	$("#tanggal8").datepicker({dateFormat: 'yy-mm-dd' });
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
	


	$aksi="modul/master/aksi_master.php";
	switch($_GET['act']){

case "menumaster":

	echo "<center>
<table class='noborder' border='0' cellspacing='0' celpadding='0'>
		<tr>
		
		<td align='center' class='noborder'>
		<a href='media.php?module=master&act=addpart&halaman=1'><img src='images/masterpart.png' width='150px' height='150px'></img></a></li>
		<br>
		<b>Master Part</b></td>
		
		<td align='center' class='noborder'>
		<a href='media.php?module=master&act=adduser&halaman=1'><img src='images/masteruser.png' width='150px' height='150px'></img></a></li>
		<br>
		<b>Master User</b></td>
		
		
		<td align='center' class='noborder'>
		<a href='media.php?module=master&act=addsupplier&halaman=1'><img src='images/mastersupplier.png' width='150px' height='150px'></img></a></li>
		<br>
		<b>Master Supplier</b></td>
		
		</tr>

</table></center><br>";
		
	

break;	

case "editsupplier":


$tampil = "SELECT * FROM master_supplier
									WHERE master_supplier.kode_supplier LIKE '%$_GET[id]%'";

$hasil  = mysql_query($tampil);
$data=mysql_fetch_array($hasil)



?>
<body>	
		<h1>EDIT Supplier</h1>
		
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
				      echo"<form method='post' class='form4' action='$aksi?module=master&act=updatesupplier'>
                            <input type='hidden' name='kode_supplier'  placeholder='Nama Supplier' value='$data[kode_supplier]' size='30'>
							<table id='tablemodul'>
                          
							<tr>
							<td align=left class=cc>Nama Supplier</td><td><input type='text' name='name_supplier'  placeholder='Nama Supplier' value='$data[name_supplier]' size='30'></td>
							</tr>
							<tr>
							<td align=left class=cc>Telephone Supplier</td><td><input type='text' name='telpon_supplier'  placeholder='Telephone Supplier' value='$data[telpon_supplier]' size='30'></td>
							</tr>
							<tr>
							<td align=left class=cc>Alamat Supplier</td><td><textarea name='alamat_supplier' cols='50' rows='5'>$data[alamat_supplier]</textarea></td>
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


case "searchsupplier":

?>
<body>	
		<h1>TAMBAH SUPPLIER</h1>
		
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
				      echo"<form method='post' class='form4' action='$aksi?module=master&act=addsupplier'>
                            <table id='tablemodul'>
                          
							<tr>
							<td align=left class=cc>Nama Supplier</td><td><input type='text' name='name_supplier'  placeholder='Nama Supplier' size='30'></td>
							</tr>
							<tr>
							<td align=left class=cc>Telephone Supplier</td><td><input type='text' name='telpon_supplier'  placeholder='Telephone Supplier' size='30'></td>
							</tr>
							<tr>
							<td align=left class=cc>Alamat Supplier</td><td><textarea name='alamat_supplier' cols='50' rows='5'></textarea></td>
							</tr>
							
							<tr>
							<td colspan='2'>
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   <input type=submit value='Simpan' class=tombol></td></tr>
                            </table></form>";
                ?>      
              </ul>
              </span>
            <br />  
<?php

echo "

<h1> HASIL PENCARIAN : $_POST[value] </h1>
<form method='post' class='form' action='?module=master&act=searchsupplier&halaman=1'>
<b>Nama Supplier </b>
<input type='text' name='value'>
<input type='submit' value='         CARI         '>
</form>


<form method='post' class='form' action='modul/laporan/excellaporansupplier.php'>
<input type='image' name='submit' src='images/convertexcel.png' width='230px' height='45px' border='0' alt='Submit' />
</form>

<center><table border='1' cellspacing='0' cellpadding='0' width='95%'>
	<tr>
	<th width='5%'><center>No</th>
	<th width='20%'>Nama Supplier</th>
	<th width='10%'>No. Telephone</th>
	<th width='60%'>Alamat Supplier</th>
	<th width='5%'>EDIT</th>
	</tr>";


//Langkah 1: Tentukan batas,cek halaman & posisi data

//Langkah 2: Sesuaikan perintah SQL
$tampil = "SELECT * FROM  master_supplier WHERE master_supplier.name_supplier LIKE '%$_POST[value]%'
			order by master_supplier.name_supplier ASC";
$hasil  = mysql_query($tampil);

$no=1;
while ($data=mysql_fetch_array($hasil)){
	
  echo "<tr><td>$no</td>
			<td>$data[name_supplier]</td>
			<td>$data[telpon_supplier]</td>
			<td>$data[alamat_supplier]</td>
			<td align='center'>
			<a href=?module=master&act=editsupplier&id=$data[kode_supplier]><img src='images/edit.png' border='0' title='edit' /></a>
			</td>
			</tr>";
  $no++;
}
echo "</table></center><br><br>";

break;


case "addsupplier":


?> 
<body>	
		<h1>TAMBAH SUPPLIER</h1>
		
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
				      echo"<form method='post' class='form4' action='$aksi?module=master&act=addsupplier'>
                            <table id='tablemodul'>
                          
							<tr>
							<td align=left class=cc>Nama Supplier</td><td><input type='text' name='name_supplier'  placeholder='Nama Supplier' size='30'></td>
							</tr>
							<tr>
							<td align=left class=cc>Telephone Supplier</td><td><input type='text' name='telpon_supplier'  placeholder='Telephone Supplier' size='30'></td>
							</tr>
							<tr>
							<td align=left class=cc>Alamat Supplier</td><td><textarea name='alamat_supplier' cols='50' rows='5'></textarea></td>
							</tr>
							
							<tr>
							<td colspan='2'>
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   <input type=submit value='Simpan' class=tombol></td></tr>
                            </table></form>";
                ?>      
              </ul>
              </span>
           <br/>  
<?php
$file="?module=master&act=addsupplier";
echo "

<h1> DATA SUPPLIER </h1>
<form method='post' class='form' action='?module=master&act=searchsupplier&halaman=1'>
<b>Nama Supplier </b>
<input type='text' name='value'>
<input type='submit' value='         CARI         '>
</form>


<form method='post' class='form' action='modul/laporan/excellaporansupplier.php'>
<input type='image' name='submit' src='images/convertexcel.png' width='230px' height='45px' border='0' alt='Submit' />
</form>

<center><table border='1' cellspacing='0' cellpadding='0' width='95%'>
	<tr>
	<th width='5%'><center>No</th>
	<th width='20%'>Nama Supplier</th>
	<th width='10%'>No. Telephone</th>
	<th width='60%'>Alamat Supplier</th>
	<th width='5%'>EDIT</th>
	</tr>";


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
$tampil = "SELECT * FROM  master_supplier
			order by master_supplier.name_supplier ASC LIMIT $posisi,$batas";
$hasil  = mysql_query($tampil);

$no=$posisi+1;
while ($data=mysql_fetch_array($hasil)){
	
  echo "<tr><td>$no</td>
			<td>$data[name_supplier]</td>
			<td>$data[telpon_supplier]</td>
			<td>$data[alamat_supplier]</td>
			<td align='center'>
			<a href=?module=master&act=editsupplier&id=$data[kode_supplier]><img src='images/edit.png' border='0' title='edit' /></a>
			</td>
			</tr>";
  $no++;
}
echo "</table><br>";

//Langkah 3: Hitung total data dan halaman 
$tampil2= "SELECT * FROM  master_supplier
			order by master_supplier.name_supplier ASC";
$hasil2=mysql_query($tampil2);
$jmldata=mysql_num_rows($hasil2);

$jmlproduct=$jmldata/3;
$jmlhalaman=ceil($jmldata/$batas);

//link ke halaman sebelumnya (previous)
if($halaman > 1)
{
	$previous=$halaman-1;
	echo "
		<A HREF=$file&halaman=1><< First</A> | 
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
	echo " | Next > | Last >> ";
}
	
echo "</center><br><br>";		
	
break;

case "adduser":

echo"<h1> TAMBAH USER</h1>
<form method='post' class='form4' action='$aksi?module=master&act=adduser'>
                            <table id='tablemodul'>
                          
							<tr>
							<td align=left class=cc>Username</td><td><input type='text' name='username'  placeholder='Username' size='20'></td>
							</tr>
							<tr>
							<td align=left class=cc>Password</td><td><input type='password' name='password'  placeholder='Password' size='20'></td>
							</tr>
							<tr>
							<td align=left class=cc>Nama Lengkap</td><td><input type='text' name='namalengkapuser'  placeholder='Nama Lengkap' size='30'></td>
							</tr>
							
							<tr>
							<td colspan='2'>
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   <input type=submit value='Simpan' class=tombol></td></tr>
                            </table></form>";
                ?>      
              </ul>
              </span>
            <br />  
<?php

echo "

<left><table border='1' cellspacing='0' cellpadding='0' width='70%'>
	<tr>
	<th width='5%'><center>No</th>
	<th width='20%'>Nama Lengkap</th>
	<th width='20%'>Username</th>
	</tr>";


//Langkah 2: Sesuaikan perintah SQL

$tampil = "SELECT * FROM  user 
			order by namalengkapuser asc ";




$hasil  = mysql_query($tampil);

$no=1;
while ($data=mysql_fetch_array($hasil)){
	
	
	
	
  echo "<tr><td>$no</td>
			<td>$data[namalengkapuser]</td>
			<td>$data[username]</td>
			</tr>";
  $no++;
}
echo "</table></left><br>";


break;

case "searchpart":
	
	
?> 
<body>	
		<h1>TAMBAH PART</h1>
		
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
				      echo"<form method='post' class='form4' action='$aksi?module=master&act=addpart'>
                            <table id='tablemodul'>
                          
							<tr>
							<td align=left class=cc>Nama Part</td><td><input type='text' name='part_name'  placeholder='Nama Part' size='30'></td>
							</tr>
							<tr>
							<td align=left class=cc>Part Number</td><td><input type='text' name='part_number'  placeholder='Part Number' size='30'></td>
							</tr>
							<tr>
							<td align=left class=cc>Part Price</td><td><input type='text' name='part_price'  placeholder='Part Price' size='10'></td>
							</tr>
							
							<tr>
							<td align=left class=cc>Minimum Stock</td><td><input type='text' name='part_limit'  placeholder='limit Stock' size='8'></td>
							</tr>
							<tr>
							<td align=left class=cc>Location</td><td>
							<select name='part_location'>
		 								<option value=''>- Location -</option>";
		 								$tampil=mysql_query("SELECT * FROM master_location order by name_location ASC");
														while($w=mysql_fetch_array($tampil)){
																				echo "<option value='$w[kode_location]'>$w[name_location]</option>";
															}
											echo "</select>
							
							</td>
							</tr>
							<tr>
							<td align=left class=cc>Supplier</td><td>
							
							<select name='part_supplier'>
		 								<option value=''>- Supplier -</option>";
		 								$tampil=mysql_query("SELECT * FROM master_supplier ORDER BY name_supplier ASC");
														while($w=mysql_fetch_array($tampil)){
																				echo "<option value='$w[kode_supplier]'>$w[name_supplier]</option>";
															}
											echo "</select>
							
							
							</td>
							</tr>
							<tr>
							<td align=left class=cc>Pemakaian Untuk Mesin</td><td>
							<select name='part_application'>
		 								<option value=''>- Pemakaian Mesin -</option>";
		 								$tampil=mysql_query("SELECT * FROM master_application ORDER BY name_application ASC");
														while($w=mysql_fetch_array($tampil)){
															
															IF ($data['part_application']==$w['kode_application'])
															{
																				echo "<option value='$w[kode_application]' selected>$w[name_application]</option>";
															}
															else{
																echo "<option value='$w[kode_application]'>$w[name_application]</option>";
															}
															
															}
											echo "</select>
							</td>
							</tr>
							
							<tr>
							<td colspan='2'>
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   <input type=submit value='Simpan' class=tombol></td></tr>
                            </table></form>";
                ?>      
              </ul>
              </span>
            <br />  
<?php
$file="?module=master&act=addpart";
echo "

<h1> DATA PART </h1>
<form method='post' class='form' action='?module=master&act=searchpart&halaman=1'>
<b>PENCARIAN </b><select name='filter'>
<option value='masterpart.part_name'> Nama Part </option>
<option value='masterpart.part_number'> Nomor Part </option>
<option value='master_location.name_location'> Location </option>
<option value='master_supplier.name_supplier'> Supplier </option>
<option value='master_application.name_application'> Aplikasi Mesin</option>
</select>
<input type='text' name='value'>
<input type='submit' value='         CARI         '>
</form>


<form method='post' class='form' action='modul/laporan/excellaporanstock.php'>
<input type='hidden' name='filter' value='ALL'>
<input type='image' name='submit' src='images/convertexcel.png' width='230px' height='45px' border='0' alt='Submit' />
</form>

<center><table border='1' cellspacing='0' cellpadding='0' width='95%'>
	<tr>
	<th width='5%'><center>No</th>
	<th width='20%'>Nama Part</th>
	<th width='20%'>No. Part</th>
	<th width='15%'>Harga Satuan</th>
	<th width='7%'>Pemakasin Mesin</th>
	<th width='5%'>Lokasi</th>
	<th width='15%'>Supplier</th>
	<th width='5%'>Stok Part</th>
	<th width='5%'>Stok Minimum</th>
	<th width='5%'>Status</th>
	<th width='5%'>Edit</th>
	</tr>";


//Langkah 2: Sesuaikan perintah SQL

$tampil = "SELECT * FROM  masterpart INNER JOIN master_location
										ON master_location.kode_location=masterpart.part_location
									INNER JOIN master_supplier
										ON master_supplier.kode_supplier=masterpart.part_supplier
									INNER JOIN master_application
										ON master_application.kode_application=masterpart.part_application
									WHERE $_POST[filter] LIKE '%$_POST[value]%'
			order by masterpart.part_name asc ";




$hasil  = mysql_query($tampil);

$no=1;
while ($data=mysql_fetch_array($hasil)){
	
	if($data['part_stock']<$data['part_limit'])
	{$status="<font color='red'><b>ORDER</b></font>";}
	else {$status="<font color='green'><b>OKE</b></font>";}
	
	
  echo "<tr><td>$no</td>
			<td>$data[part_name]</td>
			<td>$data[part_number]</td>
			<td>Rp. ".number_format($data['part_price'],0,',','.')."</td>
			<td>$data[name_application]</td>
			<td>$data[name_location]</td>
			<td>$data[name_supplier]</td>
			<td>$data[part_stock]</td>
			<td>$data[part_limit]</td>
			<td>$status</td>
			
			<td align='center'>
			<a href=?module=master&act=editpart&id=$data[kodeproduct]><img src='images/edit.png' border='0' title='edit' /></a>
			</td>
			</tr>";
  $no++;
}
echo "</table></center><br>";

echo "<br><br>";	



break;



case "editpart":

$tampil = "SELECT * FROM  masterpart INNER JOIN master_location
										ON master_location.kode_location=masterpart.part_location
									INNER JOIN master_supplier
										ON master_supplier.kode_supplier=masterpart.part_supplier
									WHERE masterpart.kodeproduct LIKE '%$_GET[id]%'
			order by masterpart.part_name asc ";




$hasil  = mysql_query($tampil);

$no=1;
$data=mysql_fetch_array($hasil)



?>
<body>	
		<h1>EDIT PART</h1>
		
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
				      echo"<form method='post' class='form4' action='$aksi?module=master&act=updatepart'>
							<input type='hidden' name='kodeproduct'  size='30' value='$data[kodeproduct]'>
                            <table id='tablemodul'>
							<tr>
							<td align=left class=cc>Nama Part</td><td><input type='text' name='part_name'  placeholder='Nama Part' size='30' value='$data[part_name]'></td>
							</tr>
							<tr>
							<td align=left class=cc>Part Number</td><td><input type='text' name='part_number'  placeholder='Part Number' size='30' value='$data[part_number]'></td>
							</tr>
							<tr>
							<td align=left class=cc>Part Price</td><td><input type='text' name='part_price'  placeholder='Part Price' size='10' value='$data[part_price]'></td>
							</tr>
							
							<tr>
							<td align=left class=cc>Minimum Stock</td><td><input type='text' name='part_limit'  placeholder='limit Stock' size='8' value='$data[part_limit]'></td>
							</tr>
							<tr>
							<td align=left class=cc>CURRENT STOCK</td><td><input type='text' name='part_stock'  placeholder='limit Stock' size='8' value='$data[part_stock]'></td>
							</tr>
							<tr>
							<td align=left class=cc>Location</td><td>
							<select name='part_location'>
		 								<option value=''>- Location -</option>";
		 								$tampil=mysql_query("SELECT * FROM master_location order by name_location ASC");
														while($w=mysql_fetch_array($tampil)){
															IF ($data['kode_location']==$w['kode_location'])
															{
																				echo "<option value='$w[kode_location]' selected>$w[name_location]</option>";
															}
															else{
																echo "<option value='$w[kode_location]'>$w[name_location]</option>";
															}
															}
																											
											echo "</select>
							
							</td>
							</tr>
							<tr>
							<td align=left class=cc>Supplier</td><td>
							
							<select name='part_supplier'>
		 								<option value=''>- Supplier -</option>";
		 								$tampil=mysql_query("SELECT * FROM master_supplier ORDER BY name_supplier ASC");
														while($w=mysql_fetch_array($tampil)){
															
															IF ($data['kode_supplier']==$w['kode_supplier'])
															{
																				echo "<option value='$w[kode_supplier]' selected>$w[name_supplier]</option>";
															}
															else{
																echo "<option value='$w[kode_supplier]'>$w[name_supplier]</option>";
															}
															
															}
											echo "</select>
							
							
							</td>
							</tr>
							<tr>
							<td align=left class=cc>Pemakaian Untuk Mesin</td><td>
							<select name='part_application'>
		 								<option value=''>- Pemakaian Mesin -</option>";
		 								$tampil=mysql_query("SELECT * FROM master_application ORDER BY name_application ASC");
														while($w=mysql_fetch_array($tampil)){
															
															IF ($data['part_application']==$w['kode_application'])
															{
																				echo "<option value='$w[kode_application]' selected>$w[name_application]</option>";
															}
															else{
																echo "<option value='$w[kode_application]'>$w[name_application]</option>";
															}
															
															}
											echo "</select>
							</td>
							</tr>
							
							<tr>
							<td colspan='2'>
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   <input type=submit value='           EDIT           ' class=tombol></td></tr>
                            </table></form>  </ul>
              </span>
            <br />  ";
          
break;

case "addpart":
	
	
?> 
<body>	
		<h1>TAMBAH PART</h1>
		
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
				      echo"<form method='post' class='form4' action='$aksi?module=master&act=addpart'>
                            <table id='tablemodul'>
                          
							<tr>
							<td align=left class=cc>Nama Part</td><td><input type='text' name='part_name'  placeholder='Nama Part' size='30'></td>
							</tr>
							<tr>
							<td align=left class=cc>Part Number</td><td><input type='text' name='part_number'  placeholder='Part Number' size='30'></td>
							</tr>
							<tr>
							<td align=left class=cc>Part Price</td><td><input type='text' name='part_price'  placeholder='Part Price' size='10'></td>
							</tr>
							
							<tr>
							<td align=left class=cc>Minimum Stock</td><td><input type='text' name='part_limit'  placeholder='limit Stock' size='8'></td>
							</tr>
							<tr>
							<td align=left class=cc>Location</td><td>
							<select name='part_location'>
		 								<option value=''>- Location -</option>";
		 								$tampil=mysql_query("SELECT * FROM master_location order by name_location ASC");
														while($s=mysql_fetch_array($tampil)){
																				echo "<option value='$s[kode_location]'>$s[name_location]</option>";
															}
											echo "</select>
							
							</td>
							</tr>
							<tr>
							<td align=left class=cc>Supplier</td><td>
							
							<select name='part_supplier'>
		 								<option value=''>- Supplier -</option>";
		 								$tampil=mysql_query("SELECT * FROM master_supplier ORDER BY name_supplier ASC");
														while($g=mysql_fetch_array($tampil)){
																				echo "<option value='$g[kode_supplier]'>$g[name_supplier]</option>";
															}
											echo "</select>
							
							
							</td>
							</tr>
							<tr>
							<td align=left class=cc>Pemakaian Untuk Mesin</td><td>
							<select name='part_application'>
		 								<option value=''>- Pemakaian Mesin -</option>";
		 								$tampil=mysql_query("SELECT * FROM master_application ORDER BY name_application ASC");
														while($h=mysql_fetch_array($tampil)){
																				echo "<option value='$h[kode_application]'>$h[name_application]</option>";
															}
											echo "</select>
							
							</td>
							</tr>
							
							<tr>
							<td colspan='2'>
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   <input type=submit value='Simpan' class=tombol></td></tr>
                            </table></form>";
                ?>      
              </ul>
              </span>
            <br />  
<?php
$file="?module=master&act=addpart";
echo "

<h1> DATA PART </h1>
<form method='post' class='form' action='?module=master&act=searchpart&halaman=1'>
<b>PENCARIAN </b><select name='filter'>
<option value='masterpart.part_name'> Nama Part </option>
<option value='masterpart.part_number'> Nomor Part </option>
<option value='master_location.name_location'> Location </option>
<option value='master_supplier.name_supplier'> Supplier </option>
<option value='master_application.name_application'> Aplikasi Mesin</option>
</select>
<input type='text' name='value'>
<input type='submit' value='         CARI         '>
</form>


<form method='post' class='form' action='modul/laporan/excellaporanstock.php'>
<input type='hidden' name='filter' value='ALL'>
<input type='image' name='submit' src='images/convertexcel.png' width='230px' height='45px' border='0' alt='Submit' />
</form>

<center><table border='1' cellspacing='0' cellpadding='0' width='98%'>
	<tr>
	<th width='5%'><center>No</th>
	<th width='20%'>Nama Part</th>
	<th width='20%'>No. Part</th>
	<th width='15%'>Harga Satuan</th>
	<th width='7%'>Pemakaian Mesin</th>
	<th width='5%'>Lokasi</th>
	<th width='15%'>Supplier</th>
	<th width='5%'>Stok Part</th>
	<th width='5%'>Stok Minimum</th>
	<th width='5%'>Status</th>
	<th width='5%'>Edit</th>
	</tr>";


//Langkah 1: Tentukan batas,cek halaman & posisi data
$batas=500;
$halaman=$_GET['halaman'];
if(empty($halaman)){
	$posisi=0;
	$halaman=1;
}
else{
	$posisi = ($halaman-1) * $batas;
}

//Langkah 2: Sesuaikan perintah SQL
$tampil = mysql_query("SELECT * FROM  masterpart INNER JOIN master_location
										ON master_location.kode_location=masterpart.part_location
									INNER JOIN master_supplier
										ON master_supplier.kode_supplier=masterpart.part_supplier
									INNER JOIN master_application
										ON master_application.kode_application=masterpart.part_application
			order by masterpart.part_name asc LIMIT $posisi,$batas");


$no=$posisi+1;
while ($data = mysql_fetch_array($tampil)){
	
	if($data['part_stock']<$data['part_limit'])
	{$status="<font color='red'><b>ORDER</b></font>";}
	else {$status="<font color='green'><b>OKE</b></font>";}
	
	
  echo "<tr><td>$no</td>
			<td>$data[part_name]</td>
			<td>$data[part_number]</td>
			<td>$data[part_price]</td>
			
			<td>$data[name_application]</td>
			<td>$data[name_location]</td>
			<td>$data[name_supplier]</td>
			<td>$data[part_stock]</td>
			<td>$data[part_limit]</td>
			<td>$status</td>
			
			<td align='center'>
			<a href=?module=master&act=editpart&id=$data[kodeproduct]><img src='images/edit.png' border='0' title='edit' /></a>
			</td>
			</tr>";
  $no++;
}
echo "</table></center><br>";

//Langkah 3: Hitung total data dan halaman 
$tampil2= "SELECT * FROM masterpart ";
$hasil2=mysql_query($tampil2);
$jmldata=mysql_num_rows($hasil2);

$jmlproduct=$jmldata/3;
$jmlhalaman=ceil($jmldata/$batas);

//link ke halaman sebelumnya (previous)
if($halaman > 1)
{
	$previous=$halaman-1;
	echo "
		<A HREF=$file&halaman=1><< First</A> | 
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
	echo " | Next > | Last >> ";
}
	
echo "<br><br>";		
	
	break;	


	}
?>	