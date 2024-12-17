<?php
include "config.php";
if(file_exists("img/$_GET[foto]")) unlink("assets/$_GET[foto]");
$query = mysqli_query($conn, "DELETE FROM ukm
WHERE id_ukm='$_GET[id]'");
if($query){
echo "<script>alert('Data berhasil dihapus')</script>";
echo "<meta http-equiv='refresh' content='0; url=tentang_admin.php'>";
} else{
echo "<script>alert('Tidak dapat menghapus data')</script>";
echo mysqli_error($conn);
}
?>