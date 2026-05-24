@extends('layouts.app')

@section('title', 'Dashboard Utama')
@section('page_title', 'Dashboard Utama')

@section('content')
    <!-- Welcome Hero Premium -->
    <div class="welcome-hero" style="position: relative; overflow: hidden; padding: 3rem 2.5rem; margin-bottom: 2rem;">
        <div style="position: relative; z-index: 2; max-width: 800px;">
            <span class="badge-modern" style="margin-bottom: 1rem; display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255, 255, 255, 0.2); color: #ffffff; font-weight: 700; font-size: 0.75rem; letter-spacing: 0.05em; text-transform: uppercase; border: 1px solid rgba(255,255,255,0.35); border-radius: 9999px; padding: 0.35rem 0.85rem;">
                <span style="width: 6px; height: 6px; background-color: #86efac; border-radius: 50%; display: inline-block; animation: badgePulse 2s infinite;"></span>
                Sistem Pengambilan Keputusan Aktif
            </span>
            <h2 class="welcome-hero-title" style="font-family: var(--font-heading); font-size: 2.25rem; font-weight: 800; line-height: 1.2; margin-bottom: 0.75rem;">
                Selamat Datang di <span style="background: rgba(255,255,255,0.25); -webkit-background-clip: text; background-clip: text; text-decoration: underline; text-decoration-color: rgba(255,255,255,0.5);">BanSmart</span>, {{ Auth::user()->name }}!
            </h2>
            <p style="color: rgba(255, 255, 255, 0.85); font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem; max-width: 680px;">
                Aplikasi Sistem Pendukung Keputusan penentuan kelayakan penerima Bantuan Sosial berbasis web modern. Mengintegrasikan metode <strong>Analytical Hierarchy Process (AHP)</strong> untuk penentuan bobot prioritas kriteria dan <strong>TOPSIS</strong> untuk perangkingan alternatif warga secara objektif dan akurat.
            </p>
            <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                <span style="padding: 0.4rem 1rem; font-size: 0.8rem; background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); color: #ffffff; display: flex; align-items: center; gap: 0.4rem; border-radius: 9999px; font-weight: 600;">
                    <i class="fa-solid fa-shield-halved" style="color: #bfdbfe;"></i> Hak Akses: <strong>{{ ucfirst(Auth::user()->role) }}</strong>
                </span>
                <span style="padding: 0.4rem 1rem; font-size: 0.8rem; background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); color: #ffffff; display: flex; align-items: center; gap: 0.4rem; border-radius: 9999px; font-weight: 600;">
                    <i class="fa-solid fa-server" style="color: #86efac;"></i> Status DB: <strong style="color: #86efac;">Terkoneksi</strong>
                </span>
            </div>
        </div>
    </div>

    <!-- Quick Actions Grid -->
    <div style="margin-bottom: 2rem;">
        <h4 style="font-family: var(--font-heading); color: var(--text-primary); font-size: 1rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-wand-magic-sparkles" style="color: var(--primary-gradient-start);"></i> Menu Akses Cepat
        </h4>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
            <a href="{{ route('warga.index') }}" class="card-modern quick-action-card quick-action-blue" style="padding: 1.25rem; display: flex; align-items: center; gap: 1rem; text-decoration: none; color: inherit; transition: var(--transition-smooth); border: 1px solid rgba(226, 232, 240, 0.8);">
                <div style="width: 44px; height: 44px; border-radius: 12px; background: var(--accent-blue-light); color: var(--primary-gradient-start); display: flex; align-items: center; justify-content: center; font-size: 1.15rem;">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <h5 style="margin: 0; font-size: 0.9rem; font-weight: 700; font-family: var(--font-heading);">Kelola Warga</h5>
                    <p style="margin: 0; font-size: 0.75rem; color: var(--text-muted);">Pendataan warga alternatif</p>
                </div>
            </a>
            
            <a href="{{ route('ahp.index') }}" class="card-modern quick-action-card quick-action-emerald" style="padding: 1.25rem; display: flex; align-items: center; gap: 1rem; text-decoration: none; color: inherit; transition: var(--transition-smooth); border: 1px solid rgba(226, 232, 240, 0.8);">
                <div style="width: 44px; height: 44px; border-radius: 12px; background: var(--accent-emerald-light); color: var(--accent-emerald); display: flex; align-items: center; justify-content: center; font-size: 1.15rem;">
                    <i class="fa-solid fa-scale-balanced"></i>
                </div>
                <div>
                    <h5 style="margin: 0; font-size: 0.9rem; font-weight: 700; font-family: var(--font-heading);">Analisis AHP</h5>
                    <p style="margin: 0; font-size: 0.75rem; color: var(--text-muted);">Pembobotan kriteria Saaty</p>
                </div>
            </a>

            <a href="{{ route('topsis.index') }}" class="card-modern quick-action-card quick-action-cyan" style="padding: 1.25rem; display: flex; align-items: center; gap: 1rem; text-decoration: none; color: inherit; transition: var(--transition-smooth); border: 1px solid rgba(226, 232, 240, 0.8);">
                <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(6, 182, 212, 0.08); color: #06b6d4; display: flex; align-items: center; justify-content: center; font-size: 1.15rem;">
                    <i class="fa-solid fa-ranking-star"></i>
                </div>
                <div>
                    <h5 style="margin: 0; font-size: 0.9rem; font-weight: 700; font-family: var(--font-heading);">Proses TOPSIS</h5>
                    <p style="margin: 0; font-size: 0.75rem; color: var(--text-muted);">Perangkingan penerima bansos</p>
                </div>
            </a>

            <a href="{{ route('laporan.index') }}" class="card-modern quick-action-card quick-action-amber" style="padding: 1.25rem; display: flex; align-items: center; gap: 1rem; text-decoration: none; color: inherit; transition: var(--transition-smooth); border: 1px solid rgba(226, 232, 240, 0.8);">
                <div style="width: 44px; height: 44px; border-radius: 12px; background: var(--accent-yellow-light); color: var(--accent-yellow); display: flex; align-items: center; justify-content: center; font-size: 1.15rem;">
                    <i class="fa-solid fa-print"></i>
                </div>
                <div>
                    <h5 style="margin: 0; font-size: 0.9rem; font-weight: 700; font-family: var(--font-heading);">Laporan Cetak</h5>
                    <p style="margin: 0; font-size: 0.75rem; color: var(--text-muted);">Export PDF, Excel & Cetak Kop</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="stats-grid" style="margin-bottom: 2rem;">
        <!-- Warga -->
        <a href="{{ route('warga.index') }}" style="text-decoration: none; color: inherit;">
            <div class="card-stat stat-card-blue" style="transition: var(--transition-smooth); position: relative; overflow: hidden; border-radius: var(--radius-2xl); border: 1px solid var(--border-color); box-shadow: var(--shadow-premium-sm);">
                <div class="stat-info">
                    <span class="stat-label">Warga Terdaftar</span>
                    <span class="stat-value" style="font-family: var(--font-heading); font-weight: 800;">{{ $wargaCount }}</span>
                </div>
                <div class="stat-icon-wrapper icon-blue" style="box-shadow: var(--shadow-premium-sm);">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
        </a>

        <!-- Kriteria -->
        <a href="{{ route('kriteria.index') }}" style="text-decoration: none; color: inherit;">
            <div class="card-stat stat-card-emerald" style="transition: var(--transition-smooth); position: relative; overflow: hidden; border-radius: var(--radius-2xl); border: 1px solid var(--border-color); box-shadow: var(--shadow-premium-sm);">
                <div class="stat-info">
                    <span class="stat-label">Kriteria Penilaian</span>
                    <span class="stat-value" style="font-family: var(--font-heading); font-weight: 800;">{{ $kriteriaCount }}</span>
                </div>
                <div class="stat-icon-wrapper icon-emerald" style="box-shadow: var(--shadow-premium-sm);">
                    <i class="fa-solid fa-list-check"></i>
                </div>
            </div>
        </a>

        <!-- Subkriteria -->
        <a href="{{ route('sub-kriteria.index') }}" style="text-decoration: none; color: inherit;">
            <div class="card-stat stat-card-amber" style="transition: var(--transition-smooth); position: relative; overflow: hidden; border-radius: var(--radius-2xl); border: 1px solid var(--border-color); box-shadow: var(--shadow-premium-sm);">
                <div class="stat-info">
                    <span class="stat-label">Skala Penilaian</span>
                    <span class="stat-value" style="font-family: var(--font-heading); font-weight: 800;">{{ $subKriteriaCount }}</span>
                </div>
                <div class="stat-icon-wrapper icon-yellow" style="box-shadow: var(--shadow-premium-sm);">
                    <i class="fa-solid fa-sliders"></i>
                </div>
            </div>
        </a>

        <!-- Bantuan Aktif -->
        <div class="card-stat stat-card-rose" style="position: relative; overflow: hidden; border-radius: var(--radius-2xl); border: 1px solid var(--border-color); box-shadow: var(--shadow-premium-sm);">
            <div class="stat-info">
                <span class="stat-label">Bansos Aktif</span>
                <span class="stat-value" style="font-family: var(--font-heading); font-weight: 800;">{{ $bantuanAktifCount }}</span>
            </div>
            <div class="stat-icon-wrapper icon-red" style="box-shadow: var(--shadow-premium-sm);">
                <i class="fa-solid fa-hand-holding-heart"></i>
            </div>
        </div>
    </div>

    <!-- Main Panels Grid -->
    <div class="dashboard-panels" style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; margin-bottom: 2rem;">
        
        <!-- Left Panel: Graphic Charts -->
        <div class="card-modern chart-panel" data-chart-panel style="min-height: 400px; display: flex; flex-direction: column;">
            <div class="card-header-modern">
                <h3 class="card-title-modern">
                    <i class="fa-solid fa-chart-pie" style="color: var(--accent-blue);"></i> Visualisasi Distribusi Warga
                </h3>
                <span style="font-size: 0.8rem; color: var(--text-secondary);">Berdasarkan Desa & Kategori Bantuan</span>
            </div>
            
            <div class="chart-grid">
                <!-- Chart 1 -->
                <div class="chart-shell">
                    <canvas id="chartDesa"></canvas>
                    <span class="chart-caption">Warga per Wilayah Desa</span>
                </div>

                <!-- Chart 2 -->
                <div class="chart-shell">
                    <canvas id="chartBantuan"></canvas>
                    <span class="chart-caption">Status Bantuan Sebelumnya</span>
                </div>
            </div>
        </div>

        <!-- Right Panel: TOPSIS Ranking Preview -->
        <div class="card-modern" style="display: flex; flex-direction: column;">
            <div class="card-header-modern" style="margin-bottom: 1rem;">
                <h3 class="card-title-modern">
                    <i class="fa-solid fa-trophy" style="color: #fbbf24;"></i> Hasil Ranking Teratas
                </h3>
                <a href="{{ route('topsis.index') }}" style="font-size: 0.75rem; color: var(--primary-gradient-start); text-decoration: none; font-weight: 600;">Lihat Semua <i class="fa-solid fa-chevron-right" style="font-size: 0.65rem;"></i></a>
            </div>

            <div style="flex: 1; display: flex; flex-direction: column; justify-content: flex-start; gap: 0.75rem; padding: 0.5rem 0;">
                @forelse($topTopsis as $idx => $item)
                    <div class="ranking-item" style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem 1rem; border-radius: 12px; background: var(--bg-main); border: 1px solid var(--border-color); transition: var(--transition-smooth);">
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <!-- Rank indicators -->
                            @if($idx === 0)
                                <div style="width: 28px; height: 28px; border-radius: 50%; background: linear-gradient(135deg, #fbbf24, #d97706); color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 800; box-shadow: 0 2px 6px rgba(217, 119, 6, 0.4);">1</div>
                            @elseif($idx === 1)
                                <div style="width: 28px; height: 28px; border-radius: 50%; background: linear-gradient(135deg, #cbd5e1, #94a3b8); color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 800; box-shadow: 0 2px 6px rgba(148, 163, 184, 0.4);">2</div>
                            @elseif($idx === 2)
                                <div style="width: 28px; height: 28px; border-radius: 50%; background: linear-gradient(135deg, #f59e0b, #b45309); color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 800; box-shadow: 0 2px 6px rgba(180, 83, 9, 0.4);">3</div>
                            @else
                                <div style="width: 28px; height: 28px; border-radius: 50%; background: #e2e8f0; color: var(--text-secondary); display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 800;">{{ $idx + 1 }}</div>
                            @endif
                            
                            <div>
                                <h5 style="margin: 0; font-size: 0.85rem; font-weight: 700; color: var(--text-primary);">{{ $item->warga->nama_lengkap }}</h5>
                                <span style="font-size: 0.7rem; color: var(--text-muted);">V-Score: <strong>{{ number_format($item->v, 4) }}</strong></span>
                            </div>
                        </div>
                        
                        <div>
                            @if($item->status === 'Layak')
                                <span class="badge-modern badge-emerald" style="font-size: 0.7rem; padding: 0.15rem 0.5rem; font-weight: 700;">{{ $item->status }}</span>
                            @else
                                <span class="badge-modern badge-red" style="font-size: 0.7rem; padding: 0.15rem 0.5rem; font-weight: 700;">{{ $item->status }}</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="empty-state-card" style="padding: 1.5rem 1rem; border-radius: 16px; margin: 0 auto; max-width: 100%;">
                        <div class="empty-state-icon-premium" style="width: 50px; height: 50px; font-size: 1.25rem; margin-bottom: 0.75rem;">
                            <i class="fa-solid fa-ranking-star"></i>
                        </div>
                        <h4 style="font-size: 0.85rem; font-weight: 700; margin-bottom: 0.25rem;">Belum Ada Peringkat</h4>
                        <p style="font-size: 0.75rem; color: var(--text-muted); margin-bottom: 1rem;">Lakukan perhitungan TOPSIS terlebih dahulu.</p>
                        <a href="{{ route('topsis.index') }}" class="btn-modern btn-primary-modern" style="padding: 0.4rem 0.8rem; font-size: 0.75rem; border-radius: 8px; text-decoration: none;">Pergi Ke TOPSIS</a>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <!-- Timeline Log Aktivitas Panel -->
    <div class="card-modern" style="margin-bottom: 2rem;">
        <div class="card-header-modern" style="border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; margin-bottom: 1.5rem;">
            <h3 class="card-title-modern">
                <i class="fa-solid fa-clock-rotate-left" style="color: var(--accent-emerald);"></i> Log Aktivitas Terbaru Sistem
            </h3>
            <span class="badge-modern badge-emerald-pulse" style="font-size: 0.7rem; font-weight: 700; background: var(--accent-emerald-light); color: var(--accent-emerald); display: inline-flex; align-items: center; gap: 0.35rem; border: none; padding: 0.25rem 0.6rem;">
                <span class="badge-dot" style="width: 5px; height: 5px; background-color: var(--accent-emerald); border-radius: 50%;"></span> Live Update
            </span>
        </div>

        <div class="activity-list" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.25rem;">
            @forelse($recentActivities as $log)
                <div class="activity-item activity-card" style="display: flex; gap: 1rem; background: var(--bg-main); padding: 1.25rem; border-radius: 16px; border: 1px solid var(--border-color); transition: var(--transition-smooth);">
                    <div class="activity-badge" style="
                        width: 42px;
                        height: 42px;
                        border-radius: 12px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 1.1rem;
                        flex-shrink: 0;
                        background-color: {{ $log->user->role === 'admin' ? 'var(--accent-emerald-light)' : ($log->user->role === 'petugas' ? 'var(--accent-blue-light)' : 'var(--accent-yellow-light)') }};
                        color: {{ $log->user->role === 'admin' ? 'var(--accent-emerald)' : ($log->user->role === 'petugas' ? 'var(--accent-blue)' : 'var(--accent-yellow)') }};
                    ">
                        @if($log->aktivitas === 'Login')
                            <i class="fa-solid fa-right-to-bracket"></i>
                        @elseif($log->aktivitas === 'Logout')
                            <i class="fa-solid fa-right-from-bracket"></i>
                        @elseif(str_contains($log->aktivitas, 'Tambah') || str_contains($log->aktivitas, 'Input'))
                            <i class="fa-solid fa-circle-plus"></i>
                        @elseif(str_contains($log->aktivitas, 'Ubah') || str_contains($log->aktivitas, 'Edit') || str_contains($log->aktivitas, 'Update'))
                            <i class="fa-solid fa-pen-to-square"></i>
                        @elseif(str_contains($log->aktivitas, 'Hapus'))
                            <i class="fa-solid fa-trash-can"></i>
                        @else
                            <i class="fa-solid fa-gears"></i>
                        @endif
                    </div>
                    <div class="activity-details" style="display: flex; flex-direction: column; justify-content: center;">
                        <div class="activity-title" style="font-size: 0.9rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.15rem;">{{ $log->aktivitas }}</div>
                        <div class="activity-desc" style="font-size: 0.8rem; color: var(--text-secondary); line-height: 1.4; margin-bottom: 0.4rem;">{{ $log->deskripsi }}</div>
                        <span class="activity-time" style="font-size: 0.7rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.35rem;">
                            <i class="fa-regular fa-user" style="font-size: 0.65rem;"></i> {{ $log->user->name }} • 
                            <i class="fa-regular fa-clock" style="font-size: 0.65rem;"></i> {{ $log->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="empty-state-card" style="grid-column: 1 / -1; margin: 1rem auto; padding: 2rem 1.5rem;">
                    <div class="empty-state-icon-premium">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </div>
                    <h4 style="font-family: var(--font-heading); font-size: 1rem; font-weight: 700; margin-bottom: 0.25rem;">Belum Ada Aktivitas Terdaftar</h4>
                    <p style="font-size: 0.8rem; color: var(--text-muted);">Seluruh log operasional sistem akan dicatat secara real-time di panel ini.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@section('scripts')
    <!-- CDN Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.9/dist/chart.umd.min.js" defer></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const chartPanel = document.querySelector('[data-chart-panel]');
            const chartData = {
                desaLabels: {!! json_encode($desaLabels) !!},
                desaTotals: {!! json_encode($desaTotals) !!},
                statusLabels: {!! json_encode($statusLabels) !!},
                statusTotals: {!! json_encode($statusTotals) !!}
            };

            const sumValues = (values) => values.reduce((total, value) => total + Number(value || 0), 0);
            const makeGradient = (ctx, start, end) => {
                const gradient = ctx.createLinearGradient(0, 0, 0, 220);
                gradient.addColorStop(0, start);
                gradient.addColorStop(1, end);
                return gradient;
            };

            const centerTextPlugin = {
                id: 'centerText',
                afterDraw(chart, args, options) {
                    if (!options.text) return;

                    const { ctx, chartArea } = chart;
                    if (!chartArea) return;

                    const centerX = (chartArea.left + chartArea.right) / 2;
                    const centerY = (chartArea.top + chartArea.bottom) / 2;

                    ctx.save();
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fillStyle = '#0f172a';
                    ctx.font = '800 1.35rem Outfit, Inter, sans-serif';
                    ctx.fillText(options.text, centerX, centerY - 5);
                    ctx.fillStyle = '#64748b';
                    ctx.font = '600 0.68rem Inter, sans-serif';
                    ctx.fillText(options.subtext || 'Total', centerX, centerY + 16);
                    ctx.restore();
                }
            };

            let chartsReady = false;
            const buildCharts = () => {
                if (chartsReady || typeof Chart === 'undefined') return;
                chartsReady = true;
                Chart.register(centerTextPlugin);

                const ctxDesa = document.getElementById('chartDesa').getContext('2d');
                const ctxBantuan = document.getElementById('chartBantuan').getContext('2d');
                const palette = [
                    ['#4f46e5', '#06b6d4'],
                    ['#059669', '#34d399'],
                    ['#d97706', '#fbbf24'],
                    ['#0891b2', '#22d3ee'],
                    ['#e11d48', '#fb7185']
                ];

                const options = (total, cutout) => ({
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout,
                    animation: {
                        duration: 650,
                        easing: 'easeOutQuart'
                    },
                    interaction: {
                        mode: 'nearest',
                        intersect: true
                    },
                    onHover: (event, active, chart) => {
                        chart.canvas.style.cursor = active.length ? 'pointer' : 'default';
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'circle',
                                boxWidth: 8,
                                padding: 10,
                                font: {
                                    family: 'Inter',
                                    size: 10,
                                    weight: '600'
                                },
                                color: '#475569'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.92)',
                            borderColor: 'rgba(255, 255, 255, 0.18)',
                            borderWidth: 1,
                            padding: 10,
                            displayColors: true,
                            callbacks: {
                                label(context) {
                                    const value = Number(context.parsed || 0);
                                    const datasetTotal = sumValues(context.dataset.data);
                                    const percent = datasetTotal ? ((value / datasetTotal) * 100).toFixed(1) : '0.0';
                                    return `${context.label}: ${value} data (${percent}%)`;
                                }
                            }
                        },
                        centerText: {
                            text: String(total),
                            subtext: 'Total data'
                        }
                    }
                });

                new Chart(ctxDesa, {
                    type: 'doughnut',
                    data: {
                        labels: chartData.desaLabels,
                        datasets: [{
                            data: chartData.desaTotals,
                            backgroundColor: palette.map(([start, end]) => makeGradient(ctxDesa, start, end)),
                            hoverOffset: 8,
                            borderWidth: 3,
                            borderColor: '#ffffff'
                        }]
                    },
                    options: options(sumValues(chartData.desaTotals), '58%')
                });

                new Chart(ctxBantuan, {
                    type: 'doughnut',
                    data: {
                        labels: chartData.statusLabels,
                        datasets: [{
                            data: chartData.statusTotals,
                            backgroundColor: palette.slice(0, 3).map(([start, end]) => makeGradient(ctxBantuan, start, end)),
                            hoverOffset: 8,
                            borderWidth: 3,
                            borderColor: '#ffffff'
                        }]
                    },
                    options: options(sumValues(chartData.statusTotals), '66%')
                });
            };

            if (!chartPanel) return;

            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    if (entries.some((entry) => entry.isIntersecting)) {
                        buildCharts();
                        observer.disconnect();
                    }
                }, { rootMargin: '160px 0px' });

                observer.observe(chartPanel);
            } else {
                buildCharts();
            }
        });
    </script>
@endsection
