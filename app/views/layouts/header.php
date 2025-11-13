<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Judul Default' ?></title>
    <link rel="stylesheet" href="<?= $_ENV['APP_URL'] ?>/assets/css/bootstrap.min.css">
</head>
<body>
    <nav>
        <a href="<?= $_ENV['APP_URL'] ?>/">Home</a>
        <a href="<?= $_ENV['APP_URL'] ?>/about">About</a>
    </nav>
    <main class="container">