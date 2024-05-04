@extends('templates/main', ['titulo'=>"LANÇAMENTO DE HORAS"])

@section('conteudo')

    <x-datatable 
        title="Tabela de Horas Lançadas" 
        :header="['ID', 'Atividade', 'Horas', 'Ações']" 
        crud="comprovante" 
        :data="$data"
        :fields="['id', 'atividade', 'horas' ]" 
        :hide="[true, true, false, false]"
        remove="atividade"
        create="comprovante.create"
        id="" 
        modal=""
    /> 

@endsection