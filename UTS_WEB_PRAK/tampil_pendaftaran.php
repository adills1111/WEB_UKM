<?php
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'ukm_db';

$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data
$sql = "SELECT * FROM pendaftaran";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftaran UKM</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        header {
            background-color: #f8f8f8;

            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

/* Navbar Styles */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #f4f4f4;
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

#form {
    background-color: aliceblue;
    text-align: center;
    padding: 30px;


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


.chart {
            display: flex;
            flex-wrap: wrap; /* Allows cards to wrap to next line */
            justify-content: space-between; /* Space out cards */
            padding: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px; /* Margin between cards */
            flex: 1 1 30%; /* Flex properties for responsiveness */
            min-width: 200px; /* Minimum width of the card */
            text-align: center; /* Center text in the card */
        }

        /* Footer Styles */
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
  
    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <img src="img/background_login.png" alt="Logo HMJ" class="logo">
            <nav>
                <a class="btn-primary" href="dashboard_admin.php">Beranda</a>
                <a class="btn-primary" href="tentang_admin.php">Tentang</a>
                <a class="btn-primary" href="tampil_pendaftaran.php">Data Pendaftaran</a>
                <a class="btn-primary" href="logout.php">Logout</a>
            </nav>
        </div>
    </header>
    <main>
        <section id="data-pendaftaran">
            <h1>Data Pendaftaran UKM</h1>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Program Studi</th>
                        <th>Jenis UKM</th>
                        <th>Tanggal Pendaftaran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Cek jika ada data di database
                    if ($result->num_rows > 0) {
                        // Menampilkan data
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['nim'] . "</td>";
                            echo "<td>" . $row['nama'] . "</td>";
                            echo "<td>" . $row['jenis_kelamin'] . "</td>";
                            echo "<td>" . $row['program_studi'] . "</td>";
                            echo "<td>" . $row['jenis_ukm'] . "</td>";
                            echo "<td>" . $row['tanggal_pendaftaran'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <div>
            <a href="/"><img src="img/background_login.png" alt="icon" style="width: 3rem;" class="logo"></a>
        </div>
        <div class="menu">
            <p>&copy; Adilla Nurul Insaniya</p>
        </div>
    </footer>
</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>
