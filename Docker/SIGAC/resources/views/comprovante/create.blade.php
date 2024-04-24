@extends('templates/main', ['titulo'=>"DETALHES DO LANÇAMENTO"])

@section('conteudo')

    <form action="{{ route('comprovante.store') }}" method="POST">
        @csrf
        <x-textbox name="atividade" label="Atividade" type="text" value="" disabled="false"/>
        <x-textbox name="horas" label="Total de Horas" type="number" value="" disabled="false"/>
        <x-selectbox name="curso_id" label="Curso" color="success" :data="$cursos" field="nome" disabled="false" select="-1"/>
        <x-selectbox name="categoria_id" label="Categoria" color="success" :data="$categorias" field="nome" disabled="true" select="-1"/>
        <x-selectbox name="turma_id" label="Turma" color="success" :data="$turmas" field="ano" disabled="true" select="-1"/>
        <x-selectbox name="aluno_id" label="Aluno" color="success" :data="$alunos" field="nome" disabled="true" select="-1"/>
        <div class="row">
            <div class="col text-start mt-3">
                <x-button label="Voltar" type="link" route="comprovante.index" color="secondary"/>
            </div>
            <div class="col text-end">
                <x-button label="Lançar" type="submit" route="" color="success"/>
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