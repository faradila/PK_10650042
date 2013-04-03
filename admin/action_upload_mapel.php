<?php
include("../koneksi.php");
include("../session.php");
$action = strtolower($_POST['action']);
$id = $_REQUEST['id_materi'];
if($_SESSION['reg_level']!="admin") {
header('location:../index.php');
date_default_timezone_set('Asia/Jakarta');
}
if ($action == "edit"){
		$id=$_POST["e_id"];
		$judul=ucwords($_POST["e_judul"]);
		$nip=$_POST["e_guru"];
		$mapel=$_POST["e_mapel"];
		
		$sql = "update upload set judul = '$judul',nip_guru = '$nip', kode_mapel = '$mapel', tanggal = sysdate()  where id_materi='$id'";
		$query_edit = mysql_query($sql) or die(mysql_error());
		if($query_edit){
			?> <script language="JavaScript">alert('Data terupdate');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=5\">";
		} else {
			?><script language="JavaScript">alert('Update gagal');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=5\">";
		}
}
else 
{
$sql_select="select * from upload where id_materi='$id'";
$query_select=mysql_query($sql_select);
$data_tampil=mysql_fetch_array($query_select);
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Elearning SMK Ma`arif NU 1 Kembaran</title>
<link href="style.css" rel="stylesheet" type="text/css" />
		
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
		   echo "if (document.update.e_guru.value == \"".$nip_guru."\")";
		   echo "{";

		   // membuat option mapel untuk masing-masing guru
		   $query2 = "SELECT * FROM mengajar WHERE nip_guru = '$nip_guru'";
		   $hasil2 = mysql_query($query2);
		   $content = "document.getElementById('mapel').innerHTML = \"";
		   while ($data2 = mysql_fetch_array($hasil2))
		   {
				$query = mysql_query("SELECT * FROM mapel WHERE kode_mapel = ".$data2['kode_mapel']."");
				$tampil = mysql_fetch_array($query);
				$nama_mapel = $tampil['nama_mapel'];
				$content .= "<option value='".$data2['kode_mapel']."'>$nama_mapel</option>";
		   }
		   $content .= "\"";
		   echo $content;
		   echo "}\n";
		   
		   echo "if (document.update.e_guru.value == \"".$nip_guru."\")";
		   echo "{";
		   // membuat option kelas untuk masing-masing guru
		   $query3 = "SELECT * FROM mengajar WHERE nip_guru = '$nip_guru'";
		   $hasil3 = mysql_query($query3);
		   $content = "document.getElementById('kelas').innerHTML = \"";
		   while ($data3 = mysql_fetch_array($hasil3))
		   {
				$content .= "<option value='".$data3['kode_kelas']."'>".$data3['kode_kelas']."</option>";
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
            <?php include ("menuadmin.php");?>
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
            <h2 align="center">Update Data Materi Pelajaran</h2>
			
				<form action="action_upload_mapel.php" method="POST" name="update">

				<table width="600" align="center" cellpadding="6" cellspacing="6">
					<input type="hidden" value="<?PHP echo $data_tampil['id_materi'] ?>" name="e_id">
					<tr>
							<td>Guru</td>
							<td>
							<select name="e_guru"  onchange="showMapel()">
							<?PHP
							$data_nama=mysql_fetch_array(mysql_query("select * from guru where nip_guru = ".$data_tampil['nip_guru'].""));
							?>
							<option value="<?PHP echo $data_tampil['nip_guru'] ?>"><?PHP echo $data_nama['nama_guru'] ?></option>";
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
						      <select name="e_mapel" id="mapel">
							  <?PHP
								$kode_mapel = $data_tampil['kode_mapel'];
								$data_nama_mapel=mysql_fetch_array(mysql_query("select * from mapel where kode_mapel = '$kode_mapel'"));
							  ?>
						      <option value="<?PHP echo $data_tampil['kode_mapel'] ?>"><?PHP echo $data_nama_mapel['nama_mapel'] ?></option>";
							  </select>
						      </td>
					</tr>
					<tr>
								<td>Judul</td>
								<td>
										<input name="e_judul" type="text" value="<?PHP echo $data_tampil['judul'] ?>" size='50'>
								</td>
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
<?PHP
}
?>