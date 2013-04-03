<?php

include("../koneksi.php");
include("../session.php");
$action = strtolower($_POST['action']);
$nip_edit = $_REQUEST['nip_guru'];
$kode_mapel = $_REQUEST['mapel'];


if ($action == "hapus")
{
	$query1 = mysql_query("select distinct tugas.kode_kelas from tugas,mengajar where tugas.nip_guru = mengajar.nip_guru AND tugas.kode_mapel = mengajar.kode_mapel AND tugas.nip_guru='$nip_edit' AND tugas.kode_mapel='$kode_mapel'");
	$data1 = mysql_fetch_array($query1);
	$jumlah1 = mysql_num_rows($query1);
	
	if($jumlah1>0)
	{
		$kelas1=$data1['kode_kelas'];
		$kelas1=$data1['kode_kelas'];
		$tabel_exist .= "$kelas1";
		echo '<script language="JavaScript">alert("Mohon Maaf, Data Tidak Dapat Dihapus Karena Guru Bersangkutan Masih Mempunyai Data Tugas Untuk \nKelas '.$tabel_exist.' \nMohon Periksa Kembali !");</script>';
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=17\">";
	}
	else{
		$kode_mapel = $_POST['mapel'];
		$delete = "delete from mengajar where nip_guru = '$nip_edit' && kode_mapel = '$kode_mapel'";
		$delete_query = mysql_query($delete);
		if ($delete_query){
					?> <script language="JavaScript">alert('Data Berhasil Di Hapus');</script><?PHP
					echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=17\">";
					$hasil = mysql_query("select * from mengajar order by id_mengajar");
					$no = 1;
					while ($tampil = mysql_fetch_array($hasil)){
						$id_tampil = $tampil['id_mengajar'];
						mysql_query("update mengajar set id_mengajar = $no where id_mengajar = '$id_tampil'");
						$no ++;
					}
					mysql_query("alter table mengajar auto_increment = $no");
		}else {
					?><script language="JavaScript">alert('Data Gagal Dihapus');</script><?PHP
					echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=17\">";
				}
}


}
elseif($action=="tambah"){
		if($_POST['guru']==""){
		?> <script language="JavaScript">alert('Maaf anda Belum Memilih Guru');</script><?PHP
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=18\">";
		}
		elseif($_POST['mapel']==""){
		?> <script language="JavaScript">alert('Maaf anda Belum Memilih Mata Pelajaran');</script><?PHP
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=18\">";
		}
		else{
		$jumKel = $_POST['jumKel'];
		$nip=$_POST[guru];
		$mapel=$_POST[mapel];
		
		$tampil = mysql_query("select DISTINCT kode_mapel from mengajar where nip_guru = '$nip'");
		$jumlah = mysql_num_rows($tampil);
		$cek_jumlah = $jumlah + 1;
		echo "Jumlah mapel guru tersebut = $cek_jumlah<br>";
		echo "Apabila jumlah Mapel > 2, maka input tidak diijinkan<br>";
		
			if($cek_jumlah > 2){
					?> <script language="JavaScript">alert('Maaf Guru tersebut sudah mengambil 2 Mapel');</script><?PHP
					echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=18\">";
			}
			else{		
			for($no = 1; $no <= $jumKel; $no++)
						{
						$k = $_POST['k'.$no];
						if (!empty($k)){
								echo "Kelas $no = $k<br>";
						      $sql2 = "INSERT INTO mengajar (id_mengajar, nip_guru,kode_mapel, kode_kelas) values ('','$nip','$mapel','$k')";
						      $query2 = mysql_query($sql2) or die (mysql_error());
						   }
						}
					
					if ($query2){
						?> <script language="JavaScript">alert('Bagi Kelas berhasil Ditambahkan');</script><?PHP
						echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=17\">";
					} else {
						?><script language="JavaScript">alert('Penambahan Bagi Kelas Gagal);</script><?PHP
						echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=17\">";
						}
				}
			}
}elseif($action=="edit"){
		$nip=$_POST["e_nip_guru"];
		$e_mapel=$_POST['e_mapel'];
		$jumKel = $_POST['jumKel'];
		
			$query_delete = mysql_query("delete from mengajar where nip_guru = '$nip' and kode_mapel = '$kode_mapel'") or die (mysql_error('gagal'));
			
			if($query_delete){
						for($no = 1; $no <= $jumKel; $no++)
						{
							$k = $_POST['e_k'.$no];
							if (!empty($k)){
								echo "$k<br>";
						    $sql2 = "INSERT INTO mengajar (id_mengajar, nip_guru, kode_kelas, kode_mapel) values ('','$nip','$k','$e_mapel')";
							$query2 = mysql_query($sql2) or die (mysql_error());
						   }
						}
				}
				if ($query2){
					?> <script language="JavaScript">alert('Bagi Kelas berhasil Ditambahkan');</script><?PHP
					echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=17\">";
				} else {
					?><script language="JavaScript">alert('Penambahan Bagi Kelas Gagal);</script><?PHP
					echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=17\">";
					}
}
else 
{
$query_cek = mysql_query("select * from mengajar where nip_guru='$nip_edit'") or die (mysql_error());
$cek = mysql_fetch_array($query_cek)  or die (mysql_error());
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Elearning SMK Ma`arif NU 1 Kembaran</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
    <div id="header">
            <?php include ("menuadmin.php");?>
	</div>
    <!-- end #header -->
    <!-- end #sidebar1 -->
    <!-- begin #mainContent -->
    <div id="mainContent">
        <div class="t">
        <div class="b">
        <div class="l">
        <div class="r">
        <div class="bl">
        <div class="br">
        <div class="tl">
        <div class="tr">
            <h2 align="center">Update Data Mengajar</h2>
			
				<form action="action_mengajar.php" method="POST">

				<table width="400" align="center" cellpadding="4" cellspacing="4">
					<tr>
						<td>Nama</td>
						<?php $tampil = mysql_fetch_array(mysql_query("select * from guru where nip_guru = '$nip_edit'"));?>
						<td><input type="hidden" value="<?PHP echo $nip_edit ?>" name="e_nip_guru"><b><?PHP echo $tampil['nama_guru'] ?></b></td>
					</tr>
					<tr>
						<td>Mapel</td>
						<td><input type="hidden" name="mapel" value="<?php echo $kode_mapel ?>" />
						<select name="e_mapel">
						<?php $tampil = mysql_fetch_array(mysql_query("select * from mapel where kode_mapel = '$kode_mapel'"));
						$nama = $tampil['nama_mapel'];
						echo "$nama";
						?>
						<option value="<?PHP echo $kode_mapel ?>"><?PHP echo $tampil['nama_mapel']; ?></option>";
						<?php
						$query = "SELECT * FROM mapel";
						$hasil = mysql_query($query);
						while ($data = mysql_fetch_array($hasil))
						{
						echo "<option value=".$data['kode_mapel'].">".$data['nama_mapel']."</option>";
						}
						?></select></td>
					</tr>	
					<tr>
						<td>Kelas</td>
						<td>
						<?php
						$query = "SELECT * FROM kelas";
						$hasil = mysql_query($query);
							$i = 1;
							while ($data = mysql_fetch_array($hasil))
							{
							  echo "<input type='checkbox' value='".$data['kode_kelas']."' name='e_k".$i."' /> ".$data['nama_kelas']."<br />";
							  $i++;
							}?>
							<input type="hidden" name="jumKel" value="<?php echo $i-1; ?>" />
						</td>
					</tr>	
					<tr>
						<td width="90"></td>
						<td><input type="hidden" name="id" value="<?php $data['id_mengajar'] ?>" />
						<input type="submit" name="action" value="Edit"></td>
					</tr>

</table>
</form>
</body>
			
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <br />
    </div>
    <!-- end #mainContent -->
    <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
	<br class="clearfloat" />
    <!-- begin #footer -->
    <div id="footer">
    </div>
    <!-- end #footer -->
</div>
<!-- end #container -->
</body>
</html>
<?PHP
}
?>