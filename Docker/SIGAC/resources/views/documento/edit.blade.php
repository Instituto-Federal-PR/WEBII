@extends('templates/main', ['titulo'=>"ALTERAR SOLICITAÇÃO"])

@section('conteudo')

    <form action="{{ route('documento.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-textbox name="descricao" label="Descrição" type="text" :value="$data->descricao" disabled="false"/>
        <x-textbox name="horas" label="Total de Horas" type="number" :value="$data->horas_in" disabled="false"/>
        <x-textbox name="status" label="Andamento" type="text" :value="$data->status" disabled="true"/>
        <x-selectbox name="categoria_id" label="Categoria" color="success" :data="$categorias" field="nome" disabled="false" :select="$data->categoria_id"/>
        <x-textbox name="documento" label="Documento" type="file" value="null" disabled="false"/>
        <div class="row">
            <div class="col text-start">
                <x-button label="Voltar" type="link" route="documento.index" color="secondary"/>
            </div>
            <div class="col text-end">
                <x-button label="Alterar" type="submit" route="" color="success"/>
            </div>
        </div>
    </form>
    
@endsection