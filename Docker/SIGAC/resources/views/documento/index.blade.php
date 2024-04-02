@extends('templates/main', ['titulo'=>"SOLICITAÇÕES EFETUADAS"])

@section('conteudo')

    <x-datatable 
        title="Tabela de Solicitações" 
        :header="['ID', 'Descrição', 'Hora(s)', 'Ações']" 
        crud="documento" 
        :data="$data"
        :fields="['id', 'descricao', 'horas_in']" 
        :hide="[true, false, true, false]"
        remove="descricao"
        create="documento.create" 
        id=""
        modal=""
    /> 
@endsection