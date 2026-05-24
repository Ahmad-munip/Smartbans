<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        .title {
            font-family: 'Arial';
            font-size: 14pt;
            font-weight: bold;
            text-align: center;
        }
        .subtitle {
            font-family: 'Arial';
            font-size: 10pt;
            font-style: italic;
            text-align: center;
        }
        .header {
            background-color: #1e3a8a;
            color: #ffffff;
            font-family: 'Arial';
            font-size: 10pt;
            font-weight: bold;
            border: 0.5pt solid #000000;
            text-align: center;
        }
        .data {
            font-family: 'Arial';
            font-size: 10pt;
            border: 0.5pt solid #000000;
        }
        .summary-box {
            font-family: 'Arial';
            font-size: 10pt;
            border: 1pt solid #000000;
            background-color: #f3f4f6;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .number-format {
            mso-number-format:"0\.0000";
            text-align: center;
        }
        .percentage-format {
            mso-number-format:"0\.00%";
            text-align: center;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td colspan="6" class="title">PEMERINTAH KABUPATEN KENDAL</td>
        </tr>
        <tr>
            <td colspan="6" class="title">KECAMATAN RINGINARUM</td>
        </tr>
        <tr>
            <td colspan="6" class="title">LAPORAN DATA KRITERIA & BOBOT PRIORITAS AHP</td>
        </tr>
        <tr>
            <td colspan="6" class="subtitle">
                Metode: Analytical Hierarchy Process (AHP) &middot; Tanggal Ekspor: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}
            </td>
        </tr>
        <tr>
            <td colspan="6"></td>
        </tr>

        @if($ahpSummary)
            <tr>
                <td colspan="6" class="summary-box" style="font-weight: bold; text-align: left;">RINGKASAN VALIDITAS MATRIKS AHP</td>
            </tr>
            <tr>
                <td class="data" style="font-weight: bold;">Lambda Max (&lambda;max)</td>
                <td class="data number-format" style="text-align: left;">{{ $ahpSummary->lambda_max }}</td>
                <td class="data" style="font-weight: bold;">Consistency Index (CI)</td>
                <td class="data number-format" style="text-align: left;" colspan="3">{{ $ahpSummary->consistency_index }}</td>
            </tr>
            <tr>
                <td class="data" style="font-weight: bold;">Consistency Ratio (CR)</td>
                <td class="data number-format" style="text-align: left; font-weight: bold; color: #1e3a8a;">{{ $ahpSummary->consistency_ratio }}</td>
                <td class="data" style="font-weight: bold;">Status Konsistensi</td>
                <td class="data text-center" style="font-weight: bold; background-color: {{ $ahpSummary->is_consistent ? '#e6f4ea' : '#fce8e6' }};" colspan="3">
                    {{ $ahpSummary->is_consistent ? 'KONSISTEN (<= 0.1)' : 'TIDAK KONSISTEN (> 0.1)' }}
                </td>
            </tr>
            <tr>
                <td colspan="6"></td>
            </tr>
        @endif

        <thead>
            <tr>
                <th class="header" style="width: 40px;">No</th>
                <th class="header" style="width: 100px;">Kode</th>
                <th class="header" style="width: 250px;">Nama Kriteria</th>
                <th class="header" style="width: 120px;">Tipe Kriteria</th>
                <th class="header" style="width: 150px;">Bobot Prioritas</th>
                <th class="header" style="width: 120px;">Persentase</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $k)
                <tr>
                    <td class="data text-center">{{ $index + 1 }}</td>
                    <td class="data text-center" style="font-weight: bold; font-family: monospace;">{{ $k->kode }}</td>
                    <td class="data" style="font-weight: bold;">{{ $k->nama }}</td>
                    <td class="data text-center" style="text-transform: uppercase;">{{ $k->jenis }}</td>
                    <td class="data number-format" style="font-weight: bold;">{{ $k->bobot }}</td>
                    <td class="data percentage-format">{{ $k->bobot }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
