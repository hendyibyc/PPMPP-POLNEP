<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus FAQ PPMPP</title>
    @vite(['resources/css/faq-delete.css', 'resources/js/faq-delete.js'])
</head>

<body>
    <div class="delete-page">
        <div class="delete-container">
            <div class="page-header">
                <a href="{{ route('dashboard.konten.delete') }}" class="back-button">
                    <span>←</span>
                </a>

                <div class="header-text">
                    <h1>Hapus FAQ</h1>
                    <p>Pilih FAQ yang ingin dihapus.</p>
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

            <form action="{{ route('dashboard.faq.destroy.selected') }}" method="POST" id="deleteForm">

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

                <div class="faq-list">
                    @forelse($faqs as $faq)
                        <label class="faq-item">
                            <input type="checkbox" name="ids[]" value="{{ $faq->id }}" class="faq-checkbox">
                            <div class="faq-information">
                                <h3>{{ $faq->pertanyaan }}</h3>

                                @if ($faq->kategori)
                                    <span class="faq-category">
                                        {{ $faq->kategori }}
                                    </span>
                                @endif
                            </div>
                        </label>

                    @empty

                        <div class="empty-state">
                            <div class="empty-icon">?</div>
                            <h3>Belum ada FAQ</h3>
                            <p>Tidak ada FAQ yang dapat dihapus.</p>
                        </div>
                    @endforelse
                </div>

                @if ($faqs->count() > 0)
                    <div class="bottom-action">
                        <button type="button" id="openDeleteModal" class="delete-button">Hapus yang dipilih</button>
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
            <h2>Hapus FAQ?</h2>
            <p>FAQ yang dipilih akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.</p>

            <div class="modal-actions">
                <button type="button" id="cancelDelete" class="cancel-button">Batal</button>
                <button type="button" id="confirmDelete" class="confirm-button">Ya, Hapus</button>
            </div>
        </div>
    </div>
</body>

</html>
