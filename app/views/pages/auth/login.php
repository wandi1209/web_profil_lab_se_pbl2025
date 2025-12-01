<?php
// Pastikan session dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Lab SE</title>

    <!-- Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="<?= $_ENV['APP_URL'] ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= $_ENV['APP_URL'] ?>/assets/css/login.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="<?= $_ENV['APP_URL'] ?>/assets/js/bootstrap.bundle.min.js"></script>
    
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-4">

        <div class="card login-card shadow p-4">
            <h2 class="text-center fw-bold mb-4 text-primary">Login</h2>

            <!-- Alert Messages -->
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $_SESSION['success'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $_SESSION['error'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form action="<?= $_ENV['APP_URL'] ?>/login-proses" method="POST">
                
                <!-- Username -->
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input 
                            type="text" 
                            name="username"
                            class="form-control"
                            placeholder="Username"
                            value="<?= $_POST['username'] ?? '' ?>"
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

<script>
function togglePassword() {
    const passwordField = document.getElementById('password');
    const checkbox = document.getElementById('showPassword');
    
    if (checkbox.checked) {
        passwordField.type = 'text';
    } else {
        passwordField.type = 'password';
    }
}
</script>

</body>
</html>
