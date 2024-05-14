@extends('templates/main', ['titulo'=>"NOVO ".$nome])

@section('conteudo')

    <form action="{{ route('usuario.store') }}" method="POST">
        @csrf
        <input type="hidden" name="role_id" value="{{$role_id}}"/>
        <x-textbox name="nome" label="Nome" type="text" value="null" disabled="false"/>
        <x-textbox name="email" label="E-mail" type="email" value="null" disabled="false"/>
        <x-textbox name="senha" label="Senha" type="password" value="null" disabled="false"/>
        @if(strcmp($nome, "PROFESSOR") == 0)
            <x-selectbox name="curso" label="Curso" color="success" :data="$cursos" field="nome" disabled="true" :select="Auth::user()->curso_id"/>
            <input type="hidden" name="curso_id" value="{{Auth::user()->curso_id}}">
        @else
            <x-selectbox name="curso_id" label="Curso" color="success" :data="$cursos" field="nome" disabled="false" select="-1"/>
        @endif
        <x-selectbox name="papel" label="Papel" color="success" :data="$roles" field="nome" disabled="true" :select="$role_id"/>
        <div class="row">
            <div class="col text-start">
                <a href="{{route('users.role', $nome)}}" class="btn btn-secondary btn-block align-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-link" viewBox="0 0 16 16">
                        <path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9q-.13 0-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/>
                        <path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4 4 0 0 1-.82 1H12a3 3 0 1 0 0-6z"/>
                    </svg>
                    &nbsp; <span class="fw-bold">Voltar</span>
                </a>
            </div>
            <div class="col text-end">
                <x-button label="Cadastar" type="submit" route="" color="success"/>
            </div>
        </div>
    </form>
    
@endsection