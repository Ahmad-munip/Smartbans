<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Akses Ditolak (403) | BanSmart</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <div class="error-container">
        <div class="error-card">
            <div class="error-icon">
                <i class="fa-solid fa-lock"></i>
            </div>
            
            <h1 style="font-size: 1.75rem; font-weight: 800; color: var(--text-primary);">Akses Ditolak (403)</h1>
            
            <p style="color: var(--text-secondary); line-height: 1.6; margin-bottom: 0.5rem;">
                {{ $message ?? 'Maaf, Anda tidak memiliki kewenangan atau izin yang cukup untuk mengakses halaman ini.' }}
            </p>
            
            <div style="display: flex; gap: 0.75rem; width: 100%;">
                <a href="javascript:history.back()" class="btn-modern btn-secondary-modern" style="flex: 1;">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('dashboard') }}" class="btn-modern btn-primary-modern" style="flex: 1;">
                    <i class="fa-solid fa-house"></i> Dashboard
                </a>
            </div>
        </div>
    </div>

</body>
</html>
