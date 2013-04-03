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
<form action="action_mengajar.php" method="POST" name="form1">
<table width="400" align="center" cellpadding="4" cellspacing="4">
	<tr>
		<td>Guru</td>
		<td>
		<select name="guru">
		<option value="">-------Pilih Guru-----</option>
		<?php
		$query = "SELECT * FROM guru";
		$hasil = mysql_query($query);
		while ($data = mysql_fetch_array($hasil))
		{
		echo "<option value=".$data['nip_guru'].">".$data['nama_guru']."</option>";
		}
		?></select></td>
	</tr>
	<tr>
		<td>Mapel</td>
		<td>
		<select name="mapel">
		<option value="">-------Pilih Mapel-----</option>";
		<?php
		$query = "SELECT * FROM mapel";
		$hasil = mysql_query($query);
		while ($data = mysql_fetch_array($hasil))
		{
		echo "<option value=".$data['kode_mapel'].">".$data['nama_mapel']."</option>";
		}
		?></select></td>
	</tr>	
	<tr>
		<td>Kelas</td>
		<td>
		<?php
		$query = "SELECT * FROM kelas";
		$hasil = mysql_query($query);
			$i = 1;
			while ($data = mysql_fetch_array($hasil))
			{
			  echo "<input type='checkbox' value='".$data['kode_kelas']."' name='k".$i."' /> ".$data['nama_kelas']."<br />";
			  $i++;
			}?>
			<input type="hidden" name="jumKel" value="<?php echo $i-1; ?>" />
		</td>
	</tr>	
	<tr>
		<td width="90"></td>
		<td><input type="submit" name="action" value="tambah">
		<input type="reset" name="reset" value="Batal"></td>						
	</tr>

</table>
</form>
<a href="tampilan.php?page=17" style="text-decoration:none">Kembali</a>
</body>
</html>