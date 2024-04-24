@extends('templates/main', ['titulo'=>"DETALHES DO LANÇAMENTO"])

@section('conteudo')

    <x-textbox name="" label="Aluno" type="text" value="{{$data->aluno->nome}}" disabled="true"/>
    <x-textbox name="" label="Curso" type="text" value="{{$curso->nome}}" disabled="true"/>
    <x-textbox name="" label="Categoria" type="text" value="{{$data->categoria->nome}}" disabled="true"/>
    <x-textbox name="" label="Atividade" type="text" value="{{$data->atividade}}" disabled="true"/>
    <x-textbox name="" label="Total de Horas" type="number" value="{{$data->horas}}" disabled="true"/>
    
    <div class="row">
        <div class="col text-start mt-3">
            <x-button label="Voltar" type="link" route="comprovante.index" color="secondary"/>
        </div>
    </div>
    
    
@endsection