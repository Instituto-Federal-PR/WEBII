@extends('templates/main', ['titulo'=>"SOLICITAÇÃO DE HORAS AFINS"])

@section('conteudo')

    <form action="{{ route('documento.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-textbox name="descricao" label="Descrição" type="text" value="null" disabled="false"/>
        <x-textbox name="horas" label="Total de Horas" type="number" value="null" disabled="false"/>
        <x-selectbox name="categoria_id" label="Categoria" color="success" :data="$categorias" field="nome" disabled="false" select="-1"/>
        <x-textbox name="documento" label="Documento" type="file" value="null" disabled="false"/>
        <div class="row">
            <div class="col text-start">
                <x-button label="Voltar" type="link" route="documento.index" color="secondary"/>
            </div>
            <div class="col text-end">
                <x-button label="Solicitar" type="submit" route="" color="success"/>
            </div>
        </div>
    </form>
    
@endsection