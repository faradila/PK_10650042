<?PHP
	include("../koneksi.php");
	include("../session.php");
	if($_SESSION['reg_level']!="admin") {
	header('location:../login.php');
	}
	
?>
<html>
<head></head>

<body>
<?php
	$dataPerHalaman_Mapel = 10;
		// apabila $_GET['Halaman_Mapel'] sudah didefinisikan, gunakan nomor Halaman_Mapel tersebut,
		// sedangkan apabila belum, nomor Halaman_Mapelnya 1.
		if(isset($_GET['Halaman_Mapel']))
		{
			$noHalaman_Mapel = $_GET['Halaman_Mapel'];
		}
		else $noHalaman_Mapel = 1;
		
		// perhitungan offset
		$offset = ($noHalaman_Mapel - 1) * $dataPerHalaman_Mapel;
		
		// query SQL untuk menampilkan data perHalaman_Mapel sesuai offset
		$sql_select="select * from mapel group by kode_mapel LIMIT $offset, $dataPerHalaman_Mapel";
		$query_select=mysql_query($sql_select);
		
	$jumlah = mysql_num_rows(mysql_query("select * from mapel"));
		echo "<table cellpadding='5' cellspacing='0' border='0' align='center' Nowrap>";
			echo "<tr bgcolor='#808080'>
					<th align='center'>Kode Mapel</th>
					<th align='center'>Nama Mapel</th>
					<th align='center' colspan='2'>Action</th>
				</tr>";
				$i=2;
			while($data=mysql_fetch_array($query_select)){
					$kode_mapel = $data['kode_mapel'];
					$nama_mapel = $data['nama_mapel'];
					if($i % 2 == 0){
						echo "<tr bgcolor='#7CFC00'>";
					}
					else{
						echo "<tr bgcolor='#DCDCDC'>";
					}
					echo "<td align='center'>$kode_mapel</td>"; 
					echo "<td align='center'>$nama_mapel</td>";
					echo"<form method=\"POST\" action=\"action_mapel.php?kode_mapel=$kode_mapel&nama_mapel=$nama_mapel\">
					<input type=\"hidden\" value=\"$kode_mapel\" name=\"$kode_mapel\">
					<td align='center'>
					<input type=\"submit\" name=\"action\" value=\"Update\"></td> 
					<td align='center'>
					<input type=\"submit\" name=\"action\" value=\"Delete\" onClick=\"return confirm('Apakah anda yakin menghapus data ini?')\">
					</form>
					</td>";
					echo "</tr>";
				$i++;
				}
		echo "</table>";
		
		
		// mencari jumlah semua data dalam tabel mapel
		$query   = "SELECT COUNT(*) AS jumData FROM mapel";
		$hasil  = mysql_query($query);
		$data     = mysql_fetch_array($hasil);
		
		$jumData = $data['jumData'];
		
		// menentukan jumlah Halaman_Mapel yang muncul berdasarkan jumlah semua data
		$jumHalaman_Mapel = ceil($jumData/$dataPerHalaman_Mapel);
		
		// menampilkan link previous
		if ($noHalaman_Mapel > 1) echo  "<a href='tampilan.php?Halaman_Mapel=".($noHalaman_Mapel-1)."'>&lt;&lt; Prev</a>";
		
		// memunculkan nomor Halaman_Mapel dan linknya
		for($Halaman_Mapel = 1; $Halaman_Mapel <= $jumHalaman_Mapel; $Halaman_Mapel++)
		{
			if ((($Halaman_Mapel >= $noHalaman_Mapel - 3) && ($Halaman_Mapel <= $noHalaman_Mapel + 3)) || ($Halaman_Mapel == 1) || ($Halaman_Mapel == $jumHalaman_Mapel))
				{
				if (($showHalaman_Mapel == 1) && ($Halaman_Mapel != 2))  echo "...";
				if (($showHalaman_Mapel != ($jumHalaman_Mapel - 1)) && ($Halaman_Mapel == $jumHalaman_Mapel))  echo "...";
				if ($Halaman_Mapel == $noHalaman_Mapel) echo " <b>".$Halaman_Mapel."</b> ";
				else echo " <a href='tampilan.php?Halaman_Mapel=".$Halaman_Mapel."'>".$Halaman_Mapel."</a> ";
				$showHalaman_Mapel = $Halaman_Mapel;
				}
		}
		// menampilkan link next
		if ($noHalaman_Mapel < $jumHalaman_Mapel) echo "<a href='tampilan.php?Halaman_Mapel=".($noHalaman_Mapel+1)."'>Next &gt;&gt;</a>";

?>
<br><center>Jumlah Mata Pelajaran : <?PHP echo $jumlah;?></center>
<br>
<center><a href="tampilan.php?page=10" style="text-decoration:none"><input type="submit" name="tambah" value="Tambah"></a></center>
</body>
</html>