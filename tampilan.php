<?php
include("../koneksi.php");
include("../session.php");
if($_SESSION['reg_level']!="guru") {
header('location:../index.php');
date_default_timezone_set("Asia/Jakarta");
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script language="JavaScript">
var txt=" Elearning SMK Ma`arif NU 1 Kembaran";
var kecepatan=1000;
var segarkan=null;
function bergerak() 
{ document.title=txt;
txt=txt.substring(1,txt.length)+txt.charAt(0);
segarkan=setTimeout("bergerak()",kecepatan);}bergerak();
</script>

<link href='../images/favicon.png' rel='shortcut icon'/>

<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
    <div id="header">
            <?php include ("menuguru.php");?>
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
		<br>
			<?php
			include("../date_time.php");
			$page = $_GET['page'];	
				if(isset($_GET['Halaman_Pengumuman']))
						{
							?><h2 align="center">Pengumuman</h2><?PHP
							include("pengumuman.php");
						}
								
				elseif ($page==1){
					?><h2 align="center">Data Kelas dan Mata Pelajaran</h2><?PHP
					include("kelas_guru.php");
				}
				elseif ($page==2){
					?><h2 align="center">Data Siswa</h2><?PHP
					include("siswa.php");
				}
				elseif ($page==3){
					?><h2 align="center">Upload Materi Pelajaran</h2><?PHP
					include("upload_mapel.php");
				}
				elseif ($page==4){
					?><h2 align="center">Upload Tugas</h2><?PHP
					include("tugas.php");
				}
				elseif ($page==5){
					?><h2 align="center">Nilai</h2><?PHP
					include("nilai.php");
				}
				elseif ($page==6){
					?><h2 align="center">Pengumuman</h2><?PHP
					include("Pengumuman.php");
				}
				elseif ($page==7){
					?><h2 align="center">Ubah Password</h2><?PHP
					include("password.php");
				}
				elseif ($page==8){
					include("../logout.php");
				}
				elseif ($page==9){
					?><h2 align="center">Input Kelas</h2><?PHP
					include("input_kelas.php");
				}
				elseif ($page==10){
					?><h2 align="center">Input Mapel</h2><?PHP
					include("input_mapel.php");
				}
				elseif ($page==11){
					?><h2 align="center">Input Guru</h2><?PHP
					include("input_guru.php");
				}
				elseif ($page==12){
					?><h2 align="center">Input Siswa</h2><?PHP
					include("input_siswa.php");
				}
				elseif ($page==13){
					?><h2 align="center">Upload File</h2><?PHP
					include("upload_file.php");
				}
				elseif ($page==14){
					?><h2 align="center">Input Tugas</h2><?PHP
					include("input_tugas.php");
				}
				elseif ($page==15){
					?><h2 align="center">Masukkan Nilai</h2><?PHP
					include("nilai.php");
				}
				elseif ($page==16){
					?><h2 align="center">Download</h2><?PHP
					include("download.php");
				}
				elseif ($page==17){
					?><h2 align="center">Guru Mengajar</h2><?PHP
					include("mengajar.php");
				}
				elseif ($page==18){
					?><h2 align="center">Input Bagi Kelas</h2><?PHP
					include("input_mengajar.php");
				}
				elseif ($page==19){
					?><h2 align="center">Data Diri</h2><?PHP
					include("data_diri.php");
				}
			?>
			
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
