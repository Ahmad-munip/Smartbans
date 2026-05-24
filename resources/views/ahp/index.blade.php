@extends('layouts.app')

@section('title', 'Analisis Kriteria AHP')

@section('content')
    <!-- Breadcrumb Modern -->
    <ul class="breadcrumb-modern">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa-solid fa-house"></i> Beranda</a></li>
        <li class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></li>
        <li class="breadcrumb-item text-primary" aria-current="page">Analisis Kriteria (AHP)</li>
    </ul>

    <!-- Explanatory Header Banner -->
    <div class="welcome-hero" style="padding: 2.5rem 2rem; margin-bottom: 2rem; position: relative;">
        <div style="position: relative; z-index: 2;">
            <span class="badge-modern" style="background: rgba(255, 255, 255, 0.2); color: #ffffff; margin-bottom: 0.75rem; border: 1px solid rgba(255,255,255,0.35); border-radius: 9999px; padding: 0.35rem 0.85rem; display: inline-flex; align-items: center; gap: 0.4rem;">
                <i class="fa-solid fa-brain"></i> Metode Pembobotan Ilmiah
            </span>
            <h2 class="welcome-hero-title" style="font-size: 2rem; display: flex; align-items: center; gap: 0.75rem;">
                <i class="fa-solid fa-scale-balanced" style="opacity: 0.9;"></i> Pembobotan Kriteria AHP
            </h2>
            <p class="welcome-hero-desc" style="font-size: 1rem; max-width: 850px; line-height: 1.6; opacity: 0.95;">
                Metode <strong>Analytical Hierarchy Process (AHP)</strong> digunakan untuk menentukan bobot prioritas kriteria secara objektif melalui matriks perbandingan berpasangan skala Saaty (1-9). Konsistensi matematis dinilai dengan <em>Consistency Ratio (CR)</em> demi menjamin keputusan ilmiah yang valid.
            </p>
        </div>
    </div>

    <!-- Stepper Visual Proses -->
    <div class="card-modern" style="padding: 1.5rem; margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
            <div style="display: flex; align-items: center; gap: 1.5rem; flex: 1; min-width: 280px;">
                <!-- Step 1 -->
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, var(--primary-gradient-start), var(--primary-gradient-end)); color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.95rem; box-shadow: var(--glow-indigo);">
                        1
                    </div>
                    <div>
                        <h4 style="font-size: 0.85rem; font-weight: 700; color: var(--text-primary); margin: 0;">Isi Matriks</h4>
                        <span style="font-size: 0.7rem; color: var(--text-muted);">Perbandingan Saaty</span>
                    </div>
                </div>

                <!-- Connector -->
                <div style="flex: 1; height: 2px; background: var(--border-color); min-width: 20px;"></div>

                <!-- Step 2 -->
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 36px; height: 36px; border-radius: 50%; background: {{ $calcResults['is_consistent'] ? 'var(--accent-emerald)' : 'var(--accent-red)' }}; color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.95rem; box-shadow: {{ $calcResults['is_consistent'] ? 'var(--glow-emerald)' : '0 0 12px rgba(220, 38, 38, 0.25)' }};">
                        2
                    </div>
                    <div>
                        <h4 style="font-size: 0.85rem; font-weight: 700; color: var(--text-primary); margin: 0;">Uji Konsistensi</h4>
                        <span style="font-size: 0.7rem; color: var(--text-muted);">CR &le; 0.1000</span>
                    </div>
                </div>

                <!-- Connector -->
                <div style="flex: 1; height: 2px; background: var(--border-color); min-width: 20px;"></div>

                <!-- Step 3 -->
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 36px; height: 36px; border-radius: 50%; background: {{ $calcResults['is_consistent'] ? 'linear-gradient(135deg, #10b981, #059669)' : 'var(--bg-main)' }}; color: {{ $calcResults['is_consistent'] ? '#ffffff' : 'var(--text-muted)' }}; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.95rem; border: {{ $calcResults['is_consistent'] ? 'none' : '2px solid var(--border-color)' }};">
                        3
                    </div>
                    <div>
                        <h4 style="font-size: 0.85rem; font-weight: 700; color: {{ $calcResults['is_consistent'] ? 'var(--text-primary)' : 'var(--text-muted)' }}; margin: 0;">Bobot Akhir</h4>
                        <span style="font-size: 0.7rem; color: var(--text-muted);">Gunakan di TOPSIS</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Notifications from Session -->
    @if(session('success'))
        <div style="background-color: var(--accent-emerald-light); color: var(--accent-emerald); border: 1px solid rgba(16, 185, 129, 0.15); border-radius: var(--radius-xl); padding: 1.15rem 1.5rem; margin-bottom: 2rem; display: flex; align-items: center; gap: 1rem; font-size: 0.95rem; box-shadow: var(--shadow-premium-sm);">
            <i class="fa-solid fa-circle-check" style="font-size: 1.35rem; color: var(--accent-emerald);"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(session('warning'))
        <div style="background-color: var(--accent-yellow-light); color: var(--accent-yellow); border: 1px solid rgba(245, 158, 11, 0.15); border-radius: var(--radius-xl); padding: 1.15rem 1.5rem; margin-bottom: 2rem; display: flex; align-items: center; gap: 1rem; font-size: 0.95rem; box-shadow: var(--shadow-premium-sm);">
            <i class="fa-solid fa-triangle-exclamation" style="font-size: 1.35rem; color: var(--accent-yellow);"></i>
            <span>{{ session('warning') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div style="background-color: var(--accent-red-light); color: var(--accent-red); border: 1px solid rgba(239, 68, 68, 0.15); border-radius: var(--radius-xl); padding: 1.15rem 1.5rem; margin-bottom: 2rem; display: flex; align-items: center; gap: 1rem; font-size: 0.95rem; box-shadow: var(--shadow-premium-sm);">
            <i class="fa-solid fa-circle-xmark" style="font-size: 1.35rem; color: var(--accent-red);"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="dashboard-panels" style="grid-template-columns: 1.6fr 1fr; gap: 2rem;">
        <!-- Left: Matrix input Card -->
        <div class="card-modern" style="padding: 2rem; position: relative;">
            <div class="card-header-modern" style="border-bottom: 1px solid var(--border-color); padding-bottom: 1.25rem; margin-bottom: 2rem;">
                <div>
                    <h3 class="card-title-modern" style="font-size: 1.25rem; font-weight: 800;">
                        <i class="fa-solid fa-table-cells" style="color: var(--accent-blue);"></i> Matriks Perbandingan Berpasangan
                    </h3>
                    <p style="font-size: 0.8rem; color: var(--text-secondary); margin-top: 0.25rem; font-weight: 500;">
                        Bandingkan tingkat kepentingan relatif antar kriteria secara horizontal dan vertikal.
                    </p>
                </div>
                <span class="badge-modern badge-blue" style="font-size: 0.75rem; padding: 0.35rem 0.65rem; font-weight: 700; cursor: help; border: 1px solid rgba(79, 70, 229, 0.15);" data-tooltip="Skala 1 (Sama Penting) s.d. 9 (Mutlak Lebih Penting)">
                    <i class="fa-solid fa-circle-info"></i> Skala Saaty
                </span>
            </div>

            <form action="{{ route('ahp.calculate') }}" method="POST">
                @csrf
                <div class="table-responsive" style="border-radius: var(--radius-xl); border: 1px solid var(--border-color); box-shadow: var(--shadow-premium-sm);">
                    <table class="table-modern" style="width: 100%;">
                        <thead>
                            <tr style="text-align: center;">
                                <th style="width: 18%; background-color: var(--bg-main); text-align: center; font-weight: 800; color: var(--text-primary);">Kriteria</th>
                                @foreach($kriterias as $k)
                                    <th style="text-align: center; font-weight: 800; color: var(--text-primary); font-size: 0.85rem;" title="[{{ $k->kode }}] {{ $k->nama_kriteria }}">
                                        {{ $k->kode }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kriterias as $kRow)
                                <tr>
                                    <td style="font-weight: 800; background-color: var(--bg-main); text-align: center; color: var(--text-primary);" title="{{ $kRow->nama_kriteria }}">
                                        {{ $kRow->kode }}
                                    </td>
                                    @foreach($kriterias as $kCol)
                                        <td style="text-align: center; vertical-align: middle; padding: 1rem 0.75rem;">
                                            @if($kRow->id == $kCol->id)
                                                <!-- Diagonal value is always 1.0 -->
                                                <span style="font-weight: 800; color: var(--text-muted); font-size: 0.95rem; font-family: monospace;">1.00</span>
                                                <input type="hidden" name="matrix[{{ $kRow->id }}][{{ $kCol->id }}]" value="1.0">
                                            @elseif($kRow->id < $kCol->id)
                                                <!-- Upper triangle (Select inputs) -->
                                                <select name="matrix[{{ $kRow->id }}][{{ $kCol->id }}]" class="form-select-modern matrix-select" data-row="{{ $kRow->id }}" data-col="{{ $kCol->id }}" style="padding: 0.45rem 0.5rem; font-size: 0.85rem; font-weight: 700; width: 105px; text-align-last: center; margin: 0 auto; display: block; border-radius: 10px; border: 1.5px solid var(--border-color); cursor: pointer; color: var(--text-primary); font-family: monospace;">
                                                    <option value="1" {{ isset($matrix[$kRow->id][$kCol->id]) && $matrix[$kRow->id][$kCol->id] == 1 ? 'selected' : '' }}>1.00</option>
                                                    <option value="2" {{ isset($matrix[$kRow->id][$kCol->id]) && $matrix[$kRow->id][$kCol->id] == 2 ? 'selected' : '' }}>2.00</option>
                                                    <option value="3" {{ isset($matrix[$kRow->id][$kCol->id]) && $matrix[$kRow->id][$kCol->id] == 3 ? 'selected' : '' }}>3.00</option>
                                                    <option value="4" {{ isset($matrix[$kRow->id][$kCol->id]) && $matrix[$kRow->id][$kCol->id] == 4 ? 'selected' : '' }}>4.00</option>
                                                    <option value="5" {{ isset($matrix[$kRow->id][$kCol->id]) && $matrix[$kRow->id][$kCol->id] == 5 ? 'selected' : '' }}>5.00</option>
                                                    <option value="6" {{ isset($matrix[$kRow->id][$kCol->id]) && $matrix[$kRow->id][$kCol->id] == 6 ? 'selected' : '' }}>6.00</option>
                                                    <option value="7" {{ isset($matrix[$kRow->id][$kCol->id]) && $matrix[$kRow->id][$kCol->id] == 7 ? 'selected' : '' }}>7.00</option>
                                                    <option value="8" {{ isset($matrix[$kRow->id][$kCol->id]) && $matrix[$kRow->id][$kCol->id] == 8 ? 'selected' : '' }}>8.00</option>
                                                    <option value="9" {{ isset($matrix[$kRow->id][$kCol->id]) && $matrix[$kRow->id][$kCol->id] == 9 ? 'selected' : '' }}>9.00</option>
                                                    
                                                    <!-- Fractions -->
                                                    <option value="0.5" {{ isset($matrix[$kRow->id][$kCol->id]) && abs($matrix[$kRow->id][$kCol->id] - 0.5) < 0.01 ? 'selected' : '' }}>1/2 (0.50)</option>
                                                    <option value="0.3333" {{ isset($matrix[$kRow->id][$kCol->id]) && abs($matrix[$kRow->id][$kCol->id] - 0.3333) < 0.01 ? 'selected' : '' }}>1/3 (0.33)</option>
                                                    <option value="0.25" {{ isset($matrix[$kRow->id][$kCol->id]) && abs($matrix[$kRow->id][$kCol->id] - 0.25) < 0.01 ? 'selected' : '' }}>1/4 (0.25)</option>
                                                    <option value="0.2" {{ isset($matrix[$kRow->id][$kCol->id]) && abs($matrix[$kRow->id][$kCol->id] - 0.2) < 0.01 ? 'selected' : '' }}>1/5 (0.20)</option>
                                                    <option value="0.1667" {{ isset($matrix[$kRow->id][$kCol->id]) && abs($matrix[$kRow->id][$kCol->id] - 0.1667) < 0.01 ? 'selected' : '' }}>1/6 (0.17)</option>
                                                    <option value="0.1429" {{ isset($matrix[$kRow->id][$kCol->id]) && abs($matrix[$kRow->id][$kCol->id] - 0.1429) < 0.01 ? 'selected' : '' }}>1/7 (0.14)</option>
                                                    <option value="0.125" {{ isset($matrix[$kRow->id][$kCol->id]) && abs($matrix[$kRow->id][$kCol->id] - 0.125) < 0.01 ? 'selected' : '' }}>1/8 (0.13)</option>
                                                    <option value="0.1111" {{ isset($matrix[$kRow->id][$kCol->id]) && abs($matrix[$kRow->id][$kCol->id] - 0.1111) < 0.01 ? 'selected' : '' }}>1/9 (0.11)</option>
                                                </select>
                                            @else
                                                <!-- Lower triangle (Calculated dynamically) -->
                                                <span id="recip_{{ $kRow->id }}_{{ $kCol->id }}" class="reciprocal-cell" data-row="{{ $kRow->id }}" data-col="{{ $kCol->id }}" style="font-weight: 700; color: var(--text-secondary); font-family: monospace; font-size: 0.9rem;">
                                                    {{ isset($matrix[$kRow->id][$kCol->id]) ? (float)number_format($matrix[$kRow->id][$kCol->id], 4) : '1.0000' }}
                                                </span>
                                                <input type="hidden" name="matrix[{{ $kRow->id }}][{{ $kCol->id }}]" id="hidden_{{ $kRow->id }}_{{ $kCol->id }}" value="{{ isset($matrix[$kRow->id][$kCol->id]) ? $matrix[$kRow->id][$kCol->id] : '1.0000' }}">
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Action Button row -->
                @if(in_array(Auth::user()->role, ['admin', 'petugas']))
                    <div style="margin-top: 2rem; display: flex; justify-content: flex-end; gap: 1rem;">
                        <button type="reset" class="btn-modern btn-secondary-modern" style="border-radius: 12px; font-weight: 700; padding: 0.75rem 1.5rem;">
                            <i class="fa-solid fa-arrow-rotate-left"></i> Reset Matriks
                        </button>
                        <button type="submit" class="btn-modern btn-primary-modern" style="border-radius: 12px; font-weight: 700; padding: 0.75rem 1.75rem; box-shadow: var(--shadow-premium-md);">
                            <i class="fa-solid fa-calculator" style="margin-right: 0.25rem;"></i> Hitung & Simpan Bobot
                        </button>
                    </div>
                @else
                    <div style="background-color: var(--bg-main); border: 1.5px dashed var(--border-color); border-radius: var(--radius-xl); padding: 1.15rem; margin-top: 2rem; text-align: center; color: var(--text-secondary); font-size: 0.9rem; font-weight: 500;">
                        <i class="fa-solid fa-lock" style="color: var(--text-muted); margin-right: 0.25rem;"></i> Hanya Admin atau Petugas yang dapat memperbarui dan melakukan kalkulasi matriks perbandingan berpasangan.
                    </div>
                @endif
            </form>

            <!-- Textbook Legend -->
            <div style="margin-top: 2.5rem; border-top: 1px solid var(--border-color); padding-top: 2rem;">
                <h4 style="font-size: 1rem; font-weight: 800; color: var(--text-primary); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-circle-question" style="color: var(--accent-blue);"></i> Panduan Akademis Skala Saaty
                </h4>
                <p style="font-size: 0.85rem; color: var(--text-secondary); line-height: 1.6; margin-bottom: 1rem;">
                    Bandingkan tingkat kepentingan kriteria di baris **Kiri** terhadap kriteria kolom **Atas** berdasarkan pedoman berikut:
                </p>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 0.75rem; font-size: 0.8rem; color: var(--text-secondary);">
                    <div style="background: var(--bg-main); padding: 0.75rem 1rem; border-radius: 10px; border: 1px solid var(--border-color);"><strong style="color: var(--text-primary); display: block; margin-bottom: 0.15rem;">Nilai 1.0 (Sama Penting):</strong> Kedua kriteria berkontribusi sama terhadap tujuan SPK.</div>
                    <div style="background: var(--bg-main); padding: 0.75rem 1rem; border-radius: 10px; border: 1px solid var(--border-color);"><strong style="color: var(--text-primary); display: block; margin-bottom: 0.15rem;">Nilai 3.0 (Sedikit Lebih Penting):</strong> Penilaian sedikit memihak kriteria baris dibanding kolom.</div>
                    <div style="background: var(--bg-main); padding: 0.75rem 1rem; border-radius: 10px; border: 1px solid var(--border-color);"><strong style="color: var(--text-primary); display: block; margin-bottom: 0.15rem;">Nilai 5.0 (Lebih Penting):</strong> Kriteria baris dinilai lebih penting secara kuat dibanding kriteria kolom.</div>
                    <div style="background: var(--bg-main); padding: 0.75rem 1rem; border-radius: 10px; border: 1px solid var(--border-color);"><strong style="color: var(--text-primary); display: block; margin-bottom: 0.15rem;">Nilai 7.0 (Sangat Lebih Penting):</strong> Satu kriteria baris sangat dominan dibanding kriteria kolom.</div>
                    <div style="background: var(--bg-main); padding: 0.75rem 1rem; border-radius: 10px; border: 1px solid var(--border-color);"><strong style="color: var(--text-primary); display: block; margin-bottom: 0.15rem;">Nilai 9.0 (Mutlak Lebih Penting):</strong> Dominasi kriteria baris berada pada tingkat tertinggi yang tak terbantahkan.</div>
                    <div style="background: var(--bg-main); padding: 0.75rem 1rem; border-radius: 10px; border: 1px solid var(--border-color);"><strong style="color: var(--text-primary); display: block; margin-bottom: 0.15rem;">Pecahan (1/3, 1/5, 1/9):</strong> Kebalikan perbandingan (Kriteria kolom lebih dominan dari kriteria baris).</div>
                </div>
            </div>
        </div>

        <!-- Right: Results Card -->
        <div style="display: flex; flex-direction: column; gap: 2rem;">
            <!-- Consistency Status Panel -->
            @php
                $consistentColor = $calcResults['is_consistent'] ? 'var(--accent-emerald)' : 'var(--accent-red)';
                $consistentGlow = $calcResults['is_consistent'] ? 'var(--glow-emerald)' : '0 0 16px rgba(220, 38, 38, 0.2)';
                $consistentBg = $calcResults['is_consistent'] ? 'rgba(5, 150, 105, 0.02)' : 'rgba(220, 38, 38, 0.02)';
            @endphp
            <div class="card-modern" style="padding: 2rem; border: 1.5px solid {{ $consistentColor }}; box-shadow: {{ $consistentGlow }}; background-color: {{ $consistentBg }}; overflow: relative;">
                <div class="card-header-modern" style="margin-bottom: 1.25rem;">
                    <h3 class="card-title-modern" style="font-size: 1.1rem; font-weight: 800; color: var(--text-primary);">
                        <i class="fa-solid fa-shield-halved" style="color: {{ $consistentColor }};"></i> Uji Konsistensi Keputusan
                    </h3>
                </div>

                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; background-color: #ffffff; padding: 0.85rem 1.15rem; border-radius: var(--radius-xl); border: 1px solid var(--border-color); box-shadow: var(--shadow-premium-sm);">
                    <span style="font-size: 0.9rem; font-weight: 700; color: var(--text-secondary);">Rasio Konsistensi (CR)</span>
                    @if($calcResults['is_consistent'])
                        <span class="badge-emerald-pulse" style="padding: 0.4rem 0.85rem; font-size: 0.85rem; font-weight: 800; border-radius: 12px;">
                            <i class="fa-solid fa-circle-check"></i> KONSISTEN ({{ number_format($calcResults['cr'], 4) }})
                        </span>
                    @else
                        <span class="badge-modern badge-red" style="padding: 0.4rem 0.85rem; font-size: 0.85rem; font-weight: 800; border-radius: 12px; animation: flashRed 1.5s infinite alternate; box-shadow: 0 0 12px rgba(220, 38, 38, 0.3);">
                            <i class="fa-solid fa-circle-xmark"></i> TIDAK KONSISTEN ({{ number_format($calcResults['cr'], 4) }})
                        </span>
                    @endif
                </div>

                @if($calcResults['is_consistent'])
                    <p style="font-size: 0.85rem; color: var(--text-secondary); line-height: 1.6; margin: 0; font-weight: 500;">
                        Matriks perbandingan dinilai <strong style="color: var(--accent-emerald);">Konsisten secara Matematis</strong> karena nilai CR <strong>&le; 0.1000</strong>. Bobot kriteria di bawah ini valid, adil, dan siap digunakan oleh modul pemeringkatan TOPSIS.
                    </p>
                @else
                    <div style="background-color: var(--accent-red-light); color: var(--accent-red); border: 1px solid rgba(220, 38, 38, 0.15); border-radius: var(--radius-xl); padding: 1rem 1.15rem; font-size: 0.82rem; line-height: 1.6; font-weight: 500;">
                        <i class="fa-solid fa-circle-exclamation" style="margin-right: 0.35rem; font-size: 1rem; vertical-align: middle;"></i>
                        Matriks Anda dinilai <strong style="color: var(--accent-red);">Tidak Konsisten</strong> karena nilai CR melebihi batas toleransi akademis <strong>0.1000</strong>. Silakan sesuaikan kembali perbandingan kriteria agar lebih rasional dan logis, lalu hitung ulang.
                    </div>
                @endif
            </div>

            <!-- Calculated Weights & Visualizer -->
            <div class="card-modern" style="padding: 2rem;">
                <div class="card-header-modern" style="border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; margin-bottom: 1.5rem;">
                    <h3 class="card-title-modern" style="font-size: 1.1rem; font-weight: 800;">
                        <i class="fa-solid fa-chart-bar" style="color: var(--accent-blue);"></i> Hasil Bobot Prioritas Kriteria
                    </h3>
                </div>

                <!-- Find the highest weight key to highlight it -->
                @php
                    $highestWeightVal = 0;
                    $highestWeightKriteriaId = null;
                    if(isset($calcResults['weights']) && count($calcResults['weights']) > 0) {
                        $highestWeightVal = max($calcResults['weights']);
                        $highestWeightKriteriaId = array_search($highestWeightVal, $calcResults['weights']);
                    }
                @endphp

                <div style="margin-bottom: 1.5rem; display: flex; flex-direction: column; gap: 1rem;">
                    @foreach($kriterias as $kRow)
                        @php
                            $wVal = $calcResults['weights'][$kRow->id] ?? 0.0;
                            $percent = $wVal * 100;
                            $isHighest = $kRow->id == $highestWeightKriteriaId && $calcResults['is_consistent'];
                        @endphp
                        <div style="padding: 0.75rem 1rem; border-radius: 16px; border: 1.5px solid {{ $isHighest ? 'rgba(79, 70, 229, 0.2)' : 'var(--border-color)' }}; background-color: {{ $isHighest ? 'var(--accent-blue-light)' : '#ffffff' }}; transition: var(--transition-smooth); box-shadow: var(--shadow-premium-sm);">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; font-size: 0.85rem; align-items: center;">
                                <span style="font-weight: 700; color: var(--text-primary); display: flex; align-items: center; gap: 0.35rem;">
                                    [{{ $kRow->kode }}] {{ $kRow->nama_kriteria }}
                                    @if($isHighest)
                                        <span class="badge-modern badge-blue" style="font-size: 0.65rem; padding: 0.15rem 0.45rem; border-radius: 6px;">
                                            <i class="fa-solid fa-crown" style="font-size: 0.65rem; color: var(--accent-blue);"></i> Prioritas Utama
                                        </span>
                                    @endif
                                </span>
                                <span style="font-weight: 800; font-family: monospace; font-size: 0.95rem; color: {{ $isHighest ? 'var(--accent-blue)' : 'var(--text-primary)' }};">
                                    {{ number_format($percent, 2) }}%
                                </span>
                            </div>
                            <div style="background-color: {{ $isHighest ? '#ffffff' : 'var(--bg-main)' }}; height: 10px; border-radius: 5px; overflow: hidden; display: flex; border: 1px solid var(--border-color);">
                                <div class="weight-progress-bar" style="background: linear-gradient(90deg, var(--primary-gradient-start), {{ $isHighest ? 'var(--accent-blue)' : 'var(--accent-emerald)' }}); width: {{ $percent }}%; height: 100%; border-radius: 5px; animation: barAnim 1s ease-out;"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Math Details Accordion card -->
                <div style="background-color: var(--bg-main); border-radius: var(--radius-2xl); border: 1px solid var(--border-color); padding: 1.25rem; box-shadow: var(--shadow-premium-sm);">
                    <h4 style="font-size: 0.9rem; font-weight: 800; color: var(--text-primary); margin-bottom: 1rem; display: flex; align-items: center; justify-content: space-between;">
                        <span><i class="fa-solid fa-calculator" style="color: var(--text-secondary); margin-right: 0.25rem;"></i> Parameter Perhitungan AHP</span>
                        <span class="badge-modern" style="font-size: 0.7rem; background: rgba(0,0,0,0.05); color: var(--text-secondary); font-weight: 700;">METODE EIGENVEKTOR</span>
                    </h4>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem; font-size: 0.8rem; color: var(--text-secondary);">
                        <div style="background: #ffffff; padding: 0.65rem 0.85rem; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: var(--shadow-premium-sm);">
                            <span style="display: block; color: var(--text-muted); font-size: 0.68rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.15rem;">Eigen Maksimal (&lambda; max)</span>
                            <strong style="color: var(--text-primary); font-size: 0.95rem; font-family: monospace;">{{ number_format($calcResults['lambda_max'], 4) }}</strong>
                        </div>
                        <div style="background: #ffffff; padding: 0.65rem 0.85rem; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: var(--shadow-premium-sm);">
                            <span style="display: block; color: var(--text-muted); font-size: 0.68rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.15rem;">Index Konsistensi (CI)</span>
                            <strong style="color: var(--text-primary); font-size: 0.95rem; font-family: monospace;">{{ number_format($calcResults['ci'], 4) }}</strong>
                        </div>
                        <div style="background: #ffffff; padding: 0.65rem 0.85rem; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: var(--shadow-premium-sm);">
                            <span style="display: block; color: var(--text-muted); font-size: 0.68rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.15rem;">Random Index (RI)</span>
                            <strong style="color: var(--text-primary); font-size: 0.95rem; font-family: monospace;">1.12</strong>
                        </div>
                        <div style="background: #ffffff; padding: 0.65rem 0.85rem; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: var(--shadow-premium-sm);">
                            <span style="display: block; color: var(--text-muted); font-size: 0.68rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.15rem;">Consistency Ratio (CR)</span>
                            <strong style="color: {{ $consistentColor }}; font-size: 0.95rem; font-family: monospace;">{{ number_format($calcResults['cr'], 4) }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Real-time reciprocals dynamic mapping -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Interactive automatic reciprocity calculations
            document.querySelectorAll('.matrix-select').forEach(select => {
                select.addEventListener('change', function () {
                    const row = this.dataset.row;
                    const col = this.dataset.col;
                    const val = parseFloat(this.value);
                    
                    if (val === 0) return;
                    
                    // Calculate inverse value
                    const reciprocalVal = (1 / val);
                    
                    // Find opposite visual label element
                    const recipLabel = document.getElementById('recip_' + col + '_' + row);
                    if (recipLabel) {
                        // Format fraction values elegantly in lower triangle label
                        if (val === 1) recipLabel.textContent = "1.0000";
                        else if (val === 2) recipLabel.textContent = "0.5000";
                        else if (val === 3) recipLabel.textContent = "0.3333";
                        else if (val === 4) recipLabel.textContent = "0.2500";
                        else if (val === 5) recipLabel.textContent = "0.2000";
                        else if (val === 6) recipLabel.textContent = "0.1667";
                        else if (val === 7) recipLabel.textContent = "0.1429";
                        else if (val === 8) recipLabel.textContent = "0.1250";
                        else if (val === 9) recipLabel.textContent = "0.1111";
                        else {
                            // If user selected fractional value, reciprocal is integer
                            recipLabel.textContent = reciprocalVal.toFixed(4);
                        }
                    }
                    
                    // Update hidden inputs for full form submit
                    const hiddenInput = document.getElementById('hidden_' + col + '_' + row);
                    if (hiddenInput) {
                        hiddenInput.value = reciprocalVal.toFixed(4);
                    }
                });
            });
        });
    </script>
    
    <style>
        @keyframes flashRed {
            0% { box-shadow: 0 0 4px rgba(220, 38, 38, 0.2); }
            100% { box-shadow: 0 0 12px rgba(220, 38, 38, 0.5); }
        }
        @keyframes barAnim {
            from { width: 0%; }
            to { width: 100%; }
        }
        .weight-progress-bar {
            transition: width 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
@endsection

