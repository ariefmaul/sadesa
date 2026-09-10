<?php

namespace Tests\Feature;

use App\Models\Desa;
use App\Models\PengumumanDesa;
use App\Models\TransparansiAnggaran;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MultiDesaPublicContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_masyarakat_can_view_own_pengumuman(): void
    {
        $desaA = Desa::create(['nama' => 'Desa A', 'kode' => 'A', 'kecamatan_id' => null]);
        $user = User::factory()->create(['desa_id' => $desaA->id, 'role' => 'masyarakat']);
        $pengumuman = PengumumanDesa::create([
            'desa_id' => $desaA->id,
            'user_id' => $user->id,
            'judul' => 'Kerja Bakti',
            'isi' => 'Isi pengumuman',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->actingAs($user)
            ->get(route('masyarakat.pengumuman.show', $pengumuman))
            ->assertOk();
    }

    public function test_masyarakat_cannot_view_other_desa_pengumuman(): void
    {
        $desaA = Desa::create(['nama' => 'Desa A', 'kode' => 'A', 'kecamatan_id' => null]);
        $desaB = Desa::create(['nama' => 'Desa B', 'kode' => 'B', 'kecamatan_id' => null]);
        $userA = User::factory()->create(['desa_id' => $desaA->id, 'role' => 'masyarakat']);
        $userB = User::factory()->create(['desa_id' => $desaB->id, 'role' => 'masyarakat']);

        $pengumumanB = PengumumanDesa::create([
            'desa_id' => $desaB->id,
            'user_id' => $userB->id,
            'judul' => 'Pengumuman B',
            'isi' => 'Isi B',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->actingAs($userA)
            ->get(route('masyarakat.pengumuman.show', $pengumumanB))
            ->assertStatus(403);
    }

    public function test_admin_cannot_edit_other_desa_pengumuman(): void
    {
        $desaA = Desa::create(['nama' => 'Desa A', 'kode' => 'A', 'kecamatan_id' => null]);
        $desaB = Desa::create(['nama' => 'Desa B', 'kode' => 'B', 'kecamatan_id' => null]);
        $adminA = User::factory()->create(['desa_id' => $desaA->id, 'role' => 'admin_desa']);
        $userB = User::factory()->create(['desa_id' => $desaB->id, 'role' => 'masyarakat']);

        $pengumumanB = PengumumanDesa::create([
            'desa_id' => $desaB->id,
            'user_id' => $userB->id,
            'judul' => 'Pengumuman B',
            'isi' => 'Isi B',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->actingAs($adminA)
            ->get(route('admin.pengumuman.edit', $pengumumanB))
            ->assertStatus(403);
    }

    public function test_masyarakat_cannot_download_other_desa_transparansi_pdf(): void
    {
        $desaA = Desa::create(['nama' => 'Desa A', 'kode' => 'A', 'kecamatan_id' => null]);
        $desaB = Desa::create(['nama' => 'Desa B', 'kode' => 'B', 'kecamatan_id' => null]);
        $userA = User::factory()->create(['desa_id' => $desaA->id, 'role' => 'masyarakat']);
        $userB = User::factory()->create(['desa_id' => $desaB->id, 'role' => 'masyarakat']);

        $transparansi = TransparansiAnggaran::create([
            'desa_id' => $desaB->id,
            'user_id' => $userB->id,
            'judul' => 'APBDes 2026',
            'deskripsi' => 'Deskripsi',
            'periode' => '2026',
            'pdf_path' => 'transparansi/anggaran-b.pdf',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->actingAs($userA)
            ->get(route('masyarakat.transparansi.download', $transparansi))
            ->assertStatus(403);
    }
}
