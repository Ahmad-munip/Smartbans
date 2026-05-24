<nav class="navbar">
    <div class="navbar-left">
        <button class="toggle-sidebar" id="toggleSidebar">
            <i class="fa-solid fa-bars"></i>
        </button>
        <h1 class="navbar-page-title">
            @yield('page_title', 'Dashboard Utama')
        </h1>
    </div>

    <div class="navbar-right">
        <!-- System Health Badge -->
        <span class="navbar-badge" title="Koneksi basis data MySQL terhubung secara langsung.">
            <span class="badge-dot" style="width: 8px; height: 8px; background-color: var(--accent-emerald); border-radius: 50%; display: inline-block;"></span>
            Sistem Aktif
        </span>

        <!-- Dynamic Date -->
        <div class="navbar-date">
            <i class="fa-regular fa-calendar-days"></i>
            <span id="currentDateString">Jumat, 22 Mei 2026</span>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Set dynamic date in Indonesian locale
        const dateElement = document.getElementById('currentDateString');
        if (dateElement) {
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const today = new Date();
            // Let's force Indonesian formatting
            try {
                dateElement.textContent = today.toLocaleDateString('id-ID', options);
            } catch (e) {
                // fallback
                dateElement.textContent = today.toDateString();
            }
        }
    });
</script>
