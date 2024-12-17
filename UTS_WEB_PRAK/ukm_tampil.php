<?php
session_start(); // Start the session to access session variables

// Assuming your session contains the user information like role
// For example, $_SESSION['role'] = 'admin'; for an admin user

include "config.php";
$query = mysqli_query($conn, "SELECT * FROM ukm ORDER BY id_ukm DESC");
$no = 0;
?>

<html>
<head>
    <link rel="stylesheet" href="css/style.css">
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
    <table id="food-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Ukm</th>
                <th>Gambar</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($data = mysqli_fetch_array($query)) {
                $no++;
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $data['nama_ukm'] ?></td>
                <td><img src="img/<?= $data['foto'] ?>" width="100"></td>
                <td><?= $data['deskripsi'] ?></td>
                <td>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                        <a class="tombol edit" href="ukm_edit.php?id=<?= $data['id_ukm'] ?>">Edit</a>
                        <a class="tombol hapus" onclick="return confirm('Yakin ingin menghapus?')" href="ukm_hapus.php?id=<?= $data['id_ukm'] ?>&foto=<?= $data['foto'] ?>">Hapus</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>
