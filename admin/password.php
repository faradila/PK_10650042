<?PHP
	include("../koneksi.php");
	include("../session.php");
	if($_SESSION['reg_level']!="admin") {
	header('location:../index.php');
	}
?>

<html>
<head>
</head>
<body>
<form action="fungsi_ubah_password.php" method="POST">
<table width="500" align="center" cellpadding="3" cellspacing="0" border="0">
	<tr>
		<td width = 170px><font face="courier new" size="4"><b>Password Lama<font></td>
		<td><input type="password" name="pass0" size='25'></td>
		<td></td>
	</tr>
	<tr>
		<td><font face="courier new" size="4"><b>Password Baru<font></td>
		<td><input type="password" name="pass1" size='25'></td>
		<td><font face="sans-serif" size="2" color=green>*Password Tidak Boleh Melebihi 15 Karakter</td>
	</tr>
	<tr>
		<td><font face="courier new" size="4"><b>Ulangi Password<font></td>
		<td><input type="password" name="pass2" size='25'></td>
		<td><font face="sans-serif" size="2" color=green>*Password Tidak Boleh Melebihi 15 Karakter</td>
	</tr>
	<tr>
		<td width="100"></td>
		<td><input type="submit" name="tambah" value="Edit">
		<input type="reset" name="reset" value="Batal"></td>
	</tr>

</table>
</form>
</body>
</html>