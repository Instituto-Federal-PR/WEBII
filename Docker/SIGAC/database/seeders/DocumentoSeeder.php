<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DocumentoSeeder extends Seeder {
    
    public function run(): void {

        $dt = Carbon::now();
        $dateNow = $dt->toDateTimeString();

        $data = [
            [   
                "url" => "documentos/alunos/1_1712167197.pdf",
                "descricao" => "CURSO DE INGLÊS - WIZARD",
                "horas_in" => 45,
                "status" => 1,
                "comentario" => "DEFERIDO",
                "horas_out" => 45,
                "categoria_id" => 5,
                "user_id" => 5,
                "created_at" => $dateNow
            ],
            [   
                "url" => "documentos/alunos/1_1712337258.pdf",
                "descricao" => "PALESTRA SOBRE ARDUINO",
                "horas_in" => 5,
                "status" => 0,
                "comentario" => NULL,
                "horas_out" => 0,
                "categoria_id" => 6,
                "user_id" => 5,
                "created_at" => $dateNow
            ],
            [   
                "url" => "documentos/alunos/2_1712512121.pdf",
                "descricao" => "MINICURSO SOBRE NODEJS",
                "horas_in" => 12,
                "status" => 1,
                "comentario" => "DEFERIDO",
                "horas_out" => 8,
                "categoria_id" => 6,
                "user_id" => 6,
                "created_at" => $dateNow
            ],
            [   
                "url" => "documentos/alunos/3_1712605514.pdf",
                "descricao" => "CURSO DE ESPANHOL - FISK",
                "horas_in" => 45,
                "status" => 0,
                "comentario" => NULL,
                "horas_out" => 0,
                "categoria_id" => 5,
                "user_id" => 7,
                "created_at" => $dateNow
            ],
            [   
                "url" => "documentos/alunos/5_1712167315.pdf",
                "descricao" => "CURSO DE FRANCÊS - CULTURA EUROPÉIA",
                "horas_in" => 30,
                "status" => 0,
                "comentario" => NULL,
                "horas_out" => 0,
                "categoria_id" => 5,
                "user_id" => 9,
                "created_at" => $dateNow
            ],
            [   
                "url" => "documentos/alunos/6_1712337299.pdf",
                "descricao" => "MINICURSO SOBRE PYTHON",
                "horas_in" => 20,
                "status" => 1,
                "comentario" => "DEFERIDO",
                "horas_out" => 10,
                "categoria_id" => 6,
                "user_id" => 10,
                "created_at" => $dateNow
            ],
            [   
                "url" => "documentos/alunos/6_1712771455.pdf",
                "descricao" => "CURSO DE INGLÊS - WHATSUP",
                "horas_in" => 60,
                "status" => 0,
                "comentario" => NULL,
                "horas_out" => 0,
                "categoria_id" => 5,
                "user_id" => 10,
                "created_at" => $dateNow
            ],
            [   
                "url" => "documentos/alunos/9_1712771455.pdf",
                "descricao" => "CURSO DE INGLÊS - WIZARD",
                "horas_in" => 100,
                "status" => 1,
                "comentario" => "DEFERIDO",
                "horas_out" => 100,
                "categoria_id" => 5,
                "user_id" => 12,
                "created_at" => $dateNow
            ],
            [   
                "url" => "documentos/alunos/10_1712771455.pdf",
                "descricao" => "CURSO DE ALEMÃO - WIZARD",
                "horas_in" => 130,
                "status" => 1,
                "comentario" => "DEFERIDO",
                "horas_out" => 130,
                "categoria_id" => 5,
                "user_id" => 13,
                "created_at" => $dateNow
            ],
        ];

        DB::table('documentos')->insert($data);
    }
}
