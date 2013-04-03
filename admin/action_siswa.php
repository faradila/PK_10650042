<?php
include("../koneksi.php");
include("../session.php");
$action = strtolower($_POST['action']);
$nis = $_REQUEST['nis'];
if($_SESSION['reg_level']!="admin") {
header('location:../index.php');
}

if ($action == "delete")
{
$jumlah1 = mysql_num_rows(mysql_query("select * from nilai where nis='$nis'"));
	if($jumlah1>0){
		?> <script language="JavaScript">alert('Data Siswa Bersangkutan Tidak Dapat Dihapus Karena Masih Berkaitan Dengan Data Nilai, \nMohon Periksa Kembali !');</script><?PHP
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=4\">";
	}

	else{
		$username = $_POST['username'];
		$delete = "delete from siswa where nis = '$nis'";
		$delete2 = "delete from login where username = '$username'";

		$delete_query = mysql_query($delete);
		$delete_query2 = mysql_query($delete2);

		if ($delete_query && $delete_query2){
					?> <script language="JavaScript">alert('Data Berhasil Di Hapus');</script><?PHP
					echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=4\">";
		}else {
					?><script language="JavaScript">alert('Data Gagal Dihapus');</script><?PHP
					echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=4\">";
				}
		}
}

elseif ($action == "tambah"){
	if($_POST['nis']==""){
	?> <script language="JavaScript">alert('Maaf anda Belum Memasukkan NIS');</script><?PHP
	echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=12\">";
	}
	else if($_POST['n_siswa']==""){
	?> <script language="JavaScript">alert('Maaf anda Belum Memasukkan Nama siswa');</script><?PHP
	echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=12\">";
	}
	else if($_POST['jk']==""){
	?> <script language="JavaScript">alert('Maaf anda Belum Memasukkan Jenis Kelamin');</script><?PHP
	echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=12\">";
	}
	else if($_POST['username']==""){
	?> <script language="JavaScript">alert('Maaf anda Belum Memasukkan Jenis Kelamin');</script><?PHP
	echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=12\">";
	}
	else if($_POST['password']==""){
	?> <script language="JavaScript">alert('Maaf anda Belum Memasukkan Jenis Kelamin');</script><?PHP
	echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=12\">";
	}
	else if($_POST['kelas']==""){
	?> <script language="JavaScript">alert('Maaf anda Belum Memasukkan Kelas');</script><?PHP
	echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=12\">";
	}

	else{
		$nis=$_POST["nis"];
		$nama_siswa=strtoupper($_POST["n_siswa"]);
		$username=$_POST["username"];
		$password=$_POST["password"];
		$jk=$_POST["jk"];
		$kode_kelas=$_POST["kelas"];
		$email=$_POST["email"];
		$sql2 = "insert into siswa (nis,nama,jk,username,password,kode_kelas,email) values('$nis','$nama_siswa','$jk','$username','$password','$kode_kelas','$email')";
		$query2 = mysql_query($sql2);
		if ($query2)
		{
			$password2= md5($password);
			$sql = "insert into login (username,password,level) values('$username','$password2','siswa')";
			$query = mysql_query($sql);
		}
		if ($query){
			?> <script language="JavaScript">alert('Data berhasil ditambahkan');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=4\">";
		} else {
			mysql_query("delete from siswa where nis = '$nis'");
			?><script language="JavaScript">alert('Penambahan data gagal, Mohon dicek Kembali');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=4\">";
			}
	}
}
elseif ($action == "edit"){
		$nis=$_POST["nis"];
		$nama_siswa=ucwords($_POST["e_nama_siswa"]);
		$jk=$_POST["e_jk"];
		$username=$_POST["e_username"];
		$password=$_POST["e_password"];
		$kode_kelas=$_POST[e_kelas];
		$email=$_POST["e_email"];
		
		if(empty($nis) || empty($nama_siswa) || empty($jk) || empty($password) || empty($username) || empty($kode_kelas) || empty($email)){
		?><script language="JavaScript">alert('Anda Belum Memasukkan Data Dengan Lengkap');</script><?PHP
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=4\">";
		}
		else{
		$cek = mysql_fetch_array(mysql_query("select * from siswa where nis = '$nis'"));
		$user = $cek['username'];
		$pass = $cek['password'];
		
			$password2 = md5($password);
			$query_edit2 = mysql_query("update login set password = '$password2' where username='$user'");
			$query_edit1 = mysql_query("update login set username = '$username' where password='$password2'");
		
		if ($query_edit1 && $query_edit2 ){
			$sql = "update siswa set nama = '$nama_siswa',password = '$password', username = '$username',jk = '$jk', kode_kelas = '$kode_kelas', email = '$email'  where nis='$nis'";
			$query_edit = mysql_query($sql);
		}
		if($query_edit){
			?> <script language="JavaScript">alert('Data terupdate');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=4\">";
		} else {
			?><script language="JavaScript">alert('Update gagal');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=4\">";
		}
		}
}
else 
{
$sql_select="select * from siswa where nis='$nis'";
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
            <h2 align="center">Update Data Siswa</h2>
			<div id="table">
				<form action="action_siswa.php" method="POST">

				<table width="400" align="center" cellpadding="4" cellspacing="4">
					<tr>
						<td>NIS</td>
						<td><input type="hidden" value="<?PHP echo $data[0] ?>" name="nis"><?PHP echo $data[0] ?></td>
					</tr>
					
					<tr>
						<td>Nama Siswa</td>
						<td><input type="text" value="<?PHP echo $data[1] ?>" name="e_nama_siswa"></td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td><select name="e_jk">
						<option value="<?PHP echo $data[2] ?>"><?PHP echo $data[2] ?></option>";
						<option value="p">Pria</option>";
						<option value="w">Wanita</option>";
						</select>
						</td>
					</tr>
					<tr>
						<td>Username</td>
						<td><input type="text" value="<?PHP echo $data[3] ?>" name="e_username"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="text" value="<?PHP echo $data[4] ?>" name="e_password"></td>
					</tr>
					<tr>
						<td>Nama Kelas</td>
						<td><select name="e_kelas">
						<option value="<?PHP echo $data[5] ?>"><?PHP echo $data[5] ?></option>";
						<?php
						$query = "SELECT * FROM kelas";
						$hasil = mysql_query($query);
						while ($data_kelas = mysql_fetch_array($hasil))
						{
						echo "<option value=".$data_kelas['kode_kelas'].">".$data_kelas['nama_kelas']."</option>";
						}

						?></select></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="text" value="<?PHP echo $data[6] ?>" name="e_email"></td>
					</tr>
					<tr>
						<td width="90"></td>
						<td><input type="submit" name="action" value="edit"></td>
					</tr>

</table>
</form>
</div>
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