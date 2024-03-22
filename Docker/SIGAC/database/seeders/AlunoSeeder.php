<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AlunoSeeder extends Seeder {
   
    public function run(): void {

        $data = [
            [   
                "nome" => "LÚCIA EDUARDA SILVA ALVES",
                "cpf" => "00000000001",
                "email" => "lucia.alves@gmail.com", 
                "password" => Hash::make('123lucia123'), 
                "user_id" => 4,
                "curso_id" => 2,
                "turma_id" => 4,
            ],
            [   
                "nome" => "FABÍOLA NASCIMENTO SOUSA",
                "cpf" => "00000000002",
                "email" => "fabiola.sousa@gmail.com", 
                "password" => Hash::make('123fabi123'), 
                "user_id" => 5,
                "curso_id" => 1,
                "turma_id" => 1,
            ],
        ];
        DB::table('alunos')->insert($data);
    }
}
