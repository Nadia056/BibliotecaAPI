<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Roles::create([
            'nombre' => 'Admin',
        ]);
        Roles::create([
            'nombre' => 'Usuario',
        ]);
    }
}
