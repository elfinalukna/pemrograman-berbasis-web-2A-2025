<?php
$artikel = [
  [
  "id" => 1,
  "judul" => "Pertama Kali Belajar HTML & CSS",
  "tanggal" => "12 Maret 2025",
  "refleksi" => "Saat pertama belajar HTML dan CSS, aku merasa seperti sedang membuka pintu dunia baru. Awalnya bingung membedakan antara tag dan properti CSS, tapi setelah beberapa kali mencoba membuat halaman sederhana, aku mulai paham struktur dasar web. Rasanya menyenangkan melihat hasilnya langsung di browser.",
  "gambar" => "download.jpg",
  "sumber" => "https://www.w3schools.com/html/"
  ],

  [
  "id" => 2,
  "judul" => "Belajar Membuat Formulir Interaktif dengan PHP",
  "tanggal" => "25 Maret 2025",
  "refleksi" => "Saat mencoba membuat formulir interaktif dengan PHP, aku belajar bagaimana data bisa diproses dari input pengguna. Rasanya menegangkan saat hasilnya tidak muncul sesuai harapan, tetapi setelah menelusuri kesalahan dan memperbaikinya, aku merasa sangat puas. Proses debugging itu ternyata sangat penting dalam pengembangan web.",
  "gambar" => "Computer Illustration Images - Free Download on Freepik.jpg",
  "sumber" => "https://www.php.net/manual/en/tutorial.forms.php"
],


 [
  "id" => 3,
  "judul" => "Kenalan dengan JavaScript Dasar",
  "tanggal" => "5 April 2025",
  "refleksi" => "JavaScript membuat website menjadi lebih hidup. Saat belajar tentang DOM dan event listener, aku merasa kagum karena bisa membuat tombol berubah warna atau menampilkan pesan saat diklik. Aku masih harus banyak latihan, tapi aku yakin JS akan sangat berguna ke depannya.",
  "gambar" => "Desktop computer Customizable Isometric Illustrations _ Amico Style.jpg",
  "sumber" => "https://javascript.info"
]

];

function kutipanMotivasi() {
  $kutipan = [
    "Jangan pernah menyerah, awal memang sulit.",
    "Teruslah belajar meskipun pelan.",
    "Setiap baris kode adalah langkah menuju masa depan.",
    "Bekerja keras akan membuahkan hasil."
  ];
  return $kutipan[rand(0, count($kutipan) - 1)];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Blog Reflektif Mahasiswa</title>
  <style>
    body {
      font-family: sans-serif;
      background-color: #fdf6f9;
      padding: 20px;
      color: #333;
    }

  nav {
      background-color:rgb(252, 190, 221);
      padding: 15px;
      text-align: center;
    }

    nav a {
      color: white;
      margin: 0 15px;
      text-decoration: none;
      font-weight: bold;
    }

    nav a:hover {
      text-decoration: underline;
    }

    h1 {
      text-align: center;
      color:rgb(255, 129, 192);
    }

    .artikel {
      margin-bottom: 30px;
      padding: 15px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 1px 5px rgba(0,0,0,0.1);
    }

    img {
      max-width: 100%;
      border-radius: 8px;
      margin-top: 10px;
      
    }

    .kembali {
      margin-top: 20px;
    }

    .kembali a {
      color:rgb(245, 142, 193);
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>


<nav>
  <a href="halaman1modul5.php">Profil</a>
  <a href="halaman2modul5.php">Timeline</a>
  <a href="halaman3modul5.php">Blog Reflektif</a>
</nav>

<h1>Blog Reflektif </h1>

<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $found = false;

  foreach ($artikel as $a) {
    if ($a['id'] == $id) {
      $found = true;
      echo "<div class='artikel'>";
      echo "<h2>{$a['judul']}</h2>";
      echo "<small><i>Diposting pada {$a['tanggal']}</i></small>";
      echo "<p>{$a['refleksi']}</p>";
      echo "<img src='{$a['gambar']}' alt='Gambar Artikel'>";
      echo "<blockquote><em>" . kutipanMotivasi() . "</em></blockquote>";
      if ($a['sumber'] != "") {
        echo "<p>Sumber: <a href='{$a['sumber']}' target='_blank'>{$a['sumber']}</a></p>";
      }
      echo "</div>";
      break;
    }
  }

  if (!$found) {
    echo "<p>Artikel tidak ditemukan.</p>";
  }

  echo "<div class='kembali'><a href='halaman3modul5.php'>← Kembali ke Daftar Artikel</a></div>";
} else {
  foreach ($artikel as $a) {
    echo "<div class='artikel'>";
    echo "<h3><a href='halaman3modul5.php?id={$a['id']}'>{$a['judul']}</a></h3>";
    echo "<small><i>{$a['tanggal']}</i></small>";
    echo "</div>";
  }
}
?>

</body>
</html>