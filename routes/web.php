<?php

use App\Http\Controllers\Admin\AdminDesaController;
use App\Http\Controllers\Admin\DesaController;
use App\Http\Controllers\Admin\KecamatanController;
use App\Http\Controllers\Admin\KotaController;
use App\Http\Controllers\Admin\MasyarakatVerificationController;
use App\Http\Controllers\Admin\PengajuanSuratController as AdminPengajuanSuratController;
use App\Http\Controllers\Admin\PengumumanDesaController as AdminPengumumanDesaController;
use App\Http\Controllers\Admin\ProvinsiController;
use App\Http\Controllers\Admin\TemplateSuratController;
use App\Http\Controllers\Admin\TransparansiAnggaranController as AdminTransparansiAnggaranController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Masyarakat\PengajuanSuratController;
use App\Http\Controllers\Masyarakat\PengumumanDesaController as MasyarakatPengumumanController;
use App\Http\Controllers\Masyarakat\ProfilMasyarakatController;
use App\Http\Controllers\Masyarakat\TransparansiAnggaranController as MasyarakatTransparansiController;
use App\Http\Controllers\Mesin\MesinController;
use App\Http\Controllers\MesinCetak\ScanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SuratValidationController;
use App\Http\Controllers\VerifikasiSuratController;
use App\Models\Desa;
use App\Models\JenisSurat;
use App\Models\Kecamatan;
use App\Models\Kota;
use App\Models\PengumumanDesa;
use App\Models\Provinsi;
use App\Models\TransparansiAnggaran;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])
    ->prefix('mesin')
    ->name('mesin.')
    ->group(function () {
        Route::get('/dashboard', [MesinController::class, 'dashboard'])->name('dashboard');

        Route::get('/scan', [MesinController::class, 'scan'])->name('scan');

        Route::post('/verify', [MesinController::class, 'verify'])->name('verify');

        Route::get('/print/{dokumen}', [MesinController::class, 'print'])->name('print');
    });

Route::get('/verifikasi-surat/{token}', [VerifikasiSuratController::class, 'show'])->name('surat.verifikasi');

Route::get('/surat/validasi/{token}', [SuratValidationController::class, 'show'])->name('surat.validasi');

