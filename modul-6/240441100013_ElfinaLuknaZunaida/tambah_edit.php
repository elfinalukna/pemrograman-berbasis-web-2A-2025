<?php
require 'koneksi.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'] ?? null;
$isEdit = $id !== null;

$nip = $nama = $umur = $jenis_kelamin = $departemen = $jabatan = $kota_asal = $tanggal_absensi = $jam_masuk = $jam_pulang = "";

if ($isEdit) {
    $q = mysqli_query($conn, "SELECT * FROM karyawan_absensi WHERE id = ".intval($id));
    if (mysqli_num_rows($q) == 0) {
        header('Location: dashboard.php');
        exit;
    }
    $data = mysqli_fetch_assoc($q);
    $nip = $data['nip'];
    $nama = $data['nama'];
    $umur = $data['umur'];
    $jenis_kelamin = $data['jenis_kelamin'];
    $departemen = $data['departemen'];
    $jabatan = $data['jabatan'];
    $kota_asal = $data['kota_asal'];
    $tanggal_absensi = $data['tanggal_absensi'];
    $jam_masuk = $data['jam_masuk'];
    $jam_pulang = $data['jam_pulang'];
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nip = mysqli_real_escape_string($conn, $_POST['nip']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $umur = (int)$_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $departemen = mysqli_real_escape_string($conn, $_POST['departemen']);
    $jabatan = mysqli_real_escape_string($conn, $_POST['jabatan']);
    $kota_asal = mysqli_real_escape_string($conn, $_POST['kota_asal']);
    $tanggal_absensi = $_POST['tanggal_absensi'];
    $jam_masuk = $_POST['jam_masuk'];
    $jam_pulang = $_POST['jam_pulang'];

    if ($isEdit) {
        $sql = "UPDATE karyawan_absensi SET
            nip='$nip', nama='$nama', umur=$umur, jenis_kelamin='$jenis_kelamin',
            departemen='$departemen', jabatan='$jabatan', kota_asal='$kota_asal',
            tanggal_absensi='$tanggal_absensi', jam_masuk='$jam_masuk', jam_pulang='$jam_pulang'
            WHERE id=".intval($id);
    } else {
        $sql = "INSERT INTO karyawan_absensi
            (nip,nama,umur,jenis_kelamin,departemen,jabatan,kota_asal,tanggal_absensi,jam_masuk,jam_pulang)
            VALUES
            ('$nip','$nama',$umur,'$jenis_kelamin','$departemen','$jabatan','$kota_asal','$tanggal_absensi','$jam_masuk','$jam_pulang')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: dashboard.php');
        exit;
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<title><?= $isEdit ? "Edit" : "Tambah" ?> Data Karyawan & Absensi</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans p-6">

<h2 class="text-center text-2xl font-semibold mb-6"><?= $isEdit ? "Edit" : "Tambah" ?> Data Karyawan & Absensi</h2>

<?php if($message): ?>
    <p class="text-red-600 mb-4 text-center"><?=htmlspecialchars($message)?></p>
<?php endif; ?>

<form method="post" onsubmit="return validasiForm()" class="bg-white max-w-xl mx-auto p-6 rounded-lg shadow-md">
    <label for="nip" class="block mt-4 font-medium">NIP</label>
    <input type="text" name="nip" id="nip" required
        value="<?=htmlspecialchars($nip)?>"
        class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />

    <label for="nama" class="block mt-4 font-medium">Nama</label>
    <input type="text" name="nama" id="nama" required
        value="<?=htmlspecialchars($nama)?>"
        class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />

    <label for="umur" class="block mt-4 font-medium">Umur</label>
    <input type="number" name="umur" id="umur" required min="1" max="120"
        value="<?=htmlspecialchars($umur)?>"
        class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />

    <label for="jenis_kelamin" class="block mt-4 font-medium">Jenis Kelamin</label>
    <select name="jenis_kelamin" id="jenis_kelamin" required
        class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
        <option value="">--Pilih--</option>
        <option value="Laki-laki" <?= $jenis_kelamin=="Laki-laki"?"selected":"" ?>>Laki-laki</option>
        <option value="Perempuan" <?= $jenis_kelamin=="Perempuan"?"selected":"" ?>>Perempuan</option>
    </select>

    <label for="departemen" class="block mt-4 font-medium">Departemen</label>
    <input type="text" name="departemen" id="departemen" required
        value="<?=htmlspecialchars($departemen)?>"
        class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />

    <label for="jabatan" class="block mt-4 font-medium">Jabatan</label>
    <input type="text" name="jabatan" id="jabatan" required
        value="<?=htmlspecialchars($jabatan)?>"
        class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />

    <label for="kota_asal" class="block mt-4 font-medium">Kota Asal</label>
    <input type="text" name="kota_asal" id="kota_asal" required
        value="<?=htmlspecialchars($kota_asal)?>"
        class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />

    <label for="tanggal_absensi" class="block mt-4 font-medium">Tanggal Absensi</label>
    <input type="date" name="tanggal_absensi" id="tanggal_absensi" required
        value="<?=htmlspecialchars($tanggal_absensi)?>"
        class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />

    <label for="jam_masuk" class="block mt-4 font-medium">Jam Masuk</label>
    <input type="time" name="jam_masuk" id="jam_masuk" required
        value="<?=htmlspecialchars($jam_masuk)?>"
        class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />

    <label for="jam_pulang" class="block mt-4 font-medium">Jam Pulang</label>
    <input type="time" name="jam_pulang" id="jam_pulang" required
        value="<?=htmlspecialchars($jam_pulang)?>"
        class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />

    <button type="submit"
        class="mt-8 w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded">
        <?= $isEdit ? "Update" : "Simpan" ?>
    </button>
</form>

<div class="max-w-xl mx-auto text-center mt-6">
    <a href="dashboard.php" class="text-gray-600 hover:text-gray-900">Kembali ke Dashboard</a>
</div>

<script>
function validasiForm(){
    const fields = ['nip','nama','umur','jenis_kelamin','departemen','jabatan','kota_asal','tanggal_absensi','jam_masuk','jam_pulang'];
    for(let f of fields){
        if(!document.getElementById(f).value.trim()){
            alert('Field '+f.replace('_',' ')+' harus diisi');
            return false;
        }
    }
    const umur = Number(document.getElementById('umur').value);
    if (umur <= 0 || umur > 120) {
        alert('Umur harus antara 1 sampai 120');
        return false;
    }
    return true;
}
</script>

</body>
</html>
