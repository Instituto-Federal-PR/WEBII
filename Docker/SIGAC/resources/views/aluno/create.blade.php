@extends('templates/site')

@section('conteudo')

    <form action="{{ route('aluno.store') }}" method="POST">
        @csrf
        <h2 class="text-success fw-bold">REGISTRO DO ALUNO</h2>
        <x-textbox name="nome" label="Nome" type="text"/>
        <x-textbox name="cpf" label="CPF" type="number"/>
        <x-textbox name="email" label="E-mail" type="email"/>
        <x-textbox name="senha" label="Senha" type="password"/>
        <x-textbox name="confirmacao" label="Confirmar" type="password"/>
        <x-selectbox name="curso_id" label="Curso" color="success" :data="$cursos" field="nome" disabled="false"/>
        <x-selectbox name="turma_id" label="Turma" color="success" :data="$turmas" field="ano" disabled="true"/>
        <x-button label="Registrar" type="submit" route=""/>
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