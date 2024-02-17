<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DeclaracaoSeeder extends Seeder {
    
    public function run(): void {

        $data = [
            [
                "hash" => Hash::make('aluno_id + comprovante_id'),
                "data" => date('Y-m-d H:i:s'),
                "aluno_id" => 1,
                "comprovante_id" => 1,
            ],
        ];
        DB::table('declaracoes')->insert($data);
    }
}
