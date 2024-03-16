@extends('templates/main', ['titulo'=>"DETALHES DA TURMA"])

@section('conteudo')

    <x-textbox name="ano" label="Ano" type="number" :value="$data->ano" disabled="true"/>
    <x-selectbox name="curso_id" label="Curso" color="success" :data="$cursos" field="nome" disabled="true" :select="$data->curso_id"/>
    <div class="row">
        <div class="col text-start">
            <x-button label="Voltar" type="link" route="turma.index" color="secondary"/>
        </div>
    </div>
    
    
@endsection