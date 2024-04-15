@extends('templates/main', ['titulo'=>"ALUNOS"])

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
        crud="aluno"
        create="aluno.create"
        contentype="datatable"
        primaryroute=""
        secondaryroute=""
    />
@endsection