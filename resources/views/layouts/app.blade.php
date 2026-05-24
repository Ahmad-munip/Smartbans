<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard') | BanSmart SPK</title>
    
    <!-- Meta SEO -->
    <meta name="description" content="BanSmart - Sistem Pendukung Keputusan Penentuan Penerima Bantuan Sosial Warga Desa menggunakan Metode AHP & TOPSIS">
    <meta name="author" content="BanSmart Team">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fast font loading -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800&display=swap">

    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Custom Style Sheet with file-based cache buster -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
    
    @yield('styles')
</head>
<body>

    <div class="app-container">
        <!-- Sidebar Component -->
        @include('components.sidebar')

        <!-- Main Wrapper -->
        <div class="main-content">
            
            <!-- Navbar Component -->
            @include('components.navbar')

            <!-- Page Body -->
            <main class="content-body" id="main-body">
                @yield('content')
            </main>
            
        </div>

    </div>

    <!-- Toast Notifications Container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Main Javascript -->
    <script>
        // Toggle Sidebar for Mobile
        const sidebar = document.getElementById('sidebar');
        const toggleSidebarBtn = document.getElementById('toggleSidebar');

        if (toggleSidebarBtn && sidebar) {
            toggleSidebarBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                sidebar.classList.toggle('active');
            });
        }

        // Close sidebar on tapping outside (Mobile)
        document.addEventListener('click', (e) => {
            if (sidebar && sidebar.classList.contains('active')) {
                if (!sidebar.contains(e.target) && e.target !== toggleSidebarBtn) {
                    sidebar.classList.remove('active');
                }
            }
        });

        // Elegant Toast Helper
        function showToast(title, message, type = 'success') {
            const toastContainer = document.getElementById('toastContainer');
            if (!toastContainer) return;

            const toastId = 'toast-' + Math.random().toString(36).substr(2, 9);
            const icon = type === 'success' 
                ? '<i class="fa-solid fa-circle-check"></i>' 
                : '<i class="fa-solid fa-circle-xmark"></i>';
            
            const toastHtml = `
                <div class="toast-modern toast-${type}" id="${toastId}">
                    <div class="toast-icon">${icon}</div>
                    <div class="toast-content">
                        <div class="toast-title">${title}</div>
                        <div class="toast-message">${message}</div>
                    </div>
                    <button class="toast-close" onclick="closeToast('${toastId}')">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            `;

            toastContainer.insertAdjacentHTML('beforeend', toastHtml);
            
            const toastEl = document.getElementById(toastId);
            // Trigger animation frame
            setTimeout(() => {
                toastEl.classList.add('show');
            }, 10);

            // Auto-close after 5 seconds
            setTimeout(() => {
                closeToast(toastId);
            }, 5000);
        }

        function closeToast(id) {
            const toastEl = document.getElementById(id);
            if (!toastEl) return;
            
            toastEl.classList.remove('show');
            setTimeout(() => {
                toastEl.remove();
            }, 300);
        }

        // Catch Laravel Session Flashes
        @if(session('success'))
            showToast('Berhasil', "{{ session('success') }}", 'success');
        @endif

        @if(session('error'))
            showToast('Kesalahan', "{{ session('error') }}", 'error');
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                showToast('Validasi Gagal', "{{ $error }}", 'error');
            @endforeach
        @endif
    </script>

    @yield('scripts')
</body>
</html>
