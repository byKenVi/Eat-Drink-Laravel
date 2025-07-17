<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate( 
        ['email' => 'admin@mail.fr'],
        [ 'name' => 'Admin',
          'email' => 'admin@mail.fr', 
          'password' => Hash::make('password'), 
          'role' => 'admin', 
          'status' => 'approved', ] ); } 
    
}

