<?PHP
	include("../koneksi.php");
	include("../session.php");
	if($_SESSION['reg_level']!="admin") {
	header('location:../login.php');
	}
	$kode_kelas=$_GET['kode_kelas'];
	$sql_select="select * from kelas where kode_kelas='$kode_kelas'";
	$query_select=mysql_query($sql_select);
	$data=mysql_fetch_array($query_select);
?>

<html>
<head>
</head>
<body>
<form action="cek_edit.php" method="POST">

<table width="400" align="center" cellpadding="4" cellspacing="4">
	<tr>
		<td>Kode Kelas</td>
		<td><input type="hidden" value="<?PHP echo $data[0] ?>" name="e_kode_kelas"><?PHP echo $data[0] ?></td>
	</tr>
	
	<tr>
		<td>Nama Kelas</td>
		<td><input type="text" value="<?PHP echo $data[1] ?>" name="e_nama_kelas"></td>
	</tr>
	<tr>
		<td width="90"></td>
		<td><input type="submit" name="ubah" value="Edit"></td>
	</tr>

</table>
</form>
</body>
</html>