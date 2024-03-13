@extends('templates/main', ['titulo'=>"ALTERAR NÍVEL DE ENSINO"])

@section('conteudo')

    <form action="{{ route('nivel.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <x-textbox name="nome" label="Nome" type="text" :value="$data->nome" disabled="false"/>
        <div class="row">
            <div class="col text-start">
                <x-button label="Voltar" type="link" route="nivel.index" color="secondary"/>
            </div>
            <div class="col text-end">
                <x-button label="Alterar" type="submit" route="" color="success"/>
            </div>
        </div>
    </form>
    
@endsection