<?php
session_start();
$error = '';

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

// Redirect jika sudah login
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if ($_SESSION['role'] === 'admin') {
        echo "<script>alert('Selamat datang, Anda login sebagai Admin');</script>";
        header("Location: dashboard_admin.php");
    } else {
        echo "<script>alert('Selamat datang, Anda login sebagai User');</script>";
        header("Location: dashboard.php");
    }
    exit;
}

// Cek apakah form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query untuk mendapatkan data pengguna
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Set session
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Set cookie berlaku selama 1 jam
        setcookie("username", $user['username'], time() + 3600, "/");
        setcookie("role", $user['role'], time() + 3600, "/");

        // Redirect berdasarkan role
        if ($user['role'] === 'admin') {
            echo "<script>alert('Selamat datang, Anda login sebagai Admin');</script>";
            header("Location: dashboard_admin.php");
        } else {
            echo "<script>alert('Selamat datang, Anda login sebagai User');</script>";
            header("Location: dashboard.php");
        }
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMJ Sistem Informasi - Login</title>
    <link rel="stylesheet" href="css/style2.css">
</head>

<body>
    <section class="login-section">
        <div class="login-container">
            <h2>Login</h2>
            <!-- Form Login -->
            <form action="" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn login-btn">Login</button>
            </form>
            <p>Anda belum memiliki akun? <a href="signup.php">Daftar disini</a></p>


            <!-- Menampilkan pesan kesalahan jika login gagal -->
            <?php if (!empty($error)): ?>
                <p style="color: red; margin-top: 10px;"><?php echo $error; ?></p>
            <?php endif; ?>
        </div>
    </section>
</body>

</html>
