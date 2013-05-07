<?PHP
  include("../koneksi.php");
	include("../session.php");
	include("reg_username.php");
?>
<html>
<head></head>
<body>
<?php
	$sql_select = "select * from mengajar where nip_guru = '$nip_guru'";
	$query_select=mysql_query($sql_select);
	$jumlah = mysql_num_rows($query_select);
		echo "<table cellpadding='5' cellspacing='0' border='0' align='center'>";
			echo "<tr bgcolor='#808080'>
					<th align='center'>Kode Kelas</th>
					<th align='center'>Nama Mapel</th>
					<th align='center'>Jumlah Siswa</th>
				</tr>";
			$jumKel = 0;
			$jumSis = 0;
			$w = 2;
			while($data=mysql_fetch_array($query_select)){
					$kode_kelas = $data['kode_kelas'];
					$i = mysql_num_rows(mysql_query("select * from siswa where kode_kelas = '$kode_kelas'"));
					$jumSis = $jumSis + $i;
					$kode_mapel = $data['kode_mapel'];
					$mapel = mysql_fetch_array(mysql_query("select * from mapel where kode_mapel = '$kode_mapel'"));
					$nama_mapel = $mapel['nama_mapel'];
					$jumlah_siswa = mysql_num_rows(mysql_query("select * from siswa where kode_kelas = '$kode_kelas'"));
					
					if($w % 2 == 0){
						echo "<tr bgcolor='#7CFC00'>";
					}
					else{
						echo "<tr bgcolor='#DCDCDC'>";
					}
					echo "<td align='center'>$kode_kelas</td>"; 
					echo "<td align='center'>$nama_mapel</td>";
					echo "<td align='center'>$jumlah_siswa</td>";
					echo "</tr>";
				$w++;
				}
		echo "</table>";
?>
<br>
<center>Jumlah Kelas : <?PHP echo $jumlah;?></center>
<center>Jumlah Siswa : <?PHP echo $jumSis;?></center>
<br>
</body>
</html>
