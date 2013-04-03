<?PHP
	include("../koneksi.php");
	include("../session.php");	
?>
<html>
<head></head>
<body>
<?php
	$dataPerHalaman_Mengajar = 10;
		// apabila $_GET['Halaman_Mengajar'] sudah didefinisikan, gunakan nomor Halaman_Mengajar tersebut,
		// sedangkan apabila belum, nomor Halaman_Mengajarnya 1.
		if(isset($_GET['Halaman_Mengajar']))
		{
			$noHalaman_Mengajar = $_GET['Halaman_Mengajar'];
		}
		else $noHalaman_Mengajar = 1;
		
		// perhitungan offset
		$offset = ($noHalaman_Mengajar - 1) * $dataPerHalaman_Mengajar;
		
		// query SQL untuk menampilkan data perHalaman_Mengajar sesuai offset
		$sql_select="select * from guru order by nip_guru desc LIMIT $offset, $dataPerHalaman_Mengajar";
		$query_select=mysql_query($sql_select);
		
	$jumlah = mysql_num_rows($query_select);
		echo "<table cellpadding='5' cellspacing='0' border='1' align='center'>";
			echo "<tr bgcolor='#696969'>
					<th align='center'>NIP</th>
					<th align='center'>Nama Guru</th>
					<th align='center'>Jumlah Mapel</th>
					<th align='center'>Jumlah Kelas</th>
					<th align='center'>Lihat Data</th>
				</tr>";
			while($data=mysql_fetch_array($query_select)){
					$nip_guru = $data['nip_guru'];
					$nama_guru = $data['nama_guru'];
					$jk = $data['jk'];
					$jumlah = mysql_num_rows(mysql_query("select * from mengajar where nip_guru = '$nip_guru'"));
					$jumlah2 = mysql_num_rows(mysql_query("select distinct kode_mapel from mengajar where nip_guru = '$nip_guru'"));
					if ($jk == "p"){
					echo "<tr bgcolor= #DCDCDC>";}
					if ($jk == "w"){
					echo "<tr bgcolor= #008000>";}
					echo "<td align='center'>$nip_guru</td>"; 
					echo "<td align='center'>$nama_guru</td>";
					echo "<td align='center'>$jumlah2</td>";
					echo "<td align='center'>$jumlah</td>";
					echo "<form method=\"POST\">
					<input type=\"hidden\" value=\"$nip_guru\" name=\"nip_guru\">
					<input type=\"hidden\" value=\"$nama_guru\" name=\"nama_guru\">
					<input type=\"hidden\" value=\"$jumlah2\" name=\"jumlah2\">
					<td align='center'>
					<input type=\"submit\" name=\"action\" value=\"Lihat Data\"></td> 
					</form>";
					echo "</tr>";
				}
		echo "</table><br>";
		// mencari jumlah semua data dalam tabel guru
		$query   = "SELECT COUNT(*) AS jumData FROM guru";
		$hasil  = mysql_query($query);
		$data     = mysql_fetch_array($hasil);
		
		$jumData = $data['jumData'];
		
		// menentukan jumlah Halaman_Mengajar yang muncul berdasarkan jumlah semua data
		$jumHalaman_Mengajar = ceil($jumData/$dataPerHalaman_Mengajar);
		
		// menampilkan link previous
		if ($noHalaman_Mengajar > 1) echo  "<a href='tampilan.php?Halaman_Mengajar=".($noHalaman_Mengajar-1)."'>&lt;&lt; Prev</a>";
		
		// memunculkan nomor Halaman_Mengajar dan linknya
		for($Halaman_Mengajar = 1; $Halaman_Mengajar <= $jumHalaman_Mengajar; $Halaman_Mengajar++)
		{
			if ((($Halaman_Mengajar >= $noHalaman_Mengajar - 3) && ($Halaman_Mengajar <= $noHalaman_Mengajar + 3)) || ($Halaman_Mengajar == 1) || ($Halaman_Mengajar == $jumHalaman_Mengajar))
				{
				if (($showHalaman_Mengajar == 1) && ($Halaman_Mengajar != 2))  echo "...";
				if (($showHalaman_Mengajar != ($jumHalaman_Mengajar - 1)) && ($Halaman_Mengajar == $jumHalaman_Mengajar))  echo "...";
				if ($Halaman_Mengajar == $noHalaman_Mengajar) echo " <b>".$Halaman_Mengajar."</b> ";
				else echo " <a href='tampilan.php?Halaman_Mengajar=".$Halaman_Mengajar."'>".$Halaman_Mengajar."</a> ";
				$showHalaman_Mengajar = $Halaman_Mengajar;
				}
		}
		// menampilkan link next
		if ($noHalaman_Mengajar < $jumHalaman_Mengajar) echo "<a href='tampilan.php?Halaman_Mengajar=".($noHalaman_Mengajar+1)."'>Next &gt;&gt;</a>";
		?><center><a href="tampilan.php?page=18" style="text-decoration:none"><input type="submit" name="tambah" value="Tambah"></a></center>
		
<?PHP		
if($_POST['action'] == true){
	$nip = $_POST['nip_guru'];
	$nama = $_POST['nama_guru'];
	$jumlah2 = $_POST['jumlah2'];
	echo "<br><b><font size = 2px>
	NIP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: $nip <br>
	Nama &nbsp;: $nama
	</font></b>";
	if($jumlah2 != 0){
	$query_tampil=mysql_query("select distinct kode_mapel from mengajar where nip_guru = '$nip'");
		while($tampil = mysql_fetch_array($query_tampil)){
		$kode_mapel = $tampil['kode_mapel'];
		$n = mysql_fetch_array(mysql_query("select * from mapel where kode_mapel = '$kode_mapel'"));
		$nama_mapel = $n['nama_mapel'];
		echo "<b><center>
		Kode Mapel : $kode_mapel<br>
		Nama Mapel : $nama_mapel<br>
		</center></b>"; 
				$query_data = mysql_query("select * from mengajar where nip_guru = '$nip' and kode_mapel ='$kode_mapel'");
				$kolom = mysql_num_rows($query_data);
				echo "<table cellpadding='5' cellspacing='0' border='1' align='center'>";
				echo "<tr bgcolor='#DCDCDC'>
						<th align='center' colspan='$kolom'>Kode Kelas</th>
						<form method=\"POST\" action=\"action_mengajar.php?nip_guru=$nip\">
						<input type='hidden' name='mapel' value='$kode_mapel'>
						<th align='center' rowspan=2 width='5px'>
						<input type=\"submit\" name=\"action\" value=\"Update\">
						<input type=\"submit\" name=\"action\" value=\"Hapus\" onClick=\"return confirm('Apakah anda yakin menghapus data ini?')\">
						</th></form>
					</tr>";
				while($data = mysql_fetch_array($query_data)){
						$kode = $data['kode_kelas'];
						echo "<td align='center' bgcolor=#ADE8E6>$kode</td>";
						}
		echo "</tr>";
		echo "</table>";
		echo "<br>";
			}
		}
		else{
		echo "<br><b>Kelas Dan Mata Pelajaran Masih Kosong</b><br>";
}
}
else{
echo "<br><b>Belum Ada Proses</b><br>";
}
?>
<br>
</body>
</html>