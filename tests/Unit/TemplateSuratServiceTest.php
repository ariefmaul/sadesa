<?php

namespace Tests\Unit;

use App\Services\SuratFieldResolver;
use App\Services\TemplateSuratService;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TemplateSuratServiceTest extends TestCase
{
    #[Test]
    public function it_normalizes_placeholder_names_from_docx_variables(): void
    {
        $service = new TemplateSuratService($this->createMock(SuratFieldResolver::class));

        $this->assertSame('nama', $service->normalizePlaceholderName('${nama}'));
        $this->assertSame('nama_lengkap', $service->normalizePlaceholderName('${ nama lengkap }'));
        $this->assertSame('nomor_surat', $service->normalizePlaceholderName('${nomor.surat}'));
        $this->assertSame('', $service->normalizePlaceholderName('${w_t_w_r_proof_w_type_spellstart_w_r}'));
    }

    #[Test]
    public function it_treats_titimangsa_as_reserved_system_placeholder(): void
    {
        $service = new TemplateSuratService($this->createMock(SuratFieldResolver::class));

        $this->assertSame([], $service->validatePlaceholders(['titimangsa']));
    }
}
