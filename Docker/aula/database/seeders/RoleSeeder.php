<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder {
    
    public function run(): void {
        $data = [
            ["nome" => "ADMINISTRADOR"],
            ["nome" => "COORDENADOR"],
            ["nome" => "PROFESSOR"],
            ["nome" => "ALUNO"],
        ];
        DB::table('roles')->insert($data);
    }
}
