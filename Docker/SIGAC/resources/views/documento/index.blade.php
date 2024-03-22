@extends('templates/main', ['titulo'=>"SOLICITAÇÕES EFETUADAS"])

@section('conteudo')

    <x-datatable 
        title="Tabela de Solicitações" 
        :header="['ID', 'Horas', 'Ações']" 
        crud="documento" 
        :data="$data"
        :fields="['id', 'horas_in']" 
        :hide="[true, false, false]"
        remove="horas_in"
        create="documento.create" 
        id=""
        modal=""
    /> 
@endsection