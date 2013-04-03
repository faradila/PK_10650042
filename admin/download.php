<?php
include("../koneksi.php");
include("../session.php");
if($_SESSION['reg_level']!="admin") {
header('location:../login.php');
}


// membaca nilai ID file yang berasal dari link download.php?id=...
$id_materi      = $_GET['id_materi'];

// query untuk mencari data file yang akan didownload dalam database
$query   = "SELECT * FROM upload WHERE id_materi= $id_materi";

$hasil   = mysql_query($query);
$data    = mysql_fetch_array($hasil);

   header("Content-Disposition: attachment; filename=".$data['nama_file']);
   header("Content-length: ".$data['size']);

   header("Content-type: ".$data['type']);

   echo $data['content'];

?>
