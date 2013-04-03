<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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

<link href='images/favicon.png' rel='shortcut icon'/>

<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
    <div id="header">
    	<?php include ("selamat_datang.php");?>
    </div>
    <!-- end #header -->
    <!-- end #sidebar1 -->
    <!-- begin #mainContent -->
    <div id="mainContent2">
        <div class="t">
        <div class="b">
        <div class="l">
        <div class="r">
        <div class="bl">
        <div class="br">
        <div class="tl">
        <div class="tr">
            <h2>Silahkan Login Terlebih Dahulu</h2>
            <form action='cek.php' method='POST'>
				<table border="0">
					<tr>
						<td>Username</td>
						<td>:</td>
						<td><input type="text" name="username" id="username"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td>:</td>
						<td><input type="password" name="password" id="password"></td>
					</tr>
					<tr height='10'></tr>
					<tr>
						<td>
							<input type='submit' value='LOGIN' name='login'></td>
						<td></td>
						<td>
							<input type='reset' value='RESET'>
						</td>
						<td>
						</td>
					<tr></tr><tr></tr>
					</tr>
				</table>
				<a href="register.php" style="text-decoration:none">Klik Disini untuk melakukan pendaftaran</a>
				</form>
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
