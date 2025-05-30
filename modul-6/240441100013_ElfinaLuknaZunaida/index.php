<?php
require 'koneksi.php';

$message = '';

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        $message = "Username sudah dipakai!";
    } else {
        mysqli_query($conn, "INSERT INTO users (username,password) VALUES ('$username','$password')");
        $message = "Registrasi berhasil, silakan login.";
    }
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = $_POST['password'];
    $q = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if ($q && mysqli_num_rows($q) > 0) {
        $user = mysqli_fetch_assoc($q);
        if (password_verify($pass, $user['password'])) {
            $_SESSION['user'] = $username;
            header('Location: dashboard.php');
            exit;
        } else {
            $message = "Password salah!";
        }
    } else {
        $message = "Username tidak ditemukan! Silahkan mengisi kolom Registrasi!";
    }
}

if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Login & Registrasi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center mt-8 mb-10 px-4">

  <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center mb-4">Login</h2>
    <?php if(isset($message) && $message): ?>
      <div class="text-red-500 text-center mb-4"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <form method="post" onsubmit="return validateLogin()" class="space-y-4">
      <input type="text" name="username" placeholder="Username" required
             class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
      <input type="password" name="password" placeholder="Password" required
             class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
      <button type="submit" name="login"
              class="w-full bg-blue-400 hover:bg-blue-500 text-white font-semibold py-2 rounded-md transition duration-200">
        Login
      </button>
    </form>

    <hr class="my-6 border-gray-300" />

    <h2 class="text-2xl font-bold text-center mb-4">Registrasi</h2>
    <form method="post" onsubmit="return validateRegister()" class="space-y-4">
      <input type="text" name="username" placeholder="Username" required
             class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
      <input type="password" name="password" placeholder="Password" required minlength="6"
             class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
      <button type="submit" name="register"
              class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-md transition duration-200">
        Daftar
      </button>
    </form>
  </div>

  <script>
    function validateLogin() {
      return true;
    }
    function validateRegister() {
      const pw = document.querySelector('form:last-of-type input[name=password]').value;
      if (pw.length < 6) {
        alert('Password minimal 6 karakter');
        return false;
      }
      return true;
    }
  </script>

</body>
</html>
