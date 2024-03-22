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
    private $curso_id = 1;
    private $path = "documentos";

    public function __construct(){
        $this->repository = new DocumentoRepository();
    }
    
    public function index() {
        $data = $this->repository->findByColumnWith('user_id',$this->user_id, ['categoria']);
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
                ->with('link', "home");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
