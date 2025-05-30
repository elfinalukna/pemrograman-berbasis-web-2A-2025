<?php
require 'koneksi.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM karyawan_absensi ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-red-100 p-6 font-sans">

  <div class="max-w-screen-xl mx-auto">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-4xl font-sans font-bold">Data Karyawan</h1>
      <a href="logout.php" class="bg-green-400 hover:bg-green-500 text-white font-semibold px-2 py-2 rounded">Logout</a>
    </div>

    <table class="w-full bg-white border border-gray-300 text-sm text-center rounded">
      <thead>
        <tr class="bg-blue-300 text-white rounded">
          <th class="border px-2 py-2">ID</th>
          <th class="border px-2 py-2">NIP</th>
          <th class="border px-2 py-2">Nama</th>
          <th class="border px-2 py-2">Umur</th>
          <th class="border px-2 py-2">Jenis Kelamin</th>
          <th class="border px-2 py-2">Departemen</th>
          <th class="border px-2 py-2">Jabatan</th>
          <th class="border px-2 py-2">Kota Asal</th>
          <th class="border px-2 py-2">Tanggal Absensi</th>
          <th class="border px-2 py-2">Jam Masuk</th>
          <th class="border px-2 py-2">Jam Pulang</th>
          <th class="border px-2 py-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($data)): ?>
        <tr class="hover:bg-gray-50">
          <td class="border px-2 py-2"><?= $row['id'] ?></td>
          <td class="border px-2 py-2"><?= htmlspecialchars($row['nip']) ?></td>
          <td class="border px-2 py-2"><?= htmlspecialchars($row['nama']) ?></td>
          <td class="border px-2 py-2"><?= htmlspecialchars($row['umur']) ?></td>
          <td class="border px-2 py-2"><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
          <td class="border px-2 py-2"><?= htmlspecialchars($row['departemen']) ?></td>
          <td class="border px-2 py-2"><?= htmlspecialchars($row['jabatan']) ?></td>
          <td class="border px-2 py-2"><?= htmlspecialchars($row['kota_asal']) ?></td>
          <td class="border px-2 py-2"><?= htmlspecialchars($row['tanggal_absensi']) ?></td>
          <td class="border px-2 py-2"><?= htmlspecialchars($row['jam_masuk']) ?></td>
          <td class="border px-2 py-2"><?= htmlspecialchars($row['jam_pulang']) ?></td>
          <td class="border px-2 py-2 space-x-1">
            <a href="tambah_edit.php?id=<?= $row['id'] ?>" class="bg-green-200 hover:bg-green-300 text-black px-2 py-1 rounded text-xs flex justify-center">Edit</a>
            <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin hapus?')" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-xs flex mt-2 justify-center">Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
<a href="tambah_edit.php" class="fixed bottom-6 right-6 bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 rounded shadow-lg text-sm z-50">
  Tambah Data karyawan dan absensi +
</a>

</body>
</html>

