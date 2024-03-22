@extends('templates/main', ['titulo'=>"CURSO"])

@section('conteudo')

    <x-datatable 
        title="Tabela de Cursos" 
        :header="['ID', 'Nome', 'Ações']" 
        crud="curso" 
        :data="$data"
        :fields="['id', 'nome']" 
        :hide="[true, false, false]"
        remove="nome"
        add="true" 
    /> 
@endsection