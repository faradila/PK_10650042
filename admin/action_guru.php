<?php
include("../koneksi.php");
include("../session.php");
$action = strtolower($_POST['action']);
$nip_guru = $_REQUEST['nip_guru'];
$nama_guru = $_REQUEST['nama_guru'];
if($_SESSION['reg_level']!="admin") {
header('location:../index.php');
}

if ($action == "delete")
{
	$jumlah1 = mysql_num_rows(mysql_query("select * from mengajar where nip_guru='$nip_guru'"));
	$jumlah2 = mysql_num_rows(mysql_query("select * from pengumuman where nip_guru='$nip_guru'"));
	$jumlah3 = mysql_num_rows(mysql_query("select * from tugas where nip_guru='$nip_guru'"));
	$jumlah4 = mysql_num_rows(mysql_query("select * from upload where nip_guru='$nip_guru'"));
	
	if($jumlah1>0)
	{
		$tabel_exist .= "Mengajar,";
	}
	if($jumlah2>0)
	{
		$tabel_exist .= " Pengumuman,";
	}
	if($jumlah3>0)
	{
		$tabel_exist .= " Tugas,";
	}
	if($jumlah4>0)
	{
		$tabel_exist .= " Upload,";
	}
	if($jumlah1>0 || $jumlah2>0 || $jumlah3>0 || $jumlah4>0)
	{
		echo '<script language="JavaScript">alert("'.$nama_guru.', Tidak Dapat Dihapus Karena Guru Bersangkutan\nMasih Terkait Dengan data '.$tabel_exist.' \nMohon Periksa Kembali !");</script>';
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=3\">";
	}
	
	else{
		$username = $_POST['username'];
		$delete = "delete from guru where nip_guru = '$nip_guru'";
		$delete2 = "delete from login where username = '$username'";

		$delete_query = mysql_query($delete);
		$delete_query2 = mysql_query($delete2);

		if ($delete_query && $delete_query2){
					?> <script language="JavaScript">alert('Data Berhasil Di Hapus');</script><?PHP
					echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=3\">";
		}else {
					?><script language="JavaScript">alert('Data Gagal Dihapus');</script><?PHP
					echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=3\">";
				}
	}
}
elseif($action=="tambah"){
		if($_POST['nip']==""){
		?> <script language="JavaScript">alert('Maaf anda Belum Memasukkan NIP');</script><?PHP
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=11\">";
		}
		else if($_POST['n_guru']==""){
		?> <script language="JavaScript">alert('Maaf anda Belum Memasukkan Nama Guru');</script><?PHP
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=11\">";
		}
		else if($_POST['jk']==""){
		?> <script language="JavaScript">alert('Maaf anda Belum Memasukkan Jenis Kelamin');</script><?PHP
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=11\">";
		}
		else if($_POST['password']==""){
		?> <script language="JavaScript">alert('Maaf anda Belum Memasukkan Password');</script><?PHP
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=11\">";
		}
		
		else{
				$nip = str_replace(" ", '', strtoupper(trim($_POST["nip"]))) ;
				$nama_guru=ucwords($_POST["n_guru"]);
				$username=$_POST["username"];
				$password=$_POST["password"];
				$jk=$_POST["jk"];
				$sql2 = "INSERT INTO guru (nip_guru,nama_guru,jk,username,password) values('$nip','$nama_guru','$jk','$username','$password')";
				$query2 = mysql_query($sql2);
				
				if ($query2 && $_POST['level'])
				{
					$password2 = md5($password);
					$level = $_POST['level'];
					$sql3 = "insert into login (username,password,level) values('$username','$password2','$level')";
					$query3 = mysql_query($sql3);
				}
				else
				{
					$password2 = md5($password);
					$sql3 = "insert into login (username,password,level) values('$username','$password2','guru')";
					$query3 = mysql_query($sql3) or die (mysql_error());
				}
				if ($query3){
					?> <script language="JavaScript">alert('Data berhasil ditambahkan');</script><?PHP
					echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=3\">";
				} else {
				mysql_query("delete from guru where nip_guru = '$nip'");
					?><script language="JavaScript">alert('Penambahan data gagal');</script><?PHP
					echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=3\">";
					}
			}
}
elseif($action=="edit"){
		$nip=strtoupper($_POST["e_nip_guru"]);
		$nama_guru=ucwords($_POST["e_nama_guru"]);
		$username=($_POST["e_username"]);
		$jk=($_POST["e_jk"]);
		$password=($_POST["e_password"]);
		
		if(empty($nip) || empty($nama_guru) || empty($jk) || empty($username)|| empty($password)){
		?><script language="JavaScript">alert('Anda Belum Memasukkan Data Dengan Lengkap');</script><?PHP
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=3\">";
		}
		else{
		$cek = mysql_fetch_array(mysql_query("select * from guru where nip_guru = '$nip'"));
		$user = $cek['username'];
		$pass = $cek['password'];
		
			$password2 = md5($password);
			$query_edit2 = mysql_query("update login set password = '$password2' where username='$user'");
			$query_edit1 = mysql_query("update login set username = '$username' where password='$password2'");
		
		if ($query_edit1 && $query_edit2 ){
		$sql = "update guru set nama_guru = '$nama_guru',jk='$jk', username='$username',password = '$password' where nip_guru='$nip'";
		$query_edit = mysql_query($sql);
		}
		if($query_edit){
			?> <script language="JavaScript">alert('Data terupdate');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=3\">";
		} else {
			?><script language="JavaScript">alert('Update gagal');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=3\">";
		}
		}
}
else 
{
$sql_select="select * from guru where nip_guru='$nip_guru'";
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
            <h2 align="center">Update Data Guru</h2>
			
				<form action="action_guru.php" method="POST">

				<table width="400" align="center" cellpadding="4" cellspacing="4">
					<tr>
						<td>NIP</td>
						<td><input type="hidden" value="<?PHP echo $data['nip_guru'] ?>" name="e_nip_guru"><?PHP echo $data['nip_guru'] ?></td>
					</tr>
					
					<tr>
						<td>Nama Guru</td>
						<td><input type="text" value="<?PHP echo $data['nama_guru'] ?>" name="e_nama_guru"></td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td><select name="e_jk">
						<option value="<?PHP echo $data['jk']?>"><?PHP echo $data['jk']?></option>;
						<option value="p">Pria</option>;
						<option value="w">Wanita</option>";
						</select></td>
					</tr>
					<tr>
						<td>Username</td>
						<td><input type="text" value="<?PHP echo $data['username'] ?>" name="e_username"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="text" value="<?PHP echo $data['password'] ?>" name="e_password"></td>
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