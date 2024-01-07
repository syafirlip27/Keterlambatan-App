<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     'name' => 'Administrator',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('admin'),
        //     'role' => 'admin',
        //     'rayon_id' => '99'
        // ]);
        DB::table('users')->insert([
            'name' => 'Mirza',
            'email' => 'mirza@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'ps',
            'rayon_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
