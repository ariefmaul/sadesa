<?php

namespace Tests\Feature;

use App\Models\Desa;
use App\Models\Dokumen;
use App\Models\JenisSurat;
use App\Models\PengajuanSurat;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationIsolationTest extends TestCase
{
    use RefreshDatabase;

    public function test_masyarakat_can_view_own_pengajuan()
    {
        $desa = Desa::create(['nama' => 'A', 'kode' => 'A', 'kecamatan_id' => null]);
        $user = User::factory()->create(['desa_id' => $desa->id, 'role' => 'masyarakat']);

        $jenis = JenisSurat::create(['nama' => 'S', 'kode' => 'S1', 'desa_id' => $desa->id, 'aktif' => true]);

        $pengajuan = PengajuanSurat::create([
            'user_id' => $user->id,
            'jenis_surat_id' => $jenis->id,
            'nomor_pengajuan' => 'PGJ-1',
            'data_pengajuan' => [],
            'data_snapshot' => [],
            'status' => 'menunggu',
        ]);

        $this->actingAs($user)
            ->get(route('masyarakat.pengajuan.show', $pengajuan))
            ->assertStatus(200);
    }

    public function test_masyarakat_cannot_view_others_pengajuan()
    {
        $desa = Desa::create(['nama' => 'A', 'kode' => 'A', 'kecamatan_id' => null]);
        $user1 = User::factory()->create(['desa_id' => $desa->id, 'role' => 'masyarakat']);
        $user2 = User::factory()->create(['desa_id' => $desa->id, 'role' => 'masyarakat']);

        $jenis = JenisSurat::create(['nama' => 'S', 'kode' => 'S1', 'desa_id' => $desa->id, 'aktif' => true]);

        $pengajuan = PengajuanSurat::create([
            'user_id' => $user2->id,
            'jenis_surat_id' => $jenis->id,
            'nomor_pengajuan' => 'PGJ-2',
            'data_pengajuan' => [],
            'data_snapshot' => [],
            'status' => 'menunggu',
        ]);

        $this->actingAs($user1)
            ->get(route('masyarakat.pengajuan.show', $pengajuan))
            ->assertStatus(403);
    }

    public function test_masyarakat_cannot_use_jenis_surat_from_other_desa()
    {
        $desaA = Desa::create(['nama' => 'A', 'kode' => 'A', 'kecamatan_id' => null]);
        $desaB = Desa::create(['nama' => 'B', 'kode' => 'B', 'kecamatan_id' => null]);

        $userA = User::factory()->create(['desa_id' => $desaA->id, 'role' => 'masyarakat']);

        $jenisB = JenisSurat::create(['nama' => 'X', 'kode' => 'X1', 'desa_id' => $desaB->id, 'aktif' => true]);

        $this->actingAs($userA)
            ->post(route('masyarakat.pengajuan.store', $jenisB), [])
            ->assertStatus(403);
    }

    public function test_admin_desa_cannot_open_template_from_other_desa()
    {
        $desaA = Desa::create(['nama' => 'A', 'kode' => 'A', 'kecamatan_id' => null]);
        $desaB = Desa::create(['nama' => 'B', 'kode' => 'B', 'kecamatan_id' => null]);

        $adminA = User::factory()->create(['desa_id' => $desaA->id, 'role' => 'admin_desa']);

        $templateB = JenisSurat::create(['nama' => 'T', 'kode' => 'T1', 'desa_id' => $desaB->id, 'aktif' => true]);

        $this->actingAs($adminA)
            ->get(route('admin.template-surat.fields', $templateB))
            ->assertStatus(403);
    }

    public function test_dokumen_policy_denies_cross_desa_access()
    {
        $desaA = Desa::create(['nama' => 'A', 'kode' => 'A', 'kecamatan_id' => null]);
        $desaB = Desa::create(['nama' => 'B', 'kode' => 'B', 'kecamatan_id' => null]);

        $userA = User::factory()->create(['desa_id' => $desaA->id, 'role' => 'masyarakat']);
        $userB = User::factory()->create(['desa_id' => $desaB->id, 'role' => 'masyarakat']);

        $jenisB = JenisSurat::create(['nama' => 'X', 'kode' => 'X1', 'desa_id' => $desaB->id, 'aktif' => true]);

        $pengajuanB = PengajuanSurat::create([
            'user_id' => $userB->id,
            'jenis_surat_id' => $jenisB->id,
            'nomor_pengajuan' => 'PGJ-B',
            'data_pengajuan' => [],
            'data_snapshot' => [],
            'status' => 'menunggu',
        ]);

        $dok = Dokumen::create([
            'pengajuan_surat_id' => $pengajuanB->id,
            'nomor_dokumen' => 'DOC-B',
            'file' => 'dokumen/file.docx',
            'qr_token' => (string) \Illuminate\Support\Str::uuid(),
            'status' => 'tersedia',
        ]);

        $policy = new \App\Policies\DokumenPolicy();
        $this->assertFalse($policy->view($userA, $dok));
    }
}
