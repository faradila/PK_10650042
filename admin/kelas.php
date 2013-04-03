<?PHP
	include("../koneksi.php");
	include("../session.php");	
?>
<html>
<head>
</head>
<body>
<?php

	$sql_select="select * from kelas order by kode_kelas asc";
	$query_select=mysql_query($sql_select);
	$jumlah = mysql_num_rows($query_select);
		echo "<table cellpadding='5' cellspacing='0' border='0' align='center'>";
			echo "<tr bgcolor='#808080'>
					<td align='center'><font face='times new roman' size='4px'><b>Kode Kelas</td>
					<td align='center'><font face='times new roman' size='4px'><b>Nama Kelas</td>
					<td align='center'><font face='times new roman' size='4px'><b>Action</td>
				</tr>";
				$i = 2;
			while($data=mysql_fetch_array($query_select)){
					$kode_kelas = $data['kode_kelas'];
					$nama_kelas = $data['nama_kelas'];
					if($i % 2 == 0){
						echo "<tr bgcolor='#7CFC00'>";
					}
					else{
						echo "<tr bgcolor='#DCDCDC'>";
					}
					echo "<td align='center'>$kode_kelas</td>"; 
					echo "<td align='center'>$nama_kelas</td>";
					echo "<form method=\"POST\" action=\"action_kelas.php?kode_kelas=$kode_kelas\"><input type=\"hidden\" value=\"$kode_kelas\" name=\"$kode_kelas\">
					<td align='center'>
					<input type=\"submit\" name=\"action\" value=\"Update\">
					<input type=\"submit\" name=\"action\" value=\"Delete\" onClick=\"return confirm('Apakah anda yakin menghapus data ini?')\">
					</form>
					</td>";
					echo "</tr>";
				$i++;
				}
		echo "</table><br>";
?>
<br>
<center>Jumlah Kelas : <?PHP echo $jumlah;?></center>
<br>
<center><a href="tampilan.php?page=9" style="text-decoration:none"><input type="submit" name="tambah" value="Tambah"></a></center>
</body>
</html>