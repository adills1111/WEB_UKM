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
  background-color: #f4f4f4;
  color: #333;
}

/* Navbar Styles */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #f4f4f4;
  padding: 1rem 2rem;
  border-bottom: 0.5px solid #498dc1;
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

    </style>
    <title>Tentang UKM-SISFO SPORT</title>
</head>
<body>
    <header>
        <div class="navbar">
            <img src="img/background_login.png" alt="Logo HMJ" class="logo">
            <nav>
                <a class="btn-primary" href="dashboard.php">Beranda</a>
                <a class="btn-primary" href="tentang.php">Tentang</a>
                <a class="btn-primary" href="pendaftaran.html">Pendaftaran</a>
                <a class="btn-primary" href="Logout.php">Logout</a>
            </nav>
        </div>
    </header>

    <main>
        <?php include "ukm_tampil.php"; ?>
    </main>

    <footer> 
        <div>
            <a href="/"><img src="img/background_login.png" alt="icon" style="width: 3rem;" class="logo"></a>
        </div>
        <div class="menu">
            <p>&copy; Adilla Nurul Insaniya</p>
        </div>
        <div class="sosmed">
            <a href="#" aria-label="facebook"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z"/></svg></a>
            <a href="#" aria-label="instagram"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg></a>
            <a href="#" aria-label="twitter/x"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg></a>
            <a href="#" aria-label="youtube"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"/></svg></a>
            <a href="#" aria-label="tiktok"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M448 209.9a210.1 210.1 0 0 1 -122.8-39.3V349.4A162.6 162.6 0 1 1 185 188.3V278.2a74.6 74.6 0 1 0 52.2 71.2V0l88 0a121.2 121.2 0 0 0 1.9 22.2h0A122.2 122.2 0 0 0 381 102.4a121.4 121.4 0 0 0 67 20.1z"/></svg></a>
        </div>
    </footer>
</body>
</html>
