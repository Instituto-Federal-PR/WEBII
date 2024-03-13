@extends('templates/main', ['titulo'=>"ALTERAR CATEGORIA"])

@section('conteudo')

    <form action="{{ route('categoria.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <x-textbox name="nome" label="Nome" type="text" :value="$data->nome" disabled="false"/>
        <x-textbox name="maximo_horas" label="Máximo de Horas" type="number" :value="$data->maximo_horas" disabled="false"/>
        <x-selectbox name="curso_id" label="Curso" color="success" :data="$cursos" field="nome" disabled="false" :select="$data->curso_id"/>
        <div class="row">
            <div class="col text-start">
                <x-button label="Voltar" type="link" route="categoria.index" color="secondary"/>
            </div>
            <div class="col text-end">
                <x-button label="Alterar" type="submit" route="" color="success"/>
            </div>
        </div>
    </form>
    
@endsection