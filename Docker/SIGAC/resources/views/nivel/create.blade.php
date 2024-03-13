@extends('templates/main', ['titulo'=>"NOVO NÍVEL DE ENSINO"])

@section('conteudo')

    <form action="{{ route('nivel.store') }}" method="POST">
        @csrf
        <x-textbox name="nome" label="Nome" type="text" value="null" disabled="false"/>
        <div class="row">
            <div class="col text-start">
                <x-button label="Voltar" type="link" route="nivel.index" color="secondary"/>
            </div>
            <div class="col text-end">
                <x-button label="Cadastar" type="submit" route="" color="success"/>
            </div>
        </div>
    </form>
    
@endsection