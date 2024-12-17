<?php
$servername = "localhost"; // Ganti dengan server database Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "ukm_db"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'get':
        $sql = "SELECT * FROM activities";
        $result = $conn->query($sql);
        $activities = [];

        while ($row = $result->fetch_assoc()) {
            $activities[] = $row;
        }
        echo json_encode($activities);
        break;

    case 'edit':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        $name = $data['name'];
        $sql = "UPDATE activities SET name='$name' WHERE id=$id";
        echo json_encode(['success' => $conn->query($sql)]);
        break;

    case 'delete':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        $sql = "DELETE FROM activities WHERE id=$id";
        echo json_encode(['success' => $conn->query($sql)]);
        break;

    case 'create':
        $data = json_decode(file_get_contents('php://input'), true);
        $name = $data['name'];
        $image = $data['image'];
        $description = $data['description'];
        $sql = "INSERT INTO activities (name, image, description) VALUES ('$name', '$image', '$description')";
        echo json_encode(['success' => $conn->query($sql)]);
        break;

    default:
        echo json_encode(['error' => 'Invalid action']);
        break;
}

$conn->close();
?>