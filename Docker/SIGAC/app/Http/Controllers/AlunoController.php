<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\AlunoRepository;
use App\Repositories\CursoRepository;
use App\Repositories\TurmaRepository;

class AlunoController extends Controller {
    
    protected $repository;

    public function __construct(){
        $this->repository = new AlunoRepository();
    }

    public function index() {
        $data = $this->repository->selectAllWith(['turma', 'user']);
        return $data;    
    }

    public function register() {
        
        $cursos = (new CursoRepository())->selectAll();
        $turmas = (new TurmaRepository())->selectAll();
        return view('aluno.register', compact(['cursos', 'turmas']));
    }

    public function storeRegister(Request $request) {
        
        $objCurso = (new CursoRepository())->findById($request->curso_id);
        $objTurma = (new TurmaRepository())->findById($request->turma_id);
        
        if(isset($objCurso) && isset($objTurma)) {
            $obj = new Aluno();
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->cpf = $request->cpf;
            $obj->email = mb_strtolower($request->email, 'UTF-8');
            $obj->password = Hash::make($request->password); 
            $obj->curso()->associate($objCurso);
            $obj->turma()->associate($objTurma);
            $this->repository->save($obj);

            return view('message')
                    ->with('template', "site")
                    ->with('type', "success")
                    ->with('titulo', "")
                    ->with('message', "[OK] Registro efetuado com sucesso!")
                    ->with('link', "site");
        }
        
        return view('message')
                    ->with('template', "site")
                    ->with('type', "danger")
                    ->with('titulo', "")
                    ->with('message', "Não foi possível efetuar o registro!")
                    ->with('link', "site");
    }

    public function create() {
        $cursos = (new CursoRepository())->selectAll();
        $turmas = (new TurmaRepository())->selectAll();
        return view('aluno.create', compact(['cursos', 'turmas']));
    }

    public function store(Request $request) {

        // $this->validateRows($request);

        $objCurso = (new CursoRepository())->findById($request->curso_id);
        $objTurma = (new TurmaRepository())->findById($request->turma_id);
        
        if(isset($objCurso) && isset($objTurma)) {
            $obj = new Aluno();
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->cpf = $request->cpf;
            $obj->email = mb_strtolower($request->email, 'UTF-8');
            $obj->password = Hash::make($request->password); 
            $obj->curso()->associate($objCurso);
            $obj->turma()->associate($objTurma);
            $this->repository->save($obj);
            return "<h1>Store - OK!</h1>";
        }
        
        return "<h1>Store - Not found Curso or Turma!</h1>";
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
        $objCurso = (new CursoRepository())->findById($request->curso_id);
        $objTurma = (new TurmaRepository())->findById($request->turma_id);
        
        if(isset($obj) && isset($objCurso) && isset($objTurma)) {
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->cpf = $request->cpf;
            $obj->email = mb_strtolower($request->email, 'UTF-8');
            $obj->password = Hash::make($request->password); 
            $obj->curso()->associate($objCurso);
            $obj->turma()->associate($objTurma);
            $this->repository->save($obj);
            return "<h1>Update- OK!</h1>";
        }
        
        return "<h1>Store - Not found Curso or Turma!</h1>";
    }

    public function destroy(string $id){
        
        if($this->repository->delete($id))  {
            return "<h1>Delete - OK!</h1>";
        }
        
        return "<h1>Delete - Not found Aluno!</h1>";
    }

    public function validateRows(Request $request) {
        
        $regras = [
            'nome' => 'required|min:10|max:200',
            'cpf' => 'required|min:11|max:11|unique:alunos',
            'email' => 'required|min:8|max:200|unique:alunos',
            'senha' => 'required|min:6|max:20',
            'curso' => 'required',
            'turma' => 'required',
            'confirmacao' => 'required|same:senha'
        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "Já existe um endereço cadastrado com esse [:attribute]!",
            "same" => "O campo [:attribute] deve ter o mesmo conteúdo do campo anterior!"
        ];
        
        $request->validate($regras, $msgs);
    }
}
