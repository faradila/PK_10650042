<?php
include("../koneksi.php");
include("../session.php");
$action = strtolower($_POST['action']);
$kode_kelas = $_REQUEST['kode_kelas'];
if($_SESSION['reg_level']!="admin") {
header('location:../index.php');
}

if ($action == "delete")
{
	$jumlah1 = mysql_num_rows(mysql_query("select * from mengajar where kode_kelas='$kode_kelas'"));
	$jumlah2 = mysql_num_rows(mysql_query("select * from nilai where kode_kelas='$kode_kelas'"));
	$jumlah3 = mysql_num_rows(mysql_query("select * from tugas where kode_kelas='$kode_kelas'"));
	$jumlah4 = mysql_num_rows(mysql_query("select * from siswa where kode_kelas='$kode_kelas'"));
	
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
		echo '<script language="JavaScript">alert("Kelas '.$kode_kelas.' Tidak Dapat Dihapus Karena Masih Berkaitan Dengan Data \n'.$tabel_exist.' \nMohon Periksa Kembali !");</script>';
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=1\">";
	}
	else{
	$delete = "delete from kelas where kode_kelas = '$kode_kelas'";
	$delete_query = mysql_query($delete);

				if ($delete_query){
							?> <script language="JavaScript">alert('Data Berhasil Di Hapus');</script><?PHP
							echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=1\">";
				}else {
							?><script language="JavaScript">alert('Data Gagal Dihapus');</script><?PHP
							echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=1\">";
						}
	}
}
elseif($action == "edit")
{
		$kode_kelas=strtoupper($_POST['e_kode_kelas']);
		$nama_kelas=ucwords($_POST['e_nama_kelas']);
		
		if(empty($kode_kelas) || empty($nama_kelas)){
		?><script language="JavaScript">alert('Update gagal');</script><?PHP
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=1\">";
		}
		else{
			$sql_edit = "update kelas set nama_kelas='$nama_kelas' where kode_kelas='$kode_kelas'";
		$query_edit = mysql_query($sql_edit);
		
		if ($query_edit){
			?> <script language="JavaScript">alert('Data terupdate');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=1\">";
		} else {
			?><script language="JavaScript">alert('Update gagal');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=1\">";
		}}
}
elseif($action== "tambah")
{
		$nama_kelas=ucwords($_POST["nama_kelas"]);
		$kode_kelas = str_replace(" ", '_', strtoupper(trim($_POST["kode_kelas"])));
		
		if(empty($kode_kelas) || empty($nama_kelas)){
		?><script language="JavaScript">alert('Anda Belum Memasukkan Data Dengan Lengkap');</script><?PHP
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=9\">";
		}
		else{
		$sql = "insert into kelas (kode_kelas,nama_kelas) values('$kode_kelas','$nama_kelas')";
		$query = mysql_query($sql);
		
		if ($query){
			?> <script language="JavaScript">alert('Data berhasil ditambahkan');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=1\">";
		} else {
			?><script language="JavaScript">alert('Penambahan Kelas Gagal, Kelas Sudah Ada');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=1\">";
			}
			}
}
else 
{
$sql_select="select * from kelas where kode_kelas='$kode_kelas'";
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
            <h2 align="center">Update Data Kelas</h2>
			
				<form action="action_kelas.php" method="POST">

				<table width="400" align="center" cellpadding="4" cellspacing="4">
					<tr>
						<td>Kode Kelas</td>
						<td><input type="hidden" value="<?PHP echo $data[0] ?>" name="e_kode_kelas"><?PHP echo $data[0] ?></td>
					</tr>
					
					<tr>
						<td>Nama Kelas</td>
						<td><input type="text" value="<?PHP echo $data[1] ?>" name="e_nama_kelas"></td>
					</tr>
					<tr>
						<td width="90"></td>
						<td><input type="submit" name="action" value="Edit">
						</td>
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