<?PHP
  include("../koneksi.php");
	include("../session.php");
	include("reg_username.php");
?>
<html>
<head>
</head>
<body>
<form name="upload" method="post" enctype="multipart/form-data">
<table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
<tr><td>Mapel</td>
	      <td>
	      <select name="mapel">
		   <?PHP
		   $sql = mysql_query("SELECT distinct kode_mapel FROM mengajar WHERE nip_guru = '$nip_guru'");
		   while ($data = mysql_fetch_array($sql))
		   {
				$kode_mapel = $data['kode_mapel'];
				$query = mysql_query("SELECT * FROM mapel WHERE kode_mapel = '$kode_mapel'");
				$tampil = mysql_fetch_array($query);
				$nama_mapel = $tampil['nama_mapel'];
				echo "<option value='".$data['kode_mapel']."'>$nama_mapel</option>";
		   }?>
	      </select>
	      </td>
</tr>


<tr>
	<td>File</td>
	<td width="246">
	<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
	<input name="userfile" type="file" id="userfile">
	</td>
</tr>
<tr>
	<td>Judul</td>
	<td>
			<input name="judul" type="text" id="judul">
	</td>
</tr>
<td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
</tr>
</table>
</form>
<a href="tampilan.php?page=3" style="text-decoration:none">Kembali</a>

<?php
if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];

$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);

if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
}

include("../koneksi.php");
include("../session.php");
date_default_timezone_set("Asia/Jakarta");
$judul = ucwords($_POST[judul]);
$query = "INSERT INTO upload (nama_file, size, type, content, judul, kode_mapel,nip_guru, tanggal ) VALUES ('$fileName', '$fileSize', '$fileType', '$content','$judul','$_POST[mapel]','$nip_guru',sysdate())";

mysql_query($query) or die(mysql_error());

if ($query){
			?> <script language="JavaScript">alert('Data berhasil diupload');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=3\">";
		} else {
			?><script language="JavaScript">alert('Upload data gagal');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=3\">";
			}
}
?>
</body>
</html>
