<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Member;
use App\Models\Missionary;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

final class TenantDatabaseSeeder extends Seeder
{
    /**
     * Seed the tenants's database.
     */
    public function run(): void
    {
        $this->call([
            Tenants\CategorySeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Member::factory(5)->has(Address::factory())->create();

        Missionary::factory(5)->has(Address::factory())->create();

    }
}
