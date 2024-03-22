@extends('templates/main', ['titulo'=>"EIXO"])

@section('conteudo')

    <x-datatable 
        title="Tabela de Eixos e Áreas" 
        :header="['ID', 'Nome', 'Ações']" 
        crud="eixo" 
        :data="$data"
        :fields="['id', 'nome']" 
        :hide="[true, false, false]"
        remove="nome"
        create="eixo.create" 
        id=""
        modal=""
    /> 
@endsection