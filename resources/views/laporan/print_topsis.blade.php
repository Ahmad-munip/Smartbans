@extends('layouts.print')

@section('title', 'Laporan Hasil Perhitungan TOPSIS')

@section('content')
    <div class="report-title-container">
        <h1 class="report-title">Laporan Hasil Perhitungan & Ranking TOPSIS</h1>
        <p class="report-meta">
            Metode: Technique for Order of Preference by Similarity to Ideal Solution (TOPSIS) &middot; 
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
                <th>Desa</th>
                <th style="width: 50px;">RT/RW</th>
                <th style="width: 100px;">D+ (Ideal Positif)</th>
                <th style="width: 100px;">D- (Ideal Negatif)</th>
                <th style="width: 110px;">Preferensi (V)</th>
                <th style="width: 100px;">Kelayakan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $t)
                <tr style="{{ $t->status === 'layak' ? 'background-color: #f8fafc;' : '' }}">
                    <td class="text-center" style="font-weight: bold;">{{ $t->ranking }}</td>
                    <td class="text-center" style="font-family: monospace;">{{ $t->warga->nik }}</td>
                    <td style="font-weight: bold;">{{ $t->warga->nama_lengkap }}</td>
                    <td class="text-center">{{ $t->warga->desa }}</td>
                    <td class="text-center">{{ $t->warga->rt }}/{{ $t->warga->rw }}</td>
                    <td class="text-center" style="font-family: monospace;">{{ number_format($t->d_pos, 4) }}</td>
                    <td class="text-center" style="font-family: monospace;">{{ number_format($t->d_neg, 4) }}</td>
                    <td class="text-center" style="font-weight: bold; font-family: monospace; font-size: 11pt;">{{ number_format($t->preferensi, 5) }}</td>
                    <td class="text-center">
                        @if($t->status === 'layak')
                            <span class="badge-print" style="border-color: #000; background-color: #e6f4ea;">LAYAK</span>
                        @else
                            <span class="badge-print" style="border-color: #000; background-color: #fce8e6;">TIDAK LAYAK</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Tidak ada data hasil TOPSIS ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="font-size: 10pt; font-style: italic; margin-top: 20px; border-top: 1px solid #000; padding-top: 10px;">
        * Keterangan: Nilai Preferensi (V) berkisar antara 0 sampai 1. Semakin mendekati nilai 1, warga tersebut memiliki tingkat prioritas kelayakan yang semakin tinggi untuk menerima bantuan sosial berdasarkan kriteria-kriteria yang ditetapkan. Status kelayakan diperoleh dari kuota atau batas ambang (threshold) nilai preferensi yang berlaku.
    </div>
@endsection
