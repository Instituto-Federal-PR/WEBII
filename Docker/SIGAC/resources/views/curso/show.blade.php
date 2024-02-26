@extends('templates/main', ['titulo'=>"DETALHES DO CURSO"])

@section('conteudo')

    <form action="{{ route('curso.store') }}" method="POST">
        @csrf
        <x-textbox name="nome" label="Nome" type="text" value="{{$data->nome}}" disabled="true"/>
        <x-textbox name="sigla" label="Sigla" type="text" value="{{$data->sigla}}" disabled="true"/>
        <x-textbox name="horas" label="Total de Horas Afins" type="number" value="{{$data->total_horas}}" disabled="true"/>
        <x-textbox name="eixo" label="Eixo" type="text" value="{{$data->eixo->nome}}" disabled="true"/>
        <x-textbox name="nivel" label="Nível de Ensino" type="text" value="{{$data->nivel->nome}}" disabled="true"/>
        <div class="row">
            <div class="col text-start">
                <x-button label="Voltar" type="link" route="curso.index" color="secondary"/>
            </div>
        </div>
    </form>
    
@endsection