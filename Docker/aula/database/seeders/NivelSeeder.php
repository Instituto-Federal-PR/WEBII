<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NivelSeeder extends Seeder {
    
    public function run(): void {
        $data = [
            ["nome" => "ENSINO MÉDIO INTEGRADO"],
            ["nome" => "GRADUAÇÃO"],
        ];
        DB::table('niveis')->insert($data);
    }
}
