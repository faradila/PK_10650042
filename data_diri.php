<?PHP
  include("../koneksi.php");
	include("../session.php");
	include("reg_username.php");
?>
<html>
<head>
</head>
<body>
<?php
		echo "<table border='0' align='center' cellspacing='5'>";
					if($jk=="p"){
						$jk2="Laki-Laki";
						}
					if($jk=="w"){
						$jk2="Perempuan";
						}
					
					echo "<tr><td  bgcolor = '#F0E68C' align='center'>NIP</td><td>:</td><td><b>$nip_guru</td></tr>";
					echo "<tr><td  bgcolor = '#F0E68C' align='center'>Nama Lengkap</td><td>:</td><td>$nama_guru</td></tr>";
					echo "<tr><td  bgcolor = '#F0E68C' align='center'>Jenis Kelamin</td><td>:</td><td>$jk2</td></tr>";
					echo "<tr><td  bgcolor = '#F0E68C' align='center'>Username</td><td>:</td><td>$username</td></tr>";
					echo "<tr><td  bgcolor = '#F0E68C' align='center'>Password</td><td>:</td><td>$password</td></tr>";
					echo "<tr><td  bgcolor = '#F0E68C' align='center'>Mata Pelajaran</td><td>:</td><td>";
							while($query_lihat = mysql_fetch_array($cek_query)){
							$mapel_guru = $query_lihat['kode_mapel'];
							$lihat_mapel = mysql_fetch_array(mysql_query("select * from mapel where kode_mapel = '$mapel_guru'"));
							$nama_mapel = $lihat_mapel['nama_mapel'];
							echo "$nama_mapel<br>";
							}
					echo"</td></tr>";
					echo "<tr><td  bgcolor = '#F0E68C' align='center'>Kelas</td><td>:</td><td>";
							while($query_lihat2 = mysql_fetch_array($cek_query2)){
							$kelas_guru = $query_lihat2['kode_kelas'];
							$lihat_kelas = mysql_fetch_array(mysql_query("select * from kelas where kode_kelas = '$kelas_guru'"));
							$nama_kelas = $lihat_kelas['nama_kelas'];
							echo "$nama_kelas<br>";
							}
					echo"</td></tr>";
		echo "</table>";
?>
<br>
</body>
</html>
