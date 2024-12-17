<?php
session_start(); // Memulai sesi

// Menghapus semua data sesi
session_unset();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    setcookie("username", "", time() - 3600, "/");
    setcookie("role", "", time() - 3600, "/");
    session_destroy();
    header("Location: login.php");
    exit;
}


// Menampilkan pesan dan mengarahkan kembali ke halaman login
echo "<script>
    alert('Anda telah keluar.');
    window.location.href = 'login.php';
</script>";
exit;
?>
