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
<form action="action_kelas.php" method="POST">

<table width="400" align="center" cellpadding="4" cellspacing="4">
	<tr>
		<td>Kode Kelas</td>
		<td><input type="text" name="kode_kelas"></td>
	</tr>
	<tr>
		<td>Nama Kelas</td>
		<td><input type="text" name="nama_kelas"></td>
	</tr>
	<tr>
		<td width="90"></td>
		<td><input type="submit" name="action" value="tambah">
		&nbsp;<a href="tampilan.php?page=1" style="text-decoration:none">
		<input type="reset" name="reset" value="Batal"></a></td>
	</tr>

</table>
</form>
<a href="tampilan.php?page=1" style="text-decoration:none">Kembali</a>
</body>
</html>