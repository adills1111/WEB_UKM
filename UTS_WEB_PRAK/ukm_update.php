<?php
include "config.php";

$foto = $_FILES['foto']['name'];
$lokasi = $_FILES['foto']['tmp_name'];
$tipefile = $_FILES['foto']['type'];
$ukuranfile = $_FILES['foto']['size'];

$error = "";
$id_ukm = intval($_POST['id_ukm']); // Mengambil ID makanan dengan validasi

if (empty($foto)) { // Update jika foto tidak diubah
    $query = mysqli_query($conn, "UPDATE ukm SET
        nama_ukm = '$_POST[nama_ukm]',
        deskripsi = '$_POST[deskripsi]'
        WHERE id_ukm='$id_makanan'");
} else {
    if ($tipefile != "image/jpeg" && $tipefile != "image/jpg" && $tipefile != "image/png") {
        $error = "Tipe file tidak didukung";
    } elseif ($ukuranfile >= 1000000) {
        $error = "Ukuran file lebih dari 1 MB";
    } else { // Update jika foto diubah
        $query = mysqli_query($conn, "SELECT * FROM ukm WHERE id_ukm='$id_ukm'");
        $data = mysqli_fetch_array($query);

        if (file_exists("img/$data[foto]")) {
            unlink("img/$data[foto]"); // Hapus foto lama
        }

        $ext = strrchr($foto, '.');
        $foto = basename($foto, $ext) . time() . $ext;

        // Pindahkan file ke direktori tujuan
        if (move_uploaded_file($lokasi, "img/" . $foto)) {
            $query = mysqli_query($conn, "UPDATE ukm SET
                foto = '$foto',
                nama_ukm = '$_POST[nama_ukm]',
                deskripsi = '$_POST[deskripsi]'
                WHERE id_ukm='$id_ukm'");
        } else {
            $error = "Gagal mengunggah file.";
        }
    }
}

if (!empty($error)) {
    echo "<script>alert('$error')</script>";
    echo "<meta http-equiv='refresh' content='0; url=tentang_admin.php'>";
} elseif ($query) {
    echo "<script>alert('Data berhasil diubah')</script>";
    echo "<meta http-equiv='refresh' content='0; url=tentang_admin.php'>";
} else {
    echo "<script>alert('Tidak dapat menyimpan data')</script>";
    echo mysqli_error($conn);
}
?>