<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TurmaSeeder extends Seeder {
    
    public function run(): void {
        $data = [
            // TÉCNICO EM INFORMÁTICA
            [
                "ano" => 2021,
                "curso_id" => 1,
            ],
            [
                "ano" => 2022,
                "curso_id" => 1,
            ],
            [
                "ano" => 2023,
                "curso_id" => 1,
            ],
            [
                "ano" => 2024,
                "curso_id" => 1,
            ],
            // TECNÓLOGO EM ANÁLISE E DESENVOLVIMENTO DE SISTEMAS
            [
                "ano" => 2022,
                "curso_id" => 2,
            ],
            [
                "ano" => 2023,
                "curso_id" => 2,
            ],
            [
                "ano" => 2024,
                "curso_id" => 2,
            ],
        ];
        DB::table('turmas')->insert($data);
    }
}
