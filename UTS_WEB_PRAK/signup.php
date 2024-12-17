<?php
session_start();

$host = 'localhost';
$dbname = 'ukm_db';
$dbuser = 'root'; // Ganti dengan username database Anda
$dbpass = '';     // Ganti dengan password database Anda

// Koneksi ke database
$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$error = '';
$success = '';

// Cek apakah form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Periksa apakah setiap elemen ada di POST
    $username = isset($_POST['username']) ? $conn->real_escape_string($_POST['username']) : '';
    $password = isset($_POST['password']) ? $conn->real_escape_string($_POST['password']) : ''; // Plain password
    $full_name = isset($_POST['full_name']) ? $conn->real_escape_string($_POST['full_name']) : '';
    $phone = isset($_POST['phone']) ? $conn->real_escape_string($_POST['phone']) : '';
    $address = isset($_POST['address']) ? $conn->real_escape_string($_POST['address']) : '';
    $role = isset($_POST['role']) ? $conn->real_escape_string($_POST['role']) : '';

    // Periksa apakah username sudah ada
    $check_sql = "SELECT * FROM users WHERE username = '$username'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $error = "Username sudah digunakan, silakan pilih username lain.";
    } else {
        // Enkripsi password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Masukkan data ke tabel users
        $sql = "INSERT INTO users (username, password, full_name, phone, address, role) 
                VALUES ('$username', '$hashed_password', '$full_name', '$phone', '$address', '$role')";

        if ($conn->query($sql) === TRUE) {
            $success = "Pendaftaran berhasil. Silakan <a href='login.php'>login</a>.";
        } else {
            $error = "Terjadi kesalahan: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMJ Sistem Informasi - Sign Up</title>
    <style>
        /* Reset styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .signup-section {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .signup-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            padding: 30px;
            text-align: center;
        }
        .signup-container h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        label {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
            display: block;
        }
        input[type="text"],
        input[type="password"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-top: 5px;
        }
        textarea {
            resize: none;
        }
        button.signup-btn {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        button.signup-btn:hover {
            background-color: #0056b3;
        }
        p {
            font-size: 14px;
            margin-top: 20px;
        }
        p a {
            color: #007bff;
            text-decoration: none;
        }
        p a:hover {
            text-decoration: underline;
        }
        p[style*="color: red"] {
            font-size: 14px;
            color: red;
            text-align: center;
        }
        p[style*="color: green"] {
            font-size: 14px;
            color: green;
            text-align: center;
        }
    </style>
</head>
<body>
    <section class="signup-section">
        <div class="signup-container">
            <h2>Sign Up</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="full_name">Nama Lengkap</label>
                    <input type="text" id="full_name" name="full_name" required>
                </div>
                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <input type="text" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea id="address" name="address" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn signup-btn">Sign Up</button>

                <p style="margin-top: 15px;">Sudah memiliki akun? <a href="login.php">Login</a></p>

                <?php if (!empty($error)): ?>
                    <p style="color: red; margin-top: 10px;"><?php echo $error; ?></p>
                <?php elseif (!empty($success)): ?>
                    <p style="color: green; margin-top: 10px;"><?php echo $success; ?></p>
                <?php endif; ?>
            </form>
        </div>
    </section>
</body>
</html>


