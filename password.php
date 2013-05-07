<?PHP
  include("../koneksi.php");
	include("../session.php");
?>

<html>
<head>
</head>
<body>
<form action="fungsi_ubah_password.php" method="POST">

<table width="410px" align="center" cellpadding="3" cellspacing="0" border="0">
	<tr>
		<td width = 90px>Password Lama</td>
		<td width = 100px><input type="password" name="pass0" size="30"></td>
	</tr>
	<tr>
		<td>Password Baru<font></td>
		<td><input type="password" name="pass1" size="30"></td>
	</tr>
	<tr>
		<td>Retype Password<font></td>
		<td><input type="password" name="pass2" size="30"></td>
	</tr>
	<tr>
		<td width="90"></td>
		<td><input type="submit" name="tambah" value="Edit">
		<input type="reset" name="reset" value="Batal"></td>
	</tr>

</table>
</form>
</body>
</html>
