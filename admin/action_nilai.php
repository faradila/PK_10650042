<?php
include("../koneksi.php");
include("../session.php");
$action = strtolower($_POST['action']);
$nis = $_REQUEST['nis'];
if($_SESSION['reg_level']!="admin") {
header('location:../index.php');
}
if ($action == "insert")
{
		$kelas=$_POST['kelas'];
		$mapel=$_POST['mapel'];
		$jumMhs = $_POST['jumMhs'];
		for($no=1; $no<=$jumMhs; $no++)
			{
				$nis = $_POST['nis'.$no];
				$nilai = $_POST['nilai'.$no];
				$saran = $_POST['saran'.$no];
				if(!empty($nis) && !empty($nilai)){
				$masuk = "INSERT INTO nilai (nis, kode_kelas, kode_mapel, nilai, saran_guru) VALUES ('$nis', '$kelas', '$mapel', '$nilai', '$saran')";
				$input = mysql_query($masuk) or die (mysql_error());	
				}
			}
			if($input){
			?> <script language="JavaScript">alert('Data Berhasil Di Tambah');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=15\">";
			}
			else
			{
			?> <script language="JavaScript">alert('Data Gagal Di Tambah');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=15\">";
			}
}
elseif ($action == "update")
{
		$kelas=$_POST['kelas'];
		$mapel=$_POST['mapel'];
		$jumMhs = $_POST['jumMhs'];
		for($no=1; $no<=$jumMhs; $no++)
			{
				$nis = $_POST['nis'.$no];
				$nilai = $_POST['nilai'.$no];
				$saran = $_POST['saran'.$no];
				if(!empty($nis)){
				$ubah = " update nilai set nilai = '$nilai', saran_guru = '$saran' where nis = '$nis' ";
				$update = mysql_query($ubah) or die (mysql_error());	
				}
			}
			if($update){
			?> <script language="JavaScript">alert('Data Berhasil Di Update');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=15\">";
			}
			else
			{
			?> <script language="JavaScript">alert('Data Gagal Di Update');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=15\">";
			}
}
elseif ($action == "delete")
{
		$kelas=$_POST['kelas'];
		$mapel=$_POST['mapel'];
		$jumMhs = $_POST['jumMhs'];
		for($no=1; $no<=$jumMhs; $no++)
			{
				$nis = $_POST['nis'.$no];
				if(!empty($nis)){
				$delete = "delete from nilai where nis = '$nis' && kode_mapel = '$mapel' && kode_kelas = '$kelas'";
				$hapus = mysql_query($delete) or die (mysql_error());	
				}
			}
			if($hapus){
			?> <script language="JavaScript">alert('Data Berhasil Di Hapus');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=15\">";
			}
			else
			{
			?> <script language="JavaScript">alert('Data Gagal Di Hapus');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=15\">";
			}
}
else
			{
			?> <script language="JavaScript">alert('Operasi Tidak Berjalan');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=15\">";
			}
?>