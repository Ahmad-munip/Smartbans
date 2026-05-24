@extends('layouts.app')

@section('title', 'Perhitungan & Perangkingan TOPSIS')
@section('page_title', 'Perhitungan Prioritas Kelayakan (TOPSIS)')

@section('content')
    <!-- Explanatory Header Banner -->
    <div class="welcome-hero" style="padding: 2.25rem; margin-bottom: 2rem;">
        <h2 class="welcome-hero-title" style="font-size: 1.85rem; font-weight: 800; display: flex; align-items: center; gap: 0.75rem; font-family: var(--font-heading);">
            <i class="fa-solid fa-square-poll-vertical" style="opacity: 0.9;"></i> Analisis Kelayakan Alternatif (TOPSIS)
        </h2>
        <p class="welcome-hero-desc" style="font-size: 0.95rem; max-width: 900px; line-height: 1.6; margin-top: 0.5rem; color: rgba(255, 255, 255, 0.85);">
            Metode <strong>TOPSIS (Technique for Order Preference by Similarity to Ideal Solution)</strong> menentukan kelayakan penerima bantuan sosial berdasarkan kedekatan relatif terhadap solusi ideal positif ($A^+$) dan jarak terjauh dari solusi ideal negatif ($A^-$). Bobot kriteria terintegrasi secara otomatis dari hasil kalkulasi <strong>AHP</strong>.
        </p>
    </div>

    <!-- Interactive Stepper -->
    <div class="card-modern" style="padding: 1.5rem; margin-bottom: 2rem; background: var(--bg-card); border: 1px solid var(--border-color);">
        <h3 class="card-title-modern" style="font-size: 0.95rem; margin-bottom: 1.25rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.05em;">
            <i class="fa-solid fa-code-branch" style="color: var(--accent-blue);"></i> Alur Perhitungan Matematis TOPSIS
        </h3>
        
        <!-- Stepper Layout -->
        <div class="topsis-stepper-container" style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 1rem; position: relative;">
            
            <!-- Step 1 -->
            <div class="stepper-item active" style="text-align: center; position: relative;">
                <div class="stepper-circle" style="width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg, var(--primary-gradient-start), var(--primary-gradient-end)); color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.05rem; margin: 0 auto 0.5rem auto; box-shadow: var(--glow-indigo); border: 2px solid #ffffff; transition: var(--transition-smooth);">1</div>
                <h4 style="font-size: 0.82rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.15rem;">Matriks X</h4>
                <p style="font-size: 0.7rem; color: var(--text-secondary); margin: 0; line-height: 1.2;">Skor kuantitatif awal alternatif</p>
            </div>

            <!-- Step 2 -->
            <div class="stepper-item" style="text-align: center; position: relative;">
                <div class="stepper-circle" style="width: 42px; height: 42px; border-radius: 50%; background: #ffffff; color: var(--text-secondary); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.05rem; margin: 0 auto 0.5rem auto; border: 2px solid var(--border-color); transition: var(--transition-smooth);">2</div>
                <h4 style="font-size: 0.82rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.15rem;">Normalisasi R</h4>
                <p style="font-size: 0.7rem; color: var(--text-secondary); margin: 0; line-height: 1.2;">Skalar pembagi panjang vektor</p>
            </div>

            <!-- Step 3 -->
            <div class="stepper-item" style="text-align: center; position: relative;">
                <div class="stepper-circle" style="width: 42px; height: 42px; border-radius: 50%; background: #ffffff; color: var(--text-secondary); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.05rem; margin: 0 auto 0.5rem auto; border: 2px solid var(--border-color); transition: var(--transition-smooth);">3</div>
                <h4 style="font-size: 0.82rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.15rem;">Terbobot Y</h4>
                <p style="font-size: 0.7rem; color: var(--text-secondary); margin: 0; line-height: 1.2;">Integrasi bobot kriteria AHP</p>
            </div>

            <!-- Step 4 -->
            <div class="stepper-item" style="text-align: center; position: relative;">
                <div class="stepper-circle" style="width: 42px; height: 42px; border-radius: 50%; background: #ffffff; color: var(--text-secondary); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.05rem; margin: 0 auto 0.5rem auto; border: 2px solid var(--border-color); transition: var(--transition-smooth);">4</div>
                <h4 style="font-size: 0.82rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.15rem;">Solusi Ideal D</h4>
                <p style="font-size: 0.7rem; color: var(--text-secondary); margin: 0; line-height: 1.2;">Jarak ideal positif & negatif</p>
            </div>

            <!-- Step 5 -->
            <div class="stepper-item" style="text-align: center; position: relative;">
                <div class="stepper-circle" style="width: 42px; height: 42px; border-radius: 50%; background: #ffffff; color: var(--text-secondary); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.05rem; margin: 0 auto 0.5rem auto; border: 2px solid var(--border-color); transition: var(--transition-smooth);">5</div>
                <h4 style="font-size: 0.82rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.15rem;">Peringkat V</h4>
                <p style="font-size: 0.7rem; color: var(--text-secondary); margin: 0; line-height: 1.2;">Indeks kedekatan & kelayakan</p>
            </div>

        </div>
    </div>

    <!-- Control Center Card -->
    <div class="card-modern" style="padding: 1.5rem; margin-bottom: 1.5rem; background: var(--bg-card); border: 1px solid var(--border-color);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
            <div>
                <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.25rem; font-family: var(--font-heading);">
                    <i class="fa-solid fa-sliders" style="color: var(--accent-blue);"></i> Panel Konfigurasi Seleksi
                </h3>
                <p style="font-size: 0.82rem; color: var(--text-secondary); margin: 0;">
                    Atur kuota kelayakan untuk membagi penerima bantuan sosial berdasarkan batas kapasitas rekomendasi.
                </p>
            </div>
            
            <form action="{{ route('topsis.calculate') }}" method="POST" style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                @csrf
                <div style="display: flex; align-items: center; gap: 0.5rem; background-color: var(--bg-main); padding: 0.45rem 1rem; border-radius: 12px; border: 1px solid var(--border-color);">
                    <label for="quota" style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); white-space: nowrap;">Kuota Penerima (Layak):</label>
                    <input type="number" name="quota" id="quota" min="1" max="{{ $wargas->count() ?: 100 }}" value="{{ $quota }}" class="form-control-modern" style="width: 75px; padding: 0.25rem; font-weight: 800; font-family: monospace; text-align: center; border-radius: 8px; border: 1px solid var(--border-color); background: #ffffff;">
                </div>

                @if(in_array(Auth::user()->role, ['admin', 'petugas']))
                    <button type="submit" class="btn-modern btn-primary-modern" style="padding: 0.65rem 1.25rem; font-size: 0.88rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fa-solid fa-arrows-rotate animate-spin-hover"></i> Hitung & Simpan Hasil Seleksi
                    </button>
                @else
                    <div style="font-size: 0.8rem; color: var(--text-muted); background: var(--bg-main); padding: 0.6rem 1.25rem; border-radius: var(--radius-xl); border: 1px dashed var(--border-color); display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fa-solid fa-lock" style="color: var(--accent-red);"></i> Otorisasi Terbatas (Hanya Admin / Petugas)
                    </div>
                @endif
            </form>
        </div>
    </div>

    <!-- Summary Metrics Row -->
    <div class="metrics-grid" style="margin-bottom: 2rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 1.25rem;">
        <div class="card-stat" style="background: var(--bg-card); border: 1px solid var(--border-color);">
            <div class="stat-info">
                <span class="stat-label">Total Alternatif</span>
                <span class="stat-value" style="font-size: 1.65rem;">{{ $wargas->count() }} Warga</span>
            </div>
            <div class="stat-icon-wrapper icon-blue">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>

        <div class="card-stat" style="background: var(--bg-card); border: 1px solid var(--border-color);">
            <div class="stat-info">
                <span class="stat-label">Rekomendasi Layak</span>
                <span class="stat-value" style="font-size: 1.65rem; color: var(--accent-emerald);">
                    {{ $storedResults->where('status', 'layak')->count() }} Jiwa
                </span>
            </div>
            <div class="stat-icon-wrapper icon-emerald" style="box-shadow: var(--glow-emerald);">
                <i class="fa-solid fa-user-check"></i>
            </div>
        </div>

        <div class="card-stat" style="background: var(--bg-card); border: 1px solid var(--border-color);">
            <div class="stat-info">
                <span class="stat-label">Batas Kuota Seleksi</span>
                <span class="stat-value" style="font-size: 1.65rem; color: var(--accent-yellow);">
                    {{ $quota }} Penerima
                </span>
            </div>
            <div class="stat-icon-wrapper icon-yellow">
                <i class="fa-solid fa-ticket"></i>
            </div>
        </div>

        @php
            $topResult = $storedResults->first();
        @endphp
        <div class="card-stat" style="background: linear-gradient(135deg, rgba(234, 179, 8, 0.06) 0%, rgba(255, 255, 255, 0.95) 100%); border-color: rgba(234, 179, 8, 0.25);">
            <div class="stat-info" style="overflow: hidden;">
                <span class="stat-label" style="color: #ca8a04; font-weight: 700;">Skor V Tertinggi (Top 1)</span>
                <span class="stat-value" style="font-size: 1.05rem; font-weight: 800; text-overflow: ellipsis; overflow: hidden; white-space: nowrap; max-width: 140px;" title="{{ $topResult ? $topResult->warga->nama_lengkap : '-' }}">
                    {{ $topResult ? $topResult->warga->nama_lengkap : 'Belum Ada' }}
                </span>
                @if($topResult)
                    <span style="font-size: 0.75rem; font-weight: 700; color: var(--accent-blue); font-family: monospace;">V = {{ number_format($topResult->nilai_preferensi, 5) }}</span>
                @endif
            </div>
            <div class="stat-icon-wrapper" style="background-color: #fef08a; color: #ca8a04; box-shadow: 0 4px 12px rgba(234, 179, 8, 0.25);">
                <i class="fa-solid fa-award fa-bounce"></i>
            </div>
        </div>
    </div>

    <!-- Charts & Distributions Panel -->
    @if($storedResults->count() > 0)
        <div class="card-modern topsis-chart-card" style="padding: 1.5rem; margin-bottom: 2rem; background: var(--bg-card); border: 1px solid var(--border-color);">
            <h3 class="card-title-modern" style="font-size: 1.05rem; margin-bottom: 1.25rem; font-family: var(--font-heading);">
                <i class="fa-solid fa-chart-bar" style="color: var(--accent-emerald);"></i> Distribusi Nilai Kedekatan Alternatif Terhadap Solusi Ideal ($V$)
            </h3>
            <div class="topsis-chart-scroll">
                <div class="topsis-chart-frame" style="height: {{ max(360, min(680, $storedResults->count() * 34 + 84)) }}px;">
                    <canvas id="topsisChart"></canvas>
                </div>
            </div>
        </div>
    @endif

    <!-- Academic Step-by-Step Presentation Tabs Container -->
    <div class="card-modern" style="padding: 0; overflow: hidden; margin-bottom: 2rem; background: var(--bg-card); border: 1px solid var(--border-color);">
        <!-- Tab Navigation Bar -->
        <div style="background-color: var(--bg-main); border-bottom: 1px solid var(--border-color); display: flex; overflow-x: auto; gap: 0.25rem; padding: 0.75rem 1rem 0 1rem;">
            <button class="tab-btn active" onclick="switchTab(event, 'tab-rank')" style="padding: 0.75rem 1.5rem; font-size: 0.85rem; font-weight: 700; border-radius: var(--radius-xl) var(--radius-xl) 0 0; border: 1px solid transparent; border-bottom: none; background: transparent; cursor: pointer; color: var(--text-secondary); display: flex; align-items: center; gap: 0.45rem; transition: var(--transition-smooth);">
                <i class="fa-solid fa-crown"></i> Peringkat Akhir (V)
            </button>
            <button class="tab-btn" onclick="switchTab(event, 'tab-matrix-x')" style="padding: 0.75rem 1.5rem; font-size: 0.85rem; font-weight: 700; border-radius: var(--radius-xl) var(--radius-xl) 0 0; border: 1px solid transparent; border-bottom: none; background: transparent; cursor: pointer; color: var(--text-secondary); display: flex; align-items: center; gap: 0.45rem; transition: var(--transition-smooth);">
                <i class="fa-solid fa-table"></i> Matriks Keputusan (X & R)
            </button>
            <button class="tab-btn" onclick="switchTab(event, 'tab-matrix-y')" style="padding: 0.75rem 1.5rem; font-size: 0.85rem; font-weight: 700; border-radius: var(--radius-xl) var(--radius-xl) 0 0; border: 1px solid transparent; border-bottom: none; background: transparent; cursor: pointer; color: var(--text-secondary); display: flex; align-items: center; gap: 0.45rem; transition: var(--transition-smooth);">
                <i class="fa-solid fa-chart-gantt"></i> Matriks Terbobot (Y)
            </button>
            <button class="tab-btn" onclick="switchTab(event, 'tab-ideal')" style="padding: 0.75rem 1.5rem; font-size: 0.85rem; font-weight: 700; border-radius: var(--radius-xl) var(--radius-xl) 0 0; border: 1px solid transparent; border-bottom: none; background: transparent; cursor: pointer; color: var(--text-secondary); display: flex; align-items: center; gap: 0.45rem; transition: var(--transition-smooth);">
                <i class="fa-solid fa-calculator"></i> Jarak Ideal (D+ / D-)
            </button>
        </div>

        <!-- Tab Contents -->
        <div style="padding: 1.75rem;">
            <!-- Tab 1: Final Rankings -->
            <div id="tab-rank" class="tab-content active">
                
                <!-- Podium Top 3 Alternatif -->
                @if($storedResults->count() > 0)
                    @php
                        $top1 = $storedResults->firstWhere('ranking', 1);
                        $top2 = $storedResults->firstWhere('ranking', 2);
                        $top3 = $storedResults->firstWhere('ranking', 3);
                    @endphp
                    <div class="topsis-podium-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                        
                        <!-- 2nd Place -->
                        @if($top2)
                            <div class="card-modern topsis-podium-card" style="padding: 1.25rem; border: 1px solid rgba(148, 163, 184, 0.25); background: linear-gradient(135deg, rgba(248, 250, 252, 0.95), rgba(241, 245, 249, 0.95)); position: relative; border-radius: 20px;">
                                <div style="position: absolute; top: 1rem; right: 1rem; background: #e2e8f0; color: #475569; width: 34px; height: 34px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.1rem; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">2</div>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div class="user-avatar" style="background: linear-gradient(135deg, #94a3b8, #cbd5e1); width: 44px; height: 44px; font-weight: 800; font-family: var(--font-heading);">
                                        🥈
                                    </div>
                                    <div class="topsis-podium-info" style="overflow: hidden; width: calc(100% - 60px);">
                                        <h4 style="font-size: 0.92rem; font-weight: 800; color: var(--text-primary); margin: 0; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">{{ $top2->warga->nama_lengkap }}</h4>
                                        <span style="font-size: 0.72rem; color: var(--text-muted); display: block;">NIK: {{ $top2->warga->nik }}</span>
                                    </div>
                                </div>
                                <div style="margin-top: 1rem; display: flex; justify-content: space-between; align-items: center; border-top: 1px dashed var(--border-color); padding-top: 0.75rem;">
                                    <span style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 600;">Skor Preferensi (V)</span>
                                    <strong style="font-family: monospace; font-size: 0.95rem; color: var(--accent-blue);">{{ number_format($top2->nilai_preferensi, 5) }}</strong>
                                </div>
                            </div>
                        @endif

                        <!-- 1st Place (Gold Highlighted) -->
                        @if($top1)
                            <div class="card-modern topsis-podium-card topsis-podium-card-main" style="padding: 1.5rem; border: 2px solid #fef08a; background: linear-gradient(135deg, rgba(254, 240, 138, 0.15), rgba(255, 255, 255, 0.95)); position: relative; border-radius: 24px; box-shadow: 0 8px 24px -6px rgba(202, 138, 4, 0.15);">
                                <div style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: #ca8a04; color: #ffffff; padding: 0.2rem 0.75rem; border-radius: 999px; font-size: 0.65rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; display: flex; align-items: center; gap: 0.25rem; box-shadow: 0 4px 10px rgba(202, 138, 4, 0.3);">
                                    <i class="fa-solid fa-crown animate-pulse"></i> Prioritas Utama
                                </div>
                                <div style="position: absolute; top: 1rem; right: 1rem; background: #ca8a04; color: #ffffff; width: 38px; height: 38px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.25rem; box-shadow: 0 4px 10px rgba(202, 138, 4, 0.25);">1</div>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div class="user-avatar" style="background: linear-gradient(135deg, #eab308, #ca8a04); width: 48px; height: 48px; font-weight: 800; font-family: var(--font-heading); box-shadow: 0 4px 12px rgba(202,138,4,0.3);">
                                        🏆
                                    </div>
                                    <div class="topsis-podium-info" style="overflow: hidden; width: calc(100% - 65px);">
                                        <h4 style="font-size: 0.98rem; font-weight: 800; color: var(--text-primary); margin: 0; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">{{ $top1->warga->nama_lengkap }}</h4>
                                        <span style="font-size: 0.72rem; color: #ca8a04; font-weight: 700; display: block;">NIK: {{ $top1->warga->nik }}</span>
                                    </div>
                                </div>
                                <div style="margin-top: 1rem; display: flex; justify-content: space-between; align-items: center; border-top: 1px dashed rgba(202, 138, 4, 0.2); padding-top: 0.75rem;">
                                    <span style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 700;">Skor Preferensi (V)</span>
                                    <strong style="font-family: monospace; font-size: 1.05rem; color: #ca8a04; font-weight: 800;">{{ number_format($top1->nilai_preferensi, 5) }}</strong>
                                </div>
                            </div>
                        @endif

                        <!-- 3rd Place -->
                        @if($top3)
                            <div class="card-modern topsis-podium-card" style="padding: 1.25rem; border: 1px solid rgba(251, 146, 60, 0.25); background: linear-gradient(135deg, rgba(255, 247, 237, 0.95), rgba(254, 242, 238, 0.95)); position: relative; border-radius: 20px;">
                                <div style="position: absolute; top: 1rem; right: 1rem; background: #ffedd5; color: #ea580c; width: 34px; height: 34px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.1rem; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">3</div>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div class="user-avatar" style="background: linear-gradient(135deg, #ea580c, #f97316); width: 44px; height: 44px; font-weight: 800; font-family: var(--font-heading);">
                                        🥉
                                    </div>
                                    <div class="topsis-podium-info" style="overflow: hidden; width: calc(100% - 60px);">
                                        <h4 style="font-size: 0.92rem; font-weight: 800; color: var(--text-primary); margin: 0; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">{{ $top3->warga->nama_lengkap }}</h4>
                                        <span style="font-size: 0.72rem; color: var(--text-muted); display: block;">NIK: {{ $top3->warga->nik }}</span>
                                    </div>
                                </div>
                                <div style="margin-top: 1rem; display: flex; justify-content: space-between; align-items: center; border-top: 1px dashed var(--border-color); padding-top: 0.75rem;">
                                    <span style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 600;">Skor Preferensi (V)</span>
                                    <strong style="font-family: monospace; font-size: 0.95rem; color: var(--accent-blue);">{{ number_format($top3->nilai_preferensi, 5) }}</strong>
                                </div>
                            </div>
                        @endif

                    </div>
                @endif

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 1rem;">
                    <h4 style="font-size: 1rem; font-weight: 700; color: var(--text-primary); margin: 0; font-family: var(--font-heading);">
                        Hasil Akhir Perangkingan Alternatif
                    </h4>
                    <span style="font-size: 0.75rem; color: var(--text-muted); font-weight: 600;">Mengurutkan nilai preferensi tertinggi ke terendah secara matematis</span>
                </div>

                <div class="table-responsive">
                    <table class="table-modern" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 90px; text-align: center;">Peringkat</th>
                                <th>Nama Lengkap</th>
                                <th>NIK</th>
                                <th>Desa</th>
                                <th style="text-align: center;">Jarak D+</th>
                                <th style="text-align: center;">Jarak D-</th>
                                <th style="text-align: center;">Nilai Preferensi (V)</th>
                                <th style="text-align: center; width: 130px;">Kelayakan</th>
                                <th style="width: 110px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($storedResults as $res)
                                @php
                                    $rowStyle = '';
                                    if ($res->ranking == 1) {
                                        $rowStyle = 'background: linear-gradient(90deg, rgba(234, 179, 8, 0.05), transparent);';
                                    } elseif ($res->ranking == 2) {
                                        $rowStyle = 'background: linear-gradient(90deg, rgba(148, 163, 184, 0.04), transparent);';
                                    } elseif ($res->ranking == 3) {
                                        $rowStyle = 'background: linear-gradient(90deg, rgba(251, 146, 60, 0.04), transparent);';
                                    }
                                @endphp
                                <tr style="{{ $rowStyle }}">
                                    <td style="text-align: center; font-weight: 700; vertical-align: middle;">
                                        @if($res->ranking == 1)
                                            <span style="display: inline-flex; align-items: center; justify-content: center; background-color: #fef08a; color: #ca8a04; width: 30px; height: 30px; border-radius: 50%; box-shadow: 0 2px 8px rgba(202, 138, 4, 0.25); font-weight: 800; font-family: var(--font-heading);" title="Peringkat 1">
                                                1
                                            </span>
                                        @elseif($res->ranking == 2)
                                            <span style="display: inline-flex; align-items: center; justify-content: center; background-color: #e2e8f0; color: #475569; width: 28px; height: 28px; border-radius: 50%; box-shadow: 0 2px 6px rgba(0,0,0,0.05); font-weight: 800;" title="Peringkat 2">
                                                2
                                            </span>
                                        @elseif($res->ranking == 3)
                                            <span style="display: inline-flex; align-items: center; justify-content: center; background-color: #ffedd5; color: #ea580c; width: 26px; height: 26px; border-radius: 50%; box-shadow: 0 2px 6px rgba(234, 88, 12, 0.15); font-weight: 800;" title="Peringkat 3">
                                                3
                                            </span>
                                        @else
                                            <span style="color: var(--text-secondary); font-weight: 600;">{{ $res->ranking }}</span>
                                        @endif
                                    </td>
                                    <td style="font-weight: 700; color: var(--text-primary); vertical-align: middle;">
                                        {{ $res->warga->nama_lengkap }}
                                    </td>
                                    <td style="font-size: 0.82rem; font-family: monospace; vertical-align: middle; color: var(--text-secondary);">
                                        {{ $res->warga->nik }}
                                    </td>
                                    <td style="vertical-align: middle;">{{ $res->warga->desa }}</td>
                                    <td style="text-align: center; font-family: monospace; font-size: 0.85rem; font-weight: 600; color: var(--accent-red); vertical-align: middle;">
                                        {{ number_format($res->nilai_d_plus, 5) }}
                                    </td>
                                    <td style="text-align: center; font-family: monospace; font-size: 0.85rem; font-weight: 600; color: var(--accent-emerald); vertical-align: middle;">
                                        {{ number_format($res->nilai_d_minus, 5) }}
                                    </td>
                                    <td style="text-align: center; font-weight: 800; font-family: monospace; color: var(--accent-blue); font-size: 0.95rem; vertical-align: middle;">
                                        {{ number_format($res->nilai_preferensi, 5) }}
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        @if($res->status === 'layak')
                                            <span class="badge-emerald-pulse" style="padding: 0.35rem 0.75rem; font-size: 0.75rem; font-weight: 700;">
                                                <i class="fa-solid fa-circle-check"></i> Layak
                                            </span>
                                        @else
                                            <span class="badge-modern badge-yellow" style="padding: 0.35rem 0.75rem; font-size: 0.75rem; font-weight: 600; border: 1px solid rgba(217, 119, 6, 0.2);">
                                                <i class="fa-solid fa-hourglass-half"></i> Cadangan
                                            </span>
                                        @endif
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        <button type="button" class="btn-modern btn-secondary-modern btn-sm-modern open-math-modal" data-id="{{ $res->warga_id }}" style="padding: 0.35rem 0.65rem; font-size: 0.78rem; border-radius: 8px; font-weight: 600; display: inline-flex; align-items: center; gap: 0.25rem;">
                                            <i class="fa-solid fa-calculator" style="color: var(--accent-blue);"></i> Rumus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" style="text-align: center; padding: 4rem; color: var(--text-muted);">
                                        <div style="font-size: 2.5rem; margin-bottom: 0.75rem; color: var(--text-muted);"><i class="fa-solid fa-magnifying-glass-chart"></i></div>
                                        <p style="font-weight: 600; font-size: 0.95rem; margin-bottom: 0.5rem;">Belum ada hasil perangkingan TOPSIS</p>
                                        <span style="font-size: 0.8rem;">Klik tombol <strong>"Hitung & Simpan Hasil Seleksi"</strong> untuk memulai komputasi matriks keputusan.</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tab 2: Decision Matrix (X & R) -->
            <div id="tab-matrix-x" class="tab-content" style="display: none;">
                <div style="margin-bottom: 1.25rem; border-bottom: 1px dashed var(--border-color); padding-bottom: 1rem;">
                    <h4 style="font-size: 1rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.35rem; font-family: var(--font-heading);">
                        Matriks Keputusan ($X$) & Matriks Normalisasi ($R$)
                    </h4>
                    <p style="font-size: 0.82rem; color: var(--text-secondary); margin: 0; line-height: 1.5;">
                        Matriks <strong>$X$</strong> menunjukkan skor kualitatif warga yang dikonversi menjadi skor numerik (1-5). Matriks <strong>$R$</strong> menormalkan nilai $X$ menggunakan kalkulasi Euclidean Vektor agar data berada di rentang yang seragam.
                    </p>
                </div>

                <div class="table-responsive">
                    <table class="table-modern" style="width: 100%; border: 1px solid var(--border-color);">
                        <thead>
                            <tr style="text-align: center;">
                                <th rowspan="2" style="vertical-align: middle; background-color: var(--bg-main); text-align: left; border-right: 1px solid var(--border-color); font-weight: 700; width: 220px;">Nama Alternatif</th>
                                @foreach($kriterias as $k)
                                    <th colspan="2" style="text-align: center; font-size: 0.75rem; font-weight: 700; border-right: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color);">{{ $k->kode }} - {{ $k->nama_kriteria }}</th>
                                @endforeach
                            </tr>
                            <tr style="text-align: center; font-size: 0.72rem; background-color: var(--bg-main);">
                                @foreach($kriterias as $k)
                                    <th style="text-align: center; font-weight: 600; border-right: 1px solid rgba(226, 232, 240, 0.4);">Skor ($X$)</th>
                                    <th style="text-align: center; font-weight: 600; border-right: 1px solid var(--border-color); color: var(--accent-blue);">Normal ($R$)</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($wargas as $w)
                                <tr>
                                    <td style="font-weight: 700; color: var(--text-primary); border-right: 1px solid var(--border-color);">{{ $w->nama_lengkap }}</td>
                                    @foreach($kriterias as $k)
                                        @php
                                            $xVal = $calcData['decision_matrix'][$w->id][$k->id] ?? 3;
                                            $rVal = $calcData['normalized_matrix'][$w->id][$k->id] ?? 0;
                                        @endphp
                                        <td style="text-align: center; font-weight: 700; color: var(--text-secondary); border-right: 1px solid rgba(226, 232, 240, 0.4); font-family: monospace;">{{ $xVal }}</td>
                                        <td style="text-align: center; font-family: monospace; font-size: 0.85rem; font-weight: 600; color: var(--accent-blue); border-right: 1px solid var(--border-color);">{{ number_format($rVal, 4) }}</td>
                                    @endforeach
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ 1 + ($kriterias->count() * 2) }}" style="text-align: center; color: var(--text-muted); padding: 2rem;">Belum ada data alternatif atau kriteria.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tab 3: Weighted Normalized Matrix (Y) & A+/A- -->
            <div id="tab-matrix-y" class="tab-content" style="display: none;">
                <div style="margin-bottom: 1.25rem; border-bottom: 1px dashed var(--border-color); padding-bottom: 1rem;">
                    <h4 style="font-size: 1rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.35rem; font-family: var(--font-heading);">
                        Matriks Terbobot Ternormalisasi ($Y$) & Batas Solusi Ideal
                    </h4>
                    <p style="font-size: 0.82rem; color: var(--text-secondary); margin: 0; line-height: 1.5;">
                        Matriks <strong>$Y$</strong> diperoleh dengan mengalikan kolom Matriks Normalisasi $R$ dengan bobot prioritas hasil perhitungan <strong>AHP</strong>. Baris terbawah memperlihatkan <strong>Solusi Ideal Positif ($A^+$)</strong> dan <strong>Solusi Ideal Negatif ($A^-$)</strong> untuk masing-masing kriteria.
                    </p>
                </div>

                <div class="table-responsive">
                    <table class="table-modern" style="width: 100%; border: 1px solid var(--border-color);">
                        <thead>
                            <tr style="text-align: center;">
                                <th style="background-color: var(--bg-main); text-align: left; border-right: 1px solid var(--border-color); font-weight: 700; width: 220px;">Nama Alternatif</th>
                                @foreach($kriterias as $k)
                                    <th style="text-align: center; font-size: 0.78rem; font-weight: 700; border-right: 1px solid var(--border-color);">
                                        {{ $k->kode }}<br>
                                        <span style="font-size: 0.7rem; color: var(--text-secondary); font-weight: 700; display: inline-block; margin-top: 0.2rem; background: rgba(79, 70, 229, 0.08); padding: 0.1rem 0.4rem; border-radius: 4px;">W: {{ number_format($k->bobot, 4) }}</span>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wargas as $w)
                                <tr>
                                    <td style="font-weight: 700; color: var(--text-primary); border-right: 1px solid var(--border-color);">{{ $w->nama_lengkap }}</td>
                                    @foreach($kriterias as $k)
                                        @php
                                            $yVal = $calcData['weighted_normalized_matrix'][$w->id][$k->id] ?? 0;
                                        @endphp
                                        <td style="text-align: center; font-family: monospace; font-size: 0.85rem; font-weight: 600; color: var(--text-primary); border-right: 1px solid var(--border-color);">
                                            {{ number_format($yVal, 4) }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                            
                            <!-- A+ Ideal Positive Row -->
                            @if(count($calcData['ideal_positive']) > 0)
                                <tr style="background-color: var(--accent-emerald-light); font-weight: 800; border-top: 2px solid var(--accent-emerald);">
                                    <td style="color: var(--accent-emerald); font-weight: 800; border-right: 1px solid var(--border-color);"><i class="fa-solid fa-circle-chevron-up"></i> Solusi Ideal Positif ($A^+$)</td>
                                    @foreach($kriterias as $k)
                                        <td style="text-align: center; font-family: monospace; font-size: 0.88rem; color: var(--accent-emerald); border-right: 1px solid var(--border-color); font-weight: 800;">
                                            {{ number_format($calcData['ideal_positive'][$k->id], 4) }}
                                        </td>
                                    @endforeach
                                </tr>
                                
                                <!-- A- Ideal Negative Row -->
                                <tr style="background-color: var(--accent-yellow-light); font-weight: 800; border-top: 1px solid rgba(245, 158, 11, 0.25);">
                                    <td style="color: var(--accent-yellow); font-weight: 800; border-right: 1px solid var(--border-color);"><i class="fa-solid fa-circle-chevron-down"></i> Solusi Ideal Negatif ($A^-$)</td>
                                    @foreach($kriterias as $k)
                                        <td style="text-align: center; font-family: monospace; font-size: 0.88rem; color: var(--accent-yellow); border-right: 1px solid var(--border-color); font-weight: 800;">
                                            {{ number_format($calcData['ideal_negative'][$k->id], 4) }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tab 4: Ideal Distances & Preferences -->
            <div id="tab-ideal" class="tab-content" style="display: none;">
                <div style="margin-bottom: 1.25rem; border-bottom: 1px dashed var(--border-color); padding-bottom: 1rem;">
                    <h4 style="font-size: 1rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.35rem; font-family: var(--font-heading);">
                        Perhitungan Jarak Solusi Ideal ($D^+ / D^-$) & Nilai Preferensi ($V$)
                    </h4>
                    <p style="font-size: 0.82rem; color: var(--text-secondary); margin: 0; line-height: 1.5;">
                        Jarak <strong>$D^+$</strong> mengukur simpangan alternatif ke Solusi Ideal Positif (makin kecil makin baik). Jarak <strong>$D^-$</strong> mengukur simpangan alternatif ke Solusi Ideal Negatif (makin besar makin baik). Nilai Preferensi <strong>$V$</strong> dirumuskan sebagai rasio kedekatan relatif yang menjadi basis kelayakan.
                    </p>
                </div>

                <div class="table-responsive">
                    <table class="table-modern" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Nama Alternatif</th>
                                <th style="text-align: center; width: 140px;">Persamaan Jarak $D^+$</th>
                                <th style="text-align: center; width: 110px;">Nilai $D^+$</th>
                                <th style="text-align: center; width: 140px;">Persamaan Jarak $D^-$</th>
                                <th style="text-align: center; width: 110px;">Nilai $D^-$</th>
                                <th style="text-align: center; width: 160px;">Persamaan Preferensi $V$</th>
                                <th style="text-align: center; width: 140px;">Indeks Preferensi ($V$)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wargas as $w)
                                @php
                                    $dPlus = $calcData['distances'][$w->id]['d_plus'] ?? 0;
                                    $dMinus = $calcData['distances'][$w->id]['d_minus'] ?? 0;
                                    $vVal = $calcData['preferences'][$w->id] ?? 0;
                                  
                                    // Highlight top ones
                                    $vResult = $storedResults->firstWhere('warga_id', $w->id);
                                    $isTop = $vResult && $vResult->ranking <= 3;
                                @endphp
                                <tr style="{{ $isTop ? 'font-weight: 600;' : '' }}">
                                    <td style="font-weight: 700; color: var(--text-primary);">{{ $w->nama_lengkap }}</td>
                                    <td style="text-align: center; font-size: 0.72rem; color: var(--text-muted); font-family: monospace;">$\sqrt{\sum(y_{ij} - A_j^+)^2}$</td>
                                    <td style="text-align: center; font-family: monospace; font-size: 0.85rem; font-weight: 700; color: var(--accent-red);">{{ number_format($dPlus, 5) }}</td>
                                    <td style="text-align: center; font-size: 0.72rem; color: var(--text-muted); font-family: monospace;">$\sqrt{\sum(y_{ij} - A_j^-)^2}$</td>
                                    <td style="text-align: center; font-family: monospace; font-size: 0.85rem; font-weight: 700; color: var(--accent-emerald);">{{ number_format($dMinus, 5) }}</td>
                                    <td style="text-align: center; font-size: 0.72rem; color: var(--text-muted); font-family: monospace;">$\frac{D^-}{D^+ + D^-}$</td>
                                    <td style="text-align: center; font-weight: 800; font-family: monospace; color: var(--accent-blue); font-size: 0.95rem;">
                                        {{ number_format($vVal, 5) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Math Explanation Slideout / Modal Container -->
    <div id="mathModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(15, 23, 42, 0.4); backdrop-filter: blur(12px); z-index: 9999; justify-content: center; align-items: center; padding: 1.5rem; transition: var(--transition-smooth);">
        <div class="card-modern" style="width: 100%; max-width: 650px; padding: 2rem; background: rgba(255, 255, 255, 0.98); border-radius: var(--radius-2xl); box-shadow: var(--shadow-lg); border: 1px solid rgba(226, 232, 240, 0.8); position: relative; animation: slideIn 0.3s cubic-bezier(0.16, 1, 0.3, 1);">
            <button type="button" class="close-modal-btn" style="position: absolute; top: 1.25rem; right: 1.25rem; border: none; background: transparent; font-size: 1.5rem; color: var(--text-muted); cursor: pointer; transition: var(--transition-smooth);" onclick="closeModal()">
                <i class="fa-solid fa-circle-xmark" style="opacity: 0.7;"></i>
            </button>
            
            <div style="border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--text-primary); margin: 0; display: flex; align-items: center; gap: 0.5rem; font-family: var(--font-heading);">
                    <i class="fa-solid fa-calculator" style="color: var(--accent-blue);"></i> Detail Komputasi Matematis
                </h3>
                <span id="modalWargaName" style="font-size: 0.85rem; color: var(--text-secondary); font-weight: 700; display: block; margin-top: 0.25rem; background: var(--bg-main); padding: 0.25rem 0.75rem; border-radius: 6px; width: fit-content;"></span>
            </div>

            <!-- Modal Content Grid -->
            <div style="max-height: 400px; overflow-y: auto; padding-right: 0.5rem;">
                
                <!-- Section 1: Raw Scores -->
                <div style="margin-bottom: 1.5rem;">
                    <h4 style="font-size: 0.85rem; font-weight: 800; color: var(--text-primary); margin-bottom: 0.75rem; border-left: 4px solid var(--accent-blue); padding-left: 0.5rem; text-transform: uppercase; letter-spacing: 0.05em;">
                        1. Skor Matriks Keputusan ($X_i$)
                    </h4>
                    <table style="width: 100%; font-size: 0.82rem; border-collapse: collapse; border-radius: 8px; overflow: hidden; border: 1px solid var(--border-color);">
                        <thead>
                            <tr style="background: var(--bg-main); text-align: center; border-bottom: 1px solid var(--border-color);">
                                <th style="padding: 0.6rem; text-align: left; font-weight: 700;">Variabel</th>
                                <th style="padding: 0.6rem; text-align: center; font-weight: 700;">C1</th>
                                <th style="padding: 0.6rem; text-align: center; font-weight: 700;">C2</th>
                                <th style="padding: 0.6rem; text-align: center; font-weight: 700;">C3</th>
                                <th style="padding: 0.6rem; text-align: center; font-weight: 700;">C4</th>
                                <th style="padding: 0.6rem; text-align: center; font-weight: 700;">C5</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="modalRawRow" style="text-align: center; border-bottom: 1px solid var(--border-color); background: #ffffff;">
                                <td style="padding: 0.6rem; text-align: left; font-weight: 700; color: var(--text-secondary);">Skor Awal ($X$)</td>
                                <!-- JavaScript will inject here -->
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Section 2: Normalized Decisions -->
                <div style="margin-bottom: 1.5rem;">
                    <h4 style="font-size: 0.85rem; font-weight: 800; color: var(--text-primary); margin-bottom: 0.75rem; border-left: 4px solid var(--accent-emerald); padding-left: 0.5rem; text-transform: uppercase; letter-spacing: 0.05em;">
                        2. Normalisasi & Terbobot ($R \rightarrow Y$)
                    </h4>
                    <table style="width: 100%; font-size: 0.82rem; border-collapse: collapse; border-radius: 8px; overflow: hidden; border: 1px solid var(--border-color);">
                        <thead>
                            <tr style="background: var(--bg-main); text-align: center; border-bottom: 1px solid var(--border-color);">
                                <th style="padding: 0.6rem; text-align: left; font-weight: 700;">Tahapan</th>
                                <th style="padding: 0.6rem; text-align: center; font-weight: 700;">C1</th>
                                <th style="padding: 0.6rem; text-align: center; font-weight: 700;">C2</th>
                                <th style="padding: 0.6rem; text-align: center; font-weight: 700;">C3</th>
                                <th style="padding: 0.6rem; text-align: center; font-weight: 700;">C4</th>
                                <th style="padding: 0.6rem; text-align: center; font-weight: 700;">C5</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="modalNormRow" style="text-align: center; border-bottom: 1px solid var(--border-color); background: #ffffff;">
                                <td style="padding: 0.6rem; text-align: left; font-weight: 700; color: var(--text-secondary);">Normal ($R$)</td>
                            </tr>
                            <tr id="modalWeightRow" style="text-align: center; border-bottom: 1px solid var(--border-color); background: #ffffff;">
                                <td style="padding: 0.6rem; text-align: left; font-weight: 700; color: var(--accent-blue);">Terbobot ($Y$)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Section 3: Ideal Distances and V -->
                <div>
                    <h4 style="font-size: 0.85rem; font-weight: 800; color: var(--text-primary); margin-bottom: 0.75rem; border-left: 4px solid var(--accent-yellow); padding-left: 0.5rem; text-transform: uppercase; letter-spacing: 0.05em;">
                        3. Indeks Jarak & Kedekatan Relatif
                    </h4>
                    <div style="background-color: var(--bg-main); border-radius: 16px; padding: 1rem; border: 1px solid var(--border-color);">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; font-size: 0.82rem; margin-bottom: 0.75rem;">
                            <div>
                                <span style="display: block; color: var(--text-secondary); margin-bottom: 0.2rem; font-weight: 600;">Jarak Ideal Positif ($D^+$):</span>
                                <strong id="modalDPlusVal" style="font-family: monospace; color: var(--accent-red); font-size: 1rem; font-weight: 700;"></strong>
                            </div>
                            <div>
                                <span style="display: block; color: var(--text-secondary); margin-bottom: 0.2rem; font-weight: 600;">Jarak Ideal Negatif ($D^-$):</span>
                                <strong id="modalDMinusVal" style="font-family: monospace; color: var(--accent-emerald); font-size: 1rem; font-weight: 700;"></strong>
                            </div>
                        </div>
                        <div style="border-top: 1px dashed var(--border-color); padding-top: 0.75rem; display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <span style="font-size: 0.75rem; color: var(--text-secondary); display: block; font-weight: 600; margin-bottom: 0.15rem;">Persamaan Preferensi ($V_i$):</span>
                                <span style="font-family: monospace; font-size: 0.8rem; font-weight: 700; color: var(--text-primary);">$V_i = \frac{D_i^-}{D_i^+ + D_i^-}$</span>
                            </div>
                            <div style="text-align: right;">
                                <span style="font-size: 0.75rem; color: var(--text-secondary); display: block; font-weight: 600; margin-bottom: 0.15rem;">Nilai Preferensi ($V$):</span>
                                <strong id="modalVVal" style="font-family: monospace; font-size: 1.15rem; color: var(--accent-blue); font-weight: 800;"></strong>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Modal footer buttons -->
            <div style="margin-top: 1.5rem; border-top: 1px solid var(--border-color); padding-top: 1rem; display: flex; justify-content: flex-end;">
                <button type="button" class="btn-modern btn-secondary-modern" onclick="closeModal()" style="padding: 0.5rem 1.25rem; font-size: 0.85rem; border-radius: 10px;">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Chart.js and Tab switcher JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Tab switching engine
        function switchTab(evt, tabId) {
            // Hide all tab content
            document.querySelectorAll('.tab-content').forEach(content => {
                content.style.display = 'none';
            });
            // Deactivate all tab buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
                btn.style.borderBottom = 'none';
                btn.style.color = 'var(--text-secondary)';
                btn.style.backgroundColor = 'transparent';
            });
            
            // Show current tab content
            document.getElementById(tabId).style.display = 'block';
            
            // Activate current button
            evt.currentTarget.classList.add('active');
            evt.currentTarget.style.borderBottom = '3px solid var(--accent-blue)';
            evt.currentTarget.style.color = 'var(--accent-blue)';
            evt.currentTarget.style.backgroundColor = '#ffffff';

            // Correct the Stepper active status based on tab
            const steps = document.querySelectorAll('.stepper-item');
            steps.forEach((s, idx) => {
                s.classList.remove('active');
                const circ = s.querySelector('.stepper-circle');
                circ.style.background = '#ffffff';
                circ.style.color = 'var(--text-secondary)';
                circ.style.border = '2px solid var(--border-color)';
                circ.style.boxShadow = 'none';
            });

            let currentStepIdx = 4; // Default Peringkat (V)
            if (tabId === 'tab-matrix-x') currentStepIdx = 1; // Matriks X & R (covers Step 1 & 2)
            else if (tabId === 'tab-matrix-y') currentStepIdx = 2; // Terbobot Y (Step 3)
            else if (tabId === 'tab-ideal') currentStepIdx = 3; // Jarak Ideal (Step 4)

            for (let i = 0; i <= currentStepIdx; i++) {
                if (steps[i]) {
                    steps[i].classList.add('active');
                    const circ = steps[i].querySelector('.stepper-circle');
                    if (i === currentStepIdx) {
                        circ.style.background = 'linear-gradient(135deg, var(--primary-gradient-start), var(--primary-gradient-end))';
                        circ.style.color = '#ffffff';
                        circ.style.border = '2px solid #ffffff';
                        circ.style.boxShadow = 'var(--glow-indigo)';
                    } else {
                        circ.style.background = 'var(--accent-emerald-light)';
                        circ.style.color = 'var(--accent-emerald)';
                        circ.style.border = '2px solid var(--accent-emerald)';
                        circ.innerHTML = '<i class="fa-solid fa-check"></i>';
                    }
                }
            }
        }

        // Initialize Tab style correction on load
        document.addEventListener('DOMContentLoaded', function () {
            const activeBtn = document.querySelector('.tab-btn.active');
            if (activeBtn) {
                activeBtn.style.borderBottom = '3px solid var(--accent-blue)';
                activeBtn.style.color = 'var(--accent-blue)';
                activeBtn.style.backgroundColor = '#ffffff';
            }

            // Set dynamic check marks for the default stepper (Step 1 to 4 completed, 5 active)
            const steps = document.querySelectorAll('.stepper-item');
            steps.forEach((s, i) => {
                if (i < 4) {
                    const circ = s.querySelector('.stepper-circle');
                    circ.style.background = 'var(--accent-emerald-light)';
                    circ.style.color = 'var(--accent-emerald)';
                    circ.style.border = '2px solid var(--accent-emerald)';
                    circ.innerHTML = '<i class="fa-solid fa-check"></i>';
                }
            });

            // AJAX Modal Popup Engine
            document.querySelectorAll('.open-math-modal').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.dataset.id;
                    const url = "{{ route('topsis.detail', ':id') }}".replace(':id', id);

                    // Fetch intermediate calculation metrics
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                alert(data.error);
                                return;
                            }

                            // Inject text content
                            document.getElementById('modalWargaName').innerHTML = `<i class="fa-solid fa-user-circle" style="color: var(--accent-blue);"></i> ${data.nama} <span style="font-weight:400; color:var(--text-muted);">|</span> <i class="fa-solid fa-fingerprint" style="color: var(--accent-emerald);"></i> ${data.nik}`;
                            document.getElementById('modalDPlusVal').textContent = data.d_plus.toFixed(5);
                            document.getElementById('modalDMinusVal').textContent = data.d_minus.toFixed(5);
                            document.getElementById('modalVVal').textContent = data.v.toFixed(5);

                            // Build table cells dynamically
                            const keys = ['C1', 'C2', 'C3', 'C4', 'C5'];
                            
                            // 1. Raw rows
                            const rawRow = document.getElementById('modalRawRow');
                            while(rawRow.cells.length > 1) rawRow.deleteCell(1);
                            keys.forEach(k => {
                                const td = rawRow.insertCell();
                                td.style.padding = '0.6rem';
                                td.style.textAlign = 'center';
                                td.style.fontWeight = '700';
                                td.style.color = 'var(--text-primary)';
                                td.textContent = data.scores[k];
                            });

                            // 2. Norm rows
                            const normRow = document.getElementById('modalNormRow');
                            while(normRow.cells.length > 1) normRow.deleteCell(1);
                            keys.forEach(k => {
                                const td = normRow.insertCell();
                                td.style.padding = '0.6rem';
                                td.style.textAlign = 'center';
                                td.style.fontFamily = 'monospace';
                                td.style.fontWeight = '600';
                                td.style.color = 'var(--text-secondary)';
                                td.textContent = data.normalized[k].toFixed(4);
                            });

                            // 3. Weight rows
                            const weightRow = document.getElementById('modalWeightRow');
                            while(weightRow.cells.length > 1) weightRow.deleteCell(1);
                            keys.forEach(k => {
                                const td = weightRow.insertCell();
                                td.style.padding = '0.6rem';
                                td.style.textAlign = 'center';
                                td.style.fontFamily = 'monospace';
                                td.style.color = 'var(--accent-blue)';
                                td.style.fontWeight = '800';
                                td.textContent = data.weighted[k].toFixed(4);
                            });

                            // Display Modal
                            document.getElementById('mathModal').style.display = 'flex';
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Gagal mengambil detail matematis alternatif.');
                        });
                });
            });

            // Initialize Chart.js
            @if($storedResults->count() > 0)
                const ctx = document.getElementById('topsisChart').getContext('2d');
                
                const labels = [];
                const dataPoints = [];
                const backgroundColors = [];
                const borderColors = [];

                @foreach($storedResults as $res)
                    labels.push("{{ $res->warga->nama_lengkap }}");
                    dataPoints.push({{ $res->nilai_preferensi }});
                    backgroundColors.push("{{ $res->status === 'layak' ? 'rgba(5, 150, 105, 0.15)' : 'rgba(79, 70, 229, 0.05)' }}");
                    borderColors.push("{{ $res->status === 'layak' ? '#059669' : '#4f46e5' }}");
                @endforeach

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Nilai Preferensi (V)',
                            data: dataPoints,
                            backgroundColor: backgroundColors,
                            borderColor: borderColors,
                            borderWidth: 2,
                            borderRadius: 9,
                            borderSkipped: false,
                            barPercentage: 0.74,
                            categoryPercentage: 0.72
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                top: 6,
                                right: 18,
                                bottom: 4,
                                left: 2
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                padding: 12,
                                titleFont: {
                                    family: 'Outfit',
                                    size: 13,
                                    weight: 'bold'
                                },
                                bodyFont: {
                                    family: 'Inter',
                                    size: 12
                                },
                                callbacks: {
                                    afterBody: function(context) {
                                        const idx = context[0].dataIndex;
                                        const isLayak = idx < {{ $quota }};
                                        return isLayak ? 'Status: LAYAK MENERIMA' : 'Status: CADANGAN';
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                min: 0.0,
                                max: 1.0,
                                ticks: {
                                    stepSize: 0.1,
                                    font: {
                                        family: 'monospace',
                                        weight: 'bold'
                                    },
                                    color: '#64748b'
                                },
                                grid: {
                                    color: 'rgba(148, 163, 184, 0.18)',
                                    drawBorder: false
                                }
                            },
                            y: {
                                ticks: {
                                    font: {
                                        family: 'Inter',
                                        size: 11,
                                        weight: '600'
                                    },
                                    color: '#475569',
                                    autoSkip: false,
                                    callback: function(value) {
                                        const label = this.getLabelForValue(value);
                                        return label.length > 22 ? label.slice(0, 21) + '...' : label;
                                    }
                                },
                                grid: {
                                    display: false,
                                    drawBorder: false
                                }
                            }
                        }
                    }
                });
            @endif
        });

        // Close Modal trigger
        function closeModal() {
            document.getElementById('mathModal').style.display = 'none';
        }

        // Close modal when clicking outside contents
        window.addEventListener('click', function(e) {
            const modal = document.getElementById('mathModal');
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>

    <style>
        .topsis-chart-card {
            overflow: visible !important;
        }
        .topsis-chart-scroll {
            width: 100%;
            overflow-x: auto;
            overflow-y: hidden;
            padding: 0.35rem 0.1rem 0;
        }
        .topsis-chart-frame {
            position: relative;
            min-width: 720px;
            width: 100%;
        }
        .topsis-podium-grid {
            align-items: stretch;
            padding-top: 0.75rem;
        }
        .topsis-podium-card {
            overflow: visible !important;
            min-height: 146px;
        }
        .topsis-podium-card-main {
            padding-top: 2rem !important;
            border-color: #facc15 !important;
        }
        .topsis-podium-info {
            min-width: 0;
            padding-right: 3.1rem;
        }
        .topsis-podium-card h4,
        .topsis-podium-card span {
            max-width: 100%;
        }
        .tab-btn.active {
            box-shadow: 0 -3px 8px rgba(0,0,0,0.03);
            border-top: 3px solid var(--accent-blue) !important;
            border-left: 1px solid var(--border-color) !important;
            border-right: 1px solid var(--border-color) !important;
        }
        .stepper-item::after {
            content: '';
            position: absolute;
            top: 21px;
            left: calc(50% + 21px);
            width: calc(100% - 42px);
            height: 2px;
            background: var(--border-color);
            z-index: 0;
        }
        .stepper-item:last-child::after {
            display: none;
        }
        .stepper-item.active::after {
            background: var(--accent-emerald);
        }
        @keyframes slideIn {
            from { transform: translateY(24px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .animate-spin-hover:hover {
            transform: rotate(180deg);
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @media (max-width: 768px) {
            .topsis-chart-frame {
                min-width: 620px;
            }
            .topsis-podium-info {
                padding-right: 2.65rem;
            }
        }
    </style>
@endsection
