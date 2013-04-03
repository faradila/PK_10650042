<?PHP
	include("../koneksi.php");
	include("../session.php");
	if($_SESSION['reg_level']!="admin") {
	header('location:../login.php');
	}
	if(isset($_GET['del']))
	{
	   $query = "delete FROM upload WHERE id_materi = {$_GET['del']}";
	   mysql_query($query) or die('Mr.SQL Said : ' . mysql_error());
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=5\">";
			$hasil = mysql_query("select * from upload order by id_materi");
			$no = 1;
			while ($tampil = mysql_fetch_array($hasil)){
				$id_tampil = $tampil['id_materi'];
				mysql_query("update upload set id_materi = $no where id_materi = '$id_tampil'");
				$no ++;
			}
			mysql_query("alter table upload auto_increment = $no");
		exit;
	}
?>
<html>
<head></head>
<script language="JavaScript">
		function del(no)
		{
		   if (confirm("Yakin akan menghapus ?"))
		   {
		      window.location.href = 'tampilan.php?page=5&del=' + no;
		   }
		}
</script>
<body>
<?php
		$dataPerHalaman_Upload_Mapel = 10;
		// apabila $_GET['Halaman_Upload_Mapel'] sudah didefinisikan, gunakan nomor Halaman_Upload_Mapel tersebut,
		// sedangkan apabila belum, nomor Halaman_Upload_Mapelnya 1.
		if(isset($_GET['Halaman_Upload_Mapel']))
		{
			$noHalaman_Upload_Mapel = $_GET['Halaman_Upload_Mapel'];
		}
		else $noHalaman_Upload_Mapel = 1;
		
		// perhitungan offset
		$offset = ($noHalaman_Upload_Mapel - 1) * $dataPerHalaman_Upload_Mapel;
		
		// query SQL untuk menampilkan data perHalaman_Upload_Mapel sesuai offset
		$sql_select="select upload.id_materi, upload.nama_file, upload.size, upload.judul, 
					guru.nama_guru, mapel.nama_mapel, DATE_FORMAT(upload.tanggal, '%d %M %Y %H:%i:%s') as tanggal
					from upload, mapel, guru
					where upload.kode_mapel = mapel.kode_mapel
					and guru.nip_guru = upload.nip_guru
					LIMIT $offset, $dataPerHalaman_Upload_Mapel";
		$query_select=mysql_query($sql_select);
	$jumlah=1;
	$jumlah = mysql_num_rows($query_select);
		echo "<div id='table'>";
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
			while($data=mysql_fetch_array($query_select)){
			$i++;
					echo "<tr>";
					echo "<td align='center'>".$data['id_materi']."</td>";
					echo "<td align='center'>".$data['nama_file']."</td>";
					echo "<td align='center'>".$data['size']."</td>";
					echo "<td align='center'>".$data['judul']."</td>";
					echo "<td align='center'>".$data['nama_guru']."</td>";
					echo "<td align='center'>".$data['nama_mapel']."</td>";
					echo "<td align='center'>".$data['tanggal']."</td>";
					echo "<form method=\"POST\" action=\"action_upload_mapel.php?id_materi=".$data['id_materi']."\">
					<td align='center' width = '50'>
					<input type=\"submit\" name=\"action\" value=\"Update\">
					</form>
					<a href=javascript:del('$data[0]');><img src='../images/delete.png'></a></td>";
					echo "</tr>";
				
				}
		echo "</table>";
		echo "</div>";
		
		// mencari jumlah semua data dalam tabel upload
		$query   = "SELECT COUNT(*) AS jumData FROM upload";
		$hasil  = mysql_query($query);
		$data     = mysql_fetch_array($hasil);
		
		$jumData = $data['jumData'];
		
		// menentukan jumlah Halaman_Upload_Mapel yang muncul berdasarkan jumlah semua data
		$jumHalaman_Upload_Mapel = ceil($jumData/$dataPerHalaman_Upload_Mapel);
		
		// menampilkan link previous
		if ($noHalaman_Upload_Mapel > 1) echo  "<a href='tampilan.php?Halaman_Upload_Mapel=".($noHalaman_Upload_Mapel-1)."'>&lt;&lt; Prev</a>";
		
		// memunculkan nomor Halaman_Upload_Mapel dan linknya
		for($Halaman_Upload_Mapel = 1; $Halaman_Upload_Mapel <= $jumHalaman_Upload_Mapel; $Halaman_Upload_Mapel++)
		{
			if ((($Halaman_Upload_Mapel >= $noHalaman_Upload_Mapel - 3) && ($Halaman_Upload_Mapel <= $noHalaman_Upload_Mapel + 3)) || ($Halaman_Upload_Mapel == 1) || ($Halaman_Upload_Mapel == $jumHalaman_Upload_Mapel))
				{
				if (($showHalaman_Upload_Mapel == 1) && ($Halaman_Upload_Mapel != 2))  echo "...";
				if (($showHalaman_Upload_Mapel != ($jumHalaman_Upload_Mapel - 1)) && ($Halaman_Upload_Mapel == $jumHalaman_Upload_Mapel))  echo "...";
				if ($Halaman_Upload_Mapel == $noHalaman_Upload_Mapel) echo " <b>".$Halaman_Upload_Mapel."</b> ";
				else echo " <a href='tampilan.php?Halaman_Upload_Mapel=".$Halaman_Upload_Mapel."'>".$Halaman_Upload_Mapel."</a> ";
				$showHalaman_Upload_Mapel = $Halaman_Upload_Mapel;
				}
		}
		// menampilkan link next
		if ($noHalaman_Upload_Mapel < $jumHalaman_Upload_Mapel) echo "<a href='tampilan.php?Halaman_Upload_Mapel=".($noHalaman_Upload_Mapel+1)."'>Next &gt;&gt;</a>";

?>
<br><center>Jumlah Data : <?PHP echo $jumlah;?></center>
<br>
<center><a href="tampilan.php?page=13" style="text-decoration:none"><input type="submit" name="tambah" value="Upload"></a></center>
</body>
</html>