<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\PengumumanDesa;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PengumumanDesaController extends Controller
{
    public function index(): View
    {
        $pengumuman = PengumumanDesa::query()
            ->where('desa_id', auth()->user()->desa_id)
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(12);

        return view('masyarakat.pengumuman.index', compact('pengumuman'));
    }

    public function show(PengumumanDesa $pengumuman): View
    {
        $this->authorize('view', $pengumuman);

        return view('masyarakat.pengumuman.show', compact('pengumuman'));
    }
}
