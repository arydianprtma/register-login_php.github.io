<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Jika sudah login, tampilkan halaman dashboard
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="asset/css/styles.css">
    <link rel="stylesheet" href="asset/css/dashboard.css">
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
        <p>Email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>

        <!-- Tombol Logout -->
        <form action="logout.php" method="post">
            <button class="logout-button" type="submit">Logout</button>
        </form>

        <!-- Tombol Delete Account -->
        <form action="delete_account.php" method="post" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
            <button class="delete-button" type="submit">Delete Account</button>
        </form>
    </div>
    <script>
        feather.replace();
    </script>
</body>
</html>
