<?php

namespace Tests\Feature;

use App\Models\Desa;
use App\Models\JenisSurat;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TemplateSuratFieldOptionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_select_field_with_options(): void
    {
        $desa = Desa::create(['nama' => 'Desa A', 'kode' => 'A', 'kecamatan_id' => null]);
        $admin = User::factory()->create(['desa_id' => $desa->id, 'role' => 'admin_desa']);
        $template = JenisSurat::create([
            'nama' => 'Surat Keterangan',
            'kode' => 'SKT',
            'desa_id' => $desa->id,
            'aktif' => true,
        ]);

        $this->actingAs($admin)
            ->post(route('admin.template-surat.fields.store', $template), [
                'nama_field' => 'jenis kelamin',
                'label' => 'Jenis Kelamin',
                'sumber_data' => 'pengajuan',
                'tipe' => 'select',
                'options' => "Laki-laki\nPerempuan",
                'wajib' => true,
                'urutan' => 1,
            ])
            ->assertRedirect();

        $field = $template->fresh()->fields()->first();

        $this->assertNotNull($field);
        $this->assertSame('select', $field->inputType());
        $this->assertSame(['Laki-laki', 'Perempuan'], $field->selectOptions());
    }

    public function test_store_field_keeps_remaining_placeholders_for_uncreated_fields(): void
    {
        $desa = Desa::create(['nama' => 'Desa A', 'kode' => 'A', 'kecamatan_id' => null]);
        $admin = User::factory()->create(['desa_id' => $desa->id, 'role' => 'admin_desa']);
        $template = JenisSurat::create([
            'nama' => 'Surat Keterangan',
            'kode' => 'SKT2',
            'desa_id' => $desa->id,
            'aktif' => true,
        ]);

        $response = $this->actingAs($admin)
            ->withSession(['placeholders' => ['nama', 'alamat_ktp', 'tanggal_pengajuan']])
            ->post(route('admin.template-surat.fields.store', $template), [
                'nama_field' => 'nama',
                'label' => 'Nama',
                'sumber_data' => 'pengajuan',
                'tipe' => 'text',
                'wajib' => false,
                'urutan' => 1,
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('placeholders', ['alamat_ktp', 'tanggal_pengajuan']);
    }
}
