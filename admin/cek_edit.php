<?PHP
	include("../koneksi.php");
	include("../session.php");
	if($_SESSION['reg_level']!="admin") {
	header('location:../login.php');
	}
		$kode_kelas=$_POST['e_kode_kelas'];
		$nama_kelas=ucwords($_POST['e_nama_kelas']);

		$sql_edit = "update kelas set nama_kelas='$nama_kelas' where kode_kelas='$kode_kelas'";
		$query_edit = mysql_query($sql_edit);
		
		if ($query_edit){
			?> <script language="JavaScript">alert('Data terupdate');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=data_kelas.php?page=kelas\">";
		} else {
			?><script language="JavaScript">alert('Update gagal');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=data_kelas.php?page=kelas\">";
		}
?>