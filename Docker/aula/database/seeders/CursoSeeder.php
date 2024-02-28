<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CursoSeeder extends Seeder {
    
    public function run(): void {
        $data = [
            [
                "nome" => "TÉCNICO EM INFORMÁTICA",
                "sigla" => "INFO",
                "total_horas" => 100,
                "eixo_id" => 1,
                "nivel_id" => 1,
            ],
            [
                "nome" => "TECNÓLOGO EM ANÁLISE E DESENVOLVIMENTO DE SISTEMAS",
                "sigla" => "TADS",
                "total_horas" => 200,
                "eixo_id" => 1,
                "nivel_id" => 2,
            ],
        ];
        DB::table('cursos')->insert($data);
    }
}
