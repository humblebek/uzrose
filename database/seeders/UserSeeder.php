<?php

namespace Database\Seeders;

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
        $users = User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('admin123')
        ]);

        $users -> assignRole([1]);

        $users = User::create([
            'name'=>'client',
            'email'=>'client@gmail.com',
            'password'=>Hash::make('client123')
        ]);

        $users -> assignRole([2]);
    }
}
