@extends('layouts.print')

@section('title', 'Laporan Penerima Bantuan Layak')

@section('content')
    <div class="report-title-container">
        <h1 class="report-title">Laporan Daftar Penerima Bantuan Sosial</h1>
        <p class="report-meta">
            Kriteria Kelayakan: Layak Terpilih (Hasil Kombinasi AHP-TOPSIS) &middot; 
            Wilayah: {{ $desa ?: 'Seluruh Desa di Kecamatan Ringinarum' }} &middot; 
            Tanggal: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}
        </p>
    </div>

    <table class="print-table">
        <thead>
            <tr>
                <th style="width: 50px;">Rank</th>
                <th style="width: 120px;">NIK</th>
                <th>Nama Lengkap</th>
                <th>Alamat Lengkap</th>
                <th>Desa</th>
                <th style="width: 50px;">RT/RW</th>
                <th style="width: 120px;">Nilai Preferensi (V)</th>
                <th style="width: 130px;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $p)
                <tr>
                    <td class="text-center" style="font-weight: bold;">{{ $index + 1 }}</td>
                    <td class="text-center" style="font-family: monospace;">{{ $p->warga->nik }}</td>
                    <td style="font-weight: bold;">{{ $p->warga->nama_lengkap }}</td>
                    <td>{{ $p->warga->alamat }}</td>
                    <td class="text-center">{{ $p->warga->desa }}</td>
                    <td class="text-center">{{ $p->warga->rt }}/{{ $p->warga->rw }}</td>
                    <td class="text-center" style="font-weight: bold; font-family: monospace; font-size: 11pt;">{{ number_format($p->preferensi, 5) }}</td>
                    <td class="text-center" style="font-weight: bold; font-size: 9pt; background-color: #f0fdf4; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
                        LAYAK MENERIMA
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada warga penerima bantuan dengan status Layak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="font-size: 10pt; margin-top: 30px;">
        Dokumen ini merupakan hasil rekomendasi resmi dari sistem pendukung keputusan <strong>BanSmart</strong> Kecamatan Ringinarum berbasis integrasi pembobotan <strong>AHP</strong> dan pemeringkatan <strong>TOPSIS</strong>. Warga yang terdaftar di atas dinyatakan layak mendapatkan prioritas bantuan sosial sesuai validasi data kependudukan dan indikator ekonomi yang berlaku.
    </div>
@endsection
