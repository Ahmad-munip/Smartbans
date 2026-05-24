@extends('layouts.app')

@section('title', 'Tambah Warga Baru')
@section('page_title', 'Tambah Profil Warga Baru')

@section('content')
    <div style="margin-bottom: 1.5rem;">
        <a href="{{ route('warga.index') }}" class="btn-modern btn-secondary-modern">
            <i class="fa-solid fa-arrow-left-long"></i> Kembali ke Daftar
        </a>
    </div>

    <!-- Create Warga Form Card -->
    <div class="card-modern">
        <div class="card-header-modern" style="border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; margin-bottom: 2rem;">
            <h3 class="card-title-modern">
                <i class="fa-solid fa-user-plus" style="color: var(--accent-emerald);"></i> Formulir Registrasi Profil Warga
            </h3>
            <span style="font-size: 0.8rem; color: var(--text-secondary);">Isi data warga secara valid sesuai KTP dan KK.</span>
        </div>

        <form action="{{ route('warga.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Section 1: Data Identitas -->
            <h4 style="font-size: 1rem; font-weight: 700; color: var(--accent-blue); margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.35rem;">
                <i class="fa-solid fa-id-card"></i> 1. Identitas Kependudukan
            </h4>
            
            <div class="form-row-modern">
                <div class="form-group-modern">
                    <label for="nik" class="form-label-modern">Nomor Induk Kependudukan (NIK) <span style="color: var(--accent-red);">*</span></label>
                    <input type="text" name="nik" id="nik" class="form-input-modern @error('nik') is-invalid @enderror" placeholder="16 digit angka kartu penduduk" value="{{ old('nik') }}" required maxlength="16" minlength="16">
                    @error('nik')
                        <span class="invalid-feedback-modern">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group-modern">
                    <label for="nama_lengkap" class="form-label-modern">Nama Lengkap Sesuai KTP <span style="color: var(--accent-red);">*</span></label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-input-modern" placeholder="Nama lengkap warga" value="{{ old('nama_lengkap') }}" required>
                    @error('nama_lengkap')
                        <span class="invalid-feedback-modern">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row-modern">
                <div class="form-group-modern">
                    <label for="desa" class="form-label-modern">Desa / Kelurahan <span style="color: var(--accent-red);">*</span></label>
                    <select name="desa" id="desa" class="form-select-modern" required>
                        <option value="">-- Pilih Desa --</option>
                        <option value="Mekarsari" {{ old('desa') == 'Mekarsari' ? 'selected' : '' }}>Mekarsari</option>
                        <option value="Sukahening" {{ old('desa') == 'Sukahening' ? 'selected' : '' }}>Sukahening</option>
                    </select>
                    @error('desa')
                        <span class="invalid-feedback-modern">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group-modern">
                    <label for="no_hp" class="form-label-modern">Nomor Handphone (Aktif/WhatsApp)</label>
                    <input type="text" name="no_hp" id="no_hp" class="form-input-modern" placeholder="Contoh: 08123456789" value="{{ old('no_hp') }}">
                    @error('no_hp')
                        <span class="invalid-feedback-modern">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group-modern">
                <label for="alamat" class="form-label-modern">Alamat Lengkap Domisili <span style="color: var(--accent-red);">*</span></label>
                <textarea name="alamat" id="alamat" class="form-input-modern" placeholder="Nama jalan, gang, nomor rumah" style="min-height: 80px; resize: vertical;" required>{{ old('alamat') }}</textarea>
                @error('alamat')
                    <span class="invalid-feedback-modern">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row-modern" style="grid-template-columns: 1fr 1fr; margin-bottom: 2rem;">
                <div class="form-group-modern">
                    <label for="rt" class="form-label-modern">RT <span style="color: var(--accent-red);">*</span></label>
                    <input type="text" name="rt" id="rt" class="form-input-modern" placeholder="Contoh: 003" value="{{ old('rt') }}" required maxlength="3">
                    @error('rt')
                        <span class="invalid-feedback-modern">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group-modern">
                    <label for="rw" class="form-label-modern">RW <span style="color: var(--accent-red);">*</span></label>
                    <input type="text" name="rw" id="rw" class="form-input-modern" placeholder="Contoh: 004" value="{{ old('rw') }}" required maxlength="3">
                    @error('rw')
                        <span class="invalid-feedback-modern">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Section 2: Data Sosial & Ekonomi -->
            <h4 style="font-size: 1rem; font-weight: 700; color: var(--accent-blue); margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.35rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem;">
                <i class="fa-solid fa-wallet"></i> 2. Kondisi Sosial & Ekonomi (Kriteria SPK)
            </h4>

            <div class="form-row-modern">
                <div class="form-group-modern">
                    <label for="pekerjaan" class="form-label-modern">Pekerjaan Utama Kepala Keluarga <span style="color: var(--accent-red);">*</span></label>
                    <select name="pekerjaan" id="pekerjaan" class="form-select-modern" required>
                        <option value="">-- Pilih Kategori Pekerjaan --</option>
                        <option value="Tidak Bekerja / Pengangguran" {{ old('pekerjaan') == 'Tidak Bekerja / Pengangguran' ? 'selected' : '' }}>Tidak Bekerja / Pengangguran</option>
                        <option value="Buruh Harian Lepas" {{ old('pekerjaan') == 'Buruh Harian Lepas' ? 'selected' : '' }}>Buruh Harian Lepas</option>
                        <option value="Petani Kecil / Nelayan Kecil" {{ old('pekerjaan') == 'Petani Kecil / Nelayan Kecil' ? 'selected' : '' }}>Petani Kecil / Nelayan Kecil</option>
                        <option value="Karyawan Swasta Tidak Tetap / Wiraswasta Mikro" {{ old('pekerjaan') == 'Karyawan Swasta Tidak Tetap / Wiraswasta Mikro' ? 'selected' : '' }}>Karyawan Swasta Tidak Tetap / Wiraswasta Mikro</option>
                        <option value="PNS / Karyawan BUMN / Karyawan Tetap Swasta" {{ old('pekerjaan') == 'PNS / Karyawan BUMN / Karyawan Tetap Swasta' ? 'selected' : '' }}>PNS / Karyawan BUMN / Karyawan Tetap Swasta</option>
                    </select>
                    @error('pekerjaan')
                        <span class="invalid-feedback-modern">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group-modern">
                    <label for="penghasilan" class="form-label-modern">Penghasilan Bulanan (Rupiah) <span style="color: var(--accent-red);">*</span></label>
                    <input type="number" name="penghasilan" id="penghasilan" class="form-input-modern" placeholder="Contoh: 1500000" value="{{ old('penghasilan') }}" required min="0">
                    @error('penghasilan')
                        <span class="invalid-feedback-modern">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row-modern">
                <div class="form-group-modern">
                    <label for="jumlah_tanggungan" class="form-label-modern">Jumlah Tanggungan Keluarga (Jiwa) <span style="color: var(--accent-red);">*</span></label>
                    <input type="number" name="jumlah_tanggungan" id="jumlah_tanggungan" class="form-input-modern" placeholder="Jumlah anak/tanggungan serumah" value="{{ old('jumlah_tanggungan') }}" required min="0">
                    @error('jumlah_tanggungan')
                        <span class="invalid-feedback-modern">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group-modern">
                    <label for="kondisi_rumah" class="form-label-modern">Kondisi Fisik Tempat Tinggal <span style="color: var(--accent-red);">*</span></label>
                    <select name="kondisi_rumah" id="kondisi_rumah" class="form-select-modern" required>
                        <option value="">-- Pilih Kondisi Rumah --</option>
                        <option value="Sangat Buruk (Lantai tanah, dinding bambu, reyot)" {{ old('kondisi_rumah') == 'Sangat Buruk (Lantai tanah, dinding bambu, reyot)' ? 'selected' : '' }}>Sangat Buruk (Lantai tanah, dinding bambu, reyot)</option>
                        <option value="Buruk (Dinding kayu/bata tanpa plester, atap bocor)" {{ old('kondisi_rumah') == 'Buruk (Dinding kayu/bata tanpa plester, atap bocor)' ? 'selected' : '' }}>Buruk (Dinding kayu/bata tanpa plester, atap bocor)</option>
                        <option value="Cukup (Dinding bata permanen sederhana, semi permanen)" {{ old('kondisi_rumah') == 'Cukup (Dinding bata permanen sederhana, semi permanen)' ? 'selected' : '' }}>Cukup (Dinding bata permanen sederhana, semi permanen)</option>
                        <option value="Baik (Rumah permanen, bersih, lantai keramik)" {{ old('kondisi_rumah') == 'Baik (Rumah permanen, bersih, lantai keramik)' ? 'selected' : '' }}>Baik (Rumah permanen, bersih, lantai keramik)</option>
                        <option value="Sangat Baik (Rumah mewah/besar, bertingkat)" {{ old('kondisi_rumah') == 'Sangat Baik (Rumah mewah/besar, bertingkat)' ? 'selected' : '' }}>Sangat Baik (Rumah mewah/besar, bertingkat)</option>
                    </select>
                    @error('kondisi_rumah')
                        <span class="invalid-feedback-modern">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row-modern" style="margin-bottom: 2rem;">
                <div class="form-group-modern">
                    <label for="kepemilikan_aset" class="form-label-modern">Kepemilikan Aset Keluarga <span style="color: var(--accent-red);">*</span></label>
                    <select name="kepemilikan_aset" id="kepemilikan_aset" class="form-select-modern" required>
                        <option value="">-- Pilih Kepemilikan Aset --</option>
                        <option value="Tidak Memiliki Aset Apapun" {{ old('kepemilikan_aset') == 'Tidak Memiliki Aset Apapun' ? 'selected' : '' }}>Tidak Memiliki Aset Apapun</option>
                        <option value="Memiliki Aset Kecil (Elektronik murah, sepeda)" {{ old('kepemilikan_aset') == 'Memiliki Aset Kecil (Elektronik murah, sepeda)' ? 'selected' : '' }}>Memiliki Aset Kecil (Elektronik murah, sepeda)</option>
                        <option value="Memiliki Motor (1 unit kendaraan roda dua)" {{ old('kepemilikan_aset') == 'Memiliki Motor (1 unit kendaraan roda dua)' ? 'selected' : '' }}>Memiliki Motor (1 unit kendaraan roda dua)</option>
                        <option value="Memiliki Mobil / Tanah (Aset produktif/bernilai tinggi)" {{ old('kepemipilkan_aset') == 'Memiliki Mobil / Tanah (Aset produktif/bernilai tinggi)' ? 'selected' : '' }}>Memiliki Mobil / Tanah (Aset produktif/bernilai tinggi)</option>
                        <option value="Memiliki Banyak Aset Mewah" {{ old('kepemilikan_aset') == 'Memiliki Banyak Aset Mewah' ? 'selected' : '' }}>Memiliki Banyak Aset Mewah</option>
                    </select>
                    @error('kepemilikan_aset')
                        <span class="invalid-feedback-modern">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group-modern">
                    <label for="status_bantuan_sebelumnya" class="form-label-modern">Status Penerimaan Bantuan Sebelumnya <span style="color: var(--accent-red);">*</span></label>
                    <select name="status_bantuan_sebelumnya" id="status_bantuan_sebelumnya" class="form-select-modern" required>
                        <option value="">-- Pilih Status Bantuan --</option>
                        <option value="Belum Pernah" {{ old('status_bantuan_sebelumnya') == 'Belum Pernah' ? 'selected' : '' }}>Belum Pernah</option>
                        <option value="Pernah (Selesai)" {{ old('status_bantuan_sebelumnya') == 'Pernah (Selesai)' ? 'selected' : '' }}>Pernah (Selesai)</option>
                        <option value="Pernah (Aktif)" {{ old('status_bantuan_sebelumnya') == 'Pernah (Aktif)' ? 'selected' : '' }}>Pernah (Aktif)</option>
                    </select>
                    @error('status_bantuan_sebelumnya')
                        <span class="invalid-feedback-modern">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Section 3: Upload Berkas -->
            <h4 style="font-size: 1rem; font-weight: 700; color: var(--accent-blue); margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.35rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem;">
                <i class="fa-solid fa-cloud-arrow-up"></i> 3. Lampiran Gambar Pendukung (KTP & KK)
            </h4>

            <div class="form-row-modern" style="margin-bottom: 3rem;">
                <div class="form-group-modern">
                    <label for="foto_ktp" class="form-label-modern">Foto Kartu Tanda Penduduk (KTP)</label>
                    <input type="file" name="foto_ktp" id="foto_ktp" class="form-input-modern" style="padding: 0.55rem;" accept="image/*">
                    <span style="font-size: 0.75rem; color: var(--text-secondary);">* Ukuran maksimal file 2MB (format JPG/PNG).</span>
                    @error('foto_ktp')
                        <span class="invalid-feedback-modern">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group-modern">
                    <label for="foto_kk" class="form-label-modern">Foto Kartu Keluarga (KK)</label>
                    <input type="file" name="foto_kk" id="foto_kk" class="form-input-modern" style="padding: 0.55rem;" accept="image/*">
                    <span style="font-size: 0.75rem; color: var(--text-secondary);">* Ukuran maksimal file 2MB (format JPG/PNG).</span>
                    @error('foto_kk')
                        <span class="invalid-feedback-modern">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Buttons bar -->
            <div style="display: flex; gap: 1rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem; justify-content: flex-end;">
                <a href="{{ route('warga.index') }}" class="btn-modern btn-secondary-modern">
                    Batal
                </a>
                <button type="submit" class="btn-modern btn-primary-modern">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Data Warga
                </button>
            </div>

        </form>
    </div>
@endsection
