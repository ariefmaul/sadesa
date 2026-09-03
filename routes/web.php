<?php

use App\Http\Controllers\Admin\AdminDesaController;
use App\Http\Controllers\Admin\DesaController;
use App\Http\Controllers\Admin\MasyarakatVerificationController;
use App\Http\Controllers\Admin\PengajuanSuratController as AdminPengajuanSuratController;
use App\Http\Controllers\Admin\TemplateSuratController;
use App\Http\Controllers\Masyarakat\PengajuanSuratController;
use App\Http\Controllers\Masyarakat\ProfilMasyarakatController;
use App\Http\Controllers\Mesin\MesinController;
use App\Http\Controllers\MesinCetak\ScanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratValidationController;
use App\Http\Controllers\VerifikasiSuratController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])
    ->prefix('mesin')
    ->name('mesin.')
    ->group(function () {

        Route::get('/dashboard', [
            MesinController::class,
            'dashboard',
        ])->name('dashboard');

        Route::get('/scan', [
            MesinController::class,
            'scan',
        ])->name('scan');

        Route::post('/verify', [
            MesinController::class,
            'verify',
        ])->name('verify');

        Route::get('/print/{dokumen}', [
            MesinController::class,
            'print',
        ])->name('print');
    });

Route::get(
    '/verifikasi-surat/{token}',
    [VerifikasiSuratController::class, 'show']
)->name('surat.verifikasi');

Route::get('/surat/validasi/{token}', [
    SuratValidationController::class,
    'show',
])->name('surat.validasi');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('desa', DesaController::class)->except('show')->names('desa');
    Route::resource('provinsi', App\Http\Controllers\Admin\ProvinsiController::class)->except('show')->names('provinsi');
    Route::resource('kota', App\Http\Controllers\Admin\KotaController::class)->except('show')->names('kota');
    Route::resource('kecamatan', App\Http\Controllers\Admin\KecamatanController::class)->except('show')->names('kecamatan');
    Route::resource('admin-desa', AdminDesaController::class)
        ->except('show')
        ->parameters(['admin-desa' => 'adminDesa'])
        ->names('admin-desa');
});

// Region JSON endpoints used for chained selects (public)
Route::get('/regions/provinces', [App\Http\Controllers\RegionController::class, 'provinces']);
Route::get('/regions/regencies/{provinsi}', [App\Http\Controllers\RegionController::class, 'regencies']);
Route::get('/regions/districts/{kota}', [App\Http\Controllers\RegionController::class, 'districts']);
Route::get('/regions/villages/{kecamatan}', [App\Http\Controllers\RegionController::class, 'villages']);

Route::middleware(['auth', 'role:admin_desa'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('masyarakat', [MasyarakatVerificationController::class, 'index'])->name('masyarakat.index');
    Route::get('masyarakat/{masyarakat}', [MasyarakatVerificationController::class, 'show'])->name('masyarakat.show');
    Route::patch('masyarakat/{masyarakat}/approve', [MasyarakatVerificationController::class, 'approve'])->name('masyarakat.approve');
    Route::patch('masyarakat/{masyarakat}/reject', [MasyarakatVerificationController::class, 'reject'])->name('masyarakat.reject');

    Route::get('pengajuan', [AdminPengajuanSuratController::class, 'index'])->name('pengajuan.index');
    Route::get('pengajuan/{pengajuan}', [AdminPengajuanSuratController::class, 'show'])->name('pengajuan.show');
    Route::patch('pengajuan/{pengajuan}/approve', [AdminPengajuanSuratController::class, 'approve'])->name('pengajuan.approve');
    Route::patch('pengajuan/{pengajuan}/reject', [AdminPengajuanSuratController::class, 'reject'])->name('pengajuan.reject');
    // secure dokumen download endpoints (only admin desa for same desa can download)
    Route::get('pengajuan/dokumen/{dokumen}/word', [AdminPengajuanSuratController::class, 'downloadWord'])->name('pengajuan.dokumen.word');
    Route::get('pengajuan/dokumen/{dokumen}/pdf', [AdminPengajuanSuratController::class, 'downloadPdf'])->name('pengajuan.dokumen.pdf');
});

Route::middleware(['auth', 'role:super_admin,admin_desa'])->prefix('admin')->name('admin.')->group(function () {
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

Route::middleware(['auth', 'role:masyarakat'])->prefix('masyarakat')->name('masyarakat.')->group(function () {
    Route::get('profil', [ProfilMasyarakatController::class, 'edit'])->name('profil.edit');
    Route::patch('profil', [ProfilMasyarakatController::class, 'update'])->name('profil.update');
    Route::get('pengajuan', [PengajuanSuratController::class, 'index'])->name('pengajuan.index');
    Route::get('pengajuan/riwayat', [PengajuanSuratController::class, 'riwayat'])->name('pengajuan.riwayat');
    Route::get('pengajuan/{jenisSurat}/create', [PengajuanSuratController::class, 'create'])->name('pengajuan.create');
    Route::post('pengajuan/{jenisSurat}', [PengajuanSuratController::class, 'store'])->name('pengajuan.store');
    Route::get('pengajuan/detail/{pengajuan}', [PengajuanSuratController::class, 'show'])
        ->middleware('can:view,pengajuan')
        ->name('pengajuan.show');
});

// Mesin cetak (QR scanner)
Route::middleware(['auth', 'role:mesin,mesin_cetak'])->prefix('mesin')->name('mesin.')->group(function () {
    Route::get('scan', [ScanController::class, 'index'])->name('scan');
    Route::get('verifikasi/{token}', [ScanController::class, 'verify'])->name('verifikasi');
    Route::post('verify', [ScanController::class, 'verifyAjax'])->name('verify');
    Route::get('print/{dokumen}', [ScanController::class, 'print'])->name('print');
    Route::post('printed/{dokumen}', [ScanController::class, 'markPrinted'])->name('printed');
});

require __DIR__.'/auth.php';
