@extends('layouts.app')

@section('title', 'Laporan & Output SPK')
@section('page_title', 'Laporan SPK')

@section('content')
    <div class="row-modern">
        <div class="col-12">
            <!-- Welcome Info & Summary Card -->
            <div class="welcome-hero" style="padding: 2rem; margin-bottom: 2rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
                    <div>
                        <h2 class="welcome-hero-title" style="font-size: 1.65rem; font-weight: 800; font-family: var(--font-heading); display: flex; align-items: center; gap: 0.65rem;">
                            <i class="fa-solid fa-file-pdf" style="opacity: 0.9;"></i> Pusat Dokumentasi & Laporan SPK
                        </h2>
                        <p class="welcome-hero-desc" style="font-size: 0.95rem; margin-top: 0.5rem; color: rgba(255, 255, 255, 0.85); line-height: 1.5;">
                            Unduh, cetak, dan ekspor semua hasil pengolahan data kependudukan dan komputasi SPK AHP & TOPSIS secara legal dengan kop surat resmi.
                        </p>
                    </div>
                    <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                        <span style="border: 1px solid rgba(255,255,255,0.3); padding: 0.4rem 0.85rem; font-size: 0.78rem; background: rgba(255, 255, 255, 0.15); color: #ffffff; border-radius: 9999px; display: inline-flex; align-items: center; gap: 0.4rem; font-weight: 600;">
                            <i class="fa-solid fa-users"></i> {{ $totalWarga }} Warga
                        </span>
                        <span style="border: 1px solid rgba(255,255,255,0.3); padding: 0.4rem 0.85rem; font-size: 0.78rem; background: rgba(255, 255, 255, 0.15); color: #ffffff; border-radius: 9999px; display: inline-flex; align-items: center; gap: 0.4rem; font-weight: 600;">
                            <i class="fa-solid fa-square-check"></i> {{ $totalLayak }} Rekomendasi Layak
                        </span>
                    </div>
                </div>
            </div>

            <!-- Report Selector Tabs -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.25rem; margin-bottom: 2rem;">
                
                <!-- Tab Warga -->
                <a href="{{ route('laporan.index', ['type' => 'warga', 'desa' => $desa, 'status' => $status]) }}" style="text-decoration: none; color: inherit;">
                    <div class="card-modern hover-card {{ $type === 'warga' ? 'card-active-border' : '' }}" style="padding: 1.5rem; transition: var(--transition-smooth); border-left: 5px solid var(--accent-blue); position: relative; {{ $type === 'warga' ? 'box-shadow: var(--shadow-premium-md);' : '' }}">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div class="stat-icon-wrapper icon-blue" style="width: 48px; height: 48px; font-size: 1.2rem; border-radius: 14px;">
                                <i class="fa-solid fa-address-book"></i>
                            </div>
                            <div>
                                <h4 style="margin: 0; font-size: 1rem; font-weight: 800; color: var(--text-primary); font-family: var(--font-heading);">Demografi Warga</h4>
                                <span style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 500;">Profil & Sosial Ekonomi</span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Tab AHP -->
                <a href="{{ route('laporan.index', ['type' => 'ahp', 'desa' => $desa, 'status' => $status]) }}" style="text-decoration: none; color: inherit;">
                    <div class="card-modern hover-card {{ $type === 'ahp' ? 'card-active-border' : '' }}" style="padding: 1.5rem; transition: var(--transition-smooth); border-left: 5px solid var(--accent-yellow); position: relative; {{ $type === 'ahp' ? 'box-shadow: var(--shadow-premium-md);' : '' }}">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div class="stat-icon-wrapper icon-yellow" style="width: 48px; height: 48px; font-size: 1.2rem; border-radius: 14px; background-color: rgba(217, 119, 6, 0.08); color: #d97706;">
                                <i class="fa-solid fa-scale-balanced"></i>
                            </div>
                            <div>
                                <h4 style="margin: 0; font-size: 1rem; font-weight: 800; color: var(--text-primary); font-family: var(--font-heading);">Prioritas AHP</h4>
                                <span style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 500;">Konsistensi & Bobot</span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Tab TOPSIS -->
                <a href="{{ route('laporan.index', ['type' => 'topsis', 'desa' => $desa, 'status' => $status]) }}" style="text-decoration: none; color: inherit;">
                    <div class="card-modern hover-card {{ $type === 'topsis' ? 'card-active-border' : '' }}" style="padding: 1.5rem; transition: var(--transition-smooth); border-left: 5px solid #8b5cf6; position: relative; {{ $type === 'topsis' ? 'box-shadow: var(--shadow-premium-md);' : '' }}">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div class="stat-icon-wrapper icon-purple" style="width: 48px; height: 48px; font-size: 1.2rem; border-radius: 14px; background-color: rgba(139, 92, 246, 0.08); color: #8b5cf6;">
                                <i class="fa-solid fa-ranking-star"></i>
                            </div>
                            <div>
                                <h4 style="margin: 0; font-size: 1rem; font-weight: 800; color: var(--text-primary); font-family: var(--font-heading);">Analisis TOPSIS</h4>
                                <span style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 500;">Vektor Jarak & Skor</span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Tab Penerima -->
                <a href="{{ route('laporan.index', ['type' => 'penerima', 'desa' => $desa, 'status' => $status]) }}" style="text-decoration: none; color: inherit;">
                    <div class="card-modern hover-card {{ $type === 'penerima' ? 'card-active-border' : '' }}" style="padding: 1.5rem; transition: var(--transition-smooth); border-left: 5px solid var(--accent-emerald); position: relative; {{ $type === 'penerima' ? 'box-shadow: var(--shadow-premium-md);' : '' }}">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div class="stat-icon-wrapper icon-emerald" style="width: 48px; height: 48px; font-size: 1.2rem; border-radius: 14px;">
                                <i class="fa-solid fa-hand-holding-heart"></i>
                            </div>
                            <div>
                                <h4 style="margin: 0; font-size: 1rem; font-weight: 800; color: var(--text-primary); font-family: var(--font-heading);">Penerima Bantuan</h4>
                                <span style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 500;">Rekomendasi Warga Layak</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Filters & Actions Card -->
            <div class="card-modern" style="margin-bottom: 2rem; padding: 1.5rem; background: var(--bg-card); border: 1px solid var(--border-color);">
                <form action="{{ route('laporan.index') }}" method="GET" id="filterForm">
                    <input type="hidden" name="type" value="{{ $type }}">
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
                        
                        <!-- Filter Inputs -->
                        <div style="display: flex; gap: 1.25rem; align-items: center; flex-wrap: wrap; flex: 1;">
                            @if($type !== 'ahp')
                                <div style="min-width: 220px;">
                                    <label class="form-label-modern" style="font-size: 0.78rem; font-weight: 700; color: var(--text-secondary); margin-bottom: 0.35rem; display: block; text-transform: uppercase; letter-spacing: 0.05em;">
                                        <i class="fa-solid fa-filter" style="color: var(--accent-blue);"></i> Filter Desa
                                    </label>
                                    <select name="desa" class="form-select-modern" style="padding: 0.5rem 1rem; font-size: 0.88rem; width: 100%; border-radius: 10px; background-color: #ffffff;" onchange="this.form.submit()">
                                        <option value="">-- Semua Desa --</option>
                                        @foreach($villages as $v)
                                            <option value="{{ $v }}" {{ $desa === $v ? 'selected' : '' }}>{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            @if($type === 'topsis')
                                <div style="min-width: 220px;">
                                    <label class="form-label-modern" style="font-size: 0.78rem; font-weight: 700; color: var(--text-secondary); margin-bottom: 0.35rem; display: block; text-transform: uppercase; letter-spacing: 0.05em;">
                                        <i class="fa-solid fa-circle-info" style="color: var(--accent-blue);"></i> Filter Kelayakan
                                    </label>
                                    <select name="status" class="form-select-modern" style="padding: 0.5rem 1rem; font-size: 0.88rem; width: 100%; border-radius: 10px; background-color: #ffffff;" onchange="this.form.submit()">
                                        <option value="">-- Semua Kelayakan --</option>
                                        <option value="layak" {{ $status === 'layak' ? 'selected' : '' }}>Layak</option>
                                        <option value="tidak layak" {{ $status === 'tidak layak' ? 'selected' : '' }}>Tidak Layak</option>
                                    </select>
                                </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                            <!-- Excel Export -->
                            <a href="{{ route('laporan.excel', ['type' => $type, 'desa' => $desa, 'status' => $status]) }}" class="btn-modern" style="padding: 0.6rem 1.25rem; font-size: 0.88rem; border-radius: 12px; background: linear-gradient(135deg, #10b981, #059669); color: #ffffff; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2); font-weight: 700; display: inline-flex; align-items: center; gap: 0.5rem;" title="Ekspor ke Excel">
                                <i class="fa-solid fa-file-excel animate-pulse"></i> Ekspor Excel
                            </a>
                            
                            <!-- PDF / Print -->
                            <a href="{{ route('laporan.cetak', ['type' => $type, 'desa' => $desa, 'status' => $status]) }}" target="_blank" class="btn-modern btn-primary-modern" style="padding: 0.6rem 1.25rem; font-size: 0.88rem; border-radius: 12px; font-weight: 700; display: inline-flex; align-items: center; gap: 0.5rem;" title="Cetak PDF / Pratinjau">
                                <i class="fa-solid fa-print animate-pulse"></i> Cetak / PDF
                            </a>
                        </div>

                    </div>
                </form>
            </div>

            <!-- Preview Card -->
            <div class="card-modern" style="background: var(--bg-card); border: 1px solid var(--border-color); padding: 2rem;">
                <div class="card-header-modern" style="border-bottom: 1px solid var(--border-color); padding-bottom: 1.25rem; margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                    <div>
                        <h3 class="card-title-modern" style="font-size: 1.15rem; font-family: var(--font-heading); color: var(--text-primary); display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fa-solid fa-eye" style="color: var(--accent-blue);"></i> 
                            Pratinjau Lembar Output: 
                            <span style="color: var(--accent-blue); text-transform: uppercase; font-weight: 800;">Laporan {{ $type }}</span>
                        </h3>
                        <p style="font-size: 0.8rem; color: var(--text-secondary); margin-top: 0.25rem; font-weight: 500;">
                            Pratinjau lembar cetak dokumen resmi yang akan dihasilkan oleh sistem SPK BanSmart.
                        </p>
                    </div>
                    <div style="display: flex; gap: 0.5rem;">
                        @if($desa)
                            <span class="badge-modern badge-blue" style="font-weight: 700; font-size: 0.72rem; padding: 0.3rem 0.65rem;">Filter Desa: {{ $desa }}</span>
                        @endif
                        @if($status)
                            <span class="badge-modern badge-yellow" style="font-weight: 700; font-size: 0.72rem; padding: 0.3rem 0.65rem;">Kelayakan: {{ strtoupper($status) }}</span>
                        @endif
                    </div>
                </div>

                <div class="table-responsive">
                    <!-- REPORT 1: WARGA -->
                    @if($type === 'warga')
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th style="width: 60px; text-align: center;">No</th>
                                    <th>NIK</th>
                                    <th>Nama Lengkap</th>
                                    <th>Pekerjaan</th>
                                    <th>Penghasilan</th>
                                    <th style="text-align: center; width: 110px;">Tanggungan</th>
                                    <th>Kondisi Rumah</th>
                                    <th>Desa</th>
                                    <th style="text-align: center; width: 90px;">RT/RW</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $index => $w)
                                    <tr>
                                        <td style="text-align: center; font-weight: 700; color: var(--text-secondary);">{{ $index + 1 }}</td>
                                        <td style="font-family: monospace; font-size: 0.85rem;">{{ $w->nik }}</td>
                                        <td style="font-weight: 800; color: var(--text-primary);">{{ $w->nama_lengkap }}</td>
                                        <td style="font-weight: 600; color: var(--text-secondary);">{{ $w->pekerjaan }}</td>
                                        <td style="font-weight: 700; font-family: monospace; color: var(--accent-blue);">Rp {{ number_format($w->penghasilan, 0, ',', '.') }}</td>
                                        <td style="text-align: center; font-weight: 700; color: var(--text-primary);">{{ $w->jumlah_tanggungan }} Orang</td>
                                        <td><span style="font-size: 0.8rem; color: var(--text-secondary); font-weight: 500;">{{ Str::limit($w->kondisi_rumah, 40) }}</span></td>
                                        <td><span class="badge-modern badge-blue" style="font-weight: 700;">{{ $w->desa }}</span></td>
                                        <td style="text-align: center; font-family: monospace; font-weight: 600;">{{ $w->rt }}/{{ $w->rw }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" style="text-align: center; padding: 4rem; color: var(--text-muted);">
                                            <div style="font-size: 2.5rem; margin-bottom: 0.75rem;"><i class="fa-solid fa-folder-open"></i></div>
                                            <p style="font-weight: 600; font-size: 0.95rem;">Tidak ada data demografi warga</p>
                                            <span style="font-size: 0.8rem;">Silakan tambahkan data warga di menu Master Data Warga.</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    <!-- REPORT 2: AHP -->
                    @elseif($type === 'ahp')
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th style="width: 60px; text-align: center;">No</th>
                                    <th style="width: 100px; text-align: center;">Kode</th>
                                    <th>Nama Kriteria</th>
                                    <th style="width: 140px; text-align: center;">Tipe</th>
                                    <th style="text-align: center; width: 220px;">Bobot Prioritas (Hasil AHP)</th>
                                    <th>Visualisasi Kontribusi Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $index => $k)
                                    <tr>
                                        <td style="text-align: center; font-weight: 700; color: var(--text-secondary);">{{ $index + 1 }}</td>
                                        <td style="text-align: center; font-weight: 800; font-family: monospace;"><code>{{ $k->kode }}</code></td>
                                        <td style="font-weight: 800; color: var(--text-primary);">{{ $k->nama }}</td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <span class="badge-modern {{ $k->jenis === 'benefit' ? 'badge-emerald' : 'badge-red' }}" style="font-weight: 700; padding: 0.35rem 0.65rem; text-transform: uppercase;">
                                                <i class="fa-solid {{ $k->jenis === 'benefit' ? 'fa-circle-arrow-up' : 'fa-circle-arrow-down' }}"></i> {{ $k->jenis }}
                                            </span>
                                        </td>
                                        <td style="font-weight: 800; text-align: center; font-family: monospace; font-size: 1.05rem; color: var(--accent-blue);">
                                            {{ number_format($k->bobot, 4) }}
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                                <div style="background-color: var(--border-color); border-radius: 9999px; height: 10px; flex: 1; overflow: hidden; border: 1px solid rgba(0,0,0,0.03);">
                                                    <div style="background: linear-gradient(90deg, var(--accent-blue), var(--accent-emerald)); height: 100%; border-radius: 9999px; width: {{ $k->bobot * 100 }}%;"></div>
                                                </div>
                                                <span style="font-size: 0.78rem; font-family: monospace; font-weight: 700; color: var(--text-secondary);">{{ number_format($k->bobot * 100, 1) }}%</span>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align: center; padding: 4rem; color: var(--text-muted);">
                                            <div style="font-size: 2.5rem; margin-bottom: 0.75rem;"><i class="fa-solid fa-triangle-exclamation"></i></div>
                                            <p style="font-weight: 600; font-size: 0.95rem;">Bobot kriteria AHP kosong</p>
                                            <span style="font-size: 0.8rem;">Silakan lakukan analisis perbandingan berpasangan kriteria di menu AHP terlebih dahulu.</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    <!-- REPORT 3: TOPSIS -->
                    @elseif($type === 'topsis')
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th style="width: 80px; text-align: center;">Rank</th>
                                    <th>NIK</th>
                                    <th>Nama Alternatif (Warga)</th>
                                    <th>Desa</th>
                                    <th style="text-align: center; width: 180px;">D+ (Jarak Ideal Positif)</th>
                                    <th style="text-align: center; width: 180px;">D- (Jarak Ideal Negatif)</th>
                                    <th style="text-align: center; width: 180px;">Nilai Preferensi (V)</th>
                                    <th style="text-align: center; width: 140px;">Status Kelayakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $t)
                                    @php
                                        $rowStyle = '';
                                        if ($t->ranking == 1) {
                                            $rowStyle = 'background: linear-gradient(90deg, rgba(234, 179, 8, 0.04), transparent); font-weight: 600;';
                                        }
                                    @endphp
                                    <tr style="{{ $rowStyle }}">
                                        <td style="text-align: center; vertical-align: middle;">
                                            @if($t->ranking <= 3)
                                                <span class="badge-modern badge-yellow" style="padding: 0.35rem 0.65rem; font-weight: 800; font-size: 0.75rem; box-shadow: 0 2px 6px rgba(234, 179, 8, 0.15); font-family: var(--font-heading);">
                                                    🏆 #{{ $t->ranking }}
                                                </span>
                                            @else
                                                <span style="font-weight: 700; color: var(--text-secondary);">#{{ $t->ranking }}</span>
                                            @endif
                                        </td>
                                        <td style="font-family: monospace; font-size: 0.85rem; vertical-align: middle;">{{ $t->warga->nik }}</td>
                                        <td style="font-weight: 800; color: var(--text-primary); vertical-align: middle;">{{ $t->warga->nama_lengkap }}</td>
                                        <td style="vertical-align: middle;">{{ $t->warga->desa }}</td>
                                        <td style="text-align: center; font-family: monospace; color: var(--accent-red); font-size: 0.88rem; font-weight: 600; vertical-align: middle;">{{ number_format($t->d_pos, 5) }}</td>
                                        <td style="text-align: center; font-family: monospace; color: var(--accent-emerald); font-size: 0.88rem; font-weight: 600; vertical-align: middle;">{{ number_format($t->d_neg, 5) }}</td>
                                        <td style="text-align: center; font-family: monospace; font-weight: 800; font-size: 1.02rem; color: var(--accent-blue); vertical-align: middle;">
                                            {{ number_format($t->preferensi, 5) }}
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            @if($t->status === 'layak')
                                                <span class="badge-emerald-pulse" style="padding: 0.3rem 0.6rem; font-size: 0.72rem; font-weight: 700;">
                                                    LAYAK
                                                </span>
                                            @else
                                                <span class="badge-modern badge-yellow" style="padding: 0.3rem 0.6rem; font-size: 0.72rem; font-weight: 600;">
                                                    CADANGAN
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" style="text-align: center; padding: 4rem; color: var(--text-muted);">
                                            <div style="font-size: 2.5rem; margin-bottom: 0.75rem;"><i class="fa-solid fa-chart-line"></i></div>
                                            <p style="font-weight: 600; font-size: 0.95rem; margin-bottom: 0.25rem;">Tidak ada hasil kalkulasi TOPSIS</p>
                                            <span style="font-size: 0.8rem;">Silakan jalankan proses perhitungan TOPSIS di panel SPK terlebih dahulu.</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    <!-- REPORT 4: PENERIMA -->
                    @elseif($type === 'penerima')
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th style="width: 80px; text-align: center;">No</th>
                                    <th>NIK</th>
                                    <th>Nama Penerima Layak</th>
                                    <th>Alamat Rumah</th>
                                    <th>Desa</th>
                                    <th style="text-align: center; width: 180px;">Skor Preferensi (V)</th>
                                    <th style="text-align: center; width: 160px;">Kelayakan</th>
                                    <th style="text-align: center; width: 140px;">Otoritas Verifikasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $index => $p)
                                    <tr style="border-left: 4px solid var(--accent-emerald); background-color: rgba(16, 185, 129, 0.015);">
                                        <td style="text-align: center; font-weight: 800; color: #047857; font-family: var(--font-heading); vertical-align: middle;">
                                            {{ $index + 1 }}
                                        </td>
                                        <td style="font-family: monospace; font-size: 0.85rem; vertical-align: middle;">{{ $p->warga->nik }}</td>
                                        <td style="font-weight: 800; color: #047857; vertical-align: middle;">{{ $p->warga->nama_lengkap }}</td>
                                        <td style="font-size: 0.82rem; color: var(--text-secondary); vertical-align: middle;">{{ $p->warga->alamat }} (RT {{ $p->warga->rt }}/RW {{ $p->warga->rw }})</td>
                                        <td style="vertical-align: middle;"><span class="badge-modern badge-blue" style="font-weight: 700;">{{ $p->warga->desa }}</span></td>
                                        <td style="text-align: center; font-family: monospace; font-weight: 800; font-size: 1.05rem; color: #047857; vertical-align: middle;">
                                            {{ number_format($p->preferensi, 5) }}
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <span class="badge-emerald-pulse" style="padding: 0.35rem 0.75rem; font-size: 0.72rem; font-weight: 800;">
                                                REKOMENDASI LAYAK
                                            </span>
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <span class="badge-modern badge-blue" style="font-size: 0.7rem; font-weight: 700; padding: 0.3rem 0.6rem; border: 1px solid rgba(59, 130, 246, 0.2);">
                                                <i class="fa-solid fa-circle-check"></i> Terverifikasi
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" style="text-align: center; padding: 4rem; color: var(--text-muted);">
                                            <div style="font-size: 2.5rem; margin-bottom: 0.75rem; color: var(--text-muted);"><i class="fa-solid fa-user-xmark"></i></div>
                                            <p style="font-weight: 600; font-size: 0.95rem; margin-bottom: 0.25rem;">Tidak ada warga yang tergolong layak</p>
                                            <span style="font-size: 0.8rem;">Silakan jalankan perhitungan TOPSIS atau set ulang kuota batas kelayakan bantuan sosial.</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection

@section('styles')
    <style>
        .hover-card {
            border: 1px solid var(--border-color);
            background: #ffffff;
            cursor: pointer;
            border-radius: 20px;
        }
        .hover-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: var(--shadow-premium-lg) !important;
            border-color: rgba(79, 70, 229, 0.25) !important;
        }
        .card-active-border {
            border: 2px solid var(--accent-blue) !important;
            background-color: rgba(79, 70, 229, 0.02) !important;
            box-shadow: var(--shadow-premium-md) !important;
        }
        .card-active-border::after {
            content: '\f058';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            color: var(--accent-blue);
            font-size: 1.15rem;
        }
    </style>
@endsection
