<div class="container-fluid py-4">
    
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><?= $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i><?= $_SESSION['error']; unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm bg-primary text-white mb-5 overflow-hidden position-relative welcome-banner">
        <div class="card-body p-4 position-relative" style="z-index: 2;">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h2 class="fw-bold mb-1">Dashboard Admin</h2>
                    <p class="mb-0 opacity-75">Selamat datang kembali! Berikut adalah ringkasan aktivitas laboratorium hari ini.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-white bg-opacity-25 px-3 py-2 rounded-3 d-flex align-items-center backdrop-blur">
                        <i class="bi bi-clock me-2"></i>
                        <span id="clock-wib" class="fw-medium font-monospace">--:-- WIB</span>
                    </div>
                    <form method="POST" action="<?= $_ENV['APP_URL'] ?>/admin/refresh-stats">
                        <button class="btn btn-light text-primary fw-bold shadow-sm">
                            <i class="bi bi-arrow-clockwise me-1"></i> Refresh
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="position-absolute top-0 end-0 h-100 w-50 bg-white opacity-10" style="transform: skewX(-20deg) translateX(50%);"></div>
    </div>

    <div class="d-flex align-items-center mb-3">
        <div class="bg-primary rounded-pill me-2" style="width: 4px; height: 20px;"></div>
        <h6 class="text-uppercase fw-bold text-dark m-0 ls-1">Statistik Pendaftar</h6>
    </div>

    <div class="row g-3 mb-5">
        <?php
        $pendaftarMetrics = [
            ['label' => 'Total Pendaftar', 'val' => $summary['total_pendaftar'] ?? 0, 'icon' => 'bi-people-fill', 'color' => 'primary', 'bg_gradient' => 'linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%)'],
            ['label' => 'Menunggu',        'val' => $summary['pending_count'] ?? 0,   'icon' => 'bi-hourglass-split', 'color' => 'warning', 'bg_gradient' => 'linear-gradient(135deg, #ffc107 0%, #e0a800 100%)'],
            ['label' => 'Diterima',        'val' => $summary['diterima_count'] ?? 0,  'icon' => 'bi-check-circle-fill', 'color' => 'success', 'bg_gradient' => 'linear-gradient(135deg, #198754 0%, #146c43 100%)'],
            ['label' => 'Ditolak',         'val' => $summary['ditolak_count'] ?? 0,   'icon' => 'bi-x-circle-fill', 'color' => 'danger', 'bg_gradient' => 'linear-gradient(135deg, #dc3545 0%, #b02a37 100%)'],
        ];
        
        foreach ($pendaftarMetrics as $m): ?>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100 card-stat hover-lift">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted text-uppercase small fw-bold mb-1"><?= $m['label'] ?></p>
                                <h2 class="fw-bold text-dark mb-0"><?= $m['val'] ?></h2>
                            </div>
                            <div class="stat-icon text-white shadow-sm" style="background: <?= $m['bg_gradient'] ?>;">
                                <i class="bi <?= $m['icon'] ?>"></i>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height: 4px;">
                            <div class="progress-bar bg-<?= $m['color'] ?>" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="row g-4">
        
        <div class="col-lg-4 d-flex flex-column gap-4">
            
            <div>
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-purple rounded-pill me-2" style="width: 4px; height: 20px;"></div>
                    <h6 class="text-uppercase fw-bold text-dark m-0 ls-1">Data Personil</h6>
                </div>
                
                <div class="row g-3">
                    <?php
                    $personilMetrics = [
                        ['label' => 'Total Personil', 'val' => $summary['total_personil'] ?? 0, 'icon' => 'bi-person-badge', 'color' => '#6f42c1', 'bg' => '#f3e8ff'], // Ungu
                        ['label' => 'Dosen',          'val' => $summary['dosen_count'] ?? 0,    'icon' => 'bi-mortarboard',  'color' => '#0dcaf0', 'bg' => '#e0faff'], // Cyan
                        ['label' => 'Mahasiswa',      'val' => $summary['mhs_count'] ?? 0,      'icon' => 'bi-backpack',     'color' => '#fd7e14', 'bg' => '#fff4e6'], // Orange
                    ];
                    foreach ($personilMetrics as $p): ?>
                        <div class="col-12">
                            <div class="card border-0 shadow-sm card-personil hover-lift-sm">
                                <div class="card-body d-flex align-items-center p-3">
                                    <div class="icon-box rounded-3 me-3 d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px; background-color: <?= $p['bg'] ?>; color: <?= $p['color'] ?>;">
                                        <i class="bi <?= $p['icon'] ?> fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-0 text-dark"><?= $p['val'] ?></h5>
                                        <small class="text-muted"><?= $p['label'] ?></small>
                                    </div>
                                    <i class="bi bi-chevron-right ms-auto text-light-gray"></i>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="card border-0 shadow-sm flex-grow-1">
                <div class="card-header bg-white py-3 border-0">
                    <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-pie-chart me-2 text-primary"></i>Rasio Penerimaan</h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center position-relative">
                    <div class="chart-container" style="position: relative; height: 200px; width: 100%;">
                        <canvas id="chartStatus"></canvas>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-bar-chart-line me-2 text-primary"></i>Tren Pendaftar per Angkatan</h6>
                        <small class="text-muted">Visualisasi jumlah pendaftar berdasarkan tahun angkatan</small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container w-100" style="height: 400px;">
                        <canvas id="chartPerYear"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    /* Tipografi & Warna Custom */
    .ls-1 { letter-spacing: 1px; }
    .bg-purple { background-color: #6f42c1; }
    .text-light-gray { color: #e9ecef; }
    .backdrop-blur { backdrop-filter: blur(5px); }

    /* Card Hover Effects */
    .hover-lift {
        transition: transform 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.25s ease;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
    }
    .hover-lift-sm {
        transition: transform 0.2s ease;
    }
    .hover-lift-sm:hover {
        transform: translateY(-2px);
    }

    /* Icon Styling */
    .stat-icon {
        width: 48px; height: 48px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem;
    }
    
    /* Welcome Banner Gradient */
    .welcome-banner {
        background: linear-gradient(120deg, #0d6efd 0%, #0099ff 100%);
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Data PHP to JS
    const perYear = <?= json_encode($perYear ?? [], JSON_UNESCAPED_UNICODE) ?>;
    const summary = <?= json_encode($summary ?? [], JSON_UNESCAPED_UNICODE) ?>;

    // --- Chart 1: Bar Chart (Pendaftar per Tahun) ---
    const ctxYear = document.getElementById('chartPerYear');
    if (ctxYear && perYear.length > 0) {
        const gradient = ctxYear.getContext('2d').createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(13, 110, 253, 0.8)');
        gradient.addColorStop(1, 'rgba(13, 110, 253, 0.1)');

        new Chart(ctxYear, {
            type: 'bar',
            data: {
                labels: perYear.map(d => d.tahun),
                datasets: [{
                    label: 'Jumlah Pendaftar',
                    data: perYear.map(d => d.jumlah),
                    backgroundColor: gradient,
                    borderRadius: 8,
                    borderWidth: 0,
                    barPercentage: 0.5,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        cornerRadius: 8,
                        titleFont: { size: 13 },
                        bodyFont: { size: 14 }
                    }
                },
                scales: {
                    y: { 
                        beginAtZero: true, 
                        grid: { borderDash: [5, 5], color: '#f1f5f9' },
                        ticks: { stepSize: 1 }
                    },
                    x: { 
                        grid: { display: false } 
                    }
                }
            }
        });
    }

    // --- Chart 2: Doughnut (Status) ---
    const ctxStatus = document.getElementById('chartStatus');
    if (ctxStatus) {
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Diterima', 'Ditolak'],
                datasets: [{
                    data: [
                        summary.pending_count || 0,
                        summary.diterima_count || 0,
                        summary.ditolak_count || 0
                    ],
                    backgroundColor: ['#ffc107', '#198754', '#dc3545'], // Kuning, Hijau, Merah
                    borderColor: '#ffffff',
                    borderWidth: 2,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: { 
                    legend: { 
                        position: 'bottom',
                        labels: { usePointStyle: true, boxWidth: 8, padding: 20 }
                    } 
                }
            }
        });
    }

    // --- Realtime Clock ---
    function updateClock() {
        const now = new Date();
        const options = { 
            timeZone: 'Asia/Jakarta', 
            hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false 
        };
        const timeString = new Intl.DateTimeFormat('id-ID', options).format(now);
        document.getElementById('clock-wib').textContent = timeString + ' WIB';
    }
    setInterval(updateClock, 1000);
    updateClock();
});
</script>