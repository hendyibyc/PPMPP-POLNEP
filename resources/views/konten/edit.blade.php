<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit {{ ucfirst($jenis) }} PPMPP</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inclusive+Sans&family=Jost:wght@500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    @vite([ 'resources/css/edit/konten.css', 'resources/js/edit.js', 'resources/js/hapus.js'])
</head>

<body>
<main class="edit-page">
    <div class="edit-container">
        @if(session('success'))
            <div class="success-message">
                <i class="bi bi-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="error-message">
                <i class="bi bi-exclamation-circle"></i>
                <p>{{ session('error') }}</p>
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

        @if($jenis === 'berita' && $mode === 'edit')
            <div class="edit-header">
                <h1>EDIT BERITA</h1>
                <p>Pilih bagian berita yang ingin kamu kelola.</p>
            </div>

            <div class="berita-menu">
                <button type="button" id="editBeritaButton" class="menu-berita-button">
                    <i class="bi bi-newspaper"></i>
                    <div>
                        <h2>Edit Berita</h2>
                        <p>Mengubah judul, isi, gambar, dan urutan berita.</p>
                    </div>
                    <i class="bi bi-chevron-right"></i>
                </button>
                <div id="pilihanBerita" class="pilihan-berita">
                    <a href="{{ route('dashboard.konten.edit', ['jenis' => 'berita', 'mode' => 'berita']) }}" class="pilihan-card">
                        <i class="bi bi-pencil-square"></i>
                        <div>
                            <h2>Edit Berita</h2>
                            <p>Mengubah judul, isi, gambar, dan urutan berita.</p>
                        </div>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                    <a href="{{ route('dashboard.konten.edit', ['jenis' => 'berita', 'mode' => 'detail']) }}" class="pilihan-card">
                        <i class="bi bi-file-earmark-text"></i>
                        <div>
                            <h2>Edit Detail Berita</h2>
                            <p>Mengubah informasi lengkap pada detail berita.</p>
                        </div>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            </div>

            <div class="bottom-back">
                <a href="{{ route('dashboard') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
            </div>

        @elseif($jenis === 'berita' && $mode === 'detail')
            <div class="edit-header">
                <h1>EDIT DETAIL HALAMAN BERITA</h1>
                <p>Pilih halaman berita yang ingin diedit.</p>
            </div>

            <div class="detail-search">
                <i class="bi bi-search"></i>
                <input type="text" id="searchDetailBerita" placeholder="Temukan berita" autocomplete="off">
            </div>

            <div class="berita-detail-list" id="detailBeritaList">
                @forelse($kontens as $konten)
                    <div class="berita-detail-option" data-judul="{{ strtolower($konten->judul ?? $konten->judul_konten) }}">
                        <div class="berita-detail-number">
                            {{ $konten->urutan ?? $loop->iteration }}.
                        </div>
                        <div class="berita-detail-option-content">
                            <h2>{{ $konten->judul ?? $konten->judul_konten }}</h2>
                        </div>
                        <a href="{{ route('dashboard.konten.edit', ['jenis' => 'berita', 'mode' => 'detail-edit', 'id' => $konten->id]) }}" class="btn-edit-detail" title="Edit berita">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </div>
                @empty
                    <div class="empty-detail">
                        <i class="bi bi-newspaper"></i>
                        <p>Belum ada berita.</p>
                    </div>
                @endforelse
            </div>

            <div class="bottom-back">
                <a href="{{ route('dashboard') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
            </div>

        @elseif($mode === 'hapus')
            <div class="edit-header">
                <h1>HAPUS {{ strtoupper($jenis) }}</h1>
                <p>Pilih konten yang ingin dihapus.</p>
            </div>

            @if($kontens->count() > 0)
                <form action="{{ route('konten.destroySelected') }}" method="POST" id="formHapusKonten">
                    @csrf
                    <input type="hidden" name="jenis" value="{{ $jenis }}">

                    <div class="delete-toolbar">
                        <label class="select-all-label">
                            <input type="checkbox" id="selectAllKonten">
                            <span>Pilih semua</span>
                        </label>
                        <span id="selectedCount" class="selected-count">0 dipilih</span>
                        <button type="submit" id="btnDeleteSelected" class="btn-delete-selected" disabled>
                            <i class="bi bi-trash3"></i>
                            Hapus yang Dipilih
                        </button>
                    </div>

                    <div class="berita-detail-list delete-list">
                        @foreach($kontens as $konten)
                            <label class="delete-option" for="konten{{ $konten->id }}">
                                <input type="checkbox" class="konten-checkbox" id="konten{{ $konten->id }}" name="ids[]" value="{{ $konten->id }}">
                                <div class="berita-detail-number">
                                    {{ $loop->iteration }}.
                                </div>
                                <div class="berita-detail-option-content">
                                    <h2>{{ $konten->judul ?? $konten->judul_konten }}</h2>
                                </div>
                                <button type="button" class="btn-delete-detail" data-id="{{ $konten->id }}" title="Hapus konten ini">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </label>
                        @endforeach
                    </div>

                    <div class="bottom-back">
                        <a href="{{ route('dashboard') }}" class="btn-back">
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </form>
            @else
                <div class="empty-detail">
                    <i class="bi bi-trash3"></i>
                    <p>Belum ada {{ $jenis }} yang tersedia.</p>
                </div>

                <div class="bottom-back">
                    <a href="{{ route('dashboard') }}" class="btn-back">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            @endif

        @elseif($jenis === 'berita' && $mode === 'detail-edit')
            <div class="edit-header">
                <h1>EDIT DETAIL BERITA</h1>
                <p>{{ $kontenDetail->judul ?? $kontenDetail->judul_konten }}</p>
            </div>

            <form action="{{ route('dashboard.konten.detail.update', $kontenDetail->id) }}" method="POST" enctype="multipart/form-data" class="edit-form">
                @csrf
                @method('PUT')

                <div class="content-box">
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input type="text" id="kategori" name="kategori" value="{{ old('kategori', $kontenDetail->detailBerita->kategori ?? '') }}" placeholder="Contoh: Polnep" required>
                    </div>
                    <div class="form-group">
                        <label for="penulis">Penulis</label>
                        <input type="text" id="penulis" name="penulis" value="{{ old('penulis', $kontenDetail->detailBerita->penulis ?? '') }}" placeholder="Contoh: Teguh.F" required>
                    </div>
                    <div class="form-group">
                        <label for="gambarDetail">Gambar Detail</label>
                        <input type="file" id="gambarDetail" name="gambar" accept="image/jpeg,image/png,image/jpg,image/webp">
                        @if($kontenDetail->detailBerita?->gambar)
                            <small class="form-help">Gambar saat ini: {{ basename($kontenDetail->detailBerita->gambar) }}</small>
                        @elseif($kontenDetail->gambar)
                            <small class="form-help">Gambar saat ini: {{ basename($kontenDetail->gambar) }}</small>
                        @else
                            <small class="form-help">Belum ada gambar.</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="isi_detail">Isi Detail Berita</label>
                        <textarea id="isi_detail" name="isi_detail" placeholder="Masukkan isi lengkap berita" required>{{ old('isi_detail', $kontenDetail->detailBerita->isi_detail ?? '') }}</textarea>
                    </div>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn-save">
                        <i class="bi bi-check-lg"></i>
                        Simpan
                    </button>
                    <a href="{{ route('dashboard') }}" class="btn-back">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </form>

        @elseif($jenis === 'berita' && $mode === 'berita')
            <div class="edit-header">
                <h1>EDIT BERITA</h1>
                <p>Ubah informasi berita yang tersedia.</p>
            </div>

            <form action="{{ route('dashboard.konten.updateAll') }}" method="POST" enctype="multipart/form-data" class="edit-form">
                @csrf
                <input type="hidden" name="jenis" value="{{ $jenis }}">

                @php
                    $kontenPertama = $kontens->first();
                @endphp

                @if($kontenPertama)
                    <div class="page-info-box">
                        <div class="form-group">
                            <label for="judulKonten">Judul</label>
                            <input type="text" id="judulKonten" name="judul_konten" value="{{ old('judul_konten', $kontenPertama->judul_konten) }}" placeholder="Contoh: Berita" required>
                        </div>
                        <div class="form-group">
                            <label for="subjudul">Subjudul</label>
                            <input type="text" id="subjudul" name="subjudul" value="{{ old('subjudul', $kontenPertama->subjudul) }}" placeholder="Masukkan subjudul">
                        </div>
                    </div>
                @endif

                @foreach($kontens as $index => $konten)
                    <div class="content-box">
                        <div class="content-top">
                            <div class="content-number">Berita {{ $index + 1 }}</div>
                        </div>
                        <input type="hidden" name="konten[{{ $index }}][id]" value="{{ $konten->id }}">
                        <div class="form-group">
                            <label for="judul{{ $konten->id }}">Judul Berita</label>
                            <input type="text" id="judul{{ $konten->id }}" name="konten[{{ $index }}][judul]" value="{{ old('konten.' . $index . '.judul', $konten->judul) }}" placeholder="Masukkan judul berita" required>
                        </div>
                        <div class="form-group">
                            <label for="isi{{ $konten->id }}">Isi Singkat</label>
                            <textarea id="isi{{ $konten->id }}" name="konten[{{ $index }}][isi]" placeholder="Masukkan isi singkat berita" required>{{ old('konten.' . $index . '.isi', $konten->isi) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="gambar{{ $konten->id }}">Gambar</label>
                            <input type="file" id="gambar{{ $konten->id }}" name="konten[{{ $index }}][gambar]" accept="image/jpeg,image/png,image/jpg,image/webp">
                            @if($konten->gambar)
                                <small class="form-help">Gambar saat ini: {{ basename($konten->gambar) }}</small>
                            @else
                                <small class="form-help">Belum ada gambar.</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="urutan{{ $konten->id }}">Urutan</label>
                            <input type="number" id="urutan{{ $konten->id }}" name="konten[{{ $index }}][urutan]" value="{{ old('konten.' . $index . '.urutan', $konten->urutan) }}" placeholder="Masukkan urutan" min="0">
                        </div>
                    </div>
                @endforeach

                <div class="form-buttons">
                    <button type="submit" class="btn-save">
                        <i class="bi bi-check-lg"></i>
                        Simpan
                    </button>
                    <a href="{{ route('dashboard') }}" class="btn-back">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </form>

        @else
            <div class="edit-header">
                <h1>EDIT {{ strtoupper($jenis) }}</h1>
                <p>Ubah informasi yang terdapat pada halaman {{ ucfirst($jenis) }} PPMPP.</p>
            </div>

            <form action="{{ route('dashboard.konten.updateAll') }}" method="POST" enctype="multipart/form-data" class="edit-form">
                @csrf
                <input type="hidden" name="jenis" value="{{ $jenis }}">

                @php
                    $kontenPertama = $kontens->first();
                @endphp

                @if($kontenPertama)
                    <div class="page-info-box">
                        <div class="form-group">
                            <label for="judulKonten">Judul</label>
                            <input type="text" id="judulKonten" name="judul_konten" value="{{ old('judul_konten', $kontenPertama->judul_konten) }}" placeholder="Contoh: Profil" required>
                        </div>
                        <div class="form-group">
                            <label for="subjudul">Subjudul</label>
                            <input type="text" id="subjudul" name="subjudul" value="{{ old('subjudul', $kontenPertama->subjudul) }}" placeholder="Masukkan subjudul">
                        </div>
                    </div>

                    <div class="content-box">
                        <div class="content-top">
                            <div class="content-number">Konten</div>
                        </div>
                        <input type="hidden" name="konten[0][id]" value="{{ $kontenPertama->id }}">
                        <div class="form-group">
                            <label for="isi{{ $kontenPertama->id }}">Isi</label>
                            <textarea id="isi{{ $kontenPertama->id }}" name="konten[0][isi]" placeholder="Masukkan isi konten" required>{{ old('konten.0.isi', $kontenPertama->isi) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="gambar{{ $kontenPertama->id }}">Gambar</label>
                            <input type="file" id="gambar{{ $kontenPertama->id }}" name="konten[0][gambar]" accept="image/jpeg,image/png,image/jpg,image/webp">
                            @if($kontenPertama->gambar)
                                <small class="form-help">Gambar saat ini: {{ basename($kontenPertama->gambar) }}</small>
                            @else
                                <small class="form-help">Belum ada gambar.</small>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="empty-detail">
                        <p>Belum ada konten.</p>
                    </div>
                @endif

                <div class="form-buttons">
                    <button type="submit" class="btn-save">
                        <i class="bi bi-check-lg"></i>
                        Simpan
                    </button>
                    <a href="{{ route('dashboard') }}" class="btn-back">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </form>
        @endif
    </div>
</main>

@if($mode === 'hapus')
    <div class="delete-modal" id="deleteModal" aria-hidden="true">
        <div class="delete-modal-overlay"></div>
        <div class="delete-modal-box" role="dialog" aria-modal="true" aria-labelledby="deleteModalTitle">
            <div class="delete-modal-icon">
                <i class="bi bi-exclamation-triangle"></i>
            </div>
            <h2 id="deleteModalTitle">Apakah Anda yakin?</h2>
            <p id="deleteModalText">Apakah Anda yakin ingin menghapus bagian ini?</p>
            <div class="delete-modal-buttons">
                <button type="button" id="cancelDelete" class="delete-cancel">Batal</button>
                <button type="button" id="confirmDelete" class="delete-confirm">
                    <i class="bi bi-trash3"></i>
                    Iya, Hapus
                </button>
            </div>
        </div>
    </div>
@endif

</body>
</html>
