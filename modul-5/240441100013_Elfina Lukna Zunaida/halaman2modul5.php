<?php
function getTimeline() {
  return [
    "Semester 1" => "Masuk kuliah dan mengikuti ospek.",
    "Semester 2" => "Aktif di organisasi kampus.",
    "Semester 3" => "Mengasah pengalaman dengan tim."
  ];
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Timeline Pengalaman Kuliah</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f2f2f2;
    }
    .navbar {
      background: pink;
      padding: 10px;
      text-align: center;
    }
    .navbar a {
      text-decoration: none;
      margin: 0 10px;
      color: white;
      font-weight: bold;
    }
    h2 {
      text-align: center;
      margin-top: 20px;
    }
    .timeline {
      position: relative;
      max-width: 800px;
      margin: auto;
      padding: 20px 0;
    }
    .timeline::before {
      content: '';
      position: absolute;
      left: 30px;
      top: 0;
      bottom: 0;
      width: 4px;
      background: #999;
    }
    .item {
      position: relative;
      margin: 20px 0;
      padding-left: 60px;
    }
    .item::before {
      content: '';
      position: absolute;
      width: 16px;
      height: 16px;
      left: 22px;
      background: white;
      border: 4px solid orange;
      border-radius: 50%;
      top: 5px;
    }
    .content {
      background: white;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .content h3 {
      margin: 0 0 5px;
    }
    .buttons {
      text-align: center;
      margin-top: 30px;
    }
    .buttons a {
      text-decoration: none;
      background: #ff69b4;
      color: white;
      padding: 10px 15px;
      margin: 5px;
      border-radius: 5px;
    }
  </style>
</head>
<body>

  <div class="navbar">
    <a href="halaman1modul5.php">Profil</a>
    <a href="halaman3modul5.php">Blog</a>
  </div>

  <h2>Timeline Pengalaman Kuliah</h2>

  <div class="timeline">
    <?php foreach (getTimeline() as $semester => $isi): ?>
      <div class="item">
        <div class="content">
          <h3><?= $semester ?></h3>
          <p><?= $isi ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</body>
</html>
