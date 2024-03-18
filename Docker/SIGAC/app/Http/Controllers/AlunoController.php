<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Aluno;
use Illuminate\Http\Request;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
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

        $data = $this->repository->selectAllByTurmas();
        return view('aluno.index', compact('data'));
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
        $objRole = (new RoleRepository())->findFirstByColumn('nome', 'ALUNO');
        
        if(isset($objCurso) && isset($objTurma) && isset($objRole)) {
            // Create User
            $objUser = new User();
            $objUser->name = mb_strtoupper($request->nome, 'UTF-8');
            $objUser->email = mb_strtolower($request->email, 'UTF-8');
            $objUser->password = Hash::make($request->password); 
            $objUser->curso()->associate($objCurso);
            $objUser->role()->associate($objRole);
            (new UserRepository())->save($objUser);
            // Create Aluno
            $obj = new Aluno();
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->cpf = $request->cpf;
            $obj->email = mb_strtolower($request->email, 'UTF-8');
            $obj->password = Hash::make($request->password); 
            $obj->curso()->associate($objCurso);
            $obj->turma()->associate($objTurma);
            $obj->user()->associate($objUser);
            $this->repository->save($obj);
            return redirect()->route('aluno.index');
        }
        
        return view('message')
                ->with('template', "main")
                ->with('type', "danger")
                ->with('titulo', "OPERAÇÃO INVÁLIDA")
                ->with('message', "Não foi possível efetuar o procedimento!")
                ->with('link', "aluno.index");
    }

    public function show(string $id) {
        $data = $this->repository->findByIdWith(['curso', 'turma'], $id);

        if(isset($data)) {
            return view('aluno.show', compact('data'));
        }

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "aluno.index");
        
    }

    public function edit(string $id) {
        $cursos = (new CursoRepository())->selectAll();
        $turmas = (new TurmaRepository())->selectAll();
        $data = $this->repository->findById($id);

        if(isset($cursos) && isset($turmas) && isset($data)) {
            return view('aluno.edit', compact(['data', 'cursos', 'turmas']));
        }
        
        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "aluno.index");
    }

    public function update(Request $request, string $id) {
        
        $obj = $this->repository->findById($id);
        $objCurso = (new CursoRepository())->findById($request->curso_id);
        $objTurma = (new TurmaRepository())->findById($request->turma_id);
        
        if(isset($obj) && isset($objCurso) && isset($objTurma)) {
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->cpf = $request->cpf;
            $obj->curso()->associate($objCurso);
            $obj->turma()->associate($objTurma);
            $this->repository->save($obj);
            return redirect()->route('aluno.index');
        }
        
        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "aluno.index");
    }

    public function destroy(string $id){
        
        if($this->repository->delete($id))  {
            return redirect()->route('aluno.index');;
        }
        
        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "aluno.index");
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
