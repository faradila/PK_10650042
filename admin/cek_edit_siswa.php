<?PHP
	include("../koneksi.php");
	include("../session.php");
	if($_SESSION['reg_level']!="admin") {
	header('location:../login.php');
	}
		$nis=$_POST["e_nis"];
		$nama_siswa=ucwords($_POST["e_nama_siswa"]);
		$password=$_POST["e_password"];
		$kode_kelas=$_POST[e_kelas];
		$sql = "update siswa set nama = '$nama_siswa',password = '$password',kode_kelas = '$kode_kelas'  where nis='$nis'";
		$sql2 = "update login set password = '$password' where username='$nis'";
		$query_edit = mysql_query($sql);
		$query_edit2 = mysql_query($sql2);
		
		if ($query_edit && $query_edit2){
			?> <script language="JavaScript">alert('Data terupdate');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=data_siswa.php?page=siswa\">";
		} else {
			?><script language="JavaScript">alert('Update gagal');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=data_siswa.php?page=siswa\">";
		}
?>