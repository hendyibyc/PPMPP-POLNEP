<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judulBagian }} - PPMPP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    @vite(['resources/css/edit/konten.css', 'resources/js/delete.js'])
</head>
<body>
    <div class="edit-container">
        <div class="edit-header">
            <h1>{{ $judulBagian }}</h1>
            <p>Pilih konten yang ingin dihapus.</p>
        </div>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($kontens->count() > 0)

            <div class="berita-detail-list">

                @foreach ($kontens as $konten)

                    <div class="delete-option">

                        <div class="berita-detail-number">
                            {{ $loop->iteration }}.
                        </div>

                        <div class="berita-detail-option-content">
                            <h2>{{ $konten->judul_konten ?? $konten->judul }}</h2>
                        </div>

                        <button type="button" class="btn-delete-detail" onclick="openDeleteModal('{{ $konten->id }}')">
                            <i class="bi bi-trash3"></i>
                        </button>

                    </div>

                @endforeach

            </div>

        @else

            <div class="empty-content">
                <i class="bi bi-inbox"></i>
                <h2>Belum ada konten</h2>
                <p>Tidak ada konten yang dapat dihapus.</p>
            </div>

        @endif

        <div class="bottom-back">
            <a href="{{ route('dashboard.konten.delete') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="delete-modal" id="deleteModal">
        <div class="delete-modal-box">
            <div class="delete-modal-icon">
                <i class="bi bi-trash3"></i>
            </div>

            <h2>Hapus Konten?</h2>
            <p>Konten yang dihapus tidak dapat dikembalikan. Apakah kamu yakin ingin menghapus konten ini?</p>

            <div class="delete-modal-actions">
                <button type="button" class="btn-cancel-delete" onclick="closeDeleteModal()">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn-confirm-delete">
                        <i class="bi bi-trash3"></i>
                        Iya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
