<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EixoRepository;
use App\Models\Eixo;
use App\Repositories\CursoRepository;

class EixoController extends Controller {
    
    protected $repository;
    private $rules = [
        'nome' => 'required|min:5|max:200|unique:eixos',
    ];
    private $messages = [
        "required" => "O preenchimento do campo [:attribute] é obrigatório!",
        "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
        "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        "unique" => "Já existe um eixo cadastrado com esse [:attribute]!",
    ];
   
    public function __construct(){
       $this->repository = new EixoRepository();
    }

    public function index() {

        $this->authorize('hasFullPermission', Eixo::class);
        $data = $this->repository->selectAllWith(
            ['curso'],
            (object) ["use" => true, "rows" => $this->repository->getRows()]
        );
        return view('eixo.index')->with('data', $data);
        return $data;
    }

    public function create() {

        $this->authorize('hasFullPermission', Eixo::class);
        return view('eixo.create');
    }

    public function store(Request $request) {

        $this->authorize('hasFullPermission', Eixo::class);
        $request->validate($this->rules, $this->messages);
        $obj = new Eixo();
        $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
        $this->repository->save($obj);
        return redirect()->route('eixo.index');
    }

    public function show(string $id) {

        $this->authorize('hasFullPermission', Eixo::class);
        $data = $this->repository->findByIdWith(['curso'], $id);
        if(isset($data)) 
            return view('eixo.show', compact('data'));

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "eixo.index");
    }   

    public function edit(string $id) {

        $this->authorize('hasFullPermission', Eixo::class);
        $data = $this->repository->findById($id);
        if(isset($data))
            return view('eixo.edit', compact('data'));

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "eixo.index");
    }

    public function update(Request $request, string $id) {

        $this->authorize('hasFullPermission', Eixo::class);
        $obj = $this->repository->findById($id);
        if(isset($obj)) {
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $this->repository->save($obj);
            return redirect()->route('eixo.index');
        }

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "eixo.index");
    }

    public function destroy(string $id) {

        $this->authorize('hasFullPermission', Eixo::class);
        if($this->repository->delete($id))  {
            return redirect()->route('eixo.index');
        }
        
        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "eixo.index");
    }
}
