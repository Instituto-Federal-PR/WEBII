<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\CategoriaRepository;
use App\Repositories\DocumentoRepository;

class DocumentoController extends Controller {
    
    protected $repository;
    private $user_id = 5;
    private $curso_id = 2;
    private $path = "documentos/alunos";

    public function __construct(){
        $this->repository = new DocumentoRepository();
    }
    
    public function index() {
        $data = $this->repository->findByColumnWith('user_id', $this->user_id, ['categoria']);
        return view('documento.index', compact('data'));
    }

    public function create() {
        $categorias = (new CategoriaRepository())->findByColumn('curso_id', $this->curso_id);
        return view('documento.create', compact('categorias'));
    }

    public function store(Request $request) {
        
        $objCategoria = (new CategoriaRepository())->findById($request->categoria_id);
        $objUser = (new UserRepository())->findById($this->user_id);

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

    public function show(string $id)
    {
        $categorias = (new CategoriaRepository())->findByColumn('curso_id', $this->curso_id);
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

        $categorias = (new CategoriaRepository())->findByColumn('curso_id', $this->curso_id);
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

        $data = $this->repository->getDocumentsToAssess($this->curso_id);
        // return $data;
        return view('documento.list', compact(['data']));
    }

    public function finish(Request $request, string $id) {

        // dd($request);
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
