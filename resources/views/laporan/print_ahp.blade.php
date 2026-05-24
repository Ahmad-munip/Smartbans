@extends('layouts.print')

@section('title', 'Laporan Pembobotan Kriteria AHP')

@section('content')
    <div class="report-title-container">
        <h1 class="report-title">Laporan Pembobotan Kriteria (AHP)</h1>
        <p class="report-meta">
            Metode: Analytical Hierarchy Process (AHP) &middot; 
            Dicetak oleh: {{ Auth::user()->name }} &middot; 
            Tanggal: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}
        </p>
    </div>

    <!-- Overview Box / AHP Consistency Metrics -->
    @if($ahpSummary)
        <div style="border: 1px solid #000; padding: 15px; margin-bottom: 25px; background-color: #f9f9f9; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
            <h3 style="margin-top: 0; margin-bottom: 10px; font-size: 11pt; text-transform: uppercase; font-weight: bold; border-bottom: 1px solid #000; padding-bottom: 5px;">
                Ringkasan Validitas Matriks Perbandingan AHP
            </h3>
            <table style="width: 100%; font-size: 10pt; border-collapse: collapse;">
                <tr>
                    <td style="width: 25%; font-weight: bold; padding: 3px 0;">Lambda Max (&lambda;<sub>max</sub>)</td>
                    <td style="width: 25%; padding: 3px 0;">: {{ number_format($ahpSummary->lambda_max, 4) }}</td>
                    <td style="width: 25%; font-weight: bold; padding: 3px 0;">Consistency Index (CI)</td>
                    <td style="width: 25%; padding: 3px 0;">: {{ number_format($ahpSummary->consistency_index, 4) }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold; padding: 3px 0;">Consistency Ratio (CR)</td>
                    <td style="padding: 3px 0;">: <strong>{{ number_format($ahpSummary->consistency_ratio, 4) }}</strong></td>
                    <td style="font-weight: bold; padding: 3px 0;">Status Konsistensi</td>
                    <td style="padding: 3px 0;">: 
                        @if($ahpSummary->is_consistent)
                            <span class="badge-print" style="border-color: #000; background-color: #e6f4ea;">KONSISTEN (&le; 0.1)</span>
                        @else
                            <span class="badge-print" style="border-color: #000; background-color: #fce8e6;">TIDAK KONSISTEN (> 0.1)</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    @endif

    <h3 style="font-size: 11pt; margin-top: 0; margin-bottom: 10px; text-transform: uppercase;">
        Daftar Kriteria & Bobot Prioritas Hasil Analisis AHP
    </h3>
    <table class="print-table">
        <thead>
            <tr>
                <th style="width: 40px;">No</th>
                <th style="width: 80px;">Kode</th>
                <th>Nama Kriteria</th>
                <th style="width: 120px;">Tipe Kriteria</th>
                <th style="width: 150px;">Bobot Prioritas</th>
                <th>Persentase Kontribusi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $k)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center" style="font-weight: bold; font-family: monospace;">{{ $k->kode }}</td>
                    <td style="font-weight: bold;">{{ $k->nama }}</td>
                    <td class="text-center" style="text-transform: uppercase;">{{ $k->jenis }}</td>
                    <td class="text-center" style="font-weight: bold; font-size: 11pt;">{{ number_format($k->bobot, 4) }}</td>
                    <td class="text-center">{{ number_format($k->bobot * 100, 2) }}%</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data kriteria AHP.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="font-size: 10pt; font-style: italic; margin-top: 20px;">
        * Catatan: Bobot prioritas di atas dihasilkan secara matematis melalui perhitungan eigen vector dari matriks perbandingan berpasangan kriteria menggunakan metode AHP Saaty. Bobot ini digunakan langsung sebagai parameter pembobotan pada metode TOPSIS.
    </div>
@endsection
