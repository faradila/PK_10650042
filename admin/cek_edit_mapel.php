<?PHP
	include("../koneksi.php");
	include("../session.php");
	if($_SESSION['reg_level']!="admin") {
	header('location:../login.php');
	}
		$kode_mapel=$_POST['e_kode_mapel'];
		$nama_mapel=ucwords($_POST['e_nama_mapel']);

		$sql_edit = "update mapel set nama_mapel='$nama_mapel' where kode_mapel='$kode_mapel'";
		$query_edit = mysql_query($sql_edit);
		
		if ($query_edit){
			?> <script language="JavaScript">alert('Data terupdate');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=data_mapel.php?page=mapel\">";
		} else {
			?><script language="JavaScript">alert('Update gagal');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=data_mapel.php?page=mapel\">";
		}
?>