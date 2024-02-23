@extends('templates/site')

@section('conteudo')

    <form action="{{ route('aluno.store') }}" method="POST">
        @csrf
        <h2 class="text-success fw-bold">REGISTRO DO ALUNO</h2>
        <x-textbox name="nome" label="Nome" type="text"/>
        <x-textbox name="cpf" label="CPF" type="number"/>
        <x-textbox name="email" label="E-mail" type="email"/>
        <x-textbox name="senha" label="Senha" type="password"/>
        <x-textbox name="confirmacao" label="Confirmar" type="password"/>
        <x-selectbox name="curso" label="Curso" color="success" :data="$cursos"/>
        <x-button label="Registrar" type="submit" route=""/>
    </form>

@endsection