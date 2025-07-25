<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Division;

class DivisionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Divison de Soporte',
            'Divison de Redes',
            'Divison de Desarrollo'
        ];

        foreach ($data as $key => $value) {
            Division::create([
                    'division' => $data[$key],
                ]);
        }

    }
}
