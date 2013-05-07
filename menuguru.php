<html>
<head></head>
<body>  
<?PHP 
include("reg_username.php");
$jk = $tampil['jk'];?>
<div class="headerBackground"></div>
<div id="navcontainer">	

			<ul id="navlist">
                <li><a href="indexguru.php">HOME</a></li><!-- id="active"   id="current"-->
                <li><a href="tampilan.php?page=1">KELAS DAN MAPEL</a></li>
                <li><a href="tampilan.php?page=2">DATA SISWA</a></li>
                <li><a href="tampilan.php?page=3">UPLOAD MAPEL</a></li>
				<li><a href="tampilan.php?page=4">UPLOAD TUGAS</a></li>
				<li><a href="tampilan.php?page=5">DATA NILAI</a></li>
				<li><a href="tampilan.php?page=6">PENGUMUMAN</a></li>
			</ul>
			<ul id="navlist">
				<li><a href="tampilan.php?page=19">DATA DIRI</a></li>
				<li><a href="tampilan.php?page=7">UBAH PASSWORD</a></li>
				<li><a href="../logout.php">LOGOUT</a></li>
            </ul>
			<marquee behaviour="scroll" direction="left" loop="infinite" style="background-color: #87CEFA; color: black; font-family: Monotype.com; font-size: 16px;"><?PHP
echo "<b>:::Hi $nama_guru, Welcome to the E-Learning System:::";
?></marquee>
</div>
</body>
</html>
