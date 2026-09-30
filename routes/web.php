<?php

use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KontenController;
use App\Models\Faq;
use App\Models\Konten;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])
    ->name('home');

Route::get('/dashboard', function () {

    $beritaTerbaru = Konten::where('bagian', 'berita')
        ->with('detailBerita')
        ->latest('created_at')
        ->take(5)
        ->get();

    return view('dashboard', compact('beritaTerbaru'));

})->middleware(['auth', 'role:admin,penulis'])
    ->name('dashboard');

Route::get('/profil', function () {

    $kontens = Konten::where('bagian', 'profil')
        ->orderBy('urutan')
        ->get();

    return view('profil', compact('kontens'));

})->name('profil');

Route::get('/visimisi', function () {

    $kontens = Konten::where('bagian', 'visimisi')
        ->orderBy('urutan')
        ->get();

    return view('visimisi', compact('kontens'));

})->name('visimisi');

Route::get('/strukturorganisasi', function () {

    $kontens = Konten::where('bagian', 'struktur')
        ->orderBy('urutan')
        ->get();

    return view('strukturorganisasi', compact('kontens'));

})->name('strukturorganisasi');

Route::get('/berita', function () {

    $kontens = Konten::where('bagian', 'berita')
        ->with('detailBerita')
        ->get();

    $beritaTerpopuler = $kontens
        ->sortByDesc(function ($konten) {
            return $konten->detailBerita->views ?? 0;
        })
        ->take(3)
        ->values();

    $semuaBerita = $kontens->sortByDesc('created_at');

    return view(
        'berita',
        compact(
            'beritaTerpopuler',
            'semuaBerita'
        )
    );

})->name('berita');

Route::get('/berita/{konten}', [
    KontenController::class,
    'showBerita'
])->whereNumber('konten')
    ->name('berita.detail');

Route::get('/berita-semua', function () {

    $kontens = Konten::where('bagian', 'berita')
        ->orderBy('urutan')
        ->get();

    return view('berita-semua', compact('kontens'));

})->name('berita.semua');

Route::get('/faq', function () {

    $faqs = Faq::orderBy('kategori')
        ->orderBy('urutan')
        ->orderBy('id')
        ->get();

    return view('faq', compact('faqs'));

})->name('faq');

Route::post('/faq/kirim', [
    FaqController::class,
    'sendQuestion'
])->name('faq.send');

Route::get('/layanan', function () {

    $dokumens = Konten::where('bagian', 'dokumen')
        ->orderBy('urutan')
        ->get();

    return view('layanan', compact('dokumens'));

})->name('layanan');

Route::get('/dokumen/{konten}/download', function (Konten $konten) {

    if ($konten->bagian !== 'dokumen') {
        abort(404);
    }

    if (!$konten->file_dokumen) {
        abort(404);
    }

    $path = storage_path(
        'app/public/' . $konten->file_dokumen
    );

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);

})->name('dokumen.download');

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get(
        '/dashboard/faq/edit',
        [FaqController::class, 'index']
    )->name('dashboard.faq.edit');

    Route::get(
        '/dashboard/faq/delete',
        [FaqController::class, 'deletePage']
    )->name('dashboard.faq.delete');

    Route::post(
        '/dashboard/faq',
        [FaqController::class, 'store']
    )->name('dashboard.faq.store');

    Route::put(
        '/dashboard/faq/{faq}',
        [FaqController::class, 'update']
    )->name('dashboard.faq.update');

    Route::delete(
        '/dashboard/faq/{faq}',
        [FaqController::class, 'destroy']
    )->name('dashboard.faq.destroy');

    Route::post(
        '/dashboard/faq/hapus-terpilih',
        [FaqController::class, 'destroySelected']
    )->name('dashboard.faq.destroy.selected');

    Route::get(
        '/dashboard/dokumen/edit',
        [KontenController::class, 'editDokumen']
    )->name('dashboard.dokumen.edit');

    Route::get(
        '/dashboard/dokumen/delete',
        [KontenController::class, 'deleteDokumen']
    )->name('dashboard.dokumen.delete');

    Route::post(
        '/dashboard/dokumen',
        [KontenController::class, 'storeDokumen']
    )->name('dashboard.dokumen.store');

    Route::put(
        '/dashboard/dokumen/{konten}',
        [KontenController::class, 'updateDokumen']
    )->name('dashboard.dokumen.update');

    Route::delete(
        '/dashboard/dokumen/{konten}',
        [KontenController::class, 'destroyDokumen']
    )->name('dashboard.dokumen.destroy');

    Route::post(
        '/dashboard/dokumen/hapus-terpilih',
        [KontenController::class, 'destroySelectedDokumen']
    )->name('dashboard.dokumen.destroy.selected');
});

Route::middleware(['auth', 'role:admin,penulis'])->group(function () {

    Route::get(
        '/dashboard/konten/edit',
        [KontenController::class, 'edit']
    )->name('dashboard.konten.edit');

    Route::get(
        '/dashboard/konten/hapus',
        [KontenController::class, 'delete']
    )->name('dashboard.konten.delete');

    Route::post(
        '/dashboard/konten/update-all',
        [KontenController::class, 'updateAll']
    )->name('dashboard.konten.updateAll');

    Route::get(
        '/dashboard/konten/tambah',
        [KontenController::class, 'create']
    )->name('dashboard.konten.create');

    Route::get(
        '/dashboard/konten/tambah/{jenis}',
        [KontenController::class, 'createExisting']
    )->name('dashboard.konten.create.existing');

    Route::post(
        '/konten',
        [KontenController::class, 'store']
    )->name('konten.store');

    Route::put(
        '/dashboard/konten/{konten}/detail',
        [KontenController::class, 'updateDetail']
    )->name('dashboard.konten.detail.update');

    Route::delete(
        '/konten/{konten}',
        [KontenController::class, 'destroy']
    )->name('konten.destroy');

    Route::post(
        '/dashboard/konten/hapus-terpilih',
        [KontenController::class, 'destroySelected']
    )->name('konten.destroySelected');
});
