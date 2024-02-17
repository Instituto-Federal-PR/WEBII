<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DeclaracaoRepository;

class DeclaracaoController extends Controller {
    
    protected $repository;

    public function __construct(){
        $this->repository = new DeclaracaoRepository();
    }

    public function index() {
        $data = $this->repository->selectAllWith(['aluno', 'comprovante']);
        return $data;    
    }

    public function create() {
        // retorna, para o usuário, a view de criação de Comprovante
    }

    public function store(Request $request) {
        
    }

    public function show(string $id) {
        $data = $this->repository->findById($id);
        return $data;
    }

    public function edit(string $id) {
        // $data = $this->repository->findById($id);
        // retorna, para o usuário, a view de edição de Comporvante - passa objeto $data
    }

    public function update(Request $request, string $id) {
        
    }

    public function destroy(string $id) {

        if($this->repository->delete($id))  {
            return "<h1>Delete - OK!</h1>";
        }
        
        return "<h1>Delete - Not found Turma!</h1>";
    }
}
