@extends('layouts.app')

@section('title', 'Ubah Skala Penilaian')
@section('page_title', 'Ubah Skala Penilaian')

@section('content')
    <div style="margin-bottom: 1.5rem;">
        <a href="{{ route('sub-kriteria.index') }}" class="btn-modern btn-secondary-modern">
            <i class="fa-solid fa-arrow-left-long"></i> Kembali ke Skala
        </a>
    </div>

    <!-- Edit Subcriteria Card -->
    <div class="card-modern">
        <div class="card-header-modern" style="border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; margin-bottom: 2rem;">
            <h3 class="card-title-modern">
                <i class="fa-solid fa-pen-to-square" style="color: var(--accent-blue);"></i> Formulir Pembaruan Skala Penilaian
            </h3>
            <span style="font-size: 0.8rem; color: var(--text-secondary);">Perbarui informasi skala atau nilai konversi skor numerik untuk evaluasi.</span>
        </div>

        <form action="{{ route('sub-kriteria.update', $subKriterium->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group-modern">
                <label for="kriteria_id" class="form-label-modern">Kriteria Induk <span style="color: var(--accent-red);">*</span></label>
                <select name="kriteria_id" id="kriteria_id" class="form-select-modern" required>
                    <option value="">-- Pilih Kriteria Induk --</option>
                    @foreach($kriterias as $k)
                        <option value="{{ $k->id }}" {{ (old('kriteria_id', $subKriterium->kriteria_id) == $k->id) ? 'selected' : '' }}>
                            {{ $k->kode }} - {{ $k->nama_kriteria }} ({{ ucfirst($k->jenis) }})
                        </option>
                    @endforeach
                </select>
                @error('kriteria_id')
                    <span class="invalid-feedback-modern">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row-modern" style="margin-top: 1.25rem; margin-bottom: 1.5rem;">
                <div class="form-group-modern">
                    <label for="nama_subkriteria" class="form-label-modern">Nama Subkriteria / Deskripsi Skala <span style="color: var(--accent-red);">*</span></label>
                    <input type="text" name="nama_subkriteria" id="nama_subkriteria" class="form-input-modern" placeholder="Contoh: < Rp 1.000.000, Sangat Baik, dsb." value="{{ old('nama_subkriteria', $subKriterium->nama_subkriteria) }}" required>
                    @error('nama_subkriteria')
                        <span class="invalid-feedback-modern">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group-modern">
                    <label for="nilai" class="form-label-modern">Bobot Skor Nilai Numerik (Skala 1 s.d. 5) <span style="color: var(--accent-red);">*</span></label>
                    <input type="number" name="nilai" id="nilai" class="form-input-modern" placeholder="Masukkan angka bulat 1 - 5" value="{{ old('nilai', $subKriterium->nilai) }}" required min="1" max="5">
                    @error('nilai')
                        <span class="invalid-feedback-modern">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group-modern" style="margin-bottom: 2rem;">
                <label for="deskripsi" class="form-label-modern">Deskripsi Tambahan (Opsional)</label>
                <textarea name="deskripsi" id="deskripsi" class="form-input-modern" placeholder="Masukkan keterangan tambahan jika ada..." style="min-height: 80px; resize: vertical;">{{ old('deskripsi', $subKriterium->deskripsi) }}</textarea>
                @error('deskripsi')
                    <span class="invalid-feedback-modern">{{ $message }}</span>
                @enderror
            </div>

            <!-- Buttons bar -->
            <div style="display: flex; gap: 1rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem; justify-content: flex-end;">
                <a href="{{ route('sub-kriteria.index') }}" class="btn-modern btn-secondary-modern">
                    Batal
                </a>
                <button type="submit" class="btn-modern btn-primary-modern">
                    <i class="fa-solid fa-floppy-disk"></i> Perbarui Skala Nilai
                </button>
            </div>

        </form>
    </div>
@endsection
