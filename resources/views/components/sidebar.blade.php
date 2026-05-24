<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('dashboard') }}" class="sidebar-brand" style="text-decoration: none;">
            <i class="fa-solid fa-brain"></i> BanSmart
        </a>
    </div>

    <ul class="sidebar-menu">
        <li class="sidebar-subtitle">Menu Utama</li>
        <li class="sidebar-item">
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ Route::is('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-line"></i> Dashboard
            </a>
        </li>

        <li class="sidebar-subtitle">Master Data</li>
        <li class="sidebar-item">
            <a href="{{ route('warga.index') }}" class="sidebar-link {{ Route::is('warga.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> Data Warga
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('kriteria.index') }}" class="sidebar-link {{ Route::is('kriteria.*') ? 'active' : '' }}">
                <i class="fa-solid fa-list-check"></i> Data Kriteria
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('sub-kriteria.index') }}" class="sidebar-link {{ Route::is('sub-kriteria.*') ? 'active' : '' }}">
                <i class="fa-solid fa-sliders"></i> Skala Penilaian
            </a>
        </li>

        <li class="sidebar-subtitle">Proses SPK</li>
        <li class="sidebar-item">
            <a href="{{ route('ahp.index') }}" class="sidebar-link {{ Route::is('ahp.*') ? 'active' : '' }}">
                <i class="fa-solid fa-scale-balanced"></i> Analisis Kriteria (AHP)
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('topsis.index') }}" class="sidebar-link {{ Route::is('topsis.*') ? 'active' : '' }}">
                <i class="fa-solid fa-ranking-star"></i> Proses & Ranking (TOPSIS)
            </a>
        </li>

        <li class="sidebar-subtitle">Laporan & Output</li>
        <li class="sidebar-item">
            <a href="{{ route('laporan.index') }}" class="sidebar-link {{ Route::is('laporan.*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-pdf"></i> Laporan SPK
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        @auth
            <div class="sidebar-user">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="user-info">
                    <div class="user-name" title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</div>
                    <div class="user-role">
                        @if(Auth::user()->role === 'admin')
                            <span class="badge-modern badge-emerald" style="padding: 0.05rem 0.35rem; font-size: 0.65rem;">Admin</span>
                        @elseif(Auth::user()->role === 'petugas')
                            <span class="badge-modern badge-blue" style="padding: 0.05rem 0.35rem; font-size: 0.65rem;">Petugas</span>
                        @else
                            <span class="badge-modern badge-yellow" style="padding: 0.05rem 0.35rem; font-size: 0.65rem;">Operator</span>
                        @endif
                    </div>
                </div>
                
                <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                    @csrf
                </form>
                
                <button type="button" class="btn-logout-sidebar" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Keluar">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </button>
            </div>
        @else
            <div class="sidebar-user">
                <a href="{{ route('login') }}" class="btn-modern btn-primary-modern btn-sm-modern" style="width: 100%;">
                    <i class="fa-solid fa-right-to-bracket"></i> Masuk
                </a>
            </div>
        @endauth
    </div>
</div>
