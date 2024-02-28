<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EixoSeeder extends Seeder {
    
    public function run(): void {
        $data = [
            ["nome" => "INFORMAÇÃO E COMUNICAÇÃO"],
            ["nome" => "RECURSOS NATURAIS"],
            ["nome" => "CIÊNCIAS HUMANAS"],
        ];
        DB::table('eixos')->insert($data);
    }
}
