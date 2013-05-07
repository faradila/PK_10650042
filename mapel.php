<?PHP
  include("../koneksi.php");
	include("../session.php");
?>
<html>
<head></head>

<body>
<?php
	$sql_select="select * from mapel order by kode_mapel desc";
	$query_select=mysql_query($sql_select);
	$jumlah = mysql_num_rows($query_select);
		echo "<table cellpadding='5' cellspacing='0' border='1' align='center' Nowrap>";
			echo "<tr bgcolor='#DCDCDC'>
					<th align='center'>Kode MaPel</th>
					<th align='center'>Nama MaPel</th>
					<th align='center'>Edit MaPel</th>
					<th align='center'>Delete MaPel</th>
				</tr>";
			while($data=mysql_fetch_array($query_select)){
					$kode_mapel = $data['kode_mapel'];
					$nama_mapel = $data['nama_mapel'];
					echo "<tr>";
					echo "<td align='center'>$kode_mapel</td>"; 
					echo "<td align='center'>$nama_mapel</td>";
					echo"<form method=\"POST\" action=\"action_mapel.php?kode_mapel=$kode_mapel\"><input type=\"hidden\" value=\"$kode_mapel\" name=\"$kode_mapel\">
					<td align='center'>
					<input type=\"submit\" name=\"action\" value=\"Update\"></td> 
					<td align='center'>
					<input type=\"submit\" name=\"action\" value=\"Delete\">
					</form>
					</td>";
					echo "</tr>";
				
				}
		echo "</table>";
?>
<br><center>Jumlah Data : <?PHP echo $jumlah;?></center>
<br>
<center><a href="tampilan.php?page=10" style="text-decoration:none"><input type="submit" name="tambah" value="Tambah"></a></center>
</body>
</html>
