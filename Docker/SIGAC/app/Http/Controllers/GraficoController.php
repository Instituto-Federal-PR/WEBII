<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GraficoController extends Controller {



    
    
    
    
    
    // Apenas Exemplo - Material de Aula
    public function test() {

        $data =  json_encode([
            ["NOME", "TOTAL DE HORAS"],
            ["MARIA", 150],
            ["CARLOS", 90],
            ["JOÃO", 232],
            ["ANA", 197],
        ]);

        return view('grafico.exemplo', compact(['data'])); 
    }
}
