<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Lab SE</title>
    <link href="<?= $_ENV['APP_URL'] ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-4">
        <div class="card shadow border-0 p-4">
            <div class="text-center mb-4">
                <i class="bi bi-shield-lock text-primary" style="font-size: 3rem;"></i>
                <h3 class="fw-bold mt-2">Lupa Password?</h3>
                <p class="text-muted small">Masukkan username Anda. Permintaan reset akan dikirim ke Super Admin.</p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>

            <form action="<?= $_ENV['APP_URL'] ?>/forgot-password" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username..." required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-3">Kirim Permintaan</button>
                <a href="<?= $_ENV['APP_URL'] ?>/login" class="btn btn-outline-secondary w-100">Kembali ke Login</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>