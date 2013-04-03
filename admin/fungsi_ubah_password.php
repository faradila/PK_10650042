<?PHP
	include("../koneksi.php");
	include("../session.php");
	if($_SESSION['reg_level']!="admin") {
	header('location:../index.php');
	}
	$username = $_SESSION['reg_username'];
	$pass_lama = md5($_POST['pass0']);
	$data = (mysql_num_rows(mysql_query("SELECT * FROM login where password = '$pass_lama'")));	

if($_POST['pass0'] == "" || $_POST['pass1']=="" || $_POST['pass2']==""){
?> <script language="JavaScript">alert('Maaf anda belum mengisi seluruh form password');</script><?PHP
echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=7\">";
}
elseif($data == 0){
?> <script language="JavaScript">alert('Maaf Password Lama Tidak Sesuai ');</script><?PHP
echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=7\">";
}

elseif($_POST['pass1'] != $_POST['pass2']){
?> <script language="JavaScript">alert('Maaf Password baru dan Ulang Password Tidak Sesuai ');</script><?PHP
echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=7\">";
}
elseif(strlen($_POST['pass1']) > 15){
?> <script language="JavaScript">alert('Maaf Password Anda Terlalu Panjang ');</script><?PHP
echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=7\">";
}
else{	
		$pass1 = md5($_POST['pass1']);
		$sql_edit = "update login set password='$pass1' where username='$username'";
		$query_edit = mysql_query($sql_edit);
		
		if ($query_edit){
			?> <script language="JavaScript">alert('Data Password Terupdate')</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=7\">";
		} else {
			?><script language="JavaScript">alert('Update Password Gagal');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=7\">";
		}
	}
?>