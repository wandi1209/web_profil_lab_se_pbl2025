<?php
// Data Laboratorium dalam bentuk Array PHP
$lab_profile = [
    'title' => 'PROFIL LABORATORIUM REKAYASA PERANGKAT LUNAK',
    'subtitle' => 'Pusat Riset Unggulan dalam Teknologi Perangkat Lunak Terdistribusi',
    
    // Bagian 1: Fokus Riset & Pengembangan (3-4 item)
    'competencies' => [
        [
            'title' => 'Arsitektur Cloud & Microservices',
            'icon' => 'cloud', 
            'description' => 'Eksplorasi dan implementasi arsitektur perangkat lunak berbasis *Cloud Native*, containerization (Docker, Kubernetes), dan pola desain Microservices.',
        ],
        [
            'title' => 'DevOps & Otomasi CI/CD',
            'icon' => 'tools',
            'description' => 'Menerapkan budaya dan praktik DevOps, termasuk integrasi berkelanjutan (CI) dan deployment berkelanjutan (CD) menggunakan GitLab/Jenkins.',
        ],
        [
            'title' => 'Keamanan Aplikasi (AppSec)',
            'icon' => 'lock',
            'description' => 'Riset mendalam mengenai pengujian keamanan aplikasi (SAST, DAST) dan praktik pemrograman aman untuk mencegah kerentanan.',
        ],
    ],
    
    // Bagian 2: Infrastruktur Digital & Sumber Daya (Daftar Sumber Daya Digital)
    'equipments' => [
        ['name' => 'Git Repository Server', 'model' => 'GitLab Enterprise Edition', 'status' => 'Aktif'],
        ['name' => 'Platform Container', 'model' => 'Kubernetes Cluster (5 Node)', 'status' => 'Aktif'],
        ['name' => 'Lisensi Pengembangan', 'model' => 'JetBrains All Products Pack', 'status' => 'Lisensi'],
        ['name' => 'Server High Performance', 'model' => 'AWS/GCP Dedicated Instance (64GB RAM)', 'status' => 'Aktif'],
    ],
    
    // Bagian 3: Metode Kerja (Baru, untuk menunjukkan proses)
    'methodology' => [
        'title' => 'Metode Kerja',
        'content' => 'Laboratorium beroperasi menggunakan **Metodologi Agile/Scrum** yang menekankan pada iterasi cepat, kolaborasi tim, dan penyesuaian yang responsif terhadap perubahan kebutuhan. Proses pengembangan didukung penuh oleh Continuous Integration/Continuous Delivery (CI/CD).'
    ]
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lab_profile['title']; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/lab_profile.css">
<body>

    <div class="vm-wrapper lab-wrapper">

        <header class="lab-header">
            <h1 class="section-title"><?php echo $lab_profile['title']; ?></h1>
            <p class="lab-subtitle"><?php echo $lab_profile['subtitle']; ?></p>
        </header>
        
        <hr class="divider">

        <section class="competency-section">
            <h2 class="sub-section-title">Fokus Riset & Pengembangan</h2>
            <div class="competency-grid">
                
                <?php foreach ($lab_profile['competencies'] as $index => $comp): ?>
                <div class="comp-card">
                    <div class="comp-icon-box">
                        <i class="bi bi-<?php echo $comp['icon']; ?>"></i>
                    </div>
                    <div class="comp-content">
                        <h3 class="comp-title"><?php echo $comp['title']; ?></h3>
                        <p class="comp-text"><?php echo $comp['description']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </section>

        <section class="methodology-section">
            <h2 class="sub-section-title"><?php echo $lab_profile['methodology']['title']; ?></h2>
            <div class="method-box">
                <i class="bi bi-diagram-3-fill method-icon"></i>
                <p class="method-text"><?php echo $lab_profile['methodology']['content']; ?></p>
            </div>
        </section>
        
        <hr class="divider">

        <section class="equipment-section">
            <h2 class="sub-section-title">Infrastruktur Digital & Sumber Daya</h2>
            
            <table class="equipment-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Sumber Daya</th>
                        <th>Model/Spesifikasi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lab_profile['equipments'] as $index => $eq): ?>
                    <tr>
                        <td data-label="No"><?php echo $index + 1; ?></td>
                        <td data-label="Nama Sumber Daya"><?php echo $eq['name']; ?></td>
                        <td data-label="Model/Spesifikasi"><?php echo $eq['model']; ?></td>
                        <td data-label="Status"><span class="status-tag status-<?php echo strtolower($eq['status']); ?>"><?php echo $eq['status']; ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

    </div>

</body>
</html>