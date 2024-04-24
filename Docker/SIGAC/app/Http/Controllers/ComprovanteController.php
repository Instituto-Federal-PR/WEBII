<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Comprovante;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\AlunoRepository;
use App\Repositories\CursoRepository;
use App\Repositories\TurmaRepository;
use App\Repositories\CategoriaRepository;
use App\Repositories\ComprovanteRepository;

class ComprovanteController extends Controller {

    protected $repository;
    private $curso_id = 2;      //temporário, até implementar autenticação
    private $user_id = 2;       //temporário, até implementar autenticação

    public function __construct(){
        $this->repository = new ComprovanteRepository();
    }

    public function index() {
        $data = $this->repository->findByColumnWith('user_id', $this->user_id, ['aluno', 'categoria', 'user']);
        return view('comprovante.index', compact('data'));
    }

    public function create() {
        
        $cursos = (new CursoRepository())->selectAll();
        $categorias = [];
        $turmas = [];
        $alunos = [];

        return view('comprovante.create', compact(['categorias', 'cursos', 'turmas', 'alunos']));
    }

    public function store(Request $request) {

        $objCategoria = (new CategoriaRepository())->findById($request->categoria_id);
        $objAluno = (new AlunoRepository())->findById($request->aluno_id);
        $objUser = (new UserRepository())->findById($this->user_id);
        
        if(isset($objCategoria) && isset($objAluno) && isset($objUser)) {
            $obj = new Comprovante();
            $obj->horas = $request->horas;
            $obj->atividade = mb_strtoupper($request->atividade, 'UTF-8');
            $obj->categoria()->associate($objCategoria);
            $obj->aluno()->associate($objAluno);
            $obj->user()->associate($objUser);
            $this->repository->save($obj);
            return redirect()->route('comprovante.index');
        }
        
        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "comprovante.index");
    }

    public function show(string $id) {
        $data = $this->repository->findByIdWith(['aluno', 'categoria', 'user'], $id);
        $curso = (new CursoRepository())->findById($data->aluno->curso_id);
        return view('comprovante.show', compact(['data', 'curso']));
    }

    public function edit(string $id) {
        
        $data = $this->repository->findByIdWith(['aluno'], $id);
        $cursos = (new CursoRepository())->selectAll();
        $categorias = (new CategoriaRepository())->findByColumn('curso_id', $this->curso_id);
        return view('comprovante.edit', compact(['data', 'cursos', 'categorias']));
    }

    public function update(Request $request, string $id) {
        
        $obj = $this->repository->findById($id);
        $objCategoria = (new CategoriaRepository())->findById($request->categoria_id);
        
        if(isset($obj) && isset($objCategoria)) {
            $obj->horas = $request->horas;
            $obj->atividade = mb_strtoupper($request->atividade, 'UTF-8');
            $obj->categoria()->associate($objCategoria);
            $this->repository->save($obj);
            return redirect()->route('comprovante.index');
        }
        
        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "comprovante.index");
    }

    public function destroy(string $id) {
        
        if($this->repository->delete($id))  {
            return redirect()->route('comprovante.index');
        }
        
        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "comprovante.index");
    }
}
