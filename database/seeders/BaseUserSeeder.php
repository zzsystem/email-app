<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class BaseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@email.com'],
            [
                'name' => 'admin',
                'email' => 'admin@email.com',
                'password' => 'asdQWE123',
            ]
        );

        $admin->assignRole('admin');
    }
}