@extends('templates/main', ['titulo'=>"NOVO ALUNO"])

@section('conteudo')

    <form action="{{ route('aluno.store') }}" method="POST">
        @csrf
        <x-textbox name="nome" label="Nome" type="text" value="null" disabled="false"/>
        <x-textbox name="cpf" label="CPF" type="number" value="null" disabled="false"/>
        <x-textbox name="email" label="E-mail" type="email" value="null" disabled="false"/>
        <x-textbox name="senha" label="Senha" type="password" value="null" disabled="false"/>
        <x-selectbox name="curso_id" label="Curso" color="success" :data="$cursos" field="nome" disabled="false" select="-1"/>
        <x-selectbox name="turma_id" label="Turma" color="success" :data="$turmas" field="ano" disabled="true" select="-1"/>
        <div class="row">
            <div class="col text-start">
                <x-button label="Voltar" type="link" route="aluno.index" color="secondary"/>
            </div>
            <div class="col text-end">
                <x-button label="Cadastar" type="submit" route="" color="success"/>
            </div>
        </div>
    </form>

@endsection


@section('script')

    <script type="text/javascript">

        document.getElementById('curso_id').addEventListener('change', function() {

            // Obtém id do curso selecionado
            let curso_id = this.value

            // Requisição a API
            $.getJSON('/api/turma/'+curso_id, function(data) {

                // Remove todos os Elementos do Select
                $('#turma_id').children().remove().end()
                // Preenche o Select
                data.map((item) => {
                    $('#turma_id').append(new Option(item.ano, item.id))
                });
                // Habilita Select
                $('#turma_id').removeAttr('disabled');
            });

            // Desabilita Select
            // $('#id').attr('disabled', 'disabled');  
        });

    </script>

@endsection