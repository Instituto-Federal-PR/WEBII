@extends('templates/main', ['titulo'=>"DETALHES DO LANÇAMENTO"])

@section('conteudo')
    <form action="{{ route('comprovante.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <x-textbox name="aluno" label="Aluno" type="text" value="{{$data->aluno->nome}}" disabled="true"/>
        <x-selectbox name="categoria_id" label="Categoria" color="success" :data="$categorias" field="nome" disabled="false" :select="$data->categoria_id"/>
        <x-textbox name="atividade" label="Atividade" type="text" value="{{$data->atividade}}" disabled="false"/>
        <x-textbox name="horas" label="Total de Horas" type="number" value="{{$data->horas}}" disabled="false"/>
        <div class="row">
            <div class="col text-start mt-3">
                <x-button label="Voltar" type="link" route="comprovante.index" color="secondary"/>
            </div>
            <div class="col text-end">
                <x-button label="Alterar" type="submit" route="" color="success"/>
            </div>
        </div>
    
@endsection

@section('script')

    <script type="text/javascript">

        document.getElementById('curso_id').addEventListener('change', function() {

            // Obtém id do curso selecionado
            let curso_id = this.value

            $.getJSON('/api/categoria/'+curso_id, function(data) {
                $('#categoria_id').children().remove().end()
                $('#categoria_id').append("<option selected='true' disabled></option>")
                data.map((item) => {
                    $('#categoria_id').append(new Option(item.nome, item.id))
                });
                $('#categoria_id').removeAttr('disabled');
            });

            $.getJSON('/api/turma/'+curso_id, function(data) {
                $('#turma_id').children().remove().end()
                $('#turma_id').append("<option selected='true' disabled></option>")
                data.map((item) => {
                    $('#turma_id').append(new Option(item.ano, item.id))
                });
                $('#turma_id').removeAttr('disabled');
            });
        });

        document.getElementById('turma_id').addEventListener('change', function() {
           
            // Obtém id da turma selecionado
            let turma_id = this.value

            $.getJSON('/api/aluno/'+turma_id, function(data) {
                $('#aluno_id').children().remove().end()
                $('#aluno_id').append("<option selected='true' disabled></option>")
                data.map((item) => {
                    $('#aluno_id').append(new Option(item.nome, item.id))
                });
                $('#aluno_id').removeAttr('disabled');
            });
            
        });

    </script>

@endsection