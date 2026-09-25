<?php

namespace Database\Factories;

use App\Models\ProfilMasyarakat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => (static::$password ??= Hash::make('password')),
            'remember_token' => Str::random(10),
            'status_verifikasi' => 'disetujui',
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            if ($user->role === 'masyarakat' && ! $user->profilMasyarakat()->exists()) {
                ProfilMasyarakat::create([
                    'user_id' => $user->id,
                    'nomor_kk' => '0000000000000000',
                    'tempat_lahir' => 'Kota',
                    'tanggal_lahir' => '1990-01-01',
                    'alamat' => 'Jl. Contoh No. 1',
                    'rt' => '01',
                    'rw' => '02',
                    'dusun' => 'Dusun A',
                    'agama' => 'Islam',
                    'status_perkawinan' => 'Belum Kawin',
                    'pekerjaan' => 'Wiraswasta',
                    'kewarganegaraan' => 'WNI',
                    'no_hp' => '081234567890',
                ]);
            }
        });
    }

    public function unverified(): static
    {
        return $this->state(
            fn (array $attributes) => [
                'email_verified_at' => null,
            ],
        );
    }
}
