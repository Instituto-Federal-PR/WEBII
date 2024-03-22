@extends('templates/main', ['titulo'=>"NOVO CURSO"])

@section('conteudo')

    <form action="{{ route('curso.store') }}" method="POST">
        @csrf
        <x-textbox name="nome" label="Nome" type="text" value="null" disabled="false"/>
        <x-textbox name="sigla" label="Sigla" type="text" value="null" disabled="false"/>
        <x-textbox name="horas" label="Total de Horas Afins" type="number" value="null" disabled="false"/>
        <x-selectbox name="eixo_id" label="Eixo" color="success" :data="$eixos" field="nome" disabled="false" select="-1"/>
        <x-selectbox name="nivel_id" label="Nível" color="success" :data="$niveis" field="nome" disabled="false" select="-1"/>
        <div class="row">
            <div class="col text-start">
                <x-button label="Voltar" type="link" route="curso.index" color="secondary"/>
            </div>
            <div class="col text-end">
                <x-button label="Cadastar" type="submit" route="" color="success"/>
            </div>
        </div>
    </form>
    
@endsection