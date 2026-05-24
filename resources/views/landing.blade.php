<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BanSmart SPK | Portal Bantuan Sosial Hibrida AHP-TOPSIS</title>

    <!-- Fast font loading -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800&display=swap">

    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Custom Style Sheet with file-based cache buster -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">

    <style>
        /* Modern Civic Portal Landing Specific CSS */
        .landing-body {
            background:
                linear-gradient(180deg, #f8fafc 0%, #eef7f4 42%, #f8fafc 100%);
            color: var(--text-primary);
            font-family: var(--font-body);
            overflow-x: hidden;
            position: relative;
        }

        /* Glassmorphic Floating Header */
        .landing-header {
            position: fixed;
            top: 1.25rem;
            left: 50%;
            transform: translateX(-50%);
            width: min(92%, 1180px);
            height: 72px;
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            z-index: 1000;
            box-shadow: 0 18px 42px -22px rgba(15, 23, 42, 0.35);
            transition: var(--transition-smooth);
        }

        .landing-header.scrolled {
            top: 0.5rem;
            width: 95%;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: var(--shadow-premium-md);
        }

        .landing-brand {
            font-family: var(--font-heading);
            font-size: 1.4rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-gradient-start) 0%, var(--primary-gradient-end) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .landing-brand-mark {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.12), rgba(5, 150, 105, 0.16));
        }

        .landing-brand i {
            color: var(--primary-gradient-start);
            -webkit-text-fill-color: var(--primary-gradient-start);
        }

        .landing-nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
            align-items: center;
        }

        .landing-nav-link {
            text-decoration: none;
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 0.9rem;
            transition: var(--transition-smooth);
            position: relative;
            padding: 0.25rem 0;
        }

        .landing-nav-link:hover {
            color: var(--primary-gradient-start);
        }

        .landing-nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-gradient-start);
            transition: var(--transition-smooth);
        }

        .landing-nav-link:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .landing-hero {
            min-height: 92vh;
            padding: 150px 2rem 72px;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            background-color: #0f172a;
            isolation: isolate;
        }

        .hero-ai-image {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center right;
            z-index: -2;
            transform: scale(1.02);
        }

        .landing-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                linear-gradient(90deg, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.74) 34%, rgba(15, 23, 42, 0.18) 72%, rgba(15, 23, 42, 0.08) 100%),
                linear-gradient(180deg, rgba(15, 23, 42, 0.35) 0%, rgba(15, 23, 42, 0.05) 48%, rgba(248, 250, 252, 0.88) 100%);
            z-index: -1;
        }

        .hero-inner {
            width: min(1180px, 100%);
            margin: 0 auto;
            display: grid;
            grid-template-columns: minmax(0, 680px) 1fr;
            align-items: center;
            gap: 2rem;
        }

        .hero-copy {
            color: #ffffff;
            text-align: left;
        }

        .hero-badge {
            background-color: rgba(255, 255, 255, 0.14);
            color: #dbeafe;
            padding: 0.5rem 1.25rem;
            border-radius: 9999px;
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 10px 30px -18px rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.22);
            backdrop-filter: blur(12px);
        }

        .hero-title {
            font-family: var(--font-heading);
            font-size: clamp(2.65rem, 6vw, 5.3rem);
            font-weight: 800;
            line-height: 0.98;
            color: #ffffff;
            max-width: 760px;
            margin-bottom: 1.5rem;
            letter-spacing: 0;
        }

        .hero-title .text-gradient {
            background: linear-gradient(135deg, #67e8f9 0%, #34d399 48%, #fbbf24 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            font-size: 1.08rem;
            color: rgba(241, 245, 249, 0.88);
            max-width: 660px;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-start;
            flex-wrap: wrap;
            z-index: 10;
        }

        .hero-actions .btn-secondary-modern {
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
            border-color: rgba(255, 255, 255, 0.24);
            backdrop-filter: blur(12px);
        }

        .hero-proof-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0.75rem;
            max-width: 620px;
            margin-top: 2rem;
        }

        .hero-proof-item {
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: rgba(15, 23, 42, 0.36);
            backdrop-filter: blur(16px);
            border-radius: 8px;
            padding: 0.9rem;
        }

        .hero-proof-value {
            display: block;
            font-family: var(--font-heading);
            color: #ffffff;
            font-size: 1.25rem;
            font-weight: 800;
            margin-bottom: 0.15rem;
        }

        .hero-proof-label {
            display: block;
            color: rgba(226, 232, 240, 0.78);
            font-size: 0.76rem;
            line-height: 1.35;
        }

        /* Features Section */
        .landing-section {
            padding: 96px 2rem;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }

        .landing-hero + .landing-section {
            padding-top: 48px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-tag {
            color: var(--primary-gradient-start);
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            margin-bottom: 0.75rem;
            display: block;
        }

        .section-title {
            font-family: var(--font-heading);
            font-size: clamp(2rem, 4vw, 3.15rem);
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: 0;
            max-width: 760px;
            margin: 0 auto;
            line-height: 1.08;
        }

        .method-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
            margin-bottom: 4rem;
        }

        .method-card {
            background: rgba(255, 255, 255, 0.78);
            border: 1px solid rgba(203, 213, 225, 0.78);
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 18px 50px -32px rgba(15, 23, 42, 0.45);
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }

        .method-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 5px;
            background: linear-gradient(180deg, #4f46e5, #06b6d4);
        }

        .method-card:nth-child(2)::before {
            background: linear-gradient(180deg, #059669, #f59e0b);
        }

        .method-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 22px 70px -36px rgba(15, 23, 42, 0.55);
            border-color: rgba(79, 70, 229, 0.26);
        }

        .method-icon {
            width: 64px;
            height: 64px;
            border-radius: 8px;
            background: var(--accent-blue-light);
            color: var(--primary-gradient-start);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-premium-sm);
        }

        .method-card:nth-child(2) .method-icon {
            background: var(--accent-emerald-light);
            color: var(--accent-emerald);
        }

        .method-title {
            font-family: var(--font-heading);
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .method-desc {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .method-features-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .method-features-list li {
            font-size: 0.9rem;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .method-features-list li i {
            color: var(--primary-gradient-start);
        }

        .method-card:nth-child(2) .method-features-list li i {
            color: var(--accent-emerald);
        }

        /* Timeline / Alur Kerja Section */
        .timeline-container {
            position: relative;
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem 0;
        }

        .timeline-container::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 3px;
            background: linear-gradient(to bottom, var(--primary-gradient-start), var(--primary-gradient-end), var(--accent-emerald));
            border-radius: 9999px;
        }

        .timeline-step {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3.5rem;
            width: 100%;
            position: relative;
        }

        .timeline-step:nth-child(even) {
            flex-direction: row-reverse;
        }

        .timeline-badge {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #ffffff;
            border: 3px solid var(--primary-gradient-start);
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-heading);
            font-weight: 800;
            font-size: 1.15rem;
            color: var(--primary-gradient-start);
            box-shadow: 0 0 0 6px rgba(79, 70, 229, 0.1);
            z-index: 10;
        }

        .timeline-step:nth-child(2) .timeline-badge {
            border-color: #818cf8;
            color: #818cf8;
            box-shadow: 0 0 0 6px rgba(129, 140, 248, 0.1);
        }

        .timeline-step:nth-child(3) .timeline-badge {
            border-color: var(--primary-gradient-end);
            color: var(--primary-gradient-end);
            box-shadow: 0 0 0 6px rgba(6, 182, 212, 0.1);
        }

        .timeline-step:nth-child(4) .timeline-badge {
            border-color: var(--accent-emerald);
            color: var(--accent-emerald);
            box-shadow: 0 0 0 6px rgba(5, 150, 105, 0.1);
        }

        .timeline-content {
            width: 44%;
            background: rgba(255, 255, 255, 0.84);
            padding: 1.75rem;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-premium-sm);
            transition: var(--transition-smooth);
        }

        .timeline-step:hover .timeline-content {
            transform: translateY(-4px);
            box-shadow: var(--shadow-premium-md);
        }

        .timeline-step-title {
            font-family: var(--font-heading);
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .timeline-step-desc {
            font-size: 0.85rem;
            color: var(--text-secondary);
            line-height: 1.5;
        }

        .timeline-empty {
            width: 44%;
        }

        /* Stats Grid Section */
        .stats-banner {
            background:
                linear-gradient(135deg, rgba(15, 23, 42, 0.98) 0%, rgba(17, 94, 89, 0.96) 56%, rgba(180, 83, 9, 0.92) 100%);
            border-radius: 8px;
            padding: 3rem 4rem;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            color: #ffffff;
            box-shadow: 0 24px 70px -36px rgba(15, 23, 42, 0.65);
            margin-bottom: 5rem;
        }

        .stat-item {
            text-align: center;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .stat-num {
            font-family: var(--font-heading);
            font-size: 2.75rem;
            font-weight: 800;
            color: #ffffff;
        }

        .stat-text {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* CTA Banner */
        .cta-banner {
            border: 1px solid rgba(203, 213, 225, 0.88);
            border-radius: 8px;
            padding: 4rem 3rem;
            text-align: center;
            box-shadow: 0 24px 70px -38px rgba(15, 23, 42, 0.55);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
            background:
                linear-gradient(135deg, rgba(255, 255, 255, 0.94) 0%, rgba(240, 253, 250, 0.94) 52%, rgba(255, 251, 235, 0.94) 100%);
        }

        .cta-banner::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('{{ asset('images/bansmart-ai-hero.png') }}?v={{ filemtime(public_path('images/bansmart-ai-hero.png')) }}');
            background-size: cover;
            background-position: center;
            opacity: 0.08;
            filter: saturate(120%);
        }

        .cta-banner > * {
            position: relative;
            z-index: 1;
        }

        .cta-title {
            font-family: var(--font-heading);
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--text-primary);
            max-width: 600px;
        }

        .cta-desc {
            font-size: 1rem;
            color: var(--text-secondary);
            max-width: 500px;
            line-height: 1.6;
        }

        /* Footer */
        .landing-footer {
            background-color: #ffffff;
            border-top: 1px solid var(--border-color);
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
            z-index: 10;
        }

        .footer-brand {
            font-family: var(--font-heading);
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-desc {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            list-style: none;
            margin-bottom: 2rem;
        }

        .footer-link {
            text-decoration: none;
            color: var(--text-secondary);
            font-size: 0.85rem;
            font-weight: 600;
            transition: var(--transition-smooth);
        }

        .footer-link:hover {
            color: var(--primary-gradient-start);
        }

        .footer-copy {
            font-size: 0.8rem;
            color: var(--text-muted);
            border-top: 1px solid var(--border-color);
            padding-top: 1.5rem;
        }

        /* Responsive Breakpoints */
        @media (max-width: 992px) {
            .landing-hero {
                min-height: auto;
                padding-top: 132px;
            }
            .hero-inner {
                grid-template-columns: 1fr;
            }
            .method-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            .stats-banner {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
                padding: 2rem;
            }
        }

        @media (max-height: 760px) and (min-width: 993px) {
            .landing-hero {
                min-height: 88vh;
                padding-top: 112px;
                padding-bottom: 36px;
            }
            .hero-title {
                font-size: clamp(2.45rem, 4.9vw, 4.25rem);
                max-width: 640px;
            }
            .hero-desc {
                font-size: 0.98rem;
                max-width: 600px;
                margin-bottom: 1.25rem;
            }
            .hero-proof-grid {
                margin-top: 1.25rem;
            }
            .hero-proof-item {
                padding: 0.65rem 0.75rem;
            }
            .hero-proof-value {
                font-size: 1rem;
            }
            .hero-proof-label {
                font-size: 0.68rem;
            }
        }

        @media (max-width: 768px) {
            .landing-header {
                padding: 0 1rem;
                height: 66px;
            }
            .landing-nav-links {
                display: none; /* simple mobile version keeps only logo and CTA */
            }
            .landing-brand {
                font-size: 1.1rem;
            }
            .landing-header .btn-modern {
                padding: 0.52rem 0.85rem !important;
                font-size: 0.78rem !important;
            }
            .landing-hero {
                padding: 124px 1.25rem 56px;
            }
            .hero-ai-image {
                object-position: 62% center;
            }
            .landing-hero::before {
                background:
                    linear-gradient(180deg, rgba(15, 23, 42, 0.84) 0%, rgba(15, 23, 42, 0.56) 48%, rgba(248, 250, 252, 0.88) 100%);
            }
            .hero-copy {
                text-align: left;
            }
            .hero-desc {
                font-size: 0.98rem;
                color: rgba(241, 245, 249, 0.9);
            }
            .hero-proof-grid {
                grid-template-columns: 1fr;
            }
            .hero-actions {
                flex-direction: column;
                align-items: stretch;
            }
            .hero-actions .btn-modern {
                justify-content: center;
            }
            .timeline-container::before {
                left: 1.5rem;
            }
            .timeline-step {
                flex-direction: row !important;
                margin-bottom: 2.5rem;
            }
            .timeline-badge {
                left: 1.5rem;
                transform: translate(-50%, -50%);
            }
            .timeline-content {
                width: calc(100% - 3rem);
                margin-left: 3rem;
            }
            .timeline-empty {
                display: none;
            }
            .stats-banner {
                grid-template-columns: 1fr;
            }
            .cta-banner {
                padding: 3rem 1.5rem;
            }
            .cta-title {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body class="landing-body">

    <!-- Floating Navbar -->
    <header class="landing-header" id="navbar">
        <a href="#" class="landing-brand">
            <span class="landing-brand-mark"><i class="fa-solid fa-brain"></i></span> BanSmart
        </a>
        <ul class="landing-nav-links">
            <li><a href="#" class="landing-nav-link">Beranda</a></li>
            <li><a href="#metode" class="landing-nav-link">Metode Sains</a></li>
            <li><a href="#alur" class="landing-nav-link">Alur Kerja</a></li>
            <li><a href="#keunggulan" class="landing-nav-link">Keunggulan</a></li>
        </ul>
        <div>
            @auth
                <a href="{{ route('dashboard') }}" class="btn-modern btn-primary-modern" style="padding: 0.6rem 1.5rem; font-size: 0.85rem;">
                    <i class="fa-solid fa-gauge-high"></i> Buka Dasbor
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-modern btn-primary-modern" style="padding: 0.6rem 1.5rem; font-size: 0.85rem;">
                    <i class="fa-solid fa-right-to-bracket"></i> Masuk Sistem
                </a>
            @endauth
        </div>
    </header>

    <!-- Hero Section -->
    <section class="landing-hero">
        <img
            class="hero-ai-image"
            src="{{ asset('images/bansmart-ai-hero.png') }}?v={{ filemtime(public_path('images/bansmart-ai-hero.png')) }}"
            alt="Visual AI dashboard keputusan BanSmart dengan kartu peringkat, grafik, dan alur AHP TOPSIS"
        >
        <div class="hero-inner">
            <div class="hero-copy">
                <div class="hero-badge">
                    <i class="fa-solid fa-shield-halved"></i> SPK Bantuan Sosial Hibrida Modern
                </div>
                <h1 class="hero-title">
                    BanSmart untuk Seleksi Bansos yang <span class="text-gradient">lebih objektif</span>
                </h1>
                <p class="hero-desc">
                    Visual AI di halaman ini menggambarkan cara BanSmart membaca data warga, menimbang kriteria AHP, lalu menyusun peringkat kelayakan TOPSIS dalam satu ruang kerja yang transparan.
                </p>
                <div class="hero-actions">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-modern btn-primary-modern">
                            <i class="fa-solid fa-gauge-high"></i> Buka Dasbor Utama <i class="fa-solid fa-arrow-right" style="margin-left: 0.25rem;"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-modern btn-primary-modern">
                            <i class="fa-solid fa-right-to-bracket"></i> Mulai Analisis Sekarang <i class="fa-solid fa-arrow-right" style="margin-left: 0.25rem;"></i>
                        </a>
                    @endauth
                    <a href="#metode" class="btn-modern btn-secondary-modern">
                        <i class="fa-solid fa-circle-info"></i> Lihat Metodologi
                    </a>
                </div>
                <div class="hero-proof-grid" aria-label="Ringkasan kemampuan BanSmart">
                    <div class="hero-proof-item">
                        <span class="hero-proof-value">AHP</span>
                        <span class="hero-proof-label">Bobot kriteria dihitung dengan uji konsistensi.</span>
                    </div>
                    <div class="hero-proof-item">
                        <span class="hero-proof-value">TOPSIS</span>
                        <span class="hero-proof-label">Peringkat warga berdasarkan kedekatan solusi ideal.</span>
                    </div>
                    <div class="hero-proof-item">
                        <span class="hero-proof-value">Laporan</span>
                        <span class="hero-proof-label">Hasil seleksi siap dicetak dan diverifikasi.</span>
                    </div>
                </div>
            </div>
            <div aria-hidden="true"></div>
        </div>
    </section>

    <!-- Metodologi Section -->
    <section class="landing-section" id="metode">
        <div class="section-header">
            <span class="section-tag">Metodologi Ilmiah</span>
            <h2 class="section-title">Integrasi Algoritma AHP & TOPSIS</h2>
        </div>

        <div class="method-grid">
            <div class="method-card">
                <div class="method-icon">
                    <i class="fa-solid fa-bezier-curve"></i>
                </div>
                <h3 class="method-title">1. AHP (Analytical Hierarchy Process)</h3>
                <p class="method-desc">
                    AHP digunakan untuk menentukan bobot kepentingan dari masing-masing kriteria penerimaan bantuan (seperti Penghasilan, Tanggungan, Kondisi Rumah, dll). Metode ini menjamin objektivitas penentuan kepentingan melalui pengujian rasio konsistensi matriks perbandingan berpasangan Saaty (CR < 0.1).
                </p>
                <ul class="method-features-list">
                    <li><i class="fa-solid fa-circle-check"></i> Matriks Perbandingan Berpasangan</li>
                    <li><i class="fa-solid fa-circle-check"></i> Konsistensi Logika Teruji (CR < 10%)</li>
                    <li><i class="fa-solid fa-circle-check"></i> Skala Kepentingan Relatif Saaty (1-9)</li>
                </ul>
            </div>

            <div class="method-card">
                <div class="method-icon">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <h3 class="method-title">2. TOPSIS (Technique for Order Preference)</h3>
                <p class="method-desc">
                    TOPSIS memeringkat kelayakan calon penerima berdasarkan prinsip bahwa alternatif terpilih harus memiliki jarak terdekat dari solusi ideal positif (warga paling layak menerima) dan jarak terpanjang dari solusi ideal negatif (warga paling berkecukupan).
                </p>
                <ul class="method-features-list">
                    <li><i class="fa-solid fa-circle-check"></i> Normalisasi Matriks Keputusan</li>
                    <li><i class="fa-solid fa-circle-check"></i> Pengukuran Jarak Solusi Ideal (D+ dan D-)</li>
                    <li><i class="fa-solid fa-circle-check"></i> Kedekatan Relatif Terhadap Solusi Terbaik (Skor 0 - 1)</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Alur Kerja Section -->
    <section class="landing-section" style="background-color: rgba(255, 255, 255, 0.4); border-radius: var(--radius-2xl);" id="alur">
        <div class="section-header">
            <span class="section-tag">Proses SPK</span>
            <h2 class="section-title">Alur Kerja Sistem Keputusan</h2>
        </div>

        <div class="timeline-container">
            <!-- Step 1 -->
            <div class="timeline-step">
                <div class="timeline-badge">1</div>
                <div class="timeline-content">
                    <h4 class="timeline-step-title"><i class="fa-solid fa-sliders"></i> Pembobotan Kriteria (AHP)</h4>
                    <p class="timeline-step-desc">
                        Admin merumuskan perbandingan tingkat kepentingan antar kriteria di matriks keputusan. Sistem menghitung Eigenvector utama dan memastikan Consistency Ratio (CR) bernilai valid.
                    </p>
                </div>
                <div class="timeline-empty"></div>
            </div>

            <!-- Step 2 -->
            <div class="timeline-step">
                <div class="timeline-badge">2</div>
                <div class="timeline-empty"></div>
                <div class="timeline-content">
                    <h4 class="timeline-step-title"><i class="fa-solid fa-users"></i> Pencatatan Warga & Evaluasi</h4>
                    <p class="timeline-step-desc">
                        Petugas memasukkan berkas data warga calon penerima bantuan. Setiap warga diberikan skor riil sesuai kriteria dasar: penghasilan, tanggungan, luas tanah, dinding, dsb.
                    </p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="timeline-step">
                <div class="timeline-badge">3</div>
                <div class="timeline-content">
                    <h4 class="timeline-step-title"><i class="fa-solid fa-calculator"></i> Kalkulasi Normalisasi TOPSIS</h4>
                    <p class="timeline-step-desc">
                        Sistem melakukan perkalian bobot AHP terhadap matriks ternormalisasi TOPSIS, memetakan solusi ideal positif dan negatif, serta menghitung jarak kedekatan relatif setiap warga secara *realtime*.
                    </p>
                </div>
                <div class="timeline-empty"></div>
            </div>

            <!-- Step 4 -->
            <div class="timeline-step">
                <div class="timeline-badge">4</div>
                <div class="timeline-empty"></div>
                <div class="timeline-content">
                    <h4 class="timeline-step-title"><i class="fa-solid fa-ranking-star"></i> Peringkat Layak & Laporan</h4>
                    <p class="timeline-step-desc">
                        Sistem menyajikan rangking kelayakan warga dari skor 1.000 ke bawah. Laporan dapat dicetak langsung ke PDF atau diekspor ke Excel dengan resmi untuk verifikasi sidang penentuan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Keunggulan Section -->
    <section class="landing-section" id="keunggulan">
        <div class="section-header">
            <span class="section-tag">Keunggulan Utama</span>
            <h2 class="section-title">Mengapa Menggunakan BanSmart?</h2>
        </div>

        <div class="stats-banner">
            <div class="stat-item">
                <div class="stat-num">100%</div>
                <div class="stat-text">Objektif & Ilmiah</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">&lt; 1s</div>
                <div class="stat-text">Kalkulasi Cepat</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">4 Jenis</div>
                <div class="stat-text">Format Laporan</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">3 Peran</div>
                <div class="stat-text">Akses Keamanan</div>
            </div>
        </div>

        <div class="cta-banner">
            <h3 class="cta-title">Siap Meningkatkan Transparansi Bantuan Sosial?</h3>
            <p class="cta-desc">
                Gunakan kecerdasan buatan dan sains keputusan untuk meminimalkan salah sasaran pembagian bantuan di lingkungan warga.
            </p>
            @auth
                <a href="{{ route('dashboard') }}" class="btn-modern btn-primary-modern" style="padding: 0.9rem 2.5rem; font-size: 1rem;">
                    <i class="fa-solid fa-gauge-high"></i> Masuk ke Dasbor Utama
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-modern btn-primary-modern" style="padding: 0.9rem 2.5rem; font-size: 1rem;">
                    <i class="fa-solid fa-right-to-bracket"></i> Buka Sistem Sekarang
                </a>
            @endauth
        </div>
    </section>

    <!-- Footer -->
    <footer class="landing-footer">
        <div class="footer-brand">
            <i class="fa-solid fa-brain"></i> BanSmart
        </div>
        <p class="footer-desc">
            Sistem Pendukung Keputusan Penentuan Penerima Bantuan Sosial Hibrida AHP-TOPSIS.
        </p>
        <ul class="footer-links">
            <li><a href="#" class="footer-link">Kebijakan Privasi</a></li>
            <li><a href="#" class="footer-link">Syarat & Ketentuan</a></li>
            <li><a href="{{ route('login') }}" class="footer-link">Akses Admin</a></li>
        </ul>
        <div class="footer-copy">
            &copy; 2026 BanSmart. Aplikasi Portal Skripsi Mahasiswa. Hak Cipta Dilindungi.
        </div>
    </footer>

    <!-- Header scroll animation script -->
    <script>
        window.addEventListener('scroll', function() {
            const header = document.getElementById('navbar');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
