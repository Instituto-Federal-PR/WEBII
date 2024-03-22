@extends('templates/main', ['titulo'=>"TURMA"])

@section('conteudo')

    <x-datatable 
        title="Tabela de Turmas" 
        :header="['ID', 'Turma', 'Ano', 'Ações']" 
        crud="turma" 
        :data="$data"
        :fields="['id', 'turma', 'ano']" 
        :hide="[true, false, true, false]"
        remove="turma"
        create="turma.create"
        id="" 
        modal=""
    /> 
    
@endsection
