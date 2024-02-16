<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AlunoRepository;
use App\Repositories\UserRepository;
use App\Repositories\TurmaRepository;
use App\Models\Aluno;

class AlunoController extends Controller {
    
    protected $repository;

    public function __construct(){
        $this->repository = new AlunoRepository();
    }

    public function index() {
        $data = $this->repository->selectAllWith(['turma', 'user']);
        return $data;    
    }

    public function create() {
        // retorna, para o usuário, a view de criação de Aluno
    }

    public function store(Request $request) {

        $objUser = (new UserRepository())->findById($request->user_id);
        $objTurma = (new TurmaRepository())->findById($request->turma_id);
        
        if(isset($objUser) && isset($objTurma)) {
            $obj = new Aluno();
            $obj->cpf = $request->cpf;
            $obj->user()->associate($objUser);
            $obj->turma()->associate($objTurma);
            $this->repository->save($obj);
            return "<h1>Store - OK!</h1>";
        }
        
        return "<h1>Store - Not found User or Turma!</h1>";
    }

    public function show(string $id) {
        $data = $this->repository->findById($id);
        return $data;
    }

    public function edit(string $id) {
        // $data = $this->repository->findById($id);
        // retorna, para o usuário, a view de edição de Aluno - passa objeto $data
    }

    public function update(Request $request, string $id) {
        
        $obj = $this->repository->findById($id);
        $objUser = (new UserRepository())->findById($request->user_id);
        $objTurma = (new TurmaRepository())->findById($request->turma_id);
        
        if(isset($obj) && isset($objUser) && isset($objTurma)) {
            $obj->cpf = $request->cpf;
            $obj->user()->associate($objUser);
            $obj->turma()->associate($objTurma);
            $this->repository->save($obj);
            return "<h1>Store - OK!</h1>";
        }
        
        return "<h1>Store - Not found User or Turma!</h1>";
    }

    public function destroy(string $id){
        
        if($this->repository->delete($id))  {
            return "<h1>Delete - OK!</h1>";
        }
        
        return "<h1>Delete - Not found Turma!</h1>";
    }
}
