@extends('templates/main', ['titulo'=>"NOVA CATEGORIA"])

@section('conteudo')

    <form action="{{ route('categoria.store') }}" method="POST">
        @csrf
        <x-textbox name="nome" label="Nome" type="text" value="null" disabled="false"/>
        <x-textbox name="maximo_horas" label="Máximo de Horas" type="number" value="null" disabled="false"/>
        <x-selectbox name="curso_id" label="Curso" color="success" :data="$cursos" field="nome" disabled="false" select="-1"/>
        <div class="row">
            <div class="col text-start">
                <x-button label="Voltar" type="link" route="categoria.index" color="secondary"/>
            </div>
            <div class="col text-end">
                <x-button label="Cadastar" type="submit" route="" color="success"/>
            </div>
        </div>
    </form>
    
@endsection