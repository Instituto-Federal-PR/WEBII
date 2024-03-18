@extends('templates/main', ['titulo'=>"DETALHES DO ALUNO"])

@section('conteudo')

    <x-textbox name="nome" label="Nome" type="text" :value="$data->nome" disabled="true"/>
    <x-textbox name="cpf" label="CPF" type="text" :value="$data->cpf" disabled="true"/>
    <x-textbox name="email" label="E-mail" type="email" :value="$data->email" disabled="true"/>
    <x-textbox name="curso" label="Curso" type="text" :value="$data->curso->nome" disabled="true"/>
    <x-textbox name="turma" label="Turma" type="text" :value="$data->turma->ano" disabled="true"/>
    <div class="row">
        <div class="col text-start">
            <x-button label="Voltar" type="link" route="aluno.index" color="secondary"/>
        </div>
    </div>

@endsection
