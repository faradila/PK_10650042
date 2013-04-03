<html>
<head>
  <title>Hapus data mahasiswa</title>
  <script type="text/javascript">

  function pilihan()
  {
     // membaca jumlah komponen dalam form bernama 'myform'
     var jumKomponen = document.myform.length;

     // jika checkbox 'Pilih Semua' dipilih
     if (document.myform[0].checked == true)
     {
        // semua checkbox pada data akan terpilih
        for (i=1; i<=jumKomponen; i++)
        {
            if (document.myform[i].type == "checkbox") document.myform[i].checked = true;
        }
     }
     // jika checkbox 'Pilih Semua' tidak dipilih
     else if (document.myform[0].checked == false)
        {
            // semua checkbox pada data tidak dipilih
            for (i=1; i<=jumKomponen; i++)
            {
               if (document.myform[i].type == "checkbox") document.myform[i].checked = false;
            }
        }
  }

</script>
</head>
<body>
<h1>Hapus Data Mahasiswa</h1>
<?php

// koneksi mysql

include("../koneksi.php");

// bagian script untuk menghapus data

if ($_GET['action'] == "del")
{
   // membaca nilai n dari hidden value
   $n = $_POST['n'];

   for ($i=0; $i<=$n-1; $i++)
   {
     if (isset($_POST['kelas'.$i]))
     {
       $kode_kelas = $_POST['kelas'.$i];
       $query = "DELETE FROM kelas WHERE kode_kelas = '$kode_kelas'";
       mysql_query($query);
     }
   }
}

// query SQL untuk menampilkan semua data

$query = "SELECT * FROM kelas";
$hasil = mysql_query($query);

// membuat form penghapusan data

echo "<form name='myform' method='post' action='".$_SERVER['PHP_SELF']."?action=del'>";
echo "<table border='1'>";
echo "<tr><td><input type='checkbox' name='pilih' onclick='pilihan()' /> Pilih semua</td><td><b>kode_kelas</b></td><td><b>kode kelas</b></td></tr>";
$i = 0;
while($data = mysql_fetch_array($hasil))
{
  echo "<tr><td><input type='checkbox' name='kelas".$i."' value='".$data['kode_kelas']."' />
  </td><td>".$data['kode_kelas']."</td><td>".$data['nama_kelas']."</td></tr>";
  $i++;
}
echo "</table>";
echo "<input type='hidden' name='n' value='".$i."' />";
echo "<p><input type='submit' value='Hapus' name='submit'> <input type='reset' value='Batal' name='reset'></p>";
echo "</form>";

?>

</body>
</html>
