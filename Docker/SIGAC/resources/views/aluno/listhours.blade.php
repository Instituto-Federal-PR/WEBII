@extends('templates/main', ['titulo'=>"RELATÓRIO DE HORAS - DECLARAÇÃO"])

@section('conteudo')

<div class="card text-center">
    <div class="card-header bg-success text-white fw-bold">DESCRIÇÃO DAS HORAS REGISTRADAS NO SIGAC</div>
    <div class="card-body">
        <h5 class="card-title">Solicitadas pelo Aluno</h5>
        <p class="card-text text-success fw-bold">{{$data->solicitado}} horas</p>
        <h5 class="card-title">Validadas pela Coordenação</h5>
        <p class="card-text text-success fw-bold">{{$data->validado}} horas</p>
        <h5 class="card-title">Lançadas por Servidores</h5>
        <p class="card-text text-success fw-bold">{{$data->lancado}} horas</p>
        <h5 class="card-title">Total Contabilizado</h5>
        <p class="card-text fw-bold {{$data->total < $data->necessario ? 'text-danger' : 'text-success'}}">
                {{$data->total}} horas / {{$data->necessario}} horas
        </p>
    </div>
    <div class="card-footer text-white fw-bold {{$data->total < $data->necessario ? 'bg-danger' : 'bg-white'}}">
        @if($data->total < $data->necessario)
            <p class="card-text text-white">Ainda é necessário cumprir {{$data->necessario - $data->total}} horas!</p>
        @else
            <x-button label="Gerar Declração" type="document" route="{{route('student.declaration', $data->id)}}" color="success"/>
        @endif
    </div>
</div>
    
@endsection