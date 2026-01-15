<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Delegate seeding to dedicated seeders
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
        ]);
    }
}