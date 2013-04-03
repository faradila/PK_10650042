<?PHP
$koneksi = mysql_connect("localhost","root","");
mysql_select_db("elearning",$koneksi) or die("Koneksi ke coba gagal");

if(isset($_POST['login'])) {
session_start();
error_reporting (E_ALL & ~E_NOTICE & ~E_DEPRECATED);
session_register("reg_username");
session_register("reg_password");
$reg_username = $_POST['username'];
$pass = $_POST['password'];
$reg_password = md5($_POST['password']);

if($reg_username =="" && $reg_password ===""){
	session_unset();
	session_destroy();
	?><script language="JavaScript">alert('Username dan Password Anda Belum Diisi!!'); 
	document.location='index.php'</script><?php
}
elseif($reg_username ==""){
	session_unset();
	session_destroy();
	?><script language="JavaScript">alert('Maaf Username Anda Belum Diisi!!'); 
	document.location='index.php'</script><?php
}
elseif($reg_password ===""){
	session_unset();
	session_destroy();
	?><script language="JavaScript">alert('Maaf Password Anda Belum Diisi!!'); 
	document.location='index.php'</script><?php
}
else{
$sql = mysql_query("SELECT * FROM login WHERE username='$reg_username' && password='$reg_password'");
$data = mysql_fetch_array($sql);
$num = mysql_num_rows($sql);
$level = $data['level'];
if($num==1) {

$_SESSION['reg_username'] = $username;
$_SESSION['reg_password'] = $password;
$_SESSION['password'] = $pass;
	if($level=="admin"){
		$_SESSION['reg_level'] = $level;
		?><script language="JavaScript">alert('Anda Login sebagai admin');
		document.location='/html/admin/indexadmin.php'</script><?php
	}
	else if($level=="siswa"){
		$_SESSION['reg_level'] = $level;
		?><script language="JavaScript">alert('Anda Login sebagai siswa!');
		document.location='/html/siswa/indexsiswa.php'</script><?php
	}
	
	else if($level=="kepsek"){
		$_SESSION['reg_level'] = $level;
		?><script language="JavaScript">alert('Anda Login sebagai Kepala Sekolah!');
		document.location='/html/kepsek/indexkepsek.php'</script><?php
	}
	
	else if($level=="guru"){
		$_SESSION['reg_level'] = $level;
		echo '<script language="JavaScript">alert("Hi '.$data[username].', Anda Login sebagai Guru!");
		document.location="/html/guru/indexguru.php"</script>';
	}
} else {
	session_unset();
	session_destroy();
?><script language="JavaScript">alert('Username atau password Anda salah'); 
document.location='index.php'</script><?php
}}
}
?>
