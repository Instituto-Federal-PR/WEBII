<?php

namespace App\Http\Controllers;

use App\Events\HourRegister;
use App\Models\Documento;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Repositories\CategoriaRepository;
use App\Repositories\DocumentoRepository;

class DocumentoController extends Controller {
    
    protected $repository;
    private $path = "documentos/alunos";
    private $rules = [
        'descricao' => 'required|min:5|max:200',
        'horas' => 'required',
        'categoria_id' => 'required',
        'documento' => 'required',
    ];
    private $messages = [
        "required" => "O preenchimento do campo [:attribute] é obrigatório!",
        "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
        "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
    ];
    
    public function __construct(){
        $this->repository = new DocumentoRepository();
    }
    
    public function index() {

        $this->authorize('hasFullPermission', Documento::class);
        $data = $this->repository->findByColumnWith(
            'user_id', 
            Auth::user()->id, 
            ['categoria'],
            (object) ["use" => true, "rows" => $this->repository->getRows()]
        );
        return view('documento.index', compact('data'));
    }

    public function create() {

        $this->authorize('hasFullPermission', Documento::class);
        $categorias = (new CategoriaRepository())->findByColumn(
            'curso_id', 
            Auth::user()->curso_id,
            (object) ["use" => false, "rows" => 0]
        );
        return view('documento.create', compact('categorias'));
    }

    public function store(Request $request) {
     
        $this->authorize('hasFullPermission', Documento::class);
        // Registra o Evento HourRegister
        event(
            new HourRegister(
                Auth::user(),
                $request->categoria_id,
                mb_strtoupper($request->descricao, 'UTF-8'),
                $request->horas,
            )
        );
        
        $request->validate($this->rules, $this->messages);
        $objCategoria = (new CategoriaRepository())->findById($request->categoria_id);
        $objUser = (new UserRepository())->findById(Auth::user()->id);

        if($request->hasFile('documento') && isset($objCategoria) && isset($objUser)) {
            // Registra a Solicitação
            $obj = new Documento();
            $obj->descricao = mb_strtoupper($request->descricao, 'UTF-8');
            $obj->horas_in = $request->horas;
            $obj->status = 0;
            $obj->categoria()->associate($objCategoria);
            $obj->user()->associate($objUser);
            $id = $this->repository->saveAndReturnId($obj);    
            // Efetua o Upload do Documento
            $extensao_arq = $request->file('documento')->getClientOriginalExtension();
            $nome_arq = $id.'_'.time().'.'.$extensao_arq;
            $request->file('documento')->storeAs("public/$this->path", $nome_arq);
            $obj->url = $this->path."/".$nome_arq;
            $this->repository->save($obj);
            return redirect()->route('documento.index');    
        }

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "documento.index");
    }

    public function show(string $id) {

        $this->authorize('hasFullPermission', Documento::class);
        $categorias = (new CategoriaRepository())->findByColumn(
            'curso_id', 
            Auth::user()->curso_id,
            (object) ["use" => false, "rows" => 0]
        );
        $data = $this->repository->findByIdWith(['categoria'], $id);
        $data = $this->repository->mapStatus($data);
        
        if(isset($data) && isset($categorias)) {
            return view('documento.show', compact(['categorias', 'data']));
        }

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "documento.index");
    }

    public function edit(string $id) {

        $this->authorize('hasFullPermission', Documento::class);
        $categorias = (new CategoriaRepository())->findByColumn(
            'curso_id', 
            Auth::user()->curso_id,
            (object) ["use" => false, "rows" => 0]
        );
        $data = $this->repository->findById($id);

        // Permite alteração apenas para status solicitado
        if(isset($data) && isset($categorias) && $data->status == 0) {
            $data = $this->repository->mapStatus($data);
            return view('documento.edit', compact(['categorias', 'data']));
        }

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "documento.index");
    }

    public function update(Request $request, string $id) {
        
        $this->authorize('hasFullPermission', Documento::class);
        $obj = $this->repository->findById($id);
        $objCategoria = (new CategoriaRepository())->findById($request->categoria_id);
        
        if($request->hasFile('documento') && isset($obj) && isset($objCategoria)) {
            $obj->descricao = mb_strtoupper($request->descricao, 'UTF-8');
            $obj->horas_in = $request->horas;
            $obj->status = 0;
            $obj->categoria()->associate($objCategoria);
            $id = $this->repository->saveAndReturnId($obj);    
            // Efetua o Upload do Documento
            $extensao_arq = $request->file('documento')->getClientOriginalExtension();
            $nome_arq = $id.'_'.time().'.'.$extensao_arq;
            $request->file('documento')->storeAs("public/$this->path", $nome_arq);
            $obj->url = $this->path."/".$nome_arq;
            $this->repository->save($obj);
            return redirect()->route('documento.index');    
        }

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "documento.index");

    }

    public function destroy(string $id) {
        
        $this->authorize('hasFullPermission', Documento::class);
        $data = $this->repository->findById($id);

        // Permite a remoção apenas para status solicitado
        if($data->status == 0) {
            if($this->repository->delete($id))  {
                return redirect()->route('documento.index');
            }
        }
        
        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "documento.index");
    }

    public function list() {

        $this->authorize('hasAssessPermission', Documento::class);
        $data = $this->repository->getDocumentsToAssess(Auth::user()->curso_id, true);
        return view('documento.list', compact(['data']));
    }

    public function finish(Request $request, string $id) {

        $this->authorize('hasAssessPermission', Documento::class);
        $obj = $this->repository->findById($id);
        $horas_out = $request->input('horas_out_'.$id);

        if(isset($obj)) {
            $obj->status = $request->input('status_'.$id);
            if($obj->status == -1) $horas_out = 0;
            $obj->horas_out = $horas_out;
            $obj->comentario = $request->input('comment_'.$id);
            $this->repository->save($obj);
            return redirect()->route('assess.list');  
        }

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "assess.list");
    }
}
