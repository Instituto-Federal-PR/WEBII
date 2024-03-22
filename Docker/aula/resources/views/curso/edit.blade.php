@extends('templates/main', ['titulo'=>"ALTERAR CURSO"])

@section('conteudo')

    <form action="{{ route('curso.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <x-textbox name="nome" label="Nome" type="text" :value="$data->nome" disabled="false"/>
        <x-textbox name="sigla" label="Sigla" type="text" :value="$data->sigla" disabled="false"/>
        <x-textbox name="horas" label="Total de Horas Afins" type="number" :value="$data->total_horas" disabled="false"/>
        <x-selectbox name="eixo_id" label="Eixo" color="success" :data="$eixos" field="nome" disabled="false" :select="$data->eixo_id"/>
        <x-selectbox name="nivel_id" label="Nível" color="success" :data="$niveis" field="nome" disabled="false" :select="$data->nivel_id"/>
        <div class="row">
            <div class="col text-start">
                <x-button label="Voltar" type="link" route="curso.index" color="secondary"/>
            </div>
            <div class="col text-end">
                <x-button label="Alterar" type="submit" route="" color="success"/>
            </div>
        </div>
    </form>
    
@endsection