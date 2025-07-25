<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'celdula' => 27647120,
                'nombre' => 'Jesus Alejandro',
                'apellido' => 'Acevedo Meneses',
                'username' => 'jacevedom',
                'rol_id' => 1,
                'division_id' => 3,
                'password' => '@J27647120a**'
            ]
        ];

        foreach ($data as $key => $value) {
            User::create($data[$key]);
        }
    }
}
