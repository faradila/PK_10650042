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
<form action="action_guru.php" method="POST">


<table width="480" align="center" cellpadding="4" cellspacing="4">
	<tr>
		<td>NIP</td>
		<td><input type="text" name="nip"></td>
		<td><font size='2px' color=blue>*Pastikan NIP Diisi Dengan Benar</font></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td><input type="text" name="n_guru"></td>
		<td><font size='2px' color=darkgreen>*Nama Lengkap Beserta Gelar</font></td>
	</tr>
	<tr>
		<td>Jenis Kelamin</td>
		<td><select name="jk">
		<option value="">-------Pilih JK-----</option>;
		<option value="p">Pria</option>;
		<option value="w">Wanita</option>";
		</select></td>
	</tr>
	<?PHP
						$tampil = mysql_num_rows(mysql_query("select * from login where level = 'kepsek'"));
						if($tampil==0){
							echo "<tr>
								<td>Level</td>
								<td><select name='level'>
								<option value=''>-------Pilih Level-----</option>
								<option value='guru'>Guru</option>
								<option value='kepsek'>Kepala Sekolah</option>
								</select></td>
								</tr>";
						}
						
	?>
	<tr>
		<td>Username</td>
		<td><input type="text" name="username"></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="text" name="password"></td>
		<td><font size='2px' color=Darkgreen>*Password Lebih Baik Kombinasi Huruf dan Angka</font></td>
	</tr>
	<tr>
		<td width="90"></td>
		<td><input type="submit" name="action" value="tambah">
		<input type="reset" name="reset" value="Batal"></td>						
	</tr>

</table>
</form>
<a href="tampilan.php?page=3" style="text-decoration:none">Kembali</a>
</body>
</html>