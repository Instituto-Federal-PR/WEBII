<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CategoriaRepository;
use App\Repositories\DocumentoRepository;
use App\Models\Documento;

class DocumentoController extends Controller
{
    protected $repository;
    private $user_id = 5;
    private $curso_id = 1;
    private $path = "documentos/alunos";

    public function __construct(){
        $this->repository = new DocumentoRepository();
    }

    public function request() {
        $categorias = (new CategoriaRepository())->findByColumn('curso_id', $this->curso_id);
        return view('documento.create', compact('categorias'));
    }

    public function send(Request $request) {
    

        $objCategoria = (new CategoriaRepository())->findById($request->categoria_id);

        if($request->hasFile('foto') && isset($objCategoria)) {
            // Registra a Solicitação
            $obj = new Documento();
            $obj->horas_in = $request->nome;
            $obj->categoria()->associate($objCategoria);
            $id = $this->repository->saveAndReturnId($obj);    
            // Efetua o Upload do Documento
            $extensao_arq = $request->file('documento')->getClientOriginalExtension();
            $nome_arq = $id.'_'.time().'.'.$extensao_arq;
            $request->file('documento')->storeAs("public/$this->path", $nome_arq);
            $obj->url = $this->path."/".$nome_arq;
            $this->repository->save($obj);
            return redirect()->route('home');    
        }

        return view('message')
                    ->with('template', "main")
                    ->with('type', "danger")
                    ->with('titulo', "OPERAÇÃO INVÁLIDA")
                    ->with('message', "Não foi possível efetuar o procedimento!")
                    ->with('link', "home");
    }
}
