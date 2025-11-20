<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'CMS' ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/web_profil_lab_se_pbl2025/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/web_profil_lab_se_pbl2025/assets/css/styles.css">
    <link rel="stylesheet" href="/web_profil_lab_se_pbl2025/assets/css/sidebar.css">
    
    
</head>

<body class="d-flex flex-column min-vh-100">

<!-- WRAPPER: SIDEBAR + CONTENT -->
<div class="d-flex flex-grow-1">

    <!-- SIDEBAR -->
    <?php include 'sidebar.php'; ?>

    <!-- KONTEN -->
    <main class="flex-grow-1 p-4 d-flex flex-column justify-content-center text-center">