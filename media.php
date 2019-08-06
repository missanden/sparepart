<?php
session_start();

if (empty($_SESSION['s_user']) ){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{
	
	
?>

<html>
<head>
<title></title>
<script type="text/javascript" src="../nicEdit.js"></script>
<script type="text/javascript" src="config/jquery.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
</script>
<link href="style2.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header">
  <div id="content">
		<?php
		ECHO "
		<h3><br>
<a href='menu.php'><img src='images/buttonhome.png' width='100px' height='15px'></a> <br>

You are login : ".$_SESSION['s_user']." | <b><a href='logout.php'>Logout</a></b></h3>
";
		include "content.php"; ?>
  </div>
		<div id="footer">
			PT Sanden Indonesia | Copyright &copy; 2015
		</div>
</div>
</body>
</html>
<?php
}
?>
