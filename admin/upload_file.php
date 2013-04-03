<?PHP
	include("../koneksi.php");
	include("../session.php");
?>
<html>
<head>
<script language="JavaScript" type="text/JavaScript">

		 function showMapel()
		 {
		 <?php

		 // membaca semua guru
		 $query = "SELECT * FROM guru";
		 $hasil = mysql_query($query);

		 // membuat if untuk masing-masing pilihan guru beserta isi option untuk combobox kedua
		 while ($data = mysql_fetch_array($hasil))
		 {
		   $nip_guru = $data['nip_guru'];

		   // membuat IF untuk masing-masing guru
		   echo "if (document.upload.guru.value == \"".$nip_guru."\")";
		   echo "{";

		   // membuat option kelas untuk masing-masing guru
		   $query2 = "SELECT distinct kode_mapel FROM mengajar WHERE nip_guru = '$nip_guru'";
		   $hasil2 = mysql_query($query2);
		   $content = "document.getElementById('mapel').innerHTML = \"";
		   while ($data2 = mysql_fetch_array($hasil2))
		   {
				$kode_mapel = $data2['kode_mapel'];
				$query = mysql_query("SELECT * FROM mapel WHERE kode_mapel = '$kode_mapel'");
				$tampil = mysql_fetch_array($query);
				$nama_mapel = $tampil['nama_mapel'];
				$content .= "<option value='".$data2['kode_mapel']."'>$nama_mapel</option>";
		   }
		   $content .= "\"";
		   echo $content;
		   echo "}\n";
		 }

		 ?>
		 }
</script>

</head>
<body>
<form name="upload" method="post" enctype="multipart/form-data">
<table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
<tr>
		<td>Guru</td>
		<td>
		<select name="guru"  onchange="showMapel()">
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

<tr><td>Mapel</td>
	      <td>
	      <select name="mapel" id="mapel">
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
<a href="tampilan.php?page=5" style="text-decoration:none">Kembali</a>

<?php
if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
//membaca nama file
$fileName = $_FILES['userfile']['name'];
//membaca ukuran file
$tmpName  = $_FILES['userfile']['tmp_name'];
//membaca ukuran file
$fileSize = $_FILES['userfile']['size'];
//membaca jenis file
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
if($_SESSION['reg_level']!="admin") {
header('location:../login.php');
}
date_default_timezone_set("Asia/Jakarta");
$judul = ucwords($_POST[judul]);
$fileName = str_replace(" ", '_', ucwords(trim ($_FILES['userfile']['name'])));
$query = "INSERT INTO upload (nama_file, size, type, content, judul, kode_mapel,nip_guru, tanggal ) VALUES ('$fileName', '$fileSize', '$fileType', '$content','$judul','$_POST[mapel]','$_POST[guru]',sysdate())";

mysql_query($query) or die(mysql_error());

if ($query){
			?> <script language="JavaScript">alert('Data berhasil diupload');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=5\">";
		} else {
			?><script language="JavaScript">alert('Upload data gagal');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=5\">";
			}
}
?>
</body>
</html>