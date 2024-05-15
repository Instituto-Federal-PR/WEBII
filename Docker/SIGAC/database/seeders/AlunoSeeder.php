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
                "user_id" => 6,
                "curso_id" => 2,
                "turma_id" => 4,
            ],
            [   
                "nome" => "FABÍOLA NASCIMENTO SOUSA",
                "cpf" => "00000000002",
                "email" => "fabiola.sousa@gmail.com", 
                "password" => Hash::make('123fabiola123'), 
                "user_id" => 7,
                "curso_id" => 1,
                "turma_id" => 1,
            ],
            [   
                "nome" => "MATHEUS NOGUEIRA SILVA",
                "cpf" => "00000000003",
                "email" => "matheus.silva@gmail.com", 
                "password" => Hash::make('123matheus123'), 
                "user_id" => 8,
                "curso_id" => 1,
                "turma_id" => 2,
            ],
            [   
                "nome" => "CARLOS HENRIQUE DIAS",
                "cpf" => "00000000004",
                "email" => "carlos.dias@gmail.com", 
                "password" => Hash::make('123carlos123'), 
                "user_id" => 9,
                "curso_id" => 2,
                "turma_id" => 3,
            ],
            [   
                "nome" => "LARISSA MAIA",
                "cpf" => "00000000005",
                "email" => "larissa.maia@gmail.com", 
                "password" => Hash::make('123larissa123'), 
                "user_id" => 10,
                "curso_id" => 2,
                "turma_id" => 3,
            ],
            [   
                "nome" => "OLIVIA NEVES SANTOS",
                "cpf" => "00000000006",
                "email" => "olivia.santos@gmail.com", 
                "password" => Hash::make('123olivia123'), 
                "user_id" => 11,
                "curso_id" => 2,
                "turma_id" => 4,
            ],
            [   
                "nome" => "RODRIGO CARDOSO TAY",
                "cpf" => "00000000007",
                "email" => "rodrigo.tay@gmail.com", 
                "password" => Hash::make('123rodrigo123'), 
                "user_id" => 12,
                "curso_id" => 2,
                "turma_id" => 3,
            ],
            [   
                "nome" => "MARINA GAVAS TORRES",
                "cpf" => "00000000008",
                "email" => "marina.torres@gmail.com", 
                "password" => Hash::make('123marina123'), 
                "user_id" => 13,
                "curso_id" => 1,
                "turma_id" => 1,
            ],
            [   
                "nome" => "RAFAELA AMORIM",
                "cpf" => "00000000009",
                "email" => "rafaela.amorim@gmail.com", 
                "password" => Hash::make('123samira123'), 
                "user_id" => 14,
                "curso_id" => 2,
                "turma_id" => 3,
            ],
            [   
                "nome" => "SAMIRA MALOUF ATA",
                "cpf" => "00000000010",
                "email" => "samira.ata@gmail.com", 
                "password" => Hash::make('123samira123'), 
                "user_id" => 15,
                "curso_id" => 2,
                "turma_id" => 4,
            ],
        ];
        DB::table('alunos')->insert($data);
    }
}
