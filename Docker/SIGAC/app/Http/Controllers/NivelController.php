<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\NivelRepository;
use App\Models\Nivel;

class NivelController extends Controller {

    protected $repository;
    private $rules = [
        'nome' => 'required|min:5|max:200|unique:niveis',
    ];
    private $messages = [
        "required" => "O preenchimento do campo [:attribute] é obrigatório!",
        "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
        "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        "unique" => "Já existe um nível de ensino cadastrado com esse [:attribute]!",
    ];
   
    public function __construct(){
       $this->repository = new NivelRepository();
    }

    public function index() {

        $this->authorize('hasFullPermission', Nivel::class);
        $data = $this->repository->selectAllWith(
            ['curso'],
            (object) ["use" => true, "rows" => $this->repository->getRows()]
        );
        return view('nivel.index', compact('data'));
        // return $data;
    }

    public function create() {

        $this->authorize('hasFullPermission', Nivel::class);
        return view('nivel.create');
    }

    public function store(Request $request) {

        $this->authorize('hasFullPermission', Nivel::class);
        $request->validate($this->rules, $this->messages);
        $obj = new Nivel();
        $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
        $this->repository->save($obj);
        return redirect()->route('nivel.index');
    }

    public function show(string $id) {

        $this->authorize('hasFullPermission', Nivel::class);
        $data = $this->repository->findByIdWith(['curso'], $id);
        if(isset($data)) 
            return view('nivel.show', compact('data'));

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "nivel.index");
        return $data;
    }

    public function edit(string $id) {

        $this->authorize('hasFullPermission', Nivel::class);
        $data = $this->repository->findById($id);
        if(isset($data))
            return view('nivel.edit', compact('data'));

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "eixo.index");
    }

    public function update(Request $request, string $id) {

        $this->authorize('hasFullPermission', Nivel::class);
        $obj = $this->repository->findById($id);
        if(isset($obj)) {
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $this->repository->save($obj);
            return redirect()->route('nivel.index');
        }

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "eixo.index");
    }

    public function destroy(string $id) {

        $this->authorize('hasFullPermission', Nivel::class);
        if($this->repository->delete($id))  {
            return redirect()->route('nivel.index');
        }
        
        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "eixo.index");
    }
}
