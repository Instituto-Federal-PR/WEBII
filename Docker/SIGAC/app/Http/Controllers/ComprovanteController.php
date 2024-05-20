<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Comprovante;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Repositories\AlunoRepository;
use App\Repositories\CursoRepository;
use App\Repositories\TurmaRepository;
use App\Repositories\CategoriaRepository;
use App\Repositories\ComprovanteRepository;

class ComprovanteController extends Controller {

    protected $repository;
    private $rules = [
        'atividade' => 'required|min:5|max:200',
        'horas' => 'required',
        'curso_id' => 'required',
    ];
    private $messages = [
        "required" => "O preenchimento do campo [:attribute] é obrigatório!",
        "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
        "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
    ];
    
    public function __construct(){
        $this->repository = new ComprovanteRepository();
    }

    public function index() {

        $this->authorize('hasFullPermission', Comprovante::class);
        $data = $this->repository->findByColumnWith(
            'user_id', 
            Auth::user()->id, 
            ['aluno', 'categoria', 'user'],
            (object) ["use" => true, "rows" => $this->repository->getRows()]
        );
        return view('comprovante.index', compact('data'));
    }

    public function create() {
        
        $this->authorize('hasFullPermission', Comprovante::class);
        $cursos = (new CursoRepository())->selectAll((object) ["use" => false, "rows" => 0]);
        $categorias = [];
        $turmas = [];
        $alunos = [];

        return view('comprovante.create', compact(['categorias', 'cursos', 'turmas', 'alunos']));
    }

    public function store(Request $request) {

        $this->authorize('hasFullPermission', Comprovante::class);
        $request->validate($this->rules, $this->messages);
        $objCategoria = (new CategoriaRepository())->findById($request->categoria_id);
        $objAluno = (new AlunoRepository())->findById($request->aluno_id);
        $objUser = (new UserRepository())->findById(Auth::user()->id);
        
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

        $this->authorize('hasFullPermission', Comprovante::class);
        $data = $this->repository->findByIdWith(['aluno', 'categoria', 'user'], $id);
        $curso = (new CursoRepository())->findById($data->aluno->curso_id);
        return view('comprovante.show', compact(['data', 'curso']));
    }

    public function edit(string $id) {
        
        $this->authorize('hasFullPermission', Comprovante::class);
        $data = $this->repository->findByIdWith(['aluno'], $id);
        $cursos = (new CursoRepository())->selectAll((object) ["use" => false, "rows" => 0]);
        $categorias = (new CategoriaRepository())->findByColumn(
            'curso_id', 
            Auth::user()->curso_id,
            (object) ["use" => false, "rows" => 0]
        );
        return view('comprovante.edit', compact(['data', 'cursos', 'categorias']));
    }

    public function update(Request $request, string $id) {
        
        $this->authorize('hasFullPermission', Comprovante::class);
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
        
        $this->authorize('hasFullPermission', Comprovante::class);
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
