<?php

namespace App\Providers;

use App\Models\Dokumen;
use App\Models\PengajuanSurat;
use App\Models\PengumumanDesa;
use App\Models\TransparansiAnggaran;
use App\Policies\DokumenPolicy;
use App\Policies\PengajuanSuratPolicy;
use App\Policies\PengumumanDesaPolicy;
use App\Policies\TransparansiAnggaranPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        PengajuanSurat::class => PengajuanSuratPolicy::class,
        Dokumen::class => DokumenPolicy::class,
        PengumumanDesa::class => PengumumanDesaPolicy::class,
        TransparansiAnggaran::class => TransparansiAnggaranPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

    }
}
