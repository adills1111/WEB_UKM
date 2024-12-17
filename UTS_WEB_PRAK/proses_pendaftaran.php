<?php
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'ukm_db';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jk'];
$program_studi = $_POST['programstudi'];
$jenis_ukm = $_POST['jenisukm'];

// Query untuk menyimpan data
$sql = "INSERT INTO pendaftaran (nim, nama, jenis_kelamin, program_studi, jenis_ukm)
        VALUES ('$nim', '$nama', '$jenis_kelamin', '$program_studi', '$jenis_ukm')";

if ($conn->query($sql) === TRUE) {
    echo "Pendaftaran berhasil!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
