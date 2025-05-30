<?php
require 'koneksi.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'] ?? null;

if ($id) {
    $id = intval($id);
    mysqli_query($conn, "DELETE FROM karyawan_absensi WHERE id=$id");
}

header('Location: dashboard.php');
exit;
?>