<?php
session_start();

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if (isset($_GET['username'])) {
    $username_to_delete = $_GET['username'];

    // Connect to the database
    $host = 'localhost';
    $dbname = 'ukm_db';
    $dbuser = 'root';
    $dbpass = '';

    $conn = new mysqli($host, $dbuser, $dbpass, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Check if the user exists
    $check_sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $username_to_delete);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Proceed to delete the user
        $delete_sql = "DELETE FROM users WHERE username = ?";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bind_param("s", $username_to_delete);

        if ($stmt->execute()) {
            // Redirect back to the profile page or the users list with a success message
            header("Location: profil.php?success=User+deleted+successfully");
            exit;
        } else {
            // Redirect back with an error message
            header("Location: profil.php?error=Failed+to+delete+user");
            exit;
        }
    } else {
        // Redirect back with an error message if user not found
        header("Location: profil.php?error=User+not+found");
        exit;
    }
}
?>
