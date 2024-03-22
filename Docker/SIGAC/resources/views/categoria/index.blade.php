@extends('templates/main', ['titulo'=>"CATEGORIA"])

@section('conteudo')

    <x-datatable 
        title="Tabela de Categorias" 
        :header="['ID', 'Nome', 'Máximo (horas)', 'Ações']" 
        crud="categoria" 
        :data="$data"
        :fields="['id', 'nome', 'maximo_horas']" 
        :hide="[true, false, true, false]"
        remove="nome"
        create="categoria.create" 
        id=""
        modal=""
    /> 
@endsection