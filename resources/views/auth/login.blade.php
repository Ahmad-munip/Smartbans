<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masuk ke Sistem | BanSmart SPK</title>

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
        /* Demo Role Cards — Light Theme (white bg card style) */
        .login-demo-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 0.65rem;
            margin-bottom: 1.5rem;
        }
        
        .login-demo-card {
            background: #f8fafc;
            border: 1.5px solid var(--border-color);
            border-radius: 1rem;
            padding: 1rem 0.75rem;
            cursor: pointer;
            text-align: center;
            transition: var(--transition-smooth);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-secondary);
        }
        
        .login-demo-card:hover {
            transform: translateY(-4px);
            background: #ffffff;
            border-color: var(--primary-gradient-start);
            color: var(--text-primary);
            box-shadow: var(--shadow-premium-md);
        }
        
        .login-demo-card.active {
            background: var(--accent-blue-light);
            border-color: var(--primary-gradient-start);
            color: var(--primary-gradient-start);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.08);
        }
        
        .login-demo-card i {
            font-size: 1.5rem;
            transition: var(--transition-smooth);
        }

        .login-demo-card:not(.active) i {
            color: var(--primary-gradient-start);
        }
        
        .login-demo-card.active i {
            color: var(--primary-gradient-start);
            transform: scale(1.1);
        }
        
        .login-demo-title {
            font-size: 0.85rem;
            font-weight: 700;
            color: inherit;
        }
        
        .login-demo-subtitle {
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        /* Fix icon inside input — dark on light background */
        .input-icon {
            color: var(--text-muted);
        }
    </style>
</head>
<body class="login-body" style="position: relative; overflow: hidden;">

    <div class="login-card" style="z-index: 10; position: relative;">
        <div class="login-header">
            <span class="login-brand" style="margin-bottom: 0.75rem;"><i class="fa-solid fa-brain"></i> BanSmart</span>
            <h2 class="login-title" style="font-family: var(--font-heading); font-size: 1.5rem;">Sistem Pendukung Keputusan</h2>
            <p class="login-subtitle" style="font-size: 0.85rem; opacity: 0.8;">Metode AHP & TOPSIS • Kelayakan Bantuan</p>
        </div>

        <!-- Demonstration Account Quick Selectors -->
        <div style="margin-bottom: 1.75rem;">
            <label class="form-label-modern" style="font-size: 0.8rem; margin-bottom: 0.75rem; display: block; font-weight: 600;">
                <i class="fa-solid fa-circle-user" style="color: var(--primary-gradient-start);"></i> Pilihan Akun Demo (Sidang Uji Coba)
            </label>
            <div class="login-demo-grid">
                <div class="login-demo-card" id="card-admin" onclick="fillCredentials('admin@bansmart.test', 'password', 'admin')">
                    <i class="fa-solid fa-user-shield"></i>
                    <div>
                        <div class="login-demo-title">Admin</div>
                        <div class="login-demo-subtitle">Akses SPK Penuh</div>
                    </div>
                </div>
                <div class="login-demo-card" id="card-petugas" onclick="fillCredentials('petugas@bansmart.test', 'password', 'petugas')">
                    <i class="fa-solid fa-user-pen"></i>
                    <div>
                        <div class="login-demo-title">Petugas</div>
                        <div class="login-demo-subtitle">Akses Input Data</div>
                    </div>
                </div>
                <div class="login-demo-card" id="card-operator" onclick="fillCredentials('operator@bansmart.test', 'password', 'operator')">
                    <i class="fa-solid fa-user-clock"></i>
                    <div>
                        <div class="login-demo-title">Operator</div>
                        <div class="login-demo-subtitle">Akses Lihat Data</div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('login') }}" method="POST" class="login-form">
            @csrf
            
            <div class="form-group-modern" style="margin-bottom: 1.25rem;">
                <label for="email" class="form-label-modern">Alamat Email</label>
                <div style="position: relative;">
                    <i class="fa-regular fa-envelope input-icon" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); font-size: 0.9rem;"></i>
                    <input type="email" name="email" id="email" class="form-input-modern" placeholder="nama@bansmart.test" value="{{ old('email') }}" style="padding-left: 2.75rem; width: 100%;" required autofocus>
                </div>
                @error('email')
                    <span class="invalid-feedback-modern" style="color: #f87171; font-size: 0.75rem; margin-top: 0.35rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group-modern" style="margin-bottom: 1.5rem;">
                <label for="password" class="form-label-modern">Kata Sandi</label>
                <div style="position: relative;">
                    <i class="fa-solid fa-lock input-icon" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); font-size: 0.9rem;"></i>
                    <input type="password" name="password" id="password" class="form-input-modern" placeholder="Masukkan kata sandi" style="padding-left: 2.75rem; width: 100%;" required>
                </div>
                @error('password')
                    <span class="invalid-feedback-modern" style="color: #f87171; font-size: 0.75rem; margin-top: 0.35rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="login-remember" style="margin-bottom: 1.75rem;">
                <label class="checkbox-modern" style="font-size: 0.8rem;">
                    <input type="checkbox" name="remember" id="remember" style="width: 16px; height: 16px;">
                    Ingat Sesi Masuk
                </label>
            </div>

            <button type="submit" class="btn-modern btn-primary-modern" style="width: 100%; padding: 0.9rem; font-size: 0.95rem; display: flex; justify-content: center; align-items: center; gap: 0.5rem; font-weight: 600; cursor: pointer; letter-spacing: 0.01em;">
                <i class="fa-solid fa-right-to-bracket"></i> Masuk Sekarang <i class="fa-solid fa-arrow-right" style="font-size: 0.8rem; margin-left: 0.2rem;"></i>
            </button>
        </form>
    </div>

    <!-- Script to fill credentials -->
    <script>
        function fillCredentials(email, password, role) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
            
            // Highlight selected card
            document.querySelectorAll('.login-demo-card').forEach(c => c.classList.remove('active'));
            if (role === 'admin') {
                document.getElementById('card-admin').classList.add('active');
            } else if (role === 'petugas') {
                document.getElementById('card-petugas').classList.add('active');
            } else if (role === 'operator') {
                document.getElementById('card-operator').classList.add('active');
            }
            
            // Button feedback animation
            const btn = document.querySelector('.btn-primary-modern');
            btn.style.transform = 'scale(0.98)';
            setTimeout(() => { btn.style.transform = 'none'; }, 150);
        }
    </script>
</body>
</html>
