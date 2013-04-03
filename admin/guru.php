<?PHP
	include("../koneksi.php");
	include("../session.php");

		$dataPerHalaman = 10;
		// apabila $_GET['halaman'] sudah didefinisikan, gunakan nomor halaman tersebut,
		// sedangkan apabila belum, nomor halamannya 1.
		if(isset($_GET['halaman']))
		{
			$noHalaman = $_GET['halaman'];
		}
		else $noHalaman = 1;
		
		// perhitungan offset
		$offset = ($noHalaman - 1) * $dataPerHalaman;
		
		// query SQL untuk menampilkan data perhalaman sesuai offset
		$sql_select="select * from guru LIMIT $offset, $dataPerHalaman";
		$query_select=mysql_query($sql_select);
?>
<html>
<head></head>

<body>
<?php
	$jumlah = mysql_num_rows($query_select);
		echo "<table cellpadding='5' cellspacing='0' border='0' align='center' width='800'>";
			echo "<tr bgcolor='#808080'>
					<th align='center'>NIP</th>
					<th align='center'>Nama Guru</th>
					<th align='center'>JK</th>
					<th align='center'>Username</th>
					<th align='center'>Password</th>
					<th align='center'>Aksi</th>
				</tr>";
			while($data=mysql_fetch_array($query_select)){
					$nip_guru = $data['nip_guru'];
					$nama_guru = $data['nama_guru'];
					$username = $data['username'];
					$jk = $data['jk'];
					$password = $data['password'];

					if ($jk == "p"){
					$jenis_kelamin = 'Pria';
					echo "<tr bgcolor= #A9A9A9>";}
					if ($jk == "w"){
					$jenis_kelamin = 'Wanita';
					echo "<tr bgcolor=#9932CC>";}
					
					echo "<td align='center'>$nip_guru</td>"; 
					echo "<td align='center'>$nama_guru</td>";
					echo "<td align='center'>$jenis_kelamin</td>";
					echo "<td align='center'>$username</td>";
					echo "<td align='center'>$password</td>";
					echo"<form method=\"POST\" action=\"action_guru.php?nip_guru=$nip_guru&nama_guru=$nama_guru\">
					<input type=\"hidden\" value=\"$username\" name=\"username\">
					<td align='center'>
					<input type=\"submit\" name=\"action\" value=\"Update\">
					<input type=\"submit\" name=\"action\" value=\"Delete\" onClick=\"return confirm('Apakah anda yakin menghapus data ini?')\">
					</form>
					</td>";
					echo "</tr>";
				
				}
		echo "</table>";
		
		// mencari jumlah semua data dalam tabel Guru
		$query   = "SELECT COUNT(*) AS jumData FROM guru";
		$hasil  = mysql_query($query);
		$data     = mysql_fetch_array($hasil);
		
		$jumData = $data['jumData'];
		
		// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
		$jumHalaman = ceil($jumData/$dataPerHalaman);
		
		// menampilkan link previous
		if ($noHalaman > 1) echo  "<a href='tampilan.php?halaman=".($noHalaman-1)."'>&lt;&lt; Prev</a>";
		
		// memunculkan nomor halaman dan linknya
		for($halaman = 1; $halaman <= $jumHalaman; $halaman++)
		{
			if ((($halaman >= $noHalaman - 3) && ($halaman <= $noHalaman + 3)) || ($halaman == 1) || ($halaman == $jumHalaman))
				{
				if (($showHalaman == 1) && ($halaman != 2))  echo "...";
				if (($showHalaman != ($jumHalaman - 1)) && ($halaman == $jumHalaman))  echo "...";
				if ($halaman == $noHalaman) echo " <b>".$halaman."</b> ";
				else echo " <a href='tampilan.php?halaman=".$halaman."'>".$halaman."</a> ";
				$showHalaman = $halaman;
				}
		}
		// menampilkan link next
		if ($noHalaman < $jumHalaman) echo "<a href='tampilan.php?halaman=".($noHalaman+1)."'>Next &gt;&gt;</a>";

?>
<br><center>Jumlah Data : <?PHP echo $jumlah;?></center>
<br>
<center><a href="tampilan.php?page=11" style="text-decoration:none"><input type="submit" name="tambah" value="Tambah"></a></center>
</body>
</html>