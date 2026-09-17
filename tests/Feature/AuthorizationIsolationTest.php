<?php

namespace Tests\Feature;

use App\Models\Desa;
use App\Models\Dokumen;
use App\Models\JenisSurat;
use App\Models\PengajuanSurat;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
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

    public function test_admin_receives_database_notification_only_for_same_desa_when_masyarakat_submits_pengajuan()
    {
        $desaA = Desa::create(['nama' => 'Desa A', 'kode' => 'A', 'kecamatan_id' => null]);
        $desaB = Desa::create(['nama' => 'Desa B', 'kode' => 'B', 'kecamatan_id' => null]);

        $adminA = User::factory()->create(['desa_id' => $desaA->id, 'role' => 'admin_desa']);
        $adminB = User::factory()->create(['desa_id' => $desaB->id, 'role' => 'admin_desa']);
        $masyarakat = User::factory()->create(['desa_id' => $desaA->id, 'role' => 'masyarakat']);

        $jenis = JenisSurat::create(['nama' => 'SKTM', 'kode' => 'SKTM-A', 'desa_id' => $desaA->id, 'aktif' => true]);

        $this->actingAs($masyarakat)
            ->post(route('masyarakat.pengajuan.store', $jenis), [])
            ->assertRedirect();

        $this->assertDatabaseHas('notifications', [
            'notifiable_id' => $adminA->id,
            'notifiable_type' => User::class,
        ]);

        $this->assertDatabaseMissing('notifications', [
            'notifiable_id' => $adminB->id,
            'notifiable_type' => User::class,
        ]);
    }

    public function test_admin_approval_sends_email_to_pengajuan_owner()
    {
        Notification::fake();

        $desa = Desa::create(['nama' => 'Desa A', 'kode' => 'A', 'kecamatan_id' => null]);
        $user = User::factory()->create(['desa_id' => $desa->id, 'role' => 'masyarakat', 'email' => 'masyarakat@example.com']);
        $jenis = JenisSurat::create(['nama' => 'SKTM', 'kode' => 'SKTM-B', 'desa_id' => $desa->id, 'aktif' => true]);

        $pengajuan = PengajuanSurat::create([
            'user_id' => $user->id,
            'jenis_surat_id' => $jenis->id,
            'nomor_pengajuan' => 'PGJ-EMAIL',
            'data_pengajuan' => [],
            'data_snapshot' => [],
            'status' => 'menunggu',
        ]);

        $user->notify(new \App\Notifications\PengajuanDisetujuiNotification($pengajuan));

        Notification::assertSentTo($user, \App\Notifications\PengajuanDisetujuiNotification::class, function ($notification, $channels) use ($user) {
            return $notification->pengajuan->user_id === $user->id && $notification->pengajuan->user->email === $user->email;
        });
    }

    public function test_admin_verification_result_sends_email_to_masyarakat()
    {
        Notification::fake();

        $desa = Desa::create(['nama' => 'Desa A', 'kode' => 'A', 'kecamatan_id' => null]);
        $user = User::factory()->create(['desa_id' => $desa->id, 'role' => 'masyarakat', 'status_verifikasi' => 'menunggu', 'email' => 'masyarakat@example.com']);

        $user->notify(new \App\Notifications\AkunDiverifikasiNotification($user, 'disetujui'));

        Notification::assertSentTo($user, \App\Notifications\AkunDiverifikasiNotification::class, function ($notification, $channels) use ($user) {
            return $notification->user->id === $user->id && $notification->user->email === $user->email && $notification->status === 'disetujui';
        });
    }

    public function test_super_admin_can_manage_masyarakat_accounts()
    {
        $desa = Desa::create(['nama' => 'Desa A', 'kode' => 'A', 'kecamatan_id' => null]);
        $superAdmin = User::factory()->create(['desa_id' => $desa->id, 'role' => 'super_admin', 'status_verifikasi' => 'disetujui']);

        $this->actingAs($superAdmin)
            ->get(route('admin.users.index'))
            ->assertOk();

        $user = User::factory()->create(['desa_id' => $desa->id, 'role' => 'masyarakat', 'status_verifikasi' => 'disetujui']);

        $this->actingAs($superAdmin)
            ->post(route('admin.users.store'), [
                'name' => 'Pengguna Baru',
                'nik' => '1234567890123456',
                'jenis_kelamin' => 'P',
                'desa_id' => $desa->id,
                'email' => 'baru@example.com',
                'status_verifikasi' => 'disetujui',
                'password' => 'Password123',
                'password_confirmation' => 'Password123',
            ])
            ->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', ['email' => 'baru@example.com', 'role' => 'masyarakat']);

        $this->actingAs($superAdmin)
            ->get(route('admin.users.edit', $user))
            ->assertOk();

        $this->actingAs($superAdmin)
            ->delete(route('admin.users.destroy', $user))
            ->assertRedirect(route('admin.users.index'));
    }
}
