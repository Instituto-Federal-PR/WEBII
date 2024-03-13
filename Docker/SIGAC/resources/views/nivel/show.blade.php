@extends('templates/main', ['titulo'=>"DETALHES DO NÍVEL DE ENSINO"])

@section('conteudo')

    <x-textbox name="nome" label="Nome" type="text" value="{{$data->nome}}" disabled="true"/>
    <x-listbox title="Cursos" :data="$data->curso" field="nome"/>
    <div class="row">
        <div class="col text-start mt-3">
            <x-button label="Voltar" type="link" route="nivel.index" color="secondary"/>
        </div>
    </div>
    
    
@endsection