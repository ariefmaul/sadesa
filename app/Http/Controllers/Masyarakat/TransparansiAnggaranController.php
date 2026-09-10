<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\TransparansiAnggaran;
use Illuminate\View\View;

class TransparansiAnggaranController extends Controller
{
    public function index(): View
    {
        $transparansi = TransparansiAnggaran::query()
            ->where('desa_id', auth()->user()->desa_id)
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(12);

        return view('masyarakat.transparansi.index', compact('transparansi'));
    }

    public function show(TransparansiAnggaran $transparansi): View
    {
        $this->authorize('view', $transparansi);

        return view('masyarakat.transparansi.show', compact('transparansi'));
    }

    public function download(TransparansiAnggaran $transparansi)
    {
        $this->authorize('download', $transparansi);

        if (! $transparansi->pdf_path || ! \Storage::disk('public')->exists($transparansi->pdf_path)) {
            abort(404);
        }

        return response()->download(\Storage::disk('public')->path($transparansi->pdf_path), basename($transparansi->pdf_path));
    }
}
