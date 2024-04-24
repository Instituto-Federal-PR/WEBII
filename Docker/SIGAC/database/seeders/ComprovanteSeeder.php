<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComprovanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [   
                "horas" => 12,
                "atividade" => "ORGANIZAÇÃO DA SEMANA ACADÊMICA",
                "categoria_id" => 5,
                "aluno_id" => 1,
                "user_id" => 2,
            ],
            [   
                "horas" => 20,
                "atividade" => "MATERIAL DIDÁTICO - DESENVOLVIMENTO WEB",
                "categoria_id" => 6,
                "aluno_id" => 1,
                "user_id" => 2,
            ],
            [   
                "horas" => 35,
                "atividade" => "MATERIAL DIDÁTICO - DESENVOLVIMENTO WEB",
                "categoria_id" => 3,
                "aluno_id" => 2,
                "user_id" => 3,
            ],
            [   
                "horas" => 40,
                "atividade" => "ORGANIZAÇÃO DA SEMANA ACADÊMICA",
                "categoria_id" => 2,
                "aluno_id" => 3,
                "user_id" => 3,
            ],
            [   
                "horas" => 15,
                "atividade" => "ORGANIZAÇÃO DA SEMANA ACADÊMICA",
                "categoria_id" => 8,
                "aluno_id" => 4,
                "user_id" => 2,
            ],
            [   
                "horas" => 50,
                "atividade" => "ORGANIZAÇÃO DA SEMANA ACADÊMICA",
                "categoria_id" => 7,
                "aluno_id" => 7,
                "user_id" => 3,
            ],
            [   
                "horas" => 80,
                "atividade" => "ORGANIZAÇÃO DA SEMANA ACADÊMICA",
                "categoria_id" => 5,
                "aluno_id" => 9,
                "user_id" => 2,
            ],
            [   
                "horas" => 90,
                "atividade" => "MATERIAL DIDÁTICO - DESENVOLVIMENTO WEB",
                "categoria_id" => 5,
                "aluno_id" => 10,
                "user_id" => 3,
            ],
        ];
        DB::table('comprovantes')->insert($data);
    }
}
