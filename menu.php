<?PHP
session_start();
?>
<html>
<head>
<title></title>
<script type="text/javascript" src="../nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
</script>
<link href="style1.css" rel="stylesheet" type="text/css" />
</head>
<body>
<br><br>
<div id="header">
  <div id="content">
 
<?php  
echo "<h3><br>
<a href='menu.php'><img src='images/buttonhome.png' width='100px' height='15px'></a> <br>

You are login : ".$_SESSION['s_user']." | <b><a href='logout.php'>Logout</a></b></h3>
<br><center>
<table class='noborder' border='0' cellspacing='0' celpadding='0'>
		<tr>
		
		<td align='center' class='noborder'>
		<a href='media.php?module=master&act=menumaster'><img src='images/master.png' width='150px' height='150px'></img></a></li>
		<br>
		<b>Master</b></td>
		
		<td align='center' class='noborder'>
		<a href='media.php?module=transaksi&act=menutransaksi'><img src='images/transaksi.png' width='150px' height='150px'></img></a></li>
		<br>
		<b>Transaksi</b></td>
		
		
		<td align='center'  class='noborder'>
		<a href='media.php?module=laporan&act=menulaporan'><img src='images/laporan.png' width='150px' height='150px'></img></a></li>
		<br>
		<b>Laporan</b></td>
		</tr>

</table></center><br>";
		
	
		
?>

  </div>
		<div id="footer">
			Copyright &copy; 2015. All rights reserved.
		</div>
</div>
</body>
</html>