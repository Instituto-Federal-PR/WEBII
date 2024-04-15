@extends('templates/main', ['titulo'=>"RELATÓRIO (PDF) DE HORAS"])

@section('conteudo')

    <x-tablist
        :tabs="$data"
        fieldtab="turma"
        id="id"
        data="alunos"
        fielddata="nome"
        :header="['ID', 'Nome', 'Ações']" 
        :fields="['id', 'nome']"
        :hide="[true, false, false]" 
        primaryroute="report.class"
        secondaryroute="report.student"
        contentype="listitem"
    />

@endsection