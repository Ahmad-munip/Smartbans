@extends('layouts.app')

@section('title', 'Skala Penilaian')
@section('page_title', 'Master Skala Penilaian (Subkriteria)')

@section('content')
    <!-- Header info panel -->
    <div class="card-modern" style="padding: 1.5rem; flex-direction: row; align-items: center; gap: 1.25rem; margin-bottom: 2rem;">
        <div class="stat-icon-wrapper icon-yellow" style="width: 56px; height: 56px; border-radius: var(--radius-xl); font-size: 1.5rem; flex-shrink: 0;">
            <i class="fa-solid fa-sliders"></i>
        </div>
        <div>
            <h4 style="font-weight: 700; font-size: 1rem; color: var(--text-primary);">Skala Penilaian & Subkriteria</h4>
            <p style="font-size: 0.8rem; color: var(--text-secondary); line-height: 1.4; margin-top: 0.25rem;">
                Setiap kriteria memiliki skala penilaian kualitatif maupun kuantitatif yang dikonversi menjadi bobot nilai numerik (skala 1 s.d. 5). Nilai skala ini akan digunakan secara otomatis dalam perhitungan matriks keputusan TOPSIS.
            </p>
        </div>
    </div>

    <!-- Criteria and Subcriteria List Grid -->
    <div style="display: flex; flex-direction: column; gap: 2rem;">
        @foreach($kriterias as $k)
            <div class="card-modern" style="padding: 0; overflow: hidden; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
                <!-- Section Header -->
                <div style="background-color: var(--bg-main); padding: 1.25rem 1.75rem; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <span style="font-weight: 800; font-family: monospace; font-size: 1rem; color: var(--accent-blue); background-color: var(--accent-blue-light); padding: 0.35rem 0.65rem; border-radius: 8px;">
                            {{ $k->kode }}
                        </span>
                        <div>
                            <h3 style="font-size: 1.1rem; font-weight: 800; color: var(--text-primary);">{{ $k->nama_kriteria }}</h3>
                            <span style="font-size: 0.75rem; color: var(--text-secondary);">Jenis: {{ ucfirst($k->jenis) }} • Bobot AHP: {{ number_format($k->bobot, 4) }}</span>
                        </div>
                    </div>

                    @if(in_array(Auth::user()->role, ['admin', 'petugas']))
                        <a href="{{ route('sub-kriteria.create', ['kriteria_id' => $k->id]) }}" class="btn-modern btn-primary-modern btn-sm-modern" style="padding: 0.5rem 1rem;">
                            <i class="fa-solid fa-plus-circle"></i> Tambah Skala
                        </a>
                    @endif
                </div>

                <!-- Section Body (Subkriteria Table/List) -->
                <div style="padding: 1.25rem 1.75rem;">
                    @if($k->subKriterias->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table-modern" style="border: none;">
                                <thead>
                                    <tr>
                                        <th style="background-color: transparent; border-bottom: 1px solid var(--border-color); padding: 0.75rem 0.5rem; width: 60%;">Deskripsi / Skala Kategori</th>
                                        <th style="background-color: transparent; border-bottom: 1px solid var(--border-color); padding: 0.75rem 0.5rem; text-align: center; width: 20%;">Nilai Skor</th>
                                        @if(in_array(Auth::user()->role, ['admin', 'petugas']))
                                            <th style="background-color: transparent; border-bottom: 1px solid var(--border-color); padding: 0.75rem 0.5rem; text-align: center; width: 20%;">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($k->subKriterias as $sub)
                                        <tr>
                                            <td style="border-bottom: 1px solid rgba(0,0,0,0.05); padding: 0.85rem 0.5rem; font-weight: 600; color: var(--text-primary);">
                                                {{ $sub->nama_subkriteria }}
                                            </td>
                                            <td style="border-bottom: 1px solid rgba(0,0,0,0.05); padding: 0.85rem 0.5rem; text-align: center;">
                                                <span class="badge-modern {{ $sub->nilai >= 4 ? 'badge-emerald' : ($sub->nilai >= 3 ? 'badge-blue' : 'badge-yellow') }}" style="font-size: 0.85rem; font-weight: 800; font-family: monospace; padding: 0.3rem 0.75rem; border-radius: 8px;">
                                                    Skor: {{ $sub->nilai }}
                                                </span>
                                            </td>
                                            @if(in_array(Auth::user()->role, ['admin', 'petugas']))
                                                <td style="border-bottom: 1px solid rgba(0,0,0,0.05); padding: 0.85rem 0.5rem; text-align: center;">
                                                    <div style="display: flex; gap: 0.5rem; justify-content: center; align-items: center;">
                                                        <a href="{{ route('sub-kriteria.edit', $sub->id) }}" class="btn-modern btn-secondary-modern btn-sm-modern" style="padding: 0.35rem 0.75rem;" title="Edit Skala">
                                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                                        </a>
                                                        <form action="{{ route('sub-kriteria.destroy', $sub->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus skala penilaian ini?')" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn-modern btn-danger-modern btn-sm-modern" style="padding: 0.35rem 0.75rem;" title="Hapus Skala">
                                                                <i class="fa-solid fa-trash-can"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state" style="padding: 2rem 0;">
                            <div class="empty-state-icon" style="width: 48px; height: 48px; font-size: 1.1rem;">
                                <i class="fa-solid fa-sliders"></i>
                            </div>
                            <h4 class="empty-state-title" style="font-size: 0.9rem;">Belum Ada Skala</h4>
                            <p class="empty-state-desc" style="font-size: 0.8rem; max-width: 300px;">Konfigurasikan skala nilai numerik minimal 1 skala agar dapat dievaluasi.</p>
                            @if(in_array(Auth::user()->role, ['admin', 'petugas']))
                                <a href="{{ route('sub-kriteria.create', ['kriteria_id' => $k->id]) }}" class="btn-modern btn-primary-modern btn-sm-modern">
                                    <i class="fa-solid fa-plus"></i> Tambah Skala
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
