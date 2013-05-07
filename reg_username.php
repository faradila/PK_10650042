<?PHP   		
				$nama = ($_SESSION['reg_username']);
				$data = mysql_fetch_array(mysql_query("select * from guru where username='$nama'"));
				$nip_guru = $data['nip_guru'];
				$nama_guru = $data['nama_guru'];
				$jk = $data['jk'];
				$username = $data['username'];
				$password = $data['password'];
				$cek_query = mysql_query("select distinct kode_mapel from mengajar where nip_guru='$nip_guru'");
				$cek_query2 = mysql_query("select distinct kode_kelas from mengajar where nip_guru='$nip_guru'");
?>
