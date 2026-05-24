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
            background-color: #047857; /* Emerald theme for selected winners */
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
        .preferensi-format {
            mso-number-format:"0\.00000";
            text-align: center;
            font-weight: bold;
            color: #047857;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td colspan="8" class="title">PEMERINTAH KABUPATEN KENDAL</td>
        </tr>
        <tr>
            <td colspan="8" class="title">KECAMATAN RINGINARUM</td>
        </tr>
        <tr>
            <td colspan="8" class="title">DAFTAR PENERIMA REKOMENDASI BANTUAN SOSIAL (AHP-TOPSIS)</td>
        </tr>
        <tr>
            <td colspan="8" class="subtitle">
                Kriteria: Layak Menerima &middot; Wilayah: {{ $desa ?: 'Semua Desa' }} &middot; Tanggal Ekspor: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}
            </td>
        </tr>
        <tr>
            <td colspan="8"></td>
        </tr>
        <thead>
            <tr>
                <th class="header" style="width: 80px;">No (Rank)</th>
                <th class="header" style="width: 150px;">NIK</th>
                <th class="header" style="width: 200px;">Nama Penerima</th>
                <th class="header" style="width: 250px;">Alamat Lengkap</th>
                <th class="header" style="width: 120px;">Desa</th>
                <th class="header" style="width: 60px;">RT/RW</th>
                <th class="header" style="width: 130px;">Preferensi (V)</th>
                <th class="header" style="width: 150px;">Status Verifikasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $p)
                <tr>
                    <td class="data text-center" style="font-weight: bold;">{{ $index + 1 }}</td>
                    <td class="data nik-text">{{ $p->warga->nik }}</td>
                    <td class="data" style="font-weight: bold; color: #047857;">{{ $p->warga->nama_lengkap }}</td>
                    <td class="data">{{ $p->warga->alamat }}</td>
                    <td class="data text-center">{{ $p->warga->desa }}</td>
                    <td class="data text-center">{{ $p->warga->rt }}/{{ $p->warga->rw }}</td>
                    <td class="data preferensi-format">{{ $p->preferensi }}</td>
                    <td class="data text-center" style="font-weight: bold; color: #1e3a8a; background-color: #eff6ff;">
                        TERVERIFIKASI SISTEM
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
