<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laporan') | BanSmart Kecamatan Ringinarum</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            color: #000;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        /* Container & Print Margins */
        .print-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        /* Kop Surat (Official Letterhead) */
        .kop-surat {
            display: flex;
            align-items: center;
            border-bottom: 4px double #000;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .kop-logo {
            width: 80px;
            height: auto;
            margin-right: 20px;
        }

        .kop-text {
            text-align: center;
            flex-grow: 1;
        }

        .kop-text h2 {
            margin: 0;
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .kop-text h3 {
            margin: 3px 0 0 0;
            font-size: 18pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .kop-text p {
            margin: 5px 0 0 0;
            font-size: 10pt;
            font-style: italic;
        }

        /* Title & Meta */
        .report-title-container {
            text-align: center;
            margin-bottom: 25px;
        }

        .report-title {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0 0 5px 0;
            text-decoration: underline;
        }

        .report-meta {
            font-size: 10pt;
            margin: 0;
            color: #333;
        }

        /* Tables styling */
        .print-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 10pt;
        }

        .print-table th, .print-table td {
            border: 1px solid #000;
            padding: 8px 10px;
            text-align: left;
        }

        .print-table th {
            background-color: #f2f2f2 !important;
            font-weight: bold;
            text-align: center;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .text-center {
            text-align: center !important;
        }

        .text-right {
            text-align: right !important;
        }

        /* Badges for Print */
        .badge-print {
            display: inline-block;
            padding: 3px 8px;
            font-size: 9pt;
            font-weight: bold;
            border-radius: 3px;
            border: 1px solid #000;
            text-transform: uppercase;
        }

        /* Sign Block */
        .sign-block-container {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            page-break-inside: avoid;
        }

        .sign-block {
            width: 250px;
            text-align: center;
        }

        .sign-block .date {
            margin-bottom: 60px;
        }

        .sign-block .name {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 3px;
        }

        .sign-block .nip {
            font-size: 10pt;
        }

        /* Non-printable action floating bar */
        .no-print-bar {
            background-color: #1e293b;
            color: #fff;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: system-ui, -apple-system, sans-serif;
            font-size: 14px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .no-print-bar .btn-group {
            display: flex;
            gap: 10px;
        }

        .no-print-bar button, .no-print-bar a {
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            font-size: 13px;
            transition: all 0.2s;
        }

        .btn-print {
            background-color: #10b981;
            color: white;
        }

        .btn-print:hover {
            background-color: #059669;
        }

        .btn-back {
            background-color: #4b5563;
            color: white;
        }

        .btn-back:hover {
            background-color: #374151;
        }

        /* Print Media Queries */
        @media print {
            .no-print-bar {
                display: none !important;
            }
            body {
                margin: 0;
                padding: 0;
            }
            .print-container {
                max-width: 100%;
                padding: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Floating Top Bar for UI Interaction before print -->
    <div class="no-print-bar">
        <div>
            <strong>BanSmart Laporan SPK</strong> &middot; Mode Cetak Dokumen Resmi
        </div>
        <div class="btn-group">
            <a href="{{ route('laporan.index', ['type' => $type ?? 'warga', 'desa' => $desa ?? '', 'status' => $status ?? '']) }}" class="btn-back">
                &larr; Kembali ke Dashboard
            </a>
            <button onclick="window.print();" class="btn-print">
                <i class="fa-solid fa-print"></i> Cetak / Simpan PDF
            </button>
        </div>
    </div>

    <div class="print-container">
        <!-- Kop Surat -->
        <div class="kop-surat">
            <!-- Sleek styled placeholder logo if image not available -->
            <div style="font-size: 28pt; padding: 5px 15px; border: 3px solid #000; font-weight: bold; border-radius: 8px; margin-right: 20px;">
                K
            </div>
            <div class="kop-text">
                <h2>Pemerintah Kabupaten Kendal</h2>
                <h3>Kecamatan Ringinarum</h3>
                <p>Jl. Raya Ringinarum No. 12 Ringinarum, Kendal - Jawa Tengah 51356 | Telp: (0294) 381xxx</p>
            </div>
        </div>

        <!-- Main Body -->
        @yield('content')

        <!-- Signature Block -->
        <div class="sign-block-container">
            <div class="sign-block">
                <div>Mengetahui,</div>
                <div style="margin-bottom: 60px; font-weight: bold;">Camat Ringinarum</div>
                <div class="name">Dr. H. Mulyono, M.Si.</div>
                <div class="nip">NIP. 19740815 200112 1 002</div>
            </div>
            <div class="sign-block">
                <div class="date">Ringinarum, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
                <div style="margin-bottom: 60px; font-weight: bold;">Petugas SPK Bansos</div>
                <div class="name">{{ Auth::user()->name }}</div>
                <div class="nip">NIP. 19891002 201503 2 001</div>
            </div>
        </div>
    </div>

</body>
</html>
