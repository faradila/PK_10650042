<?PHP
	include("../koneksi.php");
	include("../session.php");	
?>
<html>
<head>
</head>
<body>
<?PHP
if($tabel=='siswa'){
			echo "<table cellpadding='5' cellspacing='0' border='1' align='center'>";
			echo "<tr bgcolor='#DCDCDC'>
					<th align='center'>NIS</th>
					<th align='center'>Nama Siswa</th>
					<th align='center'>JK</th>
					<th align='center'>Username</th>
					<th align='center'>Password</th>
					<th align='center'>Kode Kelas</th>
					<th align='center'>Aksi</th>
				</tr>";
				$p=0;
				$w=0;
			while($data=mysql_fetch_array($hasil)){
					$nis = $data['nis'];
					$nama_siswa = $data['nama'];
					$jk = $data['jk'];
					$username = $data['username'];
					$password = $data['password'];
					$kode_kelas = $data['kode_kelas'];
					
					
					if ($jk == "p"){
					$jenis_kelamin = 'Pria';
					echo "<tr bgcolor= #ADFF2F>";
					$p++;
					}
					if ($jk == "w"){
					$jenis_kelamin = 'Wanita';
					echo "<tr bgcolor=#ADE8E6>";
					$w++;
					}
					
					echo "<td align='center'>$nis</td>"; 
					echo "<td align='center'>$nama_siswa</td>";
					echo "<td align='center'>$jenis_kelamin</td>";
					echo "<td align='center'>$username</td>";
					echo "<td align='center'>$password</td>";
					echo "<td align='center'>$kode_kelas</td>";
					echo "<form method=\"POST\" action=\"action_siswa.php?nis=$nis\">
					<input type=\"hidden\" value=\"$username\" name=\"username\">
					<td align='center'>
					<input type=\"submit\" name=\"action\" value=\"Update\">
					<input type=\"submit\" name=\"action\" value=\"Delete\">
					</form>
					</td>";
					echo "</tr>";
				}
		echo "</table>";
}
elseif($tabel=='nilai')
{
	echo "<form method=\"POST\" action=\"action_nilai.php\">";
		echo "<table cellpadding='5' cellspacing='0' border='1' align='center'>";
		echo "<tr bgcolor='#DCDCDC'>
					<th align='center'>NIS</th>
					<th align='center'>Nama Siswa</th>
					<th align='center'>Nama Mapel</th>
					<th align='center'>Kode_Kelas</th>
					<th align='center'>Nilai</th>
				</tr>";
			while($data=mysql_fetch_array($hasil)){
					$nis = $data['nis'];
					$lihat_nama=(mysql_fetch_array(mysql_query("select * from siswa where nis = '$nis'")));
					$nama = $lihat_nama['nama'];
					$mapel = $data['kode_mapel'];
					$kelas = $data['kode_kelas'];
					$tampil=(mysql_fetch_array(mysql_query("select * from mapel where kode_mapel = '$mapel'")));
					$nama_mapel = $tampil['nama_mapel'];
					$nilai = $data['nilai'];
					echo "<tr>";
					echo "<td align='center'>$nis<input type='hidden' name='nis".$no."' value='$nis'></td>"; 
					echo "<td align='center'>$nama</td>";
					echo "<td align='center'>$nama_mapel</td>";
					echo "<td align='center'>$kelas</td>";
					echo "<td><input type='text' readonly name='nilai' value='$nilai' size=3></td>";
					$no++;
					}
			echo "</table>";
}
elseif($tabel=='guru'){
		echo "<table cellpadding='5' cellspacing='0' border='1' align='center'>";
			echo "<tr bgcolor='#DCDCDC'>
					<th align='center'>NIP</th>
					<th align='center'>Nama Guru</th>
					<th align='center'>JK</th>
					<th align='center'>Username</th>
					<th align='center'>Password</th>
					<th align='center'>Aksi</th>
				</tr>";
			while($data=mysql_fetch_array($hasil)){
					$nip_guru = $data['nip_guru'];
					$nama_guru = $data['nama_guru'];
					$username = $data['username'];
					$jk = $data['jk'];
					$password = $data['password'];

					if ($jk == "p"){
					$jenis_kelamin = 'Pria';
					echo "<tr bgcolor= #ADFF2F>";}
					if ($jk == "w"){
					$jenis_kelamin = 'Wanita';
					echo "<tr bgcolor=#ADE8E6>";}
					
					echo "<td align='center'>$nip_guru</td>"; 
					echo "<td align='center'>$nama_guru</td>";
					echo "<td align='center'>$jenis_kelamin</td>";
					echo "<td align='center'>$username</td>";
					echo "<td align='center'>$password</td>";
					echo"<form method=\"POST\" action=\"action_guru.php?nip_guru=$nip_guru\">
					<input type=\"hidden\" value=\"$username\" name=\"username\">
					<td align='center'>
					<input type=\"submit\" name=\"action\" value=\"Update\">
					</form>
					</td>";
					echo "</tr>";
				
				}
		echo "</table>";
}
elseif($tabel=='tugas'){
		echo "<table cellpadding='3' cellspacing='0' border='1' align='center'>";
			echo "<tr bgcolor='#DCDCDC'>
					<th align='center'>No.</th>
					<th align='center'>Judul</th>
					<th align='center'>Name File</th>
					<th align='center'>Size</th>
					<th align='center'>Jenis Tugas</th>
					<th align='center'>Nama Guru</th>
					<th align='center'>Kode Kelas</th>
					<th align='center'>Nama Mapel</th>
					<th align='center'>Waktu Upload</th>
					<th align='center'>Keterangan</th>
					<th align='center'>Aksi</th>
				</tr>";
			while($data=mysql_fetch_array($hasil)){
					echo "<tr>";
					echo "<td align='center'>".$data['id_tugas']."</td>";
					echo "<td align='center'>".$data['judul']."</td>";
					echo "<td align='center'>".$data['nama_file']."</td>";
					echo "<td align='center'>".$data['size']."</td>";
					echo "<td align='center'>".$data['jenis_tugas']."</td>";
					$query_tampil=mysql_query("select * from guru where nip_guru = ".$data['nip_guru']."");
					$tampil1 = mysql_fetch_array($query_tampil) or die (mysql_error());
					$nama_guru = $tampil1['nama_guru'];
					echo "<td align='center'>$nama_guru</td>";
					echo "<td align='center'>".$data['kode_kelas']."</td>";
					$query_tampil2=mysql_query("select * from mapel where kode_mapel = ".$data['kode_mapel']."");
					$tampil2 = mysql_fetch_array($query_tampil2) or die (mysql_error());
					$nama_mapel = $tampil2['nama_mapel'];
					echo "<td align='center'>$nama_mapel</td>";
					echo "<td align='center'>".$data['tanggal']."</td>";
					echo "<td align='center'>".$data['ket']."</td>";
					echo"<form method=\"POST\" action=\"action_tugas.php?id_tugas=".$data['id_tugas']."\">
					<td align='center'>
					<input type=\"submit\" name=\"action\" value=\"Update\"></form>";
					echo "</tr>";
				
				}
		echo "</table>";
}
else
{
		echo "<table cellpadding='4' cellspacing='0' border='1' align='center'>";
			echo "<tr bgcolor='#DCDCDC'>
					<th align='center'>No</th>
					<th align='center'>Name File</th>
					<th align='center'>Size</th>
					<th align='center'>Judul</th>
					<th align='center' width=100>Nama Guru</th>
					<th align='center' width=70>Mapel</th>
					<th align='center'>Waktu</th>
					<th align='center'>Aksi</th>
				</tr>";
			$i=0;
			while($data=mysql_fetch_array($hasil)){
			$i++;
					echo "<tr>";
					echo "<td align='center'>".$data['id_materi']."</td>";
					echo "<td align='center'>".$data['nama_file']."</td>";
					echo "<td align='center'>".$data['size']."</td>";
					echo "<td align='center'>".$data['judul']."</td>";
						$sql = "select * from guru where nip_guru = ".$data['nip_guru']."";
						$query = mysql_query($sql);
						$tampil = mysql_fetch_array($query);
						$nama_guru = $tampil['nama_guru'];
					echo "<td align='center'>$nama_guru</td>";
						$sql = "select * from mapel where kode_mapel = ".$data['kode_mapel']."";
						$query = mysql_query($sql);
						$tampil = mysql_fetch_array($query);
						$nama_mapel = $tampil['nama_mapel'];
					echo "<td align='center'>$nama_mapel</td>";
					echo "<td align='center'>".$data['tanggal']."</td>";
					echo "<form method=\"POST\" action=\"action_upload_mapel.php?id_materi=".$data['id_materi']."\">
					<td align='center' width = '50'>
					<input type=\"submit\" name=\"action\" value=\"Update\">
					</form>";
					echo "</tr>";
				
				}
		echo "</table>";
}
?>
</body>
</html>