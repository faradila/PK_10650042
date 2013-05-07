<?PHP
  include("../koneksi.php");
	include("../session.php");
	include("reg_username.php");
	if(isset($_GET['del']))
	{
	   $query = "delete FROM upload WHERE id_materi = {$_GET['del']}";
	   mysql_query($query) or die('Mr.SQL Said : ' . mysql_error());
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=3\">";
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
		   if (confirm("Yakin mau menghapus ?"))
		   {
		      window.location.href = 'tampilan.php?page=3&del=' + no;
		   }
		}
</script>
<body>
<?php
	$sql_select="select * from upload where nip_guru = '$nip_guru' order by tanggal desc";
	$query_select=mysql_query($sql_select);
	$jumlah = mysql_num_rows($query_select);
		echo "<div id='table_kecil'>";
		echo "<table cellpadding='4' cellspacing='0' border='0' align='center' width='800px'>";
			echo "<tr bgcolor='#556B2F'>
					<th align='center' width=10>No</th>
					<th align='center' width=70>Mapel</th>
					<th align='center' width=150>Judul</th>
					<th align='center' width=250>Name File</th>
					<th align='center' width=50>Waktu</th>
					<th align='center'>Aksi</th>
				</tr>";
			$i=1;
			$w=2;
			while($data=mysql_fetch_array($query_select)){
					if($w % 2 == 0){
						echo "<tr bgcolor='#ADE8E6'>";
					}
					else{
						echo "<tr bgcolor='#F0E68C'>";
					}
					echo "<td align='center'>".$i."</td>";
						$kode_mapel = $data['kode_mapel'];
						$sql = "select * from mapel where kode_mapel = '$kode_mapel'";
						$query = mysql_query($sql);
						$tampil = mysql_fetch_array($query);
						$nama_mapel = $tampil['nama_mapel'];
					echo "<td align='center'>$nama_mapel</td>";
					echo "<td align='center'>".$data['judul']."</td>";
					echo "<td align='center'>".$data['nama_file']."</td>";
					echo "<td align='center'>".$data['tanggal']."</td>";
					echo "<form method=\"POST\" action=\"action_upload_mapel.php?id_materi=".$data['id_materi']."&kode_mapel=$kode_mapel&judul=".$data['judul']."\">
					<td align='center' width = '50'>
					<input type=\"submit\" name=\"action\" value=\"Update\">
					</form>
					<a href=javascript:del('$data[0]');><img src='../images/delete.png'></a></td>";
					echo "</tr>";
				$i++;
				$w++;
				}
		echo "</table>";
		echo "</div>";
?>
<br><center>Jumlah Data : <?PHP echo $jumlah;?></center>
<br>
<center><a href="tampilan.php?page=13" style="text-decoration:none"><input type="submit" name="tambah" value="Upload"></a></center>
</body>
</html>
