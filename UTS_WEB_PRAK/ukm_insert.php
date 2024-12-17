<?php
include "config.php";

$foto = $_FILES['foto']['name'];
$lokasi = $_FILES['foto']['tmp_name'];
$tipefile = $_FILES['foto']['type'];
$ukuranfile = $_FILES['foto']['size'];
$error = "";

if ($foto == "") {
    $query = mysqli_query($conn, "INSERT INTO ukm (nama_ukm, deskripsi) VALUES ('" . mysqli_real_escape_string($conn, $_POST['nama_ukm']) . "', '" . mysqli_real_escape_string($conn, $_POST['deskripsi']) . "')");
} else {
    if ($tipefile != "image/jpeg" && $tipefile != "image/jpg" && $tipefile != "image/png") {
        $error = "Tipe file tidak didukung";
    } elseif ($ukuranfile >= 1000000) {
        $error = "Ukuran file lebih dari 1 MB";
    } else {
        $ext = pathinfo($foto, PATHINFO_EXTENSION);
        $foto = basename($foto, ".$ext") . time() . ".$ext";
        if (move_uploaded_file($lokasi, "img/" . $foto)) {
            $query = mysqli_query($conn, "INSERT INTO ukm (foto, nama_ukm, deskripsi) VALUES ('$foto', '" . mysqli_real_escape_string($conn, $_POST['nama_ukm']) . "', '" . mysqli_real_escape_string($conn, $_POST['deskripsi']) . "')");
        } else {
            $error = "Gagal mengunggah file";
        }
    }
}

if ($error != "") {
    echo "<script>alert('$error');</script>";
    echo "<meta http-equiv='refresh' content='0; url=tentang_admin.php'>";
} elseif ($query) {
    echo "<script>alert('Data berhasil disimpan');</script>";
    echo "<meta http-equiv='refresh' content='0; url=tentang_admin.php'>";
} else {
    echo "<script>alert('Tidak dapat menyimpan data');</script>";
    echo "Error: " . mysqli_error($conn);
}
?>
