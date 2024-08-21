<?php

namespace App\Http\Controllers;

use App\Models\Eixo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;

class EixoController extends Controller {
    
    public function index() {

        $this->authorize('index', Eixo::class);

        $data = Eixo::all();    
        Storage::disk('local')->put('example.txt', 'Contents');
        return view('eixo.index', compact(['data']));
    }

    public function create() {

        $this->authorize('create', Eixo::class);
        return view('eixo.create');
    }

    public function store(Request $request) {

        $this->authorize('create', Eixo::class);

        if($request->hasFile('documento')) {

            $eixo = new Eixo();
            $eixo->nome = $request->nome;
            $eixo->descricao = $request->descricao;
            $eixo->save();
            $ext = $request->file('documento')->getClientOriginalExtension();
            $nome_arq = $eixo->id . "_" . time() . "." . $ext; 
            $request->file('documento')->storeAs("public/", $nome_arq);
            $eixo->url = $nome_arq;
            $eixo->save();

            return redirect()->route('eixo.index');
        }
    }

    public function show($id) {

        $this->authorize('show', Eixo::class);

        $eixo = Eixo::find($id);
        if(isset($eixo)) {
            return view('eixo.show', compact(['eixo']));
        }
        return "<h1>ERRO: EIXO NÃO ENCONTRADO!</h1>";
    }

    public function edit($id) {

        $this->authorize('edit', Eixo::class);

        $eixo = Eixo::find($id);
        if(isset($eixo)) {
            return view('eixo.edit', compact(['eixo']));
        }
        return "<h1>ERRO: EIXO NÃO ENCONTRADO!</h1>";
    }

    public function update(Request $request, $id) {

        $this->authorize('edit', Eixo::class);

        $eixo = Eixo::find($id);
        if(isset($eixo)) {
            $eixo->nome = $request->nome;
            $eixo->descricao = $request->descricao;
            $eixo->save();
            return redirect()->route('eixo.index');
        }
        return "<h1>ERRO: EIXO NÃO ENCONTRADO!</h1>";
    }

    public function destroy($id) {
        
        $this->authorize('destroy', Eixo::class);

        $eixo = Eixo::find($id);
        if(isset($eixo)) {
            $eixo->delete();
            return redirect()->route('eixo.index');
        }
        
        return "<h1>ERRO: EIXO NÃO ENCONTRADO!</h1>";
    }

    public function report() {

        $data = Eixo::all();

        // Instancia um Objeto da Classe Dompdf
        $dompdf = new Dompdf();
        // Carrega o HTML
        $dompdf->loadHtml(view('eixo.pdf', compact('data')));
        // Converte o HTML em PDF
        $dompdf->render();
        // Serializa o PDF para Abertura em uma Nova A
        $dompdf->stream("relatorio-horas-turma.pdf", 
            array("Attachment" => false));
    }

    public function graph() {
        
        $data = json_encode([
            ["NOME", "TOTAL"],
            ["Eduardo", 100],
            ["Maria", 130],
            ["Carlos", 200],
            ["Rafaela", 120],
        ]);

        return view('eixo.graph', compact('data'));
    }
}
