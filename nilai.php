<?PHP
include("../koneksi.php");
include("../session.php");
include("reg_username.php");
?>
<html>
<head>
<script language="JavaScript" type="text/JavaScript">

  	 function showMapel()
		 {
		 <?php

		 // membaca semua kelas
		 $query = "SELECT DISTINCT kode_kelas FROM mengajar WHERE nip_guru = '$nip_guru'";
		 $hasil = mysql_query($query);

		 // membuat if untuk masing-masing pilihan kelas beserta isi option untuk combobox kedua
		 while ($data = mysql_fetch_array($hasil))
		 {
		   $kode_kelas = $data['kode_kelas'];

		   // membuat IF untuk masing-masing guru
		   echo "if (document.nilai.kelas.value == \"".$kode_kelas."\")";
		   echo "{";

		   // membuat option mapel untuk masing-masing kelas
		   $query2 = "SELECT DISTINCT kode_mapel FROM mengajar WHERE kode_kelas = '$kode_kelas' && nip_guru = '$nip_guru'";
		   $hasil2 = mysql_query($query2);
		   $content = "document.getElementById('mapel').innerHTML = \"";
		   while ($data2 = mysql_fetch_array($hasil2))
		   {
				$kode_mapel = $data2['kode_mapel'];
				$query = mysql_query("SELECT * FROM mapel WHERE kode_mapel = '$kode_mapel'");
				$tampil = mysql_fetch_array($query);
				$nama_mapel = $tampil['nama_mapel'];
				$content .= "<option value='".$data2['kode_mapel']."'>$nama_mapel</option>";
		   }
		   $content .= "\"";
		   echo $content;
		   echo "}\n";
		 }

		 ?>
		 }
</script>

</head>
<body>
<form name="nilai" method="post" enctype="multipart/form-data">
<table width="150" border="0" cellpadding="0" cellspacing="10"align =center>
<tr>
		<td><b>Kelas</b></td><td>:</td>
			<td width = "25">
			<select name="kelas"  onchange="showMapel()">
			<option value="">-------Pilih Kelas-----</option>";
			<?php
			$query = "SELECT DISTINCT kode_kelas FROM mengajar WHERE nip_guru = '$nip_guru'";
			$hasil = mysql_query($query);
			while ($data = mysql_fetch_array($hasil))
			{
			echo "<option value=".$data['kode_kelas'].">".$data['kode_kelas']."</option>";
			}

			?></select></td>
		<td><b>Mapel</b></td><td>:</td>
	      <td>
	      <select name="mapel" id="mapel">
	      </select>
	      </td>
		  <td>
		  <input type="submit" name="buka" value="buka ">
		  </td>
</tr>
</table>
</form>

<?php
if(isset($_POST['buka']))
{		
		$kelas=$_POST["kelas"];
		$mapel=$_POST["mapel"];
		
		if(empty($kelas) || empty($mapel)){
		echo "*Maaf Anda Belum Memilih Option Yang tersedia<br>";
		}
		else{
		echo "Kelas &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: $kelas<br>";
		echo "Kode Mapel &nbsp: $mapel<br><br>";
		
		echo "<form method=\"POST\" action=\"action_nilai.php\">";
		echo"<div id='table'>";
		echo "<table cellpadding='5' cellspacing='0' border='1' align='center'>";
		echo "<tr bgcolor='#DCDCDC'>
					<th align='center'>NIS</th>
					<th align='center'>Nama Siswa</th>
					<th align='center'>Nama Mapel</th>
					<th align='center'>Kode_Kelas</th>
					<th align='center'>Nilai</th>
					<th align='center'>Saran</th>
				</tr>";
			$buka= mysql_query("select * from nilai where kode_mapel = '$mapel' && kode_kelas = '$kelas'");
			$jum_nilai = mysql_num_rows($buka);
			
			if($jum_nilai == 0)
			{
			$buka= mysql_query("select * from siswa where kode_kelas = '$kelas'");
			$no = 1;
			while($data=mysql_fetch_array($buka)){
					$nis = $data['nis'];
					$nama = $data['nama'];
					$tampil=(mysql_fetch_array(mysql_query("select * from mapel where kode_mapel = '$mapel'")));
					$nama_mapel = $tampil['nama_mapel'];
					echo "<tr>";
					echo "<td align='center'>$nis<input type='hidden' name='nis".$no."' value='$nis'></td>"; 
					echo "<td align='center'>$nama</td>";
					echo "<td align='center'>$nama_mapel</td>";
					echo "<td align='center'>$kelas</td>";
					echo "<td><input type='text' name='nilai".$no."' size=3></td>";
					echo "<td><input type='text' name='saran".$no."' size=43></td>";
					$no++;
					}
			echo "</table>";
			echo "</div>";
			$jumMhs = $no - 1;
			?>
			<input type='hidden' name="jumMhs" value="<?PHP echo $jumMhs?>">
			<input type='hidden' name="kelas" value="<?PHP echo $kelas?>">
			<input type='hidden' name="mapel" value="<?PHP echo $mapel?>">
			<br>
			<center><input type="submit" name="action" value="Insert">
			</center>
			</form>
			<?PHP
			}
			else{
			$buka= mysql_query("select * from nilai where kode_kelas = '$kelas' and kode_mapel = '$mapel'");
			$no = 1;
			while($data=mysql_fetch_array($buka)){
					$nis = $data['nis'];
					$lihat_nama=(mysql_fetch_array(mysql_query("select * from siswa where nis = '$nis'")));
					$nama = $lihat_nama['nama'];
					$tampil=(mysql_fetch_array(mysql_query("select * from mapel where kode_mapel = '$mapel'")));
					$nama_mapel = $tampil['nama_mapel'];
					$nilai = $data['nilai'];
					$saran = $data['saran_guru'];
					echo "<tr>";
					echo "<td align='center'>$nis<input type='hidden' name='nis".$no."' value='$nis'></td>"; 
					echo "<td align='center'>$nama</td>";
					echo "<td align='center'>$nama_mapel</td>";
					echo "<td align='center'>$kelas</td>";
					echo "<td><input type='text' name='nilai".$no."' value='$nilai' size=3></td>";
					echo "<td><input type='text' name='saran".$no."' value='$saran' size=43></td>";
					$no++;
					}
			echo "</table>";
			echo "</div>";
			$jumMhs = $no - 1;?>
			<input type='hidden' name="jumMhs" value="<?PHP echo $jumMhs?>">
			<input type='hidden' name="kelas" value="<?PHP echo $kelas?>">
			<input type='hidden' name="mapel" value="<?PHP echo $mapel?>">
			<br>
			<center><input type="submit" name="action" value="Update">
			<input type="submit" name="action" value="Delete">
			</center>
			</form>
			<?PHP
			}
		}
}
?>
</body>
</html>
