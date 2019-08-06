<html>
<head>
<title>Login Application - Spare Part System</title>
<script language="javascript">
function validasi(form){
  if (form.	userid.value == ""){
    alert("Anda belum memilih  Username.");
    form.userid.focus();
    return (false);
  }
     
  if (form.password.value == ""){
    alert("Anda belum mengisikan Password.");
    form.password.focus();
    return (false);
  }
  return (true);
}
</script>
<br>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body OnLoad="document.login.username.focus();">
<div id="header">
  <div id="content">
	<h2>Login Spare Part System</h2>
   

<form name="login" action="cek_login.php" method="POST" onSubmit="return validasi(this)">
<center><br>
<table width='60%' height='20%'>
<tr><td>Username</td><td> <input type="text" name="username" size="28"></td></tr>
<tr><td>Password</td><td>  <input type="password" name="password" size="28"></td></tr>
<tr><td colspan="2" align="center">
<input type="image" name="submit" src="images/button_login.png" width="130px" height="30px" border="0" alt="Submit" />
</td></tr>
</table>
</center>
</form>
<p>&nbsp;</p>
  </div>
	<div id="footer">
			Copyright &copy; 2016. All rights reserved.
	</div>
</div>
</body>
</html>
