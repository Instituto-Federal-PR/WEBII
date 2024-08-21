@extends('templates.main', [
    "title" => "Novo Eixo",
    "header" => "Cadastrar Eixo"
])

@section('content')
    <hr>
        <a href="{{route('eixo.index')}}" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
            </svg>
        </a>
    <hr>
    <form action="{{route('eixo.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="nome" class="form-control"><br>
        <textarea rows="6" cols="30" name="descricao" class="form-control"></textarea><br>
        <input type="file" id="documento" name="documento" class="form-control">
        <input type="submit" value="Salvar" class="btn btn-primary mt-2">
    </form>
@endsection
