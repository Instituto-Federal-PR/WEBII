<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourceSeeder extends Seeder
{
    public function run(): void {
        
        $data = [
            ["nome" => "eixo.index"],
            ["nome" => "eixo.create"],
            ["nome" => "eixo.show"],
            ["nome" => "eixo.edit"],
            ["nome" => "eixo.destroy"],
            ["nome" => "nivel.index"],
            ["nome" => "nivel.create"],
            ["nome" => "nivel.show"],
            ["nome" => "nivel.edit"],
            ["nome" => "nivel.destroy"],
            ["nome" => "curso.index"],
            ["nome" => "curso.create"],
            ["nome" => "curso.show"],
            ["nome" => "curso.edit"],
            ["nome" => "curso.destroy"],
        ];
        DB::table('resources')->insert($data);
    }
}
