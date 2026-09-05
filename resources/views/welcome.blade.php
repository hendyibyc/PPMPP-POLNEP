<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPMPP | Pusat Penjaminan Mutu dan Pengembangan Pembelajaran</title>
    @vite(['resources/css/welcome.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inclusive+Sans&family=Jost:wght@400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="welcome-page">
        <header class="header">
            <div class="logo">
                <img src="{{ asset('logo.png') }}" alt="Logo PPMPP">
                <div>
                    <h1>PPMPP</h1>
                    <p>Pusat Penjaminan Mutu dan Pengembangan Pembelajaran</p>
                </div>
            </div>
        </header>

        <main class="welcome-main">
            <div class="welcome-content">
                <span class="welcome-label">SISTEM INFORMASI PPMPP</span>
                <h2>Selamat Datang di <span>PPMPP</span></h2>
                <p class="welcome-description">Silakan pilih akses yang ingin Anda gunakanuntuk melanjutkan ke sistem informasi PPMPP.</p>


                <div class="auth-table">
                    <a href="{{ route('login') }}" class="auth-row">
                        <div class="auth-icon">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 3H19C20.1 3 21 3.9 21 5V19C21 20.1 20.1 21 19 21H15" stroke="currentColor"
                                    stroke-width="1.8" stroke-linecap="round" />
                                <path d="M10 17L15 12L10 7" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15 12H3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="auth-info">
                            <h3>Login</h3>
                            <p>Masuk menggunakan akun yang sudah terdaftar.</p>
                        </div>
                        <div class="auth-arrow">→</div>
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="auth-row">
                            <div class="auth-icon register-icon">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="9" cy="8" r="3" stroke="currentColor"
                                        stroke-width="1.8" />
                                    <path d="M3 20C3 16.69 5.69 14 9 14C12.31 14 15 16.69 15 20" stroke="currentColor"
                                        stroke-width="1.8" stroke-linecap="round" />
                                    <path d="M19 8V14" stroke="currentColor" stroke-width="1.8"
                                        stroke-linecap="round" />
                                    <path d="M16 11H22" stroke="currentColor" stroke-width="1.8"
                                        stroke-linecap="round" />
                                </svg>
                            </div>
                            <div class="auth-info">
                                <h3>Register</h3>
                                <p>Buat akun baru untuk menggunakan sistem.</p>
                            </div>
                            <div class="auth-arrow">→</div>
                        </a>
                    @endif
                </div>
            </div>
        </main>

        <footer class="footer">
            © {{ date('Y') }} Politeknik Negeri Pontianak. Hak cipta dilindungi undang-undang.
        </footer>
    </div>
</body>

</html>
