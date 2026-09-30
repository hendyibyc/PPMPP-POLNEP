<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @if ($jenis === 'berita')
            Tambah Berita
        @elseif ($jenis === 'dokumen')
            Tambah Dokumen
        @elseif ($jenis === 'profil')
            Tambah Profil
        @elseif ($jenis === 'visimisi')
            Tambah Visi & Misi
        @elseif ($jenis === 'struktur')
            Tambah Struktur Organisasi
        @else
            Tambah Konten
        @endif
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inclusive+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Jost:wght@700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    @vite(['resources/css/tambah.css'])
</head>
<body>
    <main class="tambah-page">
        <div class="tambah-header">
            <h1>
                @if ($jenis === 'berita')
                    Tambah Berita
                @elseif ($jenis === 'dokumen')
                    Tambah Dokumen
                @elseif ($jenis === 'profil')
                    Tambah Profil
                @elseif ($jenis === 'visimisi')
                    Tambah Visi & Misi
                @elseif ($jenis === 'struktur')
                    Tambah Struktur Organisasi
                @else
                    Tambah Konten
                @endif
            </h1>

            <p>
                @if ($jenis === 'berita')
                    Tambahkan berita baru ke dalam halaman PPMPP.
                @elseif ($jenis === 'dokumen')
                    Tambahkan dokumen baru ke dalam layanan PPMPP.
                @elseif ($jenis === 'profil')
                    Tambahkan konten baru ke dalam halaman Profil PPMPP.
                @elseif ($jenis === 'visimisi')
                    Tambahkan konten baru ke dalam halaman Visi & Misi PPMPP.
                @elseif ($jenis === 'struktur')
                    Tambahkan konten baru ke dalam Struktur Organisasi PPMPP.
                @else
                    Tambahkan konten baru ke dalam halaman PPMPP.
                @endif
            </p>
        </div>

        @if (session('success'))
            <div class="alert-success">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="alert-error">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                <i class="bi bi-exclamation-circle-fill"></i>

                <div>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <form action="{{ route('konten.store') }}" method="POST" enctype="multipart/form-data" class="tambah-form">
            @csrf
            <input type="hidden" name="jenis" value="{{ $jenis }}">
            @if ($jenis === 'berita')

                <div class="form-group">
                    <label for="judul">Judul Berita</label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Masukkan judul berita" required>
                </div>

                <div class="form-group">
                    <label for="isi">Isi Berita</label>
                    <textarea id="isi" name="isi" placeholder="Masukkan isi berita" required>{{ old('isi') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" id="gambar" name="gambar" accept=".jpg,.jpeg,.png,.webp">

                    <small>Format JPG, JPEG, PNG atau WEBP. Maksimal 5 MB.</small>
                </div>

                <div class="form-group">
                    <label for="urutan">Urutan</label>
                    <input type="number" id="urutan" name="urutan" value="{{ old('urutan', 0) }}" min="0">
                </div>

            @elseif ($jenis === 'dokumen')

                <div class="form-group">
                    <label for="judul_konten">Judul Dokumen</label>
                    <input type="text" id="judul_konten" name="judul_konten" value="{{ old('judul_konten') }}" placeholder="Masukkan judul dokumen" required>
                </div>

                <div class="form-group">
                    <label for="subjudul">Subjudul</label>
                    <input type="text" id="subjudul" name="subjudul" value="{{ old('subjudul') }}" placeholder="Masukkan subjudul dokumen">
                </div>

                <div class="form-group">
                    <label for="file_dokumen">File Dokumen</label>
                    <input type="file" id="file_dokumen" name="file_dokumen" accept=".pdf" required>

                    <small>Format PDF. Maksimal 10 MB.</small>
                </div>

                <div class="form-group">
                    <label for="urutan">Urutan</label>
                    <input type="number" id="urutan" name="urutan" value="{{ old('urutan', 0) }}" min="0">
                </div>

            @else

                <div class="form-group">
                    <label for="judul_konten">Judul Konten</label>
                    <input type="text" id="judul_konten" name="judul_konten" value="{{ old('judul_konten') }}" placeholder="Masukkan judul konten" required>
                </div>

                <div class="form-group">
                    <label for="subjudul">Subjudul</label>
                    <input type="text" id="subjudul" name="subjudul" value="{{ old('subjudul') }}" placeholder="Masukkan subjudul konten">
                </div>

                <div class="form-group">
                    <label for="isi">Isi Konten</label>
                    <textarea id="isi" name="isi" placeholder="Masukkan isi konten" required>{{ old('isi') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" id="gambar" name="gambar" accept=".jpg,.jpeg,.png,.webp">

                    <small>
                        Format JPG, JPEG, PNG atau WEBP. Maksimal 5 MB.
                    </small>
                </div>

                <div class="form-group">
                    <label for="urutan">Urutan</label>
                    <input type="number" id="urutan" name="urutan" value="{{ old('urutan', 0) }}" min="0">
                </div>

            @endif

            <div class="form-actions">
                <button type="submit" class="btn-save">
                    <i class="bi bi-check"></i>
                    Simpan
                </button>

                <a href="{{ route('dashboard') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    Back
                </a>
            </div>
        </form>
    </main>
</body>
</html>
