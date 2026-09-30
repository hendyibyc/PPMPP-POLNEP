<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Konten - PPMPP</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inclusive+Sans&family=Jost:wght@600;700&family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    @vite(['resources/css/delete-menu.css'])
</head>

<body>
    <div class="delete-menu-page">
        <div class="delete-menu-container">
            <div class="delete-menu-header">
                <div class="delete-menu-title">
                    <div class="delete-menu-icon">
                        <i class="bi bi-trash3"></i>
                    </div>

                    <div>
                        <h1>Hapus Konten</h1>
                        <p>Pilih jenis konten yang ingin dihapus.</p>
                    </div>
                </div>

                <a href="{{ route('dashboard') }}" class="back-button">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
            </div>

            <div class="delete-menu-list">
                <a href="{{ route('dashboard.konten.delete', ['jenis' => 'profil']) }}" class="delete-menu-item">
                    <div class="item-icon">
                        <i class="bi bi-person-vcard"></i>
                    </div>

                    <div class="item-content">
                        <h2>Profil</h2>
                        <p>Hapus konten halaman profil PPMPP.</p>
                    </div>

                    <div class="item-arrow">
                        <i class="bi bi-chevron-right"></i>
                    </div>
                </a>

                <a href="{{ route('dashboard.konten.delete', ['jenis' => 'visimisi']) }}" class="delete-menu-item">
                    <div class="item-icon">
                        <i class="bi bi-bullseye"></i>
                    </div>

                    <div class="item-content">
                        <h2>Visi & Misi</h2>
                        <p>Hapus konten visi dan misi PPMPP.</p>
                    </div>

                    <div class="item-arrow">
                        <i class="bi bi-chevron-right"></i>
                    </div>
                </a>

                <a href="{{ route('dashboard.konten.delete', ['jenis' => 'struktur']) }}" class="delete-menu-item">
                    <div class="item-icon">
                        <i class="bi bi-diagram-3"></i>
                    </div>

                    <div class="item-content">
                        <h2>Struktur Organisasi</h2>
                        <p>Hapus bagian dari struktur organisasi.</p>
                    </div>

                    <div class="item-arrow">
                        <i class="bi bi-chevron-right"></i>
                    </div>
                </a>

                @if (auth()->user()->role === 'admin' || auth()->user()->role === 'penulis')
                    <a href="{{ route('dashboard.konten.delete', ['jenis' => 'berita']) }}" class="delete-menu-item">
                        <div class="item-icon">
                            <i class="bi bi-newspaper"></i>
                        </div>

                        <div class="item-content">
                            <h2>Berita</h2>
                            <p>Hapus berita yang sudah tidak diperlukan.</p>
                        </div>

                        <div class="item-arrow">
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </a>
                @endif

                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('dashboard.konten.delete', ['jenis' => 'faq']) }}" class="delete-menu-item">
                        <div class="item-icon">
                            <i class="bi bi-question-circle"></i>
                        </div>

                        <div class="item-content">
                            <h2>FAQ</h2>
                            <p>Kelola dan hapus pertanyaan FAQ.</p>
                        </div>

                        <div class="item-arrow">
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('dashboard.konten.delete', ['jenis' => 'dokumen']) }}" class="delete-menu-item">
                        <div class="item-icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>

                        <div class="item-content">
                            <h2>Dokumen</h2>
                            <p>Pilih dokumen yang ingin dihapus.</p>
                        </div>

                        <div class="item-arrow">
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
