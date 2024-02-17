<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder {

    public function run(): void {

        $data = [
            // TÉCNICO EM INFORMÁTICA
            [
                "nome" => "ESTÁGIO NÃO OBRIGATÓRIO",
                "maximo_horas" => 60,
                "curso_id" => 1,
            ],
            [
                "nome" => "CURSO DE LÍNGUAS",
                "maximo_horas" => 30,
                "curso_id" => 1,
            ],
            [
                "nome" => "PALESTRAS RELACIONADAS AO CURSO",
                "maximo_horas" => 30,
                "curso_id" => 1,
            ],
            [
                "nome" => "TRABALHO DE MONITORIA",
                "maximo_horas" => 60,
                "curso_id" => 1,
            ],
            // TECNÓLOGO EM ANÁLISE E DESENVOLVIMENTO DE SISTEMAS
            [
                "nome" => "CURSOS MINISTRADOS ",
                "maximo_horas" => 40,
                "curso_id" => 2,
            ],
            [
                "nome" => "PARTICIPAÇÃO EM CONGRESSOS",
                "maximo_horas" => 40,
                "curso_id" => 2,
            ],
            [
                "nome" => "PUBLICAÇÃO DE ARTIGOS EM JORNAIS",
                "maximo_horas" => 20,
                "curso_id" => 2,
            ],
            [
                "nome" => "PUBLICAÇÃO DE ARTIGOS EM CONGRESSOS",
                "maximo_horas" => 20,
                "curso_id" => 2,
            ],
        ];
        DB::table('categorias')->insert($data);
    }
}
