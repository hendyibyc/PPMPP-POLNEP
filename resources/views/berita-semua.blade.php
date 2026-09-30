<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Berita PPMPP</title>
    <!-- Fonts inclusive sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inclusive+Sans&display=swap" rel="stylesheet">

    <!-- Fonts Jost -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@700&display=swap" rel="stylesheet">

    <!-- Fonts Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">

    <!-- Fonts Jua -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">

    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/css/berita.css', 'resources/css/berita-semua.css', 'resources/js/app.js', 'resources/js/berita-semua.js'])
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('logo.png') }}" alt="Logo">
            <div>
                <h1>PPMPP</h1>
                <p>Pusat Penjaminan Mutu dan Pengembagan Pembelajaran</p>
            </div>
        </div>

        <div class="nav-menu">
            <ul class="menu">
                <li><a href="{{ route('home') }}">Beranda</a></li>

                <li class="profile-menu">
                    <button type="button" class="profile-button" id="profileButton"><span>Profil</span><span
                            id="profileArrow">›</span></button>

                    <div class="profile-dropdown" id="profileDropdown">
                        <a href="{{ route('profil') }}">Profil</a>
                        <a href="{{ route('visimisi') }}">Visi & Misi</a>
                        <a href="{{ route('strukturorganisasi') }}">Struktur Organisasi</a>
                    </div>
                </li>

                <li><a href="{{ 'berita' }}">Berita</a></li>
                <li><a href="{{ 'faq' }}">FAQ</a></li>
                <li><a href="{{ 'layanan' }}">Layanan</a></li>
            </ul>

            <button class="search-btn">
                <i class="bi bi-search"></i>
            </button>

            @auth
                <div class="user-dropdown">
                    <button class="user-button" type="button" id="userButton">
                        <i class="bi bi-person-circle"></i>
                        {{ Auth::user()->name }}
                        <i class="bi bi-chevron-down"></i>
                    </button>

                    <div class="user-dropdown-menu" id="userDropdownMenu">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">
                                <i class="bi bi-box-arrow-right"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            <button class="menu-toggle">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </nav>

    <main class="berita-semua-page">
        <div class="berita-semua-container">
            <div class="berita-semua-heading">
                <h1>LIHAT SEMUA BERITA</h1>
                <p>Pilih berita yang ingin dibaca</p>
            </div>

            <div class="berita-search">
                <i class="bi bi-search"></i>
                <input type="text" id="searchBerita" placeholder="Temukan katalog" autocomplete="off">
            </div>

            <div class="berita-list" id="beritaList">
                @forelse ($kontens as $index => $konten)
                    <article class="berita-item" data-title="{{ strtolower($konten->judul) }}">
                        <div class="berita-number">
                            {{ $konten->urutan ?? $index + 1 }}.
                        </div>

                        <div class="berita-content">
                            <h2>{{ $konten->judul }}</h2>
                            <p>{{ $konten->isi }}</p>
                        </div>

                        <a href="{{ route('berita.detail', $konten->id) }}" class="berita-button" title="Baca berita">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </article>

                @empty
                    <div class="berita-empty">
                        Belum ada berita yang tersedia.
                    </div>
                @endforelse
            </div>

            <div id="beritaTidakDitemukan" class="berita-empty" style="display: none;">
                Berita yang dicari tidak ditemukan.
            </div>

            <a href="{{ route('berita') }}" class="berita-back">
                ← Kembali
            </a>
        </div>
    </main>

    <footer class= "footer">
        <div class="footer-top">
            <div class="footer-left">
                <div class= "footer-logo">
                    <img src="{{ asset('logo.png') }}" alt="Logo">
                    <div>
                        <h2>PPMPP</h2>
                        <p>Pusat Penjaminan Mutu dan Pengembangan Pembelajaran</p>
                    </div>
                </div>

                <div class="footer-social">
                    <h3>Media Sosial</h3>
                    <div class="social-icons">
                        <a href="www.youtube.com/@mediapolnep" target="_blank">
                            <i class="bi bi-youtube"></i>
                        </a>

                        <a href="https://www.instagram.com/mediapolnep?igsh=MWJhcmdiZ2R3Mmljbg==" target="_blank">
                            <i class="bi bi-instagram"></i>
                        </a>

                        <a href="#" target="_blank">
                            <i class="bi bi-twitter-x"></i>
                        </a>

                        <a href="#" target="_blank">
                            <i class="bi bi-telegram"></i>
                        </a>

                        <a href="https://www.facebook.com/share/14oqJnVqhzD/" target="_blank">
                            <i class="bi bi-facebook"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="footer-info">
                <h3>Informasi Kami</h3>
                <div class="info-item">
                    <i class="bi bi-geo-alt"></i>
                    <span>Jl. Ahmad Yani, Bansir Darat, Pontianak Tenggara, Kalimantan Barat 78124</span>
                </div>

                <div class="info-item">
                    <i class="bi bi-telephone"></i>
                    <span>+62 123-456-789</span>
                </div>

                <div class="info-item">
                    <i class="bi bi-envelope"></i>
                    <span>polnep@123.com</span>
                </div>

                <div class="info-item">
                    <i class="bi bi-clock"></i>
                    <span>Senin–Jumat, 08.00–16.00 WIB</span>
                </div>
            </div>

            <div class="footer-links">
                <h3>Tautan Cepat</h3>
                <a href="#">Berita Terkini</a>
                <a href="#">Profil Polnep</a>
                <a href="#">Visi & Misi</a>
                <a href="#">Akreditasi</a>
                <a href="#">Galeri</a>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© 2026 Politeknik Negeri Pontianak. Hak cipta dilindungi undang-undang.</p>
        </div>
    </footer>
</body>
</html>
