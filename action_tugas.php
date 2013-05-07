<?php
include("../koneksi.php");
include("../session.php");
include("reg_username.php");
$action = strtolower($_POST['action']);
$id = $_REQUEST['id_tugas'];
date_default_timezone_set('Asia/Jakarta');
if ($action == "edit"){
  	$id=$_POST["e_id"];
		$judul=ucwords($_POST["e_judul"]);
		$kelas=$_POST["kelas"];
		$mapel=$_POST["mapel"];
		$jenis=$_POST["e_jenis"];
		$ket=ucfirst($_POST["e_ket"]);
		
		$sql = "update tugas set judul = '$judul',nip_guru = '$nip_guru',kode_kelas = '$kelas', kode_mapel = '$mapel', 
				jenis_tugas = '$jenis', ket='$ket' where id_tugas='$id'";
		$query_edit = mysql_query($sql) or die(mysql_error());
		if($query_edit){
			?> <script language="JavaScript">alert('Data terupdate');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=4\">";
		} else {
			?><script language="JavaScript">alert('Update gagal');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=4\">";
		}
}
else 
{
$sql_select="select * from tugas where id_tugas='$id'";
$query_select=mysql_query($sql_select);
$data_tampil=mysql_fetch_array($query_select);
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Elearning SMK Ma`arif NU 1 Kembaran</title>
<link href="style.css" rel="stylesheet" type="text/css" />
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
		   echo "if (document.update.mapel.value == \"".$kode_mapel."\")";
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
</head>
<body>
<div id="container">
    <div id="header">
            <?php include ("menuguru.php");?>
	</div>
    <!-- end #header -->
    <!-- end #sidebar1 -->
    <!-- begin #mainContent -->
    <div id="mainContent">
        <div class="t">
        <div class="b">
        <div class="l">
        <div class="r">
        <div class="bl">
        <div class="br">
        <div class="tl">
        <div class="tr">
            <h2 align="center">Update Data Tugas</h2>
			
				<form action="action_tugas.php" method="POST" name="update">

				<table width="600" align="center" cellpadding="6" cellspacing="6">
					<input type="hidden" value="<?PHP echo $data_tampil['id_tugas'] ?>" name="e_id">
					<tr>
						<td>Mapel</td>
						<td>
						<select name="mapel"  onchange="showKelas()">
						<option value="<?PHP echo $data_tampil['kode_mapel'] ?>"><?PHP echo $data_tampil['kode_mapel'] ?></option>";
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
					      <option value="<?PHP echo $data_tampil['kode_kelas'] ?>"><?PHP echo $data_tampil['kode_kelas'] ?></option>";
						  </select>
					      </td>
					</tr>
									
					<tr>
								<td>Judul</td>
								<td>
										<input name="e_judul" type="text" value="<?PHP echo $data_tampil['judul'] ?>">
								</td>
					</tr>
					<tr>
								<td>Jenis Tugas</td>
								<td><select name="e_jenis">
								<option value="<?PHP echo $data_tampil['jenis_tugas'] ?>"><?PHP echo $data_tampil['jenis_tugas'] ?></option>";
								<option value="Individu">Tugas Individu</option>
								<option value="Kelompok">Tugas Kelompok</option>
								<option value="PR">Pekerjaan Rumah</option>
								</select></td>
					</tr>
					<tr>
								<td>Pesan</td>
								<td><textarea name="e_ket"  rows="10" cols="30" value="<?PHP echo $data_tampil['ket'] ?>"><?PHP echo $data_tampil['ket'] ?></textarea></td>
								</tr>
					<tr>
								<td width="90"></td>
								<td><input type="submit" name="action" value="edit"></td>
					</tr>

</table>
</form>
</body>
			
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <br />
    </div>
    <!-- end #mainContent -->
    <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
	<br class="clearfloat" />
    <!-- begin #footer -->
    <div id="footer">
    </div>
    <!-- end #footer -->
</div>
<!-- end #container -->
</body>
</html>
