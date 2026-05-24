@extends('layouts.app')

@section('title', 'Data Kriteria')
@section('page_title', 'Master Data Kriteria')

@section('content')
    <!-- Actions and Info Bar -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; margin-bottom: 2rem; align-items: stretch; flex-wrap: wrap;">
        <!-- Left info card -->
        <div class="card-modern" style="padding: 1.5rem; flex-direction: row; align-items: center; gap: 1.25rem;">
            <div class="stat-icon-wrapper icon-blue" style="width: 56px; height: 56px; border-radius: var(--radius-xl); font-size: 1.5rem; flex-shrink: 0;">
                <i class="fa-solid fa-scale-balanced"></i>
            </div>
            <div>
                <h4 style="font-weight: 700; font-size: 1rem; color: var(--text-primary);">Pembobotan Kriteria AHP</h4>
                <p style="font-size: 0.8rem; color: var(--text-secondary); line-height: 1.4; margin-top: 0.25rem;">
                    Bobot kriteria di bawah ini merepresentasikan tingkat prioritas masing-masing kriteria dalam penentuan alternatif bansos. Jumlah total seluruh bobot kriteria wajib bernilai <strong>1.00 (100%)</strong> agar konsisten.
                </p>
            </div>
        </div>

        <!-- Right weight consistency card -->
        @php
            $totalWeight = $kriterias->sum('bobot');
            $isConsistent = abs($totalWeight - 1.0) < 0.0001;
        @endphp
        <div class="card-modern" style="padding: 1.5rem; justify-content: center; align-items: center; text-align: center; background-color: {{ $isConsistent ? 'var(--accent-emerald-light)' : 'var(--accent-red-light)' }}; border-color: {{ $isConsistent ? 'rgba(16, 185, 129, 0.2)' : 'rgba(239, 68, 68, 0.2)' }};">
            <span class="detail-label" style="color: {{ $isConsistent ? 'var(--accent-emerald)' : 'var(--accent-red)' }}; font-weight: 800; font-size: 0.75rem;">Total Nilai Bobot</span>
            <span style="font-size: 2.25rem; font-weight: 800; color: {{ $isConsistent ? 'var(--accent-emerald)' : 'var(--accent-red)' }}; margin: 0.25rem 0;">
                {{ number_format($totalWeight, 2, ',', '.') }}
            </span>
            <span class="badge-modern {{ $isConsistent ? 'badge-emerald' : 'badge-red' }}" style="font-size: 0.7rem; font-weight: 700;">
                <i class="fa-solid {{ $isConsistent ? 'fa-circle-check' : 'fa-triangle-exclamation' }}"></i>
                {{ $isConsistent ? 'Konsisten (100%)' : 'Tidak Konsisten (!= 1.0)' }}
            </span>
        </div>
    </div>

    @if(Auth::user()->role === 'admin')
        <div style="margin-bottom: 1.5rem; display: flex; justify-content: flex-end;">
            <a href="{{ route('kriteria.create') }}" class="btn-modern btn-primary-modern">
                <i class="fa-solid fa-plus"></i> Tambah Kriteria Baru
            </a>
        </div>
    @endif

    <!-- Criteria Table Card -->
    <div class="card-modern">
        <div class="table-responsive">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th style="width: 80px;">Kode</th>
                        <th>Nama Kriteria</th>
                        <th>Jenis/Tipe</th>
                        <th>Bobot (Nilai AHP)</th>
                        <th>Persentase</th>
                        <th>Deskripsi</th>
                        @if(in_array(Auth::user()->role, ['admin', 'petugas']))
                            <th style="text-align: center; width: 180px;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($kriterias as $k)
                        <tr>
                            <td>
                                <span style="font-weight: 800; font-family: monospace; font-size: 1rem; color: var(--accent-blue); background-color: var(--accent-blue-light); padding: 0.25rem 0.5rem; border-radius: 6px;">{{ $k->kode }}</span>
                            </td>
                            <td>
                                <span style="font-weight: 700; color: var(--text-primary);">{{ $k->nama_kriteria }}</span>
                            </td>
                            <td>
                                @if($k->jenis === 'benefit')
                                    <span class="badge-modern badge-emerald">
                                        <i class="fa-solid fa-circle-arrow-up"></i> Benefit (Keuntungan)
                                    </span>
                                @else
                                    <span class="badge-modern badge-red">
                                        <i class="fa-solid fa-circle-arrow-down"></i> Cost (Biaya/Beban)
                                    </span>
                                @endif
                            </td>
                            <td style="font-weight: 800; font-family: monospace; font-size: 1.05rem;">
                                {{ number_format($k->bobot, 4, ',', '.') }}
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.5rem; min-width: 100px;">
                                    <div style="flex: 1; height: 6px; background-color: var(--border-color); border-radius: 9999px; overflow: hidden;">
                                        <div style="width: {{ $k->bobot * 100 }}%; height: 100%; background: linear-gradient(135deg, var(--primary-gradient-start), var(--primary-gradient-end)); border-radius: 9999px;"></div>
                                    </div>
                                    <span style="font-weight: 700; font-size: 0.85rem; font-family: monospace;">{{ number_format($k->bobot * 100, 1, ',', '.') }}%</span>
                                </div>
                            </td>
                            <td>
                                <span style="font-size: 0.85rem; color: var(--text-secondary);" title="{{ $k->deskripsi }}">{{ Str::limit($k->deskripsi, 60) }}</span>
                            </td>
                            @if(in_array(Auth::user()->role, ['admin', 'petugas']))
                                <td style="text-align: center;">
                                    <div style="display: flex; gap: 0.5rem; justify-content: center; align-items: center;">
                                        <a href="{{ route('kriteria.edit', $k->id) }}" class="btn-modern btn-primary-modern btn-sm-modern" style="padding: 0.4rem 0.85rem;" title="Edit Kriteria">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>
                                        @if(Auth::user()->role === 'admin')
                                            <form action="{{ route('kriteria.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kriteria {{ $k->nama_kriteria }}? Tindakan ini dapat merusak perbandingan bobot AHP yang ada.')" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-modern btn-danger-modern btn-sm-modern" title="Hapus Kriteria">
                                                    <i class="fa-solid fa-trash-can"></i> Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fa-solid fa-list-check"></i>
                                    </div>
                                    <h3 class="empty-state-title">Data Kriteria Kosong</h3>
                                    <p class="empty-state-desc">Belum ada kriteria penilaian bantuan sosial yang terdaftar.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Educational Saaty Scale Reference Card -->
    <div class="card-modern" style="margin-top: 2rem; padding: 2rem; border-radius: var(--radius-2xl); border: 1px solid var(--border-color); background: var(--bg-card); box-shadow: var(--shadow-premium-md);">
        <div class="card-header-modern" style="border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; margin-bottom: 1.5rem;">
            <h3 class="card-title-modern" style="font-family: var(--font-heading); font-size: 1.1rem; font-weight: 700; color: var(--text-primary);">
                <i class="fa-solid fa-graduation-cap" style="color: var(--accent-emerald);"></i> Panduan Skala Perbandingan Berpasangan Saaty (AHP)
            </h3>
            <span style="font-size: 0.8rem; color: var(--text-secondary);">Referensi akademis penentuan nilai perbandingan berpasangan kriteria berdasarkan Teori Thomas L. Saaty.</span>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem;">
            <!-- Scale 1 -->
            <div style="background: var(--bg-main); border: 1px solid var(--border-color); padding: 1rem; border-radius: 12px; display: flex; align-items: flex-start; gap: 0.75rem;">
                <span style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 800; color: var(--primary-gradient-start); line-height: 1;">1</span>
                <div>
                    <h5 style="margin: 0; font-size: 0.85rem; font-weight: 700; color: var(--text-primary);">Sama Penting (Equal)</h5>
                    <p style="margin: 0; font-size: 0.75rem; color: var(--text-muted); line-height: 1.3; margin-top: 0.25rem;">Kedua elemen mempunyai pengaruh yang sama besar.</p>
                </div>
            </div>

            <!-- Scale 3 -->
            <div style="background: var(--bg-main); border: 1px solid var(--border-color); padding: 1rem; border-radius: 12px; display: flex; align-items: flex-start; gap: 0.75rem;">
                <span style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 800; color: var(--primary-gradient-start); line-height: 1;">3</span>
                <div>
                    <h5 style="margin: 0; font-size: 0.85rem; font-weight: 700; color: var(--text-primary);">Sedikit Lebih Penting</h5>
                    <p style="margin: 0; font-size: 0.75rem; color: var(--text-muted); line-height: 1.3; margin-top: 0.25rem;">Satu elemen sedikit lebih disukai dibanding elemen lain.</p>
                </div>
            </div>

            <!-- Scale 5 -->
            <div style="background: var(--bg-main); border: 1px solid var(--border-color); padding: 1rem; border-radius: 12px; display: flex; align-items: flex-start; gap: 0.75rem;">
                <span style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 800; color: var(--primary-gradient-start); line-height: 1;">5</span>
                <div>
                    <h5 style="margin: 0; font-size: 0.85rem; font-weight: 700; color: var(--text-primary);">Lebih Penting (Strong)</h5>
                    <p style="margin: 0; font-size: 0.75rem; color: var(--text-muted); line-height: 1.3; margin-top: 0.25rem;">Satu elemen sangat disukai dan didukung secara kuat.</p>
                </div>
            </div>

            <!-- Scale 7 -->
            <div style="background: var(--bg-main); border: 1px solid var(--border-color); padding: 1rem; border-radius: 12px; display: flex; align-items: flex-start; gap: 0.75rem;">
                <span style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 800; color: var(--primary-gradient-start); line-height: 1;">7</span>
                <div>
                    <h5 style="margin: 0; font-size: 0.85rem; font-weight: 700; color: var(--text-primary);">Sangat Jelas Lebih Penting</h5>
                    <p style="margin: 0; font-size: 0.75rem; color: var(--text-muted); line-height: 1.3; margin-top: 0.25rem;">Satu elemen terbukti sangat dominan secara objektif.</p>
                </div>
            </div>

            <!-- Scale 9 -->
            <div style="background: var(--bg-main); border: 1px solid var(--border-color); padding: 1rem; border-radius: 12px; display: flex; align-items: flex-start; gap: 0.75rem;">
                <span style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 800; color: var(--primary-gradient-start); line-height: 1;">9</span>
                <div>
                    <h5 style="margin: 0; font-size: 0.85rem; font-weight: 700; color: var(--text-primary);">Mutlak Lebih Penting</h5>
                    <p style="margin: 0; font-size: 0.75rem; color: var(--text-muted); line-height: 1.3; margin-top: 0.25rem;">Perbedaan mutlak yang tidak dapat diragukan lagi.</p>
                </div>
            </div>

            <!-- Scale Even -->
            <div style="background: var(--bg-main); border: 1px solid var(--border-color); padding: 1rem; border-radius: 12px; display: flex; align-items: flex-start; gap: 0.75rem;">
                <span style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 800; color: var(--accent-emerald); line-height: 1;">2,4,6,8</span>
                <div>
                    <h5 style="margin: 0; font-size: 0.85rem; font-weight: 700; color: var(--text-primary);">Nilai Pertengahan</h5>
                    <p style="margin: 0; font-size: 0.75rem; color: var(--text-muted); line-height: 1.3; margin-top: 0.25rem;">Diambil jika berada di antara dua pertimbangan yang berdekatan.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
