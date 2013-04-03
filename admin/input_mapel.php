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
<form action="action_mapel.php" method="POST">

<table width="400" align="center" cellpadding="4" cellspacing="4">
	<tr>
		<td>Kode Mapel</td>
		<td><input type="text" name="k_mapel"></td>
	</tr>
	<tr>
		<td>Nama Mapel</td>
		<td><input type="text" name="n_mapel"></td>
	</tr>
	<tr>
		<td width="90"></td>
		<td><input type="submit" name="action" value="Tambah">
		<input type="reset" name="reset" value="Batal"></td>
	</tr>
</table>
</form>
<a href="tampilan.php?page=2" style="text-decoration:none">Kembali</a>
</body>
</html>