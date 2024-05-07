@extends('templates/main', ['titulo'=>"HOME"])

@section('conteudo')

<span class="fs-4"->Seja bem-vindo(a)<br>{{ Auth::user()->name }}</span>

@endsection

