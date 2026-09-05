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

                <a href="#" class="menu-item active">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 11L12 4L20 11V20H4V11Z" />
                        <path d="M9 20V14H15V20" />
                    </svg>
                    <span>HOME</span>
                </a>

                <a href="#" class="menu-item">
                    <svg viewBox="0 0 24 24">
                        <rect x="5" y="4" width="14" height="16" rx="1" />
                        <path d="M9 8H15" />
                        <path d="M9 12H15" />
                        <path d="M9 16H13" />
                    </svg>
                    <span>PROFIL</span>
                </a>

                <a href="#" class="menu-item">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="8" />
                        <circle cx="12" cy="12" r="2" />
                    </svg>
                    <span>VISI & MISI</span>
                </a>

                <a href="#" class="menu-item">
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

                <a href="#" class="menu-item">
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
                            <path d="M10 5H6C4.9 5 4 5.9 4 7V17C4 18.1 4.9 19 6 19H10"/>
                            <path d="M14 8L18 12L14 16"/>
                            <path d="M18 12H9"/>
                        </svg>
                        <span>KELUAR</span>
                    </button>
                </form>

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

                    <div class="datetime">
                        <span id="current-date"></span>
                    </div>
                </div>
            </header>


            <section class="dashboard-content">
                <div class="dashboard-card">
                    <div class="card-title">Peraturan dan Prinsip Utama</div>
                    <div class="getting-content">
                        <div class="getting-item">
                            <h3>
                                <span class="check-icon">✓</span>Pelajari Konten
                            </h3>
                            <p>Pahami Maksud dari konten yang disajikan untuk web ini.</p>
                        </div>

                        <div class="getting-item">
                            <h3>
                                <span class="check-icon">✓</span>Teknik Penulisan Konten
                            </h3>
                            <p>Informasi menggunakan bahasa yang mudah dipahami oleh target audiens Anda.</p>
                        </div>

                        <div class="getting-item">
                            <h3>
                                <span class="check-icon">✓</span>Keamanan Konten
                            </h3>
                            <p>Memastikan konten yang disajikan aman dan tidak membahayakan pengguna.</p>
                        </div>

                        <div class="getting-item">
                            <h3>
                                <span class="check-icon">✓</span>Kesesuaian Konten
                            </h3>
                            <p>Pastikan konten yang disajikan sesuai dengan kebutuhan dan harapan pengguna.</p>
                        </div>
                    </div>
                </div>

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


                <div class="dashboard-card">
                    <div class="card-title">Berita Terbaru</div>

                    <div class="table-wrapper">
                        <table class="dashboard-table">
                            <tbody>

                                <tr>
                                    <td class="number">1.</td>
                                    <td>Kampus POLNEP Pontianak Resmi masuk tahun ajaran baru</td>
                                    <td>20 Juli 2026</td>
                                    <td>Oleh admin PPMPP</td>
                                </tr>

                                <tr>
                                    <td class="number">2.</td>
                                    <td>Ulang Tahun POLNEP Pontianak</td>
                                    <td>24 Juli 2026</td>
                                    <td>Oleh admin PPMPP</td>
                                </tr>

                                <tr>
                                    <td class="number">3.</td>
                                    <td>Layanan konsultasi melayani juga di pendidikan</td>
                                    <td>31 Juli 2026</td>
                                    <td>Oleh admin PPMPP</td>
                                </tr>

                                <tr>
                                    <td class="number">4.</td>
                                    <td>Keseruan 17 Agustus di POLNEP Pontianak</td>
                                    <td>17 Agustus 2026</td>
                                    <td>Oleh admin PPMPP</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>
