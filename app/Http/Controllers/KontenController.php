<?php

namespace App\Http\Controllers;

use App\Models\DetailBerita;
use App\Models\Konten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KontenController extends Controller
{
    private function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private function storeImage(Request $request, string $field = 'gambar'): ?string
    {
        if (!$request->hasFile($field)) {
            return null;
        }

        return $request->file($field)->store('konten', 'public');
    }

    public function create()
    {
        $role = Auth::user()->role;

        if ($role === 'penulis') {
            return view('konten.create', [
                'jenis' => 'berita',
            ]);
        }

        return view('konten.create', [
            'jenis' => null,
        ]);
    }

    public function createExisting($jenis)
    {
        $role = Auth::user()->role;

        $allowedJenis = [
            'profil',
            'visimisi',
            'struktur',
            'berita',
            'faq',
            'dokumen',
        ];

        if (!in_array($jenis, $allowedJenis)) {
            abort(404);
        }

        if ($role === 'penulis' && $jenis !== 'berita') {
            abort(403);
        }

        if ($role === 'admin' && $jenis === 'berita') {
            abort(403);
        }

        return view('konten.create', [
            'jenis' => $jenis,
        ]);
    }

    public function edit(Request $request)
    {
        $role = Auth::user()->role;

        $jenis = $request->query('jenis', 'profil');
        $mode = $request->query('mode', 'edit');

        $allowedJenis = [
            'profil',
            'visimisi',
            'struktur',
            'berita',
            'faq',
            'dokumen',
        ];

        if (!in_array($jenis, $allowedJenis)) {
            abort(404);
        }

        if ($jenis === 'dokumen') {
            return redirect()->route('dashboard.dokumen.edit');
        }

        if ($jenis === 'faq') {
            return redirect()->route('dashboard.faq.edit');
        }

        if ($role === 'penulis' && $jenis !== 'berita') {
            abort(403);
        }

        if ($jenis === 'berita') {
            if (!in_array($mode, [
                'berita',
                'detail',
                'detail-edit',
                'hapus',
            ])) {
                abort(404);
            }

            if ($role === 'admin' && $mode !== 'hapus') {
                abort(403);
            }

            if ($mode === 'detail-edit' && $role !== 'penulis') {
                abort(403);
            }
        } else {
            if (!in_array($mode, [
                'edit',
                'hapus',
            ])) {
                abort(404);
            }

            if ($role !== 'admin') {
                abort(403);
            }
        }

        $kontens = Konten::where('bagian', $jenis)
            ->with('detailBerita')
            ->orderBy('urutan')
            ->orderBy('created_at')
            ->get();

        $kontenDetail = null;

        if (
            $jenis === 'berita' &&
            $mode === 'detail-edit'
        ) {
            $id = $request->query('id');

            if (!$id) {
                abort(404);
            }

            $kontenDetail = Konten::where(
                'bagian',
                'berita'
            )
                ->with('detailBerita')
                ->findOrFail($id);
        }

        return view(
            'konten.edit',
            compact(
                'jenis',
                'mode',
                'kontens',
                'kontenDetail'
            )
        );
    }

    public function delete(Request $request)
    {
        $role = Auth::user()->role;

        $jenis = $request->query('jenis');

        if ($role === 'penulis') {
            $jenis = 'berita';
        }

        if ($role !== 'admin' && $role !== 'penulis') {
            abort(403);
        }

        if (!$jenis) {
            return view('konten.delete-menu');
        }

        $allowedJenis = [
            'profil',
            'visimisi',
            'struktur',
            'berita',
            'faq',
            'dokumen',
        ];

        if (!in_array($jenis, $allowedJenis)) {
            abort(404);
        }

        if ($role === 'penulis' && $jenis !== 'berita') {
            abort(403);
        }

        if ($jenis === 'faq') {
            if ($role !== 'admin') {
                abort(403);
            }

            return redirect()->route('dashboard.faq.delete');
        }

        if ($jenis === 'dokumen') {
            if ($role !== 'admin') {
                abort(403);
            }

            return redirect()->route('dashboard.dokumen.delete');
        }

        $kontens = Konten::where('bagian', $jenis)
            ->orderBy('urutan')
            ->orderBy('id')
            ->get();

        $judulBagian = match ($jenis) {
            'profil' => 'HAPUS PROFIL',
            'visimisi' => 'HAPUS VISI & MISI',
            'struktur' => 'HAPUS STRUKTUR ORGANISASI',
            'berita' => 'HAPUS BERITA',
            default => 'HAPUS KONTEN',
        };

        return view(
            'konten.delete',
            compact(
                'jenis',
                'kontens',
                'judulBagian'
            )
        );
    }

    public function editDokumen()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $dokumens = Konten::where(
            'bagian',
            'dokumen'
        )
            ->orderBy('urutan')
            ->orderBy('id')
            ->get();

        return view(
            'dokumen.edit',
            compact('dokumens')
        );
    }

    public function deleteDokumen()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $dokumens = Konten::where(
            'bagian',
            'dokumen'
        )
            ->orderBy('urutan')
            ->orderBy('id')
            ->get();

        return view(
            'dokumen.delete',
            compact('dokumens')
        );
    }

    public function storeDokumen(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'judul_konten' => 'required|string|max:255',
            'subjudul' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer|min:0',
            'file_dokumen' => 'required|file|mimes:pdf|max:10240',
        ]);

        $file = $request
            ->file('file_dokumen')
            ->store('dokumen', 'public');

        Konten::create([
            'bagian' => 'dokumen',
            'judul_konten' => $request->judul_konten,
            'subjudul' => $request->subjudul,
            'judul' => $request->judul_konten,
            'isi' => null,
            'gambar' => null,
            'file_dokumen' => $file,
            'urutan' => $request->urutan ?? 0,
        ]);

        return redirect()
            ->route('dashboard.dokumen.edit')
            ->with(
                'success',
                'Dokumen berhasil ditambahkan.'
            );
    }

    public function updateDokumen(
        Request $request,
        Konten $konten
    ) {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        if ($konten->bagian !== 'dokumen') {
            abort(404);
        }

        $request->validate([
            'judul_konten' => 'required|string|max:255',
            'subjudul' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer|min:0',
            'file_dokumen' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $data = [
            'judul_konten' => $request->judul_konten,
            'judul' => $request->judul_konten,
            'subjudul' => $request->subjudul,
            'urutan' => $request->urutan ?? 0,
        ];

        if ($request->hasFile('file_dokumen')) {
            $this->deleteFile($konten->file_dokumen);

            $data['file_dokumen'] = $request
                ->file('file_dokumen')
                ->store('dokumen', 'public');
        }

        $konten->update($data);

        return redirect()
            ->route('dashboard.dokumen.edit')
            ->with(
                'success',
                'Dokumen berhasil diperbarui.'
            );
    }

    public function destroyDokumen(Konten $konten)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        if ($konten->bagian !== 'dokumen') {
            abort(404);
        }

        $this->deleteFile(
            $konten->file_dokumen
        );

        $konten->delete();

        return redirect()
            ->route('dashboard.dokumen.delete')
            ->with(
                'success',
                'Dokumen berhasil dihapus.'
            );
    }

    public function destroySelectedDokumen(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer',
        ]);

        $dokumens = Konten::where(
            'bagian',
            'dokumen'
        )
            ->whereIn(
                'id',
                $request->ids
            )
            ->get();

        $jumlah = $dokumens->count();

        foreach ($dokumens as $dokumen) {
            $this->deleteFile(
                $dokumen->file_dokumen
            );

            $dokumen->delete();
        }

        return redirect()
            ->route('dashboard.dokumen.delete')
            ->with(
                'success',
                $jumlah . ' dokumen berhasil dihapus.'
            );
    }

    public function store(Request $request)
    {
        $role = Auth::user()->role;
        $jenis = $request->jenis;

        if ($jenis === 'dokumen') {
            return $this->storeDokumen($request);
        }

        if ($jenis === 'berita') {
            if ($role !== 'penulis') {
                abort(403);
            }

            $request->validate([
                'judul' => 'required|string|max:255',
                'isi' => 'required|string',
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
                'urutan' => 'nullable|integer|min:0',
            ]);

            $gambar = $this->storeImage(
                $request,
                'gambar'
            );

            $konten = Konten::create([
                'bagian' => 'berita',
                'judul_konten' => $request->judul,
                'subjudul' => null,
                'judul' => $request->judul,
                'isi' => $request->isi,
                'gambar' => $gambar,
                'file_dokumen' => null,
                'urutan' => $request->urutan ?? 0,
            ]);

            DetailBerita::create([
                'konten_id' => $konten->id,
                'kategori' => 'Berita',
                'penulis' => Auth::user()->name,
                'gambar' => $gambar,
                'isi_detail' => $request->isi,
                'views' => 0,
            ]);

            return redirect()
                ->route('berita')
                ->with(
                    'success',
                    'Berita berhasil ditambahkan.'
                );
        }

        if ($role !== 'admin') {
            abort(403);
        }

        $allowedJenis = [
            'profil',
            'visimisi',
            'struktur',
        ];

        if (!in_array($jenis, $allowedJenis)) {
            abort(403);
        }

        $request->validate([
            'judul_konten' => 'required|string|max:255',
            'subjudul' => 'nullable|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $gambar = $this->storeImage(
            $request,
            'gambar'
        );

        Konten::create([
            'bagian' => $jenis,
            'judul_konten' => $request->judul_konten,
            'subjudul' => $request->subjudul,
            'judul' => $request->judul_konten,
            'isi' => $request->isi,
            'gambar' => $gambar,
            'file_dokumen' => null,
            'urutan' => $request->urutan ?? 0,
        ]);

        $redirectRoute = match ($jenis) {
            'profil' => 'profil',
            'visimisi' => 'visimisi',
            'struktur' => 'strukturorganisasi',
            default => 'dashboard',
        };

        return redirect()
            ->route($redirectRoute)
            ->with(
                'success',
                'Konten berhasil ditambahkan.'
            );
    }

    public function updateAll(Request $request)
    {
        $role = Auth::user()->role;
        $jenis = $request->jenis;

        $allowedJenis = [
            'profil',
            'visimisi',
            'struktur',
            'berita',
        ];

        if (!in_array($jenis, $allowedJenis)) {
            abort(404);
        }

        if (
            $role === 'penulis' &&
            $jenis !== 'berita'
        ) {
            abort(403);
        }

        if (
            $role === 'admin' &&
            $jenis === 'berita'
        ) {
            abort(403);
        }

        if ($jenis === 'berita') {
            $request->validate([
                'jenis' => 'required|string|max:50',
                'judul_konten' => 'required|string|max:255',
                'subjudul' => 'nullable|string|max:255',
                'konten' => 'required|array',
                'konten.*.id' => 'required|integer',
                'konten.*.judul' => 'required|string|max:255',
                'konten.*.isi' => 'required|string',
                'konten.*.gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
                'konten.*.urutan' => 'nullable|integer|min:0',
            ]);

            foreach ($request->konten as $index => $data) {
                $konten = Konten::where(
                    'bagian',
                    'berita'
                )->findOrFail($data['id']);

                $updateData = [
                    'judul_konten' => $request->judul_konten,
                    'subjudul' => $request->subjudul,
                    'judul' => $data['judul'],
                    'isi' => $data['isi'],
                    'urutan' => $data['urutan'] ?? 0,
                ];

                $gambar = $request->file(
                    "konten.$index.gambar"
                );

                if ($gambar) {
                    $this->deleteFile(
                        $konten->gambar
                    );

                    $updateData['gambar'] = $gambar->store(
                        'konten',
                        'public'
                    );
                }

                $konten->update($updateData);
            }

            return redirect()
                ->route(
                    'dashboard.konten.edit',
                    [
                        'jenis' => 'berita',
                        'mode' => 'berita',
                    ]
                )
                ->with(
                    'success',
                    'Isi berita berhasil diperbarui.'
                );
        }

        $request->validate([
            'jenis' => 'required|string|max:50',
            'judul_konten' => 'required|string|max:255',
            'subjudul' => 'nullable|string|max:255',
            'konten' => 'required|array',
            'konten.*.id' => 'required|integer',
            'konten.*.isi' => 'required|string',
            'konten.*.gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'konten.*.urutan' => 'nullable|integer|min:0',
        ]);

        foreach ($request->konten as $index => $data) {
            $konten = Konten::where(
                'bagian',
                $jenis
            )->findOrFail($data['id']);

            $updateData = [
                'judul_konten' => $request->judul_konten,
                'judul' => $request->judul_konten,
                'subjudul' => $request->subjudul,
                'isi' => $data['isi'],
                'urutan' => $data['urutan'] ?? 0,
            ];

            $gambar = $request->file(
                "konten.$index.gambar"
            );

            if ($gambar) {
                $this->deleteFile(
                    $konten->gambar
                );

                $updateData['gambar'] = $gambar->store(
                    'konten',
                    'public'
                );
            }

            $konten->update($updateData);
        }

        return redirect()
            ->route(
                'dashboard.konten.edit',
                [
                    'jenis' => $jenis,
                    'mode' => 'edit',
                ]
            )
            ->with(
                'success',
                'Konten berhasil diperbarui.'
            );
    }

    public function updateDetail(
        Request $request,
        Konten $konten
    ) {
        if ($konten->bagian !== 'berita') {
            abort(404);
        }

        if (Auth::user()->role !== 'penulis') {
            abort(403);
        }

        $request->validate([
            'kategori' => 'required|string|max:100',
            'penulis' => 'required|string|max:100',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'isi_detail' => 'required|string',
        ]);

        $detail = DetailBerita::firstOrNew([
            'konten_id' => $konten->id,
        ]);

        $gambar = $detail->gambar;

        if ($request->hasFile('gambar')) {
            $this->deleteFile(
                $detail->gambar
            );

            $gambar = $request
                ->file('gambar')
                ->store('konten', 'public');
        }

        $detail->kategori = $request->kategori;
        $detail->penulis = $request->penulis;
        $detail->gambar = $gambar;
        $detail->isi_detail = $request->isi_detail;

        if (!$detail->exists) {
            $detail->views = 0;
        }

        $detail->save();

        return redirect()
            ->route(
                'dashboard.konten.edit',
                [
                    'jenis' => 'berita',
                    'mode' => 'detail',
                ]
            )
            ->with(
                'success',
                'Detail berita berhasil diperbarui.'
            );
    }

    public function showBerita(Konten $konten)
    {
        if ($konten->bagian !== 'berita') {
            abort(404);
        }

        $detailBerita = DetailBerita::firstOrCreate(
            [
                'konten_id' => $konten->id,
            ],
            [
                'kategori' => 'Berita',
                'penulis' => 'PPMPP',
                'gambar' => $konten->gambar,
                'isi_detail' => $konten->isi,
                'views' => 0,
            ]
        );

        $detailBerita->increment('views');

        $konten->setRelation(
            'detailBerita',
            $detailBerita
        );

        return view(
            'berita-detail',
            compact('konten')
        );
    }

    public function destroy(Konten $konten)
    {
        $role = Auth::user()->role;

        if (
            $role === 'penulis' &&
            $konten->bagian !== 'berita'
        ) {
            abort(403);
        }

        if (
            $role !== 'admin' &&
            $role !== 'penulis'
        ) {
            abort(403);
        }

        if ($konten->bagian === 'dokumen') {
            if ($role !== 'admin') {
                abort(403);
            }

            $this->deleteFile(
                $konten->file_dokumen
            );

            $konten->delete();

            return redirect()
                ->route('dashboard.dokumen.delete')
                ->with(
                    'success',
                    'Dokumen berhasil dihapus.'
                );
        }

        if ($konten->bagian === 'berita') {
            $detail = DetailBerita::where(
                'konten_id',
                $konten->id
            )->first();

            if ($detail) {
                if (
                    $detail->gambar &&
                    $detail->gambar !== $konten->gambar
                ) {
                    $this->deleteFile(
                        $detail->gambar
                    );
                }

                $detail->delete();
            }
        }

        $this->deleteFile(
            $konten->gambar
        );

        $jenis = $konten->bagian;

        $konten->delete();

        return redirect()
            ->route(
                'dashboard.konten.delete',
                [
                    'jenis' => $jenis,
                ]
            )
            ->with(
                'success',
                'Konten berhasil dihapus.'
            );
    }

    public function destroySelected(Request $request)
    {
        $role = Auth::user()->role;

        $request->validate([
            'jenis' => 'required|string',
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer',
        ]);

        $jenis = $request->jenis;

        $allowedJenis = [
            'profil',
            'visimisi',
            'struktur',
            'berita',
        ];

        if (!in_array($jenis, $allowedJenis)) {
            abort(404);
        }

        if (
            $role === 'penulis' &&
            $jenis !== 'berita'
        ) {
            abort(403);
        }

        if (
            $role !== 'admin' &&
            $role !== 'penulis'
        ) {
            abort(403);
        }

        $kontens = Konten::where(
            'bagian',
            $jenis
        )
            ->whereIn(
                'id',
                $request->ids
            )
            ->get();

        $jumlah = $kontens->count();

        foreach ($kontens as $konten) {
            if ($jenis === 'berita') {
                $detail = DetailBerita::where(
                    'konten_id',
                    $konten->id
                )->first();

                if ($detail) {
                    if (
                        $detail->gambar &&
                        $detail->gambar !== $konten->gambar
                    ) {
                        $this->deleteFile(
                            $detail->gambar
                        );
                    }

                    $detail->delete();
                }
            }

            $this->deleteFile(
                $konten->gambar
            );

            $konten->delete();
        }

        return redirect()
            ->route(
                'dashboard.konten.delete',
                [
                    'jenis' => $jenis,
                ]
            )
            ->with(
                'success',
                $jumlah . ' konten berhasil dihapus.'
            );
    }
}
