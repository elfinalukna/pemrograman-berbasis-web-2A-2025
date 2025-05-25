<!DOCTYPE html>
<html>
<head>
    <title>Profil Interaktif Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(251, 220, 220);
            text-align: center;
            margin: 0;
            padding: 40px;
        }
        .container {
            display: inline-block;
            text-align: left;
        }
        h2, h3 {
            color:rgb(216, 122, 122);
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 500px;
            background-color:rgb(243, 225, 225);
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color:rgb(247, 203, 236);
        }
        form {
            background-color:rgb(242, 155, 155);
            padding: 20px;
            border: 1px solid #ccc;
            width: 500px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"], textarea, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        input[type="submit"] {
            margin-top: 15px;
            padding: 10px 20px;
            background-color:rgb(250, 158, 244);
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color:rgb(238, 176, 250);
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        .result {
            background-color:rgb(255, 194, 234);
            padding: 15px;
            border: 1px solid rgb(248, 215, 252);
            width: 500px;
            margin: 20px auto;
        }
        .nav-link {
            margin-bottom: 20px;
            text-align: center;
        }
        .nav-link a {
            margin: 0 10px;
            color: rgb(128, 0, 64);
            text-decoration: none;
            font-weight: bold;
        }
        nav a {         
            color: white;         
            margin: 0 10px;       
            font-weight: bold;         
            text-decoration: none;         
            transition: color 0.3s; 
        } 
        nav a:hover {         
            color:beige; 
        }
        .footer-nav {        
            display: flex;         
            justify-content: center;         
            gap: 30px;        
            margin-top: 50px; 
        } 
 
    .footer-nav a { 
        background-color:blanchedalmond;        
        padding: 15px 30px;         
        color:indianred;         
        font-weight: bold;        
        text-decoration: none;         
        border-radius: 5px; 
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
        transition: background-color 0.3s, transform 0.2s;     } 
 
    .footer-nav a:hover {         
        background-color: #d07d59;         
        transform: scale(1.05);  
    } 



    </style>
</head>
<body>
<div class="container">
    <h2>Profil Interaktif Mahasiswa</h2>
    <table>
        <tr><th>Nama</th><td>Elfina Lukna Zunaida</td></tr>
        <tr><th>NIM</th><td>240441100013</td></tr>
        <tr><th>Tempat, Tanggal Lahir</th><td>Bojonegoro, 01 Desember 2005</td></tr>
        <tr><th>Email</th><td>elfinalukna12345@gmail.com</td></tr>
        <tr><th>Nomor HP</th><td>082230307949</td></tr>
    </table>

    <h3>Formulir Tambahan</h3>
    <form method="POST">
        <label>Bahasa Pemrograman yang Dikuasai (pisahkan dengan koma):</label>
        <input type="text" name="bahasa" placeholder="Contoh: PHP, Python, JavaScript">

        <label>Pengalaman Membuat Proyek Pribadi:</label>
        <textarea name="pengalaman" rows="3"></textarea>

        <label>Software yang Sering Digunakan:</label>
        <input type="checkbox" name="software[]" value="VS Code"> VS Code
        <input type="checkbox" name="software[]" value="XAMPP"> XAMPP
        <input type="checkbox" name="software[]" value="Git"> Git

        <label>Sistem Operasi yang Digunakan:</label>
        <input type="radio" name="os" value="Windows"> Windows
        <input type="radio" name="os" value="Linux"> Linux
        <input type="radio" name="os" value="Mac"> Mac

        <label>Tingkat Penguasaan PHP:</label>
        <select name="tingkat_php">
            <option value="">--Pilih--</option>
            <option value="Pemula">Pemula</option>
            <option value="Menengah">Menengah</option>
            <option value="Mahir">Mahir</option>
        </select>

        <input type="submit" name="submit" value="Kirim">
    </form>

    <?php
    function tampilkanHasil($bahasaArray, $pengalaman, $software, $os, $tingkat_php) {
        echo "<div class='result'>";
        echo "<h3>Hasil Input</h3>";
        echo "<table>
                <tr><th>Bahasa Pemrograman</th><td>" . implode(", ", $bahasaArray) . "</td></tr>
                <tr><th>Pengalaman</th><td>$pengalaman</td></tr>
                <tr><th>Software</th><td>" . implode(", ", $software) . "</td></tr>
                <tr><th>Sistem Operasi</th><td>$os</td></tr>
                <tr><th>Tingkat PHP</th><td>$tingkat_php</td></tr>
              </table>";
        echo "<p><em>Pengalaman proyek:</em> $pengalaman</p>";
        echo "<p>Anda menggunakan <strong>$os</strong> dan tingkat PHP <strong>$tingkat_php</strong>.</p>";
        if (count($bahasaArray) > 2) {
            echo "<p><strong>Anda cukup berpengalaman dalam pemrograman!</strong></p>";
        }
        echo "</div>";
    }

    if (isset($_POST['submit'])) {
        $bahasaInput = $_POST['bahasa'] ?? '';
        $bahasaArray = array_map('trim', explode(',', $bahasaInput));
       
        $pengalaman = trim($_POST['pengalaman']);
        $software = $_POST['software'] ?? [];
        $os = $_POST['os'] ?? '';
        $tingkat_php = $_POST['tingkat_php'];

        if (empty($bahasaArray) || empty($pengalaman) || empty($software) || empty($os) || empty($tingkat_php)) {
            echo "<p class='error'>Semua input wajib diisi!</p>";
        } 
        else {
            tampilkanHasil($bahasaArray, $pengalaman, $software, $os, $tingkat_php);
        }
    }
    ?>
</div>
<div class="footer-nav"> 
        <a href="halaman2modul5.php">Timeline Kuliah</a> 
        <a href="halaman3modul5.php">Blog</a> 
    </div> 


</body>
</html>
