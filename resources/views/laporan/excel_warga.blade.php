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
            mso-number-format:"\@"; /* Force text mode in Excel to keep NIK zero leading digits */
            text-align: center;
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
            <td colspan="9" class="title">LAPORAN DATA WARGA BANSOS BANSMART</td>
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
                <th class="header" style="width: 40px;">No</th>
                <th class="header" style="width: 150px;">NIK</th>
                <th class="header" style="width: 200px;">Nama Lengkap</th>
                <th class="header" style="width: 150px;">Pekerjaan</th>
                <th class="header" style="width: 120px;">Penghasilan</th>
                <th class="header" style="width: 80px;">Tanggungan</th>
                <th class="header" style="width: 250px;">Kondisi Rumah</th>
                <th class="header" style="width: 120px;">Desa</th>
                <th class="header" style="width: 60px;">RT/RW</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $w)
                <tr>
                    <td class="data text-center">{{ $index + 1 }}</td>
                    <td class="data nik-text">{{ $w->nik }}</td>
                    <td class="data" style="font-weight: bold;">{{ $w->nama_lengkap }}</td>
                    <td class="data">{{ $w->pekerjaan }}</td>
                    <td class="data text-right" style="mso-number-format:'\#\,\#\#0';"><span>{{ $w->penghasilan }}</span></td>
                    <td class="data text-center">{{ $w->jumlah_tanggungan }}</td>
                    <td class="data">{{ $w->kondisi_rumah }}</td>
                    <td class="data text-center">{{ $w->desa }}</td>
                    <td class="data text-center">{{ $w->rt }}/{{ $w->rw }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
