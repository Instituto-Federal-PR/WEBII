<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    
    public function run(): void {
        
        $data = [
            [
                // ADMINISTRADOR
                "name" => "MARCUS VINÍCIUS OLIVEIRA", 
                "email" => "admin.admin@ifpr.edu.br", 
                "password" => Hash::make('123admin123'), 
                "role_id" => 1,
                "curso_id" => 1,
            ],
            [
                // COORDENADOR
                "name" => "GIL EDUARDO DE ANDRADE", 
                "email" => "gil.andrade@ifpr.edu.br", 
                "password" => Hash::make('123gil123'), 
                "role_id" => 2,
                "curso_id" => 1,
            ],
            [
                // COORDENADOR
                "name" => "ELVIS CANTERI DE ANDRADE", 
                "email" => "elvis.andrade@ifpr.edu.br", 
                "password" => Hash::make('123elvis123'), 
                "role_id" => 2,
                "curso_id" => 2,
            ],
            [
                // COORDENADOR
                "name" => "IZABEL CAROLINA CAVALLET", 
                "email" => "izabel.cavallet@ifpr.edu.br", 
                "password" => Hash::make('123izabel123'), 
                "role_id" => 2,
                "curso_id" => 3,
            ],
            [
                // PROFESSOR
                "name" => "ORIOSVALDO NASCIMENTO TORRES", 
                "email" => "oriosvaldo.torres@ifpr.edu.br", 
                "password" => Hash::make('123torres123'), 
                "role_id" => 3,
                "curso_id" => 1,
            ],
            [
                // ALUNO
                "name" => "LÚCIA EDUARDA SILVA ALVES", 
                "email" => "lucia.alves@gmail.com", 
                "password" => Hash::make('123lucia123'), 
                "role_id" => 4,
                "curso_id" => 2,
            ],
            [
                // ALUNO
                "name" => "FABÍOLA NASCIMENTO SOUSA", 
                "email" => "fabiola.sousa@gmail.com", 
                "password" => Hash::make('123fabiola123'), 
                "role_id" => 4,
                "curso_id" => 1,
            ],
            [   
                // ALUNO
                "name" => "MATHEUS NOGUEIRA SILVA", 
                "email" => "matheus.silva@gmail.com", 
                "password" => Hash::make('123matheus123'), 
                "role_id" => 4,
                "curso_id" => 1,
            ],
            [   
                // ALUNO
                "name" => "CARLOS HENRIQUE DIAS",
                "email" => "carlos.dias@gmail.com", 
                "password" => Hash::make('123carlos123'), 
                "role_id" => 4,
                "curso_id" => 2,
            ],
            [   
                // ALUNO
                "name" => "LARISSA MAIA",
                "email" => "larissa.maia@gmail.com", 
                "password" => Hash::make('123larissa123'), 
                "role_id" => 4,
                "curso_id" => 2,
            ],
            [   
                // ALUNO
                "name" => "OLIVIA NEVES SANTOS",
                "email" => "olivia.santos@gmail.com", 
                "password" => Hash::make('123olivia123'), 
                "role_id" => 4,
                "curso_id" => 2,
            ],
            [   
                // ALUNO
                "name" => "RODRIGO CARDOSO TAY",
                "email" => "rodrigo.tay@gmail.com", 
                "password" => Hash::make('123rodrigo123'), 
                "role_id" => 4,
                "curso_id" => 2,
            ],
            [   
                // ALUNO
                "name" => "MARINA GAVAS TORRES",
                "email" => "marina.torres@gmail.com", 
                "password" => Hash::make('123marina123'), 
                "role_id" => 4,
                "curso_id" => 1,
            ],
            [   
                // ALUNO
                "name" => "RAFAELA AMORIM",
                "email" => "rafaela.amorim@gmail.com", 
                "password" => Hash::make('123rafaela123'), 
                "role_id" => 4,
                "curso_id" => 2,
            ],
            [   
                // ALUNO
                "name" => "SAMIRA MALOUF ATA",
                "email" => "samira.ata@gmail.com", 
                "password" => Hash::make('123samira123'), 
                "role_id" => 4,
                "curso_id" => 2,
            ],
        ];
        DB::table('users')->insert($data);
    }
}