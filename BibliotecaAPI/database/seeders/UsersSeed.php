<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new Usuario();
        $admin->nombre = 'admin';
        $admin->email = 'admin@gmail.com';
        $admin->password =Hash::make( 'adminadmin');
        $admin->rol= 1;        
        $admin->save();

    }
}
