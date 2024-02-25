@extends('templates/main', ['titulo'=>"NOVO CURSO"])

@section('conteudo')

    <form action="{{ route('curso.store') }}" method="POST">
        @csrf
        <x-textbox name="nome" label="Nome" type="text"/>
        <x-selectbox name="eixo_id" label="Eixo" color="success" :data="$eixos" field="nome" disabled="false"/>
        <div class="row">
            <div class="col text-start">
                <x-button label="Voltar" type="link" route="curso.index"/>
            </div>
            <div class="col text-end">
                <x-button label="Cadastar" type="submit" route=""/>
            </div>
        </div>
    </form>
    
@endsection