<?php
include("../koneksi.php");
include("../session.php");
$action = strtolower($_POST['action']);
$id = $_REQUEST['id_pengumuman'];
if($_SESSION['reg_level']!="admin") {
header('location:../index.php');
date_default_timezone_set('Asia/Jakarta');
}

if ($action == "delete")
{
$delete = "delete from pengumuman where id_pengumuman = '$id'";
$delete_query = mysql_query($delete);

if ($delete_query){
			?> <script language="JavaScript">alert('Data Berhasil Di Hapus');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=19\">";
			$hasil = mysql_query("select * from pengumuman order by id_pengumuman");
			$no = 1;
			while ($tampil = mysql_fetch_array($hasil)){
				$id_tampil = $tampil['id_pengumuman'];
				mysql_query("update tugas set id_pengumuman = $no where id_pengumuman = '$id_tampil'");
				$no ++;
			}
			mysql_query("alter table pengumuman auto_increment = $no");
}else {
			?><script language="JavaScript">alert('Data Gagal Dihapus');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=19\">";
		}
}
elseif ($action == "tambah"){
	if($_POST['judul']==""){
	?> <script language="JavaScript">alert('Maaf anda Belum Memasukkan judul');</script><?PHP
	echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=20\">";
	}
	else if($_POST['nip']==""){
	?> <script language="JavaScript">alert('Maaf anda Belum Memasukkan nama guru');</script><?PHP
	echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=20\">";
	}
	else if($_POST['objek']==""){
	?> <script language="JavaScript">alert('Maaf anda Belum Objek Pengumuman');</script><?PHP
	echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=20\">";
	}
	else if($_POST['pesan']==""){
	?> <script language="JavaScript">alert('Maaf anda Belum Memasukkan pesan');</script><?PHP
	echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=20\">";
	}

	else{
		$judul=ucwords($_POST["judul"]);
		$nip=($_POST["nip"]);
		$objek=ucwords($_POST["objek"]);
		$pesan=ucfirst($_POST["pesan"]);
		$sql = "insert into pengumuman (id_pengumuman,judul,nip_guru,objek,waktu,isi) values('','$judul','$nip','$objek',sysdate(),'$pesan')";
		$query = mysql_query($sql)or die (mysql_error());
		if ($query){
			?> <script language="JavaScript">alert('Data berhasil ditambahkan');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=19\">";
		} else {
			?><script language="JavaScript">alert('Penambahan data gagal, Mohon dicek Kembali');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=20\">";
			}
	}
}

elseif ($action == "edit"){
		$id=$_POST["e_id"];
		$judul=ucwords($_POST["e_judul"]);
		$nip=$_POST["e_nip"];
		$objek=ucwords($_POST["e_objek"]);
		$pesan=ucfirst($_POST["e_pesan"]);
		//$pesan=ltrim(ucfirst($_POST["e_pesan"]));
		$waktu=date("Y-m-d H:i:s");
		
		$sql = "update pengumuman set judul = '$judul',nip_guru = '$nip',waktu = '$waktu', objek = '$objek', isi='$pesan'  where id_pengumuman='$id'";
		$query_edit = mysql_query($sql) or die(mysql_error());
		if($query_edit){
			?> <script language="JavaScript">alert('Data terupdate');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=19\">";
		} else {
			?><script language="JavaScript">alert('Update gagal');</script><?PHP
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tampilan.php?page=19\">";
		}
}
else 
{
$sql_select="select * from pengumuman where id_pengumuman='$id'";
$query_select=mysql_query($sql_select);
$data=mysql_fetch_array($query_select);
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Elearning SMK Ma`arif NU 1 Kembaran</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">

var maxChar = 250;

function count()
{
	if (document.formku.e_pesan.value.length> maxChar)
	{
		document.formku.e_pesan.value = 
		document.formku.e_pesan.value.substring(0, maxChar);
	}
	else document.formku.counter.value = maxChar - document.formku.e_pesan.value.length;
}

function initial()
{
	document.formku.counter.value = maxChar;
}
</script>
</head>
<body onload="initial()">
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
            <h2 align="center">Update Pengumuman</h2>
			
				<form action="action_pengumuman.php" method="POST" name="formku">

				<table width="600" align="center" cellpadding="6" cellspacing="6">
					<tr>
						<td>id</td>
						<td><input type="hidden" value="<?PHP echo $data['id_pengumuman'] ?>" name="e_id"><?PHP echo $data['id_pengumuman'] ?></td>
					</tr>
					<tr>
						<td>Judul</td>
						<td><input type="text" value="<?PHP echo $data['judul'] ?>" name="e_judul" size='45'></td>
					</tr>
					<tr>
						<td>Nama Guru</td>
						<td><select name="e_nip">
						<option value="<?PHP echo $data['nip_guru'] ?>"><?PHP echo $data['nip_guru'] ?></option>";
						<?php
						$query = "SELECT * FROM guru";
						$hasil = mysql_query($query);
						while ($cek = mysql_fetch_array($hasil))
						{
						echo "<option value=".$cek['nip_guru'].">".$cek['nama_guru']."</option>";
						}

						?></select></td>
					</tr>
					<tr>
						<td>Kepada</td>
						<td><input type="text" value="<?PHP echo $data['objek'] ?>" name="e_objek" size='45'></td>
					</tr>
					<tr>
						<td>Pengumuman</td>
						<td>
						<textarea name="e_pesan"  value="<?PHP echo($data['isi']) ?>" rows="10" cols="40" onKeyUp="count()"><?PHP echo $data['isi'] ?></textarea>
						</td>
					</tr>
					<tr><td></td>
						<td>
						<input type="text" readonly  name="counter" size="3">
						</td>
					</tr>
					<tr>
						<td width="90"></td>
						<td><input type="submit" name="action" value="edit"></td>
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