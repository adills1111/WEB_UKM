<?php
include "config.php";

// Periksa apakah parameter 'id' ada di URL
if (isset($_GET['id'])) {
    // Ambil ID dan pastikan itu adalah angka
    $id = intval($_GET['id']);
    
    // Query untuk mengambil data makanan berdasarkan ID
    $query = mysqli_query($conn, "SELECT * FROM ukm WHERE id_ukm='$id'");
    
    // Ambil data makanan
    $data = mysqli_fetch_array($query);
    
    // Periksa apakah data ditemukan
    if (!$data) {
        die("Data tidak ditemukan.");
    }
} else {
    die("ID tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
       /* Basic Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* General Styles */
body {
  font-family: Arial, sans-serif;
  color: #333;
}

/* Navbar Styles */
/* Navbar Styles */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #f4f4f4; /* Warna putih */
  border-bottom: 0.5px solid #498dc1;
  padding: 1rem 2rem;
}


.logo {
  width: 100px;
}

.navbar nav a {
  color: white;
  text-decoration: none;
  margin-left: 20px;
  font-weight: bold;
  transition: color 0.3s ease;
}

.navbar nav a:hover {
  color: #ffeb3b;
}

.btn-primary {
  background-color: #498dc1;
  color: white;
  padding: 0.5rem 1rem;
  border-radius: 25px;
  text-decoration: none;
  font-weight: bold;
  transition: background 0.3s ease;
}

.btn-primary:hover {
  background-color: #4a9ad7;
}


/* Main Section */
main {
  padding: 2rem;
}

h1 {
  font-size: 2rem;
  margin-bottom: 1rem;
}

#tentang p {
  margin-bottom: 2rem;
  line-height: 1.6;
}

.list-ukm table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 1rem;
}

.list-ukm th, .list-ukm td {
  padding: 1rem;
  border: 1px solid #ddd;
  text-align: left;
}

.activity-img {
  width: 100px;
  height: auto;
}

/* Footer */
footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 2rem;
  background-color: #498dc1;
  color: white;
}

footer .logo {
  width: 3rem;
}

footer .menu {
  font-size: 0.9rem;
}

.sosmed a {
  color: white;
  margin-left: 1rem;
}

.sosmed svg {
  width: 1.5rem;
  height: 1.5rem;
  fill: white;
}

/* Gaya untuk konten utama */
section.content {
  flex: 80%;
  padding: 20px;
  height: 100vh;
  overflow: scroll;
}



/* Tombol tambah */
.add-button {
  margin-bottom: 20px;
  text-align: left;
}

.add-button button {
  background-color: #28a745;
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.add-button button:hover {
  background-color: #218838;
}

/* Gaya untuk form */
form {
  background-color: #fff;
  padding: 2rem;
  margin: 1rem 0;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
  display: block;
  margin-bottom: 8px;
}

input[type="text"],
input[type="file"] {
  width: 100%;
  padding: 8px;
  margin-bottom: 1rem;
  border: 1px solid #ddd;
  border-radius: 4px;
}

/* Gaya untuk tabel */
table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
  background-color: #fff;
}

table th,
table td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

table th {
  background-color: #333;
  color: white;
}

table img {
  border-radius: 4px;
}

/* Mengatur desain tombol aksi yang dibuat dengan tag <a> */
.tombol {
  display: inline-block;
  max-width: 150px;
  padding: 15px 30px;
  color: #fff;
  text-decoration: none;
  background: #038ade;
  cursor: pointer;
}

/* Desain tombol edit dan hapus agar lebih kecil */
.tombol.edit,
.tombol.hapus {
  padding: 10px 15px;
  font-size: 12px;
  border-radius: 4px;
}

.tombol.hapus {
  background: #fc4c4c;
}

.tombol.edit:hover {
  background-color: #0056b3;
}

.tombol.hapus:hover {
  background-color: #c82333;
}
        
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f4f4f4;
}

    </style>
    <title>Tentang UKM-SISFO SPORT</title>
</head>
<body>
    <header>
        <div class="navbar">
            <img src="img/background_login.png" alt="Logo HMJ" class="logo">
            <nav>
                <a class="btn-primary" href="dashboard_admin.html">Beranda</a>
                <a class="btn-primary" href="tentang_admin.php">Tentang</a>
                <a class="btn-primary" href="tampil_pendaftaran.php">Data Pendaftaran</a>
                <a class="btn-primary" href="Logout.php">Login</a>
            </nav>
        </div>
    </header>

    <main>
        <section id="tentang">
            <h1>Temukan Bakat & Minat Kamu Disini</h1>
            <p>
                Di SISFO SPORT, kami menawarkan beragam pilihan kegiatan yang sesuai dengan minat dan bakat Kamu. Dengan berbagai pilihan SPORT yang tersedia, kami yakin Kamu akan menemukan tempat yang sesuai untuk berkembang dan berkontribusi.
            </p>
            <div class="list-ukm"></div>
    <!-- Konten Utama -->
    <section class="content">
        <!-- Formulir Edit Makanan -->
        <form id="food-form" action="ukm_update.php" method="post" enctype="multipart/form-data">
            <h2>Edit UKM </h2>
            <input type="hidden" name="id_ukm" value="<?= $data['id_ukm'] ?>">
            <label for="food-name">Nama Ukm:</label>
            <input type="text" id="nama_ukm" name="nama_ukm" placeholder="Masukkan nama..."
                   value="<?= $data['nama_ukm'] ?>" required
                   oninvalid="this.setCustomValidity('Ups! Kolom ini tidak boleh kosong')"
                   oninput="setCustomValidity('')">
            <label for="food-desc">Deskripsi:</label>
            <input type="text" id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi..."
                   required value="<?= $data['deskripsi'] ?>"
                   oninvalid="this.setCustomValidity('Ups! Kolom ini tidak boleh kosong')"
                   oninput="setCustomValidity('')">
            <label for="food-image">Gambar :</label>
            <img src="img/<?= $data['foto'] ?>" width="150">
            <input type="file" id="foto" name="foto">
            <div class="add-button">
                <button type="submit" id="submit-btn">Simpan</button>
                <button type="reset" onclick="location.href='tentang_admin.php';">Batal</button>
            </div>
        </form>
        <!-- Tabel Data Makanan -->
        <?php include "ukm_tampil.php"; ?>
    </section>
</div>
</body>
</html>