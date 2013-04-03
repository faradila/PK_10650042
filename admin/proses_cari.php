<?PHP
	include("../koneksi.php");
	include("../session.php");	
?>

<html>
<body>
<?PHP
$bagianWhere = "";
$tabel = $_POST['tabel'];
echo "<b>$tabel</b><br>";

if (isset($_POST['nisCat']))
{
   $nis = $_POST['nis'];
   if (empty($bagianWhere))
   {
        $bagianWhere .= "nis LIKE '%$nis%'";
   }
   else
   {
        $bagianWhere .= " AND nis LIKE '%$nis%'";
   }
}

elseif (isset($_POST['namaCat']))
{
   $nama = $_POST['nama'];
   if (empty($bagianWhere))
   {
        $bagianWhere .= "nama LIKE '%$nama%'";
   }
   else
   {
        $bagianWhere .= " AND nama LIKE '%$nama%'";
   }
}

elseif (isset($_POST['kelasCat']))
{
   $kelas = $_POST['kelas'];
   if (empty($bagianWhere))
   {
        $bagianWhere .= "kode_kelas LIKE '%$kelas%'";
   }
   else
   {
        $bagianWhere .= " AND kode_kelas = '$kelas'";
   }
}

elseif (isset($_POST['judulCat']))
{
   $judul = $_POST['judul'];
   if (empty($bagianWhere))
   {
        $bagianWhere .= "judul LIKE '%$judul%'";
   }
   else
   {
        $bagianWhere .= " AND judul LIKE '%$judul%'";
   }
}

elseif (isset($_POST['mapelCat']))
{
   $mapel = $_POST['mapel'];
   if (empty($bagianWhere))
   {
        $bagianWhere .= "kode_mapel LIKE '%$mapel%'";
   }
   else
   {
        $bagianWhere .= " AND kode_mapel LIKE '%$mapel%'";
   }
}

elseif (isset($_POST['nipCat']))
{
   $nip = $_POST['nip'];
   if (empty($bagianWhere))
   {
        $bagianWhere .= "nip_guru LIKE '%$nip%'";
   }
   else
   {
        $bagianWhere .= " AND nip_guru LIKE '%$nip%'";
   }
}

elseif (isset($_POST['nama_guruCat']))
{
   $nama_guru = $_POST['nama_guru'];
   if (empty($bagianWhere))
   {
        $bagianWhere .= "nama_guru LIKE '%$nama_guru%'";
   }
   else
   {
        $bagianWhere .= " AND nama_guru LIKE '%$nama_guru%'";
   }
}

elseif (isset($_POST['jkCat']))
{
   $jk = $_POST['jk'];
   if (empty($bagianWhere))
   {
        $bagianWhere .= "jk = '$jk'";
   }
   else
   {
        $bagianWhere .= " AND jk = '$jk'";
   }
}
elseif (isset($_POST['jenis_tugasCat']))
{
   $jenis_tugas = $_POST['jenis_tugas'];
   if (empty($bagianWhere))
   {
        $bagianWhere .= "jenis_tugas = '$jenis_tugas'";
   }
   else
   {
        $bagianWhere .= " AND jenis_tugas = '$jenis_tugas'";
   }
}
else{
echo "<b><font color='#FF0000'>Anda Tidak Mencentang Kategori Pencarian </font></b>";
?><a href="tampilan.php?page=21" style="text-decoration:none">Kembali</a><br><?PHP
}

//echo "<br><b> $nis $nama $kelas_siswa $mapel $jk </b><br>";
echo "<br><b> $nip $nama_guru $mapel $jk $judul $kelas $jenis_tugas</b><br>";
	$query = "SELECT * FROM ".$tabel." WHERE ".$bagianWhere;
	$hasil = mysql_query($query) or die ("Pencarian Gagal, Ulangi Dengan Mencentang Kategori Kemudian Isi Data Pencarian");
	include("tampil_cari.php");			
/*echo "<table border='1'>";
echo "<tr><td>NIM</td><td>Nama Mahasiswa</td><td>Alamat</td><td>Jenis Kelamin</td></tr>";
while ($data = mysql_fetch_array($hasil))
{
   echo "<tr><td>".$data['nim']."</td><td>".$data['namamhs']."</td><td>".$data['alamat']."</td><td>".$data['sex']."</td></tr>";
}
echo "</table>";*/
?>
<br>
<center><a href="tampilan.php?page=21" style="text-decoration:none">Kembali</a></center>
</body>
</html>