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
        $data = $this->repository->selectAllAdapted();
        return view('turma.index', compact('data'));
        // return $data;    
    }

    public function create() {
        $cursos = (new CursoRepository())->selectAll();
        return view('turma.create', compact('cursos'));
    }

    public function store(Request $request) {
        
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
        
        $data = $this->repository->findById($id);

        if(isset($data)) {
            $cursos = (new CursoRepository())->selectAll();
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

        $data = $this->repository->findById($id);

        if(isset($data)) {
            $cursos = (new CursoRepository())->selectAll();
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

    public function getTurmasByCurso($value) {
        $data = $this->repository->findByColumn('curso_id', $value);
        return json_encode($data);
    }
}
