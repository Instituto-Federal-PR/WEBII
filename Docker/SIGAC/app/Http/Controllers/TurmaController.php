<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\CursoRepository;
use App\Repositories\TurmaRepository;

class TurmaController extends Controller {
    
    protected $repository;
    private $rules = [
        'ano' => 'required|unique:turmas',
    ];
    private $messages = [
        "required" => "O preenchimento do campo [:attribute] é obrigatório!",
        "unique" => "Já existe uma truam cadastrada com esse [:attribute]!",
    ];

    public function __construct(){
        $this->repository = new TurmaRepository();
    }

    public function index() {

        $this->authorize('hasFullPermission', Turma::class);
        $data = $this->repository->selectAllAdapted(Auth::user()->curso_id);
        return view('turma.index', compact('data'));
    }

    public function create() {

        $this->authorize('hasFullPermission', Turma::class);
        $cursos = (new CursoRepository())->selectAll((object) ["use" => false, "rows" => 0]);
        return view('turma.create', compact('cursos'));
    }

    public function store(Request $request) {
        
        $this->authorize('hasFullPermission', Turma::class);
        $request->validate($this->rules, $this->messages);
        $objCurso = (new CursoRepository())->findById($request->curso_id);
        
        if(isset($objCurso)) {
            $obj = new Turma();
            $obj->ano = $request->ano;
            $obj->curso()->associate($objCurso);
            $this->repository->save($obj);
            return redirect()->route('turma.index');
        }

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "turma.index");
    }

    public function show(string $id) {
        
        $this->authorize('hasFullPermission', Turma::class);
        $data = $this->repository->findById($id);

        if(isset($data)) {
            $cursos = (new CursoRepository())->selectAll((object) ["use" => false, "rows" => 0]);
            return view('turma.show', compact(['data', 'cursos']));
        }

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "turma.index");
    }

    public function edit(string $id) {

        $this->authorize('hasFullPermission', Turma::class);
        $data = $this->repository->findById($id);

        if(isset($data)) {
            $cursos = (new CursoRepository())->selectAll((object) ["use" => false, "rows" => 0]);
            return view('turma.edit', compact(['data', 'cursos']));
        }

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "turma.index");
    }

    public function update(Request $request, string $id) {

        $this->authorize('hasFullPermission', Turma::class);
        $obj = $this->repository->findById($id);
        $objCurso = (new CursoRepository())->findById($request->curso_id);
        
        if(isset($obj) && isset($objCurso)) {
            $obj->ano = $request->ano;
            $obj->curso()->associate($objCurso);
            $this->repository->save($obj);
            return redirect()->route('turma.index');
        }
        
        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "turma.index");
    }

    public function destroy(string $id) {

        $this->authorize('hasFullPermission', Turma::class);
        if($this->repository->delete($id))  {
            return redirect()->route('turma.index');
        }
        
        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "turma.index");
    }

    public function getClassesByCourse($value) {
        $data = $this->repository->findByColumn(
            'curso_id', $value,
            (object) ["use" => false, "rows" => 0]
        );
        return json_encode($data);
    }
}
