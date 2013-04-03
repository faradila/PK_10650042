<?PHP
	include("../koneksi.php");
	include("../session.php");
	include("reg_username.php");
	
	if($_SESSION['reg_level']!="admin") {
	header('location:../login.php');
	}
	if(isset($_GET['del']))
	{
	   $query = "delete FROM tugas WHERE id_tugas = {$_GET['del']}";
	   mysql_query($query) or die('Mr.SQL Said : ' . mysql_error());
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=6\">";
		$hasil = mysql_query("select * from tugas order by id_tugas");
			$no = 1;
			while ($tampil = mysql_fetch_array($hasil)){
				$id_tampil = $tampil['id_tugas'];
				mysql_query("update tugas set id_tugas = $no where id_tugas = '$id_tampil'");
				$no ++;
			}
			mysql_query("alter table tugas auto_increment = $no");
		exit;
	}
?>
<html>
<head></head>
<script language="JavaScript">
		function del(no)
		{
		   if (confirm("Yakin mau menghapus ?"))
		   {
		      window.location.href = 'tampilan.php?page=6&del=' + no;
		   }
		}
</script>
<body>
<?php
	$dataPerHalaman_Tugas = 10;
		// apabila $_GET['Halaman_Tugas'] sudah didefinisikan, gunakan nomor Halaman_Tugas tersebut,
		// sedangkan apabila belum, nomor Halaman_Tugasnya 1.
		if(isset($_GET['Halaman_Tugas']))
		{
			$noHalaman_Tugas = $_GET['Halaman_Tugas'];
		}
		else $noHalaman_Tugas = 1;
		
		// perhitungan offset
		$offset = ($noHalaman_Tugas - 1) * $dataPerHalaman_Tugas;
		
		// query SQL untuk menampilkan data perHalaman_Tugas sesuai offset
		$sql_select="select id_tugas, judul, nama_file, size, jenis_tugas, nip_guru, kode_kelas, kode_mapel, ket, DATE_FORMAT(tanggal, '%d-%m-%Y') as tanggal from tugas LIMIT $offset, $dataPerHalaman_Tugas";
		$query_select=mysql_query($sql_select);
	
	$jumlah = mysql_num_rows($query_select);
	echo "<div id='table_kecil'>";
		echo "<table cellpadding='3' cellspacing='0' border='1' align='center' width='800px'>";
			echo "<tr bgcolor='#DCDCDC'>
					<th align='center'>No.</th>
					<th align='center'>Judul</th>
					<th align='center'>Size</th>
					<th align='center'>Jenis Tugas</th>
					<th align='center'>Nama Guru</th>
					<th align='center'>Kode Kelas</th>
					<th align='center'>Nama Mapel</th>
					<th align='center'>Tanggal Upload</th>
					<th align='center'>Keterangan</th>
					<th align='center'>Aksi</th>
				</tr>";
			$i=0;
			while($data=mysql_fetch_array($query_select)){
			$i++;
					echo "<tr>";
					echo "<td align='center'>".$data['id_tugas']."</td>";
					echo "<td align='center'>".$data['judul']."</td>";
					echo "<td align='center'>".$data['size']."</td>";
					echo "<td align='center'>".$data['jenis_tugas']."</td>";
					$query_tampil=mysql_query("select * from guru where nip_guru = ".$data['nip_guru']."");
					$tampil1 = mysql_fetch_array($query_tampil) or die (mysql_error());
					$nama_guru = $tampil1['nama_guru'];
					echo "<td align='center'>$nama_guru</td>";
					echo "<td align='center'>".$data['kode_kelas']."</td>";
					$kode_mapel = $data['kode_mapel'];
					$query_tampil2=mysql_query("select * from mapel where kode_mapel = '$kode_mapel'");
					$tampil2 = mysql_fetch_array($query_tampil2) or die (mysql_error());
					$nama_mapel = $tampil2['nama_mapel'];
					echo "<td align='center'>$nama_mapel</td>";
					echo "<td align='center'>".$data['tanggal']."</td>";
					echo "<td align='center'>".$data['ket']."</td>";
					echo"<form method=\"POST\" action=\"action_tugas.php?id_tugas=".$data['id_tugas']."\">
					<td align='center'>
					<input type=\"submit\" name=\"action\" value=\"Update\"></form>
					<a href=javascript:del('$data[0]'); text-decoration:none><img src='../images/delete.png'></a></td>";
					echo "</tr>";
				
				}
		echo "</table>";
		echo "</div>";
		
		// mencari jumlah semua data dalam tabel tugas
		$query   = "SELECT COUNT(*) AS jumData FROM tugas";
		$hasil  = mysql_query($query);
		$data     = mysql_fetch_array($hasil);
		
		$jumData = $data['jumData'];
		
		// menentukan jumlah Halaman_Tugas yang muncul berdasarkan jumlah semua data
		$jumHalaman_Tugas = ceil($jumData/$dataPerHalaman_Tugas);
		
		// menampilkan link previous
		if ($noHalaman_Tugas > 1) echo  "<a href='tampilan.php?Halaman_Tugas=".($noHalaman_Tugas-1)."'>&lt;&lt; Prev</a>";
		
		// memunculkan nomor Halaman_Tugas dan linknya
		for($Halaman_Tugas = 1; $Halaman_Tugas <= $jumHalaman_Tugas; $Halaman_Tugas++)
		{
			if ((($Halaman_Tugas >= $noHalaman_Tugas - 3) && ($Halaman_Tugas <= $noHalaman_Tugas + 3)) || ($Halaman_Tugas == 1) || ($Halaman_Tugas == $jumHalaman_Tugas))
				{
				if (($showHalaman_Tugas == 1) && ($Halaman_Tugas != 2))  echo "...";
				if (($showHalaman_Tugas != ($jumHalaman_Tugas - 1)) && ($Halaman_Tugas == $jumHalaman_Tugas))  echo "...";
				if ($Halaman_Tugas == $noHalaman_Tugas) echo " <b>".$Halaman_Tugas."</b> ";
				else echo " <a href='tampilan.php?Halaman_Tugas=".$Halaman_Tugas."'>".$Halaman_Tugas."</a> ";
				$showHalaman_Tugas = $Halaman_Tugas;
				}
		}
		// menampilkan link next
		if ($noHalaman_Tugas < $jumHalaman_Tugas) echo "<a href='tampilan.php?Halaman_Tugas=".($noHalaman_Tugas+1)."'>Next &gt;&gt;</a>";

?>
<br><center>Jumlah Tugas : <?PHP echo $jumlah;?></center>
<br>
<center><a href="tampilan.php?page=14" style="text-decoration:none"><input type="submit" name="tambah" value="Tambah"></a></center>
</body>
</html>