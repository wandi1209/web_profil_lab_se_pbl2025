<?php
// Proses login sederhana
$isLoading = false;
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $isLoading = true;

    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    // Contoh logika login — silakan ganti sesuai sistem Anda
    if ($username === "admin" && $password === "123456") {
        $message = "<div class='alert alert-success text-center'>Login berhasil!</div>";
    } else {
        $message = "<div class='alert alert-danger text-center'>Username atau password salah!</div>";
    }

    $isLoading = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-4">

        <div class="card login-card shadow p-4">
            <h2 class="text-center fw-bold mb-4 text-primary">Login</h2>

            <!-- pesan login -->
            <?= $message ?>

            <form action="<?= $_ENV['APP_URL'] ?>/login-proses" method="POST">
                <?php 
                if(isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
                    unset($_SESSION['error']); 
                }
                ?>
                <!-- Username -->
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input 
                            type="text" 
                            name="username"
                            class="form-control"
                            placeholder="Username"
                            required
                        >
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input 
                            type="password" 
                            name="password"
                            id="password"
                            class="form-control"
                            placeholder="Password"
                            required
                        >
                    </div>
                </div>

                <!-- Show Password -->
                <div class="form-check my-2">
                    <input 
                        class="form-check-input" 
                        type="checkbox" 
                        id="showPassword" 
                        onclick="togglePassword()"
                    >
                    <label class="form-check-label" for="showPassword">
                        Tampilkan Password
                    </label>
                </div>

                <!-- Tombol login -->
                <button 
                    type="submit"
                    class="btn btn-primary w-100 py-2 fw-bold mt-3"
                >
                    Login →
                </button>

            </form>

        </div>
    </div>
</div>

</body>
</html>
