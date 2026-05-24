@extends('layouts.app')

@section('title', 'Tambah Kriteria Baru')
@section('page_title', 'Tambah Kriteria Baru')

@section('content')
    <div style="margin-bottom: 1.5rem;">
        <a href="{{ route('kriteria.index') }}" class="btn-modern btn-secondary-modern">
            <i class="fa-solid fa-arrow-left-long"></i> Kembali ke Daftar
        </a>
    </div>

    <!-- Create Criteria Card -->
    <div class="card-modern">
        <div class="card-header-modern" style="border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; margin-bottom: 2rem;">
            <h3 class="card-title-modern">
                <i class="fa-solid fa-square-plus" style="color: var(--accent-emerald);"></i> Formulir Registrasi Kriteria Baru
            </h3>
            <span style="font-size: 0.8rem; color: var(--text-secondary);">Tambahkan parameter baru sebagai landasan penilaian kelayakan bantuan sosial.</span>
        </div>

        <form action="{{ route('kriteria.store') }}" method="POST">
            @csrf

            <div class="form-row-modern">
                <div class="form-group-modern">
                    <label for="kode" class="form-label-modern">Kode Kriteria <span style="color: var(--accent-red);">*</span></label>
                    <input type="text" name="kode" id="kode" class="form-input-modern" placeholder="Contoh: C6, C7..." value="{{ old('kode') }}" required maxlength="10">
                    @error('kode')
                        <span class="invalid-feedback-modern">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group-modern">
                    <label for="nama_kriteria" class="form-label-modern">Nama Kriteria <span style="color: var(--accent-red);">*</span></label>
                    <input type="text" name="nama_kriteria" id="nama_kriteria" class="form-input-modern" placeholder="Contoh: Kepemilikan Tabungan" value="{{ old('nama_kriteria') }}" required>
                    @error('nama_kriteria')
                        <span class="invalid-feedback-modern">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row-modern" style="margin-bottom: 1.5rem;">
                <div class="form-group-modern">
                    <label for="jenis" class="form-label-modern">Jenis/Tipe Kriteria <span style="color: var(--accent-red);">*</span></label>
                    <select name="jenis" id="jenis" class="form-select-modern" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="benefit" {{ old('jenis') == 'benefit' ? 'selected' : '' }}>Benefit (Keuntungan - Semakin tinggi nilai subkriteria, semakin berhak mendapat bantuan)</option>
                        <option value="cost" {{ old('jenis') == 'cost' ? 'selected' : '' }}>Cost (Biaya - Semakin tinggi nilai subkriteria, semakin TIDAK berhak mendapat bantuan)</option>
                    </select>
                    @error('jenis')
                        <span class="invalid-feedback-modern">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group-modern">
                    <label for="bobot" class="form-label-modern">Bobot Awal Kriteria (Pecahan 0.00 s.d 1.00) <span style="color: var(--accent-red);">*</span></label>
                    <input type="number" step="0.0001" name="bobot" id="bobot" class="form-input-modern" placeholder="Contoh: 0.15" value="{{ old('bobot', 0) }}" required min="0" max="1">
                    <span style="font-size: 0.75rem; color: var(--text-secondary);">* Bobot kriteria yang dimasukkan secara manual ini akan disesuaikan kembali saat proses analisis berpasangan AHP.</span>
                    @error('bobot')
                        <span class="invalid-feedback-modern">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group-modern" style="margin-bottom: 2rem;">
                <label for="deskripsi" class="form-label-modern">Deskripsi / Penjelasan Kriteria</label>
                <textarea name="deskripsi" id="deskripsi" class="form-input-modern" placeholder="Jelaskan maksud dan tujuan kriteria ini..." style="min-height: 100px; resize: vertical;">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <span class="invalid-feedback-modern">{{ $message }}</span>
                @enderror
            </div>

            <!-- Buttons bar -->
            <div style="display: flex; gap: 1rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem; justify-content: flex-end;">
                <a href="{{ route('kriteria.index') }}" class="btn-modern btn-secondary-modern">
                    Batal
                </a>
                <button type="submit" class="btn-modern btn-primary-modern">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Kriteria
                </button>
            </div>

        </form>
    </div>
@endsection
