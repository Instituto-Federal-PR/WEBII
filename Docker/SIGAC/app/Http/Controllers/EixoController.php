<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EixoRepository;
use App\Models\Eixo;
use App\Repositories\CursoRepository;

class EixoController extends Controller {
    
    protected $repository;
   
    public function __construct(){
       $this->repository = new EixoRepository();
    }

    public function index() {
        $data = $this->repository->selectAllWith(['curso']);
        return view('eixo.index')->with('data', $data);
        return $data;
    }

    public function create() {
        return view('eixo.create');
    }

    public function store(Request $request) {
        $obj = new Eixo();
        $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
        $this->repository->save($obj);
        return redirect()->route('eixo.index');
    }

    public function show(string $id) {
        $data = $this->repository->findByIdWith(['curso'], $id);
        if(isset($data)) 
            return view('eixo.show', compact('data'));

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "eixo.index");
    }   

    public function edit(string $id) {
        $data = $this->repository->findById($id);
        if(isset($data))
            return view('eixo.edit', compact('data'));

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "eixo.index");
    }

    public function update(Request $request, string $id) {
        $obj = $this->repository->findById($id);
        if(isset($obj)) {
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $this->repository->save($obj);
            return redirect()->route('eixo.index');
        }

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "eixo.index");
    }

    public function destroy(string $id) {
        if($this->repository->delete($id))  {
            return redirect()->route('eixo.index');
        }
        
        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "eixo.index");
    }
}
