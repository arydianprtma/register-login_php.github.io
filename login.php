<?php
session_start();

$servername = "localhost";
$username = "root"; // Ganti dengan nama pengguna MySQL Anda
$password = ""; // Ganti dengan kata sandi MySQL Anda
$dbname = "register_login"; // Ganti dengan nama database Anda

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Ambil data yang di-submit dari form login
    $username_email = isset($_POST['username_email']) ? $_POST['username_email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // SQL untuk mengambil data pengguna dari database
    $sql = "SELECT id, username, email, password FROM users WHERE username = :username_email OR email = :username_email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username_email', $username_email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Ada pengguna dengan username/email yang diberikan
        if (password_verify($password, $result['password'])) {
            // Password cocok, login berhasil
            // Simpan data pengguna ke dalam sesi
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['email'] = $result['email'];
            // Arahkan pengguna ke halaman dashboard atau halaman lain yang diinginkan setelah login berhasil
            header("Location: dashboard.php");
            exit();
        } else {
            // Password tidak cocok, login gagal
            echo "<script>alert('Password salah'); window.location.href = 'index.html';</script>";
        }
    } else {
        // Tidak ada pengguna dengan username/email yang diberikan
        echo "<script>alert('Pengguna tidak ditemukan'); window.location.href = 'index.html';</script>";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
