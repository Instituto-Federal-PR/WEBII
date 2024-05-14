@extends('templates/main', ['titulo'=>"NOVA TURMA"])

@section('conteudo')

    <form action="{{ route('turma.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <x-textbox name="ano" label="Ano" type="number" value="{{$data->ano}}" disabled="false"/>
        <x-selectbox name="curso" label="Curso" color="success" :data="$cursos" field="nome" disabled="true" select="{{$data->curso_id}}"/>
        <input type="hidden" name="curso_id" value="{{Auth::user()->curso_id}}">
        <div class="row">
            <div class="col text-start">
                <x-button label="Voltar" type="link" route="turma.index" color="secondary"/>
            </div>
            <div class="col text-end">
                <x-button label="Cadastar" type="submit" route="" color="success"/>
            </div>
        </div>
    </form>
    
@endsection