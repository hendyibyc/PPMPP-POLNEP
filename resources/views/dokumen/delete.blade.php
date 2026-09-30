<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Dokumen PPMPP</title>
    @vite(['resources/css/dokumen-delete.css', 'resources/js/dokumen-delete.js'])
</head>
<body>
    <div class="delete-page">
        <div class="delete-container">
            <div class="page-header">
                <a href="{{ route('dashboard.konten.delete') }}" class="back-button">
                    <span>←</span>
                </a>

                <div class="header-text">
                    <h1>Hapus Dokumen</h1>
                    <p>Pilih dokumen yang ingin dihapus.</p>
                </div>
            </div>

            @if (session('error'))
                <div class="alert error">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('dashboard.dokumen.destroy.selected') }}" method="POST" id="deleteForm">
                @csrf

                <div class="select-header">
                    <label class="select-all">
                        <input type="checkbox" id="selectAll">
                        <span>Pilih semua</span>
                    </label>

                    <span id="selectedCount">
                        0 dipilih
                    </span>
                </div>

                <div class="document-list">
                    @forelse($dokumens as $dokumen)
                        <label class="document-item">
                            <input type="checkbox" name="ids[]" value="{{ $dokumen->id }}" class="document-checkbox">
                            <div class="document-information">
                                <div class="document-icon">
                                    📄
                                </div>

                                <div>
                                    <h3>{{ $dokumen->judul }}</h3>
                                    @if ($dokumen->subjudul)
                                        <p>{{ $dokumen->subjudul }}</p>
                                    @endif
                                </div>
                            </div>
                        </label>

                    @empty

                        <div class="empty-state">
                            <div class="empty-icon">
                                📄
                            </div>
                            <h3>Belum ada dokumen</h3>
                            <p>Tidak ada dokumen yang dapat dihapus.</p>
                        </div>
                    @endforelse
                </div>

                @if ($dokumens->count() > 0)
                    <div class="bottom-action">
                        <button type="button" id="openDeleteModal" class="delete-button">
                            Hapus yang dipilih
                        </button>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <div class="modal-overlay" id="deleteModal">
        <div class="delete-modal">
            <div class="modal-icon">
                !
            </div>

            <h2>Hapus Dokumen?</h2>
            <p>Dokumen yang dipilih beserta file-nya akan dihapus secara permanen.</p>

            <div class="modal-actions">
                <button type="button" id="cancelDelete" class="cancel-button">
                    Batal
                </button>

                <button type="button" id="confirmDelete" class="confirm-button">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</body>

</html>
