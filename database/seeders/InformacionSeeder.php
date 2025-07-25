<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Informacion;

class InformacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'titulo' => 'Manual de Mantenimiento de equipo',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores ut dolorem quasi nobis facilis praesentium officiis nesciunt est? Non dolor molestias minus voluptate tenetur earum, eveniet corporis et enim. Minima.',
                'user_id' => 1,
                'division_id' => 1
            ],
            [
                'titulo' => 'Manual de levantamiento de servicios',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores ut dolorem quasi nobis facilis praesentium officiis nesciunt est? Non dolor molestias minus voluptate tenetur earum, eveniet corporis et enim. Minima.',
                'user_id' => 1,
                'division_id' => 2
            ],
            [
                'titulo' => 'Manual de Respaldos de Bases de Datos',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores ut dolorem quasi nobis facilis praesentium officiis nesciunt est? Non dolor molestias minus voluptate tenetur earum, eveniet corporis et enim. Minima.',
                'user_id' => 1,
                'division_id' => 3
            ]
        ];

        foreach ($data as $key => $value) {
            Informacion::create($data[$key]);
        }
    }
}
