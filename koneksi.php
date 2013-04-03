<?php

$hostname="localhost";
$user="root";
$password="";
$dbname="elearning";

$koneksi=mysql_connect("$hostname","$user","$password");
if(!$koneksi)
	{
		echo "koneksi tidak berhasil<br>";
	}
else
	{
		mysql_select_db($dbname,$koneksi);
	}
	
?>