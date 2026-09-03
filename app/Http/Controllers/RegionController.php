<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
// models used: Provinsi, Kota, Kecamatan

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
