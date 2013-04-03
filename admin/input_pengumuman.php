<?PHP
	include("../koneksi.php");
	include("../session.php");
?>

<html>
<head>
<script type="text/javascript">

var maxChar = 250;

function count()
{
	if (document.formku.pesan.value.length> maxChar)
	{
		document.formku.pesan.value = 
		document.formku.pesan.value.substring(0, maxChar);
	}
	else document.formku.counter.value = maxChar - document.formku.pesan.value.length;
}

function initial()
{
	document.formku.counter.value = maxChar;
}
</script>
</head>
<body onload="initial()">
<form name="formku" action="action_pengumuman.php" method="POST">

<table width="600" align="center" cellpadding="4" cellspacing="4">
	<tr>
		<td>Judul</td>
		<td><input type="text" name="judul" size='45'></td>
	</tr>
	<tr>
	<td  width='100'>Nama Guru</td>
		<td><select name="nip">
		<option value="">-------Pilih Guru-----</option>";
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
		<td>Kepada</td>
		<td><input type="text" name="objek" size='45'></td>
	</tr>
	<tr>
		<td>Pesan</td>
		<td><textarea name="pesan"  rows="10" cols="40" onKeyUp="count()"></textarea></td>
	</tr>
	<tr><td></td>
		<td>
		<input type="text" readonly  name="counter" size="3">
		</td>
	</tr>
	<tr>
		<td width="90"></td>
		<td><input type="submit" name="action" value="Tambah">
		<input type="reset" name="reset" value="Batal"></td>
	</tr>

</table>
</form>
</body>
</html>