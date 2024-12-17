<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "db_ukm";
//Membuat koneksi
$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if(mysqli_connect_errno()){
echo "Koneksi gagal: ".mysqli_connect_error();
}
//query membuat tabel
$sql = "CREATE TABLE ukm (
id_ukm INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nama_ukm VARCHAR(30) NOT NULL,
deskripsi text,
foto VARCHAR(50)
)";
if (mysqli_query($conn, $sql)) {
echo "Table Ukm berhasil dibuat";
} else {
echo "Gagal membuat tabel: " . mysqli_error($conn);
}
mysqli_close($conn);
?>