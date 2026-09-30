<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PPMPP</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inclusive+Sans&family=Jost:wght@500;600;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    @vite(['resources/css/dashboard.css', 'resources/js/dashboard.js'])
</head>

<body>
    <div class="dashboard-wrapper">
        <aside class="sidebar" id="sidebar">

            <div class="sidebar-logo">
                <img src="{{ asset('logo.png') }}" alt="Logo PPMPP">

                <div class="sidebar-logo-text">
                    <h2>PPMPP</h2>
                    <p>Pusat Penjaminan Mutu dan Pengembangan Pembelajaran</p>
                </div>
            </div>

            <nav class="sidebar-menu">
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard') }}" class="menu-item active">
                        <svg viewBox="0 0 24 24">
                            <path d="M4 11L12 4L20 11V20H4V11Z" />
                            <path d="M9 20V14H15V20" />
                        </svg>
                        <span>HOME</span>
                    </a>

                    <a href="{{ route('profil') }}" class="menu-item">
                        <svg viewBox="0 0 24 24">
                            <rect x="5" y="4" width="14" height="16" rx="1" />
                            <path d="M9 8H15" />
                            <path d="M9 12H15" />
                            <path d="M9 16H13" />
                        </svg>
                        <span>PROFIL</span>
                    </a>

                    <a href="{{ route('visimisi') }}" class="menu-item">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="8" />
                            <circle cx="12" cy="12" r="2" />
                        </svg>
                        <span>VISI & MISI</span>
                    </a>

                    <a href="{{ route('strukturorganisasi') }}" class="menu-item">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="5" r="2.5" />
                            <circle cx="6" cy="17" r="2.5" />
                            <circle cx="18" cy="17" r="2.5" />
                            <path d="M12 7.5V12" />
                            <path d="M12 12L6 14.5" />
                            <path d="M12 12L18 14.5" />
                        </svg>
                        <span>STRUKTUR ORGANISASI</span>
                    </a>

                    <a href="{{ route('berita') }}" class="menu-item">
                        <svg viewBox="0 0 24 24">
                            <rect x="5" y="4" width="14" height="16" />
                            <path d="M8 8H16" />
                            <path d="M8 12H16" />
                            <path d="M8 16H16" />
                        </svg>
                        <span>BERITA</span>
                    </a>

                    <a href="{{ route('faq') }}" class="menu-item">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9"></circle>
                            <path d="M9.5 9a2.5 2.5 0 1 1 4.2 1.8c-.9.7-1.7 1.1-1.7 2.2"></path>
                            <path d="M12 16h.01"></path>
                        </svg>
                        <span>FAQ</span>
                    </a>

                    <a href="{{ route('layanan') }}" class="menu-item">
                        <svg viewBox="0 0 24 24">
                            <path d="M4 5h16v14H4z"></path>
                            <path d="M8 9h8"></path>
                            <path d="M8 13h8"></path>
                            <path d="M8 17h5"></path>
                        </svg>
                        <span>DOKUMEN</span>
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf

                        <button type="submit" class="menu-item logout-button">
                            <svg viewBox="0 0 24 24">
                                <path d="M10 5H6C4.9 5 4 5.9 4 7V17C4 18.1 4.9 19 6 19H10" />
                                <path d="M14 8L18 12L14 16" />
                                <path d="M18 12H9" />
                            </svg>

                            <span>KELUAR</span>
                        </button>
                    </form>
                @elseif (Auth::user()->role === 'penulis')
                    <a href="{{ route('dashboard') }}" class="menu-item active">
                        <svg viewBox="0 0 24 24">
                            <path d="M4 11L12 4L20 11V20H4V11Z" />
                            <path d="M9 20V14H15V20" />
                        </svg>

                        <span>HOME</span>
                    </a>

                    <a href="{{ route('berita') }}" class="menu-item">
                        <svg viewBox="0 0 24 24">
                            <rect x="5" y="4" width="14" height="16" />
                            <path d="M8 8H16" />
                            <path d="M8 12H16" />
                            <path d="M8 16H16" />
                        </svg>

                        <span>BERITA</span>
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf

                        <button type="submit" class="menu-item logout-button">
                            <svg viewBox="0 0 24 24">
                                <path d="M10 5H6C4.9 5 4 5.9 4 7V17C4 18.1 4.9 19 6 19H10" />
                                <path d="M14 8L18 12L14 16" />
                                <path d="M18 12H9" />
                            </svg>

                            <span>KELUAR</span>
                        </button>
                    </form>
                @endif

            </nav>

            <div class="sidebar-copyright">
                © 2026 Politeknik Negeri Pontianak. Hak cipta dilindungi undang-undang.
            </div>

        </aside>

        <main class="main-content">
            <header class="topbar">

                <div class="topbar-left">
                    <button class="hamburger" id="hamburger" type="button">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <h1>Dashboard</h1>
                </div>

                <div class="topbar-right">
                    <div class="notification">
                        <svg class="notification-icon" viewBox="0 0 24 24">
                            <path d="M18 8C18 5.79 16.21 4 14 4H10C7.79 4 6 5.79 6 8V13L4 16H20L18 13V8Z" />
                            <path d="M10 20H14" />
                        </svg>
                        <span class="notification-badge">3</span>
                    </div>

                    @auth
                        <div class="dashboard-user">
                            <i class="bi bi-person-circle"></i>
                            <span>{{ Auth::user()->name }}</span>
                        </div>
                    @endauth
                </div>
            </header>

            <section class="dashboard-content">
                @if (Auth::user()->role === 'admin')
                    <div class="dashboard-card">
                        <div class="card-title">CRUD KONTEN</div>
                        <div class="getting-content">

                            <div class="getting-item">
                                <a href="{{ route('dashboard.konten.create') }}" class="crud-action">
                                    <h3>
                                        <span class="check-icon">+</span>
                                        Tambah Konten
                                    </h3>
                                    <p>Tambah konten baru untuk memperlengkapi PPMPP menjadi lebih baik.</p>
                                </a>
                            </div>
                            <div class="getting-item">
                                <button type="button" class="crud-button" id="openEditContent">
                                    <h3><span class="check-icon">=</span>Edit Konten</h3>
                                    <p>Edit informasi untuk mengupdate atau memperbaiki kesalahan</p>
                                </button>
                            </div>

                            <a href="{{ route('dashboard.konten.delete') }}" class="getting-item">
                                <h3>
                                    <span class="check-icon">-</span>Hapus Konten
                                </h3>
                                <p>Jika ada konten yang sudah tidak dipakai dapat dihapus</p>
                            </a>
                        </div>
                    </div>
                @elseif (Auth::user()->role === 'penulis')
                    <div class="dashboard-card">
                        <div class="card-title">
                            CRUD BERITA
                        </div>

                        <div class="getting-content">
                            <div class="getting-item">
                                <a href="{{ route('dashboard.konten.create.existing', ['jenis' => 'berita']) }}"
                                    class="crud-button">

                                    <h3>
                                        <span class="check-icon">+</span>
                                        Tambah Berita
                                    </h3>

                                    <p>Tambahkan berita terbaru ke dalam website PPMPP.</p>
                                </a>
                            </div>

                            <div class="getting-item">
                                <a href="{{ route('dashboard.konten.edit', ['jenis' => 'berita', 'mode' => 'detail']) }}"
                                    class="crud-button">
                                    <h3><span class="check-icon">=</span>Edit Berita</h3>
                                    <p>Edit atau perbarui detail berita yang sudah tersedia.</p>
                                </a>
                            </div>

                            <div class="getting-item">
                                <a href="{{ route('dashboard.konten.edit', ['jenis' => 'berita', 'mode' => 'hapus']) }}"
                                    class="crud-button">
                                    <h3><span class="check-icon">-</span>Hapus Berita</h3>
                                    <p>Hapus berita yang sudah tidak diperlukan.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="dashboard-card">
                    <div class="card-title">Berita Terbaru</div>
                    <div class="table-wrapper">
                        <table class="dashboard-table">
                            <tbody>
                                @forelse ($beritaTerbaru as $index => $berita)
                                    <tr>
                                        <td class="number">{{ $index + 1 }}.</td>
                                        <td>{{ $berita->judul }}</td>
                                        <td>{{ $berita->created_at->format('d F Y') }}</td>
                                        <td>Oleh {{ $berita->detailBerita->penulis ?? 'PPMPP' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            Belum ada berita.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if (Auth::user()->role === 'admin')
                    <div class="dashboard-card">
                        <div class="card-title">
                            Penambahan Fitur
                        </div>

                        <div class="table-wrapper">
                            <table class="dashboard-table">
                                <tbody>
                                    <tr>
                                        <td class="number">1.</td>
                                        <td>Pembukaan WEB PPMPP POLNEP Pontianak</td>
                                        <td>12 Juli 2026</td>
                                        <td>Oleh admin PPMPP</td>
                                    </tr>

                                    <tr>
                                        <td class="number">2.</td>
                                        <td>Penambahan fitur Berita tersedia</td>
                                        <td>13 Juli 2026</td>
                                        <td>Oleh admin PPMPP</td>
                                    </tr>

                                    <tr>
                                        <td class="number">3.</td>
                                        <td>Penambahan fitur detail berita</td>
                                        <td>17 Juli 2026</td>
                                        <td>Oleh admin PPMPP</td>
                                    </tr>

                                    <tr>
                                        <td class="number">4.</td>
                                        <td>Penmbaruan fitur tombol pencariaan</td>
                                        <td>1 Agustus 2026</td>
                                        <td>Oleh admin PPMPP</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </section>
        </main>
    </div>

    <div class="edit-modal" id="editModal">

        <div class="edit-modal-box">
            <div class="edit-modal-header">
                <div class="edit-modal-title">
                    <i class="bi bi-pencil-square"></i>
                    <span>Edit Konten PPMPP</span>
                </div>
                <button type="button" class="edit-modal-close" id="closeEditContent">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <div class="edit-modal-body">
                <p class="edit-modal-description">Pilih fitur yang ingin kamu edit.</p>

                <a href="{{ route('dashboard.konten.edit', ['jenis' => 'profil']) }}" class="edit-feature">
                    <div class="edit-feature-icon">
                        <i class="bi bi-file-text"></i>
                    </div>

                    <div class="edit-feature-text">
                        <h3>PROFIL</h3>
                        <p>Edit informasi dan isi halaman Profil.</p>
                    </div>
                    <i class="bi bi-chevron-right edit-feature-arrow"></i>
                </a>

                <a href="{{ route('dashboard.konten.edit', ['jenis' => 'visimisi']) }}" class="edit-feature">
                    <div class="edit-feature-icon">
                        <i class="bi bi-record-circle"></i>
                    </div>

                    <div class="edit-feature-text">
                        <h3>VISI & MISI</h3>
                        <p>Edit visi dan misi PPMPP.</p>
                    </div>
                    <i class="bi bi-chevron-right edit-feature-arrow"></i>
                </a>

                <a href="{{ route('dashboard.konten.edit', ['jenis' => 'struktur']) }}" class="edit-feature">
                    <div class="edit-feature-icon">
                        <i class="bi bi-diagram-3"></i>
                    </div>

                    <div class="edit-feature-text">
                        <h3>STRUKTUR ORGANISASI</h3>
                        <p>Edit struktur organisasi PPMPP.</p>
                    </div>
                    <i class="bi bi-chevron-right edit-feature-arrow"></i>
                </a>

                <a href="{{ route('dashboard.faq.edit') }}" class="edit-feature">
                    <div class="edit-feature-icon">
                        <i class="bi bi-question-circle"></i>
                    </div>

                    <div class="edit-feature-text">
                        <h3>FAQ</h3>
                        <p>Edit pertanyaan dan jawaban FAQ.</p>
                    </div>

                    <i class="bi bi-chevron-right edit-feature-arrow"></i>
                </a>

                <a href="{{ route('dashboard.konten.edit', ['jenis' => 'dokumen']) }}" class="edit-feature">
                    <div class="edit-feature-icon">
                        <i class="bi bi-file-earmark"></i>
                    </div>

                    <div class="edit-feature-text">
                        <h3>DOKUMEN</h3>
                        <p>Edit dan kelola dokumen PPMPP.</p>
                    </div>

                    <i class="bi bi-chevron-right edit-feature-arrow"></i>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
