<?php

namespace Database\Seeders;

use App\Models\ReplySupport;
use App\Models\Support;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->create();

        User::create([
            'name' => 'Silvio Lucas dos Santos',
            'email' => 'silviolucas_santos@hotmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        Support::factory(15)->create();

        ReplySupport::factory(50)->create();
    }
}
