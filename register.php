<?php
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script language="JavaScript">
var txt=" Elearning SMK Ma`arif NU 1 Kembaran";
var kecepatan=1000;
var segarkan=null;
function bergerak() 
{ document.title=txt;
txt=txt.substring(1,txt.length)+txt.charAt(0);
segarkan=setTimeout("bergerak()",kecepatan);}bergerak();
</script>

<link href='images/favicon.png' rel='shortcut icon'/>

<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
    <div id="header">
    	<?php include ("selamat_datang.php");?>
    </div>
    <!-- end #header -->
    <!-- end #sidebar1 -->
    <!-- begin #mainContent -->
    <div id="mainContent3">
			<?PHP

			include("koneksi.php");
			error_reporting (E_ALL & ~E_NOTICE & ~E_DEPRECATED);
			if($_POST){
				$nis = $_POST['nis'];
				$nama_siswa = ucwords($_POST['nama_siswa']);
				$username = $_POST['username'];
				$password = $_POST['password'];
				$password2 = $_POST['password2'];
				$email = $_POST['email'];
				$kelas = $_POST['kelas'];
				$jk = $_POST['jk'];
				$number = $_REQUEST['number'];
				$key = $_SESSION['key'];
				
				$error = array();
				$polaemail = "^.+@.+.((com)|(co.id)|(net)(org))+$";
				$polaNis = "^99[0-9]{8}+$";
				$polaPass = "^.{5,}$";
				
				$cek1=mysql_query("select * from siswa where nis='$nis'");
				$cek2=mysql_query("select * from login where username='$username'");
				$cek3=mysql_query("select * from siswa where email='$email'");
				
				if(empty($nis) ){
					$error['nis'] = 'Nomor Induk Siswa Nasional Tidak Valid';
				}if(empty($nama_siswa)){
					$error['nama_siswa'] = 'Nama Tidak Boleh Kosong';
				} if(empty($username)){
					$error['username'] = 'Username Tidak Boleh Kosong';
				} if(empty($email) || !eregi($polaemail, $email)){
					$error['email'] = 'Email Tidak Valid';
				}
				if(empty($password) || !eregi($polaPass, $password)){
					$error['password'] = 'Password Minimal 5 Karakter';
				}
				if($password != $password2 || !eregi($polaPass, $password2)){
					$error['password2'] = 'Password Retype Tidak Sesuai';
				}if(empty($kelas)){
					$error['kelas'] = 'Kelas Tidak Boleh Kosong';
				}if(empty($jk)){
					$error['jk'] = 'Jenis Kelamin Tidak Boleh Kosong';
				}if(mysql_num_rows($cek1)>0){
					$error['nis2'] = 'Nomor Induk Siswa Nasional Sudah Ada';
				}if(mysql_num_rows($cek2)>0){
					$error['username2'] = 'Username Sudah Ada';
				}
				if(mysql_num_rows($cek3)>0){
					$error['email2'] = 'Email Sudah Ada';
				}
				if(empty($number)){
					$error['captcha'] = 'Mohon Masukkan Captcha';
				}
				if($number!=$key){
					$error['captcha2'] = 'Captcha Yang Anda Masukkan Tidak Valid';
				}
				if(empty($error)){
				//proses data
				$sql2 = "insert into siswa (nis,nama,jk,username,password,kode_kelas,email) values('$nis','$nama_siswa','$jk','$username','$password','$kelas','$email')";
				$query2 = mysql_query($sql2);
				if ($query2)
				{
					$password_enkrip= md5($password);
					$sql = "insert into login (username,password,level) values('$username','$password_enkrip','siswa')";
					$query = mysql_query($sql);
				}
				if ($query){
					//$sembunyi = 1;
					if($jk==p){$jk2='Pria';}
					if($jk==w){$jk2='Wanita';}
					echo "<h1>Pendaftaran Siswa Berhasil</h1>
							<table border='0'>
							<tr><td><b>NIS </td><td>:</td><td> $nis</td></tr>
							<tr><td><b>Nama </td><td>:</td><td> $nama_siswa</td></tr>
							<tr><td><b>Jenis Kelamin </td><td>:</td><td> $jk2</td></tr>
							<tr><td><b>Username </td><td>:</td><td> $username</td></tr>
							<tr><td><b>Password </td><td>:</td><td> $password</td></tr>
							<tr><td><b>Kelas </td><td>:</td><td> $kelas</td></tr>
							<tr><td><b>Email </td><td>:</td><td> $email</td></tr>
							<tr><td><b>Password Enkripsi </td><td>:</td><td> $password_enkrip</td></tr>
							</table>
							*mohon data disimpan, dan gunakan data untuk melakukan login
							<hr>
							<a href='index.php' style='text-decoration:none'><font color='green'>Halaman Login</font></a>
							<br><br><br>";
							
				} else {
					mysql_query("delete from siswa where nis = '$nis'");
					?><script language="JavaScript">alert('Penambahan data gagal, Mohon dicek Kembali');</script><?PHP
					echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=register.php\">";
					}
				}
			}
			
			?>
			<h2>Silahkan Mengisi Formulir Pendaftaran</h2>
            <form method='POST'>
				<table border="0">
					<tr>
						<td>NISN</td>
						<td>:</td>
						<td><input type="text" name="nis" id="nis" value="<?PHP echo isset($_POST['nis']) ? $_POST['nis']: '';?>">
						<div style="color:red"><?PHP echo isset($error['nis']) ? $error['nis']: '';?><div>
						<div style="color:red"><?PHP echo isset($error['nis2']) ? $error['nis2']: '';?><div>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>Nama Lengkap</td>
						<td>:</td>
						<td><input type="text" name="nama_siswa" id="nama_siswa" value="<?PHP echo isset($_POST['nama_siswa']) ? $_POST['nama_siswa']: '';?>">
						<div style="color:red"><?PHP echo isset($error['nama_siswa']) ? $error['nama_siswa']: '';?><div>
						</td>
					</tr>
					<td>Jenis Kelamin</td>
						<td>:</td>
						<td><select name="jk">
						<option value="<?PHP echo isset($_POST['jk']) ? $_POST['jk']: '';?>">
						<?PHP
						if (isset($_POST['jk']))
							{
								echo $_POST['jk'];
							}
						else{
								echo "-------Pilih JK-----";
							}
						?>
						</option>";
						<option value="p">Pria</option>";
						<option value="w">Wanita</option>";
						</select>
						<div style="color:red"><?PHP echo isset($error['jk']) ? $error['jk']: '';?><div>
						</td>
					</tr>
					<tr>
						<td>Kelas</td>
						<td>:</td>
						<td>
						<select name="kelas">
						<option value="<?PHP echo isset($_POST['kelas']) ? $_POST['kelas']: '';?>">
						<?PHP
						if (isset($_POST['kelas']))
							{
								echo $_POST['kelas'];
							}
						else{
								echo "-------Pilih Kelas-----";
							}
						?>
						</option>";
						<?php
						$query = "SELECT * FROM kelas";
						$hasil = mysql_query($query);
						while ($data = mysql_fetch_array($hasil))
						{
						echo "<option value=".$data['kode_kelas'].">".$data['nama_kelas']."</option>";
						}
						?></select>
						<div style="color:red"><?PHP echo isset($error['kelas']) ? $error['kelas']: '';?><div>
						</td>
					</tr>	
					<tr>
						<td>Username</td>
						<td>:</td>
						<td><input type="text" name="username" id="username" value="<?PHP echo isset($_POST['username']) ? $_POST['username']: '';?>">
						<div style="color:red"><?PHP echo isset($error['username']) ? $error['username']: '';?><div>
						<div style="color:red"><?PHP echo isset($error['username2']) ? $error['username2']: '';?><div>
						</td>
					</tr>
					<tr>
						<td>Password</td>
						<td>:</td>
						<td><input type="password" name="password" id="password" value="<?PHP echo isset($_POST['password']) ? $_POST['password']: '';?>">
						<div style="color:red"><?PHP echo isset($error['password']) ? $error['password']: '';?><div>
						</td>
						<td>* </td>
						<td width=7000><font color='blue'>Disarankan untuk menggunakan Kombinasi Angka dan Huruf</td>
					</tr>
					<tr>
						<td>Retype Password</td>
						<td>:</td>
						<td><input type="password" name="password2" id="password" value="<?PHP echo isset($_POST['password2']) ? $_POST['password2']: '';?>">
						<div style="color:red"><?PHP echo isset($error['password2']) ? $error['password2']: '';?><div>
						</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><input type="text" name="email" id="email" value="<?PHP echo isset($_POST['email']) ? $_POST['email']: '';?>">
						<div style="color:red"><?PHP echo isset($error['email']) ? $error['email']: '';?><div>
						<div style="color:red"><?PHP echo isset($error['email2']) ? $error['email2']: '';?><div>
						</td>
						<td>* </td>
						<td width=7000><font color='blue'>Masukkan Email Yang Valid</td>
					</tr>
					<tr>
						<td colspan=3>
						<center><img src="captcha_image.php" />
						</td>
					</tr>
					<tr>
						<td>Masukkan Captcha</td>
						<td>:</td>
						<td><input name="number" type="text" id="number" value="<?PHP echo isset($_REQUEST['number']) ? $_REQUEST['number']: '';?>">
						<div style="color:red"><?PHP echo isset($error['captcha']) ? $error['captcha']: '';?><div>
						<div style="color:red"><?PHP echo isset($error['captcha2']) ? $error['captcha2']: '';?><div>
						</td>
					</tr>
					<tr height='10'></tr>
					<tr>
						<td>
							<input type='submit' value='SUBMIT' name='login'></td>
						<td></td>
						<td>
							<input type='reset' value='RESET'>
						</td>
						<td>
						</td>
					<tr></tr><tr></tr>
					</tr>
				</table>
				<a href="index.php" style="text-decoration:none">Kembali</a>
				</form>
				<?PHP ?>
        <br /> 
	</div>
	<?PHP	
	
				$random=md5(microtime());
				$random=substr($random,0,5);
	?>
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
