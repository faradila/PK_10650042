<?php
include("../koneksi.php");
include("../session.php");
if($_SESSION['reg_level']!="admin") {
header('location:../login.php');
}
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
    <div id="mainContent3">
        <div class="t">
        <div class="b">
        <div class="l">
        <div class="r">
        <div class="bl">
        <div class="br">
        <div class="tl">
        <div class="tr">
            <h2 align="center">Input Data Guru</h2>
			<?php
				$page = $_GET['page'];
					
				if(!empty($page)){
					include ("$page.php");
				}else{
					include("password.php");
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
       <?php include ("footeradmin.php");?>
    </div>
    <!-- end #footer -->
</div>
<!-- end #container -->
</body>
</html>
