<?php
include("../koneksi.php");
include("../session.php");
$nama = ($_SESSION['reg_username']);
$tampil = mysql_fetch_array(mysql_query("select * from guru where username = '$nama'"));
$nama_guru = $tampil['nama_guru'];
$jk = $tampil['jk'];
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
	<br><br>
    <div id="mainContent">
        <div class="t">
        <div class="b">
        <div class="l">
        <div class="r">
        <div class="bl">
        <div class="br">
        <div class="tl">
        <div class="tr">
		<h2>Selamat Datang 
		<?PHP
			if($jk == "p"){
				echo "Bapak ";
				}
				elseif($jk == "w"){
				echo "Ibu  ";
				}
				else{
				echo "Saudara ";
				}
			 echo "$nama_guru"?>,<br> 
           di Elearning SMK Ma`arif NU 1 Kembaran,<br>Anda Login Sebagai Guru</h2>
			
			<b>Selamat Bergabung......</b>
            </p>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <br /><br /><br /><br />
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
