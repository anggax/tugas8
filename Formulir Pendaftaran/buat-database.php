<?php
//pembuatan variabel server, username, dan password db
$servername = "localhost";
$username 	= "root";
$password 	= "";
//melakukan koneksi dengan database
$koneksi = mysqli_connect($servername, $username, $password);
if (!$koneksi) {
	die ("Connection failed: ". mysqli_connect_error());
}
//membuat database
$sql = "CREATE DATABASE formulir";
if (mysqli_query($koneksi, $sql)) {
	echo "Database berhasil dibuat"; 
} else {
	echo "Gagal membuat database: ".mysqli_error($koneksi); 
}

mysqli_close($koneksi);
?>