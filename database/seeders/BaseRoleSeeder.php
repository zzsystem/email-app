<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class BaseRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'user',
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['name' => $role]);
        }
    }
}