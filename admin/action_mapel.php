<?php
include("../koneksi.php");
include("../session.php");
$action = strtolower($_POST['action']);
$kode_mapel = $_REQUEST['kode_mapel'];
$nama_mapel = $_REQUEST['nama_mapel'];
if($_SESSION['reg_level']!="admin") {
header('location:../index.php');
}

if ($action == "delete")
{
	$jumlah1 = mysql_num_rows(mysql_query("select * from mengajar where kode_mapel='$kode_mapel'"));
	$jumlah2 = mysql_num_rows(mysql_query("select * from nilai where kode_mapel='$kode_mapel'"));
	$jumlah3 = mysql_num_rows(mysql_query("select * from tugas where kode_mapel='$kode_mapel'"));
	$jumlah4 = mysql_num_rows(mysql_query("select * from upload where kode_mapel='$kode_mapel'"));
	
	if($jumlah1>0)
	{
		$tabel_exist .= "Pengajar,";
	}
	if($jumlah2>0)
	{
		$tabel_exist .= " Nilai,";
	}
	if($jumlah3>0)
	{
		$tabel_exist .= " Tugas,";
	}
	if($jumlah4>0)
	{
		$tabel_exist .= " Siswa,";
	}
	if($jumlah1>0 || $jumlah2>0 || $jumlah3>0 || $jumlah4>0)
	{
		echo '<script language="JavaScript">alert("Mata Pelajaran '.$nama_mapel.' Tidak Dapat Dihapus Karena Masih Berkaitan Dengan Data \n'.$tabel_exist.' \nMohon Periksa Kembali !");</script>';
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=2\">";
	}
	else{
		$delete = "delete from mapel where kode_mapel = '$kode_mapel'";
		$delete_query = mysql_query($delete);
		if ($delete_query){
				?> <script language="JavaScript">alert('Data Berhasil Di Hapus');</script><?PHP
				echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=2\">";
		}else {
				?><script language="JavaScript">alert('Data Gagal Dihapus');</script><?PHP
				echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=2\">";
			}
		}
}
elseif($action == "tambah"){
		$nama_mapel=ucwords($_POST["n_mapel"]);
		$kode = str_replace(" ", '_', strtoupper(trim($_POST["k_mapel"])));

		if(empty($kode) || empty($nama_mapel)){
		?> <script language="JavaScript">alert('Maaf anda Belum Memasukkan Data dengan Lengkap');</script><?PHP
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=10\">";
		}
		else{
			$sql = "insert into mapel (kode_mapel,nama_mapel) values('$kode','$nama_mapel')";
			$query = mysql_query($sql) or die (mysql_error());
			if ($query){
			?> <script language="JavaScript">alert('Data berhasil ditambahkan');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=2\">";
			} else {
			?><script language="JavaScript">alert('Penambahan data gagal');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=2\">";
			}
		}
} 
elseif($action == "edit"){
		$kode_mapel=strtoupper($_POST['e_kode_mapel']);
		$nama_mapel=ucwords($_POST['e_nama_mapel']);
		
		if(empty($kode_mapel) || empty($nama_mapel)){
		?> <script language="JavaScript">alert('Maaf anda Belum Memasukkan Data dengan Lengkap');</script><?PHP
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=2\">";
		}
		else{
		$sql_edit = "update mapel set nama_mapel='$nama_mapel' where kode_mapel='$kode_mapel'";
		$query_edit = mysql_query($sql_edit);
		if ($query_edit){
			?> <script language="JavaScript">alert('Data terupdate');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=2\">";
		} else {
			?><script language="JavaScript">alert('Update gagal');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=2\">";
		}
		}
}
else
{
$sql_select="select * from mapel where kode_mapel='$kode_mapel'";
$query_select=mysql_query($sql_select);
$data=mysql_fetch_array($query_select);
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
            <h2 align="center">Update Data mapel</h2>
			
				<form action="action_mapel.php" method="POST">

				<table width="400" align="center" cellpadding="4" cellspacing="4">
					<tr>
						<td>Kode mapel</td>
						<td><input type="hidden" value="<?PHP echo $data[0] ?>" name="e_kode_mapel"><?PHP echo $data[0] ?></td>
					</tr>
					
					<tr>
						<td>Nama mapel</td>
						<td><input type="text" value="<?PHP echo $data[1] ?>" name="e_nama_mapel"></td>
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