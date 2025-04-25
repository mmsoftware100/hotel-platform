<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'id' => 1,
            'name' => 'Admin'
        ]);
        Role::create([
            'id' => 2,
            'name' => 'Owner'
        ]);
        Role::create([
            'id' => 3,
            'name' => 'Staff'
        ]);
        Role::create([
            'id' => 4,
            'name' => 'User'
        ]);
    }
}
