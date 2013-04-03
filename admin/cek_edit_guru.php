<?PHP
	include("../koneksi.php");
	include("../session.php");
	if($_SESSION['reg_level']!="admin") {
	header('location:../login.php');
	}
		$nip=$_POST["e_nip_guru"];
		$nama_guru=ucwords($_POST["e_nama_guru"]);
		$password=($_POST["e_password"]);
		$kode_mapel=$_POST[e_mapel];
		$kode_kelas=$_POST[e_kelas];
		$sql = "update guru set nama_guru = '$nama_guru',password = '$password',kode_mapel = '$kode_mapel',kode_kelas = '$kode_kelas'  where nip_guru='$nip'";
		$query_edit = mysql_query($sql);
		if($query_edit)
		{
			$sql2 = "update login set password = '$password' where username='$nip'";
			$query_edit2 = mysql_query($sql2);
		}
		if ($query_edit2){
			?> <script language="JavaScript">alert('Data terupdate');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=data_guru.php?page=guru\">";
		} else {
			?><script language="JavaScript">alert('Update gagal');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=data_guru.php?page=guru\">";
		}
?>