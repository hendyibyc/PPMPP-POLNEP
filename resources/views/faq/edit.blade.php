<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelola FAQ PPMPP</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inclusive+Sans&family=Jost:wght@500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    @vite(['resources/css/faq-edit.css', 'resources/js/faq-edit.js'])
</head>

<body>
    <main class="faq-page">
        <div class="faq-container">
            @if (session('success'))
                <div class="success-message">
                    <i class="bi bi-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="error-message">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="page-header">
                <div>
                    <h1>KELOLA FAQ</h1>
                    <p>Kelola pertanyaan dan jawaban yang ditampilkan pada halaman FAQ.</p>
                </div>
            </div>

            <div class="top-actions">
                <button type="button" class="btn-add" id="btnTambahFaq">
                    <i class="bi bi-plus-lg"></i>
                    Tambah FAQ
                </button>
            </div>

            <div class="add-faq-box" id="formTambahFaq">
                <div class="form-title">
                    <h2>Tambah FAQ</h2>
                    <p>Tambahkan pertanyaan dan jawaban baru.</p>
                </div>

                <form action="{{ route('dashboard.faq.store') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <input type="text" id="kategori" name="kategori" placeholder="Contoh: Informasi Publik"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="urutan">Urutan</label>
                            <input type="number" id="urutan" name="urutan" value="1" min="0">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pertanyaan">Pertanyaan</label>
                        <input type="text" id="pertanyaan" name="pertanyaan" placeholder="Masukkan pertanyaan"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="jawaban">Jawaban</label>
                        <textarea id="jawaban" name="jawaban" placeholder="Masukkan jawaban" required></textarea>
                    </div>

                    <div class="form-buttons">
                        <button type="submit" class="btn-save">
                            <i class="bi bi-check-lg"></i>
                            Simpan
                        </button>

                        <button type="button" class="btn-cancel" id="btnBatalTambah">
                            Batal
                        </button>
                    </div>
                </form>
            </div>

            <div class="faq-list">
                @forelse ($faqs->groupBy('kategori') as $kategori => $items)
                    <section class="faq-category">
                        <button type="button" class="category-header" data-category-toggle>
                            <span class="category-left">
                                <span class="category-arrow"><i class="bi bi-chevron-right"></i></span>
                                <span class="category-title">{{ $kategori }}</span>
                                <span class="category-count">{{ $items->count() }}</span>
                            </span>
                        </button>

                        <div class="category-content">
                            @foreach ($items as $faq)
                                <div class="faq-item">
                                    <div class="faq-number">{{ $loop->iteration }}.</div>

                                    <div class="faq-content">
                                        <h3>{{ $faq->pertanyaan }}</h3>
                                        <p>{{ $faq->jawaban }}</p>
                                    </div>

                                    <div class="faq-actions">
                                        <button type="button" class="btn-edit" data-edit-faq="{{ $faq->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                            Edit
                                        </button>

                                        <form action="{{ route('dashboard.faq.destroy', $faq->id) }}" method="POST"
                                            class="delete-form"
                                            onsubmit="return confirm('Apakah kamu yakin ingin menghapus FAQ ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn-delete">
                                                <i class="bi bi-trash3"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>

                                    <div class="faq-edit-form" id="editFaq{{ $faq->id }}">
                                        <form action="{{ route('dashboard.faq.update', $faq->id) }}" method="POST">

                                            @csrf
                                            @method('PUT')

                                            <div class="form-grid">
                                                <div class="form-group">
                                                    <label>Kategori</label>
                                                    <input type="text" name="kategori" value="{{ $faq->kategori }}"
                                                        required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Urutan</label>
                                                    <input type="number" name="urutan" value="{{ $faq->urutan }}"
                                                        min="0">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Pertanyaan</label>
                                                <input type="text" name="pertanyaan"
                                                    value="{{ $faq->pertanyaan }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Jawaban</label>
                                                <textarea name="jawaban" required>{{ $faq->jawaban }}</textarea>
                                            </div>

                                            <div class="form-buttons">
                                                <button type="submit" class="btn-save">
                                                    <i class="bi bi-check-lg"></i>
                                                    Simpan Perubahan
                                                </button>

                                                <button type="button" class="btn-cancel"
                                                    data-cancel-edit="{{ $faq->id }}">
                                                    Batal
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                @empty

                    <div class="empty-message">
                        <i class="bi bi-question-circle"></i>
                        <p>Belum ada data FAQ.</p>
                    </div>

                @endforelse
            </div>

            <div class="bottom-back">
                <a href="{{ route('dashboard') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>
    </main>
</body>

</html>
