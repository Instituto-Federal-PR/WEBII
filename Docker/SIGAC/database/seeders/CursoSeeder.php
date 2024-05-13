<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
                "total_horas" => 150,
                "eixo_id" => 1,
                "nivel_id" => 2,
            ],
            [
                "nome" => "TÉCNICO EM MEIO AMBIENTE",
                "sigla" => "MAMB",
                "total_horas" => 100,
                "eixo_id" => 2,
                "nivel_id" => 1,
            ],
            [
                "nome" => "TECNÓLOGO EM GESTÃO AMBIENTAL",
                "sigla" => "TADS",
                "total_horas" => 150,
                "eixo_id" => 2,
                "nivel_id" => 2,
            ],
            [
                "nome" => "TÉCNICO EM MECÂNICA",
                "sigla" => "MEC",
                "total_horas" => 120,
                "eixo_id" => 5,
                "nivel_id" => 1,
            ],
            [
                "nome" => "LICENCIATURA EM CIÊNCIAS SOCIAIS",
                "sigla" => "LCS",
                "total_horas" => 150,
                "eixo_id" => 3,
                "nivel_id" => 2,
            ],
            [
                "nome" => "TÉCNICO EM PRODUÇÃO CULTURAL",
                "sigla" => "PROD",
                "total_horas" => 140,
                "eixo_id" => 6,
                "nivel_id" => 1,
            ],
        ];
        DB::table('cursos')->insert($data);
    }
}
