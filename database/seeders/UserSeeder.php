<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::all();
        $users = [];

        // hash take coputation power
        $password = Hash::make('password');
        // Hashing Passwords: Hashing passwords can be computationally expensive, especially if there are many users being created.
        

        foreach ($roles as $role) {

            $users[] = [
                // 'id' => $role->id,
                'name' => ucfirst($role->name),
                'email' => strtolower(str_replace(' ', '', $role->name)) . '@mail.com',
                'password' => $password,
                'role_id' => $role->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        User::insert($users);
    }
}
