<?PHP
	include("../koneksi.php");
	include("../session.php");
	if($_SESSION['reg_level']!="admin") {
	header('location:../login.php');
	}
?>

<html>
<head>
</head>
<body>
<form action="action_siswa.php" method="POST">

<table width="500" align="center" cellpadding="4" cellspacing="4">
	<tr>
		<td>NIS</td>
		<td><input type="text" name="nis" size="25"></td>
		<td><font face="sans-serif" size="2" color=green>*Pastikan Anda Mengisi NIS dengan Benar</td>
	</tr>
	<tr>
		<td>Nama</td>
		<td><input type="text" name="n_siswa" size="25"></td>
	</tr>
	<tr>
	<td>JK</td>
		<td><select name="jk">
		<option value="">-------Pilih JK-----</option>";
		<option value="p">Pria</option>";
		<option value="w">Wanita</option>";
		</select>
		</td>
	</tr>
	<tr>
		<td>Username</td>
		<td><input type="text" name="username" size="25"></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="text" name="password" size="25"></td>
		<td><font face="sans-serif" size="2" color=green>*Password Tidak Boleh Melebihi 15 Karakter</td>
	</tr>
	<tr>
	<td>Kelas</td>
		<td><select name="kelas">
		<option value="">-------Pilih Kelas-----</option>";
		<?php
		$query = "SELECT * FROM kelas";
		$hasil = mysql_query($query);
		while ($data = mysql_fetch_array($hasil))
		{
		echo "<option value=".$data['kode_kelas'].">".$data['nama_kelas']."</option>";
		}

		?></select></td>
	</tr>
		<tr>
		<td>Email</td>
		<td><input type="text" name="email" size="25"></td>
		<td><font face="sans-serif" size="2" color=green>*Masukkan Password Yang Benar</td>
	</tr>
	<tr>
		<td width="90"></td>
		<td>
		<input type="submit" name="action" value="tambah">
		<input type="reset" name="reset" value="Batal"></td>
	</tr>

</table>
</form>
<a href="tampilan.php?page=4" style="text-decoration:none">Kembali</a>
</body>
</html>