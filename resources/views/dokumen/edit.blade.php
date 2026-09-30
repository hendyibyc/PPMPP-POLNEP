<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Dokumen PPMPP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inclusive+Sans&family=Jost:wght@500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite([ 'resources/css/dokumen.css','resources/js/dokumen-edit.js'])
</head>
<body>
<main class="document-page">
    <div class="document-container">
        @if(session('success'))
            <div class="success-message">
                <i class="bi bi-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="error-message">
                <i class="bi bi-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="error-message">
                <i class="bi bi-exclamation-circle"></i>

                <div>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="document-heading">
            <h1>EDIT DOKUMEN</h1>
            <p>Kelola dokumen yang ditampilkan pada halaman layanan.</p>
        </div>

        <div class="add-document-section">
            <div class="add-document-header">
                <div>
                    <h2>Tambah Dokumen</h2>
                    <p>Tambahkan dokumen baru ke halaman layanan.</p>
                </div>

                <button type="button" class="add-document-button" id="addDocumentButton">
                    <i class="bi bi-plus-lg"></i>
                    Tambah Dokumen
                </button>
            </div>

            <div class="add-document-form" id="documentAddForm">
                <form action="{{ route('dashboard.dokumen.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="judul_konten">
                                Judul Dokumen
                            </label>

                            <input type="text" id="judul_konten" name="judul_konten" value="{{ old('judul_konten') }}" placeholder="Masukkan judul dokumen" required>
                        </div>

                        <div class="form-group">
                            <label for="subjudul">
                                Keterangan
                            </label>

                            <input type="text" id="subjudul" name="subjudul" value="{{ old('subjudul') }}" placeholder="Masukkan keterangan">
                        </div>

                        <div class="form-group">
                            <label for="urutan">
                                Urutan
                            </label>

                            <input type="number" id="urutan" name="urutan" min="0" value="{{ old('urutan', 0) }}">
                        </div>

                        <div class="form-group">
                            <label for="file_dokumen">
                                File PDF
                            </label>

                            <input type="file" id="file_dokumen" name="file_dokumen" accept=".pdf,application/pdf" required>
                            <small>
                                Maksimal 10 MB dan harus berupa PDF.
                            </small>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="cancel-button" id="cancelAddDocument">
                            Batal
                        </button>

                        <button type="submit" class="save-button"> <i class="bi bi-check-lg"></i>
                            Simpan Dokumen
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="document-list-section">
            <div class="list-heading">
                <h2>Daftar Dokumen</h2>
                <p>Pilih dokumen yang ingin diedit.</p>
            </div>

            <div class="document-list">
                @forelse($dokumens as $index => $dokumen)
                    <div class="document-wrapper">
                        <div class="document-row">
                            <div class="document-number">
                                {{ $index + 1 }}.
                            </div>

                            <div class="document-title">
                                <h3>{{ $dokumen->judul_konten }}</h3>
                                @if($dokumen->subjudul)
                                    <p>{{ $dokumen->subjudul }}</p>
                                @endif
                            </div>

                            <button type="button" class="document-edit-button" data-target="edit-document-{{ $dokumen->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </div>

                        <div class="document-edit-form" id="edit-document-{{ $dokumen->id }}">
                            <form action="{{ route('dashboard.dokumen.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="edit-form-heading">
                                    <i class="bi bi-pencil-square"></i>
                                    <span>Edit Dokumen</span>
                                </div>

                                <div class="form-grid">
                                    <div class="form-group">
                                        <label>Judul Dokumen</label>
                                        <input type="text" name="judul_konten" value="{{ $dokumen->judul_konten }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" name="subjudul" value="{{ $dokumen->subjudul }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Urutan</label>
                                        <input type="number" name="urutan" min="0" value="{{ $dokumen->urutan }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Ganti File PDF</label>
                                        <input type="file" name="file_dokumen" accept=".pdf,application/pdf">
                                        <small>Kosongkan jika PDF tidak ingin diganti.</small>
                                    </div>
                                </div>

                                @if($dokumen->file_dokumen)
                                    <a href="{{ route('dokumen.download', $dokumen->id) }}" target="_blank" class="current-document">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                        Lihat PDF Saat Ini
                                        <i class="bi bi-box-arrow-up-right"></i>
                                    </a>
                                @endif

                                <div class="edit-form-actions">
                                    <button type="button" class="cancel-edit-button">
                                        Batal
                                    </button>
                                    <button type="submit" class="save-edit-button">
                                        <i class="bi bi-check-lg"></i>
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @empty

                    <div class="document-empty">
                        <i class="bi bi-file-earmark-x"></i>
                        <h3>Belum Ada Dokumen</h3>
                        <p>Silakan tambahkan dokumen menggunakan tombol "Tambah Dokumen" di atas.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="document-back">
            <a href="{{ route('dashboard') }}">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>
</main>
</body>
</html>
