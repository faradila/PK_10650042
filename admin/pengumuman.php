<?PHP
	include("../koneksi.php");
	include("../session.php");
	if($_SESSION['reg_level']!="admin") {
	header('location:../index.php');
	}
	
?>
<html>
<head></head>

<body>
<?php
	$dataPerHalaman_Pengumuman = 10;
		// apabila $_GET['Halaman_Pengumuman'] sudah didefinisikan, gunakan nomor Halaman_Pengumuman tersebut,
		// sedangkan apabila belum, nomor Halaman_Pengumumannya 1.
		if(isset($_GET['Halaman_Pengumuman']))
		{
			$noHalaman_Pengumuman = $_GET['Halaman_Pengumuman'];
		}
		else $noHalaman_Pengumuman = 1;
		
		// perhitungan offset
		$offset = ($noHalaman_Pengumuman - 1) * $dataPerHalaman_Pengumuman;
		
		// query SQL untuk menampilkan data perHalaman_Pengumuman sesuai offset
		$sql_select="select id_pengumuman, judul, nip_guru, objek, DATE_FORMAT(waktu, '%d-%m-%Y %H:%i:%s') as waktu, isi from pengumuman LIMIT $offset, $dataPerHalaman_Pengumuman";
		$query_select=mysql_query($sql_select);

	$jumlah = mysql_num_rows($query_select);
		echo "<div id = 'table_kecil'>";
		echo "<table cellpadding='8' cellspacing='0' border='1' align='center'>";
			echo "<tr bgcolor='#DCDCDC'>
					<th align='center' width='5'>No.</th>
					<th align='center'>Judul</th>
					<th align='center'>Pengirim</th>
					<th align='center'>Kepada</th>
					<th align='center'>Tanggal</th>
					<th align='center'>Pengumuman</th>
					<th align='center'>Aksi</th>
				</tr>";
			$i=0;
			while($data=mysql_fetch_array($query_select)){
			$i++;
					echo "<tr>";
					echo "<td align='left'>".$data['id_pengumuman']."</td>";
					echo "<td align='left'>".$data['judul']."</td>";
					$lihat=mysql_fetch_array(mysql_query("select * from guru where nip_guru = ".$data['nip_guru'].""));
					$nama = $lihat['nama_guru'];
					echo "<td align='left'>$nama</td>";
					echo "<td align='left'>".$data['objek']."</td>";
					echo "<td align='left'>".$data['waktu']."</td>";
					echo "<td align='left'>".$data['isi']."</td>";
					echo"<form method=\"POST\" action=\"action_pengumuman.php?id_pengumuman=".$data['id_pengumuman']."\">
					<input type=\"hidden\" value=\"".$data['id']."\" name=\"".$data['id']."\">
					<td align='center'>
					<input type=\"submit\" name=\"action\" value=\"Update\">
					<input type=\"submit\" name=\"action\" value=\"Delete\" onClick=\"return confirm('Apakah anda yakin menghapus data ini?')\">
					</form>
					</td>";
					echo "</tr>";
				
				}
		echo "</table>";
		echo "</div>";
		
		
		// mencari jumlah semua data dalam tabel pengumuman
		$query   = "SELECT COUNT(*) AS jumData FROM pengumuman";
		$hasil  = mysql_query($query);
		$data     = mysql_fetch_array($hasil);
		
		$jumData = $data['jumData'];
		
		// menentukan jumlah Halaman_Pengumuman yang muncul berdasarkan jumlah semua data
		$jumHalaman_Pengumuman = ceil($jumData/$dataPerHalaman_Pengumuman);
		
		// menampilkan link previous
		if ($noHalaman_Pengumuman > 1) echo  "<a href='tampilan.php?Halaman_Pengumuman=".($noHalaman_Pengumuman-1)."'>&lt;&lt; Prev</a>";
		
		// memunculkan nomor Halaman_Pengumuman dan linknya
		for($Halaman_Pengumuman = 1; $Halaman_Pengumuman <= $jumHalaman_Pengumuman; $Halaman_Pengumuman++)
		{
			if ((($Halaman_Pengumuman >= $noHalaman_Pengumuman - 3) && ($Halaman_Pengumuman <= $noHalaman_Pengumuman + 3)) || ($Halaman_Pengumuman == 1) || ($Halaman_Pengumuman == $jumHalaman_Pengumuman))
				{
				if (($showHalaman_Pengumuman == 1) && ($Halaman_Pengumuman != 2))  echo "...";
				if (($showHalaman_Pengumuman != ($jumHalaman_Pengumuman - 1)) && ($Halaman_Pengumuman == $jumHalaman_Pengumuman))  echo "...";
				if ($Halaman_Pengumuman == $noHalaman_Pengumuman) echo " <b>".$Halaman_Pengumuman."</b> ";
				else echo " <a href='tampilan.php?Halaman_Pengumuman=".$Halaman_Pengumuman."'>".$Halaman_Pengumuman."</a> ";
				$showHalaman_Pengumuman = $Halaman_Pengumuman;
				}
		}
		// menampilkan link next
		if ($noHalaman_Pengumuman < $jumHalaman_Pengumuman) echo "<a href='tampilan.php?Halaman_Pengumuman=".($noHalaman_Pengumuman+1)."'>Next &gt;&gt;</a>";

?>
<br><center>Jumlah Data : <?PHP echo $jumlah;?></center>
<br>
<center><a href="tampilan.php?page=20" style="text-decoration:none"><input type="submit" name="tambah" value="Tambah"></a></center>
</body>
</html>