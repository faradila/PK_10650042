<?PHP
include("../koneksi.php");
include("../session.php");
include("reg_username.php");
?>
<html>
<script language="JavaScript" type="text/JavaScript">

  	 function showKelas()
		 {
		 <?php

		 // membaca semua mata pelajaran berdasarkan nip guru
		 $query = "SELECT distinct kode_mapel FROM mengajar WHERE nip_guru = '$nip_guru'";
		 $hasil = mysql_query($query);

		 // membuat if untuk masing-masing pilihan mapel beserta isi option untuk combobox kedua
		 while ($data = mysql_fetch_array($hasil))
		 {
		   $kode_mapel = $data['kode_mapel'];

		   // membuat IF untuk masing-masing mapel
		   echo "if (document.upload.mapel.value == \"".$kode_mapel."\")";
		   echo "{";

		   // membuat option kelas untuk masing-masing guru
		   $query2 = "SELECT distinct kode_kelas FROM mengajar WHERE kode_mapel = '$kode_mapel' && nip_guru='$nip_guru'";
		   $hasil2 = mysql_query($query2);
		   $content = "document.getElementById('kelas').innerHTML = \"";
		   while ($data2 = mysql_fetch_array($hasil2))
		   {
				$content .= "<option value='".$data2['kode_kelas']."'>".$data2['kode_kelas']."</option>";
		   }
		   $content .= "\"";
		   echo $content;
		   echo "}\n";
		 }

		 ?>
		 }
</script>
<head>
</head>
<body>
<div id='table'>
<form name="upload" method="post" enctype="multipart/form-data">
<table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
<tr>
<tr>
		<td>Mapel</td>
		<td>
		<select name="mapel"  onchange="showKelas()">
		<option value="">-------Pilih MaPel-----</option>";
		<?php
		$query = "SELECT distinct kode_mapel FROM mengajar WHERE nip_guru = '$nip_guru'";
		$hasil = mysql_query($query);
		while ($data = mysql_fetch_array($hasil))
		{
		$kode_mapel = $data['kode_mapel'];
		$query = mysql_query("SELECT * FROM mapel WHERE kode_mapel = '$kode_mapel'");
		$tampil = mysql_fetch_array($query);
		$nama_mapel = $tampil['nama_mapel'];
		echo "<option value='$kode_mapel'>$nama_mapel</option>";
		}

		?></select></td>
</tr>

<tr><td>Kelas</td>
	      <td>
	      <select name="kelas" id="kelas">
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
<tr>
<td>Jenis Tugas</td>
		<td><select name="jenis">
		<option value="">-------Pilih Jenis Tugas-----</option>";
		<option value="Individu">Tugas Individu</option>
		<option value="Kelompok">Tugas Kelompok</option>
		<option value="PR">Pekerjaan Rumah</option>
		</select></td>
</tr>
<tr>
		<td>Pesan</td>
		<td><textarea name="ket"  rows="10" cols="30"></textarea></td>
	</tr>
<td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
</tr>
</table>
</form>
</div>
<a href="tampilan.php?page=5" style="text-decoration:none">Kembali</a>

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
date_default_timezone_set("Asia/Jakarta");
$judul = ucwords($_POST[judul]);
$jenis = $_POST[jenis];
$mapel = $_POST[mapel];
$kelas = $_POST[kelas];
$ket = ucfirst($_POST[ket]);
$query = "INSERT INTO tugas (judul,nama_file, type, size, content, jenis_tugas, kode_mapel, kode_kelas, nip_guru, ket, tanggal) VALUES 
('$judul','$fileName', '$fileType', '$fileSize', 
'$content','$jenis','$mapel', '$kelas',
'$nip_guru', '$ket', sysdate())";

$input = mysql_query($query) or die(mysql_error());

if ($input){
			?> <script language="JavaScript">alert('Data berhasil diupload');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=4\">";
		} else {
			?><script language="JavaScript">alert('Upload data gagal');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=4\">";
			}
}
?>
</body>
</html>
