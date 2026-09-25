<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransparansiAnggaran;
use App\Models\User;
use App\Notifications\TransparansiAnggaranBaruNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TransparansiAnggaranController extends Controller
{
    public function index(): View
    {
        $transparansi = TransparansiAnggaran::query()
            ->where('desa_id', auth()->user()->desa_id)
            ->latest()
            ->paginate(12);

        return view('admin.transparansi.index', compact('transparansi'));
    }

    public function create(): View
    {
        return view('admin.transparansi.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'periode' => ['nullable', 'string', 'max:255'],
            'pdf' => ['required', 'file', 'mimes:pdf', 'max:10240'],
            'status' => ['required', 'in:draft,published'],
        ]);

        $path = $request->file('pdf')->storeAs('transparansi', 'transparansi-'.now()->timestamp.'-'.uniqid().'.pdf', 'public');

        $document = TransparansiAnggaran::create([
            'desa_id' => auth()->user()->desa_id,
            'user_id' => auth()->id(),
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'periode' => $validated['periode'] ?? null,
            'pdf_path' => $path,
            'status' => $validated['status'],
            'published_at' => $validated['status'] === 'published' ? now() : null,
        ]);

        if ($document->status === 'published') {
            $this->sendPublishedNotification($document);
        }

        return redirect()->route('admin.transparansi.index')->with('success', 'Dokumen transparansi anggaran berhasil disimpan.');
    }

    public function edit(TransparansiAnggaran $transparansi): View
    {
        $this->authorize('update', $transparansi);

        return view('admin.transparansi.edit', compact('transparansi'));
    }

    public function update(Request $request, TransparansiAnggaran $transparansi): RedirectResponse
    {
        $this->authorize('update', $transparansi);

        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'periode' => ['nullable', 'string', 'max:255'],
            'pdf' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'status' => ['required', 'in:draft,published'],
        ]);

        $publishBefore = $transparansi->status === 'published';

        $payload = [
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'periode' => $validated['periode'] ?? null,
            'status' => $validated['status'],
            'published_at' => $validated['status'] === 'published' ? ($publishBefore ? $transparansi->published_at : now()) : null,
        ];

        if ($request->hasFile('pdf')) {
            Storage::disk('public')->delete($transparansi->pdf_path);
            $payload['pdf_path'] = $request->file('pdf')->storeAs('transparansi', 'transparansi-'.now()->timestamp.'-'.uniqid().'.pdf', 'public');
        }

        $transparansi->update($payload);

        if ($validated['status'] === 'published' && ! $publishBefore) {
            $this->sendPublishedNotification($transparansi);
        }

        return redirect()->route('admin.transparansi.index')->with('success', 'Dokumen transparansi anggaran berhasil diperbarui.');
    }

    public function destroy(TransparansiAnggaran $transparansi): RedirectResponse
    {
        $this->authorize('delete', $transparansi);
        if ($transparansi->pdf_path) {
            Storage::disk('public')->delete($transparansi->pdf_path);
        }
        $transparansi->delete();

        return redirect()->route('admin.transparansi.index')->with('success', 'Dokumen transparansi anggaran berhasil dihapus.');
    }

    public function publish(TransparansiAnggaran $transparansi): RedirectResponse
    {
        $this->authorize('update', $transparansi);

        if ($transparansi->status !== 'published') {
            $transparansi->update([
                'status' => 'published',
                'published_at' => now(),
            ]);
            $this->sendPublishedNotification($transparansi);
        }

        return redirect()->route('admin.transparansi.index')->with('success', 'Dokumen transparansi anggaran berhasil dipublikasikan.');
    }

    public function unpublish(TransparansiAnggaran $transparansi): RedirectResponse
    {
        $this->authorize('update', $transparansi);
        $transparansi->update([
            'status' => 'draft',
            'published_at' => null,
        ]);

        return redirect()->route('admin.transparansi.index')->with('success', 'Dokumen transparansi anggaran berhasil diarsipkan.');
    }

    public function download(TransparansiAnggaran $transparansi)
    {
        $this->authorize('download', $transparansi);

        if (! $transparansi->pdf_path || ! Storage::disk('public')->exists($transparansi->pdf_path)) {
            abort(404);
        }

        return response()->download(Storage::disk('public')->path($transparansi->pdf_path), basename($transparansi->pdf_path));
    }

    protected function sendPublishedNotification(TransparansiAnggaran $transparansi): void
    {
        DB::transaction(function () use ($transparansi) {
            $recipients = User::query()
                ->where('desa_id', $transparansi->desa_id)
                ->where('role', 'masyarakat')
                ->whereNotNull('email')
                ->get();

            foreach ($recipients as $recipient) {
                $recipient->notify(new TransparansiAnggaranBaruNotification($transparansi));
            }
        });
    }
}
