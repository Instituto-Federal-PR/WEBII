<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TurmaRepository;
use App\Repositories\CursoRepository;
use App\Models\Turma;

class TurmaController extends Controller {
    
    protected $repository;

    public function __construct(){
        $this->repository = new TurmaRepository();
    }

    public function index() {
        $data = $this->repository->selectAllWith(['curso']);
        return $data;    
    }

    public function create() {
        // retorna, para o usuário, a view de criação de Turma
    }

    public function store(Request $request) {
        
        $objCurso = (new CursoRepository())->findById($request->curso_id);
        
        if(isset($objCurso)) {
            $obj = new Turma();
            $obj->ano = $request->ano;
            $obj->curso()->associate($objCurso);
            $this->repository->save($obj);
            return "<h1>Store - OK!</h1>";
        }
        
        return "<h1>Store - Not found Curso!</h1>";
    }

    public function show(string $id) {
        $data = $this->repository->findById($id);
        return $data;
    }

    public function edit(string $id) {
        // $data = $this->repository->findById($id);
        // retorna, para o usuário, a view de edição de Turma - passa objeto $data
    }

    public function update(Request $request, string $id) {

        $obj = $this->repository->findById($id);
        $objCurso = (new CursoRepository())->findById($request->curso_id);
        
        if(isset($obj) && isset($objCurso)) {
            $obj->ano = $request->ano;
            $obj->curso()->associate($objCurso);
            $this->repository->save($obj);
            return "<h1>Update - OK!</h1>";
        }
        
        return "<h1>Store - Not found Curso!</h1>";
    }

    public function destroy(string $id) {
        if($this->repository->delete($id))  {
            return "<h1>Delete - OK!</h1>";
        }
        
        return "<h1>Delete - Not found Turma!</h1>";
    }

    public function getTurmasByCurso($value) {
        $data = $this->repository->findByColumn('curso_id', $value);
        return json_encode($data);
    }
}
