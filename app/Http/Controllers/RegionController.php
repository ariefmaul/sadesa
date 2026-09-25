<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kota;
use App\Models\Provinsi;

class RegionController extends Controller
{
    public function provinces()
    {
        return Provinsi::orderBy('nama')->get();
    }

    public function regencies(Provinsi $provinsi)
    {
        return $provinsi->kotas()->orderBy('nama')->get();
    }

    public function districts(Kota $kota)
    {
        return $kota->kecamatans()->orderBy('nama')->get();
    }

    public function villages(Kecamatan $kecamatan)
    {
        return $kecamatan->desas()->orderBy('nama')->get();
    }
}
