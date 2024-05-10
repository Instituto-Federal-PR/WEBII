<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourceSeeder extends Seeder
{
    public function run(): void {
        
        $data = [
            // MENU ADMINISTRADOR   ----------------------------
            ["nome" => "administrador"],                    // 1
            ["nome" => "administrador.coordenadores"],      // 2
            ["nome" => "administrador.cursos"],             // 3
            ["nome" => "administrador.eixos"],              // 4
            ["nome" => "administrador.niveis"],             // 5
            // MENU COORDENADOR     ----------------------------
            ["nome" => "coordenador"],                      // 6
            ["nome" => "coordenador.alunos"],               // 7
            ["nome" => "coordenador.avaliar"],              // 8
            ["nome" => "coordenador.categorias"],           // 9
            ["nome" => "coordenador.graficos.alunos"],      // 10
            ["nome" => "coordenador.graficos.horas"],       // 11
            ["nome" => "coordenador.professores"],          // 12
            ["nome" => "coordenador.relatorio"],            // 13
            ["nome" => "coordenador.turmas"],               // 14
            ["nome" => "coordenador.validar"],              // 15
            // MENU PROFESSOR       -----------------------------
            ["nome" => "professor"],                        // 16
            ["nome" => "professor.cadastrar"],              // 17
            // MENU ALUNO           -----------------------------
            ["nome" => "aluno"],                            // 18
            ["nome" => "aluno.solicitar"],                  // 19
            ["nome" => "aluno.gerar"],                      // 20
        ];
        DB::table('resources')->insert($data);
    }
}
