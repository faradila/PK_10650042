<?PHP
include("../koneksi.php");
include("../session.php");
if($_SESSION['reg_level']!="admin") {
header('location:../index.php');
}
?>
<html>
<head>
</head>
<body>
<form name="nilai" method="post" enctype="multipart/form-data">
<table border="0" cellpadding="0" cellspacing="10" align='center'>
<tr>
		<td><b>Pilih Tabel</b></td><td>:</td>
		<td>
			<select name="tabel">
			<option value="">-------Pilih Tabel-----</option>";
			<option value="siswa">Siswa</option>";
			<option value="nilai">Nilai</option>";
			<option value="guru">Guru</option>";
			<option value="upload">Upload</option>";
			<option value="tugas">Tugas</option>";
			</select></td>
		  <td>
		  <input type="submit" name="buka" value="buka ">
		  </td>
</tr>
</table>
</form>

<?php
if(isset($_POST['buka']))
{		
		$tabel=$_POST["tabel"];
		
		echo "<b>$tabel</b><br>";
if($tabel=="siswa" || $tabel=="nilai"){
		$data = ucwords($tabel);
		echo "<br><center><font face='black' size='5px' color='green'>Cari Data $data </font><br>";
		echo "Pilih Kategori Pencarian</center><br>";
		
		echo "<form method=\"POST\" action=\"tampilan.php?page=22\">";
		echo "<div id='table' align='center'>";
		echo "<table>";
		?>
			<tr><td><input type="checkbox" name="nisCat"> NIS</td><td><input type="text" name="nis"></td></tr>
				<?PHP 
				if($tabel=="siswa"){?>
			<tr><td><input type="checkbox" name="namaCat"> Nama Siswa</td><td><input type="text" name="nama"></td></tr>
				<?PHP } ?>
			<tr><td><input type="checkbox" name="kelasCat"> Kelas</td>
					<td>
					<select name="kelas">
					<option value="">-------Pilih Kelas-----</option>";
					<?php
					$query = "SELECT * FROM kelas";
					$hasil = mysql_query($query);
					while ($data = mysql_fetch_array($hasil))
					{
					echo "<option value=".$data['kode_kelas'].">".$data['kode_kelas']."</option>";
					}
					?></select></td>
			</tr>
			<?PHP 
			if($tabel=="nilai"){
			echo "<input type='hidden' name='tabel' value='nilai'>";
					echo "<tr><td><input type='checkbox' name='mapelCat'> Mapel </td>";
					?>
					<td>
						<select name="mapel">
						<option value="">-------Pilih MaPel-----</option>";
						<?php
						$query = "SELECT * FROM mapel";
						$hasil = mysql_query($query);
						while ($data = mysql_fetch_array($hasil))
						{
						echo "<option value=".$data['kode_mapel'].">".$data['nama_mapel']."</option>";
						}
						?></select></td></tr>
					<?PHP
			}
			if($tabel=="siswa"){
				echo "<input type='hidden' name='tabel' value='siswa'>";
				echo "<tr><td><input type='checkbox' name='jkCat'> Jenis Kelamin</td><td><input type='radio' name='jk' value='p'> Laki-Laki <input type='radio' name='jk' value='w'> Perempuan</td></tr>";
			}
			?>
			<tr><td></td><td><input type="submit" name="submit" value="Submit"></td></tr>
		</table>
		</form>
		</div>
<?PHP }
if($tabel=="mengajar" || $tabel=="tugas" ||$tabel=="upload" || $tabel=="guru"){
		$data = ucwords($tabel);
		echo "<br><center><font face='black' size='5px' color='green'>Cari Data $data</font><br>";
		echo "Pilih Kategori Pencarian</center><br>";
		
		echo "<form method=\"POST\" action=\"tampilan.php?page=22\">";
		echo "<div id='table' align='center'>";
		echo "<table>";
		?>
			<tr><td><input type="checkbox" name="nipCat"> NIP</td><td><input type="text" name="nip"></td></tr>
				<?PHP
				if($tabel=='mengajar'){
				echo "<input type='hidden' name='tabel' value='mengajar'>";
				?>
					<tr><td><input type='checkbox' name='mapelCat'> Mapel </td>
					<td>
						<select name="mapel">
						<option value="">-------Pilih MaPel-----</option>";
						<?php
						$query = "SELECT * FROM mapel";
						$hasil = mysql_query($query);
						while ($data = mysql_fetch_array($hasil))
						{
						echo "<option value=".$data['kode_mapel'].">".$data['nama_mapel']."</option>";
						}
						?></select></td>
					</tr>
					<tr><td><input type="checkbox" name="kelasCat"> Kelas</td>
							<td>
							<select name="kelas">
							<option value="">-------Pilih Kelas-----</option>";
							<?php
							$query = "SELECT * FROM kelas";
							$hasil = mysql_query($query);
							while ($data = mysql_fetch_array($hasil))
							{
							echo "<option value=".$data['kode_kelas'].">".$data['kode_kelas']."</option>";
							}
							?></select></td>
					</tr>
				<?PHP
				}
				if($tabel=='tugas'){
				echo "<input type='hidden' name='tabel' value='tugas'>";
				?>	
					<tr><td><input type='checkbox' name='mapelCat'> Mapel </td>
					<td>
						<select name="mapel">
						<option value="">-------Pilih MaPel-----</option>";
						<?php
						$query = "SELECT * FROM mapel";
						$hasil = mysql_query($query);
						while ($data = mysql_fetch_array($hasil))
						{
						echo "<option value=".$data['kode_mapel'].">".$data['nama_mapel']."</option>";
						}
						?></select></td>
					</tr>
					<tr><td><input type="checkbox" name="kelasCat"> Kelas</td>
							<td>
							<select name="kelas">
							<option value="">-------Pilih Kelas-----</option>";
							<?php
							$query = "SELECT * FROM kelas";
							$hasil = mysql_query($query);
							while ($data = mysql_fetch_array($hasil))
							{
							echo "<option value=".$data['kode_kelas'].">".$data['kode_kelas']."</option>";
							}
							?></select></td>
					</tr>
					<tr><td><input type="checkbox" name="jenis_tugasCat"> Jenis Tugas</td>
							<td><select name="jenis_tugas">
							<option value="">-------Pilih Jenis Tugas-----</option>";
							<option value="individu">Tugas Individu</option>
							<option value="kelompok">Tugas Kelompok</option>
							<option value="kelompok">Pekerjaan Rumah</option>
							</select></td>
					</tr>
				<?PHP
				}
				if($tabel=='upload'){
				echo "<input type='hidden' name='tabel' value='upload'>";
				?>
					<tr><td><input type='checkbox' name='mapelCat'> Mapel </td>
					<td>
						<select name="mapel">
						<option value="">-------Pilih MaPel-----</option>";
						<?php
						$query = "SELECT * FROM mapel";
						$hasil = mysql_query($query);
						while ($data = mysql_fetch_array($hasil))
						{
						echo "<option value=".$data['kode_mapel'].">".$data['nama_mapel']."</option>";
						}
						?></select></td>
					</tr>
					<tr><td><input type="checkbox" name="judulCat"> Judul</td><td><input type="text" name="judul"></td></tr>
				<?PHP
				}
				if($tabel=='guru'){
				echo "<input type='hidden' name='tabel' value='guru'>";
				echo"<tr><td><input type='checkbox' name='nama_guruCat'> Nama Guru</td><td><input type='text' name='nama_guru'></td></tr>";
				echo "<tr><td><input type='checkbox' name='jkCat'> Jenis Kelamin</td><td><input type='radio' name='jk' value='p'> Laki-Laki <input type='radio' name='jk' value='w'> Perempuan</td></tr>";
				}
				?>
			<tr><td></td><td><input type="submit" name="submit" value="Submit"></td></tr>
		</table>
		</form>
		</div>
		<?PHP }
if(empty($tabel)){
	echo "<br><b><font color='#FF0000'>*Maaf Anda Belum Memilih Option Pilih Tabel</font><br></b>";
	}
}
?>
</body>
</html>