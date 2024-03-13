@extends('templates/main', ['titulo'=>"DETALHES ".$nome])

@section('conteudo')

    <x-textbox name="nome" label="Nome" type="text" :value="$data->name" disabled="true"/>
    <x-textbox name="email" label="E-mail" type="email" :value="$data->email" disabled="true"/>
    <x-selectbox name="curso_id" label="Curso" color="success" :data="$cursos" field="nome" disabled="true" :select="$data->curso_id"/>
    <x-selectbox name="papel" label="Papel" color="success" :data="$roles" field="nome" disabled="true" :select="$data->role_id"/>
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
    </div>
    
@endsection