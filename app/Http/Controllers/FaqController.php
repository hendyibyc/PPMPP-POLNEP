<?php

namespace App\Http\Controllers;

use App\Mail\FaqQuestionMail;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FaqController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $faqs = Faq::orderBy('kategori')
            ->orderBy('urutan')
            ->orderBy('id')
            ->get();

        return view('faq.edit', compact('faqs'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'kategori' => 'required|string|max:255',
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
            'urutan' => 'nullable|integer|min:0',
        ]);

        Faq::create([
            'kategori' => $request->kategori,
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
            'urutan' => $request->urutan ?? 0,
        ]);

        return redirect()
            ->route('dashboard.faq.edit')
            ->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function update(Request $request, Faq $faq)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'kategori' => 'required|string|max:255',
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $faq->update([
            'kategori' => $request->kategori,
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
            'urutan' => $request->urutan ?? 0,
        ]);

        return redirect()
            ->route('dashboard.faq.edit')
            ->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(Faq $faq)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $faq->delete();

        return redirect()
            ->route('dashboard.faq.edit')
            ->with('success', 'FAQ berhasil dihapus.');
    }

    public function sendQuestion(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'pertanyaan' => 'required|string|max:5000',
        ]);

        Mail::to(env('MAIL_TO'))->send(
            new FaqQuestionMail(
                $request->nama,
                $request->email,
                $request->pertanyaan
            )
        );

        return back()->with(
            'success',
            'Pertanyaan berhasil dikirim. Terima kasih.'
        );
    }

    public function deletePage()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $faqs = Faq::orderBy('kategori')
            ->orderBy('urutan')
            ->orderBy('id')
            ->get();

        return view('faq.delete', compact('faqs'));
    }

    public function destroySelected(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return back()->with('error', 'Pilih FAQ yang ingin dihapus.');
        }

        Faq::whereIn('id', $ids)->delete();

        return redirect()
            ->route('dashboard.konten.delete')
            ->with('success', 'FAQ berhasil dihapus.');
    }
}
