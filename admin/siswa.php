<?PHP
	include("../koneksi.php");
	include("../session.php");
	
	if($_SESSION['reg_level']!="admin") {
	header('location:../login.php');
	}
	
		$dataPerHalaman_Siswa = 10;
		// apabila $_GET['Halaman_Siswa'] sudah didefinisikan, gunakan nomor Halaman_Siswa tersebut,
		// sedangkan apabila belum, nomor Halaman_Siswanya 1.
		if(isset($_GET['Halaman_Siswa']))
		{
			$noHalaman_Siswa = $_GET['Halaman_Siswa'];
		}
		else $noHalaman_Siswa = 1;
		
		// perhitungan offset
		$offset = ($noHalaman_Siswa - 1) * $dataPerHalaman_Siswa;
		
		// query SQL untuk menampilkan data perHalaman_Siswa sesuai offset
		$sql_select="select * from kelas LIMIT $offset, $dataPerHalaman_Siswa";
		$query_select=mysql_query($sql_select);	
?>
<html>
<head>
<!--<meta http-equiv="refresh" content="2"/>--->
</head>

<body>
<?php
		echo "<table cellpadding='5' cellspacing='0' border='1' align='center'>";
			echo "<tr bgcolor='#DCDCDC'>
					<th align='center'>Kode Kelas</th>
					<th align='center'>Nama Kelas</th>
					<th align='center'>Jumlah Siswa</th>
					<th align='center' bgcolor=#008000><font color = '#00FF00'>Lihat Siswa</font></th>
				</tr>";
			while($data=mysql_fetch_array($query_select)){
					$kode_kelas = $data['kode_kelas'];
					$nama_kelas = $data['nama_kelas'];
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
					echo "</tr>";
				}
		echo "</table>";
		$total_siswa = mysql_num_rows(mysql_query("select * from siswa"));
		echo "<br><b>Jumlah Seluruh Siswa : $total_siswa</b><br>";

		
		// mencari jumlah semua data dalam tabel kelas
		$query   = "SELECT COUNT(*) AS jumData FROM kelas";
		$hasil  = mysql_query($query);
		$data     = mysql_fetch_array($hasil);
		
		$jumData = $data['jumData'];
		
		// menentukan jumlah Halaman_Siswa yang muncul berdasarkan jumlah semua data
		$jumHalaman_Siswa = ceil($jumData/$dataPerHalaman_Siswa);
		
		// menampilkan link previous
		if ($noHalaman_Siswa > 1) echo  "<a href='tampilan.php?Halaman_Siswa=".($noHalaman_Siswa-1)."'>&lt;&lt; Prev</a>";
		
		// memunculkan nomor Halaman_Siswa dan linknya
		for($Halaman_Siswa = 1; $Halaman_Siswa <= $jumHalaman_Siswa; $Halaman_Siswa++)
		{
			if ((($Halaman_Siswa >= $noHalaman_Siswa - 3) && ($Halaman_Siswa <= $noHalaman_Siswa + 3)) || ($Halaman_Siswa == 1) || ($Halaman_Siswa == $jumHalaman_Siswa))
				{
				if (($showHalaman_Siswa == 1) && ($Halaman_Siswa != 2))  echo "...";
				if (($showHalaman_Siswa != ($jumHalaman_Siswa - 1)) && ($Halaman_Siswa == $jumHalaman_Siswa))  echo "...";
				if ($Halaman_Siswa == $noHalaman_Siswa) echo " <b>".$Halaman_Siswa."</b> ";
				else echo " <a href='tampilan.php?Halaman_Siswa=".$Halaman_Siswa."'>".$Halaman_Siswa."</a> ";
				$showHalaman_Siswa = $Halaman_Siswa;
				}
		}
		// menampilkan link next
		if ($noHalaman_Siswa < $jumHalaman_Siswa) echo "<a href='tampilan.php?Halaman_Siswa=".($noHalaman_Siswa+1)."'>Next &gt;&gt;</a>";

if($_POST['action'] == true){
		$kode_kelas = $_POST['kode_kelas'];
		echo "<h3><center>Kode Kelas = $kode_kelas</center></h3>";
		$query_select2=mysql_query("select * from siswa where kode_kelas = '$kode_kelas'");
		$jumlah2 = mysql_num_rows($query_select2);
		
		echo "<table cellpadding='3' cellspacing='0' border='1' align='center'>";
			echo "<tr bgcolor='#DCDCDC'>
					<th align='center'>NIS</th>
					<th align='center'>Nama Siswa</th>
					<th align='center'>JK</th>
					<th align='center'>Username</th>
					<th align='center'>Password</th>
					<th align='center'>Kode Kelas</th>
					<th align='center'>Email</th>
					<th align='center'>Aksi</th>
				</tr>";
				$p=0;
				$w=0;
			echo "<div id = 'table_kecil'>";
			while($data2=mysql_fetch_array($query_select2)){
					$nis = $data2['nis'];
					$nama_siswa = $data2['nama'];
					$jk = $data2['jk'];
					$username = $data2['username'];
					$password = $data2['password'];
					$kode_kelas = $data2['kode_kelas'];
					$email = $data2['email'];
					
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
					echo "<td align='center'>$email</td>";
					echo "<form method=\"POST\" action=\"action_siswa.php?nis=$nis\">
					<input type=\"hidden\" value=\"$username\" name=\"username\">
					<td align='center' width='5'>
					<input type=\"submit\" name=\"action\" value=\"Update\">
					<input type=\"submit\" name=\"action\" value=\"Delete\" onClick=\"return confirm('Apakah anda yakin menghapus data ini?')\">
					</form>
					</td>";
					echo "</tr>";
				}
		echo "</div>";
		echo "</table>";
		
		
		$jumlah_siswa = mysql_num_rows(mysql_query("select * from siswa where kode_kelas = '$kode_kelas'"));
		?><br><center><font face='arial' color='black' size='2px'>*Jumlah Siswa : <?PHP echo $jumlah_siswa;?></center>
		<center>*Jumlah Siswa Pria: <?PHP echo $p;?></center>
		<center>*Jumlah Siswa Wanita: <?PHP echo $w;?></center><?PHP
}
?>
<br>
<center><a href="tampilan.php?page=12" style="text-decoration:none"><input type="submit" name="tambah" value="Tambah"></a></center>
</body>
</html>