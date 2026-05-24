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
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .nik-text {
            mso-number-format:"\@"; /* Keep leading zero for NIK */
            text-align: center;
        }
        .decimal-format {
            mso-number-format:"0\.0000";
            text-align: center;
        }
        .preferensi-format {
            mso-number-format:"0\.00000";
            text-align: center;
            font-weight: bold;
            color: #1e3a8a;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td colspan="9" class="title">PEMERINTAH KABUPATEN KENDAL</td>
        </tr>
        <tr>
            <td colspan="9" class="title">KECAMATAN RINGINARUM</td>
        </tr>
        <tr>
            <td colspan="9" class="title">LAPORAN HASIL PERHITUNGAN & RANKING TOPSIS</td>
        </tr>
        <tr>
            <td colspan="9" class="subtitle">
                Wilayah: {{ $desa ?: 'Semua Desa' }} &middot; Tanggal Ekspor: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}
            </td>
        </tr>
        <tr>
            <td colspan="9"></td>
        </tr>
        <thead>
            <tr>
                <th class="header" style="width: 60px;">No (Rank)</th>
                <th class="header" style="width: 150px;">NIK</th>
                <th class="header" style="width: 200px;">Nama Lengkap</th>
                <th class="header" style="width: 120px;">Desa</th>
                <th class="header" style="width: 60px;">RT/RW</th>
                <th class="header" style="width: 120px;">D+ (Ideal Positif)</th>
                <th class="header" style="width: 120px;">D- (Ideal Negatif)</th>
                <th class="header" style="width: 130px;">Preferensi (V)</th>
                <th class="header" style="width: 120px;">Status Kelayakan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $t)
                <tr>
                    <td class="data text-center" style="font-weight: bold;">{{ $t->ranking }}</td>
                    <td class="data nik-text">{{ $t->warga->nik }}</td>
                    <td class="data" style="font-weight: bold;">{{ $t->warga->nama_lengkap }}</td>
                    <td class="data text-center">{{ $t->warga->desa }}</td>
                    <td class="data text-center">{{ $t->warga->rt }}/{{ $t->warga->rw }}</td>
                    <td class="data decimal-format">{{ $t->d_pos }}</td>
                    <td class="data decimal-format">{{ $t->d_neg }}</td>
                    <td class="data preferensi-format">{{ $t->preferensi }}</td>
                    <td class="data text-center" style="font-weight: bold; background-color: {{ $t->status === 'layak' ? '#e6f4ea' : '#fce8e6' }};">
                        {{ strtoupper($t->status) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
