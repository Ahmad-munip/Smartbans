@extends('layouts.app')

@section('title', 'Data Warga')
@section('page_title', 'Master Data Warga')

@section('content')
    <style>
        /* Responsive Display Toggle */
        @media (max-width: 768px) {
            .desktop-only-table {
                display: none !important;
            }
            .mobile-only-grid {
                display: grid !important;
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }
        @media (min-width: 769px) {
            .desktop-only-table {
                display: block !important;
            }
            .mobile-only-grid {
                display: none !important;
            }
        }

        .warga-card-mobile {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-xl);
            padding: 1.25rem;
            box-shadow: var(--shadow-premium-sm);
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            transition: var(--transition-smooth);
        }
        .warga-card-mobile:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-premium-md);
            border-color: var(--primary-gradient-start);
        }
    </style>

    <!-- Actions Bar & Advanced Filtering Toolbar -->
    <div class="actions-bar" style="margin-bottom: 2rem; padding: 1.5rem; border-radius: var(--radius-2xl); border: 1px solid var(--border-color); background: var(--bg-card); box-shadow: var(--shadow-premium-sm);">
        <form action="{{ route('warga.index') }}" method="GET" class="filters-group" style="flex: 1; display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap;">
            <!-- Search Input -->
            <div class="search-box" style="flex: 1; min-width: 240px; margin-bottom: 0;">
                <i class="fa-solid fa-magnifying-glass" style="color: var(--text-secondary);"></i>
                <input type="text" name="search" placeholder="Cari NIK, nama, alamat warga..." value="{{ request('search') }}" style="width: 100%;">
            </div>
            
            <!-- Village Filter -->
            <select name="desa" class="form-select-modern" style="min-width: 150px; padding: 0.65rem 1rem;" onchange="this.form.submit()">
                <option value="">Semua Wilayah Desa</option>
                @foreach($villages as $v)
                    <option value="{{ $v }}" {{ request('desa') == $v ? 'selected' : '' }}>{{ $v }}</option>
                @endforeach
            </select>

            <!-- Sort By -->
            <select name="sort_by" class="form-select-modern" style="min-width: 150px; padding: 0.65rem 1rem;" onchange="this.form.submit()">
                <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Urutkan: Tgl Input</option>
                <option value="nama_lengkap" {{ request('sort_by') == 'nama_lengkap' ? 'selected' : '' }}>Urutkan: Nama Lengkap</option>
                <option value="penghasilan" {{ request('sort_by') == 'penghasilan' ? 'selected' : '' }}>Urutkan: Penghasilan</option>
                <option value="jumlah_tanggungan" {{ request('sort_by') == 'jumlah_tanggungan' ? 'selected' : '' }}>Urutkan: Tanggungan</option>
            </select>

            <!-- Sort Direction -->
            <select name="sort_dir" class="form-select-modern" style="min-width: 130px; padding: 0.65rem 1rem;" onchange="this.form.submit()">
                <option value="desc" {{ request('sort_dir') == 'desc' ? 'selected' : '' }}>Urutkan: Menurun</option>
                <option value="asc" {{ request('sort_dir') == 'asc' ? 'selected' : '' }}>Urutkan: Meningkat</option>
            </select>
            
            <div style="display: flex; gap: 0.5rem;">
                <button type="submit" class="btn-modern btn-secondary-modern" style="padding: 0.65rem 1rem; border-radius: 12px;">
                    <i class="fa-solid fa-filter"></i> Saring
                </button>
                
                @if(request()->anyFilled(['search', 'desa', 'sort_by', 'sort_dir']))
                    <a href="{{ route('warga.index') }}" class="btn-modern btn-danger-modern" style="text-decoration: none; padding: 0.65rem 1rem; border-radius: 12px; display: inline-flex; align-items: center; gap: 0.35rem;">
                        <i class="fa-solid fa-filter-circle-xmark"></i> Reset
                    </a>
                @endif
            </div>
        </form>

        <!-- Add Warga Button -->
        <div style="margin-left: auto;">
            <a href="{{ route('warga.create') }}" class="btn-modern btn-primary-modern" style="padding: 0.75rem 1.25rem; font-weight: 700; border-radius: 12px; display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);">
                <i class="fa-solid fa-user-plus"></i> Tambah Alternatif Warga
            </a>
        </div>
    </div>

    <!-- Warga Listing (Desktop Table View) -->
    <div class="card-modern desktop-only-table" style="padding: 0; overflow: hidden; border-radius: var(--radius-2xl); border: 1px solid var(--border-color); background: var(--bg-card); box-shadow: var(--shadow-premium-md);">
        <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
            <table class="table-modern" style="width: 100%; min-width: 900px; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid var(--border-color); background: #f8fafc;">
                        <th style="padding: 1rem 1rem; font-family: var(--font-heading); font-weight: 700; text-align: left; font-size: 0.8rem; color: var(--text-secondary); white-space: nowrap;">Identitas / NIK</th>
                        <th style="padding: 1rem 1rem; font-family: var(--font-heading); font-weight: 700; text-align: left; font-size: 0.8rem; color: var(--text-secondary); white-space: nowrap;">Nama Lengkap</th>
                        <th style="padding: 1rem 1rem; font-family: var(--font-heading); font-weight: 700; text-align: left; font-size: 0.8rem; color: var(--text-secondary); white-space: nowrap;">Domisili</th>
                        <th style="padding: 1rem 1rem; font-family: var(--font-heading); font-weight: 700; text-align: left; font-size: 0.8rem; color: var(--text-secondary); white-space: nowrap;">Pekerjaan</th>
                        <th style="padding: 1rem 1rem; font-family: var(--font-heading); font-weight: 700; text-align: right; font-size: 0.8rem; color: var(--text-secondary); white-space: nowrap;">Pendapatan</th>
                        <th style="padding: 1rem 1rem; font-family: var(--font-heading); font-weight: 700; text-align: center; font-size: 0.8rem; color: var(--text-secondary); white-space: nowrap;">Tanggungan</th>
                        <th style="padding: 1rem 1rem; font-family: var(--font-heading); font-weight: 700; text-align: center; font-size: 0.8rem; color: var(--text-secondary); white-space: nowrap;">Prioritas</th>
                        <th style="padding: 1rem 1rem; font-family: var(--font-heading); font-weight: 700; text-align: center; font-size: 0.8rem; color: var(--text-secondary); white-space: nowrap;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($wargas as $w)
                        @php
                            // Advanced Prioritas Badges logic
                            $priority = 'Sedang';
                            if ($w->penghasilan <= 1500000 && $w->jumlah_tanggungan >= 3) {
                                $priority = 'Tinggi';
                            } elseif ($w->penghasilan > 3000000) {
                                $priority = 'Rendah';
                            }
                            
                            // Dynamic initial avatar color
                            $colors = ['#4f46e5', '#059669', '#d97706', '#06b6d4', '#f43f5e', '#8b5cf6'];
                            $colorIndex = (ord(substr($w->nama_lengkap, 0, 1)) - 65) % count($colors);
                            $avatarColor = $colors[$colorIndex] ?? '#4f46e5';
                        @endphp
                        <tr style="border-bottom: 1px solid var(--border-color); transition: var(--transition-smooth);" onmouseover="this.style.backgroundColor='rgba(79, 70, 229, 0.02)'" onmouseout="this.style.backgroundColor='transparent'">
                            <td style="padding: 0.9rem 1rem; vertical-align: middle;">
                                <span style="font-family: monospace; font-weight: 700; color: var(--text-secondary); font-size: 0.8rem; white-space: nowrap;">{{ $w->nik }}</span>
                            </td>
                            <td style="padding: 0.9rem 1rem; vertical-align: middle;">
                                <div style="display: flex; align-items: center; gap: 0.6rem;">
                                    <div style="width: 34px; height: 34px; border-radius: 50%; background-color: {{ $avatarColor }}15; color: {{ $avatarColor }}; display: flex; align-items: center; justify-content: center; font-weight: 800; font-family: var(--font-heading); font-size: 0.85rem; border: 1px solid {{ $avatarColor }}30; flex-shrink: 0;">
                                        {{ strtoupper(substr($w->nama_lengkap, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 700; color: var(--text-primary); font-size: 0.85rem; white-space: nowrap;">{{ $w->nama_lengkap }}</div>
                                        <span style="font-size: 0.72rem; color: var(--text-muted);">{{ $w->no_hp ?: '-' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 0.9rem 1rem; vertical-align: middle;">
                                <div style="font-weight: 600; color: var(--text-primary); font-size: 0.82rem;">{{ $w->desa }}</div>
                                <div style="font-size: 0.72rem; color: var(--text-muted);">RT {{ $w->rt }}/RW {{ $w->rw }}</div>
                            </td>
                            <td style="padding: 0.9rem 1rem; vertical-align: middle; max-width: 120px;">
                                <span style="font-size: 0.78rem; font-weight: 600; color: var(--accent-blue); background: var(--accent-blue-light); padding: 0.2rem 0.5rem; border-radius: 6px; display: inline-block; line-height: 1.4;">{{ Str::limit($w->pekerjaan, 25) }}</span>
                            </td>
                            <td style="padding: 0.9rem 1rem; vertical-align: middle; text-align: right;">
                                <span style="font-weight: 800; color: var(--accent-red); font-size: 0.88rem; white-space: nowrap;">Rp {{ number_format($w->penghasilan, 0, ',', '.') }}</span>
                            </td>
                            <td style="padding: 0.9rem 1rem; vertical-align: middle; text-align: center;">
                                <span style="font-weight: 700; color: var(--text-primary); font-size: 0.9rem;">{{ $w->jumlah_tanggungan }}</span> <span style="font-size: 0.72rem; color: var(--text-muted);">Jiwa</span>
                            </td>
                            <td style="padding: 0.9rem 1rem; vertical-align: middle; text-align: center;">
                                @if($priority === 'Tinggi')
                                    <span style="font-size: 0.72rem; font-weight: 700; padding: 0.2rem 0.55rem; display: inline-flex; align-items: center; gap: 0.25rem; border-radius: 9999px; background: rgba(220, 38, 38, 0.1); color: var(--accent-red);">
                                        <span style="width: 5px; height: 5px; background-color: var(--accent-red); border-radius: 50%; flex-shrink: 0;"></span> Tinggi
                                    </span>
                                @elseif($priority === 'Sedang')
                                    <span style="font-size: 0.72rem; font-weight: 700; padding: 0.2rem 0.55rem; display: inline-flex; align-items: center; gap: 0.25rem; border-radius: 9999px; background: rgba(217, 119, 6, 0.1); color: var(--accent-yellow);">
                                        <span style="width: 5px; height: 5px; background-color: var(--accent-yellow); border-radius: 50%; flex-shrink: 0;"></span> Sedang
                                    </span>
                                @else
                                    <span style="font-size: 0.72rem; font-weight: 700; padding: 0.2rem 0.55rem; display: inline-flex; align-items: center; gap: 0.25rem; border-radius: 9999px; background: var(--accent-emerald-light); color: var(--accent-emerald);">
                                        <span style="width: 5px; height: 5px; background-color: var(--accent-emerald); border-radius: 50%; flex-shrink: 0;"></span> Rendah
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 0.9rem 1rem; vertical-align: middle; text-align: center;">
                                <div style="display: flex; gap: 0.3rem; justify-content: center; align-items: center; flex-wrap: nowrap;">
                                    <button class="btn-modern btn-secondary-modern" style="padding: 0.35rem 0.65rem; border-radius: 8px; font-size: 0.78rem; white-space: nowrap;" onclick="showWargaDetail({{ $w->id }})" title="Detail">
                                        <i class="fa-solid fa-eye"></i> Detail
                                    </button>
                                    <a href="{{ route('warga.edit', $w->id) }}" class="btn-modern btn-primary-modern" style="padding: 0.35rem 0.65rem; border-radius: 8px; font-size: 0.78rem; text-decoration: none; white-space: nowrap;" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    @if(in_array(Auth::user()->role, ['admin', 'petugas']))
                                        <form action="{{ route('warga.destroy', $w->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data warga {{ $w->nama_lengkap }} secara permanen?')" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-modern btn-danger-modern" style="padding: 0.35rem 0.65rem; border-radius: 8px; font-size: 0.78rem; white-space: nowrap;" title="Hapus">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state-card" style="margin: 3rem auto;">
                                    <div class="empty-state-icon-premium">
                                        <i class="fa-solid fa-users-slash"></i>
                                    </div>
                                    <h4 style="font-family: var(--font-heading); font-size: 1.1rem; font-weight: 700; margin-bottom: 0.25rem;">Data Warga Tidak Ditemukan</h4>
                                    <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 1.5rem;">Belum ada data warga terdaftar atau hasil saringan Anda kosong.</p>
                                    <a href="{{ route('warga.create') }}" class="btn-modern btn-primary-modern" style="text-decoration: none;">
                                        <i class="fa-solid fa-plus"></i> Tambah Warga Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Warga Listing (Mobile Card View) -->
    <div class="mobile-only-grid">
        @forelse($wargas as $w)
            @php
                $priority = 'Sedang';
                if ($w->penghasilan <= 1500000 && $w->jumlah_tanggungan >= 3) {
                    $priority = 'Tinggi';
                } elseif ($w->penghasilan > 3000000) {
                    $priority = 'Rendah';
                }
                
                $colors = ['#4f46e5', '#059669', '#d97706', '#06b6d4', '#f43f5e', '#8b5cf6'];
                $colorIndex = (ord(substr($w->nama_lengkap, 0, 1)) - 65) % count($colors);
                $avatarColor = $colors[$colorIndex] ?? '#4f46e5';
            @endphp
            <div class="warga-card-mobile">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 38px; height: 38px; border-radius: 50%; background-color: {{ $avatarColor }}15; color: {{ $avatarColor }}; display: flex; align-items: center; justify-content: center; font-weight: 800; font-family: var(--font-heading); border: 1px solid {{ $avatarColor }}30;">
                            {{ strtoupper(substr($w->nama_lengkap, 0, 1)) }}
                        </div>
                        <div>
                            <h5 style="margin: 0; font-size: 0.9rem; font-weight: 700; color: var(--text-primary);">{{ $w->nama_lengkap }}</h5>
                            <span style="font-size: 0.7rem; color: var(--text-muted); font-family: monospace;">{{ $w->nik }}</span>
                        </div>
                    </div>
                    
                    @if($priority === 'Tinggi')
                        <span class="badge-modern badge-red" style="font-size: 0.65rem; font-weight: 700; padding: 0.1rem 0.4rem;">Tinggi</span>
                    @elseif($priority === 'Sedang')
                        <span class="badge-modern badge-yellow" style="font-size: 0.65rem; font-weight: 700; padding: 0.1rem 0.4rem;">Sedang</span>
                    @else
                        <span class="badge-modern badge-emerald" style="font-size: 0.65rem; font-weight: 700; padding: 0.1rem 0.4rem;">Rendah</span>
                    @endif
                </div>

                <div style="border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color); padding: 0.6rem 0; display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; font-size: 0.75rem;">
                    <div>
                        <span style="color: var(--text-muted); display: block;">Wilayah</span>
                        <strong style="color: var(--text-primary);">{{ $w->desa }}</strong>
                    </div>
                    <div>
                        <span style="color: var(--text-muted); display: block;">Pekerjaan</span>
                        <strong style="color: var(--text-primary);">{{ $w->pekerjaan }}</strong>
                    </div>
                    <div>
                        <span style="color: var(--text-muted); display: block;">Pendapatan</span>
                        <strong style="color: var(--accent-red);">Rp {{ number_format($w->penghasilan, 0, ',', '.') }}</strong>
                    </div>
                    <div>
                        <span style="color: var(--text-muted); display: block;">Tanggungan</span>
                        <strong style="color: var(--text-primary);">{{ $w->jumlah_tanggungan }} Jiwa</strong>
                    </div>
                </div>

                <div style="display: flex; gap: 0.35rem; justify-content: flex-end;">
                    <button class="btn-modern btn-secondary-modern btn-sm-modern" style="padding: 0.35rem 0.7rem; font-size: 0.7rem; border-radius: 6px;" onclick="showWargaDetail({{ $w->id }})">
                        <i class="fa-solid fa-eye"></i> Detail
                    </button>
                    <a href="{{ route('warga.edit', $w->id) }}" class="btn-modern btn-primary-modern btn-sm-modern" style="padding: 0.35rem 0.7rem; font-size: 0.7rem; border-radius: 6px; text-decoration: none;">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                    @if(in_array(Auth::user()->role, ['admin', 'petugas']))
                        <form action="{{ route('warga.destroy', $w->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?')" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-modern btn-danger-modern btn-sm-modern" style="padding: 0.35rem 0.7rem; font-size: 0.7rem; border-radius: 6px;">
                                <i class="fa-solid fa-trash-can"></i> Hapus
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty-state-card" style="padding: 2rem 1rem;">
                <div class="empty-state-icon-premium">
                    <i class="fa-solid fa-users-slash"></i>
                </div>
                <h4 style="font-size: 0.95rem; font-weight: 700; margin-bottom: 0.25rem;">Data Warga Kosong</h4>
                <a href="{{ route('warga.create') }}" class="btn-modern btn-primary-modern" style="text-decoration: none; font-size: 0.75rem; padding: 0.4rem 0.8rem;">Tambah Warga Baru</a>
            </div>
        @endforelse
    </div>

    <!-- Pagination Links -->
    @if($wargas->hasPages())
        <div class="card-modern" style="margin-top: 1.5rem; padding: 1rem 1.5rem; border-radius: var(--radius-xl); border: 1px solid var(--border-color); background: var(--bg-card); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
            <div style="font-size: 0.8rem; color: var(--text-secondary);">
                Menampilkan <strong>{{ $wargas->firstItem() }}</strong> - <strong>{{ $wargas->lastItem() }}</strong> dari <strong>{{ $wargas->total() }}</strong> warga.
            </div>
            <div class="pagination-links">
                {{-- Previous Page --}}
                @if ($wargas->onFirstPage())
                    <span class="pagination-link disabled"><i class="fa-solid fa-chevron-left"></i></span>
                @else
                    <a href="{{ $wargas->previousPageUrl() }}" class="pagination-link"><i class="fa-solid fa-chevron-left"></i></a>
                @endif

                {{-- Page Numbers --}}
                @foreach ($wargas->getUrlRange(1, $wargas->lastPage()) as $page => $url)
                    @if ($page == $wargas->currentPage())
                        <span class="pagination-link active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next Page --}}
                @if ($wargas->hasMorePages())
                    <a href="{{ $wargas->nextPageUrl() }}" class="pagination-link"><i class="fa-solid fa-chevron-right"></i></a>
                @else
                    <span class="pagination-link disabled"><i class="fa-solid fa-chevron-right"></i></span>
                @endif
            </div>
        </div>
    @endif

    <!-- Warga Details Modal Overlay -->
    <div class="modal-overlay" id="detailModal">
        <div class="modal-container" style="max-width: 700px; width: 95%;">
            <div class="modal-header">
                <h3 class="modal-title" style="font-family: var(--font-heading); display: flex; align-items: center; gap: 0.5rem;"><i class="fa-solid fa-id-card" style="color: var(--primary-gradient-start);"></i> Detail Profil Lengkap Warga</h3>
                <button class="modal-close" onclick="closeWargaDetail()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <div class="detail-grid" id="detailGrid" style="margin-bottom: 1.5rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                    <!-- Appended dynamically -->
                </div>
                
                <!-- KTP / KK Photos Panel -->
                <div style="margin-top: 1.5rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem;">
                    <h4 class="form-label-modern" style="margin-bottom: 0.75rem; font-weight: 700; font-family: var(--font-heading); font-size: 0.9rem; color: var(--text-primary);"><i class="fa-solid fa-paperclip" style="color: var(--accent-emerald);"></i> Berkas Dokumen Kependudukan</h4>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div style="background-color: var(--bg-main); border: 1px solid var(--border-color); padding: 0.75rem; border-radius: var(--radius-xl); text-align: center;">
                            <span class="detail-label" style="display: block; margin-bottom: 0.5rem; font-size: 0.7rem; font-weight: 700; color: var(--text-secondary);">Kartu Tanda Penduduk (KTP)</span>
                            <div id="ktpPhotoContainer" style="height: 150px; display: flex; align-items: center; justify-content: center; overflow: hidden; border-radius: 8px; background-color: rgba(226, 232, 240, 0.4); border: 1px dashed var(--border-color);">
                                <i class="fa-regular fa-image" style="font-size: 2rem; color: var(--text-muted);"></i>
                            </div>
                        </div>
                        <div style="background-color: var(--bg-main); border: 1px solid var(--border-color); padding: 0.75rem; border-radius: var(--radius-xl); text-align: center;">
                            <span class="detail-label" style="display: block; margin-bottom: 0.5rem; font-size: 0.7rem; font-weight: 700; color: var(--text-secondary);">Kartu Keluarga (KK)</span>
                            <div id="kkPhotoContainer" style="height: 150px; display: flex; align-items: center; justify-content: center; overflow: hidden; border-radius: 8px; background-color: rgba(226, 232, 240, 0.4); border: 1px dashed var(--border-color);">
                                <i class="fa-regular fa-image" style="font-size: 2rem; color: var(--text-muted);"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding: 1rem 1.5rem; display: flex; justify-content: flex-end; gap: 0.5rem;">
                <button class="btn-modern btn-secondary-modern" style="border-radius: 8px; padding: 0.5rem 1rem;" onclick="closeWargaDetail()">Tutup Detail</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const modal = document.getElementById('detailModal');
        
        function showWargaDetail(id) {
            // Fetch warga data asynchronously
            fetch(`/dashboard/warga/${id}`)
                .then(response => response.json())
                .then(data => {
                    const grid = document.getElementById('detailGrid');
                    
                    // Format Income
                    const incomeFormatted = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        maximumFractionDigits: 0
                    }).format(data.penghasilan);

                    grid.innerHTML = `
                        <div class="detail-item" style="padding: 0.75rem 1rem; border-radius: 12px; background: var(--bg-main); border: 1px solid var(--border-color);">
                            <span class="detail-label" style="font-size: 0.65rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">NIK (Nomor Induk Kependudukan)</span>
                            <span class="detail-value" style="font-family: monospace; font-size: 1rem; color: var(--primary-gradient-start); font-weight: 700;">${data.nik}</span>
                        </div>
                        <div class="detail-item" style="padding: 0.75rem 1rem; border-radius: 12px; background: var(--bg-main); border: 1px solid var(--border-color);">
                            <span class="detail-label" style="font-size: 0.65rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Nama Lengkap</span>
                            <span class="detail-value" style="font-weight: 700; color: var(--text-primary);">${data.nama_lengkap}</span>
                        </div>
                        <div class="detail-item" style="padding: 0.75rem 1rem; border-radius: 12px; background: var(--bg-main); border: 1px solid var(--border-color);">
                            <span class="detail-label" style="font-size: 0.65rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Wilayah Desa</span>
                            <span class="detail-value" style="font-weight: 700; color: var(--text-primary);">${data.desa}</span>
                        </div>
                        <div class="detail-item" style="padding: 0.75rem 1rem; border-radius: 12px; background: var(--bg-main); border: 1px solid var(--border-color);">
                            <span class="detail-label" style="font-size: 0.65rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Alamat Rumah</span>
                            <span class="detail-value" style="font-weight: 700; color: var(--text-primary);">${data.alamat}</span>
                        </div>
                        <div class="detail-item" style="padding: 0.75rem 1rem; border-radius: 12px; background: var(--bg-main); border: 1px solid var(--border-color);">
                            <span class="detail-label" style="font-size: 0.65rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Rukun Tetangga & Rukun Warga</span>
                            <span class="detail-value" style="font-weight: 700; color: var(--text-primary);">RT ${data.rt} / RW ${data.rw}</span>
                        </div>
                        <div class="detail-item" style="padding: 0.75rem 1rem; border-radius: 12px; background: var(--bg-main); border: 1px solid var(--border-color);">
                            <span class="detail-label" style="font-size: 0.65rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Nomor Telepon</span>
                            <span class="detail-value" style="font-weight: 700; color: var(--text-primary);">${data.no_hp || '-'}</span>
                        </div>
                        <div class="detail-item" style="padding: 0.75rem 1rem; border-radius: 12px; background: var(--bg-main); border: 1px solid var(--border-color);">
                            <span class="detail-label" style="font-size: 0.65rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Pekerjaan Utama</span>
                            <span class="detail-value" style="font-weight: 700; color: var(--text-primary);">${data.pekerjaan}</span>
                        </div>
                        <div class="detail-item" style="padding: 0.75rem 1rem; border-radius: 12px; background: var(--bg-main); border: 1px solid var(--border-color);">
                            <span class="detail-label" style="font-size: 0.65rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Pendapatan Bulanan</span>
                            <span class="detail-value" style="font-weight: 800; color: var(--accent-red);">${incomeFormatted}</span>
                        </div>
                        <div class="detail-item" style="padding: 0.75rem 1rem; border-radius: 12px; background: var(--bg-main); border: 1px solid var(--border-color);">
                            <span class="detail-label" style="font-size: 0.65rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Tanggungan Keluarga</span>
                            <span class="detail-value" style="font-weight: 700; color: var(--text-primary);">${data.jumlah_tanggungan} Jiwa</span>
                        </div>
                        <div class="detail-item" style="padding: 0.75rem 1rem; border-radius: 12px; background: var(--bg-main); border: 1px solid var(--border-color);">
                            <span class="detail-label" style="font-size: 0.65rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Kondisi Fisik Rumah</span>
                            <span class="detail-value" style="font-weight: 700; color: var(--text-primary); font-size: 0.8rem;">${data.kondisi_rumah}</span>
                        </div>
                        <div class="detail-item" style="padding: 0.75rem 1rem; border-radius: 12px; background: var(--bg-main); border: 1px solid var(--border-color);">
                            <span class="detail-label" style="font-size: 0.65rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Aset Berharga</span>
                            <span class="detail-value" style="font-weight: 700; color: var(--text-primary); font-size: 0.8rem;">${data.kepemilikan_aset}</span>
                        </div>
                        <div class="detail-item" style="padding: 0.75rem 1rem; border-radius: 12px; background: var(--bg-main); border: 1px solid var(--border-color);">
                            <span class="detail-label" style="font-size: 0.65rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Status Bantuan Sosial Sebelumnya</span>
                            <span class="detail-value">
                                <span class="badge-modern ${
                                    data.status_bantuan_sebelumnya === 'Belum Pernah' ? 'badge-blue' :
                                    (data.status_bantuan_sebelumnya === 'Pernah (Aktif)' ? 'badge-emerald' : 'badge-yellow')
                                }" style="font-size: 0.7rem; font-weight: 700; display: inline-block; padding: 0.15rem 0.5rem; margin-top: 0.15rem;">${data.status_bantuan_sebelumnya}</span>
                            </span>
                        </div>
                    `;

                    // Render KTP image
                    const ktpContainer = document.getElementById('ktpPhotoContainer');
                    if (data.foto_ktp) {
                        ktpContainer.innerHTML = `<img src="${data.foto_ktp}" style="max-width: 100%; max-height: 100%; object-fit: contain; border-radius: 6px;" alt="Foto KTP">`;
                    } else {
                        ktpContainer.innerHTML = `<div style="text-align: center; color: var(--text-muted);"><i class="fa-regular fa-image" style="font-size: 1.5rem; display: block; margin-bottom: 0.25rem;"></i><span style="font-size: 0.7rem;">Belum Dilampirkan</span></div>`;
                    }

                    // Render KK image
                    const kkContainer = document.getElementById('kkPhotoContainer');
                    if (data.foto_kk) {
                        kkContainer.innerHTML = `<img src="${data.foto_kk}" style="max-width: 100%; max-height: 100%; object-fit: contain; border-radius: 6px;" alt="Foto KK">`;
                    } else {
                        kkContainer.innerHTML = `<div style="text-align: center; color: var(--text-muted);"><i class="fa-regular fa-image" style="font-size: 1.5rem; display: block; margin-bottom: 0.25rem;"></i><span style="font-size: 0.7rem;">Belum Dilampirkan</span></div>`;
                    }

                    // Open Modal
                    modal.classList.add('active');
                })
                .catch(err => {
                    showToast('Kesalahan', 'Gagal memuat profil data warga.', 'error');
                });
        }

        function closeWargaDetail() {
            modal.classList.remove('active');
        }

        // Close on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.classList.contains('active')) {
                closeWargaDetail();
            }
        });
    </script>
@endsection
