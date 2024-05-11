<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Aluno;
use Illuminate\Http\Request;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\AlunoRepository;
use App\Repositories\CursoRepository;
use App\Repositories\TurmaRepository;
use App\Repositories\DocumentoRepository;
use App\Repositories\ComprovanteRepository;

class AlunoController extends Controller {
    
    protected $repository;

    public function __construct(){
        $this->repository = new AlunoRepository();
    }

    public function index() {

        $this->authorize('hasFullPermission', Aluno::class);
        $data = $this->repository->selectAllByTurmas(Auth::user()->curso_id);
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

        $this->authorize('hasFullPermission', Aluno::class);
        $cursos = (new CursoRepository())->selectAll();
        $turmas = (new TurmaRepository())->selectAll();
        return view('aluno.create', compact(['cursos', 'turmas']));
    }

    public function store(Request $request) {

        $this->authorize('hasFullPermission', Aluno::class);
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

        $this->authorize('hasFullPermission', Aluno::class);
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

        $this->authorize('hasFullPermission', Aluno::class);
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
        
        $this->authorize('hasFullPermission', Aluno::class);
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
        
        $this->authorize('hasFullPermission', Aluno::class);
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

    public function listStudentHours() {

        $this->authorize('hasListStudentHoursPermission', Aluno::class);
        $aluno_id = ((new AlunoRepository())->findFirstByColumn('user_id', Auth::user()->id))->id;

        $solicitadas = (new DocumentoRepository())->getTotalHoursByStudent(Auth::user()->id);
        $lancadas = (new ComprovanteRepository())->getTotalHoursByStudent($aluno_id);
        $necessarias = ((new CursoRepository())->findById(Auth::user()->curso_id))->total_horas;

        $data = (Object) [
            "id" => $aluno_id,
            "necessario" => $necessarias,
            "solicitado" => $solicitadas->total_in,
            "validado" => $solicitadas->total_out,
            "lancado" => $lancadas,
            "total" => $solicitadas->total_out + $lancadas,
        ];

        return view('aluno.listhours', compact('data'));
    }

    public function getStudentsByClass($value) {
        $data = $this->repository->findByColumn('turma_id', $value);
        return json_encode($data);
    }

    public function listNewRegisters() {
        
        $this->authorize('hasValidateRegisterPermission', Aluno::class);
        $data = $this->repository->selectAllAdapted(false, Auth::user()->curso_id, ['curso', 'turma']);
        return view('aluno.validate', compact('data'));
    }

    public function validateNewRegisters(Request $request, $id) {
        
        $this->authorize('hasValidateRegisterPermission', Aluno::class);
        $aluno = $this->repository->findById($id);

        if(isset($aluno)) {

            $response = $request->input('status_'.$id);
            $role_id = Role::getRoleId("ALUNO");
            
            // Accept - create and bind user
            if($response == 1) {
                // Create
                $user = new User();
                $user->name = mb_strtoupper($aluno->nome, 'UTF-8');
                $user->email = mb_strtolower($aluno->email, 'UTF-8');
                $user->password = $aluno->password; 
                $user->curso()->associate((new CursoRepository())->findById($aluno->curso_id));
                $user->role()->associate((new RoleRepository())->findById($role_id));
                (new UserRepository())->save($user);
                // Bind
                $aluno->user()->associate($user);
                $this->repository->save($aluno);
            }
            // Refuse - remove register
            else {
                $this->destroy($id);
            }

            return redirect()->route('validate.list');
        }

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "validate.list");        
    }

    public function validateRows(Request $request) {
        
        $regras = [
            'nome' => 'required|min:10|max:200',
            'cpf' => 'required|min:11|max:11|unique:alunos',
            'email' => 'required|min:8|max:200|unique:alunos',
            'senha' => 'required|min:6|max:20',
            'curso' => 'required',
            'turma' => 'required',
        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "Já existe um endereço cadastrado com esse [:attribute]!",
        ];
        
        $request->validate($regras, $msgs);
    }
}
