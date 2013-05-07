<?PHP
  include("../koneksi.php");
	include("../session.php");
?>
<html>
<head>
</head>
<body>
<?php
	$dataPerHalaman_Pengumuman = 2;
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
		$sql_select="select * from pengumuman order by id_pengumuman desc LIMIT $offset, $dataPerHalaman_Pengumuman";
		$query_select=mysql_query($sql_select);
		$jumlah = mysql_num_rows($query_select);
		
		//Membuat Nomor
		$i = ($noHalaman_Pengumuman-1)*$dataPerHalaman_Pengumuman + 1;
		
	echo "<div id='table_kecil'>";
		echo "<table cellpadding='3' cellspacing='0' border='1' align='center'>";
			echo "<tr bgcolor='#DCDCDC' height='30px'>
					<th align='center'width=10px>No.</th>
					<th align='center'width=90px>Pengirim</th>
					<th align='center' width=90px>Kepada</th>
					<th align='center'width=150px>Judul</th>
					<th align='center'width=250px>Pengumuman</th>
					<th align='center'width=50px>Waktu</th>
					<th align='center'width=50px>Action</th>
				</tr>";
			while($data=mysql_fetch_array($query_select)){
					$id = $data['id_pengumuman'];
					$nip = $data['nip_guru'];
					$tampil = mysql_fetch_array(mysql_query("select * from guru where nip_guru = '$nip'"));
					$nama = $tampil['nama_guru'];
					echo "<tr> <font size='2px'>";
					echo "<td align='left'>".$i."</td>"; 
					echo "<td align='left'><font face = times new roman size=3>$nama</font></td>";
					echo "<td align='left'><font face = times new roman size=3>".$data['objek']."</font></td>";
					echo "<td align='left'><font face = times new roman size=3>".$data['judul']."</font></td>";
					echo "<td align='left'><font face = times new roman size=3>".$data['isi']."</font></td>";
					echo "<td align='left'><font face = times new roman size=3>".$data['waktu']."</font></td>";
					echo "<form method=\"POST\" action=\"action_pengumuman.php?id_pengumuman=$id\">
					<input type=\"hidden\" value=\"$nip\" name=\"nip\">
					<td align='center'>
					<input type=\"submit\" name=\"action\" value=\"Update\">
					<input type=\"submit\" name=\"action\" value=\"Delete\" onClick=\"return confirm('Apakah anda yakin menghapus data ini?')\">
					</form>
					</td>";
					echo "</tr>";
					$i++;
				}
		echo "</table>";
		echo "</div>";
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
</body>
</html>