Route::get('/', function () {
    $desa = null;

    $pengumuman = PengumumanDesa::query()->where('status', 'published')->latest('published_at')->take(4)->get();

    $transparansi = TransparansiAnggaran::query()->where('status', 'published')->latest('published_at')->take(3)->get();

    $templateSurat = JenisSurat::query()->where('aktif', true)->orderBy('nama')->get();

    $counts = [
        'provinsi' => Provinsi::query()->count(),
        'kota' => Kota::query()->count(),
        'kecamatan' => Kecamatan::query()->count(),
        'desa' => Desa::query()->count(),
        'templateSurat' => $templateSurat->count(),
        'pengumuman' => $pengumuman->count(),
        'transparansi' => $transparansi->count(),
    ];

    return view('welcome', compact('desa', 'pengumuman', 'transparansi', 'templateSurat', 'counts'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:super_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('desa', DesaController::class)->except('show')->names('desa');

        Route::resource('provinsi', ProvinsiController::class)->except('show')->names('provinsi');

        Route::get('kota', [KotaController::class, 'index'])->name('kota.index');

        Route::get('kota/create', [KotaController::class, 'create'])->name('kota.create');

        Route::post('kota', [KotaController::class, 'store'])->name('kota.store');

        Route::get('kota/{kota}/edit', [KotaController::class, 'edit'])->name('kota.edit');

        Route::put('kota/{kota}', [KotaController::class, 'update'])->name('kota.update');

        Route::patch('kota/{kota}', [KotaController::class, 'update'])->name('kota.update.patch');

        Route::delete('kota/{kota}', [KotaController::class, 'destroy'])->name('kota.destroy');

        Route::resource('kecamatan', KecamatanController::class)->except('show')->names('kecamatan');

        Route::resource('admin-desa', AdminDesaController::class)
            ->except('show')
            ->parameters(['admin-desa' => 'adminDesa'])
            ->names('admin-desa');

        Route::resource('users', UserController::class)->except('show')->names('users');
    });

Route::get('/regions/provinces', [RegionController::class, 'provinces']);
Route::get('/regions/regencies/{provinsi}', [RegionController::class, 'regencies']);
Route::get('/regions/districts/{kota}', [RegionController::class, 'districts']);
Route::get('/regions/villages/{kecamatan}', [RegionController::class, 'villages']);

Route::middleware(['auth', 'role:admin_desa'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('akun', [UserController::class, 'desaIndex'])->name('akun.index');
        Route::get('akun/create', [UserController::class, 'create'])->name('akun.create');
        Route::post('akun', [UserController::class, 'store'])->name('akun.store');
        Route::get('akun/{user}/edit', [UserController::class, 'edit'])->name('akun.edit');
        Route::put('akun/{user}', [UserController::class, 'update'])->name('akun.update');
        Route::delete('akun/{user}', [UserController::class, 'destroy'])->name('akun.destroy');

        Route::get('masyarakat', [MasyarakatVerificationController::class, 'index'])->name('masyarakat.index');
        Route::get('masyarakat/{masyarakat}', [MasyarakatVerificationController::class, 'show'])->name('masyarakat.show');
        Route::patch('masyarakat/{masyarakat}/approve', [MasyarakatVerificationController::class, 'approve'])->name('masyarakat.approve');
        Route::patch('masyarakat/{masyarakat}/reject', [MasyarakatVerificationController::class, 'reject'])->name('masyarakat.reject');

        Route::get('pengajuan', [AdminPengajuanSuratController::class, 'index'])->name('pengajuan.index');
        Route::get('pengajuan/realtime', [AdminPengajuanSuratController::class, 'realtime'])->name('pengajuan.realtime');
        Route::get('pengajuan/notifikasi', [AdminPengajuanSuratController::class, 'notifications'])->name('pengajuan.notifications');
        Route::post('pengajuan/notifikasi/{id}/read', [AdminPengajuanSuratController::class, 'markNotificationAsRead'])->name('pengajuan.notifications.read');
        Route::get('pengajuan/{pengajuan}', [AdminPengajuanSuratController::class, 'show'])->name('pengajuan.show');
        Route::post('pengajuan/{pengajuan}/approve', [AdminPengajuanSuratController::class, 'approve'])->name('pengajuan.approve');
        Route::patch('pengajuan/{pengajuan}/approve', [AdminPengajuanSuratController::class, 'approve'])->name('pengajuan.approve.patch');
        Route::post('pengajuan/{pengajuan}/reject', [AdminPengajuanSuratController::class, 'reject'])->name('pengajuan.reject');
        Route::patch('pengajuan/{pengajuan}/reject', [AdminPengajuanSuratController::class, 'reject'])->name('pengajuan.reject.patch');

        Route::get('pengajuan/dokumen/{dokumen}/word', [AdminPengajuanSuratController::class, 'downloadWord'])->name('pengajuan.dokumen.word');
        Route::get('pengajuan/dokumen/{dokumen}/pdf', [AdminPengajuanSuratController::class, 'downloadPdf'])->name('pengajuan.dokumen.pdf');

        Route::get('pengumuman', [AdminPengumumanDesaController::class, 'index'])->name('pengumuman.index');
        Route::get('pengumuman/create', [AdminPengumumanDesaController::class, 'create'])->name('pengumuman.create');
        Route::post('pengumuman', [AdminPengumumanDesaController::class, 'store'])->name('pengumuman.store');
        Route::get('pengumuman/{pengumuman}/edit', [AdminPengumumanDesaController::class, 'edit'])->name('pengumuman.edit');
        Route::put('pengumuman/{pengumuman}', [AdminPengumumanDesaController::class, 'update'])->name('pengumuman.update');
        Route::delete('pengumuman/{pengumuman}', [AdminPengumumanDesaController::class, 'destroy'])->name('pengumuman.destroy');
        Route::patch('pengumuman/{pengumuman}/publish', [AdminPengumumanDesaController::class, 'publish'])->name('pengumuman.publish');
        Route::patch('pengumuman/{pengumuman}/unpublish', [AdminPengumumanDesaController::class, 'unpublish'])->name('pengumuman.unpublish');

        Route::get('transparansi', [AdminTransparansiAnggaranController::class, 'index'])->name('transparansi.index');
        Route::get('transparansi/create', [AdminTransparansiAnggaranController::class, 'create'])->name('transparansi.create');
        Route::post('transparansi', [AdminTransparansiAnggaranController::class, 'store'])->name('transparansi.store');
        Route::get('transparansi/{transparansi}/edit', [AdminTransparansiAnggaranController::class, 'edit'])->name('transparansi.edit');
        Route::put('transparansi/{transparansi}', [AdminTransparansiAnggaranController::class, 'update'])->name('transparansi.update');
        Route::delete('transparansi/{transparansi}', [AdminTransparansiAnggaranController::class, 'destroy'])->name('transparansi.destroy');
        Route::patch('transparansi/{transparansi}/publish', [AdminTransparansiAnggaranController::class, 'publish'])->name('transparansi.publish');
        Route::patch('transparansi/{transparansi}/unpublish', [AdminTransparansiAnggaranController::class, 'unpublish'])->name('transparansi.unpublish');
        Route::get('transparansi/{transparansi}/download', [AdminTransparansiAnggaranController::class, 'download'])->name('transparansi.download');
    });

Route::middleware(['auth', 'role:super_admin,admin_desa'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('template-surat', [TemplateSuratController::class, 'index'])->name('template-surat.index');
        Route::get('template-surat/create', [TemplateSuratController::class, 'create'])->name('template-surat.create');
        Route::post('template-surat', [TemplateSuratController::class, 'store'])->name('template-surat.store');
        Route::post('template-surat/{templateSurat}/fields/bulk', [TemplateSuratController::class, 'bulkCreate'])->name('template-surat.fields.bulk');
        Route::delete('template-surat/{templateSurat}', [TemplateSuratController::class, 'destroy'])->name('template-surat.destroy');
        Route::get('template-surat/{templateSurat}/fields', [TemplateSuratController::class, 'fields'])->name('template-surat.fields');
        Route::post('template-surat/{templateSurat}/fields', [TemplateSuratController::class, 'storeField'])->name('template-surat.fields.store');
        Route::get('template-surat/{templateSurat}/fields/{field}/edit', [TemplateSuratController::class, 'editField'])->name('template-surat.fields.edit');
        Route::put('template-surat/{templateSurat}/fields/{field}', [TemplateSuratController::class, 'updateField'])->name('template-surat.fields.update');
        Route::delete('template-surat/{templateSurat}/fields/{field}', [TemplateSuratController::class, 'destroyField'])->name('template-surat.fields.destroy');
    });

Route::middleware(['auth', 'role:masyarakat'])
    ->prefix('masyarakat')
    ->name('masyarakat.')
    ->group(function () {
        Route::get('profil', [ProfilMasyarakatController::class, 'edit'])->name('profil.edit');
        Route::patch('profil', [ProfilMasyarakatController::class, 'update'])->name('profil.update');
        Route::get('pengajuan', [PengajuanSuratController::class, 'index'])->name('pengajuan.index');
        Route::get('pengajuan/riwayat', [PengajuanSuratController::class, 'riwayat'])->name('pengajuan.riwayat');
        Route::get('pengajuan/{jenisSurat}/create', [PengajuanSuratController::class, 'create'])->name('pengajuan.create');
        Route::post('pengajuan/{jenisSurat}', [PengajuanSuratController::class, 'store'])->name('pengajuan.store');
        Route::get('pengajuan/detail/{pengajuan}', [PengajuanSuratController::class, 'show'])
            ->middleware('can:view,pengajuan')
            ->name('pengajuan.show');

        Route::get('pengumuman', [MasyarakatPengumumanController::class, 'index'])->name('pengumuman.index');
        Route::get('pengumuman/{pengumuman}', [MasyarakatPengumumanController::class, 'show'])
            ->middleware('can:view,pengumuman')
            ->name('pengumuman.show');

        Route::get('transparansi', [MasyarakatTransparansiController::class, 'index'])->name('transparansi.index');
        Route::get('transparansi/{transparansi}', [MasyarakatTransparansiController::class, 'show'])
            ->middleware('can:view,transparansi')
            ->name('transparansi.show');
        Route::get('transparansi/{transparansi}/download', [MasyarakatTransparansiController::class, 'download'])
            ->middleware('can:download,transparansi')
            ->name('transparansi.download');
    });

Route::middleware(['auth', 'role:mesin,mesin_cetak'])
    ->prefix('mesin')
    ->name('mesin.')
    ->group(function () {
        Route::get('scan', [ScanController::class, 'index'])->name('scan');
        Route::get('verifikasi/{token}', [ScanController::class, 'verify'])->name('verifikasi');
        Route::post('verify', [ScanController::class, 'verifyAjax'])->name('verify');
        Route::get('print/{dokumen}', [ScanController::class, 'print'])->name('print');
        Route::post('printed/{dokumen}', [ScanController::class, 'markPrinted'])->name('printed');
    });

require __DIR__.'/auth.php';
