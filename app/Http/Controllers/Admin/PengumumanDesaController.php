<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengumumanDesa;
use App\Models\User;
use App\Notifications\PengumumanDesaBaruNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PengumumanDesaController extends Controller
{
    public function index(): View
    {
        $pengumuman = PengumumanDesa::query()
            ->where('desa_id', auth()->user()->desa_id)
            ->latest()
            ->paginate(12);

        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    public function create(): View
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'status' => ['required', 'in:draft,published'],
        ]);

        $pengumuman = PengumumanDesa::create([
            'desa_id' => auth()->user()->desa_id,
            'user_id' => auth()->id(),
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
            'status' => $validated['status'],
            'published_at' => $validated['status'] === 'published' ? now() : null,
        ]);

        if ($pengumuman->status === 'published') {
            $this->sendPublishedNotification($pengumuman);
        }

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman desa berhasil disimpan.');
    }

    public function edit(PengumumanDesa $pengumuman): View
    {
        $this->authorize('update', $pengumuman);

        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, PengumumanDesa $pengumuman): RedirectResponse
    {
        $this->authorize('update', $pengumuman);

        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'status' => ['required', 'in:draft,published'],
        ]);

        $publishBefore = $pengumuman->status === 'published';

        $pengumuman->update([
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
            'status' => $validated['status'],
            'published_at' => $validated['status'] === 'published' ? ($publishBefore ? $pengumuman->published_at : now()) : null,
        ]);

        if ($validated['status'] === 'published' && ! $publishBefore) {
            $this->sendPublishedNotification($pengumuman);
        }

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman desa berhasil diperbarui.');
    }

    public function destroy(PengumumanDesa $pengumuman): RedirectResponse
    {
        $this->authorize('delete', $pengumuman);
        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman desa berhasil dihapus.');
    }

    public function publish(PengumumanDesa $pengumuman): RedirectResponse
    {
        $this->authorize('update', $pengumuman);

        if ($pengumuman->status !== 'published') {
            $pengumuman->update([
                'status' => 'published',
                'published_at' => now(),
            ]);
            $this->sendPublishedNotification($pengumuman);
        }

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dipublikasikan.');
    }

    public function unpublish(PengumumanDesa $pengumuman): RedirectResponse
    {
        $this->authorize('update', $pengumuman);
        $pengumuman->update([
            'status' => 'draft',
            'published_at' => null,
        ]);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diarsipkan.');
    }

    protected function sendPublishedNotification(PengumumanDesa $pengumuman): void
    {
        DB::transaction(function () use ($pengumuman) {
            $recipients = User::query()
                ->where('desa_id', $pengumuman->desa_id)
                ->where('role', 'masyarakat')
                ->whereNotNull('email')
                ->get();

            foreach ($recipients as $recipient) {
                $recipient->notify(new PengumumanDesaBaruNotification($pengumuman));
            }
        });
    }
}
