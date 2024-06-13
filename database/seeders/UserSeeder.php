<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Encrypt password using bcrypt()
        $hashedPassword = Hash::make('Hola1234');

        DB::table('users')->insert([
            // [
            //     'name' => 'admin',
            //     'surname' => 'admin',
            //     'email' => 'admin@admin.com',
            //     'password' => $hashedPassword, 
            //     'role_id' => '1',
            //     'email_verified_at' => now(),
            //     'remember_token' => Str::random(10),
            //     'created_at' => now(),
            //     'updated_at' => now(),

            // ],
            // [
            //     'name' => 'user',
            //     'surname' => 'user',
            //     'email' => 'user@user.com',
            //     'password' => $hashedPassword, 
            //     'role_id' => '2',
            //     'email_verified_at' => now(),
            //     'remember_token' => Str::random(10),
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'name' => 'Alberto',
            //     'surname' => 'Pérez',
            //     'email' => 'alberto@user.com',
            //     'password' => $hashedPassword, 
            //     'role_id' => '2',
            //     'email_verified_at' => now(),
            //     'remember_token' => Str::random(10),
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'name' => 'Romina',
            //     'surname' => 'Castro',
            //     'email' => 'romina@user.com',
            //     'password' => $hashedPassword, 
            //     'role_id' => '2',
            //     'email_verified_at' => now(),
            //     'remember_token' => Str::random(10),
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'name' => 'José',
            //     'surname' => 'Gúzman',
            //     'email' => 'jose@user.com',
            //     'password' => $hashedPassword, 
            //     'role_id' => '2',
            //     'email_verified_at' => now(),
            //     'remember_token' => Str::random(10),
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'name' => 'Maria',
            //     'surname' => 'Manuela',
            //     'email' => 'mari@user.com',
            //     'password' => $hashedPassword, 
            //     'role_id' => '2',
            //     'email_verified_at' => now(),
            //     'remember_token' => Str::random(10),
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ]
        ]);
    }
}