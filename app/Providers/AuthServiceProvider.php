<?php

namespace App\Providers;

use App\Models\PengajuanSurat;
use App\Policies\PengajuanSuratPolicy;
use App\Models\Dokumen;
use App\Policies\DokumenPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        PengajuanSurat::class => PengajuanSuratPolicy::class,
        Dokumen::class => DokumenPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Additional gates if needed in future
    }
}
