<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlunoSeeder extends Seeder {
   
    public function run(): void {

        $data = [
            [
                "cpf" => "000.000.000-01",
                "user_id" => 2,
                "turma_id" => 6,
            ],
        ];
        DB::table('alunos')->insert($data);
    }
}
