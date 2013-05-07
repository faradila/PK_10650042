<?php
include("../koneksi.php");
include("../session.php");
include("reg_username.php");
$action = strtolower($_POST['action']);
$id = $_REQUEST['id_materi'];
date_default_timezone_set('Asia/Jakarta');

if ($action == "edit"){
  	$judul=ucwords($_POST["e_judul"]);
		$mapel=$_POST["e_mapel"];
		
		$sql = "update upload set judul = '$judul', kode_mapel = '$mapel' where id_materi='$id'";
		$query_edit = mysql_query($sql) or die(mysql_error());
		if($query_edit){
			?> <script language="JavaScript">alert('Data terupdate');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=3\">";
		} else {
			?><script language="JavaScript">alert('Update gagal');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=3\">";
		}
}

else 
{
$judul = $_REQUEST['judul'];
$kode_mapel = $_REQUEST['kode_mapel'];
$data1=mysql_fetch_array(mysql_query("select * from mapel where kode_mapel = '$kode_mapel'"));
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Elearning SMK Ma`arif NU 1 Kembaran</title>
<link href="style.css" rel="stylesheet" type="text/css" />
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
            <h2 align="center">Update Data Materi Pelajaran</h2>
			
				<form action="action_upload_mapel.php" method="POST" name="update">

				<table width="600" align="center" cellpadding="6" cellspacing="6">
					<tr>
							  <td>Mapel</td>
						      <td>
						      <select name="e_mapel" id="mapel">
						      <option value="<?PHP echo $kode_mapel?>"><?PHP echo $data1['nama_mapel'] ?></option>";
							  <?php
								
								while ($data2 = mysql_fetch_array($cek_query))
								{
								$kode_mapel2 = $data2['kode_mapel'];
								if($kode_mapel != $kode_mapel2){
									$tampil = mysql_fetch_array(mysql_query("SELECT * FROM mapel where kode_mapel='$kode_mapel2'"));
									echo "<option value='$kode_mapel2'>".$tampil['nama_mapel']."</option>";
								}
								}
							?>
							  </select>
						      </td>
					</tr>
					<tr>
								<td>Judul</td>
								<td>
										<input name="e_judul" type="text" value="<?PHP echo $judul ?>" size='50'>
								</td>
					</tr>
					<tr>
								<td width="90"></td>
								<input type="hidden" name="id_materi" value="<?php echo $id ?>" />
								<td><input type="submit" name="action" value="Edit"></td>
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
