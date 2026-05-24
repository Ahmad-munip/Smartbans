@extends('layouts.print')

@section('title', 'Laporan Data Warga')

@section('content')
    <div class="report-title-container">
        <h1 class="report-title">Laporan Data Warga Ringinarum</h1>
        <p class="report-meta">
            Wilayah: {{ $desa ?: 'Seluruh Desa di Kecamatan Ringinarum' }} &middot; 
            Dicetak oleh: {{ Auth::user()->name }} &middot; 
            Tanggal: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}
        </p>
    </div>

    <table class="print-table">
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th style="width: 130px;">NIK</th>
                <th>Nama Lengkap</th>
                <th>Pekerjaan</th>
                <th style="width: 100px;">Penghasilan</th>
                <th style="width: 40px;">Tang.</th>
                <th>Kondisi Rumah</th>
                <th>Desa</th>
                <th style="width: 50px;">RT/RW</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $w)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center" style="font-family: monospace;">{{ $w->nik }}</td>
                    <td style="font-weight: bold;">{{ $w->nama_lengkap }}</td>
                    <td>{{ $w->pekerjaan }}</td>
                    <td class="text-right">Rp {{ number_format($w->penghasilan, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $w->jumlah_tanggungan }}</td>
                    <td>{{ Str::limit($w->kondisi_rumah, 45) }}</td>
                    <td class="text-center">{{ $w->desa }}</td>
                    <td class="text-center">{{ $w->rt }}/{{ $w->rw }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Tidak ada data warga ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
