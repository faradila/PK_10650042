<?PHP
  include("../koneksi.php");
	include("../session.php");
	include("reg_username.php");
	if(isset($_GET['del']))
	{
	   $query = "delete FROM tugas WHERE id_tugas = {$_GET['del']}";
	   mysql_query($query) or die('Mr.SQL Said : ' . mysql_error());
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=4\">";
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
		      window.location.href = 'tampilan.php?page=4&del=' + no;
		   }
		}
</script>
<body>
<?php
	$sql_select="select * from tugas where nip_guru='$nip_guru' order by tanggal desc";
	$query_select=mysql_query($sql_select);
	$jumlah = mysql_num_rows($query_select);
	echo "<div id='table_kecil'>";
		echo "<table cellpadding='3' cellspacing='0' border='1' align='center'>";
			echo "<tr bgcolor='#DCDCDC'>
					<th align='center'>No.</th>
					<th align='center'>Judul</th>
					<th align='center'>Name File</th>
					<th align='center'>Jenis Tugas</th>
					<th align='center'>Kode Kelas</th>
					<th align='center'>Nama Mapel</th>
					<th align='center'>Waktu Upload</th>
					<th align='center'>Keterangan</th>
					<th align='center'>Aksi</th>
				</tr>";
			$i=0;
			while($data=mysql_fetch_array($query_select)){
			$i++;
					echo "<tr>";
					echo "<td align='center'>".$i."</td>";
					echo "<td align='center'>".$data['judul']."</td>";
					echo "<td align='center'>".$data['nama_file']."</td>";
					echo "<td align='center'>".$data['jenis_tugas']."</td>";
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
?>
<br><center>Jumlah Data : <?PHP echo $jumlah;?></center>
<br>
<center><a href="tampilan.php?page=14" style="text-decoration:none"><input type="submit" name="tambah" value="Tambah"></a></center>
</body>
</html>
