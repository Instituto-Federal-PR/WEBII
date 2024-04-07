@extends('templates/main', ['titulo'=>"SOLICITAÇÕES EM ABERTO"])

@section('conteudo')

    <x-requestable :data="$data" />

@endsection