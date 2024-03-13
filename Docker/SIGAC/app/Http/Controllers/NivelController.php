<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\NivelRepository;
use App\Models\Nivel;

class NivelController extends Controller {

    protected $repository;
   
    public function __construct(){
       $this->repository = new NivelRepository();
    }

    public function index() {
        $data = $this->repository->selectAllWith(['curso']);
        return view('nivel.index', compact('data'));
        // return $data;
    }

    public function create() {
        return view('nivel.create');
    }

    public function store(Request $request) {
        $obj = new Nivel();
        $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
        $this->repository->save($obj);
        return redirect()->route('nivel.index');
    }

    public function show(string $id) {
        $data = $this->repository->findByIdWith(['curso'], $id);
        if(isset($data)) 
            return view('nivel.show', compact('data'));

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "nivel.index");
        return $data;
    }

    public function edit(string $id) {

        $data = $this->repository->findById($id);
        if(isset($data))
            return view('nivel.edit', compact('data'));

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
            return redirect()->route('nivel.index');
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
            return redirect()->route('nivel.index');
        }
        
        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "eixo.index");
    }
}
