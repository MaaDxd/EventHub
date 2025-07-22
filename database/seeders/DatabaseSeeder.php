<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Usuario administrador
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@eventhub.com',
            'role' => 'admin'
        ]);

        // Creador de eventos
        User::factory()->create([
            'name' => 'Event Creator',
            'email' => 'creator@eventhub.com',
            'role' => 'creator'
        ]);

        // Usuario regular
        User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@eventhub.com',
            'role' => 'user'
        ]);
    }
}
