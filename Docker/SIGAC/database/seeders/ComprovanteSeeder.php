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
                "categoria_id" => 2,
                "aluno_id" => 1,
                "user_id" => 1,
            ],
            [   
                "horas" => 20,
                "atividade" => "MATERIAL DIDÁTICO - DESENVOLVIMENTO WEB",
                "categoria_id" => 3,
                "aluno_id" => 1,
                "user_id" => 1,
            ],
        ];
        DB::table('comprovantes')->insert($data);
    }
}
