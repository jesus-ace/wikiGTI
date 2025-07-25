<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Administrador',
            'Editor',
            'Lector'
        ];

        foreach ($data as $key => $value) {
            Roles::create([
                    'rol' => $data[$key],
                ]);
        }
    }
}
