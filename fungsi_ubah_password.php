<?PHP
  include("../koneksi.php");
	include("../session.php");
	include("reg_username.php");

if($_POST['pass0']=="" ||$_POST['pass1']=="" || $_POST['pass2']==""){
?> <script language="JavaScript">alert('Maaf anda belum mengisi seluruh form password');</script><?PHP
echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=7\">";
}
elseif($_POST['pass0'] != $password){
?> <script language="JavaScript">alert('Maaf Password Lama Anda Tidak Sesuai ');</script><?PHP
echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=7\">";
}
elseif($_POST['pass1'] != $_POST['pass2']){
?> <script language="JavaScript">alert('Maaf Password baru dan Ulang Password Tidak Sesuai ');</script><?PHP
echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=7\">";
}
elseif(strlen($_POST['pass1']) <= 5){
?> <script language="JavaScript">alert('Panjang Password Minimal 5 Karakter ');</script><?PHP
echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=7\">";
}
else{	
		$pass2 = md5($_POST['pass1']);
		$sql_edit = "update login set password='$pass2' where username='$username'";
		$query_edit = mysql_query($sql_edit);
		
		if ($query_edit){
			$pass = $_POST['pass1'];
			$query_edit = mysql_query("update guru set password='$pass' where username='$username'");
			?> <script language="JavaScript">alert('Password terupdate');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=19\">";
		} else {
			?><script language="JavaScript">alert('Update Password Gagal');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=7\">";
		}
	}
?>
