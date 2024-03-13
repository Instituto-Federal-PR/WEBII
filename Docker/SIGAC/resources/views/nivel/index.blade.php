@extends('templates/main', ['titulo'=>"NÍVEL"])

@section('conteudo')

    <x-datatable 
        title="Tabela de Níveis de Ensino" 
        :header="['ID', 'Nome', 'Ações']" 
        crud="nivel" 
        :data="$data"
        :fields="['id', 'nome']" 
        :hide="[true, false, false]"
        remove="nome"
        create="nivel.create"
        id="" 
    /> 
    
@endsection
