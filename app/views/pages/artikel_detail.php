<?php
// SIMULASI PENGAMBILAN DATA
// Asumsi ID artikel diambil dari URL (misal: artikel_detail.php?id=101)
$article_id = isset($_GET['id']) ? (int)$_GET['id'] : 101; 

// DATA ARTIKEL UTAMA (Contoh Data ID 101)
$article_data = [
    'title' => 'Menguasai Microservices: Panduan Implementasi dengan Kubernetes',
    'author' => 'Dr. Budi Santoso',
    'date' => '25 November 2025',
    'reading_time' => '12 Menit',
    'category' => 'Cloud Computing',
    'tags' => ['Kubernetes', 'DevOps', 'Cloud Native'],
    'hero_image' => 'assets/images/gedung.webp', 
    
    // Konten Artikel dalam bentuk array block
    'content_blocks' => [
        'Pengantar' => 'Arsitektur Microservices telah menjadi standar industri dalam pengembangan aplikasi skala besar. Ini memungkinkan tim untuk bekerja secara independen dan mendeploy layanan lebih cepat. Namun, manajemen ribuan kontainer membawa tantangan baru yang menuntut orkestrasi cerdas.',
        
        'Mengapa Microservices?' => [
            'Pola Microservices menawarkan skalabilitas horizontal, memungkinkan layanan individu dikembangkan dan ditingkatkan secara terpisah.',
            'Memberikan ketahanan (*resilience*) yang lebih baik; jika satu layanan gagal, seluruh aplikasi tidak akan down.',
            'Mengurangi *technical debt* yang sering terjadi pada arsitektur monolitik yang besar.'
        ],
        
        'Tantangan Integrasi' => 'Tantangan utama termasuk manajemen *state*, komunikasi antar-layanan yang kompleks (menggunakan *API Gateway*), dan kebutuhan akan *logging/monitoring* terpusat yang efisien.',
        
        'Peran Kubernetes' => 'Kubernetes (K8s) adalah orkestrator kontainer *de facto*. Tugas utamanya adalah mengotomatisasi *deployment*, *scaling*, dan manajemen aplikasi yang dikemas dalam kontainer. K8s adalah tulang punggung untuk mengelola ekosistem Microservices yang kompleks.',
        
        'Studi Kasus: Pola Desain' => 'Dalam proyek kami, kami mengadopsi pola *Service Mesh* menggunakan Istio untuk manajemen komunikasi dan keamanan (misalnya, mTLS antar-layanan). Ini memastikan bahwa semua komunikasi internal dienkripsi dan terstruktur.',
        
        'Kesimpulan' => 'Memigrasikan dari monolit ke Microservices adalah investasi besar, tetapi dengan orkestrasi Kubernetes yang tepat, Laboratorium kami dapat mencapai fleksibilitas dan kecepatan yang diperlukan di pasar digital saat ini. Artikel selanjutnya akan membahas detail konfigurasi Istio.'
    ]
];
// Jika ID tidak 101, Anda dapat menampilkan error atau konten default.
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $article_data['title'] ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="lab_profile.css">
    <link rel="stylesheet" href="assets/css/artikel.css"> 
    <link rel="stylesheet" href="assets/css/article_detail.css"> </head>
<body>

<div class="vm-wrapper article-detail-page">
    <article class="article-container">

        <header class="detail-header">
            <span class="detail-category"><?= $article_data['category'] ?></span>
            <h1 class="detail-title"><?= $article_data['title'] ?></h1>
            <div class="detail-meta">
                <span class="meta-item"><i class="bi bi-person-circle"></i> <?= $article_data['author'] ?></span>
                <span class="meta-item"><i class="bi bi-calendar"></i> <?= $article_data['date'] ?></span>
                <span class="meta-item"><i class="bi bi-clock"></i> <?= $article_data['reading_time'] ?></span>
            </div>
        </header>
        
        <figure class="detail-hero">
            <img src="<?= $article_data['hero_image'] ?>" alt="Ilustrasi: <?= $article_data['title'] ?>">
            <figcaption>Ilustrasi Microservices di Kubernetes.</figcaption>
        </figure>

        <div class="detail-body">
            
            <?php foreach ($article_data['content_blocks'] as $heading => $body): ?>
                
                <?php if ($heading == 'Pengantar'): ?>
                    <p class="article-lead"><?= $body ?></p>
                    
                    <blockquote>
                        "Orkestrasi kontainer bukan lagi pilihan, melainkan keharusan untuk mencapai skalabilitas di era Microservices."
                    </blockquote>
                
                <?php elseif (is_array($body)): ?>
                    <h2><?= $heading ?></h2>
                    <ul class="article-list">
                        <?php foreach ($body as $item): ?>
                            <li><?= $item ?></li>
                        <?php endforeach; ?>
                    </ul>
                
                <?php else: ?>
                    <h2><?= $heading ?></h2>
                    <p><?= $body ?></p>
                <?php endif; ?>
                
            <?php endforeach; ?>
        </div>

        <footer class="detail-footer">
            <div class="tag-list">
                <?php foreach($article_data['tags'] as $tag): ?>
                    <a href="artikel.php?tag=<?= $tag ?>">#<?= $tag ?></a>
                <?php endforeach; ?>
            </div>
            
            <a href="artikel.php" class="btn-back-to-list">
                <i class="bi bi-arrow-left-short"></i> Kembali ke Daftar
            </a>
        </footer>

    </article>
</div>

</body>
</html>