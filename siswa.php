<?PHP
  include("../koneksi.php");
	include("../session.php");
	include("reg_username.php");
?>
<html>
<head></head>

<body>
<?php

	$query_select = mysql_query("select distinct kode_kelas from mengajar where nip_guru='$nip_guru'");
	
		echo "<table cellpadding='5' cellspacing='0' border='1' align='center'>";
			echo "<tr bgcolor='#DCDCDC'>
					<th align='center'>Kode Kelas</th>
					<th align='center'>Nama Kelas</th>
					<th align='center'>Jumlah Siswa</th>
					<th align='center' bgcolor=#008000><font color = '#00FF00'>Lihat Siswa</font></th>
				</tr>";
			$total = 0;
			while($data=mysql_fetch_array($query_select)){
					$kode_kelas = $data['kode_kelas'];
					$lihat = mysql_fetch_array(mysql_query("select * from kelas where kode_kelas='$kode_kelas'"));
					$nama_kelas = $lihat['nama_kelas'];
					$jumlah_siswa = mysql_num_rows(mysql_query("select * from siswa where kode_kelas = '$kode_kelas'"));
					echo "<tr>";
					echo "<td align='center'>$kode_kelas</td>"; 
					echo "<td align='center'>$nama_kelas</td>";
					echo "<td align='center'>$jumlah_siswa</td>";
					
					echo "<form method=\"POST\"> 
					<input type=\"hidden\"  name = \"kode_kelas\" value=\"$kode_kelas\">
					<td align='center'>
					<input type=\"submit\" name=\"action\" value=\"Lihat\">
					</form>
					</td>";
					$total =$total + $jumlah_siswa;
					echo "</tr>";
				}
		echo "</table>";
		echo "<br><center><b>Jumlah Seluruh Siswa : $total</b></center><br>";
		
if($_POST['action'] == true){
	$kode_kelas = $_POST['kode_kelas'];
	$query_select=mysql_query("select * from siswa where kode_kelas = '$kode_kelas'");
	$jumlah = mysql_num_rows($query_select);
	if($jumlah>0){
		echo "<h3><center>Kode Kelas = $kode_kelas</center></h3>";
		echo "<table cellpadding='6' cellspacing='0' border='1' align='center'>";
			echo "<tr bgcolor='#DCDCDC'>
					<th align='center'>NIS</th>
					<th align='center'>Nama Siswa</th>
					<th align='center'>JK</th>
					<th align='center'>Email</th>
				</tr>";
				$p=0;
				$w=0;
			while($data=mysql_fetch_array($query_select)){
					$nis = $data['nis'];
					$nama_siswa = $data['nama'];
					$jk = $data['jk'];
					$email = $data['email'];
					if ($jk == "p"){
					echo "<tr bgcolor= #ADFF2F>";
					$jk2 = 'Pria';
					$p++;
					}
					if ($jk == "w"){
					echo "<tr bgcolor=#ADE8E6>";
					$jk2 = 'Wanita';
					$w++;
					}
					echo "<td align='center'>$nis</td>"; 
					echo "<td align='center'>$nama_siswa</td>";
					echo "<td align='center'>$jk2</td>";
					if($email!=""){
						echo "<td align='center'>$email</td>";
					}else{
						echo "<td align='center'>--</td>";
					}
					echo "</tr>";
				
				}
		echo "</table>";
		?><br><center><font face='arial' color='black' size='2px'>*Jumlah Siswa : <?PHP echo $jumlah;?></center>
		<center>*Jumlah Siswa Pria: <?PHP echo $p;?></center>
		<center>*Jumlah Siswa Wanita: <?PHP echo $w;?></center><?PHP
}
else{
echo "<center><b>Data Siswa Kosong</b></center>";
}
}
else{
echo "<br><br>";
}
?>

<br>
</body>
</html>
