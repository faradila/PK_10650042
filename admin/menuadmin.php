<html>
<head></head>
<body>	
<?PHP $nama = $_SESSION['reg_username'];?>
<div class="headerBackground"></div>
<div id="navcontainer">	
			<ul>
                <li><a href="indexadmin.php"><b><font face = "courier new" size="4">HOME</font></a></li>
                <li>
					<font face = "courier new" size="4">DATA</font>
					<ul>
						<li><a href="tampilan.php?page=1"><font face = "courier new" size="4">KELAS</font></a></li>
						<li><a href="tampilan.php?page=2"><font face = "courier new" size="4">MAPEL</font></a></li>
					</ul>
				</li>
				<li>
					<font face = "courier new" size="4">GURU</font>
						<ul>
							<li><a href="tampilan.php?page=3"><font face = "courier new" size="4">GURU</font></a></li>
							<li><a href="tampilan.php?page=17"><font face = "courier new" size="4">GURU MENGAJAR</font></a></li>
							<li><a href="tampilan.php?page=5"><font face = "courier new" size="4">UPLOAD MATERI</font></a></li>
							<li><a href="tampilan.php?page=6"><font face = "courier new" size="4">TUGAS</font></a></li>
						</ul>
				</li>
                <li>
					<font face = "courier new" size="4">SISWA</font>
					<ul>
						<li><a href="tampilan.php?page=4"><font face = "courier new" size="4">SISWA</font></a></li>
						<li><a href="tampilan.php?page=15"><font face = "courier new" size="4">NILAI</font></a></li>
						<li><a href="tampilan.php?page=19"><font face = "courier new" size="4">PENGUMUMAN</font></a></li>
					</ul>
				</li>
				<li>
					<font face = "courier new" size="4">ADMIN</font>
					<ul>
						<li><a href="tampilan.php?page=7"><font face = "courier new" size="4">UBAH PASSWORD</font></a></li>
						<li><a href="tampilan.php?page=21"><font face = "courier new" size="4">CARI DATA</font></a></li>
					</ul>
				</li>
				<li><a href="../logout.php"><font face = "courier new" size="4">LOGOUT</font></b></a></li>
            </ul>
			<marquee behaviour="scroll" direction="left" loop="infinite" style="background-color: skyblue; color: black; font-family: courier new; font-size: 13pt;"><?PHP
echo "<b>:::Hi $nama, Welcome to the E-Learning System:::</b>";
?></marquee>
</div>
</body>
</html>