<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
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

    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Profil</a></li>
                <li><a href="#">Pembelajaran</a></li>
                <li><a href="#">Layanan</a></li>
                <li><a href="#">Berita</a></li>
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
    <div class="search-modal" id="searchModal">
        <div class="search-content">
            <div class="search-header">
                <i class="bi bi-search"></i>
                <input type="text" id="searchInput" placeholder="Cari berita, layanan, atau halaman...">
                <button class="close-btn">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="search-body">
                Ketik kata kunci untuk mulai mencari.
            </div>
        </div>
    </div>

    <div class="overlay"></div>
    <section class="hero" style="background-image: url('{{ asset('Gedung.jpeg') }}');">

        <div class="hero-content">
            <h1>UNIT PPMPP</h1>
            <h2>Pusat Penjaminan Mutu dan Pengembangan Pembelajaran</h2>
            <p>Unit kami mengawasi dan memastikan semua jurusan dan kelas Polnep memiliki kualitas yang sangat baik dan
                sesuai dengan peraturan pemerintah.</p>
            <div class="button-group">
                <button>Lihat Layanan <span>›</span></button>
                <button>Tentang Kami <span>›</span></button>
            </div>
        </div>
        </div>
    </section>

    <footer class= "footer">
        <div class="footer-top">
            <div class="footer-left">
                <div class= "footer-logo">
                    <img src="{{ asset('logo.png') }}" alt="Logo">
                    <div>
                        <h2>PPMPP</h2>
                        <p>Pusat Penjaminan Mutu dan Pengmebangan Pembelajaran</p>
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
                    <span>Jl. Ahmad Yani, Bansir Darat,
                        Pontianak Tenggara, Kalimantan Barat 78124</span>
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
