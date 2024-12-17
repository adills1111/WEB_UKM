<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

$host = 'localhost';
$dbname = 'ukm_db';
$dbuser = 'root';
$dbpass = '';

$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$username = $_SESSION['username'];
$role = $_SESSION['role']; // Dapatkan role pengguna
$error = '';
$success = '';

// Ambil data pengguna
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Jika form di-submit untuk memperbarui profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);

    // Update data pengguna
    $update_sql = "UPDATE users SET full_name = ?, phone = ?, address = ? WHERE username = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssss", $full_name, $phone, $address, $username);

    if ($stmt->execute()) {
        $success = "Profil berhasil diperbarui!";
        // Refresh data pengguna
        $result = $conn->query("SELECT * FROM users WHERE username = '$username'");
        $user = $result->fetch_assoc();
    } else {
        $error = "Terjadi kesalahan, silakan coba lagi!";
    }
}

// Jika role adalah admin, tampilkan daftar pengguna
if ($role === 'admin') {
    // Query untuk menampilkan semua pengguna tanpa menampilkan password
    $users_sql = "SELECT username, full_name, phone, address FROM users";
    $users_result = $conn->query($users_sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="css/profilcss.css">
    <style>
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
</head>
<body>
    <nav>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a href="dashboard_admin.php" aria-label="Logo Icon">
                <img src="img/background_login.png" style="width: 3rem;" alt="logo">
            </a>
        <?php else: ?>
            <a href="dashboard.php" aria-label="Logo Icon">
                <img src="img/background_login.png" style="width: 3rem;" alt="logo">
            </a>
        <?php endif; ?>
    </nav>

    <section class="profile-section">
        <div class="profile-container">
            <h2>Profil Anda</h2>

            <!-- Pesan jika sukses atau gagal -->
            <?php if (!empty($success)) echo "<p style='color: green;'>$success</p>"; ?>
            <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>

            <!-- Tampilkan data profil -->
            <form action="" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" value="<?= htmlspecialchars($user['username'] ?? ''); ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="full_name" value="<?= htmlspecialchars($user['full_name'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" name="phone" value="<?= htmlspecialchars($user['phone'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="address" value="<?= htmlspecialchars($user['address'] ?? ''); ?>">
                </div>
                <button type="submit" class="btn">Simpan Perubahan</button>
            </form>

            <!-- Tombol Logout -->
            <a href="logout.php"><button class="btn logout-btn">Logout</button></a>

            <!-- Jika role adalah admin, tampilkan daftar pengguna -->
            <?php if ($role === 'admin'): ?>
                <h3>Daftar Pengguna Terdaftar</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Nomor Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th> <!-- New column for actions -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user_row = $users_result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($user_row['username']); ?></td>
                                <td><?= htmlspecialchars($user_row['full_name']); ?></td>
                                <td><?= htmlspecialchars($user_row['phone']); ?></td>
                                <td><?= htmlspecialchars($user_row['address']); ?></td>
                                <td>
                                    <!-- Delete button -->
                                    <a href="delete_user.php?username=<?= $user_row['username']; ?>" onclick="return confirm('Yakin ingin menghapus akun ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>
