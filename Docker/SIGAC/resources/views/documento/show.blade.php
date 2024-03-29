@extends('templates/main', ['titulo'=>"DETALHES DA CATEGORIA"])

@section('conteudo')

    <x-textbox name="descricao" label="Descrição" type="text" :value="$data->descricao" disabled="true"/>
    <x-textbox name="horas" label="Total de Horas" type="number" :value="$data->horas_in" disabled="true"/>
    
    <x-selectbox name="categoria_id" label="Categoria" color="success" :data="$categorias" field="nome" disabled="true" :select="$data->categoria_id"/>
    <div class="row">
        <div class="col text-start">
            <x-button label="Voltar" type="link" route="documento.index" color="secondary"/>
        </div>
        <div class="col text-end">
            <x-button label="Documento" type="document" :route="asset('storage/'.$data->url)" color="primary"/>
        </div>
    </div>
    
@endsection